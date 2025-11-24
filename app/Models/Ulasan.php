<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ulasan extends Model
{
    use HasFactory;

    protected $table = 'ulasan';
    protected $primaryKey = 'ulasan_id';

    protected $fillable = [
        'pemesanan_id',
        'homestay_id',
        'pelanggan_id',
        'rating',
        'komentar',
        'balasan_admin',
        'balasan_pemilik',
        'disembunyikan',
    ];

    /**
     * Relasi ke Pemesanan
     */
    public function pemesanan(): BelongsTo
    {
        return $this->belongsTo(Pemesanan::class, 'pemesanan_id', 'pemesanan_id');
    }

    /**
     * Relasi ke Homestay
     */
    public function homestay(): BelongsTo
    {
        return $this->belongsTo(Homestay::class, 'homestay_id', 'homestay_id');
    }

    /**
     * Relasi ke Pelanggan (User)
     */
    public function pelanggan(): BelongsTo
    {
        // Asumsi model User ada di namespace App\Models
        return $this->belongsTo(\App\Models\User::class, 'pelanggan_id', 'id');
    }
}