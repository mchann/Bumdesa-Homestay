<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peraturan extends Model
{
    use HasFactory;

    protected $table = 'peraturan';
    protected $primaryKey = 'peraturan_id';
    protected $fillable = ['isi_peraturan'];

    public $timestamps = true;


    public function homestays()
{
    return $this->belongsToMany(Homestay::class, 'homestay_peraturan', 'peraturan_id', 'homestay_id');
}

}


