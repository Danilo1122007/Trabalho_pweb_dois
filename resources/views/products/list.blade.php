@extends('layouts')

@section('conteudo')
<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="text-center mb-0">Lista de Produtos e Serviços</h2>

    <a href="{{ route('products.create') }}" class="btn btn-success">
      ➕ Novo Produto / Serviço
    </a>
  </div>

<form method="GET" action="{{ route('products.search') }}" class="row g-2 mb-4">

    <div class="col-md-3">
      <select name="type" class="form-select">
        <option value="">Todos</option>
        <option value="produto" {{ request('type') === 'produto' ? 'selected' : '' }}>Produto</option>
        <option value="servico" {{ request('type') === 'servico' ? 'selected' : '' }}>Serviço</option>
      </select>
    </div>

    <div class="col-md-6">
      <input
        type="text"
        name="search"
        value="{{ request('search') }}"
        class="form-control"
        placeholder="Digite o nome do produto ou serviço...">
    </div>

    <div class="col-md-3 d-flex">
      <button class="btn btn-primary me-2 w-100">🔍 Buscar</button>
      <a href="{{ route('products.index') }}" class="btn btn-secondary w-100">Limpar</a>
    </div>
  </form>

  <div class="table-responsive">
    <table class="table table-striped table-bordered align-middle text-center">
      <thead class="table-dark">
        <tr>
          <th style="width: 12%">Imagem</th>
          <th style="width: 20%">Nome</th>
          <th style="width: 10%">Tipo</th>
          <th style="width: 10%">Preço</th>
          <th style="width: 15%">Qtd / Horário</th>
          <th style="width: 33%">Ações</th>
        </tr>
      </thead>
      <tbody>
        @forelse($products as $p)
          <tr class="align-middle">
            <td rowspan="2" class="align-middle">
              @if($p->imagem)
                <img src="{{ asset('storage/' . $p->imagem) }}"
                     width="130" height="130"
                     class="rounded shadow-sm border object-fit-cover"
                     alt="{{ $p->name }}">
              @else
                <span class="text-muted">Sem imagem</span>
              @endif
            </td>

            <td>{{ $p->name }}</td>

            <td>{{ ucfirst($p->type) }}</td>

            <td>R$ {{ number_format($p->price, 2, ',', '.') }}</td>

            <td>
              @if($p->type === 'produto')
                {{ $p->quantity }} unid.
              @else
                @if($p->service_date)
                  {{ \Carbon\Carbon::parse($p->service_date)->format('d/m/Y') }} às {{ $p->service_time }}
                @else
                  <span class="text-muted">Sem data definida</span>
                @endif
              @endif
            </td>

            <td>
              <div class="d-flex align-items-center justify-content-center flex-wrap gap-2">
                <a href="{{ route('products.edit', $p->id) }}" class="btn btn-sm btn-warning">
                  Editar
                </a>

                <form method="POST" action="{{ route('products.destroy', $p->id) }}"
                      onsubmit="return confirm('Tem certeza que deseja excluir este item?')">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-sm btn-danger">Excluir</button>
                </form>

                @if($p->type === 'produto' && $p->quantity <= 0)
                  <span class="text-danger fw-bold">Esgotado</span>
                @else
                  <form method="POST" action="{{ route('products.addToCart', $p->id) }}"
                        class="d-flex align-items-center">
                    @csrf
                    @if($p->type === 'produto')
                      <input
                        type="number"
                        name="quantity"
                        value="1"
                        min="1"
                        max="{{ $p->quantity }}"
                        class="form-control form-control-sm me-2"
                        style="width: 80px;">
                    @endif
                    <button class="btn btn-sm btn-primary">
                      {{ $p->type === 'produto' ? 'Adicionar ao Carrinho' : 'Agendar Serviço' }}
                    </button>
                  </form>
                @endif
              </div>
            </td>
          </tr>

          <tr>
            <td colspan="5" class="text-start bg-light">
              <strong>Descrição:</strong>
              <p class="mb-0">{{ $p->description ?? 'Sem descrição disponível.' }}</p>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" class="text-center text-muted">
              Nenhum produto ou serviço encontrado.
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="d-flex justify-content-center mt-3">
    {{ $products->appends(request()->query())->links() }}
  </div>
</div>
@endsection
