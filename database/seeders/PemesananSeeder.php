<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pemesanan;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Kamar;
use App\Models\Homestay;
use Illuminate\Support\Facades\DB; // Ditambahkan untuk logging/query jika diperlukan

class PemesananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Cari user dengan ID 5 (Pelanggan) dan kamar pertama yang tersedia.
        $pelanggan = User::find(3);
        $kamar = Kamar::first();
        
        if (!$pelanggan || !$kamar) {
            $this->command->warn('Skip PemesananSeeder: User ID 3 atau data kamar tidak ditemukan. Pastikan data dasar sudah ada.');
            return;
        }

        // --- LOGIC PENENTUAN TANGGAL DI MASA LALU ---
        
        // Tanggal Check-out: 7 hari yang lalu (memastikan sudah lewat)
        $tglCheckOut = Carbon::now()->subDays(7);
        
        // Tanggal Check-in: 8 hari yang lalu
        $tglCheckIn = $tglCheckOut->copy()->subDay(1);
        
        // --- BUAT DATA PEMESANAN ---
        
        // Cek apakah pemesanan ini sudah ada (mencegah duplikasi jika seeder dijalankan berkali-kali)
        $existingOrder = Pemesanan::where('pelanggan_id', 3)
                                ->where('status', 'selesai')
                                ->whereDate('tgl_check_out', $tglCheckOut->toDateString())
                                ->exists();

        if (!$existingOrder) {
            Pemesanan::create([
                'pelanggan_id' => $pelanggan->id,
                'homestay_id' => $kamar->homestay_id,
                'kamar_id' => $kamar->kamar_id,
                'tgl_check_in' => $tglCheckIn->toDateString(),
                'tgl_check_out' => $tglCheckOut->toDateString(),
                'jumlah_tamu' => 2,
                'jumlah_kamar' => 1,
                'catatan' => 'Pemesanan khusus untuk pengujian fitur ulasan.',
                'total_harga' => 250000.00,
                'batas_pembayaran' => null,
                'status' => 'dikonfirmasi', // Status harus 'berhasil' atau 'selesai'
            ]);
        }

        $this->command->info("Data pemesanan untuk User ID 3 (status 'selesai') berhasil dibuat.");
    }
}