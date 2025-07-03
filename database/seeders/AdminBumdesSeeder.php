<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminBumdesSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@bumdes.com'], // Cek dulu biar gak dobel
            [
                'name' => 'Admin Bumdes',
                'email' => 'maskikit@gmail.com',
                'password' => Hash::make('12345678'), // Ganti nanti di real project
                'role' => 'admin', // Sesuai yang lo pakai
            ]
        );
    }
}
