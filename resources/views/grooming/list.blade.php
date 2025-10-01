@extends('layouts')
@section('titulo', 'Listagem de Banho e Tosa')
@section('conteudo')

    <h3>Listagem de Banho e Tosa</h3>

    <div class="row">
        <div class="col">
            <form action="{{ route('grooming.search') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <label class="form-label">Tipo</label>
                        <select name="tipo" class="form-select">
                            <option value="nome_animal">Nome do Animal</option>
                            <option value="raca">Raça</option>
                            <option value="telefone_tutor">Telefone do Tutor</option>
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
                        <a class="btn btn-success mt-4" href="{{ url('/grooming/create') }}">
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
                        <th>Animal</th>
                        <th>Raça</th>
                        <th>Dia e Hora do Atendimento</th>
                        <th>Telefone Tutor</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dados as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->nome_animal }}</td>
                            <td>{{ $item->raca }}</td>
                            <td>{{ $item->horario_atendimento }}</td>
                            <td>{{ $item->telefone_tutor ?? '-' }}</td>
                            <td>
                                <a href="{{ route('grooming.edit', $item->id) }}" class="btn btn-outline-warning btn-sm">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('grooming.destroy', $item->id) }}" method="post" class="d-inline">
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
