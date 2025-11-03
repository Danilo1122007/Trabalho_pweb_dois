@extends('layouts')
@section('titulo', 'Formulário de Animal')
@section('conteudo')

    @php
        if (!empty($dado->id)) {
            $action = route('animals.update', $dado->id);
        } else {
            $action = route('animals.store');
        }
    @endphp

    <h3 class="mb-4">{{ !empty($dado->id) ? 'Editar' : 'Novo' }} Animal</h3>

    <form action="{{ $action }}" method="post">
        @csrf

        @if (!empty($dado->id))
            @method('put')
        @endif

        <input type="hidden" name="id" value="{{ old('id', $dado->id ?? '') }}">

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="nome_animal" class="form-label">Nome do Animal</label>
                <input type="text" class="form-control @error('nome_animal') is-invalid @enderror" 
                       name="nome_animal" value="{{ old('nome_animal', $dado->nome_animal ?? '') }}" required>
                @error('nome_animal')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="raca" class="form-label">Raça</label>
                <input type="text" class="form-control @error('raca') is-invalid @enderror" 
                       name="raca" value="{{ old('raca', $dado->raca ?? '') }}" required>
                @error('raca')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="peso" class="form-label">Peso (kg)</label>
                <input type="number" step="0.01" class="form-control @error('peso') is-invalid @enderror" 
                       name="peso" value="{{ old('peso', $dado->peso ?? '') }}" required>
                @error('peso')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4">
                <label for="nome_tutor" class="form-label">Nome do Tutor</label>
                <input type="text" class="form-control @error('nome_tutor') is-invalid @enderror" 
                       name="nome_tutor" value="{{ old('nome_tutor', $dado->nome_tutor ?? '') }}" required>
                @error('nome_tutor')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4">
                <label for="telefone_tutor" class="form-label">Telefone do Tutor</label>
                <input type="text" class="form-control @error('telefone_tutor') is-invalid @enderror" 
                       name="telefone_tutor" value="{{ old('telefone_tutor', $dado->telefone_tutor ?? '') }}" 
                       placeholder="(00) 00000-0000" required>
                @error('telefone_tutor')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-success">
                    {{ !empty($dado->id) ? 'Atualizar' : 'Salvar' }}
                </button>
                <a href="{{ route('animals.index') }}" class="btn btn-primary">Voltar</a>
            </div>
        </div>
    </form>
@endsection