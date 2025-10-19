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
        // Ambil filter homestay dan status dari request
        $homestayId = $request->input('homestay_id'); 
        $status = $request->input('status'); // Jika perlu filter status di Excel (saat ini PemesananExport tidak menggunakannya, tapi tetap dibawa)

        // Panggil PemesananExport dan teruskan homestayId
        return Excel::download(new PemesananExport($tanggalAwal, $tanggalAkhir, $homestayId), 'data_pemesanan.xlsx');
    }
}
