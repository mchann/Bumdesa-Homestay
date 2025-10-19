<?php

namespace App\Jobs;

use App\Models\Pemesanan;
use App\Services\FonnteService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendWaNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $pemesanan;

    public function __construct(Pemesanan $pemesanan)
    {
        $this->pemesanan = $pemesanan;
    }

    public function handle(FonnteService $service): void
    {
        try {
            // Load relasi yang diperlukan
            $this->pemesanan->load([
                'pelanggan',
                'pelangganProfile', 
                'pelanggan.pelangganProfile',
                'kamar.homestay.pemilikProfile',
                'kamar.jenisKamar',
                'homestay'
            ]);

            // Chain relasi: pemesanan -> kamar -> homestay -> pemilikProfile
            $homestay = $this->pemesanan->kamar->homestay;
            
            if (!$homestay || !$homestay->pemilikProfile) {
                Log::error('Homestay atau pemilikProfile tidak ditemukan untuk pemesanan: ' . $this->pemesanan->pemesanan_id);
                return;
            }

            $pemilikPhone = $homestay->pemilikProfile->nomor_telepon;
            $adminPhone = env('WA_ADMIN_BUMDES');

            if (empty($adminPhone) || empty($pemilikPhone)) {
                Log::error('Nomor telepon admin atau pemilik kosong', [
                    'admin_phone' => $adminPhone,
                    'pemilik_phone' => $pemilikPhone
                ]);
                return;
            }

            // Template pesan dinamis dalam format invoice
            $message = $this->buildInvoiceMessage();

            // Kirim ke admin dan pemilik
            $service->sendMessage("{$adminPhone},{$pemilikPhone}", $message);

            Log::info('WhatsApp notification sent successfully for pemesanan: ' . $this->pemesanan->pemesanan_id);

        } catch (\Exception $e) {
            Log::error('Error sending WhatsApp notification: ' . $e->getMessage(), [
                'pemesanan_id' => $this->pemesanan->pemesanan_id,
                'trace' => $e->getTraceAsString()
            ]);
        }
    }

    /**
     * Buat template pesan dalam format invoice yang rapi
     */
    protected function buildInvoiceMessage(): string
    {
        $pelangganNama = $this->pemesanan->pelangganProfile->nama_lengkap 
            ?? $this->pemesanan->pelanggan->name
            ?? 'Tidak ada data';

        $telepon = $this->getTeleponPelanggan();
        $email = $this->pemesanan->pelanggan->email 
            ?? $this->pemesanan->email 
            ?? 'Tidak ada data';

        $homestayName = $this->pemesanan->kamar->homestay->nama_homestay 
            ?? $this->pemesanan->homestay->nama_homestay 
            ?? 'Tidak ada data';

        $kamarName = $this->pemesanan->kamar->nama_kamar ?? 'Tidak ada data';
        $jenisKamar = $this->pemesanan->kamar->jenisKamar->nama_jenis ?? 'Tidak ada data';

        // Hitung jumlah malam
        [$jumlahMalam, $warningTanggal] = $this->calculateJumlahMalam();

        // Format harga dan hitung total
        $hargaPerMalam = $this->pemesanan->kamar->harga ?? 0;
        $subtotal = max(0, $hargaPerMalam * $jumlahMalam * $this->pemesanan->jumlah_kamar);

        // Hanya gunakan biaya sistem saja (tidak ada potongan sistem)
        $biayaSistem = 4500;
        $totalHarga = max(0, $subtotal + $biayaSistem);

        // Format angka
        $hargaPerMalamFormatted = number_format($hargaPerMalam, 0, ',', '.');
        $subtotalFormatted = number_format($subtotal, 0, ',', '.');
        $biayaSistemFormatted = number_format($biayaSistem, 0, ',', '.');
        $totalHargaFormatted = number_format($totalHarga, 0, ',', '.');

        $catatan = $this->getCatatanKhusus();

        $message =
            "🆕 *PEMESANAN BARU DITERIMA* 🆕\n\n" .
            "📋 *INVOICE PEMESANAN*\n" .
            "No: #{$this->pemesanan->pemesanan_id}\n" .
            "Tanggal: " . now()->format('d M Y, H:i') . "\n\n" .

            "👤 *DATA PEMESAN*\n" .
            "Nama: {$pelangganNama}\n" .
            "Telepon: {$telepon}\n" .
            "Email: {$email}\n\n" .

            "🏠 *DETAIL HOMESTAY*\n" .
            "Homestay: {$homestayName}\n" .
            "Kamar: {$kamarName}\n" .
            "Tipe: {$jenisKamar}\n\n" .

            "📅 *PERIODE MENGINAP*\n" .
            "Check-in: " . $this->formatTanggal($this->pemesanan->tgl_check_in) . " (setelah 13:00)\n" .
            "Check-out: " . $this->formatTanggal($this->pemesanan->tgl_check_out) . " (sebelum 12:00)\n" .
            "Durasi: {$jumlahMalam} malam\n" .
            ($warningTanggal ? "⚠️ *Catatan:* {$warningTanggal}\n\n" : "\n") .

            "👥 *DETAIL TAMU*\n" .
            "Jumlah Kamar: {$this->pemesanan->jumlah_kamar} kamar\n" .
            "Total Tamu: {$this->pemesanan->jumlah_tamu} orang\n" .
            "Dewasa: " . ($this->pemesanan->jumlah_dewasa ?? '0') . " orang\n" .
            "Anak: " . ($this->pemesanan->jumlah_anak ?? '0') . " orang\n\n" .

            "💰 *RINCIAN BIAYA*\n" .
            "Harga/malam: Rp {$hargaPerMalamFormatted}\n" .
            "Subtotal ({$jumlahMalam} malam × {$this->pemesanan->jumlah_kamar} kamar): Rp {$subtotalFormatted}\n" .
            "Biaya Sistem: Rp {$biayaSistemFormatted}\n" .
            "────────────────\n" .
            "*TOTAL: Rp {$totalHargaFormatted}*\n\n" .

            "📝 *CATATAN KHUSUS*\n" .
            "{$catatan}\n\n" .

            "🔄 *STATUS PEMESANAN*\n" .
            "{$this->pemesanan->status}\n\n" .

            "📍 *INFORMASI*\n" .
            "Detail lengkap: tamansaritourism.id\n" .
            "Segera konfirmasi ketersediaan kamar!";

        return $message;
    }

    /**
     * Ambil nomor telepon pelanggan - VERSI DIPERBAIKI DENGAN LOGGING
     */
    protected function getTeleponPelanggan(): string
    {
        try {
            // Debug informasi
            Log::info('Mencari nomor telepon untuk pemesanan: ' . $this->pemesanan->pemesanan_id, [
                'pelanggan_id' => $this->pemesanan->pelanggan_id,
                'has_pelangganProfile' => !is_null($this->pemesanan->pelangganProfile),
                'has_pelanggan' => !is_null($this->pemesanan->pelanggan),
                'has_pelanggan_pelangganProfile' => $this->pemesanan->pelanggan && !is_null($this->pemesanan->pelanggan->pelangganProfile)
            ]);

            // Prioritas 1: Dari PelangganProfile melalui relasi yang sudah diperbaiki
            if ($this->pemesanan->pelangganProfile && !empty($this->pemesanan->pelangganProfile->nomor_telepon)) {
                $nomor = $this->pemesanan->pelangganProfile->nomor_telepon;
                Log::info('Nomor telepon ditemukan dari pelangganProfile langsung: ' . $nomor);
                return $nomor;
            }

            // Prioritas 2: Dari User -> PelangganProfile
            if ($this->pemesanan->pelanggan && 
                $this->pemesanan->pelanggan->pelangganProfile && 
                !empty($this->pemesanan->pelanggan->pelangganProfile->nomor_telepon)) {
                $nomor = $this->pemesanan->pelanggan->pelangganProfile->nomor_telepon;
                Log::info('Nomor telepon ditemukan dari User->pelangganProfile: ' . $nomor);
                return $nomor;
            }

            // Prioritas 3: Dari kolom phone di User
            if ($this->pemesanan->pelanggan && !empty($this->pemesanan->pelanggan->phone)) {
                $nomor = $this->pemesanan->pelanggan->phone;
                Log::info('Nomor telepon ditemukan dari User->phone: ' . $nomor);
                return $nomor;
            }

            // Prioritas 4: Dari kolom phone di Pemesanan (jika ada)
            if (!empty($this->pemesanan->phone)) {
                $nomor = $this->pemesanan->phone;
                Log::info('Nomor telepon ditemukan dari Pemesanan->phone: ' . $nomor);
                return $nomor;
            }

            Log::warning('Tidak ada nomor telepon yang ditemukan untuk pemesanan: ' . $this->pemesanan->pemesanan_id);
            return 'Tidak ada data';

        } catch (\Exception $e) {
            Log::error('Error dalam getTeleponPelanggan: ' . $e->getMessage());
            return 'Error mengambil data';
        }
    }

    /**
     * Ambil catatan khusus
     */
    protected function getCatatanKhusus(): string
    {
        if (!empty($this->pemesanan->catatan)) return $this->pemesanan->catatan;
        if (!empty($this->pemesanan->special_requests)) return $this->pemesanan->special_requests;
        if (!empty($this->pemesanan->permintaan_khusus)) return $this->pemesanan->permintaan_khusus;
        return 'Tidak ada catatan khusus';
    }

    /**
     * Hitung jumlah malam dengan validasi tanggal
     */
    protected function calculateJumlahMalam(): array
    {
        try {
            $checkIn = \Carbon\Carbon::parse($this->pemesanan->tgl_check_in);
            $checkOut = \Carbon\Carbon::parse($this->pemesanan->tgl_check_out);

            $jumlahMalam = abs($checkOut->diffInDays($checkIn));
            $jumlahMalam = max(1, $jumlahMalam);

            $warning = null;
            if ($checkOut->lessThan($checkIn)) {
                $warning = "Tanggal check-out lebih awal dari check-in. Data otomatis disesuaikan.";
            }

            return [$jumlahMalam, $warning];
        } catch (\Exception $e) {
            Log::error('Error calculating jumlah malam: ' . $e->getMessage());
            return [1, "Tanggal tidak valid, diset default 1 malam"];
        }
    }

    /**
     * Format tanggal menjadi lebih readable
     */
    protected function formatTanggal($date): string
    {
        try {
            return \Carbon\Carbon::parse($date)->format('d M Y');
        } catch (\Exception $e) {
            Log::error('Error formatting tanggal: ' . $e->getMessage());
            return $date ?? 'Tanggal tidak valid';
        }
    }
}