@extends('layouts')
@section('titulo', 'Listagem de Animais')
@section('conteudo')

    <h3>Listagem de Animais</h3>

    <div class="row">
        <div class="col">
            <form action="{{ route('animals.search') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <label class="form-label">Tipo</label>
                        <select name="tipo" class="form-select">
                            <option value="nome_animal">Nome do Animal</option>
                            <option value="raca">Raça</option>
                            <option value="nome_tutor">Nome do Tutor</option>
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
                        <a class="btn btn-success mt-4" href="{{ route('animals.create') }}">
                            <i class="fa-solid fa-plus"></i> Novo Animal
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a class="btn btn-warning mt-4" href="{{ route('animals.chart') }}">
                            <i class="fa-solid fa-chart-pie"></i> Gerar Gráfico
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($dados->count() > 0)
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th>#ID</th>
                            <th>Nome do Animal</th>
                            <th>Raça</th>
                            <th>Peso (kg)</th>
                            <th>Nome do Tutor</th>
                            <th>Telefone</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dados as $item)
                            @php
                                $nome_foto = !empty($item->foto) ? $item->foto : 'sem_imagem.png';
                            @endphp
                            <tr>
                                <td><img src="/storage/{{ $nome_foto }}" width="100px" height="100px" alt="img"></td>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->nome_animal }}</td>
                                <td>{{ $item->raca }}</td>
                                <td>{{ number_format($item->peso, 2) }} kg</td>
                                <td>{{ $item->nome_tutor }}</td>
                                <td>{{ $item->telefone_tutor }}</td>
                                <td>
                                    <a href="{{ route('animals.edit', $item->id) }}" class="btn btn-outline-warning btn-sm">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('animals.destroy', $item->id) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Deseja remover este animal?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-info">Nenhum animal cadastrado.</div>
            @endif
        </div>
    </div>
@endsection