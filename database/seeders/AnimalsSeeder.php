<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Animals;

class AnimalsSeeder extends Seeder
{
    public function run(): void
    {
        Animals::factory()->count(5)->create();
    }
}
