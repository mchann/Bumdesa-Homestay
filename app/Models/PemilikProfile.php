<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemilikProfile extends Model
{
    use HasFactory;

    protected $primaryKey = 'pemilik_id';

    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'alamat',
        'nomor_telepon',
        
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function homestays()
    {
        return $this->hasMany(Homestay::class, 'pemilik_id', 'pemilik_id');
    }
}
