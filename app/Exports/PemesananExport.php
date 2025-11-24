<?php
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Pemesanan;

class PemesananExport implements FromView
{
    protected $tanggalAwal;
    protected $tanggalAkhir;
    protected $homestayId; // Tambahkan properti untuk ID Homestay

    public function __construct($tanggalAwal, $tanggalAkhir, $homestayId = null)
    {
        $this->tanggalAwal = $tanggalAwal;
        $this->tanggalAkhir = $tanggalAkhir;
        $this->homestayId = $homestayId; // Simpan ID Homestay
    }

    public function view(): View
    {
        $query = Pemesanan::with(['pelanggan', 'kamar'])
            ->whereBetween('tgl_check_in', [$this->tanggalAwal, $this->tanggalAkhir]);
        
        // Kriteria: Jika homestayId ada dan tidak kosong, filter.
        if ($this->homestayId) {
            $query->where('homestay_id', $this->homestayId);
        }

        return view('exports.pemesanan', [
            'pemesanans' => $query->get()
        ]);
    }
}
