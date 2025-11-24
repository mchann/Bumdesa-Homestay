<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\Kamar;
use Carbon\Carbon;
use App\Models\Homestay;
use Illuminate\Support\Facades\Auth;
use Midtrans\Snap;
use Illuminate\Support\Facades\Response;
use App\Services\MidtransService;
use Midtrans\Config;
use Barryvdh\DomPDF\Facade\Pdf;

class PemesananController extends Controller
{
    /**
     * Menampilkan history pemesanan
     */
    public function history()
    {
        $pelangganId = Auth::id();

        $pemesanan = Pemesanan::with(['kamar.homestay', 'pelanggan', 'ulasan'])
            ->where('pelanggan_id', $pelangganId)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pelanggan.pemesanan.history', compact('pemesanan'));
    }

    /**
     * Menampilkan status pemesanan terbaru
     */
    public function cekStatus()
    {
        $pelangganId = Auth::id();

        // Ambil pemesanan terbaru user
        $pemesanan = Pemesanan::with(['kamar.homestay', 'pelanggan', 'ulasan'])
            ->where('pelanggan_id', $pelangganId)
            ->orderBy('created_at', 'desc')
            ->first();

        return view('pelanggan.pemesanan.cek-status', compact('pemesanan'));
    }

    /**
     * Menampilkan detail pemesanan spesifik
     */
    public function detail($id)
    {
        $pemesanan = Pemesanan::with(['kamar.homestay', 'pelanggan', 'kamar.jenisKamar', 'ulasan'])
            ->where('pelanggan_id', Auth::id())
            ->findOrFail($id);

        return view('pelanggan.pemesanan.detail', compact('pemesanan'));
    }

    public function show($id)
    {
        $pemesanan = Pemesanan::with(['kamar.homestay', 'pelanggan', 'homestay', 'ulasan'])
            ->findOrFail($id);

        return view('pelanggan.pemesanan.show', compact('pemesanan'));
    }

    public function create(Request $request)
    {
        $homestayId = $request->input('homestay_id');
        $kamarId = $request->input('kamar_id');
        $checkIn = $request->input('check_in');
        $checkOut = $request->input('check_out');
        $dewasa = $request->input('dewasa');
        $anak = $request->input('anak');

        $kamar = Kamar::findOrFail($kamarId);
        $homestay = Homestay::findOrFail($homestayId);

        return view('pelanggan.pemesanan.create', compact('homestay', 'kamar', 'checkIn', 'checkOut', 'dewasa', 'anak'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20|regex:/^[0-9+]+$/',
            'special_requests' => 'nullable|string|max:1000',
            'tgl_check_in' => 'required|date|after_or_equal:today',
            'tgl_check_out' => 'required|date|after:tgl_check_in',
            'jumlah_tamu' => 'required|integer|min:1',
            'jumlah_kamar' => 'required|integer|min:1',
            'kamar_id' => 'required|exists:kamar,kamar_id',
        ], [
            'phone.regex' => 'Nomor telepon hanya boleh angka dan tanda +.',
            'special_requests.max' => 'Catatan terlalu panjang (maksimal 1000 karakter).',
            'kamar_id.exists' => 'Kamar tidak ditemukan.',
        ]);

        try {
            $available = Kamar::where('kamar_id', $request->kamar_id)
                ->where('status', 'tersedia')
                ->exists();

            if (!$available) {
                return redirect()->back()
                    ->withErrors(['kamar_id' => 'Kamar tidak tersedia atau sudah dipesan.'])
                    ->withInput();
            }

            $checkIn = Carbon::parse($request->tgl_check_in);
            $checkOut = Carbon::parse($request->tgl_check_out);
            $lamaInap = $checkIn->diffInDays($checkOut);

            $kamar = Kamar::findOrFail($request->kamar_id);
            $hargaPerMalam = max($kamar->harga, 0);
            $totalHarga = $lamaInap * $hargaPerMalam * $request->jumlah_kamar;

            $pemesanan = new Pemesanan();
            $pemesanan->pelanggan_id = Auth::id();
            $pemesanan->homestay_id = $kamar->homestay_id;
            $pemesanan->kamar_id = $request->kamar_id;
            $pemesanan->tgl_check_in = $request->tgl_check_in;
            $pemesanan->tgl_check_out = $request->tgl_check_out;
            $pemesanan->jumlah_tamu = $request->jumlah_tamu;
            $pemesanan->jumlah_kamar = $request->jumlah_kamar;
            $pemesanan->catatan = $request->special_requests;
            $pemesanan->total_harga = $totalHarga;
            $pemesanan->batas_pembayaran = now()->addHours(2);
            $pemesanan->status = 'pending';
            $pemesanan->save();

            \Illuminate\Support\Facades\Log::info('Pemesanan berhasil', [
                'pemesanan_id' => $pemesanan->pemesanan_id,
                'catatan' => $pemesanan->catatan,
                'special_requests' => $request->special_requests
            ]);

            return redirect()->route('pelanggan.pemesanan.pembayaran', ['id' => $pemesanan->pemesanan_id])
                ->with('success', 'Pemesanan berhasil dibuat!');

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error simpan pemesanan: ' . $e->getMessage(), $request->all());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan pemesanan: ' . $e->getMessage());
        }
    }

    public function bayar($id)
    {
        Config::$serverKey = config('midtrans.serverKey');
        Config::$isProduction = config('midtrans.isProduction', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $pemesanan = Pemesanan::findOrFail($id);

        $params = [
            'transaction_details' => [
                'order_id' => 'ORDER-' . $pemesanan->pemesanan_id,
                'gross_amount' => $pemesanan->total_akhir,
            ],
            'customer_details' => [
                'first_name' => $pemesanan->pelanggan->name,
                'email' => $pemesanan->pelanggan->email,
            ]
        ];

        $paymentUrl = Snap::createTransaction($params)->redirect_url;

        return redirect($paymentUrl);
    }

    public function getSnapToken($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);

        Config::$serverKey = config('midtrans.serverKey');
        Config::$isProduction = config('midtrans.isProduction', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => 'ORDER-' . $pemesanan->pemesanan_id,
                'gross_amount' => (int) $pemesanan->total_akhir,
            ],
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ],
            'expiry' => [
                'start_time' => now()->format('Y-m-d H:i:s O'),
                'unit' => 'hour',
                'duration' => 2
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return Response::json([
            'snap_token' => $snapToken
        ]);
    }

    public function uploadBuktiTransfer(Request $request, $id)
    {
        $request->validate([
            'bukti_transfer' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $pemesanan = Pemesanan::where('pelanggan_id', Auth::id())->findOrFail($id);

        if ($request->hasFile('bukti_transfer')) {
            $filename = time() . '_' . $request->file('bukti_transfer')->getClientOriginalName();
            $path = $request->file('bukti_transfer')->storeAs('bukti_transfer', $filename, 'public');

            $pemesanan->bukti_transfer = $path;
            $pemesanan->status = 'menunggu_konfirmasi';
            $pemesanan->save();
        }

        return view('pelanggan.pemesanan.pemesanan_success', [
            'invoice' => $pemesanan->invoice_number,
            'tanggal' => $pemesanan->created_at->format('d M Y, H:i'),
            'total' => number_format($pemesanan->total_akhir, 0, ',', '.')
        ]);
    }

    public function showPembayaranForm($id)
    {
        $pemesanan = Pemesanan::where('pelanggan_id', Auth::id())->findOrFail($id);
        return view('pelanggan.pemesanan.pembayaran', compact('pemesanan'));
    }

    public function pembayaranSukses($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);

        return view('pelanggan.pemesanan.pemesanan_success', [
            'invoice' => $pemesanan->invoice_number,
            'tanggal' => now()->format('d M Y, H:i'),
            'total' => number_format($pemesanan->total_akhir, 0, ',', '.')
        ]);
    }

    public function showSimulasi($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        return view('pelanggan.pembayaran.simulasi', compact('pemesanan'));
    }

    /**
     * Membatalkan pemesanan
     */
    public function cancel($id)
    {
        $pemesanan = Pemesanan::where('pelanggan_id', Auth::id())
            ->where('status', 'pending')
            ->findOrFail($id);

        $pemesanan->status = 'dibatalkan';
        $pemesanan->save();

        return redirect()->route('pelanggan.history')
            ->with('success', 'Pemesanan berhasil dibatalkan.');
    }

    /**
     * API untuk mendapatkan status pemesanan
     */
    public function getStatus($id)
    {
        $pemesanan = Pemesanan::where('pelanggan_id', Auth::id())
            ->findOrFail($id);

        return response()->json([
            'status' => $pemesanan->status,
            'status_label' => $this->getStatusLabel($pemesanan->status),
            'invoice' => $pemesanan->invoice_number,
            'total_harga' => number_format($pemesanan->total_harga, 0, ',', '.'),
            'total_akhir' => number_format($pemesanan->total_akhir, 0, ',', '.'),
            'batas_pembayaran' => $pemesanan->batas_pembayaran ? $pemesanan->batas_pembayaran->format('d M Y, H:i') : null,
            'bukti_transfer' => $pemesanan->bukti_transfer
        ]);
    }

    /**
     * Download Invoice dalam format PDF
     */
    public function downloadInvoice($id, $type = 'pdf')
    {
        $pemesanan = Pemesanan::with(['kamar.homestay', 'pelanggan', 'kamar.jenisKamar'])
            ->where('pelanggan_id', Auth::id())
            ->findOrFail($id);

        // Authorization check - pastikan user hanya bisa mengakses invoice mereka sendiri
        if ($pemesanan->pelanggan_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($type === 'pdf') {
            return $this->generatePDFInvoice($pemesanan);
        }

        // Default ke PDF jika type tidak dikenali
        return $this->generatePDFInvoice($pemesanan);
    }

    /**
     * Generate PDF Invoice
     */
    private function generatePDFInvoice($pemesanan)
    {
        $data = [
            'pemesanan' => $pemesanan,
            'title' => 'Invoice ' . $pemesanan->invoice_number
        ];

        $pdf = Pdf::loadView('pdf.invoice', $data);
        
        $filename = "Invoice_{$pemesanan->invoice_number}.pdf";
        
        return $pdf->download($filename);
    }

    /**
     * Helper method untuk mendapatkan label status
     */
    private function getStatusLabel($status)
    {
        $statusLabels = [
            'pending' => 'Menunggu Pembayaran',
            'menunggu_konfirmasi' => 'Menunggu Konfirmasi',
            'dikonfirmasi' => 'Terkonfirmasi',
            'dibatalkan' => 'Dibatalkan',
            'selesai' => 'Selesai'
        ];

        return $statusLabels[$status] ?? $status;
    }
}