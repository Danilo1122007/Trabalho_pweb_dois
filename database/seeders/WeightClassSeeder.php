<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\WeightClass;

class WeightClassSeeder extends Seeder {
    public function run(): void {
        $classes = [
            ['nome'=>'Muito Leve','descricao'=>'até ~300 kg'],
            ['nome'=>'Leve','descricao'=>'~301 kg a 1000 kg'],
            ['nome'=>'Moderado','descricao'=>'~1001 kg a 3000 kg'],
            ['nome'=>'Pesado','descricao'=>'~3001 kg a 10000 kg'],
            ['nome'=>'Extra Pesado','descricao'=>'acima de 10000 kg'],
        ];

        foreach ($classes as $c) {
            WeightClass::firstOrCreate(['nome'=>$c['nome']], $c);
        }
    }
}
