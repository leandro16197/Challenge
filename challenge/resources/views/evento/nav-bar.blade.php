<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/">The Events</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto">
            @if (Auth::user()->rol == 1)
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('admin.admin') }}">Administracion</a>
                </li>
            @endif
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('evento.inicio') }}">Eventos</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('evento.myevents') }}">Mis Eventos</a>
            </li>
            <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    @if (Auth::user()->image)
                        <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="Perfil" class="rounded-circle"
                            width="30" height="30">
                    @else
                        {{ Auth::user()->name }}
                    @endif
                </a>

                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); 
                            document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>

        </ul>
    </div>

</nav>
