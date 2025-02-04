@extends('admin.admin-dashboard')

@section('title', 'Administración')

@section('content')
    <div class="container">
        <div class="tabla-evento">
            <div class="table-responsive">
                <div class="addEvento">
                    <a href="/administracion/addEvent" class="agregar-evento btn btn-primary">
                        <i class="fas fa-plus-circle"></i> Agregar Evento
                    </a>
                </div>
                <div class="buscador mb-3">
                    <form method="GET" action="{{ route('admin.admin') }}" class="search-form">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                            placeholder="Buscar por nombre">
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </form>
                </div>
                <table class="table tabla-style table-bordered table-hover shadow-lg rounded">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Capacidad</th>
                            <th scope="col" class="acciones">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($eventos as $dato)
                            <tr>
                                <td>{{ $dato->nombre }}</td>
                                <td>{{ $dato->description }}</td>
                                <td>{{ $dato->fecha_evento }}</td>
                                <td>{{ $dato->capacidad_maxima }}</td>
                                <td>
                                    <div class="d-flex">

                                        <button class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#eventoModalEditar{{ $dato->id }}">
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>

                                        <button class="btn-eliminar btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#eventoModalEliminar{{ $dato->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <div class="modal fade" id="eventoModalEditar{{ $dato->id }}" tabindex="-1"
                                aria-labelledby="eventoModalEditarLabel{{ $dato->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="eventoModalEditarLabel{{ $dato->id }}">Editar
                                                Evento
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('admin.update', $dato->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-3">
                                                    <label for="nombre" class="form-label">Nombre del Evento</label>
                                                    <input type="text" class="form-control" id="nombre" name="nombre"
                                                        value="{{ $dato->nombre }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="description" class="form-label">Descripción</label>
                                                    <textarea class="form-control" id="description" name="description" rows="3" required>{{ $dato->description }}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="fecha_evento" class="form-label">Fecha del Evento</label>
                                                    <input type="datetime-local" class="form-control" id="fecha_evento"
                                                        name="fecha_evento" value="{{ $dato->fecha_evento }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="localidad" class="form-label">Localidad</label>
                                                    <input type="text" class="form-control" id="localidad"
                                                        name="localidad" value="{{ $dato->localidad }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="direccion" class="form-label">Dirección</label>
                                                    <input type="text" class="form-control" id="direccion"
                                                        name="direccion" value="{{ $dato->direccion }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="capacidad_maxima" class="form-label">Capacidad
                                                        Máxima</label>
                                                    <input type="number" class="form-control" id="capacidad_maxima"
                                                        name="capacidad_maxima" value="{{ $dato->capacidad_maxima }}"
                                                        required>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Actualizar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal para eliminar -->
                            <div class="modal fade" id="eventoModalEliminar{{ $dato->id }}" tabindex="-1"
                                aria-labelledby="eventoModalEliminarLabel{{ $dato->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="eventoModalEliminarLabel{{ $dato->id }}">
                                                Eliminar
                                                Evento</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>¿Estás seguro de que quieres eliminar este evento?</p>
                                            <form method="POST" action="{{ route('admin.destroy', $dato->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancelar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $eventos->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
