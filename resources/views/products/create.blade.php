@extends('layouts')
@section('titulo', 'Cadastrar Produto/Serviço')

@section('conteudo')
<h2>Cadastrar Produto/Serviço</h2>

@if ($errors->any())
  <div class="alert alert-danger">
    <ul class="mb-0">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
  @csrf

  <div class="mb-3">
    <label for="imagem" class="form-label">Imagem (opcional)</label>
    <input type="file" name="imagem" id="imagem" class="form-control">
  </div>

  <div class="mb-3">
    <label for="name" class="form-label">Nome</label>
    <input type="text" name="name" id="name" class="form-control" required>
  </div>

  <div class="mb-3">
    <label for="description" class="form-label">Descrição</label>
    <textarea name="description" id="description" class="form-control"></textarea>
  </div>

  <div class="mb-3">
    <label for="price" class="form-label">Preço</label>
    <input type="number" step="0.01" name="price" id="price" class="form-control" required>
  </div>

  <div class="mb-3">
    <label for="typeSelect" class="form-label">Tipo</label>
    <select name="type" id="typeSelect" class="form-control" required>
      <option value="">Selecione</option>
      <option value="produto">Produto</option>
      <option value="servico">Serviço</option>
    </select>
  </div>

  <div class="mb-3" id="quantityDiv" style="display:none;">
    <label for="quantity" class="form-label">Quantidade</label>
    <input type="number" name="quantity" id="quantity" class="form-control" min="0">
  </div>

  <div id="serviceFields" style="display:none;">
    <div class="mb-3">
      <label for="service_date" class="form-label">Data do Serviço</label>
      <input type="date" name="service_date" id="service_date" class="form-control">
    </div>
    <div class="mb-3">
      <label for="service_time" class="form-label">Horário</label>
      <input type="time" name="service_time" id="service_time" class="form-control">
    </div>
  </div>

  <button class="btn btn-primary">Salvar</button>
</form>

<script>
document.getElementById('typeSelect').addEventListener('change', function(){
  const val = this.value;
  document.getElementById('quantityDiv').style.display = val === 'produto' ? 'block' : 'none';
  document.getElementById('serviceFields').style.display = val === 'servico' ? 'block' : 'none';
});
</script>
@endsection
