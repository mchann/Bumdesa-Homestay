<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Homestay extends Model
{
    use HasFactory; // ✅ Wajib agar bisa pakai factory()

    protected $primaryKey = 'homestay_id';

    protected $fillable = [
        'nama_homestay',
        'alamat_homestay',
        'deskripsi',
        'foto_homestay',
        'link_google_maps',
        'pemilik_id',
    ];

    /**
     * Relasi ke tabel pemilik_profiles
     * Homestay.pemilik_id -> PemilikProfile.pemilik_id
     */
    public function pemilikProfile(): BelongsTo
    {
        return $this->belongsTo(PemilikProfile::class, 'pemilik_id', 'pemilik_id');
    }

    /**
     * Relasi ke tabel users (akses user pemilik homestay)
     * PemilikProfile.user_id -> User.id
     */
    public function pemilik(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pemilik_id', 'id');
    }

    /**
     * Relasi ke tabel kamar
     */
    public function kamar(): HasMany
    {
        return $this->hasMany(Kamar::class, 'homestay_id', 'homestay_id');
    }

    /**
     * Relasi ke tabel fasilitas melalui kamar_fasilitas
     * (Setiap homestay punya banyak fasilitas lewat kamar)
     */
    public function fasilitas(): BelongsToMany
    {
        return $this->belongsToMany(Fasilitas::class, 'kamar_fasilitas', 'kamar_id', 'fasilitas_id')
                    ->join('kamar', 'kamar_fasilitas.kamar_id', '=', 'kamar.kamar_id')
                    ->where('kamar.homestay_id', '=', $this->homestay_id);
    }

    /**
     * Relasi ke tabel peraturan (melalui pivot homestay_peraturan)
     */
    public function peraturan(): BelongsToMany
    {
        return $this->belongsToMany(Peraturan::class, 'homestay_peraturan', 'homestay_id', 'peraturan_id');
    }

    /**
     * Relasi ke tabel jenis_kamar (opsional)
     */
    public function jenisKamar(): BelongsTo
    {
        return $this->belongsTo(JenisKamar::class, 'jenis_kamar_id', 'jenis_kamar_id');
    }

    /**
     * Relasi ke tabel pemesanan
     */
    public function pemesanan(): HasMany
    {
        return $this->hasMany(Pemesanan::class, 'homestay_id', 'homestay_id');
    }

    /**
     * Relasi ke tabel ulasan
     */
    public function ulasans(): HasMany
    {
        return $this->hasMany(Ulasan::class, 'homestay_id', 'homestay_id');
    }

    /**
     * Accessor: Hitung rata-rata rating dari ulasan yang tidak disembunyikan
     */
    public function getRatingRataRataAttribute(): float
    {
        return (float) ($this->ulasans()
                            ->where('disembunyikan', false)
                            ->avg('rating') ?? 0);
    }

    /**
     * Accessor: Hitung jumlah ulasan yang ditampilkan
     */
    public function getJumlahUlasanAttribute(): int
    {
        return $this->ulasans()
                    ->where('disembunyikan', false)
                    ->count();
    }
}
