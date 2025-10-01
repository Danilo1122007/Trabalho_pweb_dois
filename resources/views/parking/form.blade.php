@extends('layouts')
@section('titulo', 'Formulário de Estacionamento')
@section('conteudo')

    @php
        if (!empty($dado->id)) {
            $action = route('parking.update', $dado->id);
        } else {
            $action = route('parking.store');
        }
    @endphp

    <h3 class="mb-4">{{ !empty($dado->id) ? 'Editar' : 'Novo' }} Veículo no Estacionamento</h3>

    <form action="{{ $action }}" method="post">
        @csrf

        @if (!empty($dado->id))
            @method('put')
        @endif

        <input type="hidden" name="id" value="{{ old('id', $dado->id ?? '') }}">

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="modelo" class="form-label">Modelo do Veículo</label>
                <input type="text" class="form-control" name="modelo" value="{{ old('modelo', $dado->modelo ?? '') }}" required>
            </div>
            <div class="col-md-6">
                <label for="motorista" class="form-label">Motorista</label>
                <input type="text" class="form-control" name="motorista" value="{{ old('motorista', $dado->motorista ?? '') }}" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="hora_entrada" class="form-label">Hora de Entrada</label>
                <input type="time" class="form-control" name="hora_entrada" value="{{ old('hora_entrada', $dado->hora_entrada ?? '') }}" required>
            </div>
            <div class="col-md-6">
                <label for="hora_saida" class="form-label">Hora de Saída</label>
                <input type="time" class="form-control" name="hora_saida" value="{{ old('hora_saida', $dado->hora_saida ?? '') }}">
            </div>
        </div>

        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-success">{{ !empty($dado->id) ? 'Atualizar' : 'Salvar' }}</button>
                <a href="{{ url('parking') }}" class="btn btn-primary">Voltar</a>
            </div>
        </div>
    </form>
@endsection