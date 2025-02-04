@extends('evento.home')

@section('content')
    <div class="tabla-evento">
        <div class="mb-3">
            <form method="GET" action="{{ route('evento.inicio') }}" class="search-form">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                    placeholder="Buscar por nombre">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </form>
        </div>


        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Description</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Capacidad </th>
                    <th scope="col" class="acciones">Reservar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($evento as $dato)
                    <tr>
                        <th scope="row">{{ $dato->id }}</th>
                        <td>{{ $dato->nombre }}</td>
                        <td>{{ $dato->description }}</td>
                        <td>{{ $dato->fecha_evento }}</td>
                        <td>{{ $dato->capacidad_maxima }}</td>
                        <td>
                            <button class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#eventoModal{{ $dato->id }}">
                                <i class="fas fa-calendar-check"></i>
                            </button>

                            <button class="btn btn-info" data-bs-toggle="modal"
                                data-bs-target="#mapaModal{{ $dato->id }}" style="margin-top: 5px">
                                <i class="fas fa-map-marker-alt"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $evento->links() }}
        </div>
    </div>
    @foreach ($evento as $dato)
        <div class="modal fade" id="mapaModal{{ $dato->id }}" tabindex="-1"
            aria-labelledby="mapaModalLabel{{ $dato->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mapaModalLabel{{ $dato->id }}">Ubicación del Evento:
                            {{ $dato->nombre }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="direccion"><p>Direccion: {{$dato->direccion}}-{{$dato->localidad}} </p></div>
                        <div id="map{{ $dato->id }}" style="height: 300px;"></div>
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                const direccion = "{{ $dato->direccion }}";
                                const localidad = "{{ $dato->localidad }}";
                                obtenerCoordenadas(direccion, localidad, {{ $dato->id }});
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
                                setTimeout(() => {
                                    var map = L.map('map' + eventoId).setView([lat, lon], 15);

                                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                        attribution: '&copy; OpenStreetMap contributors'
                                    }).addTo(map);

                                    L.marker([lat, lon]).addTo(map)
                                        .bindPopup("Ubicación del evento")
                                        .openPopup();
                                    setTimeout(() => {
                                        map.invalidateSize();
                                    }, 300);
                                }, 200);
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($evento as $dato)
        <div class="modal fade" id="eventoModal{{ $dato->id }}" tabindex="-1"
            aria-labelledby="eventoModalLabel{{ $dato->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="eventoModalLabel{{ $dato->id }}">Asistir al Evento:
                            {{ $dato->nombre }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Estás por asistir al evento <strong>{{ $dato->nombre }}</strong>.</p>
                        <p><strong>Descripción:</strong> {{ $dato->description }}</p>
                        <hr>

                        <div class="formulario-inscripcion">
                            <form action="{{ route('evento.reservar', $dato->id) }}" method="post">
                                @csrf
                                <input type="hidden" name="evento_id" value="{{ $dato->id }}">

                                <div class="mb-3">
                                    <label for="cantidad{{ $dato->id }}" class="form-label">Cantidad de
                                        reservas</label>
                                    <input type="number" class="form-control" id="cantidad{{ $dato->id }}"
                                        name="cantidad" min="1" max="{{ $dato->capacidad_maxima }}" value="1"
                                        required>
                                    <div id="cantidad{{ $dato->id }}Help" class="form-text">Selecciona la cantidad de
                                        reservas que deseas hacer (máximo
                                        {{ $dato->capacidad_maxima - $dato->reservas_actuales }} plazas disponibles).</div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-success">Confirmar Asistencia</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
