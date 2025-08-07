<?php
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Pemesanan;

class PemesananExport implements FromView
{
    protected $tanggalAwal;
    protected $tanggalAkhir;

    public function __construct($tanggalAwal, $tanggalAkhir)
    {
        $this->tanggalAwal = $tanggalAwal;
        $this->tanggalAkhir = $tanggalAkhir;
    }

    public function view(): View
    {
        return view('exports.pemesanan', [
            'pemesanans' => Pemesanan::with(['pelanggan', 'kamar'])
                ->whereBetween('tgl_check_in', [$this->tanggalAwal, $this->tanggalAkhir])
                ->get()
        ]);
    }
}