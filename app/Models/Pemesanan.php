<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;
      protected $table = 'pemesanan';  
    
    protected $primaryKey = 'pemesanan_id';
   protected $fillable = [
    'pelanggan_id',
    'tgl_check_in',
    'tgl_check_out',
    'jumlah_tamu',
    'jumlah_kamar',
    'catatan',
    'kamar_id',
];


    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'kamar_id')->with('homestay');;
    }

public function pelanggan()
{
    return $this->belongsTo(User::class, 'pelanggan_id');
}

}