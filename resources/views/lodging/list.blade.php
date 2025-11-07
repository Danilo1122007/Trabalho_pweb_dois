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
                        <select id="tipo" name="tipo" class="form-select">
                            <option value="animal.nome_animal">Nome do Animal</option>
                            <option value="animal.nome_tutor">Nome do Tutor</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Valor</label>
                        <input id="valor" type="text" class="form-control" name="valor" placeholder="Pesquisar...">
                    </div>

                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary mt-4">
                            <i class="fa-solid fa-magnifying-glass"></i> Buscar
                        </button>
                    </div>
                    <div class="col-md-2">
                        <div class="d-flex gap-2 mt-4">
                            <a class="btn btn-success" href="{{ route('lodging.create') }}">
                                <i class="fa-solid fa-plus"></i> Nova Estadia
                            </a>
                            <a class="btn btn-outline-info" href="{{ route('animals.index') }}" title="Cadastrar Novo Animal">
                                <i class="fa-solid fa-paw"></i> Novo Animal
                            </a>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <a class="btn btn-danger mt-4" href="{{ route('lodging.report') }}">
                            <i class="fa-solid fa-file-pdf"></i> Relatório PDF
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
                <table class="table table-hover" id="lodgingTable">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Animal</th>
                            <th>Tutor</th>
                            <th>Dia Entrada</th>
                            <th>Dia Saída</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dados as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->animal->nome_animal }}</td>
                                <td>{{ $item->animal->nome_tutor }}</td>
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
                                            onclick="return confirm('Deseja remover esta estadia?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-info">Nenhuma estadia cadastrada.</div>
            @endif
        </div>
    </div>
@endsection
    
@section('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    const input = document.getElementById("valor");
    const tipo = document.getElementById("tipo");
    const tbody = document.querySelector("#lodgingTable tbody");

    function search() {
        fetch(`{{ route('lodging.search.ajax') }}?tipo=${tipo.value}&valor=${input.value}`)
            .then(response => response.text())
            .then(html => {
                tbody.innerHTML = html;
            });
    }

    input.addEventListener("keyup", search);
    tipo.addEventListener("change", search);
});
</script>
@endsection