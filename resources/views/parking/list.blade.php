@extends('layouts')
@section('titulo', 'Listagem de Estacionamento')
@section('conteudo')

<h3>Listagem de Estacionamento</h3>

{{-- Informações das vagas --}}
<div class="alert alert-info mb-3">
    <strong>Total de Vagas:</strong> {{ $total }} |
    <strong>Ocupadas:</strong> {{ $ocupadas }} |
    <strong>Disponíveis:</strong> {{ $livres }}
</div>

<div class="row mb-3">
    <form action="{{ route('parking.search') }}" method="post" class="row">
        @csrf

        <div class="col-md-3">
            <label class="form-label">Buscar por</label>
            <select name="tipo" class="form-select">
                <option value="modelo">Modelo do Veículo</option>
                <option value="motorista">Motorista</option>
                <option value="vehicle_type_id">Tipo de Veículo</option>
            </select>
        </div>

        <div class="col-md-4">
            <label class="form-label">Valor</label>
            <input type="text" class="form-control" name="valor" placeholder="Pesquisar...">
        </div>

        <div class="col-md-2">
            <button type="submit" class="btn btn-primary mt-4">
                <i class="fa-solid fa-magnifying-glass"></i> Buscar
            </button>
        </div>

        <div class="col-md-3">
            <a class="btn btn-success mt-4 w-100" href="{{ url('/parking/create') }}">
                <i class="fa-solid fa-plus"></i> Novo
            </a>
        </div>
    </form>
</div>

<div class="row mb-3">
    <div class="col-md-3">
        <a class="btn btn-danger w-100" href="{{ url('/parking/report') }}">Relatório PDF</a>
    </div>
    <div class="col-md-3">
        <a class="btn btn-warning w-100" href="{{ url('/parking/chart') }}">Gerar Gráfico</a>
    </div>
</div>

<table class="table table-hover">
    <thead>
        <tr>
            <th>Imagem</th>
            <th>#ID</th>
            <th>Modelo</th>
            <th>Motorista</th>
            <th>Tipo</th>
            <th>Peso</th>
            <th>Entrada</th>
            <th>Saída</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($dados as $item)
            @php
                $nome_imagem = $item->imagem ?? 'sem_imagem.png';
            @endphp
            <tr>
                <td><img src="/storage/{{ $nome_imagem }}" width="90"></td>
                <td>{{ $item->id }}</td>
                <td>{{ $item->modelo }}</td>
                <td>{{ $item->motorista }}</td>
                <td>{{ $item->vehicleType->nome ?? '-' }}</td>
                <td>{{ $item->weightClass->nome ?? '-' }}</td>
                <td>{{ $item->hora_entrada }}</td>
                <td>{{ $item->hora_saida ?? '-' }}</td>
                <td>
                    <a href="{{ route('parking.edit', $item->id) }}" class="btn btn-outline-warning btn-sm">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>

                    <form action="{{ route('parking.destroy', $item->id) }}" method="post" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger"
                            onclick="return confirm('Deseja remover este registro?')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="9" class="text-center text-muted">Nenhum registro encontrado.</td>
            </tr>
        @endforelse
    </tbody>
</table>

@endsection
