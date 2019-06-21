let cargando  = "<center><img src='img/cargaa.gif' width='25px' /><br>Cargando ...</center>";
let guardando = "<center><img src='img/cargaa.gif' width='25px' /><br>Guardando ...</center>";
let eliminando= "<center><img src='img/cargaa.gif' width='25px' /><br>Eliminando ...</center>";
let urlPag;
let urlConsultas = 'php/consultas.php';
let urlSubir     = 'php/subir.php';
let urlEliminar  = 'php/eliminar.php';
let dataTable;
let currentPage;


function selectFrm(clase){
	$('.' + clase).select2({
      placeholder: 'Seleccionar...'
    });
}

function activaDatePicker(elemento){
	$('#' + elemento).datepicker({
      autoclose: true,
      language: "es",
      today: "Today",
      clear: "Clear",
      format: "dd-mm-yyyy"
    })
}

$.fn.datepicker.dates['es'] = {
        days: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
        daysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
        daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
        months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Deciembre"],
        monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
        //titleFormat: "MM yyyy", /* Leverages same syntax as 'format' */
};

$('#btnNvoPago, #btnCancelaPago').click(function(){
	$('#frmPago').slideToggle();
	$('#btnNvoPago').slideToggle();
});

$('#btnNvoGasto, #btnCancelaGasto').click(function(){
	$('#frmGasto').slideToggle();
	$('#btnNvoGasto').slideToggle();
});

$('#btnBusquedaGastos').click(function(){
	$('#frmBusquedaGasto').slideToggle();
});



//CATÁLOGOS INMOBILIARIA +++++++++++++++++++++++++++++++++++++++++++++++++++++

//CATÁLOGO DESARROLLOS
$('#btnNvoDesarrollo, #btnCancelarDesarrollo').click(function(){
  $('#frmDesarrollo').slideToggle();
  $('#btnNvoDesarrollo').slideToggle();
  $('#txtNombre').focus();
});


function desarrollo_listado(){
  urlPag = 'pg/desarrollo_listado.php';

  $.ajax({
        beforeSend: function(){
            $("#cntnListPagos").html(cargando);
        },
        type:    "post",
        url:     urlPag,
        //data:    params,
        dataType: 'html',
        success: function(data){
            $('#cntnListPagos').html(data);
            loadDataTable('listDesarrollo', true);
        }
  });
}





//CATÁLOGO ANTIGÜEDAD
function antiguedad_listado(){
  urlPag = 'pg/antiguedad_listado.php';

  $.ajax({
        beforeSend: function(){
            $("#cntnListAntiguedad").html(cargando);
        },
        type:    "post",
        url:     urlPag,
        //data:    params,
        dataType: 'html',
        success: function(data){
            $('#cntnListAntiguedad').html(data);
            loadDataTable('listAntiguedad', true);
        }
  });
}





//CATÁLOGO COCINA
function cocina_listado(){
  urlPag = 'pg/cocina_listado.php';

  $.ajax({
        beforeSend: function(){
            $("#cntnListCocina").html(cargando);
        },
        type:    "post",
        url:     urlPag,
        //data:    params,
        dataType: 'html',
        success: function(data){
            $('#cntnListCocina').html(data);
            loadDataTable('listCocina', true);
        }
  });
}




//CATÁLOGO CALIDAD ACABADO
function calidad_acabado_listado(){
  urlPag = 'pg/calidad_acabado_listado.php';

  $.ajax({
        beforeSend: function(){
            $("#cntnListCalidadAcabado").html(cargando);
        },
        type:    "post",
        url:     urlPag,
        //data:    params,
        dataType: 'html',
        success: function(data){
            $('#cntnListCalidadAcabado').html(data);
            loadDataTable('listCalidadAcabado', true);
        }
  });
}





//CATÁLOGO CLOSETS LISTADO
function closets_listado(){
  urlPag = 'pg/closets_listado.php';

  $.ajax({
        beforeSend: function(){
            $("#cntnListClosets").html(cargando);
        },
        type:    "post",
        url:     urlPag,
        //data:    params,
        dataType: 'html',
        success: function(data){
            $('#cntnListClosets').html(data);
            loadDataTable('listCloset', true);
        }
  });
}




//CATÁLOGO ESTACIONAMIENTO
function estacionamiento_listado(){
  urlPag = 'pg/estacionamiento_listado.php';

  $.ajax({
        beforeSend: function(){
            $("#cntnListEstacionamiento").html(cargando);
        },
        type:    "post",
        url:     urlPag,
        //data:    params,
        dataType: 'html',
        success: function(data){
            $('#cntnListEstacionamiento').html(data);
            loadDataTable('listEstacionamiento', true);
        }
  });
}


//addEstacionamiento
$('#btnGuadaEstacionamiento').click(function(){
    if($('#txtNombre').val().length < 1){
      $('#txtNombre').focus();
      $('#reqTxtNombre').html('*');
      return false;
    }else{
      $('#reqTxtNombre').empty();
    }

    let formData = new FormData(document.getElementById("frmEstacionamiento"));

    $.ajax({
      beforeSend: function(){
        $("#respServer").html(guardando);
      },
      url: urlSubir,
      type: "post",
      dataType: "json",
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      success: function(resp){
          $("#respServer").empty();
          console.log(resp);
          if(resp.resp == 1){
            estacionamiento_listado();
            $('#opcion').val(201);
            resetForm('frmEstacionamiento');
          }else{
            $("#respServer").html('Ocurrió un error al intentar guardar en la base de datos');
          }
      }
    });
});



//ESTA FUNCIÓN EDITA UN ESTACIONAMIENTO
function editarRegEstacionamiento(id){
  let params = {'id':id, 'opt':201}
  $.ajax({
        beforeSend: function(){
            $("#respServer").html(cargando);
        },
        type:    "post",
        url:     urlConsultas,
        data:    params,
        dataType: 'json',
        success: function(resp){
            console.log(resp);
            $('#respServer').empty('');
            $('#txtNombre').val(resp.nombre);
            $('#hdFlIcono').val(resp.icono);
            $('#idEstacionamiento').val(resp.id_estacionamiento);
            $('#opcion').val(202);
        }
  });
}


function eliminarRegEstacionamiento(id, icono, nombre){
  swal({
        html: true,
        title: "¿Está seguro?",
        text: "eliminar el registro <strong>" + nombre + "</strong>",
        type: "warning",
        showCancelButton: true,
        cancelButtonClass: "btn-primary",
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Aceptar",
        cancelButtonText: "Cancelar",
        closeOnConfirm: true
      },
      function(){
          let params = {'id':id, 'icono':icono, 'opt':1};
          $.ajax({
              type:    "post",
              url:     urlEliminar,
              data:    params,
              dataType: 'json',
              success: function(resp){
                    console.log(resp);
                    if(resp.resp == 1){
                        estacionamiento_listado();
                    }
              }
          });
      });
}


$('#btnCancelar').click(function(){
  resetForm('frmEstacionamiento');
});

//ESTA FUNCIÓN AGREGA UN NUEVO DESARROLLO
$('#btnGuardaDesarrollo').click(function(){
    if($('#txtNombre').val().length < 1){
      $('#txtNombre').focus();
      $('#reqTxtNombre').html('Este campo es requerido');
      return false;
    }else{
      $('#reqTxtNombre').empty();
    }

    let formData = new FormData(document.getElementById("frmDesarrollo"));

    $.ajax({
      beforeSend: function(){
        $("#respServer").html(guardando);
      },
      url: urlSubir,
      type: "post",
      dataType: "json", //<---- REGRESAR A JSON
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      success: function(resp){
				console.log(resp);
          $("#respServer").empty();
          if(resp.resp == 1){
            desarrollo_listado();
            $('#opcion').val(1);
            resetForm('frmDesarrollo');
          }else{
            $("#respServer").html('Ocurrió un error al intentar guardar en la base de datos');
          }
      }
    });
});

//ESTA FUNCIÓN EDITA UN DESARROLLO

function editarRegDesarrollo(id){
  let params = {'id':id, 'opt':1}
  $.ajax({
        beforeSend: function(){
            $("#respServer").html(cargando);
        },
        type:    "post",
        url:     urlConsultas,
        data:    params,
        dataType: 'json',
        success: function(resp){
            console.log(resp);
            $('#respServer').empty('');
            $('#txtNombre').val(resp.nombre);
						$('#txtAlias').val(resp.alias);
						$('#txtCp').val(resp.codigo_postal);
            $('#hdFlIcono').val(resp.icono);
            $('#idDesarrollo').val(resp.id_desarrollo);
            $('#opcion').val(2);
						$('#frmDesarrollo').slideToggle();
					  $('#btnNvoDesarrollo').slideToggle();
					  $('#txtNombre').focus();
        }
  });
}


function eliminarRegDesarrollo(id, icono, nombre){
  swal({
        html: true,
        title: "¿Está seguro?",
        text: "eliminar el registro <strong>" + nombre + "</strong>",
        type: "warning",
        showCancelButton: true,
        cancelButtonClass: "btn-primary",
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Aceptar",
        cancelButtonText: "Cancelar",
        closeOnConfirm: true
      },
      function(){
          let params = {'id':id, 'icono':icono, 'opt':1};
          $.ajax({
              type:    "post",
              url:     urlEliminar,
              data:    params,
              dataType: 'json',
              success: function(resp){
                    console.log(resp);
                    if(resp.resp == 1){
                        desarrollo_listado();
                    }
              }
          });
      });
}



//CATÁLOGO NÚMERO DE BAÑOS
function wc_listado(){
  urlPag = 'pg/wc_listado.php';

  $.ajax({
        beforeSend: function(){
            $("#cntnListWc").html(cargando);
        },
        type:    "post",
        url:     urlPag,
        //data:    params,
        dataType: 'html',
        success: function(data){
            $('#cntnListWc').html(data);
            loadDataTable('listWc', true);
        }
  });
}





//SERVICIOS Y AMENIDADES
function servicio_amenidades_listado(){
  urlPag = 'pg/wc_listado.php';

  $.ajax({
        beforeSend: function(){
            $("#cntnListServicioAmenidades").html(cargando);
        },
        type:    "post",
        url:     urlPag,
        //data:    params,
        dataType: 'html',
        success: function(data){
            $('#cntnListServicioAmenidades').html(data);
            loadDataTable('listAmenidades', true);
        }
  });
}



//FUNCIONES++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function resetForm(formulario){
  $('#'+formulario)[0].reset();
}



function loadDataTable(table, busqueda, setPage = ''){
    dataTable = '';
    dataTable = $('#'+table).DataTable({
      'order': [[ 0, "desc" ]],
      "sPaginationType": "full_numbers",
      'paging'      : true,
      'lengthChange': true,
      'searching'   : busqueda,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      "language": {
              "search":"Buscar:",
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "Lo sentimos, no se encontraron resultados",
            "info": "Página _PAGE_ de _PAGES_",
            "infoEmpty": "No existen registros",
            "infoFiltered": "(filtrado de _MAX_ total registros)",
            "paginate": {
                "first":      "Primero",
                "last":       "Último",
                "next":       "Siguiente",
                "previous":   "Anterior"
            }
        }
      });
        if(setPage !== ''){
            setTimeout( function () {
                dataTable.page(setPage).draw('page');
            }, 10 );
        }
}


function frmNumerico(elemento){
	$('#' + elemento).mask('000,000,000,000,000.00', {reverse: true});
}
