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
// use Midtrans\Config;
use Illuminate\Support\Facades\Response;
use App\Services\MidtransService;
use Midtrans\Config as MidtransConfig;
use Midtrans\Config;
use Midtrans\VTWeb;


class PemesananController extends Controller
{
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
            'tgl_check_in' => 'required|date|after_or_equal:today',
            'tgl_check_out' => 'required|date|after:tgl_check_in',
            'jumlah_tamu' => 'required|integer|min:1',
            'jumlah_kamar' => 'required|integer|min:1',
            'kamar_id' => 'required|exists:kamar,kamar_id',
            'catatan' => 'nullable|string',
        ]);

        $available = Kamar::where('kamar_id', $request->kamar_id)
            ->where('status', 'tersedia')
            ->exists();

        if (!$available) {
            return redirect()->back()->withErrors(['kamar_id' => 'Kamar tidak tersedia'])->withInput();
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
        $pemesanan->catatan = $request->catatan;
        $pemesanan->total_harga = $totalHarga;
        $pemesanan->batas_pembayaran = now()->addHours(2);
        $pemesanan->status = 'pending';
        $pemesanan->save();

        return redirect()->route('pelanggan.pemesanan.pembayaran', ['id' => $pemesanan->pemesanan_id]);
    }

public function bayar($id)
{
    Config::$serverKey = 'SB-Mid-server-xxxx';
    Config::$isProduction = false;
    Config::$isSanitized = true;
    Config::$is3ds = true;

    $pemesanan = Pemesanan::findOrFail($id);

    $params = [
        'transaction_details' => [
            'order_id' => 'ORDER-' . $pemesanan->id,
            'gross_amount' => $pemesanan->total_harga,
        ],
        'customer_details' => [
            'first_name' => $pemesanan->pelanggan->name,
            'email' => $pemesanan->pelanggan->email,
        ]
    ];

    // Ini akan redirect ke halaman Midtrans seperti VTWeb
    $paymentUrl = Snap::createTransaction($params)->redirect_url;

    return redirect($paymentUrl);
}

public function getSnapToken($id)
{
    $pemesanan = Pemesanan::findOrFail($id);

    \Midtrans\Config::$serverKey = config('midtrans.serverKey');
    \Midtrans\Config::$isProduction = config('midtrans.isProduction');
    \Midtrans\Config::$isSanitized = true;
    \Midtrans\Config::$is3ds = true;

    $params = [
        'transaction_details' => [
            'order_id' => 'ORDER-' . $pemesanan->pemesanan_id,
            'gross_amount' => (int) $pemesanan->total_harga,
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

    $snapToken = \Midtrans\Snap::getSnapToken($params);

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
        'invoice' => 'INV-' . str_pad($pemesanan->pemesanan_id, 6, '0', STR_PAD_LEFT),
        'tanggal' => $pemesanan->created_at->format('d M Y, H:i'),
        'total' => number_format($pemesanan->total_harga, 0, ',', '.')
    ]);
}

    public function showPembayaranForm($id)
    {
        $pemesanan = Pemesanan::where('pelanggan_id', Auth::id())->findOrFail($id);
        return view('pelanggan.pemesanan.pembayaran', compact('pemesanan'));
    }

    // Jika akses langsung via route
    public function success()
{
    return view('pelanggan.pemesanan.pemesanan_success', [
        'invoice' => 'INV-000000',
        'tanggal' => now()->format('d M Y, H:i'),
        'total' => '0'
    ]);
}

}
