@extends('layouts')
@section('titulo', 'Listagem de Estacionamento')
@section('conteudo')

    <h3>Listagem de Estacionamento</h3>

    <div class="row">
        <div class="col">
            <form action="{{ route('parking.search') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <label class="form-label">Tipo</label>
                        <select name="tipo" class="form-select">
                            <option value="modelo">Modelo do Veículo</option>
                            <option value="motorista">Motorista</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Valor</label>
                        <input type="text" class="form-control" name="valor" placeholder="Pesquisar...">
                    </div>

                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary mt-4">
                            <i class="fa-solid fa-magnifying-glass"></i> Buscar
                        </button>
                    </div>
                    <div class="col-md-2">
                        <a class="btn btn-success mt-4" href="{{ url('/parking/create') }}">
                            <i class="fa-solid fa-plus"></i> Novo
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Modelo</th>
                        <th>Motorista</th>
                        <th>Hora Entrada</th>
                        <th>Hora Saída</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dados as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->modelo }}</td>
                            <td>{{ $item->motorista }}</td>
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
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection