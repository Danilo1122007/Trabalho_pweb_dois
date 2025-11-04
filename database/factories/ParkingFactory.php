<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\VehicleType;

class ParkingFactory extends Factory
{
    public function definition(): array
    {
        return [
            'modelo' => $this->faker->name,
            'motorista' => $this->faker->name,
            'vehicle_type_id' => (VehicleType::All()->random())->id,
            'hora_entrada' => $this->faker->time(),
            'hora_saida' => $this->faker->time(),
        ];
    }
}