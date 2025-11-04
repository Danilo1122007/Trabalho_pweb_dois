<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('titulo') - SIG - ACAD</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Chart.js para o Dashboard --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

    {{-- NAVBAR PRINCIPAL --}}
<nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-large">
    <div class="container-fluid align-items-center py-3"> <!-- py controla a altura do header -->
        <!-- Logo e Nome à esquerda -->
        <div class="d-flex align-items-center">
            <img src="../img/logo.png" alt="Logo" class="wolf-logo me-3" style="height:160px; width:auto;">
            <a class="navbar-brand mb-0 h1" href="{{ route('inicio') }}" style="padding-top:0;">
                <h1 class="m-0" style="font-size:2rem; font-weight:700; line-height:1;">AnimalHouse</h1>
                <small style="display:block; font-size:1.3rem; color:#cfcfcf; margin-top:2px;">Cuidados profissionais</small>
            </a>
        </div>

        <!-- Botão toggle (mobile) -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu centralizado -->
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav mx-auto text-center align-items-center" style="gap:18px;">
                <li class="nav-item"><a class="nav-link" href="{{ route('inicio') }}"><h2 style="font-size:1.25rem; margin:0;">Início</h2></a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('parking.index') }}"><h2 style="font-size:1.25rem; margin:0;">Estacionamento</h2></a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('grooming.index') }}"><h2 style="font-size:1.25rem; margin:0;">Banho</h2></a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('lodging.index') }}"><h2 style="font-size:1.25rem; margin:0;">Hotel</h2></a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('products.index') }}"><h2 style="font-size:1.25rem; margin:0;">Produtos/Serviços</h2></a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('cart.index') }}"><h2 style="font-size:1.25rem; margin:0;">Carrinho</h2></a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('orders.index') }}"><h2 style="font-size:1.25rem; margin:0;">Pedidos</h2></a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}"><h2 style="font-size:1.25rem; margin:0;">Dashboard</h2></a></li>
            </ul>
        </div>

        <!-- Login/Logout à direita -->
        <div class="d-flex align-items-center text-light" style="gap:10px;">
            @auth
                <span class="me-2" style="font-size:2rem;">Olá, <strong>{{ Auth::user()->name }}</strong></span>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">@csrf
                    <button class="btn btn-outline-light btn-sm" style="font-size:0.95rem; padding:6px 12px;">Sair</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm" style="font-size:0.95rem; padding:6px 12px;">Entrar</a>
                <a href="{{ route('register') }}" class="btn btn-success btn-sm" style="font-size:0.95rem; padding:6px 12px;">Cadastrar</a>
            @endauth
        </div>
    </div>
</nav>

<style>
/* Marca (AnimalHouse) */
.navbar-brand h1 {
    font-size: 3rem !important;
    font-weight: 50;
}

/* Itens do menu central */
.navbar-nav .nav-link h2 {
    font-size: 2rem !important;
    font-weight: 600;
    color: #ffffff;
    transition: color 0.2s ease;
}

.navbar-nav .nav-link:hover h2 {
    color: #ffc107; /* cor amarela no hover */
}

/* Área de login/logout à direita */
.navbar .text-light span {
    font-size: 1.1rem;
}

.navbar .btn-sm {
    font-size: 2rem !important;
    padding: 8px 16px !important;
}

/* Responsivo para telas menores */
@media (max-width: 991px) {
    .navbar-brand h1 {
        font-size: 1.8rem !important;
    }

    .navbar-nav .nav-link h2 {
        font-size: 1.1rem !important;
    }
}
</style>




    {{-- CONTEÚDO PRINCIPAL --}}
    <div class="container mt-4">
        {{-- Mensagens de erro e sucesso --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Por favor, verifique os erros abaixo:</strong>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Conteúdo da página --}}
        @yield('conteudo')
    </div>

    {{-- FOOTER --}}
    <footer class="text-center p-4 text-light bg-dark mt-4">
        <h2>Nos sigam em nossas redes sociais</h2>
        <div class="container">
            <ol class="list-unstyled mb-3 d-flex justify-content-center flex-wrap">
                <li class="mx-3">
                    <a href="https://www.instagram.com" class="text-light" target="_blank">
                        <i class="fa-brands fa-instagram"></i> Instagram
                    </a>
                </li>
                <li class="mx-3">
                    <a href="https://wa.me/seunumerodetelefone" class="text-light" target="_blank">
                        <i class="fa-brands fa-whatsapp"></i> WhatsApp
                    </a>
                </li>
                <li class="mx-3">
                    <a href="https://www.facebook.com" class="text-light" target="_blank">
                        <i class="fa-brands fa-facebook"></i> Facebook
                    </a>
                </li>
                <li class="mx-3">
                    <a href="https://twitter.com" class="text-light" target="_blank">
                        <i class="fa-brands fa-x-twitter"></i> Twitter (X)
                    </a>
                </li>
            </ol>
            <b>&copy; 2025 AnimalHouse</b>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    {{-- Scripts adicionais (Chart.js, JS de produtos, etc.) --}}
    @yield('scripts')
</body>
</html>
