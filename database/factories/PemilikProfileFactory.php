<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PemilikProfile;
use App\Models\User;

class PemilikProfileFactory extends Factory
{
    protected $model = PemilikProfile::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'nama_lengkap' => $this->faker->name(),
            'alamat' => $this->faker->address(),
            'nomor_telepon' => $this->faker->phoneNumber(),
        ];
    }
}
