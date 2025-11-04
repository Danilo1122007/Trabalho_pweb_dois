@extends('layouts')
@section('titulo', 'Formulário de Estacionamento')
@section('conteudo')

@php
    $action = !empty($dado->id) ? route('parking.update', $dado->id) : route('parking.store');
@endphp

<h3 class="mb-4">{{ !empty($dado->id) ? 'Editar' : 'Novo' }} Veículo</h3>

<form action="{{ $action }}" method="post" enctype="multipart/form-data">
    @csrf
    @if(!empty($dado->id))
        @method('put')
    @endif

    <div class="mb-3">
        <label>Tipo de Veículo</label>
        <select name="vehicle_type_id" class="form-control" required>
            <option value="">Selecione o tipo</option>
            @foreach($vehicleTypes as $type)
                <option value="{{ $type->id }}"
                    {{ (old('vehicle_type_id', $dado->vehicle_type_id ?? '') == $type->id) ? 'selected' : '' }}>
                    {{ $type->nome }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Classe de Peso</label>
        <select name="weight_class_id" class="form-control" required>
            <option value="">Selecione a classe de peso</option>
            @foreach($weightClasses as $wc)
                <option value="{{ $wc->id }}"
                    {{ (old('weight_class_id', $dado->weight_class_id ?? '') == $wc->id) ? 'selected' : '' }}>
                    {{ $wc->nome }} - {{ $wc->descricao }}
                </option>
            @endforeach
        </select>
    </div>


    <div class="row mb-3">
        <div class="col-md-6">
            <label>Modelo</label>
            <input type="text" class="form-control" name="modelo"
                   value="{{ old('modelo', $dado->modelo ?? '') }}" required>
        </div>

        <div class="col-md-6">
            <label>Motorista</label>
            <input type="text" class="form-control" name="motorista"
                   value="{{ old('motorista', $dado->motorista ?? '') }}" required>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label>Hora Entrada</label>
            <input type="time" class="form-control" name="hora_entrada"
                   value="{{ old('hora_entrada', $dado->hora_entrada ?? '') }}" required>
        </div>

        <div class="col-md-6">
            <label>Hora Saída</label>
            <input type="time" class="form-control" name="hora_saida"
                   value="{{ old('hora_saida', $dado->hora_saida ?? '') }}">
        </div>
    </div>

    @php
        $nome_imagem = $dado->imagem ?? 'sem_imagem.png';
    @endphp
    <div class="mb-3">
        <label>Imagem</label><br>
        <img src="/storage/{{ $nome_imagem }}" width="200px" class="mb-2">
        <input type="file" name="imagem" class="form-control">
    </div>

    <button class="btn btn-success">{{ !empty($dado->id) ? 'Atualizar' : 'Salvar' }}</button>
    <a href="{{ url('parking') }}" class="btn btn-primary">Voltar</a>
</form>

@endsection
