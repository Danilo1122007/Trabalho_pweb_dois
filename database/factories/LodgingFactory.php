<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Animals;

class LodgingFactory extends Factory
{
    public function definition(): array
    {
        return [
            'animal_id' => Animals::factory(),
            'dia_entrada' => $this->faker->date(),
            'dia_saida' => $this->faker->date(),
        ];
    }
}