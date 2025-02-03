@extends('evento.home')

@section('content')
<div class="tabla-evento">
    <div class="mb-3">
        <form method="GET" action="{{ route('evento.inicio') }}" class="search-form">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Buscar por nombre">
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
                    <th scope="row">{{$dato->id}}</th>
                    <td>{{$dato->nombre}}</td>
                    <td>{{$dato->description}}</td>
                    <td>{{$dato->fecha_evento}}</td>
                    <td>{{$dato->capacidad_maxima}}</td>
                    <td>
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#eventoModal{{$dato->id}}">
                            reservar
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
<div class="modal fade" id="eventoModal{{$dato->id}}" tabindex="-1" aria-labelledby="eventoModalLabel{{$dato->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventoModalLabel{{$dato->id}}">Asistir al Evento: {{$dato->nombre}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Estás por asistir al evento <strong>{{$dato->nombre}}</strong>.</p>
                <p><strong>Descripción:</strong> {{$dato->description}}</p>
                <hr>
                
                <div class="formulario-inscripcion">
                    <form action="{{ route('evento.reservar', $dato->id) }}" method="post">
                        @csrf
                        <input type="hidden" name="evento_id" value="{{$dato->id}}">

                        <div class="mb-3">
                            <label for="cantidad{{$dato->id}}" class="form-label">Cantidad de reservas</label>
                            <input type="number" class="form-control" id="cantidad{{$dato->id}}" name="cantidad" min="1" max="{{$dato->capacidad_maxima}}" value="1" required>
                            <div id="cantidad{{$dato->id}}Help" class="form-text">Selecciona la cantidad de reservas que deseas hacer (máximo {{$dato->capacidad_maxima - $dato->reservas_actuales}} plazas disponibles).</div>
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

