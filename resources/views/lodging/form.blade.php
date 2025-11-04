@extends('layouts')
@section('titulo', 'Formulário de Estadia')
@section('conteudo')

    @php
        if (!empty($dado->id)) {
            $action = route('lodging.update', $dado->id);
        } else {
            $action = route('lodging.store');
        }
    @endphp

    <h3 class="mb-4">{{ !empty($dado->id) ? 'Editar' : 'Nova' }} Reserva de Estadia</h3>

    <form action="{{ $action }}" method="post">
        @csrf

        @if (!empty($dado->id))
            @method('put')
        @endif

        <input type="hidden" name="id" value="{{ old('id', $dado->id ?? '') }}">

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="nome" class="form-label">Nome do Tutor</label>
                <input type="text" class="form-control" name="nome" value="{{ old('nome', $dado->nome ?? '') }}" required>
            </div>
            <div class="col-md-6">
                <label for="nome_animal" class="form-label">Nome do Animal</label>
                <input type="text" class="form-control" name="nome_animal" value="{{ old('nome_animal', $dado->nome_animal ?? '') }}" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="dia_entrada" class="form-label">Dia de Entrada</label>
                <input type="date" class="form-control" name="dia_entrada" value="{{ old('dia_entrada', $dado->dia_entrada ?? '') }}">
            </div>
            <div class="col-md-6">
                <label for="dia_saida" class="form-label">Dia de Saída</label>
                <input type="date" class="form-control" name="dia_saida" value="{{ old('dia_saida', $dado->dia_saida ?? '') }}">
            </div>
        </div>

        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-success">{{ !empty($dado->id) ? 'Atualizar' : 'Salvar' }}</button>
                <a href="{{ url('lodging') }}" class="btn btn-primary">Voltar</a>
            </div>
        </div>
    </form>
@endsection
