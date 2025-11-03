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
                <input type="text" class="form-control @error('nome') is-invalid @enderror" 
                       name="nome" value="{{ old('nome', $dado->nome ?? '') }}" required>
                @error('nome')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="animal_id" class="form-label">Animal</label>
                {{-- ALTERADO: Campo alterado para select de animais --}}
                <select class="form-control @error('animal_id') is-invalid @enderror" 
                        name="animal_id" required>
                    <option value="">Selecione um animal</option>
                    @foreach($animais as $animal)
                        <option value="{{ $animal->id }}" 
                            {{ old('animal_id', $dado->animal_id ?? '') == $animal->id ? 'selected' : '' }}>
                            {{ $animal->nome_animal }} - {{ $animal->raca }}
                        </option>
                    @endforeach
                </select>
                @error('animal_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="dia_entrada" class="form-label">Dia de Entrada</label>
                <input type="date" class="form-control @error('dia_entrada') is-invalid @enderror" 
                       name="dia_entrada" value="{{ old('dia_entrada', $dado->dia_entrada ?? '') }}" required>
                @error('dia_entrada')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="dia_saida" class="form-label">Dia de Saída</label>
                <input type="date" class="form-control @error('dia_saida') is-invalid @enderror" 
                       name="dia_saida" value="{{ old('dia_saida', $dado->dia_saida ?? '') }}" required>
                @error('dia_saida')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-success">{{ !empty($dado->id) ? 'Atualizar' : 'Salvar' }}</button>
                <a href="{{ route('lodging.index') }}" class="btn btn-primary">Voltar</a>
            </div>
        </div>
    </form>
@endsection