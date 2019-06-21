// let urlPag;
// let urlConsultas = 'php/consultas.php';
// let urlSubir     = 'php/subir.php';
// let urlEliminar  = 'php/eliminar.php';
// let dataTable;
// let currentPage;


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
//
// $('#btnNvoPago, #btnCancelaPago').click(function(){
// 	$('#frmPago').slideToggle();
// 	$('#btnNvoPago').slideToggle();
// });
//
// $('#btnNvoGasto, #btnCancelaGasto').click(function(){
// 	$('#frmGasto').slideToggle();
// 	$('#btnNvoGasto').slideToggle();
// });
//
// $('#btnBusquedaGastos').click(function(){
// 	$('#frmBusquedaGasto').slideToggle();
// });

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
//****************************************************************
//****************************************************************
//****************************************************************
//****************************************************************



$('#btnNewWork').click(function(){
  $('#frmWork').slideToggle();
  $('#btnNewWork	').slideToggle();
  $('#txtName').focus();
});

$('#btnCancelWork').click(function(){
  $('#frmWork').slideToggle();
  $('#btnNewWork').slideToggle();
  resetForm('frmWork');
});


function work_list(){
  urlPag = 'pg/obras_listado.php';

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
            loadDataTable('listWorks', true);
        }
  });
}

//ESTA FUNCIÓN CHECA SI LA FECHA DE INICIO(date1) ES MENOR O MAYOR, RETORNA FALSO
//SI LA FECHA DE INICIO ES MAYOR
function checkDate(date1, date2) {
	var dateS = date1.split('-');
	var dateF = date2.split('-');
	if( (new Date(dateF[0],dateF[1],dateF[2],).getTime() >= new Date(dateS[0],dateS[1],dateS[2],).getTime())){
      return true;
  }else return false;
}

//ESTA FUNCIÓN CHECA SI EL OBJETO HTML QUE RECIBE ESTÁ VACÍO
function isEmpty(obj){
	if(obj.val().length < 1) {
		opt = true;
	} else {
		opt = false;
	}
	return opt;
}

//ESTA FUNCIÓN AGREGA UNA NUEVA OBRA
$('#btnSaveWork').click(function(){
    if(isEmpty($('#txtName'))){
      $('#txtName').focus();
      $('#reqTxtName').html('Este campo es requerido');
      return false;
    }else{
      $('#reqTxtName').empty();
    }

		if(isEmpty($('#txtDependency'))){
      $('#txtDependency').focus();
      $('#reqTxtDependency').html('Este campo es requerido');
      return false;
    }else{
      $('#reqTxtDependency').empty();
    }

		if(isEmpty($('#inputAmount'))){
      $('#inputAmount').focus();
      $('#reqInputAmount').html('Este campo es requerido');
      return false;
    }else{
      $('#reqInputAmount').empty();
    }

		if(isEmpty($('#date1'))){
      $('#date1').focus();
      $('#reqDateStart').html('Este campo es requerido');
      return false;
    }else{
      $('#reqDateStart').empty();
    }

		if(isEmpty($('#date2'))){
      $('#date2').focus();
      $('#reqDateFinish').html('Este campo es requerido');
      return false;
    }else{
      $('#reqDateFinish').empty();
    }
		if(isEmpty($('#date2'))){
      $('#date2').focus();
      $('#reqDateFinish').html('Este campo es requerido');
      return false;
    }else{
      $('#reqDateFinish').empty();
    }

		if(isEmpty($('#txtFolderVol'))){
      $('#txtFolderVol').focus();
      $('#reqFolderVol').html('Este campo es requerido');
      return false;
    }else{
      $('#reqFolderVol').empty();
    }

		if(isEmpty($('#txtConcreteVol'))){
      $('#txtConcreteVol').focus();
      $('#reqConcreteVol').html('Este campo es requerido');
      return false;
    }else{
      $('#reqConcreteVol').empty();
    }

		if(isEmpty($('#txtWorkArea'))){
      $('#txtWorkArea').focus();
      $('#reqWorkArea').html('Este campo es requerido');
      return false;
    }else{
      $('#reqWorkArea').empty();
    }

		if(!checkDate($('#date1').val(), $('#date2').val())){
			$('#reqDateStart').html('Este fecha no debe ser mayor a la fecha de finalización')
			$('#reqDateFinish').html('Este fecha no debe ser menor a la fecha de inicio')
			return false;
		}

    let formData = new FormData(document.getElementById("frmWork"));

    $.ajax({
      beforeSend: function(){
        $("#respServer").html(guardando);
      },
      url: urlSubir,
      type: "post",
      dataType: "html", //<---- REGRESAR A JSON
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      success: function(resp){
				console.log(resp);
          $("#respServer").empty();
          if(resp.resp == 1){
            work_list();
            $('#opcion').val(1);
            resetForm('frmWork');
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
