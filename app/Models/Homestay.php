<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function pemilikProfile(): BelongsTo
    {
        return $this->belongsTo(PemilikProfile::class, 'pemilik_id','id');
    }

    // Homestay.php
public function pemilik()
{
    return $this->belongsTo(User::class, 'pemilik_id');
}
public function kamar()
{
    return $this->hasMany(Kamar::class, 'homestay_id', 'homestay_id');
}
public function fasilitas()
{
    return $this->belongsToMany(Fasilitas::class, 'kamar_fasilitas', 'kamar_id', 'fasilitas_id')
                ->join('kamar', 'kamar_fasilitas.kamar_id', '=', 'kamar.kamar_id')
                ->where('kamar.homestay_id', '=', $this->homestay_id);
}

public function peraturan()
{
    return $this->belongsToMany(Peraturan::class, 'homestay_peraturan', 'homestay_id', 'peraturan_id');
    
}

public function jenisKamar()
{
    return $this->belongsTo(JenisKamar::class);
}

public function pemesanan()
{
    return $this->hasMany(Pemesanan::class);
}

}