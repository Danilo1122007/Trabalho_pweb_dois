@extends('layouts')
@section('titulo', 'Detalhes do Pedido')

@section('conteudo')
<div class="container mt-4">
  <h2 class="mb-3">📦 Detalhes do Pedido #{{ $order->id }}</h2>

  <div class="mb-3">
    <p><strong>Data:</strong> {{ date('d/m/Y H:i', strtotime($order->order_date)) }}</p>
    <p><strong>Total:</strong> R$ {{ number_format($order->total_price, 2, ',', '.') }}</p>
  </div>

  <div class="table-responsive">
    <table class="table table-bordered align-middle text-center">
      <thead class="table-dark">
        <tr>
          <th style="width: 12%">Imagem</th>
          <th style="width: 25%">Nome</th>
          <th style="width: 10%">Tipo</th>
          <th style="width: 10%">Qtd</th>
          <th style="width: 12%">Preço</th>
          <th style="width: 12%">Subtotal</th>
        </tr>
      </thead>

      <tbody>
        @foreach($order->items as $item)
          @php $isService = $item->product->type === 'servico'; @endphp

          <tr>
            <td rowspan="2" class="align-middle">
              @if($item->product->imagem)
                <img src="{{ asset('storage/' . $item->product->imagem) }}"
                     width="100" height="100"
                     class="rounded border shadow-sm object-fit-cover"
                     alt="{{ $item->product->name }}">
              @else
                <span class="text-muted">Sem imagem</span>
              @endif
            </td>

            <td class="fw-bold align-middle">{{ $item->product->name }}</td>

            <td class="align-middle">
              <span class="badge {{ $isService ? 'bg-info' : 'bg-success' }}">
                {{ ucfirst($item->product->type) }}
              </span>
            </td>

            <td class="align-middle">
              @if($isService)
                <span class="text-muted">—</span>
              @else
                {{ $item->quantity }}
              @endif
            </td>

            <td class="align-middle">
              R$ {{ number_format($item->price, 2, ',', '.') }}
            </td>

            <td class="align-middle">
              R$ {{ number_format($item->price * ($isService ? 1 : $item->quantity), 2, ',', '.') }}
            </td>
          </tr>

          <tr>
            <td colspan="5" class="text-start bg-light">
              <strong>Descrição:</strong>
              <p class="mb-0">{{ $item->product->description ?? 'Sem descrição disponível.' }}</p>

              @if($isService && ($item->product->service_date ?? false))
                <p class="mb-0"><strong>Data do serviço:</strong> {{ date('d/m/Y', strtotime($item->product->service_date)) }}</p>
              @endif

              @if($isService && ($item->product->service_time ?? false))
                <p class="mb-0"><strong>Horário:</strong> {{ $item->product->service_time }}</p>
              @endif
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <div class="mt-4">
    <a href="{{ route('orders.index') }}" class="btn btn-secondary">← Voltar para Pedidos</a>
  </div>
</div>
@endsection
