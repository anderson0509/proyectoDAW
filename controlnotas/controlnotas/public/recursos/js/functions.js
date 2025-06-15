function generateDataTable(ruta, columnas, mostrarPdf = false) {
  var columnDefs = [
    {
      targets: 0,
      className: 'text-start',
    },
    {
      targets: -1,
      data: null,
      orderable: false,
      className: 'text-center',
      render: function (data, type, row) {
        botones = `<a class="btn btn-dark btn-sm edit"  path="/${row.path}/${data}/edit">
                    <i class="fa fa-pencil"></i></a>
                  <a class="btn btn-danger btn-sm delete" path="/${row.path}/${data}">
                    <i class="fa fa-trash"></i></a>`;

                    // Agregar botón de expediente solo si es la vista de alumnos
        if (typeof row.path !== 'undefined' && row.path === 'alumnos') {
          botones += `<a href="/expediente/${data}" class="btn btn-info btn-sm ms-1">
                      <i class="fa fa-file-alt"></i>
                    </a>`;
        }
        return botones;
      },
    }
  ];

  // Solo agregamos la columna de PDF si mostrarPdf es true
  if (mostrarPdf) {
    columnDefs.splice(1, 0, {
      targets: -2, // Columna del botón de PDF individual
      data: null,
      orderable: false,
      className: 'text-center',
      render: function (data, type, row) {
        return `<a href="/notas/pdf-individual/${data}" class="btn btn-danger btn-sm">
                  <i class="fa fa-file-pdf-o"></i> PDF
                </a>`;
      },
    });

    // Ajustamos el target de la columna de acciones a -1
    columnDefs[2].targets = -1;
  }

  var dt = $("#datatables").DataTable({
    "processing": true,
    "serverSide": true,
    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, 'All']],
    "language": {
      "lengthMenu": "Mostrar _MENU_ filas por página",
      "zeroRecords": "No se han encontrado resultados",
      "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
      "infoEmpty": "No hay datos para mostrar",
      "infoFiltered": "(Filtrado de _MAX_ registros en total)",
      "sInfoEmpty": "Mostrando 0 a 0 de 0 filas",
      "search": "Buscar:",
      "paginate": {
        "first": "Primera",
        "last": "Ultima",
        "next": "Siguiente",
        "previous": "Anterior"
      }
    },
    "ajax": {
      url: ruta,
      type: "GET",
      data: function(d) {
        return {
          draw: d.draw,
          start: d.start,
          length: d.length,
          search: { value: d.search.value },
          order: d.order
        };
      }
    },
    "columns": columnas,
    "columnDefs": columnDefs
  });
  return dt;
}
function getAlert(icono, message) {
    Swal.fire({
        position: "top-end",
        icon: icono,
        title: message,
        showConfirmButton: false,
        timer: 2500
      });
}

function addMessageRequired(clases, response){
  mesages = new Array();
  $.each(response, function(i, val){//poner mensajes con indice numerico
    mesages.push(val[0]);
  })
  i = 0;//contador para el array de messages
  $.each(clases, function (index, value) {//recorrer etiquetas donde va mensaje
    keyAttr = $(this).attr('key');
    //verificar si existe la key en el object 
    if(Object.hasOwn(response, keyAttr)){ //(&& keyAttr == names[cont])
      $(this).find('strong').text(mesages[i]);
      i++;//solo aumenta si se agrega el mensaje          
    }else{
      $(this).find('strong').text('');
    }
  });
}

function save_data(url, frm, token) {
  $.ajax({
    type: "POST",
    headers:{
      'X-CSRF-token': token
    },
    url: url,
    data: frm.serialize(),
    dataType: "json"
  })
  .done(function (data) {
    //console.log(data);
    dt.ajax.reload(null, false);//Recargar tabla
    $("#myModal").modal('hide');
    getAlert('success', data.message);
  })
  .fail(function (data) {
    response = data.responseJSON;
    var clases = frm.find('.invalid-feedbanck');
    if(response.code == 422){
      addMessageRequired(clases, response.message);
    }else{
      getAlert('error', response.message);
    }
    //console.log(response);
  });
}

function save_update(url, frm, token) {
  $.ajax({
    type: "PUT",
    headers:{
      'X-CSRF-token': token
    },
    url: url,
    data: frm.serialize(),
    dataType: "json"
  })
  .done(function (data) {
    //console.log(data);
    dt.ajax.reload(null, false);//Recargar tabla
    $("#myModal").modal('hide');
    getAlert('success', data.message);
  })
  .fail(function (data) {
    response = data.responseJSON;
    var clases = frm.find('.invalid-feedbanck');
    if(response.code == 422){
      addMessageRequired(clases, response.message);
    }else{
      getAlert('error', response.message);
    }
    //console.log(response);
  });
}

function delete_data(url, token) {
  $.ajax({
    type: "DELETE",
    headers:{
      'X-CSRF-token': token
    },
    url: url,
    dataType: "json"
  })
  .done(function (data) {
    //console.log(data);
    dt.ajax.reload(null, false);//Recargar tabla
    getAlert('success', data.message);
  })
  .fail(function (data) {

    getAlert('error', data.responseJSON['message']);
    
  });
}