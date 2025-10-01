<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class ParkingFactory extends Factory
{
    public function definition(): array
    {
        return [
            'modelo' => $this->faker->name,
            'motorista' => $this->faker->name,
            'hora_entrada' => $this->faker->time(),
            'hora_saida' => $this->faker->time(),
        ];
    }
}
