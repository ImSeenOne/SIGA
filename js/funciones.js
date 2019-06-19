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
            loadDataTable('listDesarrolloss', true);
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




//FUNCIONES++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
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