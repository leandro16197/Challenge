@extends('admin.admin-dashboard')

@section('title', 'Administración')
@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="tabla-evento">
            <div class="table-responsive">
                <div class="buscador mb-3">
                    <form method="GET" action="{{ route('admin.users') }}" class="search-form">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                            placeholder="Buscar por nombre">
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </form>
                </div>
                <table class="table tabla-style table-bordered table-hover shadow-lg rounded">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Email</th>
                            <th scope="col">Rol</th>
                            <th scope="col">Localidad</th>
                            <th scope="col" class="acciones">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuarios as $dato)
                            <tr>
                                <td>{{ $dato->name }}</td>
                                <td>{{ $dato->email }}</td>
                                @if ($dato->rol == 1)
                                    <td>Administrador</td>
                                @endif
                                @if ($dato->rol == 2)
                                    <td>Usuario</td>
                                @endif
                                <td>{{ $dato->localidad }}</td>
                                <td>
                                    <div class="d-flex">
                                        <div class="mod-rol">
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal" data-user-id="{{ $dato->id }}">
                                                <i class="fas fa-user-shield"></i>
                                            </button>
                                        </div>

                                        <div class="delete-user">
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal" data-user-id="{{ $dato->id }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                        </div>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Confirmar acción</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                ¿Seguro que quiere cambiar los permisos de acceso?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <form id="confirmForm" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-primary">Confirmar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Eliminar Usuario</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                ¿Está seguro de que desea eliminar este usuario? Esta acción no se puede deshacer.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <form id="deleteForm" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-center">
                    {{ $usuarios->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let modal = document.getElementById("exampleModal");
        modal.addEventListener("show.bs.modal", function(event) {
            let button = event.relatedTarget;
            let userId = button.getAttribute("data-user-id");
            let form = document.getElementById("confirmForm");
            form.action = `/administracion/usuarios/${userId}`;
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        let deleteModal = document.getElementById("deleteModal");
        deleteModal.addEventListener("show.bs.modal", function(event) {
            let button = event.relatedTarget;
            let userId = button.getAttribute("data-user-id");
            let form = document.getElementById("deleteForm");
            form.action = `/administracion/usuarios/${userId}`;
        });
    });
</script>
