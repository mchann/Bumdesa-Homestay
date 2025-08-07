<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\PemesananPemilikExport;
use App\Models\Pemesanan;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ExportExcelPemilikController extends Controller
{
    public function export(Request $request)
    {
        $tanggalAwal = $request->tanggal_awal;
        $tanggalAkhir = $request->tanggal_akhir;

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $pemilikId = $user->pemilikProfile->pemilik_id;

        $pemesanans = Pemesanan::with(['pelanggan', 'kamar.homestay'])
            ->whereHas('kamar.homestay', function ($query) use ($pemilikId) {
                $query->where('pemilik_id', $pemilikId);
            })
            ->whereBetween('tgl_check_in', [$tanggalAwal, $tanggalAkhir])
            ->get();

        return Excel::download(
            new PemesananPemilikExport($pemesanans),
            'laporan_pemesanan_pemilik.xlsx'
        );
    }
}
