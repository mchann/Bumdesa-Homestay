<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomClose extends Model
{
    use HasFactory;

    protected $table = 'room_closes';

    protected $fillable = [
        'kamar_id',
        'start_date',
        'end_date',
        'alasan',
    ];

    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'kamar_id', 'kamar_id');
    }


}
