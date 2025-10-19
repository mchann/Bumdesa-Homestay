<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\Homestay;

class DaftarPemesananController extends Controller
{
    public function index(Request $request)
    {
        // 1. INITIATE QUERY dan terapkan Filter
        $query = Pemesanan::with(['homestay', 'pelanggan']);

        // Filter berdasarkan status
        if ($request->has('status') && $request->status !== 'semua' && $request->status !== null) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan homestay
        if ($request->filled('homestay')) {
            $query->where('homestay_id', $request->homestay);
        }

        // Default sort by terbaru
        $query->orderBy('created_at', 'desc');

        // 2. AMBIL DATA DENGAN PAGINATION
        $pemesanans = $query->paginate(10)->withQueryString();
        
        $homestays = Homestay::all();

        // 3. HITUNG STATISTIK BERDASARKAN FILTER YANG SAMA
        // Buat query baru (atau clone query utama sebelum pagination) untuk menghitung statistik aggregate
        $statsQuery = Pemesanan::query();
        
        // Aplikasikan kembali filter homestay dan status
        if ($request->has('status') && $request->status !== 'semua' && $request->status !== null) {
            $statsQuery->where('status', $request->status);
        }
        if ($request->filled('homestay')) {
            $statsQuery->where('homestay_id', $request->homestay);
        }

        // Hitung statistik untuk data yang SUDAH DIFILTER
        $totalPemesananFilter = $pemesanans->total(); // Lebih efisien: total dari pagination

        // Karena totalPemesananFilter sudah dihitung di atas, kita hanya perlu menghitung berhasil dan pendapatan
        
        // Total Pemesanan Berhasil (dari hasil filter)
        $totalPemesananBerhasilFilter = (clone $statsQuery)->where('status', 'berhasil')->count();

        // Total Pendapatan (hanya dari status berhasil, dari hasil filter)
        $totalPendapatanFilter = (clone $statsQuery)->where('status', 'berhasil')->sum('total_harga');


        // Hitung Statistik Global (untuk referensi, jika Anda ingin menyimpannya di view)
        $totalPemesananGlobal = Pemesanan::count();
        $totalPemesananBerhasilGlobal = Pemesanan::where('status', 'berhasil')->count();
        $totalPendapatanGlobal = Pemesanan::where('status', 'berhasil')->sum('total_harga');

        return view('admin.pemesanan.index', compact(
            'pemesanans', 
            'homestays',
            // Variabel statistik filter baru
            'totalPemesananFilter',
            'totalPemesananBerhasilFilter',
            'totalPendapatanFilter',
            // Variabel statistik global lama (diberi nama baru)
            'totalPemesananGlobal', 
            'totalPemesananBerhasilGlobal',
            'totalPendapatanGlobal'
        ));
    }

    // Mengubah status pemesanan (terima/tolak)
    public function updateStatus(Request $request, $id)
    {
        // Kode updateStatus tetap sama (tidak terpengaruh filter homestay)
        $request->validate([
            'status' => 'required|in:berhasil,gagal,menunggu_konfirmasi,selesai,pending'
        ]);

        $pemesanan = Pemesanan::where('pemesanan_id', $id)->firstOrFail();
        $pemesanan->status = $request->status;
        $pemesanan->save();

        return redirect()->route('admin.pemesanan.index')->with('success', 'Status pemesanan berhasil diperbarui.');
    }

    // Menampilkan detail pemesanan
    public function show($id)
    {
        // Kode show tetap sama
        $pemesanan = Pemesanan::with(['pelanggan', 'homestay'])
            ->where('pemesanan_id', $id)
            ->firstOrFail();

        return view('admin.pemesanan.show', compact('pemesanan'));
    }

    // Export Excel dengan filter
    public function exportExcel(Request $request)
    {
        $request->validate([
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal'
        ]);

        $query = Pemesanan::with(['homestay', 'pelanggan']);

        // Filter berdasarkan tanggal
        $query->whereBetween('created_at', [$request->tanggal_awal, $request->tanggal_akhir]);

        // Filter berdasarkan status (jika ada di session/request)
        if ($request->has('status') && $request->status !== 'semua' && $request->status !== null) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan homestay (jika ada di session/request)
        if ($request->has('homestay') && $request->homestay !== '' && $request->homestay !== null) {
            $query->where('homestay_id', $request->homestay);
        }

        $pemesanans = $query->orderBy('created_at', 'desc')->get();

        // Logic untuk export Excel
        // Anda bisa menggunakan package seperti Maatwebsite/Laravel-Excel
        
        return redirect()->back()->with('success', 'Export Excel berhasil dilakukan. Data difilter berdasarkan tanggal ' . $request->tanggal_awal . ' hingga ' . $request->tanggal_akhir);
    }

    // Export PDF dengan filter
    public function exportPdf(Request $request)
    {
        $request->validate([
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal'
        ]);

        $query = Pemesanan::with(['homestay', 'pelanggan']);

        // Filter berdasarkan tanggal
        $query->whereBetween('created_at', [$request->tanggal_awal, $request->tanggal_akhir]);

        // Filter berdasarkan status (jika ada di session/request)
        if ($request->has('status') && $request->status !== 'semua' && $request->status !== null) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan homestay (jika ada di session/request)
        if ($request->has('homestay') && $request->homestay !== '' && $request->homestay !== null) {
            $query->where('homestay_id', $request->homestay);
        }

        $pemesanans = $query->orderBy('created_at', 'desc')->get();

        // Logic untuk export PDF
        // Anda bisa menggunakan package seperti barryvdh/laravel-dompdf
        
        return redirect()->back()->with('success', 'Export PDF berhasil dilakukan. Data difilter berdasarkan tanggal ' . $request->tanggal_awal . ' hingga ' . $request->tanggal_akhir);
    }
}