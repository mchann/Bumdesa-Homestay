<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Homestay extends Model
{
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
     * Relasi ke tabel users (jika ingin akses data user pemilik)
     * Homestay.pemilik_id -> User.id
     */
    public function pemilik(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pemilik_id');
    }

    public function kamar(): HasMany
    {
        return $this->hasMany(Kamar::class, 'homestay_id', 'homestay_id');
    }

    public function fasilitas(): BelongsToMany
    {
        return $this->belongsToMany(Fasilitas::class, 'kamar_fasilitas', 'kamar_id', 'fasilitas_id')
                    ->join('kamar', 'kamar_fasilitas.kamar_id', '=', 'kamar.kamar_id')
                    ->where('kamar.homestay_id', '=', $this->homestay_id);
    }

    public function peraturan(): BelongsToMany
    {
        return $this->belongsToMany(Peraturan::class, 'homestay_peraturan', 'homestay_id', 'peraturan_id');
    }

    public function jenisKamar(): BelongsTo
    {
        return $this->belongsTo(JenisKamar::class);
    }

    public function pemesanan(): HasMany
    {
        return $this->hasMany(Pemesanan::class);
    }
}