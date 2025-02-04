@extends('evento.home')

@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
<div class="container mis-eventos">
    <div class="row">
        @if ($eventos->eventos->isEmpty())
        <div class="col-12 text-center">
            <div class="card shadow-lg border-0" style="background-color: #3a3b3be7 !important; border-radius: 10px;">
                <div class="card-body">
                    <h4 class="text-muted" style="color:white !important;">📌 No tienes reservas</h4>
                    <p class="text-secondary" style="color:white !important;">Parece que aún no has realizado ninguna reserva. ¡Explora nuestros eventos y reserva tu lugar!</p>
                    <a href="{{ route('evento.inicio') }}" class="btn btn-primary mt-2">Ver Eventos</a>
                </div>
            </div>
        </div>
        @else
        @foreach ($eventos->eventos as $evento)
        <div class="card-style col-md-4 col-sm-12 mb-3 d-flex">
            <div class="card flex-fill d-flex flex-column">
                <div class="card-body flex-grow-1">
                    <h5 class="card-title">{{ $evento->nombre }}</h5>
                    <p class="card-text">{{ $evento->description }}</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <p><strong>Fecha y hora:</strong> {{ \Carbon\Carbon::parse($evento->fecha_evento)->format('d/m/y H:i') }}</p>
                    </li>
                    <li class="list-group-item">
                        <p><strong>Localidad:</strong> {{ $evento->localidad }}</p>
                    </li>
                    <li class="list-group-item">
                        <p><strong>Dirección:</strong> {{ $evento->direccion }}</p>
                    </li>
                    <li class="list-group-item">
                        <p><strong>Cantidad de reservas:</strong> {{ $evento->pivot->cantidad }}</p>
                    </li>
                </ul>
                <div class="card-footer text-center">
                    <button type="button" class="btn btn-danger" 
                        data-bs-toggle="modal" 
                        data-bs-target="#confirmarEliminar"
                        data-id="{{ $evento->pivot->id }}"
                        data-nombre="{{ $evento->nombre }}">
                        Eliminar Reserva
                    </button>
                    <!-- Botón para abrir el modal del mapa -->
                    <button type="button" class="btn btn-info " 
                        data-bs-toggle="modal" 
                        data-bs-target="#mapaModal{{ $evento->id }}">
                        Ver Mapa
                    </button>
                </div>
            </div>
        </div>
    
        <!-- Modal para mostrar el mapa -->
        <div class="modal fade" id="mapaModal{{ $evento->id }}" tabindex="-1"
            aria-labelledby="mapaModalLabel{{ $evento->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mapaModalLabel{{ $evento->id }}">Ubicación del Evento:
                            {{ $evento->nombre }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="map{{ $evento->id }}" style="height: 400px;"></div>
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                const direccion = "{{ $evento->direccion }}";
                                const localidad = "{{ $evento->localidad }}";
                                obtenerCoordenadas(direccion, localidad, {{ $evento->id }});
                            });
    
                            function obtenerCoordenadas(direccion, localidad, eventoId) {
                                const query = `${direccion}, ${localidad}, Argentina`;
                                const url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}`;
                                fetch(url)
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.length > 0) {
                                            const lat = data[0].lat;
                                            const lon = data[0].lon;
                                            mostrarMapa(lat, lon, eventoId);
                                        } else {
                                            document.getElementById("map" + eventoId).innerHTML =
                                                "<p>No se encontraron coordenadas para la dirección ingresada.</p>";
                                        }
                                    })
                                    .catch(error => console.error("Error obteniendo coordenadas:", error));
                            }
    
                            function mostrarMapa(lat, lon, eventoId) {
                                var map = L.map('map' + eventoId).setView([lat, lon], 15);
                                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                    attribution: '&copy; OpenStreetMap contributors'
                                }).addTo(map);
                                L.marker([lat, lon]).addTo(map)
                                    .bindPopup("Ubicación del evento")
                                    .openPopup();
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    
        @endif
    </div>
</div>

<!-- Modal de Confirmación -->
<div class="modal fade" id="confirmarEliminar" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-header-style">
                <h5 class="modal-title" id="modalLabel">Confirmar Eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Seguro que quieres eliminar la reserva del evento <strong id="eventoNombre"></strong>?</p>
            </div>
            <div class="modal-footer">
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var confirmModal = document.getElementById('confirmarEliminar');
        confirmModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var eventoId = button.getAttribute('data-id');
            var eventoNombre = button.getAttribute('data-nombre');
            
            document.getElementById('eventoNombre').textContent = eventoNombre;
            
            var form = document.getElementById('deleteForm');
            form.action = '/eliminar-reserva/' + eventoId; 
        });
    });
</script>

@endsection
