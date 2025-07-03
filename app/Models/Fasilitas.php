<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fasilitas extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'fasilitas_id';
    protected $fillable = ['nama_fasilitas'];

    public function kamar()
    {
        return $this->belongsToMany(Kamar::class, 'kamar_fasilitas', 'fasilitas_id', 'kamar_id');
    }
}

