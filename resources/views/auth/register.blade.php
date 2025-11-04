@extends('layouts')
@section('titulo', 'Cadastrar')

@section('conteudo')
<h2>Cadastro</h2>
<form method="POST" action="{{ route('register') }}">
  @csrf
  <div class="mb-3"><label>Nome</label><input type="text" name="name" class="form-control" required></div>
  <div class="mb-3"><label>Email</label><input type="email" name="email" class="form-control" required></div>
  <div class="mb-3"><label>Senha</label><input type="password" name="password" class="form-control" required></div>
  <div class="mb-3"><label>Confirmar Senha</label><input type="password" name="password_confirmation" class="form-control" required></div>
  <button class="btn btn-success">Cadastrar</button>
</form>
@endsection
