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
        @foreach ($eventos->eventos as $evento)
            <div class="card-style col-md-4 col-sm-12 mb-3 d-flex"> 
                <div class="card flex-fill d-flex flex-column">
                    <div class="card-body flex-grow-1">
                        <h5 class="card-title">{{ $evento->nombre }}</h5>
                        <p class="card-text">{{ $evento->description }}</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><p>Fecha y hora : {{ \Carbon\Carbon::parse($evento->fecha_evento)->format('d/m/y H:i') }}</p></li>
                        <li class="list-group-item">{{ $evento->description }}</li>
                        <li class="list-group-item">
                            <p>
                                
                                Localidad : {{ $evento->localidad }}
                                
                            </p>
                        </li>
                        <li class="list-group-item">
                            <p>
                                 Direccion : {{ $evento->direccion }}
                            </p>
                        </li>
                        <li class="list-group-item">
                            <p>Cantidad de reservas: {{ $evento->pivot->cantidad }}</p>
                        </li>
                    </ul>
                    <!-- Botón para abrir el modal -->
                    <div class="card-footer text-center">
                        <button type="button" class="btn btn-danger" 
                            data-bs-toggle="modal" 
                            data-bs-target="#confirmarEliminar"
                            data-id="{{ $evento->pivot->id }}"
                            data-nombre="{{ $evento->nombre }}">
                            Eliminar Reserva
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
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
