<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pemesanan;
use Carbon\Carbon;

class AutoCompleteCheckout extends Command
{
    protected $signature = 'auto-complete:checkout';
    protected $description = 'Otomatis menyelesaikan pesanan setelah tanggal checkout';

    public function handle()
    {
        $today = Carbon::today();

        $jumlah = Pemesanan::where('status', 'berhasil')
            ->whereDate('tgl_check_out', '<=', $today)
            ->update(['status' => 'selesai']);

        $this->info("Berhasil update $jumlah pemesanan jadi 'selesai'");
    }
}
