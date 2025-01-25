
$(document).ready(function () {
    var table = $('.table-dataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "/questions/data",
            type: 'GET',
        },
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
        },
        pageLength: 10,
        responsive: true,
        columns: [{
            data: 'id',
            name: 'id'
        },
        {
            data: 'question',
            name: 'question'
        },
        {
            data: 'genero_name',
            name: 'name'
        },
        {
            data: null,
            render: function (data, type, row) {
                return `
                    <button class="btn btn-danger btn-eliminar" data-id="${row.id}">
                        <i class="fa fa-trash"></i>
                    </button>
                    <button class="btn btn-modificar btn-modificar" data-id="${row.id}">
                        <i class="fa fa-edit"></i>
                    </button>
                `;
            },
            orderable: false,
            searchable: false
        }]
    });


    $('.table-dataTable').on('click', '.btn-modificar', function () {
        var id = $(this).data('id');
        if (!id) {
            console.error("El ID no está definido.");
            return;
        }
        $.ajax({
            url: '/dato/' + id,
            method: 'GET',
            success: function (response) {
                const question = response.data.question;
                const responses = response.data.respuestas;
                console.log(question);
                console.log(responses);
                if (response && response.data) {
                    $.ajax({
                        url: '/api/generos',
                        method: 'GET',
                        success: function (response) {

                            console.log(response);


                            if (Array.isArray(response.data)) {
                                let generos = response.data;

                                let formHtml = `
                                    <!-- Campo oculto para simular el método PUT -->
                                    <div class="form-group">
                                        <label for="question-input">Pregunta</label>
                                        <input type="hidden" id="question-input" name="question_id" class="form-control" value="${question.question_id}">
                                        <input type="text" id="pregunta-input" name="question" class="form-control" value="${question.pregunta}">
                                    </div>
                    
                                    <div class="form-group">
                                        <label for="genero-input">Género</label>
                                        <label>Cambiar Género</label>
                                        <select name="genero_id" class="form-control">
                                            ${generos.map(gen => `
                                                <option value="${gen.id}" ${question.genero_id == gen.id ? 'selected' : ''}>${gen.name}</option>
                                            `).join('')}
                                        </select>
                                    </div>
                    
                                    <div class="form-group">
                                        <label>Respuestas:</label>
                                        <div id="responses-container">
                                            ${Array.isArray(responses) ? responses.map(resp => `
                                                <div class="form-check">
                                                    <input type="radio" id="response-${resp.id}" name="correct_answers[]" value="${resp.id}" class="form-check-input" ${resp.is_correct ? 'checked' : ''}>
                                                    <input type="hidden" name="responses[${resp.id}][id]" value="${resp.id}">
                                                    <input type="text" name="responses[${resp.id}][text]" class="form-control response-input" value="${resp.respuest}">
                                                    <label for="response-${resp.id}" class="form-check-label">Verdadero</label>
                                                </div>
                                            `).join('') : '<p style="color: red;">No se encontraron respuestas disponibles.</p>'}
                                        </div>
                                    </div>
                    
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                `;

                                $('#modalModificar .content-form').html(formHtml);
                                $('#modalModificar').modal('show');
                            } else {
                                console.error('La propiedad "data" no contiene un array:', response);
                                $('#response-container').html('<p style="color: red;">Error al obtener los géneros. Datos incorrectos.</p>');
                            }
                        },
                        error: function (error) {
                            console.error("Error al obtener los géneros:", error);
                            $('#response-container').html('<p style="color: red;">Error al obtener los géneros.</p>');
                        }
                    });

                } else {
                    console.error("La respuesta no contiene datos válidos.");
                    $('#response-container').html('<p style="color: red;">No se encontraron datos.</p>');
                }
            },
            error: function (error) {
                console.error("Error al realizar la solicitud:", error);
                $('#response-container').html('<p style="color: red;">Error al obtener los datos.</p>');
            }
        });
    });


    $(document).ready(function () {
        let questionId = null;


        $(document).on('click', '.btn-eliminar', function () {
            questionId = $(this).data('id');
            $('#deleteModal').modal('show');
        });

        $('#confirmDelete').click(function () {
            if (questionId !== null) {
                $.ajax({
                    url: '/eliminar-questionary/' + questionId,
                    type: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        if (response.status === 'success') {
                            $('#deleteModal').modal('hide');
                            table.ajax.reload(null, false);

                        } else {
                            alert(response.message);
                        }
                    },
                    error: function (xhr, status, error) {
                        console.log('Hubo un error al intentar eliminar la pregunta.');
                        console.log(xhr.responseText);
                    }
                });
            }
        });

    });


    var tablaGeneros = $('.table-generos').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "/api/generos",
            type: 'GET',
        },
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
        },
        pageLength: 5,
        responsive: true,
        columns: [
            {
                data: 'id',
                name: 'id'
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: null,
                render: function (data, type, row) {
                    return `
                    <button class="btn-eliminar-genero btn btn-danger btn-eliminar" data-id="${row.id}" >
                        <i class="fa fa-trash"></i>
                    </button>
                    <button class="btn-modificar-genero btn btn-modificar" data-id="${row.id}">
                        <i class="fa fa-edit"></i>
                    </button>
                `;
                },
                orderable: false,
                searchable: false
            }
        ]
    });
    $('body').on('click', '.btn-eliminar-genero', function () {
        var generoId = $(this).data('id');

        $('#modalEliminarGenero').find('.modal-body').html(`
            ¿Estás seguro de que deseas eliminar el género con ID ${generoId}?
        `);
        $('#modalEliminarGenero').find('.btn-confirmar-eliminar').data('id', generoId);

        $('#modalEliminarGenero').modal('show');
    });




    $('body').on('click', '.btn-confirmar-eliminar', function () {
        var generoId = $(this).data('id');

        $('body').on('click', '.btn-confirmar-eliminar', function () {
            var generoId = $(this).data('id');

            $.ajax({
                url: '/api/generos/' + generoId,
                method: 'DELETE',
                success: function (response) {
                    console.log('Respuesta del servidor:', response);
                    if (response.status === '200') {
                        tablaGeneros.ajax.reload(null, false);
                        $('#modalEliminarGenero').modal('hide');
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error al eliminar el género:', error);
                    alert('Error al eliminar el género');
                }
            });
        });

    });

    $('body').on('click', '.btn-modificar-genero', function () {
        var generoId = $(this).data('id');
        console.log('ID del género:', generoId);


        $('#genero-id').val(generoId);

        $.ajax({
            url: '/api/generos/' + generoId,
            method: 'GET',
            success: function (data) {
                console.log('Datos del género:', data);


                $('#genero-name').val(data.nombre);

                $('#modalModificarGenero').modal('show');
            },
            error: function () {
                alert('Error al obtener los datos del género');
            }
        });
    });
    $('body').on('click', '#guardar-cambios', function () {
        var generoId = $('#genero-id').val();
        var generoNombre = $('#genero-name').val();
        if (!generoNombre) {
            alert('Por favor, ingresa un nombre para el género');
            return;
        }
        fetch('/api/generos/modificar/' + generoId, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                nombre: generoNombre
            })
        })
            .then(response => response.json())
            .then(data => {
                console.log('Género actualizado con éxito:', data);
                tablaGeneros.ajax.reload(null, false);
                $('#modalModificarGenero').modal('hide');
            })
            .catch(error => {
                console.log('Error al actualizar el género:', error);
            });

    });



});