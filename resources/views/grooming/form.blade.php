@extends('layouts')
@section('titulo', 'Formulário de Banho e Tosa')
@section('conteudo')

    @php
        if (!empty($dado->id)) {
            $action = route('grooming.update', $dado->id);
        } else {
            $action = route('grooming.store');
        }
    @endphp

    <h3 class="mb-4">{{ !empty($dado->id) ? 'Editar' : 'Novo' }} Agendamento de Banho e Tosa</h3>

    <form action="{{ $action }}" method="post">
        @csrf

        @if (!empty($dado->id))
            @method('put')
        @endif

        <input type="hidden" name="id" value="{{ old('id', $dado->id ?? '') }}">

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="nome_animal" class="form-label">Nome do Animal</label>
                <input type="text" class="form-control" name="nome_animal" value="{{ old('nome_animal', $dado->nome_animal ?? '') }}" required>
            </div>
            <div class="col-md-6">
                <label for="raca" class="form-label">Raça</label>
                <input type="text" class="form-control" name="raca" value="{{ old('raca', $dado->raca ?? '') }}" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="horario_atendimento" class="form-label">Dia e Hora do Atendimento</label>
                <input type="datetime-local" class="form-control" name="horario_atendimento" value="{{ old('horario_atendimento', $dado->horario_atendimento ?? '') }}" required>
            </div>
            <div class="col-md-6">
                <label for="telefone_tutor" class="form-label">Telefone do Tutor</label>
                <input type="text" class="form-control" name="telefone_tutor" value="{{ old('telefone_tutor', $dado->telefone_tutor ?? '') }}">
            </div>
        </div>

        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-success">{{ !empty($dado->id) ? 'Atualizar' : 'Salvar' }}</button>
                <a href="{{ url('grooming') }}" class="btn btn-primary">Voltar</a>
            </div>
        </div>
    </form>
@endsection
