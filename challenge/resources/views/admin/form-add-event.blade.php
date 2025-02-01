@extends('admin.admin-dashboard')

@section('content')
<div class="container container-form">
    <h2 class="mb-4 text-center">Agregar Evento</h2>
    <form method="POST" action="{{ route('admin.store') }}">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="nombre" class="form-label">Nombre del Evento</label>
                <input type="text" class="form-control form-input" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="fecha_evento" class="form-label">Fecha del Evento</label>
                <input type="datetime-local" class="form-control form-input" id="fecha_evento" name="fecha_evento" value="{{ old('fecha_evento') }}" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea class="form-control form-input" id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="localidad" class="form-label">Localidad</label>
                <input type="text" class="form-control form-input" id="localidad" name="localidad" value="{{ old('localidad') }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" class="form-control form-input" id="direccion" name="direccion" value="{{ old('direccion') }}" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="capacidad_maxima" class="form-label">Capacidad Máxima</label>
            <input type="number" class="form-control form-input" id="capacidad_maxima" name="capacidad_maxima" value="{{ old('capacidad_maxima') }}" required>
        </div>

        <button type="submit" class="btn form-btn w-100">Agregar Evento</button>
    </form>
</div>


@endsection