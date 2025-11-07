@extends('layouts')
@section('titulo', 'Editar Produto ou Serviço')

@section('conteudo')
<h2>Editar Produto ou Serviço</h2>

@if ($errors->any())
  <div class="alert alert-danger">
    <ul class="mb-0">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
  @csrf
  @method('PUT')

  <div class="mb-3">
    <label for="name" class="form-label">Nome</label>
    <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" class="form-control" required>
  </div>

  <div class="mb-3">
    <label for="description" class="form-label">Descrição</label>
    <textarea name="description" id="description" class="form-control">{{ old('description', $product->description) }}</textarea>
  </div>

  <div class="mb-3">
    <label for="price" class="form-label">Preço</label>
    <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $product->price) }}" class="form-control" required>
  </div>

  <div class="mb-3">
    <label for="type-select" class="form-label">Tipo</label>
    <select name="type" class="form-control" id="type-select" required>
      <option value="produto" {{ old('type', $product->type) === 'produto' ? 'selected' : '' }}>Produto</option>
      <option value="servico" {{ old('type', $product->type) === 'servico' ? 'selected' : '' }}>Serviço</option>
    </select>
  </div>

  <div class="mb-3" id="quantity-field" style="{{ $product->type === 'produto' ? '' : 'display:none;' }}">
    <label for="quantity" class="form-label">Quantidade em Estoque</label>
    <input type="number" name="quantity" id="quantity" value="{{ old('quantity', $product->quantity) }}" class="form-control" min="0">
  </div>

  <div id="service-fields" style="{{ $product->type === 'servico' ? '' : 'display:none;' }}">
    <div class="mb-3">
      <label for="service_date" class="form-label">Data do Serviço</label>
      <input type="date" name="service_date" id="service_date" value="{{ old('service_date', $product->service_date) }}" class="form-control">
    </div>

    <div class="mb-3">
      <label for="service_time" class="form-label">Horário do Serviço</label>
      <input type="time" name="service_time" id="service_time" value="{{ old('service_time', $product->service_time) }}" class="form-control">
    </div>
  </div>

  <div class="mb-3">
    <label for="imagem" class="form-label">Imagem (opcional)</label>
    <input type="file" name="imagem" id="imagem" class="form-control" accept="image/*">

    @if($product->imagem)
      <div class="mt-2">
        <p class="mb-1">Imagem atual:</p>
        <img src="{{ asset('storage/' . $product->imagem) }}" width="150" class="rounded shadow-sm border" alt="Imagem atual do produto">
      </div>
    @endif
  </div>

  <button type="submit" class="btn btn-success">Salvar Alterações</button>
  <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancelar</a>
</form>

<script>
  document.getElementById('type-select').addEventListener('change', function() {
    const type = this.value;
    document.getElementById('quantity-field').style.display = type === 'produto' ? 'block' : 'none';
    document.getElementById('service-fields').style.display = type === 'servico' ? 'block' : 'none';
  });

  document.getElementById('imagem').addEventListener('change', function(event) {
    const previewContainer = document.querySelector('.mt-2');
    if (event.target.files.length > 0) {
      const file = event.target.files[0];
      const reader = new FileReader();
      reader.onload = function(e) {
        if (previewContainer) {
          previewContainer.innerHTML = `<p class="mb-1">Nova imagem selecionada:</p><img src="${e.target.result}" width="150" class="rounded shadow-sm border">`;
        }
      };
      reader.readAsDataURL(file);
    }
  });
</script>
@endsection
