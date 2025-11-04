@extends('layouts')

@section('conteudo')
<div class="container mt-4">

  {{-- 🔹 Cabeçalho --}}
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="text-center mb-0">Listagem de Estacionamento</h2>

    <a href="{{ route('parking.create') }}" class="btn btn-success">
      ➕ Novo Registro
    </a>
  </div>

  {{-- 🔹 Resumo de vagas --}}
  <div class="alert alert-info text-center fw-semibold mb-4">
    🚗 <strong>Total:</strong> {{ $total }} &nbsp; | &nbsp;
    🅿️ <strong>Ocupadas:</strong> {{ $ocupadas }} &nbsp; | &nbsp;
    ✅ <strong>Disponíveis:</strong> {{ $livres }}
  </div>

  {{-- 🔹 Formulário de busca --}}
  <form action="{{ route('parking.search') }}" method="POST" class="row g-2 mb-4">
    @csrf

    <div class="col-md-3">
      <select name="tipo" class="form-select">
        <option value="modelo" {{ request('tipo') === 'modelo' ? 'selected' : '' }}>Modelo do Veículo</option>
        <option value="motorista" {{ request('tipo') === 'motorista' ? 'selected' : '' }}>Motorista</option>
        <option value="vehicle_type_id" {{ request('tipo') === 'vehicle_type_id' ? 'selected' : '' }}>Tipo de Veículo</option>
      </select>
    </div>

    <div class="col-md-6">
      <input 
        type="text" 
        name="valor" 
        value="{{ request('valor') }}" 
        class="form-control" 
        placeholder="Digite o valor da busca...">
    </div>

    <div class="col-md-3 d-flex">
      <button class="btn btn-primary me-2 w-100">🔍 Buscar</button>
      <a href="{{ route('parking.index') }}" class="btn btn-secondary w-100">Limpar</a>
    </div>
  </form>

  {{-- 🔹 Botões extras --}}
  <div class="d-flex flex-wrap justify-content-center gap-3 mb-4">
    <a class="btn btn-danger" href="{{ url('/parking/report') }}">📄 Relatório PDF</a>
    <a class="btn btn-warning" href="{{ url('/parking/chart') }}">📊 Gerar Gráfico</a>
  </div>

  {{-- 🔹 Tabela estilizada --}}
  <div class="table-responsive">
    <table class="table table-striped table-bordered align-middle text-center">
      <thead class="table-dark">
        <tr>
          <th style="width: 10%">Imagem</th>
          <th style="width: 5%">#ID</th>
          <th style="width: 15%">Modelo</th>
          <th style="width: 15%">Motorista</th>
          <th style="width: 15%">Tipo de Veículo</th>
          <th style="width: 10%">Peso</th>
          <th style="width: 10%">Entrada</th>
          <th style="width: 10%">Saída</th>
          <th style="width: 10%">Ações</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($dados as $item)
          @php
            $nome_imagem = $item->imagem ?? 'sem_imagem.png';
          @endphp
          <tr>
            {{-- 🔹 Imagem --}}
            <td rowspan="2" class="align-middle">
              <img 
                src="{{ asset('storage/' . $nome_imagem) }}" 
                width="120" height="120"
                class="rounded shadow-sm border object-fit-cover"
                alt="{{ $item->modelo }}">
            </td>

            {{-- 🔹 ID --}}
            <td>{{ $item->id }}</td>

            {{-- 🔹 Modelo --}}
            <td>{{ $item->modelo }}</td>

            {{-- 🔹 Motorista --}}
            <td>{{ $item->motorista }}</td>

            {{-- 🔹 Tipo de veículo --}}
            <td>{{ $item->vehicleType->nome ?? '-' }}</td>

            {{-- 🔹 Peso --}}
            <td>{{ $item->weightClass->nome ?? '-' }}</td>

            {{-- 🔹 Entrada / Saída --}}
            <td>{{ $item->hora_entrada }}</td>
            <td>{{ $item->hora_saida ?? '-' }}</td>

            {{-- 🔹 Ações --}}
            <td>
              <div class="d-flex align-items-center justify-content-center flex-wrap gap-2">
                {{-- ✏️ Editar --}}
                <a href="{{ route('parking.edit', $item->id) }}" class="btn btn-sm btn-warning">
                  Editar
                </a>

                {{-- 🗑️ Excluir --}}
                <form action="{{ route('parking.destroy', $item->id) }}" method="POST"
                      onsubmit="return confirm('Deseja remover este registro?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                </form>
              </div>
            </td>
          </tr>

          {{-- 🔹 Linha de descrição opcional --}}
          <tr>
            <td colspan="8" class="text-start bg-light">
              <strong>Observações:</strong>
              <p class="mb-0">{{ $item->observacoes ?? 'Sem observações registradas.' }}</p>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="9" class="text-center text-muted">Nenhum registro encontrado.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  {{-- 🔹 Paginação --}}
  <div class="d-flex justify-content-center mt-3">
    {{ $dados->appends(request()->query())->links() }}
  </div>
</div>
@endsection
