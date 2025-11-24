<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Pemesanan extends Model
{
    use HasFactory;

    protected $table = 'pemesanan';  
    protected $primaryKey = 'pemesanan_id';

    protected $fillable = [
        'pelanggan_id',
        'kamar_id',
        'homestay_id',
        'tgl_check_in',
        'tgl_check_out',
        'jumlah_tamu',
        'jumlah_kamar',
        'catatan',
        'total_harga',
        'status',
    ];

    // Relasi ke kamar
    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'kamar_id');
    }

    // Relasi ke pelanggan (user)
    public function pelanggan()
    {
        return $this->belongsTo(User::class, 'pelanggan_id');
    }

    // PERBAIKAN: Relasi ke homestay - tambahkan parameter ketiga untuk primary key homestay
    public function homestay()
    {
        return $this->belongsTo(Homestay::class, 'homestay_id', 'homestay_id');
    }

    // Relasi ke PelangganProfile melalui pelanggan_id
    public function pelangganProfile()
    {
        return $this->belongsTo(PelangganProfile::class, 'pelanggan_id', 'user_id');
    }

    /**
     * ==============================================
     * ACCESSOR UNTUK BIAYA TAMBAHAN
     * ==============================================
     */

    /**
     * Accessor untuk biaya tambahan sistem
     * @return int
     */
    public function getBiayaTambahanAttribute()
    {
        return 4500; // Biaya sistem tetap Rp 4.500
    }

    /**
     * Accessor untuk total akhir (total_harga + biaya_tambahan)
     * @return float
     */
    public function getTotalAkhirAttribute()
    {
        return $this->total_harga + $this->biaya_tambahan;
    }

    /**
     * Accessor untuk format biaya tambahan (dengan titik)
     * @return string
     */
    public function getBiayaTambahanFormattedAttribute()
    {
        return number_format($this->biaya_tambahan, 0, ',', '.');
    }

    /**
     * Accessor untuk format total akhir (dengan titik)
     * @return string
     */
    public function getTotalAkhirFormattedAttribute()
    {
        return number_format($this->total_akhir, 0, ',', '.');
    }

    /**
     * Accessor untuk format total harga (dengan titik)
     * @return string
     */
    public function getTotalHargaFormattedAttribute()
    {
        return number_format($this->total_harga, 0, ',', '.');
    }

    /**
     * Accessor untuk lama menginap
     * @return int
     */
    public function getLamaMenginapAttribute()
    {
        return \Carbon\Carbon::parse($this->tgl_check_in)
            ->diffInDays($this->tgl_check_out);
    }

    /**
     * Accessor untuk nomor invoice
     * @return string
     */
    public function getInvoiceNumberAttribute()
    {
        return 'INV-' . str_pad($this->pemesanan_id, 6, '0', STR_PAD_LEFT);
    }

    /**
     * Accessor untuk status label (lebih user friendly)
     * @return string
     */
    public function getStatusLabelAttribute()
    {
        $statusLabels = [
            'pending' => 'Menunggu Pembayaran',
            'menunggu_konfirmasi' => 'Menunggu Konfirmasi',
            'berhasil' => 'Berhasil',
            'gagal' => 'Gagal',
            'selesai' => 'Selesai'
        ];

        return $statusLabels[$this->status] ?? $this->status;
    }

    /**
     * Accessor untuk warna badge status
     * @return string
     */
    public function getStatusBadgeClassAttribute()
    {
        $statusClasses = [
            'pending' => 'warning',
            'menunggu_konfirmasi' => 'info',
            'berhasil' => 'success',
            'gagal' => 'danger',
            'selesai' => 'primary'
        ];

        return $statusClasses[$this->status] ?? 'secondary';
    }

    /**
     * Scope untuk pemesanan aktif (belum selesai atau dibatalkan)
     */
    public function scopeAktif($query)
    {
        return $query->whereNotIn('status', ['selesai', 'gagal']);
    }

    /**
     * Scope untuk pemesanan pending
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope untuk pemesanan yang perlu dikonfirmasi
     */
    public function scopeMenungguKonfirmasi($query)
    {
        return $query->where('status', 'menunggu_konfirmasi');
    }

    /**
     * Scope untuk pemesanan berhasil
     */
    public function scopeBerhasil($query)
    {
        return $query->where('status', 'berhasil');
    }

    /**
     * Cek apakah pemesanan bisa dibatalkan
     * @return bool
     */
    public function getBisaDibatalkanAttribute()
    {
        return $this->status === 'pending';
    }

    /**
     * Cek apakah pemesanan sudah kadaluarsa
     * @return bool
     */
    public function getSudahKadaluarsaAttribute()
    {
        if (!$this->batas_pembayaran || $this->status !== 'pending') {
            return false;
        }

        return now()->gt($this->batas_pembayaran);
    }

    // Relasi baru ke Ulasan
    public function ulasan()
    {
        return $this->hasOne(Ulasan::class, 'pemesanan_id', 'pemesanan_id');
    }

    /**
     * Accessor untuk mengecek apakah pelanggan bisa memberi ulasan.
     * Kriteria:
     * 1. Status harus 'berhasil' ATAU 'selesai'.
     * 2. Waktu check-out (ditetapkan pukul 11:00 AM) sudah terlampaui.
     * 3. Belum ada ulasan untuk pemesanan ini.
     * @return bool
     */
    public function getBisaBeriUlasanAttribute()
    {
        $statusValid = in_array($this->status, ['berhasil', 'selesai']);

        // Mengambil tanggal check-out dari DB dan mengatur waktunya menjadi 11:00:00
        $waktuCheckOutBatas = Carbon::parse($this->tgl_check_out)->setTime(11, 0, 0);

        // Membandingkan waktu check-out batas dengan waktu real-time (Carbon::now())
        $sudahCheckOut = Carbon::now()->greaterThanOrEqualTo($waktuCheckOutBatas); 

        $belumDiulas = is_null($this->ulasan);

        return $statusValid && $sudahCheckOut && $belumDiulas;
    }
}
