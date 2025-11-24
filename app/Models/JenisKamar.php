<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kamar; 

class JenisKamar extends Model
{
    use HasFactory;

    protected $table = 'jenis_kamar';
    protected $primaryKey = 'jenis_kamar_id';

    protected $fillable = [
        'nama_jenis', 
    ];

    // Relasi ke Kamar (asumsi one-to-many: satu jenis kamar punya banyak kamar)
    public function kamar() 
    {
        return $this->hasMany(Kamar::class);
    }

}