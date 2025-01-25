<nav class="navbar navbar-expand-lg align-items-center">
  <div class="div-logo d-none d-lg-flex align-items-center">
    <img src="{{ asset('img/logo.png') }}" alt="Logo" class="style-logo">
  </div>

  <div class="contenedor-pantallas-cichas">
    <div class="center-title d-flex justify-content-center align-items-center">
      <img src="{{ asset('img/Quiz.png') }}" alt="Logo-questionary" class="questioanry-logo me-2">
    </div>
    <!-- Botón Hamburguesa visible solo en pantallas pequeñas -->
    <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarOffcanvas" aria-controls="sidebarOffcanvas">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>
</nav>


<!-- Sidebar Offcanvas -->
<div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="sidebarOffcanvas" aria-labelledby="sidebarOffcanvasLabel">
  <div class="offcanvas-header">
    @if(Auth::user()->profile_picture)
    <a class="nav-link text-white px-3 py-2 rounded hover-bg-light" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
      <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile Picture" class="rounded-circle" width="50" height="50">
      <span>{{ Auth::user()->username }}</span>
      @if(isset($vidas) && $vidas->vidas !== null)
    <div class="mt-3">
      <span class="badge bg-success">
        <i class="fa-solid fa-heart me-2"></i> Vidas: {{ $vidas->vidas }}
      </span>
    </div>
    @else
    <div class="mt-3">
      <span class="badge bg-success">
        <i class="fa-solid fa-heart me-2"></i> Vidas: 5
      </span>
    </div>
    @endif
    </a>
    @else
    <a class="nav-link text-white px-3 py-2 rounded hover-bg-light" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
      <img src="{{ asset('img/sin-perfil.jpg') }}" alt="Profile Picture" class="rounded-circle" width="50" height="50">
      <span>{{ Auth::user()->username }}</span>
      @if(isset($vidas) && $vidas->vidas !== null)
    <div class="mt-3">
      <span class="badge bg-success">
        <i class="fa-solid fa-heart me-2"></i> Vidas: {{ $vidas->vidas }}
      </span>
    </div>
    @else
    <div class="mt-3">
      <span class="badge bg-success">
        <i class="fa-solid fa-heart me-2"></i> Vidas: 5
      </span>
    </div>
    @endif
    </a>
    
    @endif
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="/home" class="nav-link text-white" aria-current="page">
          <i class="fa-solid fa-house me-2"></i> Inicio
        </a>
      </li>
      @if(Auth::user() && Auth::user()->rol == 1)
      <li>
        <a href="/addQuestion" class="nav-link text-white">
          <i class="fa-solid fa-user-cog me-2"></i> Admin
        </a>
        
      </li>
      @endif
      <li>
        <a href="/play" class="nav-link text-white">
          <i class="fa-solid fa-play me-2"></i> Jugar
        </a>
      </li>
      <li>
        <a href="/ranking" class="nav-link text-white">
          <i class="fa-solid fa-ranking-star me-2"></i> Ranking
        </a>
      </li>
      <li>
        <a href="/market" class="nav-link text-white" aria-label="Ir al mercado">
          <i class="fa-solid fa-cart-shopping me-2"></i> Comprar
        </a>
      </li>
      <li>
        <a href="/profile/jugador" class="nav-link text-white">
          <i class="fa-solid fa-user me-2"></i> Perfil
        </a>
      </li>
      <li class="nav-item">
        <form method="POST" action="{{ route('logout') }}" class="d-inline">
          @csrf
          <a href="{{ route('logout') }}" class="close_sesion nav-link text-white px-3 py-2 rounded hover-bg-light"
            onclick="event.preventDefault(); this.closest('form').submit();">
            <i class="fa-solid fa-sign-out-alt me-2"></i> Cerrar sesión
          </a>
        </form>
      </li>
    </ul>
  </div>
</div>
