<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemesanan;
use Barryvdh\DomPDF\Facade\Pdf;

class ExportPdfController extends Controller
{
    public function export(Request $request)
    {
        $tanggalAwal = $request->tanggal_awal;
        $tanggalAkhir = $request->tanggal_akhir;
        $homestayId = $request->homestay_id; // Ambil filter homestay dari request
        $status = $request->status; // Ambil filter status dari request

        $query = Pemesanan::with(['pelanggan', 'kamar.homestay'])
            ->whereBetween('tgl_check_in', [$tanggalAwal, $tanggalAkhir]);

        // Terapkan filter homestay jika ada
        if ($homestayId) {
            $query->where('homestay_id', $homestayId);
        }
        
        // Terapkan filter status jika ada
        if ($status && $status !== 'semua') {
            $query->where('status', $status);
        }

        $pemesanans = $query->get();

        $pdf = Pdf::loadView('exports.pemesanan_pdf', compact('pemesanans', 'tanggalAwal', 'tanggalAkhir'));

        return $pdf->download('laporan_pemesanan_admin.pdf');
    }
}
