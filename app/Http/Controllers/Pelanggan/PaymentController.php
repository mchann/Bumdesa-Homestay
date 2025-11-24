<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemesanan;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;
use Midtrans\Transaction;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function __construct()
    {
        // configure Midtrans from config file on each request
        $serverKey = config('midtrans.serverKey');
        $isProduction = config('midtrans.isProduction', false);
        
        Log::debug('Midtrans Config', [
            'serverKey' => substr($serverKey, 0, 20) . '...',
            'isProduction' => $isProduction,
        ]);
        
        Config::$serverKey = $serverKey;
        Config::$isProduction = $isProduction;
        Config::$isSanitized = config('midtrans.isSanitized', true);
        Config::$is3ds = config('midtrans.is3ds', true);
    }

    /**
     * Return a Snap token for the given pemesanan id.
     */
    public function getSnapToken($id)
    {
        try {
            Log::info('Getting snap token for pemesanan', ['pemesanan_id' => $id]);
            
            $pemesanan = Pemesanan::findOrFail($id);

            // Calculate expiry duration in hours (must be integer)
            $durationHours = 2; // default 2 hours
            if ($pemesanan->batas_pembayaran) {
                $durationHours = (int) now()->diffInHours($pemesanan->batas_pembayaran);
                // ensure at least 1 hour if deadline is close
                if ($durationHours < 1) {
                    $durationHours = 1;
                }
            }

            $params = [
                'transaction_details' => [
                    'order_id' => 'ORDER-' . $pemesanan->pemesanan_id,
                    'gross_amount' => (int) $pemesanan->total_akhir,
                ],
                'customer_details' => [
                    'first_name' => optional($pemesanan->pelanggan)->name ?: 'Pelanggan',
                    'email' => optional($pemesanan->pelanggan)->email ?: '',
                ],
                'expiry' => [
                    'start_time' => now()->format('Y-m-d H:i:s O'),
                    'unit' => 'hour',
                    'duration' => $durationHours,
                ],
            ];

            Log::debug('Snap params', $params);

            // Use Snap to get a token
            $snapToken = Snap::getSnapToken($params);

            Log::info('Snap token generated successfully', ['token' => substr($snapToken, 0, 20) . '...']);

            return response()->json(['snap_token' => $snapToken]);
        } catch (\Exception $e) {
            Log::error('Error getting snap token', [
                'pemesanan_id' => $id,
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
            ]);

            return response()->json([
                'error' => 'Gagal mendapatkan token pembayaran',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Midtrans server-to-server notification (webhook)
     * This should be hit by Midtrans and must be CSRF-exempt.
     */
    public function notification(Request $request)
    {
        // Log raw payload for debugging
        Log::debug('Midtrans raw notification received', ['body' => $request->getContent(), 'headers' => $request->headers->all()]);

        // Midtrans Notification helper will read request input
        $notif = new Notification();

        Log::debug('Midtrans parsed notification', (array) $notif);

        $transaction = $notif->transaction_status;
        $orderId = $notif->order_id; // format ORDER-<id>

        // extract pemesanan id
        $pemesananId = null;
        if (str_starts_with($orderId, 'ORDER-')) {
            $pemesananId = intval(str_replace('ORDER-', '', $orderId));
        }

        $pemesanan = Pemesanan::find($pemesananId);
        if (!$pemesanan) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        switch ($transaction) {
            case 'capture':
                // capture could be challenged by fraud detection
                if ($notif->fraud_status == 'challenge') {
                    $newStatus = 'menunggu_konfirmasi';
                } else {
                    // mark as confirmed automatically
                    $newStatus = 'dikonfirmasi';
                }
                break;
            case 'settlement':
                // settled payments are confirmed
                $newStatus = 'dikonfirmasi';
                break;
            case 'pending':
                $newStatus = 'pending';
                break;
            case 'deny':
                $newStatus = 'gagal';
                break;
            case 'expire':
                $newStatus = 'gagal';
                break;
            case 'cancel':
                $newStatus = 'dibatalkan';
                break;
            default:
                $newStatus = $pemesanan->status; // no change
                break;
        }

        // Idempotency: only update if status actually changes
        if (isset($newStatus) && $newStatus !== $pemesanan->status) {
            Log::info('Updating pemesanan status via Midtrans notification', [
                'pemesanan_id' => $pemesanan->pemesanan_id,
                'old_status' => $pemesanan->status,
                'new_status' => $newStatus,
                'transaction_status' => $transaction,
            ]);

            $pemesanan->status = $newStatus;
            $pemesanan->save();
        } else {
            Log::info('Midtrans notification received but no status change needed', [
                'pemesanan_id' => $pemesanan->pemesanan_id,
                'status' => $pemesanan->status,
                'transaction_status' => $transaction,
            ]);
        }

        return response()->json(['status' => 'ok']);
    }

    /**
     * Verify transaction status with Midtrans (called from client onSuccess)
     */
    public function verifyStatus(Request $request, $id)
    {
        try {
            $pemesanan = Pemesanan::findOrFail($id);

            $orderId = 'ORDER-' . $pemesanan->pemesanan_id;

            // Call Midtrans API to get real transaction status
            $status = Transaction::status($orderId);

            Log::info('Midtrans verifyStatus result', ['order' => $orderId, 'result' => (array) $status]);

            if (is_array($status)) {
                $transaction = $status['transaction_status'] ?? null;
                $fraud = $status['fraud_status'] ?? null;
            } else {
                $transaction = $status->transaction_status ?? null;
                $fraud = $status->fraud_status ?? null;
            }

            // map to internal status similar to notification
            $newStatus = $pemesanan->status;
            if ($transaction === 'capture') {
                if ($fraud == 'challenge') {
                    $newStatus = 'menunggu_konfirmasi';
                } else {
                    $newStatus = 'dikonfirmasi';
                }
            } elseif ($transaction === 'settlement') {
                $newStatus = 'dikonfirmasi';
            } elseif ($transaction === 'pending') {
                $newStatus = 'pending';
            } elseif (in_array($transaction, ['deny', 'expire'])) {
                $newStatus = 'gagal';
            } elseif ($transaction === 'cancel') {
                $newStatus = 'dibatalkan';
            }

            if ($newStatus !== $pemesanan->status) {
                $pemesanan->status = $newStatus;
                $pemesanan->save();
            }

            return response()->json(['ok' => true, 'status' => $newStatus]);
        } catch (\Exception $e) {
            Log::error('Error verifying Midtrans transaction', ['id' => $id, 'error' => $e->getMessage()]);
            return response()->json(['ok' => false, 'error' => $e->getMessage()], 500);
        }
    }
}
