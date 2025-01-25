@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('node_modules/datatables.net-dt/css/jquery.dataTables.css') }}">
@endpush

<div class="contenedor-nav">
  <div>
    <nav class="estilo-nav navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <img class="logo-img" src="{{ asset('img/logo.png') }}" alt="">
        <!-- Hamburger Icon -->
        <button class=" hamburger-style navbar-toggler d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarOffcanvas" aria-controls="sidebarOffcanvas">
          <span class="img-hamb navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links (hidden in small screens) -->
        <div class="ocultar">
          <ul class="navbar-nav mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link text-white px-3 py-2 rounded hover-bg-light" href="/addQuestion">Pregunta - Genero</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white px-3 py-2 rounded hover-bg-light" href="/listQuestions">Lista de Preguntas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white px-3 py-2 rounded hover-bg-light" href="/home">Game</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white px-3 py-2 rounded hover-bg-light" href="/users">Usuarios</a>
            </li>
          </ul>
        </div>
        <!-- Profile and Dropdown (hidden on small screens) -->
        <div class="perfil-div collapse navbar-collapse d-flex justify-content-center d-none d-lg-block" id="navbarSupportedContent">
          <div class="perfil dropdown">
            @if(Auth::user()->profile_picture)
            <a class="nav-link text-white px-3 py-2 rounded hover-bg-light dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile Picture" class="rounded-circle" width="50" height="50">
            </a>
            @else
            <a class="nav-link text-white px-3 py-2 rounded hover-bg-light dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <span>{{ Auth::user()->username }}</span>
            </a>
            @endif

            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
              <li><a class="nav-link text-white px-3 py-2 rounded hover-bg-light" href="/profile">Perfil</a></li>
              <li class="nav-item">
          <form method="POST" action="{{ route('logout') }}" class="d-inline">
            @csrf
            <a href="{{ route('logout') }}" class=" close_sesion nav-link text-white px-3 py-2 rounded hover-bg-light"
              onclick="event.preventDefault(); this.closest('form').submit();">
               Cerrar sesión
            </a>
          </form>
        </li>
            </ul>
          </div>
        </div>

      </div>
    </nav>
  </div>
</div>


        <!-- Navbar Links (hidden in small screens) -->
        <div class="ocultar">
          <!-- Sidebar Offcanvas -->
          <div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="sidebarOffcanvas" aria-labelledby="sidebarOffcanvasLabel">
            <div class="offcanvas-header">
              @if(Auth::user()->profile_picture)
              <a class="nav-link text-white px-3 py-2 rounded hover-bg-light dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile Picture" class="rounded-circle" width="50" height="50">
              </a>
              @else
              <h1>{{ Auth::user()->username }}</h1>
              @endif
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
              <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                  <a class="nav-link text-white px-3 py-2 rounded hover-bg-light" href="/addQuestion">
                    <i class="fa-solid fa-plus me-2"></i> Pregunta - Género
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-white px-3 py-2 rounded hover-bg-light" href="/listQuestions">
                    <i class="fa-solid fa-list me-2"></i> Lista de Preguntas
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-white px-3 py-2 rounded hover-bg-light" href="/home">
                    <i class="fa-solid fa-gamepad me-2"></i> Game
                  </a>
                </li>
                <li class="nav-item">
                  <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <a href="{{ route('logout') }}" class="nav-link text-white px-3 py-2 rounded hover-bg-light"
                      onclick="event.preventDefault(); this.closest('form').submit();">
                      <i class="fa-solid fa-sign-out-alt me-2"></i> Cerrar sesión
                    </a>
                  </form>
                </li>

              </ul>
            </div>
          </div>

<style>
  .estilo-nav {
    background-color: rgb(31 41 55 / var(--tw-bg-opacity, 1)) !important;
  }

  .navbar-nav .nav-link {
    color: #f8f9fa;
    font-size: 16px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: background-color 0.3s ease;
  }

  .navbar-nav .nav-link:hover {
    background-color: #495057;
    color: #fff;
    text-decoration: none;
  }

  .nav-link:hover {
    background-color: #495057 !important;
  }

  .navbar-collapse {
    padding-left: 15px;
  }

  .navbar-nav {
    display: flex;
    gap: 15px;
    justify-content: center;
  }

  .navbar-nav .nav-item {
    border-bottom: 2px solid transparent;
    transition: border-color 0.3s ease;
  }

  .navbar-nav .nav-item:hover {
    border-color: #f8f9fa;
  }

  .perfil .nav-link {
    padding-right: 30px !important;
    color: #f8f9fa;
    font-size: 16px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: background-color 0.3s ease;
  }

  .perfil .nav-link:hover {
    background-color: #495057;
    color: #fff;
    text-decoration: none;
  }

  .dropdown-menu {
    background-color: rgb(31 41 55);
    border: none;
    min-width: 150px;
  }

  .dropdown-item {
    color: #f8f9fa;
    font-size: 14px;
    padding: 10px 20px;
    text-transform: none;
  }

  .dropdown-item:hover {
    background-color: #495057;
    color: #fff;
  }

  @media (max-width: 992px) {
    .navbar-nav {
      display: none;
    }
  }

  .perfil .dropdown-menu-end {
    right: 0;
  }

  .ocultar {
    display: flex;
    justify-content: center;
    width: 100%;
  }

  .offcanvas {
    width: 250px;
  }

  .navbar-toggler-icon {
    background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3E%3Cpath stroke='white' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-size: 100%;
    background-position: center;
  }

  .close_sesion{
    font-size: 14px !important;
  }
</style>