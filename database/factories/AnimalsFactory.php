<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AnimalsFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nome_animal' => $this->faker->firstName(),
            'nome_tutor' => $this->faker->name(),
            'raca' => $this->faker->word(),
            'peso' => $this->faker->numberBetween(1, 50),
            'telefone_tutor' => $this->faker->phoneNumber(),
            'foto' => null
        ];
    }
}