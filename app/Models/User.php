<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // 🔗 Relasi ke profil masing-masing
    public function adminProfile()
    {
        return $this->hasOne(AdminProfile::class);
    }

    public function pemilikProfile()
    {
        return $this->hasOne(PemilikProfile::class,'user_id');
    }

    public function pelangganProfile()
    {
        return $this->hasOne(PelangganProfile::class, 'user_id');
    }


    public function homestays()
{
    return $this->hasMany(Homestay::class, 'pemilik_id');
}


}