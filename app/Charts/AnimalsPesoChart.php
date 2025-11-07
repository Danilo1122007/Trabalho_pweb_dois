<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Animals;

class AnimalsPesoChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build()
    {
        $leve = Animals::where('peso', '<', 10)->count();
        $medio = Animals::whereBetween('peso', [10, 30])->count();
        $pesado = Animals::where('peso', '>', 30)->count();

        return $this->chart->pieChart()
            ->setTitle('Distribuição de Animais por Faixa de Peso')
            ->setSubtitle('Quantidade de animais cadastrados')
            ->addData([$leve, $medio, $pesado])
            ->setLabels(['Leve (<10kg)', 'Médio (10-30kg)', 'Pesado (>30kg)'])
            ->setColors(['#FF6384', '#36A2EB', '#FFCE56']);
    }
}