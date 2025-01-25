<!-- Sidebar para pantallas grandes -->
<div class="sidebar d-none d-lg-block">
  <div class="style-sidebar-game d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px;">
    @if(Auth::user()->profile_picture)
    <a class="nav-link text-white px-3 py-2 rounded hover-bg-light" href="/profile/jugador" role="button">
      <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile Picture" class="rounded-circle" width="50" height="50">
      <span>{{ Auth::user()->username }}</span>
    </a>
    @if(isset($vidas) && $vidas->vidas !== null)
    <div class="mt-3">
      <button class="badge bg-success" type="button" id="buton-vidas">
        <i class="fa-solid fa-heart me-2"></i> Vidas: {{ $vidas->vidas }}
      </button>
    </div>
    @else
    <div class="mt-3">
      <a  href="/market"  aria-current="page" class="badge bg-success">
        <i class="fa-solid fa-heart me-2"></i> Comparar
    </a>
    </div>
    @endif
    @else
    <div class="nav-link text-white px-3 py-2 rounded hover-bg-light">
      <img src="{{ asset('img/sin-perfil.jpg') }}" alt="Profile Picture" class="rounded-circle" width="50" height="50">
      <span>{{ Auth::user()->username }}</span>
      @if(isset($vidas) && $vidas->vidas !== null)
      <div class="mt-3">
        <button class="badge bg-success" type="button" id="button-vidas">
          <i class="fa-solid fa-heart me-2"></i> Vidas: {{ $vidas->vidas }}
        </button>
      </div>
      @else
      <div class="mt-3">
        <span class="badge bg-success">
          <i class="fa-solid fa-heart me-2"></i> Vidas: 5
        </span>
      </div>
      @endif
    </div>

    @endif
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="/home" class="nav-link text-white" aria-current="page">
          <i class="fa-solid fa-house me-2"></i> Inicio
        </a>
      </li>
      <li>
        @if(Auth::user() && Auth::user()->rol==1)
      <li>
        <a href="/addQuestion" class="nav-link text-white">
          <i class="fa-solid fa-user-cog me-2"></i> Admin
        </a>
      </li>
      @endif
      </li>
      <li>
        <a href="/ranking" class="nav-link text-white">
          <i class="fa-solid fa-chart-line me-2"></i> Ranking
        </a>
      </li>
      <li>
        <a href="/market" class="nav-link text-white" aria-label="Ir al mercado">
          <i class="fa-solid fa-cart-shopping me-2"></i> Comprar
        </a>
      </li>
      <li>
        <a href="/play" class="nav-link text-white">
          <i class="fa-solid fa-play me-2"></i> Jugar ahora
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
