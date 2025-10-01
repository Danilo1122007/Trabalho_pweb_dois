@extends('layouts')

@section('titulo', 'AnimalHouse - Página Inicial')

@section('conteudo')

<div id="animalCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#animalCarousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#animalCarousel" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#animalCarousel" data-bs-slide-to="2"></button>
        <button type="button" data-bs-target="#animalCarousel" data-bs-slide-to="3"></button>
    </div>

    <div class="carousel-inner">

        <div class="carousel-item active">
            <img src="{{ asset('img/seila.png') }}" class="d-block w-100" style="height: 500px; object-fit: cover;" alt="AnimalHouse">
            <div class="carousel-caption d-none d-md-block">
                <h2 class="display-4 fw-bold">O melhor recanto animal da cidade</h2>
                <p class="lead">Lazer e serviço de qualidade aprovada</p>
            </div>
        </div>

        <div class="carousel-item">
            <img src="{{ asset('img/ambienteexterno.jpg') }}" class="d-block w-100" style="height: 500px; object-fit: cover;" alt="Promoções">
            <div class="carousel-caption d-none d-md-block">
                <h2 class="display-4 fw-bold">Promoções imperdíveis</h2>
                <p class="lead">Banho + Tosa + Hospedagem com desconto especial</p>
            </div>
        </div>

        <div class="carousel-item">
            <img src="{{ asset('img/cachorro.webp') }}" class="d-block w-100" style="height: 500px; object-fit: cover;" alt="Conforto">
            <div class="carousel-caption d-none d-md-block">
                <h2 class="display-4 fw-bold">Lazer e conforto</h2>
                <p class="lead">Alta aprovação pelos nossos clientes</p>
            </div>
        </div>

        <div class="carousel-item">
            <img src="https://images.unsplash.com/photo-1552053831-71594a27632d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80" class="d-block w-100" style="height: 500px; object-fit: cover;" alt="Profissionais">
            <div class="carousel-caption d-none d-md-block">
                <h2 class="display-4 fw-bold">Cuidados profissionais</h2>
                <p class="lead">Equipe especializada e dedicada</p>
            </div>
        </div>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#animalCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
        <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#animalCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
        <span class="visually-hidden">Próximo</span>
    </button>
</div>
@endsection