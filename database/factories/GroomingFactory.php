<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class GroomingFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nome_animal' => $this->faker->name,
            'raca' => $this->faker->name,
            'horario_atendimento' => $this->faker->time(),
            'telefone_tutor' => $this->faker->phoneNumber(),
        ];
    }
}
