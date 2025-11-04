<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VehicleType;

class VehicleTypeSeeder extends Seeder
{
    public function run(): void
    {
        $tipos = [
            ['nome' => 'Ambulância', 'descricao' => 'Veículo de emergência'],
            ['nome' => 'Bicicleta', 'descricao' => 'Bicicleta/Elétrica leve'],
            ['nome' => 'Caminhão', 'descricao' => 'Caminhão médio'],
            ['nome' => 'Caminhão Pesado', 'descricao' => 'Caminhão pesado'],
            ['nome' => 'Caminhonete', 'descricao' => 'Picape / caminhonete'],
            ['nome' => 'Carro', 'descricao' => 'Carro de passeio'],
            ['nome' => 'Conversível', 'descricao' => 'Carro conversível'],
            ['nome' => 'Motocicleta', 'descricao' => 'Moto/ Scooter'],
            ['nome' => 'Outro', 'descricao' => 'Outro tipo'],
            ['nome' => 'Quadriciclo', 'descricao' => 'Quadriciclo'],
            ['nome' => 'Reboque', 'descricao' => 'Reboque/ Trailer'],
            ['nome' => 'Trator', 'descricao' => 'Trator agrícola'],
            ['nome' => 'Utilitário', 'descricao' => 'Veículo utilitário leve'],
            ['nome' => 'Van', 'descricao' => 'Van pequena'],
            ['nome' => 'Veículo Oficial', 'descricao' => 'Veículo oficial/serviço'],
            ['nome' => 'Ônibus', 'descricao' => 'Ônibus/ Micro-ônibus'],
        ];

        foreach ($tipos as $t) {
            VehicleType::firstOrCreate(['nome' => $t['nome']], $t);
        }
    }
}
