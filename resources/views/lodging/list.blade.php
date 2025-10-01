@extends('layouts')
@section('titulo', 'Listagem de Estadia')
@section('conteudo')

    <h3>Listagem de Estadia</h3>

    <div class="row">
        <div class="col">
            <form action="{{ route('lodging.search') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <label class="form-label">Tipo</label>
                        <select name="tipo" class="form-select">
                            <option value="nome">Nome do Tutor</option>
                            <option value="nome_animal">Nome do Animal</option>
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
                        <a class="btn btn-success mt-4" href="{{ url('/lodging/create') }}">
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
                        <th>Tutor</th>
                        <th>Animal</th>
                        <th>Dia Entrada</th>
                        <th>Dia Saída</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dados as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->nome }}</td>
                            <td>{{ $item->nome_animal }}</td>
                            <td>{{ $item->dia_entrada ? \Carbon\Carbon::parse($item->dia_entrada)->format('d/m/Y') : '-' }}</td>
                            <td>{{ $item->dia_saida ? \Carbon\Carbon::parse($item->dia_saida)->format('d/m/Y') : '-' }}</td>
                            <td>
                                <a href="{{ route('lodging.edit', $item->id) }}" class="btn btn-outline-warning btn-sm">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('lodging.destroy', $item->id) }}" method="post" class="d-inline">
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
