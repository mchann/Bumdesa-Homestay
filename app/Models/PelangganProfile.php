<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelangganProfile extends Model
{
    use HasFactory;

    protected $table = 'pelanggan_profiles'; 
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'nomor_telepon',
        'kewarganegaraan',
        'jenis_kelamin',
        'tgl_lahir',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
