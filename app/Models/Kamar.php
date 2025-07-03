<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;

    protected $table = 'kamar';
    protected $primaryKey = 'kamar_id';
    protected $fillable = [
        'homestay_id',
        'jenis_kamar_id',
        'nama_kamar',
        'kapasitas',
        'harga',
        'foto_kamar'
    ];

    public function homestay()
    {
        return $this->belongsTo(Homestay::class, 'homestay_id', 'homestay_id');
    }
    public function fasilitas()
{
    return $this->belongsToMany(Fasilitas::class, 'kamar_fasilitas', 'kamar_id', 'fasilitas_id');
}

public function jenisKamar()
{
    return $this->belongsTo(JenisKamar::class, 'jenis_kamar_id', 'jenis_kamar_id');
}


// relasi ketbel pemesanan
public function pemesanan()
{
    return $this->hasMany(Pemesanan::class,'kamar_id');
}


}