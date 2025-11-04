<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
Product::insert([
    [
        'name' => 'Ração Premium para Cães',
        'description' => 'Ração de alta qualidade para cães adultos.',
        'price' => 149.90,
        'quantity' => 50, // <-- aqui trocou stock por quantity
        'type' => 'produto',
        'launch_date' => now(),
    ],
    [
        'name' => 'Brinquedo de Borracha',
        'description' => 'Brinquedo resistente e seguro para seu pet.',
        'price' => 29.90,
        'quantity' => 200,
        'type' => 'produto',
        'launch_date' => now(),
    ],
    [
        'name' => 'Coleira Ajustável',
        'description' => 'Coleira confortável e durável.',
        'price' => 39.90,
        'quantity' => 100,
        'type' => 'produto',
        'launch_date' => now(),
    ],
]);

    }
}
