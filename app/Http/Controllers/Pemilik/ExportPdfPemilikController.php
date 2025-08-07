<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemesanan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class ExportPdfPemilikController extends Controller
{
    public function export(Request $request)
    {
        $tanggalAwal = $request->tanggal_awal;
        $tanggalAkhir = $request->tanggal_akhir;

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $pemilikId = $user->pemilikProfile->pemilik_id;

        $pemesanans = Pemesanan::with(['pelanggan', 'kamar.homestay'])
            ->whereBetween('tgl_check_in', [$tanggalAwal, $tanggalAkhir])
            ->whereHas('kamar.homestay', function ($query) use ($pemilikId) {
                $query->where('pemilik_id', $pemilikId);
            })
            ->get();

        $pdf = Pdf::loadView('exports.pemesanan_pdf', compact('pemesanans', 'tanggalAwal', 'tanggalAkhir'));
        return $pdf->download('laporan_pemesanan_pemilik.pdf');
    }
}
