<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class LodgingFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nome' => $this->faker->name,
            'nome_animal' => $this->faker->name,
            'dia_entrada' => $this->faker->date(),
            'dia_saida' => $this->faker->date(),
        ];
    }
}
