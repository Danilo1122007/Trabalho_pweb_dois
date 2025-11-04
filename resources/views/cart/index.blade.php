@extends('layouts')
@section('titulo', 'Carrinho')

@section('conteudo')
<div class="container mt-4">
  <h2 class="mb-4 text-center">🛒 Seu Carrinho</h2>

  @if($carts->isEmpty())
    <div class="alert alert-info text-center">
      Seu carrinho está vazio.
    </div>
  @else
    <div class="table-responsive">
      <table class="table table-striped table-bordered align-middle text-center">
        <thead class="table-dark">
          <tr>
            <th style="width: 12%">Imagem</th>
            <th style="width: 25%">Nome</th>
            <th style="width: 10%">Tipo</th>
            <th style="width: 10%">Qtd</th>
            <th style="width: 12%">Preço</th>
            <th style="width: 12%">Total</th>
            <th style="width: 19%">Ações</th>
          </tr>
        </thead>
        <tbody>
          @php $total = 0; @endphp
          @foreach($carts as $c)
            @php 
              $isService = $c->product->type === 'servico';
              $subtotal = $c->product->price * $c->quantity;
              $total += $subtotal;
            @endphp

            <tr>
              {{-- 🔹 Imagem --}}
              <td rowspan="2" class="align-middle">
                @if($c->product->imagem)
                  <img src="{{ asset('storage/' . $c->product->imagem) }}" 
                      width="120" height="120"
                      class="rounded shadow-sm border object-fit-cover" 
                      alt="{{ $c->product->name }}">
                @else
                  <span class="text-muted">Sem imagem</span>
                @endif
              </td>

              {{-- 🔹 Nome --}}
              <td class="fw-bold align-middle">{{ $c->product->name }}</td>

              {{-- 🔹 Tipo --}}
              <td class="align-middle">
                <span class="badge {{ $isService ? 'bg-info' : 'bg-success' }}">
                  {{ ucfirst($c->product->type) }}
                </span>
              </td>

              {{-- 🔹 Quantidade (apenas para produtos) --}}
              <td class="align-middle">
                @if(!$isService)
                  <form method="POST" action="{{ route('cart.updateQuantity', $c->id) }}" class="d-flex align-items-center justify-content-center">
                    @csrf
                    @method('PATCH')
                    <input 
                        type="number" 
                        name="quantity" 
                        value="{{ $c->quantity }}" 
                        min="1" 
                        class="form-control form-control-sm me-2 text-center"
                        style="width: 70px;">
                    <button type="submit" class="btn btn-sm btn-primary">Atualizar</button>
                  </form>
                @else
                  <span class="text-muted">—</span>
                @endif
              </td>

              {{-- 🔹 Preço unitário --}}
              <td class="align-middle">R$ {{ number_format($c->product->price, 2, ',', '.') }}</td>

              {{-- 🔹 Total --}}
              <td class="align-middle">R$ {{ number_format($subtotal, 2, ',', '.') }}</td>

              {{-- 🔹 Ações --}}
              <td class="align-middle">
                <form method="POST" action="{{ route('cart.remove', $c->id) }}">
                  @csrf 
                  @method('DELETE')
                  <button class="btn btn-danger btn-sm" onclick="return confirm('Remover este item do carrinho?')">Remover</button>
                </form>
              </td>
            </tr>

            {{-- 🔹 Linha de descrição --}}
            <tr>
              <td colspan="6" class="text-start bg-light">
                <strong>Descrição:</strong>
                <p class="mb-0">{{ $c->product->description ?? 'Sem descrição disponível.' }}</p>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    {{-- 🔹 Total geral --}}
    <div class="mt-4 text-end">
      <h4><strong>Total: R$ {{ number_format($total, 2, ',', '.') }}</strong></h4>
    </div>

    {{-- 🔹 Finalizar compra --}}
    <div class="text-end mt-3">
      <form method="POST" action="{{ route('cart.checkout') }}">
        @csrf
        <button class="btn btn-success btn-lg">Finalizar Compra</button>
      </form>
    </div>
  @endif
</div>
@endsection
