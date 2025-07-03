<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\Homestay;

class DaftarPemesananController extends Controller
{
    // Menampilkan daftar pemesanan dengan filter
    public function index(Request $request)
    {
        $query = Pemesanan::with(['kamar.homestay', 'pelanggan']);

        // Filter berdasarkan status
        if ($request->has('status') && $request->status !== 'semua') {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan homestay
        if ($request->has('homestay_id') && $request->homestay_id !== 'semua') {
            $query->whereHas('kamar.homestay', function ($q) use ($request) {
                $q->where('homestay_id', $request->homestay_id);
            });
        }

        $pemesanans = $query->latest()->get();
        $homestays = Homestay::all();

        return view('admin.pemesanan.index', compact('pemesanans', 'homestays'));
    }

    // Mengubah status pemesanan (terima/tolak)
    public function updateStatus(Request $request, $id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->status = $request->status;
        $pemesanan->save();

        return redirect()->route('admin.pemesanan.index')->with('success', 'Status pemesanan berhasil diperbarui.');
    }

    // Menampilkan detail pemesanan
    public function show($id)
    {
        $pemesanan = Pemesanan::with(['pelanggan', 'kamar.homestay'])
            ->where('pemesanan_id', $id)
            ->firstOrFail();

        return view('admin.pemesanan.show', compact('pemesanan'));
    }
}
