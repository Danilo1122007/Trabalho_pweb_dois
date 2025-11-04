@extends('layouts')
@section('titulo', 'Meus Pedidos')

@section('conteudo')
<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Histórico de Pedidos</h2>

    {{-- 🔹 Botão gerar PDF de todos os pedidos --}}
    <a href="{{ route('orders.report') }}" class="btn btn-outline-primary">
      📄 Gerar Relatório
    </a>
  </div>

  <div class="table-responsive">
    <table class="table table-striped table-bordered align-middle text-center">
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>Data</th>
          <th>Total</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        @forelse($orders as $o)
          <tr>
            <td>#{{ $o->id }}</td>
            <td>{{ date('d/m/Y H:i', strtotime($o->order_date)) }}</td>
            <td>R$ {{ number_format($o->total_price, 2, ',', '.') }}</td>
            <td>
              <a href="{{ route('orders.show', $o->id) }}" class="btn btn-primary btn-sm">
                Ver Detalhes
              </a>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="4" class="text-center text-muted">
              Nenhum pedido encontrado.
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
