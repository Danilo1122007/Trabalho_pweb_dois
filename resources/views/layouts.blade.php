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

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-large">
    <div class="container-fluid align-items-center py-3">
        <div class="d-flex align-items-center">
            <img src="../img/logo.png" alt="Logo" class="wolf-logo me-3" style="height:100px; width:auto;">
            <a class="navbar-brand mb-0 h1" href="{{ route('inicio') }}" style="padding-top:0;">
                <h1 class="m-0" style="font-size:1.8rem; font-weight:300; line-height:1;">AnimalHouse</h1>
                <small style="display:block; font-size:1.1rem; color:#cfcfcf; margin-top:2px;">Cuidados profissionais</small>
            </a>
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav mx-auto text-center align-items-center" style="gap:8px;">
                <li class="nav-item"><a class="nav-link" href="{{ route('inicio') }}"><span style="font-size:1.1rem; margin:0;">Início</span></a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('parking.index') }}"><span style="font-size:1.1rem; margin:0;">Estacionamento</span></a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('grooming.index') }}"><span style="font-size:1.1rem; margin:0;">Banho</span></a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('lodging.index') }}"><span style="font-size:1.1rem; margin:0;">Hotel</span></a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('products.index') }}"><span style="font-size:1.1rem; margin:0;">Produtos/Serviços</span></a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('cart.index') }}"><span style="font-size:1.1rem; margin:0;">Carrinho</span></a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('orders.index') }}"><span style="font-size:1.1rem; margin:0;">Pedidos</span></a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}"><span style="font-size:1.1rem; margin:0;">Dashboard</span></a></li>
            </ul>
        </div>

        <div class="d-flex align-items-center text-light" style="gap:8px;">
            @auth
                <span class="me-2" style="font-size:1rem;">Olá, <strong>{{ Auth::user()->name }}</strong></span>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">@csrf
                    <button class="btn btn-outline-light btn-sm" style="font-size:0.9rem; padding:5px 10px;">Sair</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm" style="font-size:0.9rem; padding:5px 10px;">Entrar</a>
                <a href="{{ route('register') }}" class="btn btn-success btn-sm" style="font-size:0.9rem; padding:5px 10px;">Cadastrar</a>
            @endauth
        </div>
    </div>
</nav>

<style>
.navbar-brand h1 {
    font-size: 1.8rem !important;
    font-weight: 300;
}

.navbar-nav .nav-link span {
    font-size: 1.1rem !important;
    font-weight: 400;
    color: #ffffff;
    transition: color 0.2s ease;
}

.navbar-nav .nav-link:hover span {
    color: #ffc107;
}

.navbar .text-light span {
    font-size: 1rem;
}

.navbar .btn-sm {
    font-size: 0.9rem !important;
    padding: 5px 10px !important;
}

@media (max-width: 991px) {
    .navbar-brand h1 {
        font-size: 1.5rem !important;
    }

    .navbar-nav .nav-link span {
        font-size: 1rem !important;
    }

    .navbar .text-light span {
        font-size: 0.9rem;
    }
}
</style>

    <div class="container mt-4">
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

        @yield('conteudo')
    </div>

    <footer class="text-center p-4 text-light bg-dark mt-4">
        <h2 style="font-size:1.3rem;">Nos sigam em nossas redes sociais</h2>
        <div class="container">
            <ol class="list-unstyled mb-3 d-flex justify-content-center flex-wrap">
                <li class="mx-3">
                    <a href="https://www.instagram.com" class="text-light" target="_blank" style="font-size:1rem;">
                        <i class="fa-brands fa-instagram"></i> Instagram
                    </a>
                </li>
                <li class="mx-3">
                    <a href="https://wa.me/seunumerodetelefone" class="text-light" target="_blank" style="font-size:1rem;">
                        <i class="fa-brands fa-whatsapp"></i> WhatsApp
                    </a>
                </li>
                <li class="mx-3">
                    <a href="https://www.facebook.com" class="text-light" target="_blank" style="font-size:1rem;">
                        <i class="fa-brands fa-facebook"></i> Facebook
                    </a>
                </li>
                <li class="mx-3">
                    <a href="https://twitter.com" class="text-light" target="_blank" style="font-size:1rem;">
                        <i class="fa-brands fa-x-twitter"></i> Twitter (X)
                    </a>
                </li>
            </ol>
            <b style="font-size:1rem;">&copy; 2025 AnimalHouse</b>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    @yield('scripts')
</body>
</html>
