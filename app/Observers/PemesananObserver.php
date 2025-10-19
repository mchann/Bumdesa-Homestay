<?php

namespace App\Observers;

use App\Jobs\SendWaNotification;
use App\Models\Pemesanan;

class PemesananObserver
{
    public function updated(Pemesanan $pemesanan): void
    {
        if ($pemesanan->wasChanged('status') && $pemesanan->status === 'berhasil') {
            SendWaNotification::dispatch($pemesanan);
        }
    }
}