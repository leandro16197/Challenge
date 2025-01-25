$(document).ready(function () {

    const loggedInUserId = $('#loggedInUserId').val();
    var table = $('.table-dataTable').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: {
            url: "/users-list",
            type: 'GET',
        },
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
        },
        pageLength: 10,
        responsive: true,
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'nombre' },
            { data: 'username', name: 'username' },
            { data: 'rol', name: 'rol' },
            {
                data: null,
                render: function (data, type, row) {
                    if (row.id == loggedInUserId) {
                        return '';
                    }
                    return `
                        <button class="btn btn-danger btn-eliminar" data-id="${row.id}" data-username="${row.username}">
                            <i class="fa fa-trash"></i>
                        </button>
                      <button class="btn btn-modificar" data-id="${row.id}" data-username="${row.username}">

                            <i class="fa fa-edit"></i>
                        </button>
                    `;
                },
                orderable: false,
                searchable: false
            }
        ]
    });

    let idSeleccionado = null;
    let usernameSeleccionado = "";

    $('.table-dataTable').on('click', '.btn-eliminar', function () {
        idSeleccionado = $(this).data("id");
        usernameSeleccionado = $(this).data("username");
        $('#nombreUsuarioEliminar').text(usernameSeleccionado);
        $("#confirmarEliminarModal").modal("show");
    });
    $('.table-dataTable').on('click', '.btn-modificar', function () {
        idSeleccionado = $(this).data("id");
        usernameSeleccionado = $(this).data("username");
        $('#nombreUsuarioModificar').text(usernameSeleccionado);  
        $("#confirmarUpdate").modal("show");
    });


    $("#confirmarEliminarBtn").on("click", function () {
        if (idSeleccionado) {
            $.ajax({
                url: `/delete-user/${idSeleccionado}`,
                type: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                success: function (response) {
                    console.log(`El usuario ${usernameSeleccionado} fue eliminado correctamente.`);
                    $('#confirmarEliminarModal').modal('hide');
                    table.ajax.reload();
                },
                error: function (xhr) {
                    console.log("Hubo un problema al intentar eliminar el usuario.");
                }
            });
        }
    });
    
    $("#confirmarUpdate").on("click",function(){
        if(idSeleccionado){
            $.ajax({
                url: `/modificar-user/${idSeleccionado}`,
                type: "PUT",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                success: function (response) {
                    console.log(`Al usuario ${usernameSeleccionado} se cambio el rol correctamente.`);
                    $('#confirmarUpdate').modal('hide');
                    table.ajax.reload();
                },
                error: function (xhr) {
                    console.log("Hubo un problema al intentar cambiar el rol de el usuario.");
                }
            });
        }
    });
});
