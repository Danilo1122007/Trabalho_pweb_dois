<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('titulo') - SIG - ACAD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container d-flex align-items-center justify-content-between">
          <div class="d-flex align-items-center">
            <img src="../img/logo.png" alt="Logo" class="wolf-logo mr-2" />
            <a class="navbar-brand mb-0 h1" href="{{ route('inicio') }}">
              <h1>AnimalHouse</h1>
            </a>
            <button id="toggleSidebar" class="btn btn-outline-light d-lg-none ml-3"></button>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item active">
                <a class="nav-link" href="{{ route('inicio') }}">
                  <h2>Início</h2>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('parking.index') }}">
                  <h2>Estacionamento</h2>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('grooming.index') }}">
                  <h2>Banho</h2>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('lodging.index') }}">
                  <h2>Hotel</h2>
                </a>
              </li>
            </ul>
          </div>
        </div>
    </nav>

    <section class="py-5 bg-light">
      <div class="container">
          <div class="row text-center">
              <div class="col-12">
                  <h1 class="display-4 fw-bold text-dark mb-4">AnimalHouse</h1>
                  <p class="lead text-muted mb-5">O serviço que encanta desde seu primeiro atendimento. Cuidamos do seu pet com amor e profissionalismo.</p>
              </div>
          </div>
      </div>
    </section>

    <div class="container mt-4">
        <div class="row">
            @if ($errors->any())
                <p>Por favor, verifique os erros abaixo</p>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
        @yield('conteudo')
    </div>

    <footer class="text-center p-4 text-light bg-dark">
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
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
</body>

</html>