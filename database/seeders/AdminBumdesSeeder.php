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
    ['email' => 'bumdesaijen@gmail.com'], // kondisi
    [
        'name' => 'Admin Bumdes',
        'password' => Hash::make('#Tamansari25pw'),
        'role' => 'admin',
    ]
);

    }
}
