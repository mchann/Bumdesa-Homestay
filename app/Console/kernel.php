<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Ini buat auto cancel yang belum bayar
        $schedule->command('auto-cancel:unpaid')->everyMinute();

        // Kalau mau sekaligus jalanin auto complete checkout, hapus komen ini:
        // $schedule->command('auto-complete:checkout')->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
    }
}
