$(document).ready(function () {
    
    //Evento para cagar el formulario para cargar categoria
    $(document).on('click', '#addForm', function(){
        let url = $(this).attr('path');
        $("#modalLabel").text("Creando Registro");
        $("#loadForm").load(url);
    });

       //Evento para crear registro
    $(document).on('submit', '#fmrSaveData', function(e){
        e.preventDefault();
        frm = $(this);
        url = $(this).attr('action');
        token =$('input[name="_token"]').val();
        save_data(url, frm, token);
    });

    //Evento para cargar el formulario de actulaizar categorias
    $(document).on('click', '.edit', function(){
        let url = $(this).attr('path');
        $("#modalLabel").text("Actualizando Resgistro");
        $("#loadForm").load(url);
        $("#myModal").modal('show');
    });

       //Evento para editar registro
    $(document).on('submit', '#fmrupdateData', function(e){
        e.preventDefault();
        frm = $(this);
        url = $(this).attr('action');
        token =$('input[name="_token"]').val();
        save_update(url, frm, token);
    });

    //evento para eliminar
    $(document).on('click', '.delete', function(){
        let url = $(this).attr('path');
        token =$('input[name="_token"]').val();
        Swal.fire({
            title: "¿Estas Seguro?",
            text: "¡Si continuas, no podras revertir la acción!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "¡Si, Eliminar!"
            }).then((result) => {
            if (result.isConfirmed) {
                //Peticion para eliminar registro
                delete_data(url, token);
            }
        });
    });

    
});