// let urlPag;
urlConsultas3 = 'php/consultas3.php';
urlSubir3     = 'php/subir3.php';
urlEliminar3  = 'php/eliminar3.php';
var employees = [];


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
    });
}

$.fn.datepicker.dates['es'] = {
        days: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
        daysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
        daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
        months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Deciembre"],
        monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"]
};

/**
********************************************************************************
********************************************************************************
********************************************************************************
*************************FUNCIONES PARA SEGUIMIENTOS****************************
********************************************************************************
********************************************************************************
***********
**/

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
        type:    'POST',
        url:     urlPag,
        //data:    params,
        dataType: 'HTML',
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

		if($('#txtAlias').val().length < 1){
			$('#txtAlias').focus();
			$('#reqTxtAlias').html('Este campo es requerido');
			return false;
		}

    let formData = new FormData(document.getElementById('frmDesarrollo'));

    $.ajax({
      beforeSend: function(){
        $('#respServer').html(guardando);
      },
      url: urlSubir3,
      type: 'POST',
      dataType: 'JSON', //<---- REGRESAR A JSON
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      success: function(resp){
          $('#respServer').empty();
          if(resp.resp == 1 ){
            desarrollo_listado();
            $('#opcion').val(1);
            resetForm('frmDesarrollo');
          }else{
            $('#respServer').html('Ocurrió un error al intentar guardar en la base de datos');
          }
      }
    });
		$('#frmDesarrollo').slideToggle();
		$('#btnNvoDesarrollo').slideToggle();
});

//ESTA FUNCIÓN EDITA UN DESARROLLO

function editarRegDesarrollo(id){
  let params = {'id':id, 'opt':1}
  $.ajax({
        beforeSend: function(){
            $('#respServer').html(cargando);
        },
        type:    'POST',
        url:     urlConsultas3,
        data:    params,
        dataType: 'json',
        success: function(resp){
            $('#respServer').empty('');
            $('#txtNombre').val(resp.nombre);
						$('#txtAlias').val(resp.alias);
						$('#txtNumeroOferta').val(resp.numero_etapa_oferta);
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
        title: '¿Está seguro?',
        text: 'eliminar el registro <strong>' + nombre + '</strong>',
        type: 'warning',
        showCancelButton: true,
        cancelButtonClass: 'btn-primary',
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
        closeOnConfirm: true
      },
      function(){
          let params = {'id':id, 'icono':icono, 'opt':1};
          $.ajax({
              type:    'POST',
              url:     urlEliminar3,
              data:    params,
              dataType: 'json',
              success: function(resp){
                    if(resp.resp == 1){
                        desarrollo_listado();
                    }
              }
          });
      });
}
/**
********************************************************************************
********************************************************************************
********************************************************************************
*****************************FUNCIONES PARA OBRAS*******************************
********************************************************************************
********************************************************************************
********************************************************************************
**/


$('#btnNewWork').click(function(){
  $('#frmWork').slideToggle();
  $('#btnNewWork	').slideToggle();
  $('#txtName').focus();
});

$('#btnCancelWork').click(function(){
  $('#frmWork').slideToggle();
  $('#btnNewWork').slideToggle();
	$('#opcion').val(3);
  resetForm('frmWork');
});


function work_list(){
  urlPag = 'pg/obras_listado.php';

  $.ajax({
        beforeSend: function(){
            $('#cntnListPagos').html(cargando);
        },
        type:    'POST',
        url:     urlPag,
        //data:    params,
        dataType: 'HTML',
        success: function(data){
            $('#cntnListPagos').html(data);
            loadDataTable('listWorks', true);
        }
  });
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

		if(isEmpty($('#date1')) || $('#date1').val() == '00-00-0000'|| $('#date1').val() == '0000-00-00'){
      $('#date1').focus();
      $('#reqDateStart').html('Este campo es requerido');
      return false;
    }else{
      $('#reqDateStart').empty();
    }

		/*if(isEmpty($('#txtFolderVol'))){
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
    }*/

		if(isEmpty($('#txtWorkArea'))){
      $('#txtWorkArea').focus();
      $('#reqWorkArea').html('Este campo es requerido');
      return false;
    }else{
      $('#reqWorkArea').empty();
    }

		if(!checkDate($('#date1').val(), $('#date2').val())){
			$('#reqDateStart').html('Este fecha no debe ser mayor a la fecha de finalización');
			$('#reqDateFinish').html('Este fecha no debe ser menor a la fecha de inicio');
			return false;
		} else {
			$('#reqDateStart').empty();
			$('#reqDateFinish').empty();
		}

    let formData = new FormData(document.getElementById('frmWork'));

    $.ajax({
      beforeSend: function(){
        $('#respServer').html(guardando);
      },
      url: urlSubir3,
      type: 'POST',
      dataType: 'JSON', //<---- REGRESAR A JSON
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      success: function(resp){
          $('#respServer').empty();
          if(resp.resp == 1){
						$('#frmWork').slideToggle();
					  $('#btnNewWork').slideToggle();
						if(!$('#btnNewWork').hasClass('hide')){
							$('#btnSavePO').addClass('hide');
							$('#btnSaveEI').addClass('hide');
							$('#btnSaveMO').addClass('hide');
						}
            work_list();
            $('#opcion').val(3);
            resetForm('frmWork');
          }else{
            $('#respServer').html('Ocurrió un error al intentar guardar en la base de datos');
          }
      }
    });
});

function eliminarRegObra(id, nombre){
  swal({
        html: true,
        title: '¿Está seguro?',
        text: 'eliminar el registro <strong>' + nombre + '</strong>',
        type: 'warning',
        showCancelButton: true,
        cancelButtonClass: 'btn-primary',
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
        closeOnConfirm: true
      },
      function(){
          let params = {'id':id, 'opt':2};
          $.ajax({
              type:    'POST',
              url:     urlEliminar3,
              data:    params,
              dataType: 'json',
              success: function(resp){
                    if(resp.resp == 1){
                        work_list();
                    }
              }
          });
      });
}

function editarRegObra(id){
  let params = {'id':id, 'opt':2}
  $.ajax({
        beforeSend: function(){
            $('#respServer').html(cargando);
        },
        type:    'POST',
        url:     urlConsultas3,
        data:    params,
        dataType: 'json',
        success: function(resp){
			let srcPO = 'pg/modal_presupuesto_obra_est.php?id='+resp.id_obra+'&flag=1';
			let srcEI = 'pg/modal_presupuesto_obra_est.php?id='+resp.id_obra+'&flag=2';
			let srcMO = 'pg/modal_presupuesto_obra_est.php?id='+resp.id_obra+'&flag=3';
            $('#respServer').empty('');
            $('#txtName').val(resp.nombre);
			$('#inputType').val(resp.tipo);
			$('#txtDependency').val(resp.dependencia);
            $('#inputAmount').val(resp.monto);
            $('#date1').val(resp.fecha_inicio);
            $('#date2').val(resp.fecha_finalizacion);
			//$('#txtFolderVol').val(resp.volumenes_carpeta);
			$('#addedType').val(resp.tipo_agregado);
			//$('#txtConcreteVol').val(resp.volumen_concreto);
			$('#txtWorkArea').val(resp.area_obra);
			$('#idWork').val(resp.id_obra);
			$('#btnSavePO').data('src',srcPO);
			$('#btnSaveEI').data('src',srcEI);
			$('#btnSaveMO').data('src',srcMO);
			if($('#btnSavePO').hasClass('hide')){

				$('#btnSavePO').removeClass('hide');
				$('#btnSaveEI').removeClass('hide');
				$('#btnSaveMO').removeClass('hide');
			}
			$('#opcion').val('9');
        }
  });
	$('#frmWork').slideToggle();
  $('#btnNewWork').slideToggle();
	$('#txtName').focus();
}
/**
********************************************************************************
********************************************************************************
********************************************************************************
*************************FUNCIONES PARA SEGUIMIENTOS****************************
********************************************************************************
********************************************************************************
***********
**/


$('#btnNewEstTrack').click(function(){
  $('#frmEstTrack').slideToggle();
  $('#btnNewEstTrack').slideToggle();
  $('#inputWorkName').focus();
});

$('#btnCancelEstTrack').click(function(){
  $('#frmEstTrack').slideToggle();
  $('#btnNewEstTrack').slideToggle();
	$('#opcion').val(4);
  resetForm('frmEstTrack');
});


function estimation_list(){
  urlPag = 'pg/seguimiento_listado.php';
  $.ajax({
        beforeSend: function(){
            $('#cntnListPagos').html(cargando);
        },
        type:    'POST',
        url:     urlPag,
        //data:    params,
        dataType: 'HTML',
        success: function(data){
            $('#cntnListPagos').html(data);
            loadDataTable('listEstimations', true);
        }
  });
}

//ESTA FUNCIÓN AGREGA UN NUEVO SEGUIMIENTO DE ESTIMACIONES
$('#saveTrackEst').click(function(){
    if($('#inputTrackEst').val().length < 1){
      $('#inputTrackEst').focus();
      $('#reqInputTrackEst').html('Este campo es requerido');
      return false;
    }else{
      $('#reqInputTrackEst').empty();
    }

		if($('#inputEstimateNum').val().length < 1){
      $('#inputEstimateNum').focus();
      $('#reqInputEstimateNum').html('Este campo es requerido');
      return false;
    }else{
      $('#reqInputEstimateNum').empty();
    }

		if($('#date1').val().length < 1){
			$('#date1').focus();
			$('#reqDate1').html('Este campo es requerido');
			return false;
		}else{
			$('#reqDate1').empty();
		}

		if($('#inputStatus').val().length < 1){
			$('#inputStatus').focus();
			$('#reqInputStatus').html('Este campo es requerido');
			return false;
		}else{
			$('#reqInputStatus').empty();
		}

		if(!($('#date2').val() != '0000-00-00') || !($('#date2').val() != '00-00-0000')){
			if(!checkDate($('#date1').val(), $('#date2').val())){
				$('#reqDate1').html('Este fecha no debe ser mayor a la fecha de finalización');
				return false;
			}
		}

		if(!($('#date1').val())) {
			$('#reqDate1').html('lol');
			return false;
		}

		if($('#inputAmount').val().length < 1){
      $('#inputAmount').focus();
      $('#reqInputAmount').html('Este campo es requerido');
      return false;
    }else{
      $('#reqInputAmount').empty();
    }

		var date1 = $('#date1').val().split('-');
		if($('#date2').val().length > 0){
			var date2 = $('#date2').val().split('-');
			if(date2[2].length == 4){
				$('#date2').val(date2[2] + '-' + date2[1] + '-' + date2[0]);
			} else {
				if(date2[2].length == 2){
					$('#date2').val(date2[0] + '-' + date2[1] + '-' + date2[2]);
				} else {
					$('#date1').focus();
					$('#reqDate1').html('Ingrese fechas en el formato DD-MM-YYYY ó YYYY-MM-DD');
					return false;
				}
			}
		}
		if(date1[2].length == 4){
			$('#date1').val(date1[2] + '-' + date1[1] + '-' + date1[0]);
		} else {
			if(date1[2].length == 2){
				$('#date1').val(date1[0] + '-' + date1[1] + '-' + date1[2]);
			} else {
				$('#date1').focus();
				$('#reqDate1').html('Ingrese fechas en el formato DD-MM-YYYY ó YYYY-MM-DD');
				return false;
			}
		}

    let formData = new FormData(document.getElementById('frmEstTrack'));

    $.ajax({
      beforeSend: function(){
        $('#respServer').html(guardando);
      },
      url: urlSubir3,
      type: 'POST',
      dataType: 'JSON', //<---- REGRESAR A JSON
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      success: function(resp){
          $('#respServer').empty();
          if(resp.resp == 1 ){
            estimation_list();
            $('#opcion').val(4);
            resetForm('frmEstTrack');
						$('#frmEstTrack').slideToggle();
						$('#btnNewEstTrack').slideToggle();
          }else{
            $('#respServer').html('Ocurrió un error al intentar guardar en la base de datos');
          }
      }
    });
});

//ESTA FUNCIÓN EDITA SEGUIMIENTOS DE ESTIMACIONES
function editarRegSegEst(id){
  let params = {'id':id, 'opt':3}
  $.ajax({
        beforeSend: function(){
            $('#respServer').html(cargando);
        },
        type:    'POST',
        url:     urlConsultas3,
        data:    params,
        dataType: 'json',
        success: function(resp){
						$('#idEstTrack').val(resp.id_seg_est);
            $('#respServer').empty('');
            $('#inputTrackEst').val(resp.nombre_obra);
						$('#inputEstimateNum').val(resp.numero_estimacion);
						$('#inputAmount').val(resp.monto);
            $('#date1').val(resp.fecha_inicio);
            $('#date2').val(resp.fecha_finalizacion);
						$('#inputPhysicAdv').val(resp.avance_fisico);
						$('#inputStatus').val(resp.status);
						$('#hdFlsImg').val(resp.imagen);
						$('#opcion').val('10');
        }
  });
	$('#frmEstTrack').slideToggle();
  $('#btnNewEstTrack').slideToggle();
	$('#inputTrackEst').focus();
}

//ESTA FUNCIÓN ELIMINA SEGUIMIENTO DE ESTIMACIONES
function eliminarRegSegEst(id, nombre){
  swal({
        html: true,
        title: '¿Está seguro?',
        text: 'eliminar el registro ' + nombre,
        type: 'warning',
        showCancelButton: true,
        cancelButtonClass: 'btn-primary',
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
        closeOnConfirm: true
      },
      function(){
          let params = {'id':id, 'opt':3};
          $.ajax({
              type:    'POST',
              url:     urlEliminar3,
              data:    params,
              dataType: 'json',
              success: function(resp){
                    if(resp.resp == 1 || resp.resp == 2){
                        estimation_list();
                    }
              }
          });
      });
}

/**
********************************************************************************
********************************************************************************
********************************************************************************
**************************FUNCIONES PARA ANTIGUEDAD*****************************
********************************************************************************
********************************************************************************
***********
**/

//LISTADO ANTIGUEDAD

function antiquity_list(){
  urlPag = 'pg/antiguedad_listado.php';

  $.ajax({
        beforeSend: function(){
            $('#cntnListAntiguedad').html(cargando);
        },
        type:    'POST',
        url:     urlPag,
        dataType: 'HTML',
        success: function(data){
            $('#cntnListAntiguedad').html(data);
            loadDataTable('listAntiguedad', true);
        }
  });
}

//FUNCIÓN PARA GUARDAR UN NUEVO REGISTRO DE ANTIGUEDAD
$('#btnGuardarAnt').click(function(){
    if($('#txtNombre').val().length < 1){
      $('#txtNombre').focus();
      $('#reqTxtNombre').html('Este campo es requerido');
      return false;
    }else{
      $('#reqTxtNombre').empty();
    }

		if(!($('#flIcono').val())){
			$('#flIcono').val($('#hdFlIcono').val());
			;
		}

    let formData = new FormData(document.getElementById('frmAntique'));

    $.ajax({
      beforeSend: function(){
        $('#respServer').html(guardando);
      },
      url: urlSubir3,
      type: 'POST',
      dataType: 'JSON', //<---- REGRESAR A JSON
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      success: function(resp){
          $('#respServer').empty();
          if(resp.resp == 1 ){
            antiquity_list();
            $('#opcion').val(5);
            resetForm('frmAntique');
          }else{
            $('#respServer').html('Ocurrió un error al intentar guardar en la base de datos');
          }
      }
    });
});


//FUNCION APRA EDITAR UN REGISTRO DE ANTIGUEDAD
function editarRegAntiguedad(id){
  let params = {'id':id, 'opt':6}
  $.ajax({
        beforeSend: function(){
            $('#respServer').html(cargando);
        },
        type:    'POST',
        url:     urlConsultas3,
        data:    params,
        dataType: 'json',
        success: function(resp){
						antiquity_list();
						$('#txtNombre').val(resp.nombre);
						$('#hdFlIcono').val(resp.icono);
						$('#idAntiguedad').val(resp.id_antiguedad);
						$('#opcion').val('6');
            $('#respServer').empty('');

        }
  });

	$('#txtNombre').focus();
}

//FUNCIÓN PARA ELIMINAR UN REGISTRO DE ANTIGUEDAD
function eliminarRegAntiguedad(id, nombre){
  swal({
        html: true,
        title: '¿Está seguro?',
        text: 'eliminar el registro <strong>' + nombre + '</strong>',
        type: 'warning',
        showCancelButton: true,
        cancelButtonClass: 'btn-primary',
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
        closeOnConfirm: true
      },
      function(){
          let params = {'id':id, 'opt':4};
          $.ajax({
              type:    'POST',
              url:     urlEliminar3,
              data:    params,
              dataType: 'json',
              success: function(resp){
                    if(resp.resp == 1 || resp.resp == 2){
                        antiquity_list();
                    }
              }
          });
      });
}

/**
********************************************************************************
********************************************************************************
********************************************************************************
***************************FUNCIONES PARA EMPLEADOS*****************************
********************************************************************************
********************************************************************************
***********
**/
function employees_list(){
  urlPag = 'pg/empleados_listado.php';

	let formData = new FormData(document.getElementById('frmSearchEmployee'));

  $.ajax({
        beforeSend: function(){
            $('#cntnListEmployees').html(cargando);
        },
        type:    'POST',
        url:     urlPag,
				data: formData,
				cache: false,
				contentType: false,
				processData: false,
        dataType: 'HTML',
        success: function(data){
            $('#cntnListEmployees').html(data);
            loadDataTable('employees_list', false);
        }
  });
}

//
$('#btnNewEmployee').click(function(){
  $('#frmAddEmployee').slideToggle();
  $('#btnNewEmployee').slideToggle();
	$('#btnSearchEmployee').slideToggle();
  $('#txtName').focus();
});
//
$('#btnSearchEmployee').click(function(){
	$('#frmSearchEmployee').slideToggle();
	$('#btnNewEmployee').slideToggle();
	$('#btnSearchEmployee').slideToggle();

	$('#txtEmployee').focus();
});


$('#btnCancelSearch').click(function(){
  $('#frmSearchEmployee').slideToggle();
  $('#btnNewEmployee').slideToggle();
	$('#btnSearchEmployee').slideToggle();
  resetForm('frmSearchEmployee');
});

$('#btnCancelEmployee').click(function(){
  $('#frmAddEmployee').slideToggle();
  $('#btnNewEmployee').slideToggle();
	$('#btnSearchEmployee').slideToggle();
	$('#opcion').val(7);
  resetForm('frmAddEmployee');
});



$('#btnAddEmployee').click(function(){

	    if($('#txtName').val().length < 1){
	      $('#txtName').focus();
	      $('#reqTxtName').html('Este campo es requerido');
	      return false;
	    }else{
	      $('#reqTxtNombre').empty();
	    }

			if($('#txtLastName').val().length < 1){
				$('#txtLastName').focus();
				$('#reqTxtLastName').html('Este campo es requerido');
				return false;
			}else{
				$('#reqTxtLastName').empty();
			}

			if($('#txtMLastName').val().length < 1){
				$('#txtMLastName').focus();
				$('#reqTxtMLastName').html('Este campo es requerido');
				return false;
			}else{
				$('#reqTxtMLastName').empty();
			}

			if($('#txtAddress').val().length < 1){
				$('#txtAddress').focus();
				$('#reqTxtAddress').html('Este campo es requerido');
				return false;
			}else{
				$('#reqTxtAddress').empty();
			}

			if($('#txtCURP').val().length < 1){
				$('#txtCURP').focus();
				$('#reqTxtCURP').html('Este campo es requerido');
				return false;
			}else{
				$('#reqTxtCURP').empty();
			}

			if($('#admissionDate').val().length < 1){
				$('#admissionDate').focus();
				$('#reqAdmissionDate').html('Este campo es requerido');
				return false;
			}else{
				$('#reqAdmissionDate').empty();
			}

	    let formData = new FormData(document.getElementById('frmAddEmployee'));

	    $.ajax({
	      beforeSend: function(){
	        $('#respServer').html(guardando);
	      },
	      url: urlSubir3,
	      type: 'POST',
	      dataType: 'JSON', //<---- REGRESAR A JSON
	      data: formData,
	      cache: false,
	      contentType: false,
	      processData: false,
	      success: function(resp){
	          $('#respServer').empty();
	          if(resp.resp == 1 ){
	            employees_list();
	            $('#opcion').val(7);
	            resetForm('frmAddEmployee');
							$('#frmAddEmployee').slideToggle();
							$('#btnNewEmployee').slideToggle();
							$('#btnSearchEmployee').slideToggle();
	          }else{
							$('#respServer').html('Ocurrió un error al intentar guardar en la base de datos');
	          }
	      }
	    });
});

function editEmployee(id) {
	let params = {'id':id, 'opt':5}
  $.ajax({
        beforeSend: function(){
            $('#respServer').html(cargando);
        },
        type:    'POST',
        url:     urlConsultas3,
        data:    params,
        dataType: 'json',
        success: function(resp){
						employees_list();
						$('#txtName').val(resp.nombre);
						$('#txtLastName').val(resp.apellido_paterno);
						$('#txtMLastName').val(resp.apellido_materno);
						$('#txtAddress').val(resp.direccion);
						$('#txtIMSS').val(resp.imss);
						$('#txtRFCi').val(resp.rfc);
						$('#txtCURP').val(resp.curp);
						$('#admissionDate').val(resp.fecha_admision);
						$('#txtCivilSts').val(resp.estado_civil);
						$('#txtGender').val(resp.genero);
						$('#txtCategory').val(resp.categoria);
						$('#txtDepartment').val(resp.departamento);
						$('#txtArea').val(resp.area);
						$('#txtType').val(resp.tipo);
						$('#id_employee').val(resp.id_empleado);
						$('#opcion').val('8');
            $('#respServer').empty('');
        }
  });
	$('#frmAddEmployee').slideToggle();
	$('#btnNewEmployee').slideToggle();
	$('#btnSearchEmployee').slideToggle();
	$('#txtName').focus();
}

function deleteEmployee(id, name){


	  swal({
	        html: true,
	        title: '¿Está seguro?',
	        text: 'eliminar el empleado <strong>' + name + '</strong>',
	        type: 'warning',
	        showCancelButton: true,
	        cancelButtonClass: 'btn-primary',
	        confirmButtonColor: '#DD6B55',
	        confirmButtonText: 'Aceptar',
	        cancelButtonText: 'Cancelar',
	        closeOnConfirm: true
	      },
	      function(){
	          let params = {'id':id, 'opt':5};
	          $.ajax({
	              type:    'POST',
	              url:     urlEliminar3,
	              data:    params,
	              dataType: 'json',
	              success: function(resp){
	                    if(resp.resp == 1){
	                        employees_list();
	                    }
	              }
	          });
	      });
}

/**
********************************************************************************
********************************************************************************
********************************************************************************
******************************FUNCIONES PARA RAYA*******************************
********************************************************************************
********************************************************************************
********************************************************************************
**/

function listPayments(){
	urlPag = 'pg/raya_listado.php';

	$.ajax({
				beforeSend: function(){
						$('#cntnListPayments').html(cargando);
				},
				type:    'POST',
				url:     urlPag,
				dataType: 'HTML',
				success: function(data){
						$('#cntnListPayments').html(data);
						loadDataTable('listPayments', true);
				}
	});
}

$('#btnSearchPayment').click(function(){
	$('#searchPaymentFrm').slideToggle();
	$('#btnNewPayment').slideToggle();
	$('#btnSearchPayment').slideToggle();
	resetForm('frmPayment');
});

$('#btnNewPayment').click(function(){
  $('#frmPayment').slideToggle();
	$('#btnSearchPayment').slideToggle();
  $('#btnNewPayment').slideToggle();
  resetForm('frmPayment');
});

$('#cancelSearchPayment').click(function(){
	$('#btnSearchPayment').slideToggle();
	$('#btnNewPayment').slideToggle();
	$('#searchPaymentFrm').slideToggle();
	resetForm('searchPaymentFrm');
});

$('#cancelPaymentBtn').click(function(){
	$('#frmPayment').slideToggle();
	$('#btnSearchPayment').slideToggle();
	$('#btnNewPayment').slideToggle();
	resetForm('frmPayment');
	$('#opcion').val('11');
});

$('#frmPayment').submit(function(event){

		event.preventDefault();
	swal({
				html: true,
				title: '¿Está seguro?',
				text: 'Una vez agregado un pago, no se puede modificar ni eliminar',
				type: 'warning',
				showCancelButton: true,
				cancelButtonClass: 'btn-primary',
				confirmButtonColor: '#7BED81',
				confirmButtonText: 'Aceptar',
				cancelButtonText: 'Prefiero revisar los datos',
				closeOnConfirm: true
			},
			function(){
					let formData = new FormData(document.getElementById('frmPayment'));
					$.ajax({
							type:    'POST',
							url:     urlSubir3,
							data:    formData,
							dataType: 'json',
							cache: false,
							contentType: false,
							processData: false,
							success: function(resp){
										if(resp.resp == 1){
												listPayments();
										}
							}
					});
			});
});

/*******************************************************************************/
/*******************************************************************************/
/*******************************************************************************/
/*******************************************************************************/
/*******************************************************************************/
/**************************FUNCIONES PARA CONTRATOS*****************************/
/*******************************************************************************/
/*******************************************************************************/
/*******************************************************************************/


function listContracts(){
	urlPag = 'pg/contratos_listado.php';

	$.ajax({
				beforeSend: function(){
						$('#cntnListContracts').html(cargando);
				},
				type:    'POST',
				url:     urlPag,
				dataType: 'HTML',
				success: function(data){
						$('#cntnListContracts').html(data);
						loadDataTable('listContracts', true);
				}
	});
}

$('#btnNewContract').click(function(){
	$('#sillyTable').attr('style','');
	$('#frmContract').slideToggle();
	$('#btnNewContract').slideToggle();
});

$('#cancelContract').click(function(){
	$('#sillyTable').attr('style','margin-top: -10%');
	$('#frmContract').slideToggle();
	$('#btnNewContract').slideToggle();
	$('#opcion').val('12');
});

//GUARDA UN CONTRATO
$('#frmContract').submit(function(event){
		event.preventDefault();
		let formData = new FormData($(this)[0]);

		$.ajax({beforeSend: function(){
							$('#respServer').html(cargando);
						},
						url: urlSubir3,
						type: 'POST',
						dataType: 'JSON', //<---- REGRESAR A JSON
						data: formData,
						cache: false,
						contentType: false,
						processData: false,
						success: function(resp){
								if(resp.resp == 1 ){
									$('#respServer').html('');
									resetForm('frmContract');
									$('#sillyTable').attr('style','margin-top: -10%');
									$('#frmContract').slideToggle();
									$('#btnNewContract').slideToggle();
									$('#opcion').val('12');
									$('#flContract').prop('required',true);
									listContracts();
								}else{
									$('#respServer').html('Ocurrió un error al intentar guardar en la base de datos');
								}
						}

		});
});
//EDITA UN CONTRATO
function editContract(id){

	let params = {'id':id, 'opt':7};
	$.ajax({
	        beforeSend: function(){
	            $('#respServer').html(cargando);
	        },
	        type:    'POST',
	        url:     urlConsultas3,
	        data:    params,
	        dataType: 'json',
	        success: function(resp){
				listContracts();
				$('#idContract').val(resp.id_contrato);
				$('#folio').val(resp.folio);
				let fecha = moment(resp.fecha_realizacion,'DD-MM-YYYY').format('DD/MM/YYYY').toString();
				$('#dateContract').val(fecha);
				$('#dateContract').keyup();
				$('#clientSelected').val(resp.id_cliente);
				clientChanged(resp.id_propiedad);
				fecha = moment(resp.vigencia,'DD-MM-YYYY').format('DD/MM/YYYY').toString();
				$('#contractValidity').val(fecha);
				$('#contractValidity').keyup();
				$('#contractType').val(resp.tipo_contrato);
				$('#contractAmount').val(resp.monto);
				$('#contractAmount').keyup();
				$('#contractOwner').val(resp.id_propietario);
				$('#contractLessee').val(resp.estado_civil);
				$('#hitch').val(resp.enganche_deposito);
				$('#hitch').keyup();
				$('#hdFlContract').val(resp.archivo);
				$('#remarks').val(resp.observaciones);
				$('#respServer').empty('');
				$('#sillyTable').attr('style','');
				$('#frmContract').slideToggle();
				$('#btnNewContract').slideToggle();
				$('#period').val(resp.periodo);
				//$('#propertySelected').val(resp.id_propiedad);
				changeContractType();
				$('#flContract').prop('required',false);
				$('#opcion').val('13');
	        }
				});
}
//ELIMINA UN CONTRATO
function deleteContract(id, name, archivo){
		  swal({
		        html: true,
		        title: '¿Está seguro?',
		        text: '¿Eliminará el registro del contrato con el cliente <strong>' + name + '</strong>?',
		        type: 'warning',
		        showCancelButton: true,
		        confirmButtonColor: '#DD6B55',
		        confirmButtonText: 'Eliminar',
		        cancelButtonText: 'Cancelar',
		        closeOnConfirm: true
		      },
		      function(){
		          let params = {'id':id, 'archivo':archivo, 'opt':6};
		          $.ajax({
		              type:    'POST',
		              url:     urlEliminar3,
		              data:    params,
		              dataType: 'json',
		              success: function(resp){
		                    if(resp.resp == 1 || resp.resp == 2){
		                        listContracts();
		                    }
		              }
		          });
		      });
}

//OBTIENE PROPIEDADES QUE INTERESAN AL CLIENTE
function clientChanged(idProperty=0){
	let idClient = $('#clientSelected').val();
	let params = {idClient: idClient, opt: 24};
	let properties;
	$.ajax({
				beforeSend: function(){
						$('#respServer').html(cargando);
						$('#propertySelected').empty();
						$('#propertySelected').append(
						`<option value='0'>Selecciona una propiedad</option>`);
				},
				type:    'POST',
				url:     urlConsultas3,
				dataType: 'json',
				data: params,
				success: function(resp){
					$("#respServer").html('');
					$.each(resp.properties,function(i,y){
						if(idProperty !=0){
							$('#propertySelected').append(
								`<option selected value="`+y['id_property']+`" name ="`+y['name']+`" data-development="`+y['development']+`" data-amount="`+y['amount']+
								`" data-owner="`+y['owner']+`" data-type="`+y['type']+`">`+
								y['name']+
								`</option>`);
						}
						else{
							$('#propertySelected').append(
							`<option value="`+y['id_property']+`" name ="`+y['name']+`" data-development="`+y['development']+`" data-amount="`+y['amount']+
							`" data-owner="`+y['owner']+`" data-type="`+y['type']+`">`+
							y['name']+
							`</option>`);
						}
					});
					changeProperty();
				}
	});
}

/*******************************************************************************/
/*******************************************************************************/
/*******************************************************************************/
/*******************************************************************************/
/*******************************************************************************/
/**************************FUNCIONES PARA NOMINA AD*****************************/
/*******************************************************************************/
/*******************************************************************************/
/*******************************************************************************/

function listAdmPayments(){
	urlPag = 'pg/nom_adm_listado.php';

	$.ajax({
				beforeSend: function(){
						$("#cntnListAdmPayments").html(cargando);
				},
				type:    'POST',
				url:     urlPag,
				dataType: 'HTML',
				success: function(data){
						$('#cntnListAdmPayments').html(data);
						loadDataTable('listAdmPayments', true);
				}
	});
}

$('#btnNewAdmPayment').click(function(){
  $('#frmAdmPayment').slideToggle();
  $('#btnNewAdmPayment').slideToggle();
  resetForm('frmAdmPayment');
});

$('#cancelSearchPayment').click(function(){
	$('#btnSearchAdmPayment').slideToggle();
	$('#btnNewAdmPayment').slideToggle();
	$('#searchAdmPaymentFrm').slideToggle();
	resetForm('searchPaymentFrm');
});

$('#cancelAdmPaymentBtn').click(function(){
	$('#frmAdmPayment').slideToggle();
	$('#btnSearchAdmPayment').slideToggle();
	$('#btnNewAdmPayment').slideToggle();
	resetForm('frmAdmPayment');
	$('#opcion').val("14"); //CAMBIAR OPCIÓN
});

$('#frmAdmPayment').submit(function(event){

	event.preventDefault();

	let formData = new FormData($(this)[0]);

	swal({
				html: true,
				title: "¿Está seguro?",
				text: "Una vez agregado un pago, no se puede modificar ni eliminar",
				type: "warning",
				showCancelButton: true,
				cancelButtonClass: "btn-primary",
				confirmButtonColor: "#7BED81",
				confirmButtonText: "Aceptar",
				cancelButtonText: "Prefiero revisar los datos",
				closeOnConfirm: true
			},
			function(){
					let formData = new FormData(document.getElementById("frmPayment"));
					$.ajax({beforeSend: function(){
										$("#respServer").html(cargando);
									},
									url: urlSubir3,
									type: 'POST',
									dataType: 'JSON', //<---- REGRESAR A JSON
									data: formData,
									cache: false,
									contentType: false,
									processData: false,
									success: function(resp){
											if(resp.resp == 1 ){
												$("#respServer").html('');
												resetForm('frmAdmPayment');
												$('#frmAdmPayment').slideToggle();
												$('#btnNewAdmPayment').slideToggle();
												listAdmPayments();
											}else{
												$("#respServer").html('Ocurrió un error al intentar guardar en la base de datos');
											}
									}

					});
			});
});

/*******************************************************************************/
/*******************************************************************************/
/*******************************************************************************/
/*******************************************************************************/
/*******************************************************************************/
/**************************FUNCIONES PARA AVANCES F*****************************/
/*******************************************************************************/
/*******************************************************************************/
/*******************************************************************************/

$('#addToTable').click(function(){
	let id = $('#concept').val();
	let concept = $('#concept option:selected').text();
	let code = $('#concept').find(":selected").data("code");
	let quant = $('#concept').find(":selected").data("quant");
	let used = '';
	var tbody = $("#listConcepts tbody");

	if($('#concept').val() != 0){
		if (tbody.children().length == 0) {
				$("#listConcepts").slideToggle();
				$('#saveConcepts').slideToggle();
		}
		let params = {'id':id, 'opt':22}
		$.ajax({
				type:    'POST',
				url:     urlConsultas3,
				data:    params,
				dataType: 'json',
				success: function(resp){
					$('#input'+id).attr("max", parseFloat(quant) - parseFloat(resp.used));
				}
		});

		if(!$('#'+id).length){
			$('#listConcepts tbody').append(
			'<tr id="'+id+'">'+
			'<td class="text-center">'+id+'</td>'+
			'<td class="text-center">'+code+'</td>'+
			'<td class="text-center">'+concept+'</td>'+
			'<td> <input id="input'+id+'" type="number" step="0.001" required onkeypress="return isNumberKey(event)" class="form-control text-center"style="display: block;" min="1" > </td>'+
			'<td> <button type="button" name="button" class="btn btn-danger text-center" onclick="deleteTR(\''+id+'\')"> <i class="fa fa-trash"></i> </button> </td>'+
			'</tr>');
		} else {
			swal({
			  type: 'warning',
			  title: 'El concepto que deseas agregar ya se encuentra en la lista, quizá quieras editar la cantidad',
			  showConfirmButton: false,
			  timer: 2500
			});
		}

	}
	});

	function deleteTR(code){
		var tbody = $("#listConcepts tbody");
		$('#'+code).remove();

		if (tbody.children().length == 0) {
				$("#listConcepts").slideToggle();
				$('#saveConcepts').slideToggle();
		}
	}

	//AGREGA UN NUEVO AVANCE FÍSICO
	$('#newPhysProg').submit(function(event){
		event.preventDefault();

		let formData = new FormData($(this)[0]);

		let idConcept = [];
		let quantConcept = [];

		$("#listConcepts tbody tr").each(function (index) {
	    $(this).children("td").each(function (index2) {
	      switch (index2) {
	        case 0:
					idConcept.push($(this).text());
	        break;

	        case 3:
					quantConcept.push($(this).children().val());
					break;
	      }
	    });
  	});

		$('#respServer').html(cargando);

		let id = $('#id').val();

		let resident = $('#resident').val();
		let work = $('#work').val();

		let dateStart = $('#dateStart').val();
		let dateFinish = $('#dateFinish').val();

		let opcion = $('#opcion').val();

		let concepts = JSON.stringify(idConcept);

		let quantities = JSON.stringify(quantConcept);

		let params = {
									'id':id,
									'resident':resident,
									'work':work,
									'dateStart':dateStart,
									'dateFinish':dateFinish,
									'opcion':opcion,
									'concepts':concepts,
									'quantities':quantities}

		$.ajax({
				type:    'POST',
				url:     urlSubir3,
				data:    params,
				dataType: 'json',
				success: function(resp){
					$('#respServer').html("");
					resetForm('newPhysProg');
					listPhysProg();
					$('#newPhysProg').slideToggle();
					$('#btnNewPhysProg').slideToggle();
					$("#listConcepts tbody tr").each(function (index) {
						deleteTR($(this).attr('id'));
					});
					$('#opcion').val("15");
				}
		});
	});

	function fillConcepts(){
		$('#waitingConcepts').html(cargando);
		$('#concept').hide();
		var work = $('#work').val();
		let params = {'work': work, 'opt': 21}
		let element = '';
    $.ajax({
        type:    'POST',
        url:     urlConsultas3,
        data:    params,
        dataType: 'json',
        success: function(resp){
					$("#listConcepts tbody tr").each(function (index) {
						deleteTR($(this).attr('id'));
					});
            element+= '<option value="0">Seleccionar...</option>';
            $.each(resp.conceptos,function(i,y){
                element+= '<option value="' + y['id'] + '"data-quant="'+y['cantidad']+'" data-code="'+y['codigo']+'">' + y['concepto'] + '</option>';
            });
						$("#concept").empty();
            $('#concept').append(element);
						$('#concept').show();
						$('#waitingConcepts').html("");
        }
    });
	}

$('#btnNewPhysProg').click(function(){
  $('#newPhysProg').slideToggle();
	$('#btnNewPhysProg').slideToggle();
});

function listPhysProg(){
	urlPag = 'pg/avance_fisico_listado.php';

	$.ajax({
				beforeSend: function(){
						$("#cntnListProgress").html(cargando);
				},
				type:    'POST',
				url:     urlPag,
				dataType: 'HTML',
				success: function(data){
						$('#cntnListProgress').html(data);
						loadDataTable('listPhysicalProgress', true);
				}
	});
}

$('#cancelAllConcepts').click(function(){
	$("#listConcepts tbody tr").each(function (index) {
		deleteTR($(this).attr('id'));
	});
	$('#opcion').val("15");
	$('#id').html("");
	$('#newPhysProg').slideToggle();
	$('#btnNewPhysProg').slideToggle();
});

function lookDetails(id){
	$("#listConceptsDetail tbody tr").each(function (index) {
		$(this).remove();
	});
	$('#folioModal').html('Cargando...');
	$('#residentModal').html('Cargando...');
	$('#workModal').html('Cargando...');

	$.ajax({
				beforeSend: function(){
						$("#respServerModalDetail").html(cargando);
				},
				type:    'post',
				url:     urlConsultas3,
				data: {'id':id, 'opt':23},
				dataType: 'json',
				success: function(resp){
						$.each(resp.concepts,function(i,y){
								$('#listConceptsDetail tbody').append(
								'<tr>'+
								'<td class="text-center">'+y['id']+'</td>'+
								'<td class="text-center">'+y['codigo']+'</td>'+
								'<td class="text-center">'+y['concepto']+'</td>'+
								'<td class="text-center">'+y['cantidad']+'</td>'+
								'</tr>');
						});
						$('#respServerModalDetail').html("");
						$('#folioModal').html('Folio: <b>'+resp.folio+'</b>');
						$('#residentModal').html('Residente: <b>'+resp.resident+'</b>');
						$('#workModal').html('Obra: <b>'+resp.work+'</b>');
				}
	});
}

function deleteProgress(id){
	swal({
				html: true,
				title: "¿Está seguro?",
				text: "Ésta acción no se puede revertir",
				type: "warning",
				showCancelButton: true,
				cancelButtonClass: "btn-primary",
				confirmButtonColor: "#7BED81",
				confirmButtonText: "Aceptar",
				cancelButtonText: "Cancelar",
				closeOnConfirm: true
			},
			function(){
					$.ajax({
								beforeSend: function(){
										$("#cntnListProgress").html(cargando);
								},
								type:    'post',
								url:     urlEliminar3,
								data: {'id':id, 'opt':7},
								dataType: 'json',
								success: function(resp){
									$("#cntnListProgress").html("");
									listPhysProg();
								}
					});
			});
}

function editProgress(id){
	$("#listConcepts tbody tr").each(function (index) {
		deleteTR($(this).attr('id'));
	});
	$.ajax({
				beforeSend: function(){
						$("#respServer").html(cargando);
				},
				type:    'post',
				url:     urlConsultas3,
				data: {'id':id, 'opt':8},
				dataType: 'json',
				success: function(resp){
					$('#resident').val(resp.resident);
					$('#work').val(resp.work);
					$('#dateStart').val(resp.dateStart);
					$('#dateFinish').val(resp.dateFinish);
					$.each(resp.concepts,function(i,y){
						$('#concept').val(y['id']);
						$('#addToTable').trigger("click");
						$('#input'+y['id']).val(y['id']);
					});

					$('#concept').select2();

					if($('#newPhysProg').is(':hidden')){
						$('#newPhysProg').slideToggle();
					}
					if($('#btnNewPhysProg').is(':visible')){
						$('#btnNewPhysProg').slideToggle();
					}

					$('#opcion').val("16");
					$('#id').val(resp.id);
					$("#respServer").html("");
				}
	});
}


/*******************************************************************************/
/*******************************************************************************/
/*******************************************************************************/
/*******************************************************************************/
/*******************************************************************************/
/************************FUNCIONES PARA CATÁLOGO NIVEL**************************/
/*******************************************************************************/
/*******************************************************************************/
/*******************************************************************************/

function listLevels(){

	urlPag = 'pg/nivel_listado.php';

	$.ajax({
				beforeSend: function(){
						$("#cntnListLevels").html(cargando);
				},
				type:    'POST',
				url:     urlPag,
				dataType: 'HTML',
				success: function(data){
						$('#cntnListLevels').html(data);
						loadDataTable('listLevels', true);
				}
	});
}

$('#frmLevel').submit(function(event){
	event.preventDefault();
	let formData = new FormData($(this)[0]);
	$.ajax({
			beforeSend: function(){
				$('#respServer').html(cargando);
			},
			type:    'POST',
			url:     urlSubir3,
			data:    formData,
			dataType: 'json',
			cache: false,
			contentType: false,
			processData: false,
			success: function(resp){
					if(resp.resp == 1){
						listLevels();
						$('#respServer').html("");
					} else {
						$('#respServer').html(resp.msg);
					}
					$('#name').val("");
					$('#id').val("");
					$('#opcion').val(17);
			}
	});
});

function editLevel(id){
	$.ajax({
			beforeSend: function(){
				$('#respServer').html(cargando);
			},
			type:    'POST',
			url:     urlConsultas3,
			data:    {'id':id,'opt': 9},
			dataType: 'json',
			success: function(resp){
					$('#name').val(resp.name);
					$('#id').val(resp.id);
					$('#respServer').html("");
					$('#opcion').val('18');
			}
	});
}

function deleteLevel(id, name){
	swal({
				html: true,
				title: "¿Está seguro?",
				text: "Ésta acción no se puede revertir, está a punto de eliminar el nivel: <br>"+name+"</br>",
				type: "warning",
				showCancelButton: true,
				cancelButtonClass: "btn-primary",
				confirmButtonColor: "#7BED81",
				confirmButtonText: "Aceptar",
				cancelButtonText: "Cancelar",
				closeOnConfirm: true
			},
			function(){
					$.ajax({
								beforeSend: function(){
										$("#cntnListLevels").html(cargando);
								},
								type:    'POST',
								url:     urlEliminar3,
								data: {'id':id, 'opt':8},
								dataType: 'json',
								success: function(resp){
									if(resp.resp == 1){
										$("#cntnListLevels").html("");
										listLevels();
									} else {
										$("#cntnListLevels").html("");
									}
								}
					});
			});
}
/*******************************************************************************/
/*******************************************************************************/
/*******************************************************************************/
/*******************************************************************************/
/*******************************************************************************/
/************************FUNCIONES PARA EMPRESAS****************************/
/*******************************************************************************/
/*******************************************************************************/
/*******************************************************************************/

$('#cancelCompany').click(function(){
	resetForm('frmCompany');
	$('#opcion').val('19');
});

function listCompanies(){
	$.ajax({
		beforeSend: function(){
			$('#cntnListCompanies').html(cargando);
		},
		type: 'POST',
		dataType: 'HTML',
		url: 'pg/empresas_listado.php',
		success: function(data){
			$('#cntnListCompanies').html(data);
			loadDataTable('listCompanies', true);
		}
	});
}

$('#frmCompany').submit(function(event){
	event.preventDefault();

	let formData = new FormData($(this)[0]);

	$.ajax({
		beforeSend: function(){
			$('#respServer').html(cargando);
		},
		type: 'POST',
		data: formData,
		dataType: 'JSON',
		url: urlSubir3,
		cache: false,
		contentType: false,
		processData: false,
		success: function(){
			$('#respServer').html('');
			listCompanies();
			resetForm('frmCompany');
			$('#opcion').val('19');
		}
	});
});

function editCompany(id){
	$.ajax({
		beforeSend: function(){
			$('#respServer').html(cargando);
		},
		type: 'POST',
		data: {id:id, opt: 10},
		dataType: 'JSON',
		url: urlConsultas3,
		success: function(resp){
			$('#respServer').html('');
			$('#id').val(resp.id);
			$('#name').val(resp.name);
			$('#opcion').val('20');
		}
	});
}

function deleteCompany(id, name){
	swal({
        html: true,
        title: '¿Está seguro?',
        text: 'Se eliminará el registro <strong>' + name + '</strong>',
        type: 'warning',
        showCancelButton: true,
        cancelButtonClass: 'btn-primary',
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
        closeOnConfirm: true
      },
      function(){
          let params = {'id':id, 'opt': 9};
          $.ajax({
              type:    'POST',
              url:     urlEliminar3,
              data:    params,
              dataType: 'JSON',
              success: function(resp){
                    listCompanies();
              }
          });
      });
}


/*******************************************************************************/
/*******************************************************************************/
/*******************************************************************************/
/*******************************************************************************/
/*******************************************************************************/
/************************FUNCIONES PARA LICITACIONES****************************/
/*******************************************************************************/
/*******************************************************************************/
/*******************************************************************************/
$('#btnNewBidding').click(function(){
	resetForm('frmBidding');
	$('#frmBidding').slideToggle();
	$('#btnNewBidding').slideToggle();
});

$('#cancelBidding').click(function(){
	resetForm('frmBidding');
	$('#frmBidding').slideToggle();
	$('#btnNewBidding').slideToggle();
	$('#respServer').html('');
});

function listBiddings(){
	$.ajax({
		beforeSend: function(){
			$('#cntnListBiddings').html(cargando);
		},
		type: 'POST',
		url: 'pg/licitaciones_listado.php',
		dataType: 'HTML',
		success: function(data){
			$('#cntnListBiddings').html(data);
			loadDataTable('listBiddings', true);
		}
	});
}

$('#frmBidding').submit(function(event){
	event.preventDefault();

	let formData = new FormData($(this)[0]);

	$.ajax({
					beforeSend: function(){
						$('#respServer').html(cargando);
					},
					url: urlSubir3,
					type: 'POST',
					dataType: 'JSON', //<---- REGRESAR A JSON
					data: formData,
					cache: false,
					contentType: false,
					processData: false,
					success: function(resp){
							if(resp.resp == 1 ){
								$('#respServer').html('');
								resetForm('frmBidding');
								if($('#frmBidding').is(':visible')){
									$('#frmBidding').slideToggle();
								}
								if($('#btnNewBidding').is(':hidden')){
									$('#btnNewBidding').slideToggle();
								}

								$('#opcion').val('21');
								listBiddings();
							}else{
								$('#respServer').html('Ocurrió un error al intentar guardar en la base de datos');
							}
					}

	});
});

function editBidding(id){
	$.ajax({
		beforeSend: function(){
			$('#respServer').html(cargando);
		},
		type: 'POST',
		data: {id:id, opt: 11},
		dataType: 'JSON',
		url: urlConsultas3,
		success: function(resp){
			console.log(resp);
			$('#bidNum').val(resp.bidNumber);
			$('#work').val(resp.work);
			$('#propDelivery').val(resp.propDelivery);
			$('#failDate').val(resp.failDate);
			$('#place').val(resp.place);
			$('#hdFile').val(resp.file);
			$('#idBid').val(resp.id);
			$('#respServer').html('');
			$('#respServer').html('El archivo ya subido se mantendrá intacto a menos que subas uno nuevo');
			$('#opcion').val('22');
			if($('#frmBidding').is(':hidden')){
				$('#frmBidding').slideToggle();
			}
			if($('#btnNewBidding').is(':visible')){
				$('#btnNewBidding').slideToggle();
			}
		}
	});
}

function deleteBidding(id, name){
	swal({
        html: true,
        title: '¿Está seguro?',
        text: 'Se eliminará la licitación <strong>#' + name + '</strong>',
        type: 'warning',
        showCancelButton: true,
        cancelButtonClass: 'btn-primary',
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
        closeOnConfirm: true
      },
      function(){
          let params = {'id':id, 'opt': 10};
          $.ajax({
              type:    'POST',
              url:     urlEliminar3,
              data:    params,
              dataType: 'JSON',
              success: function(resp){
                listBiddings();
              }
          });
					listBiddings();
	});
}

/*******************************************************************************/
/*******************************************************************************/
/*******************************************************************************/
/*******************************************************************************/
/*******************************************************************************/
/**************************FORMAT CURRENCY FUNCTIONS*****************************/
/*******************************************************************************/
/*******************************************************************************/
/*******************************************************************************/

$("input[data-type='currency']").on({
    keyup: function() {
      formatCurrency($(this));
    },
    blur: function() {
      formatCurrency($(this), "blur");
    }
});


function formatNumber(n) {
  // format number 1000000 to 1,234,567
  return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}


function formatCurrency(input, blur) {
  // appends $ to value, validates decimal side
  // and puts cursor back in right position.

  // get input value
  var input_val = input.val();

  // don't validate empty input
  if (input_val === "") { return; }

  // original length
  var original_len = input_val.length;

  // initial caret position
  var caret_pos = input.prop("selectionStart");

  // check for decimal
  if (input_val.indexOf(".") >= 0) {

    // get position of first decimal
    // this prevents multiple decimals from
    // being entered
    var decimal_pos = input_val.indexOf(".");

    // split number by decimal point
    var left_side = input_val.substring(0, decimal_pos);
    var right_side = input_val.substring(decimal_pos);

    // add commas to left side of number
    left_side = formatNumber(left_side);

    // validate right side
    right_side = formatNumber(right_side);

    // On blur make sure 2 numbers after decimal
    if (blur === "blur") {
      right_side += "00";
    }

    // Limit decimal to only 2 digits
    right_side = right_side.substring(0, 2);

    // join number by .
    input_val = "$" + left_side + "." + right_side;

  } else {
    // no decimal entered
    // add commas to number
    // remove all non-digits
    input_val = formatNumber(input_val);
    input_val = "$" + input_val;

    // final formatting
    if (blur === "blur") {
      input_val += ".00";
    }
  }

  // send updated string to input
  input.val(input_val);

  // put caret back in the right position
  var updated_len = input_val.length;
  caret_pos = updated_len - original_len + caret_pos;
  input[0].setSelectionRange(caret_pos, caret_pos);
}

function isNumberKey(evt) {
var charCode = (evt.which) ? evt.which : evt.keyCode;
// Added to allow decimal, period, or delete
if (charCode == 110 || charCode == 190 || charCode == 46)
	return true;

if (charCode > 31 && (charCode < 48 || charCode > 57))
		return false;

	return true;
}


/*
*This function checks if the date1 is greater than date2
*/
function checkDate(date1, date2) {

	let dateOne=[];
	let dateTwo=[];

	if(date1.includes('/')){
		dateOne = date1.split('/');
	}
	if(date2.includes('/')){
		dateTwo = date2.split('/');
	}

	if(date1.includes('-')){
		dateOne = date1.split('-');
	}
	if(date2.includes('-')){
		dateTwo = date2.split('-');
	}

	var dateS = new Date(dateOne[2],dateOne[1],dateOne[0]);
	var dateF = new Date(dateTwo[2],dateTwo[1],dateTwo[0]);
	var dateOpt = dates.compare(dateF, dateS);
	if(dateOpt == 1 || dateOpt == 0){
      return true;
  }else return false;
}

var dates = {
    convert:function(d) {
        // Converts the date in d to a date-object. The input can be:
        //   a date object: returned without modification
        //  an array      : Interpreted as [year,month,day]. NOTE: month is 0-11.
        //   a number     : Interpreted as number of milliseconds
        //                  since 1 Jan 1970 (a timestamp)
        //   a string     : Any format supported by the javascript engine, like
        //                  "YYYY/MM/DD", "MM/DD/YYYY", "Jan 31 2009" etc.
        //  an object     : Interpreted as an object with year, month and date
        //                  attributes.  **NOTE** month is 0-11.
        return (
            d.constructor === Date ? d :
            d.constructor === Array ? new Date(d[0],d[1],d[2]) :
            d.constructor === Number ? new Date(d) :
            d.constructor === String ? new Date(d) :
            typeof d === "object" ? new Date(d.year,d.month,d.date) :
            NaN
        );
    },
    compare:function(a,b) {
        // Compare two dates (could be of any type supported by the convert
        // function above) and returns:
        //  -1 : if a < b
        //   0 : if a = b
        //   1 : if a > b
        // NaN : if a or b is an illegal date
        // NOTE: The code inside isFinite does an assignment (=).
        return (
            isFinite(a=this.convert(a).valueOf()) &&
            isFinite(b=this.convert(b).valueOf()) ?
            (a>b)-(a<b) :
            NaN
        );
    },
    inRange:function(d,start,end) {
        // Checks if date in d is between dates in start and end.
        // Returns a boolean or NaN:
        //    true  : if d is between start and end (inclusive)
        //    false : if d is before start or after end
        //    NaN   : if one or more of the dates is illegal.
        // NOTE: The code inside isFinite does an assignment (=).
       return (
            isFinite(d=this.convert(d).valueOf()) &&
            isFinite(start=this.convert(start).valueOf()) &&
            isFinite(end=this.convert(end).valueOf()) ?
            start <= d && d <= end :
            NaN
        );
    }
};

//checks if html object is empty
function isEmpty(obj){
	if(obj.val().length < 1) {
		opt = true;
	} else {
		opt = false;
	}
	return opt;
}
