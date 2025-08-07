<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Exports\PemesananExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ExportExcelController extends Controller
{
    public function export(Request $request)
    {
        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');

        return Excel::download(new PemesananExport($tanggalAwal, $tanggalAkhir), 'data_pemesanan.xlsx');
    }
}