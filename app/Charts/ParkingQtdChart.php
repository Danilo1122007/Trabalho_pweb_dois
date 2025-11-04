<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Parking;

class ParkingQtdChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build()
{
    $dados = Parking::with('vehicleType')
        ->selectRaw('vehicle_type_id, COUNT(*) as total')
        ->groupBy('vehicle_type_id')
        ->get();

    // Obtém os nomes dos tipos de veículo
    $labels = $dados->map(fn($item) => $item->vehicleType->nome ?? 'Desconhecido')->toArray();
    $values = $dados->pluck('total')->toArray();

    return $this->chart->barChart()
        ->setTitle('Quantidade de Veículos por Tipo')
        ->addData('Veículos', $values)
        ->setXAxis($labels);
}
}
