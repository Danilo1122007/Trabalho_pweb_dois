<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            VehicleTypeSeeder::class,
            WeightClassSeeder::class,
            GroomingSeeder::class,
            LodgingSeeder::class,
            ParkingSeeder::class,
        ]);
    }
}