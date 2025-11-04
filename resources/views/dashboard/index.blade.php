@extends('layouts')
@section('titulo', 'Dashboard')

@section('conteudo')
<h2>Dashboard</h2>
<div class="row mb-4">
  <div class="col-md-3"><div class="card p-3 bg-light"><b>Produtos:</b> {{ $totProducts }}</div></div>
  <div class="col-md-3"><div class="card p-3 bg-light"><b>Serviços:</b> {{ $totServices }}</div></div>
  <div class="col-md-3"><div class="card p-3 bg-light"><b>Esgotados:</b> {{ $noStock }}</div></div>
  <div class="col-md-3"><div class="card p-3 bg-light"><b>Vendas:</b> {{ $sales }}</div></div>
</div>

<h4>Vendas dos Últimos 7 Dias</h4>
<canvas id="salesChart" height="100"></canvas>

<script>
const ctx1 = document.getElementById('salesChart');
new Chart(ctx1, {
  type: 'line',
  data: {
    labels: {!! json_encode($salesPerDay->pluck('date')) !!},
    datasets: [{
      label: 'Vendas',
      data: {!! json_encode($salesPerDay->pluck('total')) !!},
      borderColor: 'blue',
      borderWidth: 2,
      fill: false
    }]
  },
  options: { scales: { y: { beginAtZero: true } } }
});
</script>
@endsection
