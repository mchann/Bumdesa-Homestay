<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PemesananPemilikExport implements FromView
{
    protected $pemesanans;

    public function __construct($pemesanans)
    {
        $this->pemesanans = $pemesanans;
    }

    public function view(): View
    {
        return view('exports.pemesanan', [
            'pemesanans' => $this->pemesanans
        ]);
    }
}
