<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Grooming;

class GroomingSeeder extends Seeder
{
    public function run(): void
    {
        Grooming::factory()->count(3)->create();
    }
}
