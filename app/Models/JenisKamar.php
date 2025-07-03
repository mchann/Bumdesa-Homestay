<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisKamar extends Model
{
    protected $table = 'jenis_kamar';
    protected $primaryKey = 'jenis_kamar_id';
   protected $fillable = [
    'nama_jenis',
    'jenis_kamar_id',

];
public function Kamar()
{
    return $this->hasMany(Kamar::class);
}
public function jenisKamar()
{
    return $this->hasMany(JenisKamar::class);
}
}
