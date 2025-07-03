<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pemesanan;
use Carbon\Carbon;

class AutoCancelUnpaidPemesanan extends Command
{
    protected $signature = 'auto-cancel:unpaid';
    protected $description = 'Membatalkan otomatis pemesanan yang belum dibayar sebelum batas waktu';

    public function handle()
    {
        $jumlah = Pemesanan::where('status', 'pending')
            ->where('batas_pembayaran', '<', Carbon::now()) 
            ->whereNull('bukti_transfer') 
            ->update(['status' => 'gagal']); 

        $this->info("Berhasil update $jumlah pemesanan jadi 'gagal'");
    }
}
