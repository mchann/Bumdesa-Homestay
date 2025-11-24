<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Homestay;
use App\Models\PemilikProfile;

class HomestayFactory extends Factory
{
    protected $model = Homestay::class;

    public function definition(): array
    {
        return [
            'pemilik_id' => PemilikProfile::factory(),
            'nama_homestay' => $this->faker->company(),
            'alamat_homestay' => $this->faker->address(),
            'deskripsi' => $this->faker->paragraph(),
            'foto_homestay' => 'default.jpg',
            'link_google_maps' => $this->faker->url(),
        ];
    }
}
