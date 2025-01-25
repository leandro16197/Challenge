@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">

<link rel="stylesheet" type="text/css" href="{{ asset('node_modules/datatables.net-dt/css/jquery.dataTables.css') }}">

@endpush
<div class="general">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-stretch"> <!-- Cambié align-items-start a align-items-stretch -->
        <!-- Formulario de agregar pregunta -->
        <div class="form-preguntas order-2 order-md-1">
            <h1 class="addPreguntas">Agregar Pregunta</h1>
            <form class="form-questionary" action="{{ route('questionary.store') }}" method="POST">
                @csrf
                <div class="container mt-5">
                    <div class="form-container p-4">
                        <!-- Campo de pregunta -->
                        <div class="form-group">
                            <label for="question">Pregunta</label>
                            <input type="text" name="question" id="question" class="form-control" value="{{ old('question') }}" required>
                        </div>

                        <!-- Selección de género -->
                        <div class="form-group">
                            <label for="genero_id">Género</label>
                            <select name="genero_id" id="genero_id" class="form-control" required>
                                <option value="">Seleccionar género</option> <!-- Opción por defecto -->
                            </select>
                        </div>

                        <!-- Contenedor para las respuestas -->
                        <div class="form-group">
                            <label>Respuestas</label>
                            <div class="responses-container">
                                <div class="row mb-3">
                                    @foreach(range(1, 5) as $i)
                                    <!-- Respuesta -->
                                    <div class="col-md-6 d-flex align-items-center">
                                        <input type="text" name="responses[]" id="response_{{ $i }}" class="form-control me-2" placeholder="Respuesta {{ $i }}" value="{{ old('responses.' . ($i - 1)) }}" required>
                                    </div>

                                    <!-- Checkbox -->
                                    <div class="col-md-6 d-flex align-items-center">
                                        <label for="response_{{ $i }}_correct" class="me-2">Verdadero</label>
                                        <input type="checkbox" name="correct_answers[]" value="{{ $i - 1 }}" id="response_{{ $i }}_correct">
                                    </div>

                                    <!-- Cerrar la fila después de cada dos respuestas -->
                                    @if($i % 2 == 0 && $i < 5)
                                        </div>
                                        <div class="row mb-3">
                                            @endif
                                            @endforeach
                                        </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Agregar Pregunta</button>
                            </div>
                        </div>
                    </div>
            </form>
        </div>

        <!-- Formulario de agregar género -->
        <div class="addGenero order-1 order-md-2 mt-0"> <!-- Cambié mt-4 a mt-0 para evitar el desplazamiento -->
            <div class="generos">
                <h1 class="addPreguntas">Agregar Género</h1>
                <form class="form-questionary questionary_genero" id="addGeneroForm" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="addGenero-nombre" for="name">Nombre del Género:</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="addGenero-imagen addGenero-nombre" for="image">Imagen del Género:</label>
                        <input type="file" id="image" name="image" class="form-control" accept="image/*" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Agregar Género</button>
                </form>

            </div>
            <div class="table-generos-style">
                <table class="table-generos">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Modal para modificar -->
<div class="modal fade" id="modalModificarGenero" tabindex="-1" aria-labelledby="modalModificarGeneroLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalModificarGeneroLabel">Modificar Género</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form  enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="genero-id">
                    <div class="form-group mb-3">
                        <label for="genero-name">Nombre del Género</label>
                        <input type="text" id="genero-name" class="form-control" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button id="guardar-cambios" type="button" class="btn btn-primary">Guardar Cambios</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para eliminar -->
<div class="modal fade" id="modalEliminarGenero" tabindex="-1" aria-labelledby="modalEliminarGeneroLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEliminarGeneroLabel">Eliminar Género</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger btn-confirmar-eliminar">Eliminar</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/edit_update.js') }}"></script>
@endpush
<script>
    document.getElementById('addGeneroForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(this);

        fetch('api/generos/agregar', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Solo si usas Laravel y necesitas CSRF
                },
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);

                if (data.status == 201) {
                    if (data.genero && data.genero.id && data.genero.name) {
                        const select = document.getElementById('genero_id');
                        const newOption = document.createElement('option');
                        newOption.value = data.genero.id;
                        newOption.textContent = data.genero.name;
                        select.appendChild(newOption);
                    } else {
                        console.log('Error: Los datos del género no están completos', data);
                    }
                } else {
                    console.log('Error al agregar género:', data);
                }
            })
            .catch(error => console.error('Error:', error));
    });



    document.addEventListener('DOMContentLoaded', function() {
        fetch('api/generos')
            .then(response => response.json())
            .then(data => {


                const select = document.getElementById('genero_id');
                select.innerHTML = '<option value="">Seleccionar género</option>';


                data.data.forEach(genero => {
                    const option = document.createElement('option');
                    option.value = genero.id;
                    option.textContent = genero.name;
                    select.appendChild(option);
                });
            })
            .catch(error => console.error('Error al cargar los géneros:', error));
    });


</script>