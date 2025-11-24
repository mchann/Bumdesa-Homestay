<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Kamar;
use App\Models\Homestay;
use App\Models\JenisKamar;

class KamarFactory extends Factory
{
    protected $model = Kamar::class;

    public function definition()
    {
        return [
            'homestay_id' => Homestay::factory(),
            'jenis_kamar_id' => JenisKamar::factory(),
            'nama_kamar' => $this->faker->word() . ' Room',
            'kapasitas' => '2 Orang',
            'harga' => $this->faker->numberBetween(100000, 500000),
            'foto_kamar' => 'default.jpg',
        ];
    }
}