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

        $pemesanans = Pemesanan::with(['pelanggan', 'kamar.homestay'])
            ->whereBetween('tgl_check_in', [$tanggalAwal, $tanggalAkhir])
            ->get();

        $pdf = Pdf::loadView('exports.pemesanan_pdf', compact('pemesanans', 'tanggalAwal', 'tanggalAkhir'));

        return $pdf->download('laporan_pemesanan_admin.pdf');
    }
}