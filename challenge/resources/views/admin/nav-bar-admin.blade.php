<nav class="header header-sticky admin-nav navbar navbar-expand-lg navbar-white bg-white">
    <button id="toggle-sidebar" class="buton-hamburger border-0 bg-transparent">
        <i class="bi bi-list fs-2"></i>
    </button>

    <button class=" button-responsive button-nav navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
        data-bs-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle sidebar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-dark">
                    <i class="cil-user"></i> Administracion
                </a>
            </li>
        </ul>
    </div>

    <div class="perfil">
        @if (Auth::user()->image)
            <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="Perfil" class="rounded-circle"
                width="60" height="60">
        @else
            {{ Auth::user()->name }}
        @endif
    </div>
</nav>

<div class="collapse" id="sidebar">
    <div class="sidebar-content">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="sidebar-li-text nav-link text-dark" href="/">
                    <i class="fas fa-home"></i> Inicio
                </a>
            </li>
            <li class="nav-item">
                <a class="sidebar-li-text nav-link text-dark" href="/administracion">
                    <i class="fas fa-calendar-alt"></i> Eventos
                </a>
            </li>
            <li class="nav-item">
                <a class="sidebar-li-text nav-link text-dark" href="/">
                    <i class="fas fa-cogs"></i> Configuración
                </a>
            </li>
            <li class="nav-item">
                <a class="sidebar-li-text nav-link text-dark" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</div>
