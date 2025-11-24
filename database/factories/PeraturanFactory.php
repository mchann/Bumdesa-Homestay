<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PeraturanFactory extends Factory
{
    public function definition(): array
    {
        return [
            'isi_peraturan' => $this->faker->sentence(8),
        ];
    }
}