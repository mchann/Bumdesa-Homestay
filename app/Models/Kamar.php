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

    // Relasi ke Homestay
    public function homestay()
    {
        return $this->belongsTo(Homestay::class, 'homestay_id', 'homestay_id');
    }

    // Relasi ke Fasilitas (Many-to-Many)
    public function fasilitas()
    {
        return $this->belongsToMany(Fasilitas::class, 'kamar_fasilitas', 'kamar_id', 'fasilitas_id');
    }

    // Relasi ke Jenis Kamar
    public function jenisKamar()
    {
        return $this->belongsTo(JenisKamar::class, 'jenis_kamar_id', 'jenis_kamar_id');
    }

    // Relasi ke Pemesanan
    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class, 'kamar_id');
    }

    // Relasi ke Penutupan Kamar (semua penutupan)
    public function roomClose()
    {
        return $this->hasMany(RoomClose::class, 'kamar_id', 'kamar_id');
    }

    // Relasi ke Penutupan Terbaru (untuk ditampilkan di daftar kamar)
    public function penutupanTerbaru()
    {
        return $this->hasOne(RoomClose::class, 'kamar_id', 'kamar_id')->latestOfMany();
    }
}
