<?php

namespace App\Models;
use HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminProfile extends Model
{
    public function user()
{
    return $this->belongsTo(User::class);
}
    protected $primaryKey = 'admin_id';
    // Menambahkan kolom yang bisa diisi secara massal
    protected $fillable = [
        'nama_lengkap',
        'nomor_telepon',
        'alamat',
        // tambahkan kolom lain yang diperlukan
    ];

}
