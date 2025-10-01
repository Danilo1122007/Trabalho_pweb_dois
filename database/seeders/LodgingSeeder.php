<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lodging;

class LodgingSeeder extends Seeder
{
    public function run(): void
    {
        Lodging::factory()->count(3)->create();
    }
}
