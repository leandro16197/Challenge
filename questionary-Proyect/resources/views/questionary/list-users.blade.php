@extends('layouts.app')
@section('header')
@section('title', 'questionary')
@endsection

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('node_modules/datatables.net-dt/css/jquery.dataTables.css') }}">

@endpush


@section('content')
<div class="general list-users-style contenedorQuestionList contenedor-principal d-flex">
<input type="hidden" id="loggedInUserId" value="{{ Auth::id() }}">
    <div class="table-style">
        @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        <div class="table-responsive">
            <table class="table-dataTable table table-dark">
                <thead class="style-body-table">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Username</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="style-body-table">
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- confirmar eliminacion -->
<div class="modal fade" id="confirmarEliminarModal" tabindex="-1" aria-labelledby="confirmarEliminarLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered"> 
        <div class="modal-content style-modal-mod-usuarios-delete">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmarEliminarLabel">Confirmar eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <!-- Mensaje dinámico -->
                ¿Estás seguro de que deseas eliminar al usuario <span id="nombreUsuarioEliminar" class="fw-bold"></span>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="confirmarEliminarBtn">Eliminar</button>
            </div>
        </div>
    </div>
</div>
<!-- confirmar eliminacion -->
<div class="modal fade" id="confirmarUpdate" tabindex="-1" aria-labelledby="confirmarEliminarLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered"> 
        <div class="modal-content style-modal-mod-usuarios">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmarUpdate">Cambiar Rol</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <!-- Mensaje dinámico -->
                ¿Estás seguro de que deseas cambiar el rol del Usuario <span id="nombreUsuarioModificar" class="fw-bold"></span>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="confirmarUpdate">Confirmar</button>
            </div>
        </div>
    </div>
</div>

<style>
    .py-4{
        width: 90%;
        height: auto;
    }
</style>

@endsection
@push('scripts')
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<!-- DataTables Responsive -->
<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
<!-- Bootstrap (si se utiliza para los estilos) -->
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/lista_usuarios.js') }}"></script>

@endpush
