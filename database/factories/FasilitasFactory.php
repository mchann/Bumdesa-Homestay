<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Fasilitas;

class FasilitasFactory extends Factory
{
    protected $model = Fasilitas::class;

    public function definition()
    {
        return [
            'nama_fasilitas' => $this->faker->unique()->words(2, true),
        ];
    }
}