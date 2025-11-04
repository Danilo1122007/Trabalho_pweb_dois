<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class GroomingFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nome_animal' => $this->faker->name,
            'raca' => $this->faker->randomElement([
                'Poodle', 'Bulldog', 'Labrador', 'Schnauzer', 'Beagle',
                'Vira-lata', 'Persa', 'Siamês', 'Golden Retriever', 'Chihuahua'
            ]),
            'horario_atendimento' => $this->faker->time(),
            'telefone_tutor' => $this->faker->phoneNumber(),
        ];
    }
}
