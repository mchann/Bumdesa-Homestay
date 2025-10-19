<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kamar; // Import jika relasi ke Kamar

class JenisKamar extends Model
{
    use HasFactory;

    protected $table = 'jenis_kamar';
    protected $primaryKey = 'jenis_kamar_id';

    protected $fillable = [
        'nama_jenis', // HANYA ini, primary key tidak perlu di fillable
    ];

    // Relasi ke Kamar (asumsi one-to-many: satu jenis kamar punya banyak kamar)
    public function kamar() // Ubah nama method ke lowercase untuk konvensi
    {
        return $this->hasMany(Kamar::class);
    }

    // HAPUS: public function jenisKamar() { ... } – ini salah (self-reference)
}