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
    ['email' => 'maskikit@gmail.com'], // kondisi
    [
        'name' => 'Admin Bumdes',
        'password' => Hash::make('12345678'),
        'role' => 'admin',
    ]
);

    }
}
