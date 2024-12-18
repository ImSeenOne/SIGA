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
            $('#latitud').val(resp.latitud);
            $('#longitud').val(resp.longitud);
			$('#frmDesarrollo').slideToggle();
			$('#btnNvoDesarrollo').slideToggle();
			$('#txtNombre').focus();
			mapa_formregistro()
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
  ocultarBotonesObra(1);
});

$('#btnCancelWork').click(function(){
  $('#frmWork').slideToggle();
  $('#btnNewWork').slideToggle();
	$('#opcion').val(3);
  resetForm('frmWork');
  ocultarBotonesObra(1);
});


function ocultarBotonesObra(flag){
	console.log($("#btnSaveGeo").hasClass('hidden'));
	switch(flag){
		case 1:
			if(!$("#btnSaveGeo").hasClass('hidden')){
				$("#btnSaveGeo").addClass('hidden');
				$("#btnSavePO").addClass('hidden');
				$("#btnSaveEI").addClass('hidden');
				$("#btnSaveMO").addClass('hidden');
			}
			break;
		case 2:
				if($("#btnSaveGeo").hasClass('hidden')){
					$("#btnSaveGeo").removeClass('hidden');
					$("#btnSavePO").removeClass('hidden');
					$("#btnSaveEI").removeClass('hidden');
					$("#btnSaveMO").removeClass('hidden');
				}
			break;
	}
}


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
$('#btnSaveWork').on('click',function(){
	let validity = true;
	if($('#txtName').val().length < 1){
		$('#alert').html('Faltan campos por completar');
		validity = false;
	}
	if($('#inputType').val().length < 1){
		$('#alert').html('Faltan campos por completar');
		validity = false;
	}
	if($('#txtDependency').val().length < 1){
		$('#alert').html('Faltan campos por completar');
		validity = false;
	}
	if($('#inputAmount').val().length < 1){
		$('#alert').html('Faltan campos por completar');
		validity = false;
	}
	if($('#date1').val().length < 1){
		$('#alert').html('Faltan campos por completar');
		validity = false;
	}
	if($('#date2').val().length < 1){
		$('#alert').html('Faltan campos por completar');
		validity = false;
	}
	if($('#txtName').val().length < 1){
		$('#alert').html('Faltan campos por completar');
		validity = false;
	}


    let formData = new FormData(document.getElementById('frmWork'));
		if(validity){
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
					console.log(resp);
	          $('#respServer').empty();
	          if(resp.resp == 1){
				$('#frmWork').slideToggle();
				$('#btnNewWork').slideToggle();
				ocultarBotonesObra(1);
	            work_list();
	            $('#opcion').val(3);
	            resetForm('frmWork');
	          }else{
	            $('#respServer').html('Ocurrió un error al intentar guardar en la base de datos');
	          }
	      }
	    });
		} else {
			$('#reqFormWork').html("Complete todos los campos");
			$('#reqFormWork').addClass('text-danger');
		}

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
			console.log(resp);
			let srcPO = 'pg/modal_presupuesto_obra_est.php?id='+resp.id_obra+'&flag=1';
			let srcEI = 'pg/modal_presupuesto_obra_est.php?id='+resp.id_obra+'&flag=2';
			let srcMO = 'pg/modal_presupuesto_obra_est.php?id='+resp.id_obra+'&flag=3';

            $('#respServer').empty('');
            $('#txtName').val(resp.nombre);
			$('#inputType').val(resp.tipo);
			$('#txtDependency').val(resp.dependencia);
			$('#inputAmount').val(resp.monto);
			$('#inputAmount').keyup();
            $('#date1').val(resp.fecha_inicio);
            $('#date2').val(resp.fecha_finalizacion);
			$('#addedType').val(resp.tipo_agregado);
			$('#txtWorkArea').val(resp.area_obra);
			$('#txtWorkArea').keyup();
			$('#idWork').val(resp.id_obra);
			$('#btnSavePO').data('src',srcPO);
			$('#btnSaveEI').data('src',srcEI);
			$('#btnSaveMO').data('src',srcMO);
			$('#txtDireccion').val(resp.direccion);
			$('#latitud').val(resp.latitud);
			$('#longitud').val(resp.longitud);
			ocultarBotonesObra(2);
			mapa_formregistro()
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
	if($('#frmAddEmployee').is(':hidden')){
		$('#frmAddEmployee').slideToggle();
	}
  if($('#btnNewEmployee').is(':visible')){
		$('#btnNewEmployee').slideToggle();
	}
	if($('#btnSearchEmployee').is(':visible')){
		$('#btnSearchEmployee').slideToggle();
	}
	if($('#frmSearchEmployee').is(':visible')){
		$('#frmSearchEmployee').slideToggle();
	}
  $('#txtName').focus();
});
//
$('#btnSearchEmployee').click(function(){
	if($('#frmAddEmployee').is(':visible')){
		$('#frmAddEmployee').slideToggle();
	}
  if($('#btnNewEmployee').is(':visible')){
		$('#btnNewEmployee').slideToggle();
	}
	if($('#btnSearchEmployee').is(':visible')){
		$('#btnSearchEmployee').slideToggle();
	}
	if($('#frmSearchEmployee').is(':hidden')){
		$('#frmSearchEmployee').slideToggle();
	}

	$('#txtEmployee').focus();
});


$('#btnCancelSearch').click(function(){
	if($('#frmAddEmployee').is(':visible')){
		$('#frmAddEmployee').slideToggle();
	}
  if($('#btnNewEmployee').is(':hidden')){
		$('#btnNewEmployee').slideToggle();
	}
	if($('#btnSearchEmployee').is(':hidden')){
		$('#btnSearchEmployee').slideToggle();
	}
	if($('#frmSearchEmployee').is(':visible')){
		$('#frmSearchEmployee').slideToggle();
	}
  resetForm('frmSearchEmployee');
});

$('#btnCancelEmployee').click(function(){
	if($('#frmAddEmployee').is(':visible')){
		$('#frmAddEmployee').slideToggle();
	}
  if($('#btnNewEmployee').is(':hidden')){
		$('#btnNewEmployee').slideToggle();
	}
	if($('#btnSearchEmployee').is(':hidden')){
		$('#btnSearchEmployee').slideToggle();
	}
	if($('#frmSearchEmployee').is(':visible')){
		$('#frmSearchEmployee').slideToggle();
	}
	$('#opcion').val(7);
  resetForm('frmAddEmployee');
});



$('#frmAddEmployee').submit(function(event){
			event.preventDefault();
	    // if($('#txtName').val().length < 1){
	    //   $('#txtName').focus();
	    //   $('#reqTxtName').html('Este campo es requerido');
	    //   return false;
	    // }else{
	    //   $('#reqTxtNombre').empty();
	    // }
			//
			// if($('#txtLastName').val().length < 1){
			// 	$('#txtLastName').focus();
			// 	$('#reqTxtLastName').html('Este campo es requerido');
			// 	return false;
			// }else{
			// 	$('#reqTxtLastName').empty();
			// }
			//
			// if($('#txtMLastName').val().length < 1){
			// 	$('#txtMLastName').focus();
			// 	$('#reqTxtMLastName').html('Este campo es requerido');
			// 	return false;
			// }else{
			// 	$('#reqTxtMLastName').empty();
			// }
			//
			// if($('#txtAddress').val().length < 1){
			// 	$('#txtAddress').focus();
			// 	$('#reqTxtAddress').html('Este campo es requerido');
			// 	return false;
			// }else{
			// 	$('#reqTxtAddress').empty();
			// }
			//
			// if($('#txtIMSS').val().length < 11){
			// 	$('#txtIMSS').focus();
			// 	$('#reqTxtIMSS').html('Verifica este campo');
			// 	return false;
			// }else{
			// 	$('#reqTxtCURP').empty();
			// }
			//
			// if($('#txtCURP').val().length < 18){
			// 	$('#txtCURP').focus();
			// 	$('#reqTxtCURP').html('Verifica este campo');
			// 	return false;
			// }else{
			// 	$('#reqTxtCURP').empty();
			// }
			//
			// if($('#admissionDate').val().length < 1){
			// 	$('#admissionDate').focus();
			// 	$('#reqAdmissionDate').html('Este campo es requerido');
			// 	return false;
			// }else{
			// 	$('#reqAdmissionDate').empty();
			// }

	    let formData = new FormData($(this)[0]);

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
							$('#respServer').html('<p class="text-danger">Ocurrió un error al intentar guardar en la base de datos <br>Verifique que la CURP, IMSS o RFC no hayan sido agregadas antes.</p>');
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
	$('#btnNewEmployee').trigger('click');
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

function departmentChanged(){
	let idDpt = $('#txtDepartment').val();
	$.ajax({
		beforeSend: function(){
			$('#respServerArea').html(cargando);
		},
		url: urlConsultas3,
		type: 'POST',
		dataType: 'JSON',
		data: {id: idDpt, opt: 27},
		success: function(resp){
			$('#respServerArea').html('');
			$('#txtArea').empty();
			$('#txtArea').append(resp.htmlcode);
			$('#txtArea').removeAttr('disabled');
		}
	});
}

/*******************************************************************************
********************************************************************************
********************************************************************************
*******************FUNCIONES PARA CATEGORÍAS DE EMPLEADOS***********************
********************************************************************************
********************************************************************************
*******************************************************************************/

function listEmpCategories(){
	$.ajax({
		beforeSend: function(){
			$('#cntnListEmpCategory').html(cargando);
		},
		url: 'pg/categoria_empleado_listado.php',
		type: 'POST',
		dataType: 'HTML',
		success: function(data){
			$('#cntnListEmpCategory').html(data);
			loadDataTable('listEmpCategory', false);
		}
	})
}

$('#frmEmpCategory').submit(function(event){

	event.preventDefault();

	let formData = new FormData($(this)[0]);

	$.ajax({
		beforeSend: function(){
			$('#respServer').html(cargando);
		},
		type: 'POST',
		dataType: 'JSON',
		url: urlSubir3,
		data: formData,
		cache: false,
		contentType: false,
		processData: false,
		success: function(resp){
			if(resp.resp == 1){
				$('#respServer').html('');
				resetForm('frmEmpCategory');
				listEmpCategories();
				$('#opcion').val('30');
			}
		}
	});
});

function editEmpCategory(id){
	$.ajax({
		beforeSend: function(){
			$('#respServer').html(cargando);
		},
		type: 'POST',
		data: {id: id, opt: 13},
		dataType: 'JSON',
		url: urlConsultas3,
		success: function(resp){
			$('#id').val(resp.id);
			$('#name').val(resp.name);
			$('#workDays').val(resp.workDays);
			$('#payment').val(resp.payment);
			$('#payment').trigger('keyup');
			$('#respServer').html('');
			$('#opcion').val('30');
		}
	});
}

function deleteEmpCategory(id, name){
	swal({
				html: true,
				title: '¿Está seguro?',
				text: 'eliminar la categoría <strong>' + name + '</strong>',
				type: 'warning',
				showCancelButton: true,
				cancelButtonClass: 'btn-primary',
				confirmButtonColor: '#DD6B55',
				confirmButtonText: 'Aceptar',
				cancelButtonText: 'Cancelar',
				closeOnConfirm: true
			},
			function(){
					let params = {'id':id, 'opt':13};
					$.ajax({
							type:    'POST',
							url:     urlEliminar3,
							data:    params,
							dataType: 'json',
							success: function(resp){
										if(resp.resp == 1){
												listEmpCategories();
										} else {
											$('#respServer').html(resp.msg);
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
		if($('#work').val() > 0 || $('#employee').val() > 0){
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
											$('#cancelPaymentBtn').trigger('click');
										}
									}
							});
					});
		} else {
			let opciones = {
  			appendTo:'#frmPayment',
  			minWidth:300,
  			maxWidth: 350,
  		};
  		parent.mensaje("Debes escoger una obra y/o un empleado",'warning',opciones);
		}

});

function seePaymentDetails(id){
	$('#paymentDetailsLabel').html('Detalles del pago');
	$('#paymentDataModal').removeAttr('style');
	$('#flAddedActivities').attr('style', 'display: none;');
	$.ajax({
		beforeSend: function(){
			$('#respServerModal').html(cargando);
		},
		type: 'POST',
		dataType: 'JSON',
		url: urlConsultas3,
		data: {id: id, opt: 26},
		success: function(resp){
			$('#respServerModal').html('');
			$('#idPaymentModal').html(id);
			$('#idModal').val(id);
			$('#employeeModal').html(resp.employee);
			$('#workModal').html(resp.work);
			$('#totalAmountModal').html('$'+resp.totalAmount);
			$('#foodAmountModal').html('$'+resp.foodAmount);
			$('#totalPaymentModal').html('$'+resp.baseAmount);
			$('#periodModal').html('de '+resp.dateStart+' a '+resp.dateFinish);
			$('#statusModal').html(resp.status);
			$('#perceptionsModal').html('$'+resp.perceptions);
			$('#deductionsModal').html('$'+resp.deductions);
			if(resp.remarks.length > 0){
				$('#remarksModal').html(resp.remarks);
			} else {
				$('#remarksModal').html('<cite>No hay observaciones</cite>');
			}

			$('#registerDate').html(resp.registerDate);
		}
	});
}

function addPaymentActivities(id, name, work, period){
	$('#paymentDetailsLabel').html('Agregar actividades añadidas');
	$('#paymentDataModal').attr('style', 'display: none;');
	$('#flAddedActivities').removeAttr('style');
	$('#idModal').val(id);
	$('#employeeCiteModal').html(name);
	$('#workCiteModal').html(work);
	$('#periodCiteModal').html(period);
	let urlPag = 'pg/raya_modal_listado.php';
	$.ajax({
				beforeSend: function(){
						$('#cntnListPaymentActivitiesModal').html(cargando);
				},
				type:    'POST',
				data: {id: id},
				url:     urlPag,
				dataType: 'HTML',
				success: function(data){
						$('#cntnListPaymentActivitiesModal').html(data);
				}
	});
}

$('#frmAddActivity').submit(function(event){
	if($('#addedActivity').val() > 0){
		event.preventDefault();
			let formData = new FormData(document.getElementById('frmAddActivity'));
		$.ajax({
			beforeSend: function(){
				$('#cntnListPaymentActivitiesModal').html(cargando);
			},
			url: urlSubir3,
			type: 'POST',
			dataType: 'JSON',
			data: formData,
			cache: false,
			contentType: false,
			processData: false,
			success(resp){
				$('#employeeCiteModal').html();
				$('#workCiteModal').html();
				$('#periodCiteModal').html();
				addPaymentActivities($('#idModal').val(), $('#employeeCiteModal').html(), $('#workCiteModal').html(), $('#periodCiteModal').html());
				resetForm('frmAddActivity');
			}
		})
	} else {
		let opciones = {
			appendTo:'#frmAddActivity',
			minWidth:300,
			maxWidth: 350,
		};
		parent.mensaje("Debes escoger una actividad para añadir",'warning',opciones);
		event.preventDefault();
	}

});

function listAddedActivities(id){
	let urlPag = 'pg/raya_modal_listado.php';
	$.ajax({
				beforeSend: function(){
						$('#cntnListPaymentActivitiesModal').html(cargando);
				},
				type:    'POST',
				data: {id: id},
				url:     urlPag,
				dataType: 'HTML',
				success: function(data){
						$('#cntnListPaymentActivitiesModal').html(data);
				}
	});
}

function deleteAssAddedActivity(id, name, quant){
	swal({
				html: true,
				title: '¿Está seguro?',
				text: '¿Eliminará el registro de la actividad añadida de tipo <strong>' + name + '</strong> y de cantidad '+ quant +'?',
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#DD6B55',
				confirmButtonText: 'Eliminar',
				cancelButtonText: 'Cancelar',
				closeOnConfirm: true
			},
			function(){
					let params = {'id':id, 'opt':51};
					$.ajax({
							type:    'POST',
							url:     urlEliminar3,
							data:    params,
							dataType: 'json',
							success: function(resp){
										if(resp.resp == 1){
												listAddedActivities($('#idModal').val());
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

function seeAdmPaymentDetails(id){
	$('#admPaymentDetailsLabel').html('Detalles del pago de nómina');
	$('#admPaymentDataModal').removeAttr('style');
	$('#flAdmAddedActivities').attr('style', 'display: none;');
	$.ajax({
		beforeSend: function(){
			$('#respServerModal').html(cargando);
		},
		type: 'POST',
		dataType: 'JSON',
		url: urlConsultas3,
		data: {id: id, opt: 28},
		success: function(resp){
			$('#respServerModal').html('');
			$('#idPaymentModal').html(id);
			$('#idModal').val(id);
			$('#employeeModal').html(resp.employee);
			$('#totalAmountModal').html('$'+resp.totalAmount);
			$('#foodAmountModal').html('$'+resp.foodAmount);
			$('#totalPaymentModal').html('$'+resp.baseAmount);
			$('#periodModal').html('de ' + resp.dateStart + ' a ' + resp.dateFinish);
			$('#statusModal').html(resp.status);
			$('#perceptionsModal').html('$'+resp.perceptions);
			$('#deductionsModal').html('$'+resp.deductions);
			if(resp.remarks.length > 0){
				$('#remarksModal').html(resp.remarks);
			} else {
				$('#remarksModal').html('<cite>No hay observaciones</cite>');
			}

			$('#registerDate').html(resp.registerDate);
		}
	});
}

function addAdmPaymentActivities(id, name, period){
	$('#admPaymentDetailsLabel').html('Agregar actividades añadidas');
	$('#admPaymentDataModal').attr('style', 'display: none;');
	$('#flAdmAddedActivities').removeAttr('style');
	$('#idModal').val(id);
	$('#employeeCiteModal').html(name);
	$('#periodCiteModal').html(period);
	let urlPag = 'pg/nom_adm_modal_listado.php';
	$.ajax({
				beforeSend: function(){
						$('#cntnListAdmPaymentActivitiesModal').html(cargando);
				},
				type:    'POST',
				data: {id: id},
				url:     urlPag,
				dataType: 'HTML',
				success: function(data){
						$('#cntnListAdmPaymentActivitiesModal').html(data);
				}
	});
}

$('#frmAdmAddActivity').submit(function(event){
	if($('#addedActivity').val() > 0){
			event.preventDefault();
			let formData = new FormData($(this)[0]);
		$.ajax({
			beforeSend: function(){
				$('#cntnListAdmPaymentActivitiesModal').html(cargando);
			},
			url: urlSubir3,
			type: 'POST',
			dataType: 'JSON',
			data: formData,
			cache: false,
			contentType: false,
			processData: false,
			success(resp){
				$('#employeeCiteModal').html();
				$('#periodCiteModal').html();
				addAdmPaymentActivities($('#idModal').val(), $('#employeeCiteModal').html(), $('#periodCiteModal').html());
				resetForm('frmAdmAddActivity');
			}
		})
	} else {
		let opciones = {
			appendTo:'#frmAdmAddActivity',
			minWidth:300,
			maxWidth: 350,
		};
		parent.mensaje("Debes escoger una actividad para añadir",'warning',opciones);
		event.preventDefault();
	}

});

function listAdmAddedActivities(id){
	let urlPag = 'pg/nom_adm_modal_listado.php';
	$.ajax({
				beforeSend: function(){
						$('#cntnListAdmPaymentActivitiesModal').html(cargando);
				},
				type:    'POST',
				data: {id: id},
				url:     urlPag,
				dataType: 'HTML',
				success: function(data){
						$('#cntnListAdmPaymentActivitiesModal').html(data);
				}
	});
}

function deleteAssAdmAddedActivity(id, name, quant){
	swal({
				html: true,
				title: '¿Está seguro?',
				text: '¿Eliminará el registro de la actividad añadida de tipo <strong>' + name + '</strong> y de cantidad '+ quant +'?',
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#DD6B55',
				confirmButtonText: 'Eliminar',
				cancelButtonText: 'Cancelar',
				closeOnConfirm: true
			},
			function(){
					let params = {'id':id, 'opt':52};
					$.ajax({
							type:    'POST',
							url:     urlEliminar3,
							data:    params,
							dataType: 'json',
							success: function(resp){
										if(resp.resp == 1){
												listAdmAddedActivities($('#idModal').val());
										}
							}
					});
			});
}

function changePaymentStatus(type, id, status){
	switch (type) {
		//CAMBIA EL STATUS DE UN PAGO DE RAYA
		case 1:
			$.ajax({
				beforeSend: function(){
					$('#buttonChangePaymentStatus').hide('blind');
				},
				type: 'POST',
				dataType: 'JSON',
				data: {id: id, status: status, opcion: 46},
				url: urlSubir3,
				success: function(resp){
					if(resp.resp == 1){
						listPayments();
					}
					$('#buttonChangePaymentStatus').show('blind');
				}
			});
		break;
		//CAMBIA EL STATUS DE UNA NÓMINA ADMINISTRATIVA
		case 2:
		$.ajax({
			beforeSend: function(){
				$('#buttonChangePaymentStatus').hide('blind');
			},
			type: 'POST',
			dataType: 'JSON',
			data: {id: id, status: status, opcion: 47},
			url: urlSubir3,
			success: function(resp){
				if(resp.resp == 1){
					listAdmPayments();
				}
				$('#buttonChangePaymentStatus').show('blind');
			}
		});
		break;
	}
}

/*******************************************************************************/
/*******************************************************************************/
/*******************************************************************************/
/*******************************************************************************/
/*******************************************************************************/
/**************************FUNCIONES PARA AVANCES F*****************************/
/*******************************************************************************/
/*******************************************************************************/
/*******************************************************************************/

	//AGREGA UN NUEVO AVANCE FÍSICO
	$('#newPhysProg').submit(function(event){
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
				success: function(resp){
					if(resp.resp == 1){
						$('#respServer').html("");

						resetForm('newPhysProg');

						listPhysProg();

						if($('#newPhysProg').is(':visible')){
							$('#newPhysProg').slideToggle();
						}

						if($('#btnNewPhysProg').is(':hidden')){
							$('#btnNewPhysProg').slideToggle();
						}

						$('#opcion').val("15");
				} else {
					$("#respServer").html(resp.msg);
				}

				}
		});
	});

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
	$('#opcion').val("15");
	$('#id').html("");
	resetForm('newPhysProg');
	if($('#newPhysProg').is(':visible')){
		$('#newPhysProg').slideToggle();
	}
	if($('#btnNewPhysProg').is(':hidden')){
		$('#btnNewPhysProg').slideToggle();
	}
});

function setConceptData(){
	let id = $('#concepts').val();
	let unit = $('#concepts').find(':selected').data('unit'+id);
	let maxQuant = parseFloat($('#concepts').find(':selected').data('quant'+id));
	let totalQuant = $('#concepts').find(':selected').data('total'+id);
	$('#quantity').attr({'max': maxQuant});
	$('#unit').val(''+unit+'');
	$('#totalQuant').val(''+maxQuant+'');
}

function fillConcepts(){
		$('#waitingConcepts').html(cargando);
		$('#concepts').slideToggle();
		var work = $('#workConcepts').val();
		let params = {'work': work, 'opt': 21}
		let element = '';
    $.ajax({
        type:    'POST',
        url:     urlConsultas3,
        data:    params,
        dataType: 'json',
        success: function(resp){
            element+= '<option value="0">Seleccionar...</option>';
            $.each(resp.concepts,function(i,y){
							console.log('ID: '+y['id']+'::MQ: '+y['max_quantity']);
							if(y['max_quantity']>0){
								element+= '<option value="' + y['id'] + '" data-quant'+y['id']+'="'+y['max_quantity']+'" data-code'+y['id']+'="'+y['code']+'" data-unit'+y['id']+'="'+y['unit']+'" data-used'+y['id']+'="'+y['used_quantity']+'" data-total'+y['id']+'="'+y['quantity']+'">' + y['concept'] + '</option>';
							}
            });
						$("#concepts").empty();
            $('#concepts').append(element);
						$('#concepts').slideToggle();
						$('#waitingConcepts').html("");
        }
    });
	}
//
// function listUsedConcepts(id){
// 	$.ajax({
// 		beforeSend: function(){
// 			$('#listConceptsDetail').hide();
// 			$('#respServerModalDetail').html(cargando);
// 		},
// 		type: 'POST',
// 		params: {'id': id, 'opt': 23},
// 		dataType: 'JSON',
// 		success: function(resp){
// 			if(resp.resp == 1){
// 				$('#listConceptsDetail').show();
// 				$.each(resp.concepts,function(i,y){
// 					if(y['used_quantity'] > 0){
// 						$('#listConceptsDetail tbody').append(
// 						'<tr>'+
// 						'<td>'+y['id']+'</td>'+
// 						'<td>'+y['code']+'</td>'+
// 						'<td>'+y['concept']+'</td>'+
// 						'<td>'+y['used_quantity']+'</td>'+
// 						'<td>'+y['unit']+'</td>'+
// 						'</tr>');
// 					}
// 				});
// 				$('#listConceptsDetail tbody').append()
// 			}
// 		}
// 	});
// }

function addConcepts(id){
	$("#respServerModalDetail").html(cargando);
	$.ajax({
				beforeSend: function(){
						$("#respServerModalDetail").html(cargando);
				},
				type:    'post',
				url:     urlConsultas3,
				data: {'id':id, 'opt':23},
				dataType: 'json',
				success: function(resp){
						let  fine = false;
						$.each(resp.concepts,function(i,y){
							if(y['used_quantity'] > 0){
								fine = true;
								$('#listConceptsDetail tr').remove();
								$('#listConceptsDetail tbody').append(
								'<tr>'+
								'<td>'+y['id']+'</td>'+
								'<td>'+y['code'].substring(0, 100)+'</td>'+
								'<td>'+y['concept']+'</td>'+
								'<td>'+y['used_quantity']+'</td>'+
								'<td>'+y['unit']+'</td>'+
								'<td><button type="button" id="deleteConcept" class="btn btn-danger" onclick="deleteConcept('+y['realID']+')"><i class="fa fa-trash"></i></button></td>'+
								'</tr>');
								$('#respServerModalDetail').html('');
							}
						});
						if(!fine){
							$('#listConceptsDetail').slideToggle();
							$('#respServerModalDetail').html('<center><h4>¡No hay conceptos usados para éste avance!</h4></center>');
						}
						$('#folioModal').html(resp.folio);
						$('#residentModal').html(resp.resident);
						$('#workModal').html(resp.work);
						$('#workConcepts').val(resp.work_id);
						$('#physProgId').val(id);
						fillConcepts();
				}
	});
}

$('#saveConcept').click(function(){

	let formData = new FormData(document.getElementById('frmConcept'));
	if(parseFloat($('#quantity').attr('max'))>=parseFloat($('#quantity').val())){
		$.ajax({
			beforeSend: function(){
				$('#respServerModalDetail').html(cargando);
			},
			url: urlSubir3,
			type: 'POST',
			data: formData,
			cache: false,
			contentType: false,
			processData: false,
			dataType: 'JSON',
			success: function(resp){
				if(resp.resp == 1){
					$('#quantity').val('');
					$('#totalQuant').val('');
					addConcepts($('#physProgId').val());
				}
			}
		});
	} else {
		let opciones = {
			appendTo:'#frmConcept',
			minWidth:300,
			maxWidth: 350,
		};
		parent.mensaje("Debes utilizar una cantidad menor a la cantidad restante",'warning',opciones);
	}

});

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
	$("#respServer").html(cargando);
	$.ajax({
				beforeSend: function(){
						$("#respServer").html(cargando);
				},
				type:    'post',
				url:     urlConsultas3,
				data: {'id':id, 'opt':8},
				dataType: 'json',
				success: function(resp){
					$("#listConcepts tbody tr").each(function (index) {
						deleteTR($(this).attr('id'));
					});
					console.log(resp);
					$('#resident').val(resp.resident);
					$('#work').val(resp.work);
					$('#concept').select2();
					$('#dateStart').val(resp.dateStart.split('-')[2]+'/'+resp.dateStart.split('-')[1]+'/'+resp.dateStart.split('-')[0]);
					$('#dateFinish').val(resp.dateFinish.split('-')[2]+'/'+resp.dateFinish.split('-')[1]+'/'+resp.dateFinish.split('-')[0]);
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

function deleteConcept(id){
	$.ajax({
		beforeSend: function(){
			$('#listConceptsDetail tbody').empty();
			$('#respServerModalDetail').html(cargando);
		},
		data: {id: id, opt: 50},
		type: 'POST',
		url: urlEliminar3,
		dataType: 'JSON',
		success: function(resp){
			if(resp.resp == 1){
				addConcepts($('#physProgId').val());
				fillConcepts();
			} else {
				swal({
		     title: resp.msg,
		     type: "warning",
		     timer: 1500
		     });
			}
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
/*******************************FUNCIONES PARA**********************************/
/*******************************TIPOS DE GASTOS*********************************/
/*******************************************************************************/
/*******************************************************************************/
/*******************************************************************************/
$('#cancelExpenseType').click(function(){
	$('#opcion').val('23');
	resetForm('frmExpenseType');
});


function listExpensesTypes(){
	urlPag = 'pg/tipo_gasto_listado.php';

  $.ajax({
        beforeSend: function(){
            $("#cntnListExpensesTypes").html(cargando);
        },
        type:    'POST',
        url:     urlPag,
        //data:    params,
        dataType: 'HTML',
        success: function(data){
            $('#cntnListExpensesTypes').html(data);
            loadDataTable('listExpensesTypes', false);
        }
  });
}

$('#frmExpenseType').submit(function(event){

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
								resetForm('frmExpenseType');
								$('#opcion').val('23');
								listExpensesTypes();
							}else{
								$('#respServer').html('Ocurrió un error al intentar guardar en la base de datos');
							}
					}
	});
});

function updateExpenseType(id){
	$.ajax({
		beforeSend: function(){
			$('#respServer').html(cargando);
			resetForm('frmExpenseType');
		},
		type: 'POST',
		data: {id:id, opt: 12},
		dataType: 'JSON',
		url: urlConsultas3,
		success: function(resp){
			$('#id').val(resp.id);
			$('#name').val(resp.name);
			$('#respServer').html('');
			$('#opcion').val('24');
		}
	});
}

function deleteExpenseType(id, name){
	swal({
        html: true,
        title: '¿Está seguro?',
        text: 'Se eliminará el tipo de gasto \'<strong>' + name + '</strong>\'',
        type: 'warning',
        showCancelButton: true,
        cancelButtonClass: 'btn-primary',
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
        closeOnConfirm: true
      },
      function(){
          let params = {'id':id, 'opt': 11};
          $.ajax({
              type:    'POST',
              url:     urlEliminar3,
              data:    params,
              dataType: 'JSON',
              success: function(resp){
                listExpensesTypes();
              }
          });
					listExpensesTypes();
	});
}



/*******************************************************************************/
/*******************************************************************************/
/*******************************************************************************/
/*******************************FUNCIONES PARA**********************************/
/***********************************GASTOS**************************************/
/*******************************************************************************/
/*******************************************************************************/
/*******************************************************************************/

//LISTA LOS GASTOS
function listExpenses(month='', year='', expenseType = ''){
	urlPag = 'pg/gastos_listado.php';

	let params = {'month': month, 'year': year, 'expenseType': expenseType};

  $.ajax({
        beforeSend: function(){
            $('#cntnListExpenses').html(cargando);
        },
        type:    'POST',
        url:     urlPag,
				data: params,
        dataType: 'HTML',
        success: function(data){
            $('#cntnListExpenses').html(data);
            loadDataTable('listExpenses', false);
        }
  });
}

//ACTIVA LA CREACIÓN DE UN NUEVO GASTO
$('#btnNewExpense').click(function(){
	if($('#frmNewExpense').is(':hidden')){
		$('#frmNewExpense').slideToggle();
	}
	if($('#frmExpenseSearch').is(':visible')){
		$('#frmExpenseSearch').slideToggle();
	}
	if($('#btnSearchExpense').is(':hidden')){
		$('#btnSearchExpense').slideToggle();
	}
	if($('#btnNewExpense').is(':visible')){
		$('#btnNewExpense').slideToggle();
	}

	resetForm('frmNewExpense');
	$('#amount').val(0);
	$('#amount').keyup();
});

//ACTIVA LA BÚSQUEDA
$('#btnSearchExpense').click(function(){
	if($('#frmExpenseSearch').is(':hidden')){
		$('#frmExpenseSearch').slideToggle();
	}
	if($('#btnSearchExpense').is(':visible')){
		$('#btnSearchExpense').slideToggle();
	}
	if($('#frmNewExpense').is(':visible')){
		$('#frmNewExpense').slideToggle();
	}
	if($('#btnNewExpense').is(':hidden')){
		$('#btnNewExpense').slideToggle();
	}
	resetForm('frmExpenseSearch');
});

//CANCELA LA CREACIÓN DE UN NUEVO GASTO
$('#cancelExpense').click(function(){
	if($('#frmNewExpense').is(':visible')){
		$('#frmNewExpense').slideToggle();
	}
	if($('#btnNewExpense').is(':hidden')){
		$('#btnNewExpense').slideToggle();
	}
});

//REINICIA EL FORMATO DE BÚSQUEDA
$('#resetSearchForm').click(function(){
	resetForm('frmExpenseSearch');
	listExpenses();
});

//BUSCA EL GASTO
$('#searchExpense').click(function() {
	let month = $('#searchMonth').val();
	let year = $('#searchYear').val();
	let expenseType = $('#searchExpenseType').val();
	listExpenses(month, year, expenseType);
});

//CANCELA LA BÚSQUEDA
$('#cancelSearch').click(function(){
	if($('#frmExpenseSearch').is(':visible')){
		$('#frmExpenseSearch').slideToggle();
	}
	if($('#btnSearchExpense').is(':hidden')){
		$('#btnSearchExpense').slideToggle();
	}
	listExpenses();
});

//CREA UN NUEVO GASTO
$('#frmNewExpense').submit(function(event){
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
							if($('#frmNewExpense').is(':visible')){
								$('#frmNewExpense').slideToggle();
							}
							if($('#btnNewExpense').is(':hidden')){
								$('#btnNewExpense').slideToggle();
							}
							if(resp.resp == 1 ){
								$('#respServer').html('');
								resetForm('frmNewExpense');
								$('#opcion').val('25');
								listExpenses();
							}else{
								$('#respServer').html('Ocurrió un error al intentar guardar en la base de datos');
							}
					}
	});
});

//CANCELA EL GASTO
function cancelExpense(id, name) {
	swal({
				html: true,
				title: '¿Está seguro?',
				text: 'Se eliminará el gasto <strong>#' + id + '</strong>: \''+ name +'\'',
				type: 'warning',
				showCancelButton: true,
				cancelButtonClass: 'btn-primary',
				confirmButtonColor: '#DD6B55',
				confirmButtonText: 'Aceptar',
				cancelButtonText: 'Cancelar',
				closeOnConfirm: true
			},
			function(){
					let params = {'id':id, 'opt': 12};
					$.ajax({
							type:    'POST',
							url:     urlEliminar3,
							data:    params,
							dataType: 'JSON',
							success: function(resp){
								listExpenses();
							}
					});
	});
}

/*******************************************************************************/
/*******************************************************************************/
/*******************************************************************************/
/**********************************Gasolina Interna*****************************/
/*******************************************************************************/
/*******************************************************************************/
/*******************************************************************************/

function listInsFuelExps(){
	$.ajax({
		beforeSend: function(){
			$('#cntnListInsFuelExp').html(cargando);
		},
		type: 'POST',
		url: 'pg/gasolina_interna_listado.php',
		dataType: 'HTML',
		success: function(data){
			$('#cntnListInsFuelExp').html(data);
			loadDataTable('listInsFuelExp', true);
		}
	});
}

$('#btnCancelInsFuelExp').click(function(){
	if($('#btnNewInsFuelExp').is(':hidden')){
		$('#btnNewInsFuelExp').slideToggle();
	}

	if($('#frmNewInsFuelExp').is(':visible')){
		$('#frmNewInsFuelExp').slideToggle();
	}
	resetForm('frmNewInsFuelExp');
	$('#opcion').val('27');
});

$('#btnNewInsFuelExp').click(function(){
	if($('#btnNewInsFuelExp').is(':visible')){
		$('#btnNewInsFuelExp').slideToggle();
	}

	if($('#frmNewInsFuelExp').is(':hidden')){
		$('#frmNewInsFuelExp').slideToggle();
	}
	$('#status').val(1);
	$('#opcion').val('27');
});

$('#frmNewInsFuelExp').submit(function(event){

	event.preventDefault();

	let formData = new FormData($(this)[0]);

	$.ajax({
					beforeSend: function(){
						$('#respServer').html(cargando);
					},
					url: urlSubir3,
					type: 'POST',
					dataType: 'JSON',
					data: formData,
					cache: false,
					contentType: false,
					processData: false,
					success: function(resp){
							if(resp.resp == 1 ){
								if($('#btnNewInsFuelExp').is(':hidden')){
									$('#btnNewInsFuelExp').slideToggle();
								}

								if($('#frmNewInsFuelExp').is(':visible')){
									$('#frmNewInsFuelExp').slideToggle();
								}
								resetForm('frmNewInsFuelExp');
								$('#respServer').html('');
								$('#opcion').val('27');
								$('#magnaLts').removeAttr('min');
								$('#premiumLts').removeAttr('min');
								$('#dieselLts').removeAttr('min');
								listInsFuelExps();
							}else{
								$('#respServer').html('Ocurrió un error al intentar guardar en la base de datos');
							}
					}
	});
});

function setGasMax(){
	if($('#fuelTypeModal').val() > 0){
		let fuelType = $('#fuelTypeModal').val();
		let id = $('#idInsFuelExpModal').val();
		$.ajax({
			beforeSend: function(){
				$('#waitGasResponse').html(cargando);
			},
			type: 'POST',
			data: {'id': id, 'fuelType': fuelType,'opt': 25},
			url: urlConsultas3,
			dataType: 'JSON',
			success: function(resp){
				$('#waitGasResponse').html('');

				if(parseFloat(resp.max_liters) > 0){
					$('#litersModal').removeAttr('disabled');
					$('#litersModal').attr({'max': resp.max_liters});
				}
			}
		});
	} else {
		$('#litersModal').prop('disabled', true);
	}
}

function listFuelExpAssEmployees(id){
	$('#idInsFuelExpModal').val(id);
	$('#btnCancelInsFuelExp').trigger('click');
	$.ajax({
		beforeSend: function(){
			$('#cntnListAssignedFuelExpenses').html(cargando);
		},
		data: {'id': id},
		type: 'POST',
		dataType: 'HTML',
		url: 'pg/gasolina_interna_asignacion_modal_listado.php',
		success: function(data){
			$('#cntnListAssignedFuelExpenses').html(data);
		}
	});
}

$('#frmAssignExpense').submit(function(event){

	event.preventDefault();

	let formData = new FormData($(this)[0]);
	if($('#employeeModal').val() > 0){
		$.ajax({
			beforeSend: function(){
				$('#respServerAssFuelExp').html(cargando);
			},
			url: urlSubir3,
			type: 'POST',
			data: formData,
			dataType: 'JSON',
			cache: false,
			contentType: false,
			processData: false,
			success: function(resp){
				if(resp.resp == 1){
					$('#respServerAssFuelExp').html('');
					listFuelExpAssEmployees($('#idInsFuelExpModal').val());
					resetForm('frmAssignExpense');
					$('#respServerAssFuelExp').html('');
					$('#litersModal').prop('disabled', true);
					$('#litersModal').val('');
				} else {
					$('#respServerAssFuelExp').html(resp.msg);
				}
			}
		});
	} else {
		swal({
     title: "Debes seleccionar un empleado",
     type: "warning",
     timer: 1500
     });
	}

});

function editInsFuelExp(id){
	$.ajax({
		beforeSend: function(){
			$('#respServer').html(cargando);
		},
		type: 'POST',
		data: {id: id, opt: 15},
		dataType: 'JSON',
		url: urlConsultas3,
		success: function(resp){
			console.log(resp);
			if($('#btnNewInsFuelExp').is(':visible')){
				$('#btnNewInsFuelExp').slideToggle();
			}

			if($('#frmNewInsFuelExp').is(':hidden')){
				$('#frmNewInsFuelExp').slideToggle();
			}
			$('#folio').val(resp.folio);
			$('#dateStart').val(resp.dateStart);
			$('#dateFinish').val(resp.dateFinish);
			$('#status').val(resp.status);
			$('#magna').val(resp.priceMagna);
			$('#magna').trigger('blur');
			$('#premium').val(resp.pricePremium);
			$('#premium').trigger('blur');
			$('#diesel').val(resp.priceDiesel);
			$('#diesel').trigger('blur');
			$('#magnaLts').val(resp.magna);
			$('#magnaLts').attr({'min': parseFloat(resp.maxMagna)});
			$('#premiumLts').val(resp.premium);
			$('#premiumLts').attr({'min': parseFloat(resp.maxPremium)});
			$('#dieselLts').val(resp.diesel);
			$('#dieselLts').attr({'min': parseFloat(resp.maxDiesel)});
			$('#diesel').trigger('keyup');
			$('#work').val(resp.work);
			$('#id').val(resp.id);
			$('#opcion').val(34);
			$('#respServer').html('');
		}
	})
}

function deleteInsFuelExp(id, name){
	swal({
				html: true,
				title: '¿Está seguro?',
				text: 'Se eliminará el registro <strong>#' + id + '</strong>: \''+ name +'\'',
				type: 'warning',
				showCancelButton: true,
				cancelButtonClass: 'btn-primary',
				confirmButtonColor: '#DD6B55',
				confirmButtonText: 'Aceptar',
				cancelButtonText: 'Cancelar',
				closeOnConfirm: true
			},
			function(){
					let params = {'id':id, 'opt': 15};
					$.ajax({
							type:    'POST',
							url:     urlEliminar3,
							data:    params,
							dataType: 'JSON',
							success: function(resp){
								if(resp.resp == 1){
										listInsFuelExps();
								} else {
									$('#respServer').html(resp.msg);
								}
							}
					});
	});
}

function deleteInsFuelExpEmp(id, name){
	swal({
				html: true,
				title: '¿Está seguro?',
				text: 'Se borrará el registro <strong>#' + id + '</strong> del empleado '+ name +'.',
				type: 'warning',
				showCancelButton: true,
				cancelButtonClass: 'btn-primary',
				confirmButtonColor: '#DD6B55',
				confirmButtonText: 'Aceptar',
				cancelButtonText: 'Cancelar',
				closeOnConfirm: true
			},
			function(){
					let params = {'id':id, 'opt': 16};
					$.ajax({
							type:    'POST',
							url:     urlEliminar3,
							data:    params,
							dataType: 'JSON',
							success: function(resp){
								if(resp.resp == 1){
										listFuelExpAssEmployees($('#idInsFuelExpModal').val());
								} else {
									$('#respServer').html(resp.msg);
								}
							}
					});
	});
}

/*******************************************************************************/
/*******************************************************************************/
/*******************************************************************************/
/****************************CATÁLOGO STATUS GERENCIA***************************/
/*******************************************************************************/
/*******************************************************************************/
/*******************************************************************************/

function listStatusInsFuel(){
	$.ajax({
		beforeSend: function(){
			$('#cntnListStatusInsFuel').html(cargando);
		},
		type: 'POST',
		dataType: 'HTML',
		url: 'pg/status_gerencia_listado.php',
		success: function(resp){
			$('#cntnListStatusInsFuel').html(resp);
			loadDataTable('list')
		}
	});
}

$('#frmStatus').submit(function(event){
	event.preventDefault();

	let formData = new FormData($(this)[0]);

	$.ajax({
					beforeSend: function(){
						$('#respServer').html(cargando);
					},
					url: urlSubir3,
					type: 'POST',
					dataType: 'JSON',
					data: formData,
					cache: false,
					contentType: false,
					processData: false,
					success: function(resp){
							if(resp.resp == 1 ){
								resetForm('frmStatus');
								$('#respServer').html('');
								$('#opcion').val('');
								listStatusInsFuel();
								$('#opcion').val('31');
							}else{
								$('#respServer').html(resp.msg);
							}
					}
	});
});

function editInsFuelStatus(id){
	$.ajax({
		beforeSend: function(){
			$('#respServer').html(cargando);
		},
		url: urlConsultas3,
		type: 'POST',
		dataType: 'JSON',
		data: {opt: 14, id: id},
		success: function(resp){
			$('#respServer').html('');
			$('#name').val(resp.name);
			$('#id').val(resp.id);
			$('#opcion').val('32');
		}
	});
}

function deleteInsFuelStatus(id, name) {
	swal({
				html: true,
				title: '¿Está seguro?',
				text: 'Se eliminará el status <strong>#' + id + '</strong>: \''+ name +'\'',
				type: 'warning',
				showCancelButton: true,
				cancelButtonClass: 'btn-primary',
				confirmButtonColor: '#DD6B55',
				confirmButtonText: 'Aceptar',
				cancelButtonText: 'Cancelar',
				closeOnConfirm: true
			},
			function(){
					let params = {'id':id, 'opt': 14};
					$.ajax({
							type:    'POST',
							url:     urlEliminar3,
							data:    params,
							dataType: 'JSON',
							success: function(resp){
								if(resp.resp == 1){
										listStatusInsFuel();
								} else {
									$('#respServer').html(resp.msg);
								}
							}
					});
	});
}

/*******************************************************************************/
/*******************************************************************************/
/*******************************************************************************/
/**********************CATÁLOGO CONCEPTOS CONTABILIDAD**************************/
/*******************************************************************************/
/*******************************************************************************/
/*******************************************************************************/
$('#cancelConcept').click(function(){
	$('#opcion').val('35');
	resetForm('frmConceptAcc');
});

$('#frmConceptAcc').submit(function(event){
	event.preventDefault();
	let formData = new FormData($(this)[0]);
	$.ajax({
		beforeSend: function(){
			$('#respServer').html(cargando);
		},
		url: urlSubir3,
		type: 'POST',
		dataType: 'JSON',
		data: formData,
		cache: false,
		contentType: false,
		processData: false,
		success: function(resp){
			resetForm('frmConceptAcc');
			$('#respServer').html('');
			$('#opcion').val('35');
			listConceptsAcc();
		}
	});
});

function listConceptsAcc(){
	$.ajax({
		beforeSend: function(){
			$('#cntnListConceptsAcc').html(cargando);
		},
		type: 'POST',
		dataType: 'HTML',
		url: 'pg/cat_conceptos_cont_listado.php',
		success: function(resp){
			$('#cntnListConceptsAcc').html(resp);
		}
	});
}

function editConceptAcc(id){
	$.ajax({
		beforeSend: function(){
			$('#respServer').html(cargando);
		},
		url: urlConsultas3,
		type: 'POST',
		dataType: 'JSON',
		data: {id: id, opt: 16},
		success: function(resp){
			resetForm('frmConceptAcc');
			$('#respServer').html('');
			$('#opcion').val('36');
			$('#name').val(resp.name);
			$('#id').val(id);
		}
	});
}

function deleteConceptAcc(id, name){
	swal({
				html: true,
				title: '¿Está seguro?',
				text: 'Se eliminará el concepto <strong>#' + id + '</strong>: \''+ name +'\'',
				type: 'warning',
				showCancelButton: true,
				cancelButtonClass: 'btn-primary',
				confirmButtonColor: '#DD6B55',
				confirmButtonText: 'Aceptar',
				cancelButtonText: 'Cancelar',
				closeOnConfirm: true
			},
			function(){
					let params = {'id':id, 'opt': 17};
					$.ajax({
							type:    'POST',
							url:     urlEliminar3,
							data:    params,
							dataType: 'JSON',
							success: function(resp){
								if(resp.resp == 1){
										listConceptsAcc();
								} else {
									$('#respServer').html(resp.msg);
								}
							}
					});
	});
}

/*******************************************************************************/
/*******************************************************************************/
/*******************************************************************************/
/*********************CATÁLOGO PROVEEDORES CONTABILIDAD*************************/
/*******************************************************************************/
/*******************************************************************************/
/*******************************************************************************/
$('#cancelProvider').click(function(){
	$('#opcion').val('37');
	resetForm('frmProviderAcc');
});

$('#frmProviderAcc').submit(function(event){
	event.preventDefault();
	let formData = new FormData($(this)[0]);
	$.ajax({
		beforeSend: function(){
			$('#respServer').html(cargando);
		},
		url: urlSubir3,
		type: 'POST',
		dataType: 'JSON',
		data: formData,
		cache: false,
		contentType: false,
		processData: false,
		success: function(resp){
			resetForm('frmProviderAcc');
			$('#respServer').html('');
			$('#opcion').val('37');
			listProvidersAcc();
		}
	});
});

function listProvidersAcc(){
	$.ajax({
		beforeSend: function(){
			$('#cntnListProvidersAcc').html(cargando);
		},
		type: 'POST',
		dataType: 'HTML',
		url: 'pg/cat_proveedores_cont_listado.php',
		success: function(resp){
			$('#cntnListProvidersAcc').html(resp);
		}
	});
}

function editProviderAcc(id){
	$.ajax({
		beforeSend: function(){
			$('#respServer').html(cargando);
		},
		url: urlConsultas3,
		type: 'POST',
		dataType: 'JSON',
		data: {id: id, opt: 17},
		success: function(resp){
			resetForm('frmProviderAcc');
			$('#respServer').html('');
			$('#opcion').val('38');
			$('#name').val(resp.name);
			$('#id').val(id);
		}
	});
}

function deleteProviderAcc(id, name){
	swal({
				html: true,
				title: '¿Está seguro?',
				text: 'Se eliminará el proveedor <strong>#' + id + '</strong>: \''+ name +'\'',
				type: 'warning',
				showCancelButton: true,
				cancelButtonClass: 'btn-primary',
				confirmButtonColor: '#DD6B55',
				confirmButtonText: 'Aceptar',
				cancelButtonText: 'Cancelar',
				closeOnConfirm: true
			},
			function(){
					let params = {'id':id, 'opt': 18};
					$.ajax({
							type:    'POST',
							url:     urlEliminar3,
							data:    params,
							dataType: 'JSON',
							success: function(resp){
								if(resp.resp == 1){
										listProvidersAcc();
								} else {
									$('#respServer').html(resp.msg);
								}
							}
					});
	});
}

/*******************************************************************************/
/*******************************************************************************/
/*******************************************************************************/
/*********************************MÓDULO INGRESOS*******************************/
/*******************************************************************************/
/*******************************************************************************/
/*******************************************************************************/

$('#btnNewIncome').click(function(){
	if($('#frmIncome').is(':hidden')){
		$('#frmIncome').slideToggle();
	}
	if($('#btnNewIncome').is(':visible')){
		$('#btnNewIncome').slideToggle();
	}
	$('#opcion').val('39');
});

$('#cancelIncome').click(function(){
	if($('#frmIncome').is(':visible')){
		$('#frmIncome').slideToggle();
	}
	if($('#btnNewIncome').is(':hidden')){
		$('#btnNewIncome').slideToggle();
	}
	resetForm('frmIncome');
	$('#opcion').val('39');
});

function listIncomes(){
	$.ajax({
		beforeSend: function(){
			$('#cntnListIncomes').html(cargando);
		},
		url: 'pg/ingresos_listado.php',
		dataType: 'HTML',
		type: 'POST',
		success: function(data){
			$('#cntnListIncomes').html(data);
			loadDataTable('listIncomes', true);
		}
	});
}

$('#frmIncome').submit(function(event){
	event.preventDefault();
	if($('#concept').val() > 0){
		if($('#provider').val() > 0){
			let formData = new FormData($(this)[0]);
			$.ajax({
				beforeSend: function(){
					$('#respServer').html(cargando);
				},
				type: 'POST',
				dataType: 'JSON',
				data: formData,
				url: urlSubir3,
				cache: false,
				contentType: false,
				processData: false,
				success: function(resp){
					$('#respServer').html('');
					if(resp.resp == 1){
						$('#cancelIncome').trigger('click');
						listIncomes();
					} else {
						$('#respServer').html(resp.msg);
					}
				}
			});
		} else {
			let opciones = {
				appendTo:'#frmIncome',
				minWidth:300,
				maxWidth: 350,
			};
			parent.mensaje('Debes seleccionar un proveedor','warning',opciones);
		}
	} else {
		let opciones = {
			appendTo:'#frmIncome',
			minWidth:300,
			maxWidth: 350,
		};
		parent.mensaje('Debes seleccionar un concepto','warning',opciones);
	}
});

function editIncome(id){
	if($('#frmIncome').is(':hidden')){
		$('#frmIncome').slideToggle();
	}
	if($('#btnNewIncome').is(':visible')){
		$('#btnNewIncome').slideToggle();
	}
	$.ajax({
		beforeSend: function(){
			$('#respServer').html(cargando);
		},
		type: 'POST',
		dataType: 'JSON',
		data: {id: id, opt: 18},
		url: urlConsultas3,
		success: function(resp){
			console.log(resp);
			$('#respServer').html('');
			$('#billNum').val(resp.billNum);
			$('#billDate').val(resp.billDate);
			$('#chargeDate').val(resp.chargeDate);
			$('#concept').val(resp.concept);
			$('#provider').val(resp.provider);
			$('#conceptText').val(resp.conceptText);
			$('#withhold').val(resp.withhold);
			$('#repAdvance').val(resp.repAdvance);
			$('#repAdvance').keyup();
			$('#repIVA').val(resp.repIVA);
			$('#subtotal').val(resp.subtotal);
			$('#subtotal').keyup();
			$('#iva').val(resp.iva)
			$('#id').val(id);
			$('#opcion').val('40');
			$('#provider').select2().next().show();
			$('#concept').select2().next().show();
		}
	});
}

function deleteIncome(id, name){
	swal({
				html: true,
				title: '¿Está seguro?',
				text: 'Se eliminará el ingreso <strong>#' + id + ', de concepto:</strong> \''+ name +'\'',
				type: 'warning',
				showCancelButton: true,
				cancelButtonClass: 'btn-primary',
				confirmButtonColor: '#DD6B55',
				confirmButtonText: 'Aceptar',
				cancelButtonText: 'Cancelar',
				closeOnConfirm: true
			},
			function(){
					let params = {'id':id, 'opt': 20};
					$.ajax({
							type:    'POST',
							url:     urlEliminar3,
							data:    params,
							dataType: 'JSON',
							success: function(resp){
								if(resp.resp == 1){
										listIncomes();
										$('#cancelIncome').trigger('click');
								} else {
									$('#respServer').html(resp.msg);
								}

							}
					});
	});
}

function listAssConceptsAcc(id){
	$('#assignConceptAccModalLabel').html('Retenciones');
	$('#fillIncome').removeAttr('style');
	$('#viewIncome').attr('style', 'display: none;');
	$.ajax({
		beforeSend: function(){
			$('#cntnListIncomesModal').html(cargando);
		},
		data: {id: id},
		url: 'pg/ingresos_modal_listado.php',
		dataType: 'HTML',
		type: 'POST',
		success: function (data){
			$('#idModal').val(id);
			$('#cntnListIncomesModal').html(data);
		}
	});
}

$('#frmRepModal').submit(function(event){
	event.preventDefault();
	let formData = new FormData($(this)[0]);
	$.ajax({
		beforeSend: function(){
			$('#buttonModal').html(cargando);
		},
		type: 'POST',
		dataType: 'JSON',
		data: formData,
		url: urlSubir3,
		cache: false,
		contentType: false,
		processData: false,
		success: function(resp){
			if(resp.resp == 1){
				$('#buttonModal').html('<button type="submit" class="btn btn-primary btn-block">Agregar concepto</button>');
				listAssConceptsAcc($('#idModal').val());
			} else {
				$('#buttonModal').html('<button type="submit" class="btn btn-primary btn-block">Agregar concepto</button>');
				let opciones = {
	  			appendTo:'#frmIncome',
	  			minWidth:300,
	  			maxWidth: 350,
	  		};
	  		parent.mensaje(resp.msg,'danger',opciones);
			}
			resetForm('frmRepModal');
		}
	});
});

function deleteConceptIncome(id, name){
	swal({
				html: true,
				title: '¿Está seguro?',
				text: 'Se eliminará el concepto <strong>#' + id + ', de nombre:</strong> \''+ name +'\'',
				type: 'warning',
				showCancelButton: true,
				cancelButtonClass: 'btn-primary',
				confirmButtonColor: '#DD6B55',
				confirmButtonText: 'Aceptar',
				cancelButtonText: 'Cancelar',
				closeOnConfirm: true
			},
			function(){
					let params = {'id':id, 'opt': 21};
					$.ajax({
							type:    'POST',
							url:     urlEliminar3,
							data:    params,
							dataType: 'JSON',
							success: function(resp){
								if(resp.resp == 1){
										listAssConceptsAcc($('#idModal').val());
								} else {
									$('#respServer').html(resp.msg);
								}

							}
					});
	});
}

function viewIncomeDetails(id){
	$('#assignConceptAccModalLabel').html('Detalles de la factura');
	$('#fillIncome').attr('style', 'display: none;');
	$('#viewIncome').removeAttr('style');
	$.ajax({
		beforeSend: function(){
			$('#idIncomeModal').html('Cargando...');
			$('#incomeNumberModal').html('Cargando...');
			$('#billDateModal').html('Cargando...');
			$('#chargeDateModal').html('Cargando...');
			$('#typeConceptModal').html('Cargando...');
			$('#providerModal').html('Cargando...');
			$('#conceptTextModal').html('Cargando...');
			$('#withholdModal').html('Cargando...');
			$('#repAdvanceModal').html('Cargando...');
			$('#repIVAModal').html('Cargando...');
			$('#subtotalModal').html('Cargando...');
			$('#ivaModal').html('Cargando...');
			$('#totalAmountModal').html('Cargando...');
		},
		url: urlConsultas3,
		type: 'POST',
		dataType: 'JSON',
		data: {id: id, opt: 18},
		 success: function(resp){
			 $('#idIncomeModal').html(id);
 			$('#incomeNumberModal').html(resp.billNum);
 			$('#billDateModal').html(resp.billDate);
 			$('#chargeDateModal').html(resp.chargeDate);
 			$('#typeConceptModal').html(resp.textConcept);
 			$('#providerModal').html(resp.textProvider);
 			$('#conceptTextModal').html(resp.conceptText);
 			$('#withholdModal').html(resp.withhold+'%');
 			$('#repAdvanceModal').html('$'+formatMoney(resp.repAdvance));
 			$('#repIVAModal').html(resp.repIVA+'%');
 			$('#subtotalModal').html('$'+formatMoney(resp.subtotal));
 			$('#ivaModal').html(resp.iva+'%');
 			$('#totalAmountModal').html('$'+formatMoney(resp.totalAmount));
		 }

	})
}

/*******************************************************************************/
/*******************************************************************************/
/*******************************************************************************/
/****************************MÓDULO DEPARTAMENTOS*******************************/
/*******************************************************************************/
/*******************************************************************************/
/*******************************************************************************/

function listEmpDepts(){
	$.ajax({
		beforeSend: function(){
			$('#cntnListEmpDept').html(cargando);
		},
		url: 'pg/deptos_emp_listado.php',
		type: 'POST',
		dataType: 'HTML',
		success: function(data){
				$('#cntnListEmpDept').html(data);
				loadDataTable('listEmpDept', true);
		}
	});
}

$('#frmEmpDept').submit(function(event){
	event.preventDefault();
	let formData = new FormData($(this)[0]);
	$.ajax({
		beforeSend: function(){
			$('#respServer').html(cargando);
		},
		type: 'POST',
		dataType: 'JSON',
		data: formData,
		url: urlSubir3,
		cache: false,
		contentType: false,
		processData: false,
		success: function(resp){
			$('#respServer').html('');
			if(resp.resp == 1){
				listEmpDepts();
				$('#name').val('');
			} else {
				$('#respServer').html(resp.msg);
			}
			$('#opcion').val('43');
		}
	});
});

function editEmpDept(id){
	$.ajax({
		beforeSend: function(){
			$('#respServer').html(cargando);
		},
		data: {id: id, opt: 18},
		url: urlConsultas3,
		type: 'POST',
		dataType: 'JSON',
		success: function(resp){
				$('#respServer').html('');
				$('#name').val(resp.name);
				$('#id').val(id);
				$('#opcion').val('44');
		}
	});
}

function deleteEmpDept(id){
	swal({
				html: true,
				title: '¿Está seguro?',
				text: 'Se eliminará el departamento <strong>#' + id + '</strong>',
				type: 'warning',
				showCancelButton: true,
				cancelButtonClass: 'btn-primary',
				confirmButtonColor: '#DD6B55',
				confirmButtonText: 'Aceptar',
				cancelButtonText: 'Cancelar',
				closeOnConfirm: true
			},
			function(){
					$.ajax({
						data: {id: id, opt: 19},
						url: urlEliminar3,
						type: 'POST',
						dataType: 'JSON',
						success: function(resp){
							listEmpDepts();
						}
					});
	});

}
/*******************************************************************************/
/*******************************************************************************/
/*******************************************************************************/
/***************************MODULO SOLICITUD ASFALTO****************************/
/*******************************************************************************/
/*******************************************************************************/
/*******************************************************************************/


$('#btnNewAsphaltRequest').click(function(){
	if($('#frmAsphaltRequest').is(':hidden')){
		$('#frmAsphaltRequest').slideToggle();
	}
	if($('#btnNewAsphaltRequest').is(':visible')){
		$('#btnNewAsphaltRequest').slideToggle();
	}
});

$('#cancelAsphaltRequest').click(function(){
	if($('#frmAsphaltRequest').is(':visible')){
		$('#frmAsphaltRequest').slideToggle();
	}
	if($('#btnNewAsphaltRequest').is(':hidden')){
		$('#btnNewAsphaltRequest').slideToggle();
	}
	$('#opcion').val('48');
	$('#id').val('');
	resetForm('frmAsphaltRequest');
});

$('#frmAsphaltRequest').submit(function(event){
	event.preventDefault();
	let formData = new FormData($(this)[0]);
	$.ajax({
		beforeSend: function(){
			$('#respServer').html(cargando);
		},
		type: 'POST',
		dataType: 'JSON',
		data: formData,
		url: urlSubir3,
		cache: false,
		contentType: false,
		processData: false,
		success: function(resp){
			if(resp.resp == 1){
				$('#cancelAsphaltRequest').trigger('click');
				$('#respServer').html('');
			} else {
				$('#respServer').html(resp.msg);
			}
			$('#opcion').val('48');
			$('#id').val('');
			listAsphaltRequests();
		}
	});
});

function listAsphaltRequests(){
	$.ajax({
		beforeSend: function(){
			$('#cntnListAsphaltRequests').html(cargando);
		},
		url: 'pg/solicitud_asfalto_listado.php',
		type: 'POST',
		dataType: 'HTML',
		success: function(data){
				$('#cntnListAsphaltRequests').html(data);
				loadDataTable('listAsphaltRequests', true);
				$(function () {
				  $('[data-toggle="popover"]').popover({
						container: 'body'
					});
				});
		}
	});
}

function editAsphaltRequest(id){
	$.ajax({
		beforeSend: function(){
			$('#respServer').html(cargando);
		},
		url: urlConsultas3,
		type: 'POST',
		dataType: 'JSON',
		data: {id: id, opt: 29},
		success: function(resp){
			if($('#frmAsphaltRequest').is(':hidden')){
				$('#frmAsphaltRequest').slideToggle();
			}
			if($('#btnNewAsphaltRequest').is(':visible')){
				$('#btnNewAsphaltRequest').slideToggle();
			}
			$('#work').val(resp.work);
			$('#requestDate').val(resp.requestDate);
			$('#asphaltLiters').val(resp.asphaltLiters);
			$('#asphaltDelivery').val(resp.asphaltDelivery);
			$('#emulsionLiters').val(resp.emulsionLiters);
			$('#emulsionDelivery').val(resp.emulsionDelivery);
			$('#alternateFuelLiters').val(resp.alternateFuelLiters);
			$('#alternateFuelDelivery').val(resp.alternateFuelDelivery);
			$('#id').val(id);
			$('#opcion').val('49');
			$('#work').select2().next().show();
			$('#respServer').html('');
		}
	});
}

function deleteAsphaltRequest(id){
	$('#cancelAsphaltRequest').trigger('click');
	swal({
				html: true,
				title: '¿Está seguro?',
				text: 'Se eliminará la solicitud <strong>#' + id + '</strong>',
				type: 'warning',
				showCancelButton: true,
				cancelButtonClass: 'btn-primary',
				confirmButtonColor: '#DD6B55',
				confirmButtonText: 'Aceptar',
				cancelButtonText: 'Cancelar',
				closeOnConfirm: true
			},
			function(){
					let params = {'id':id, 'opt': 22};
					$.ajax({
							type:    'POST',
							url:     urlEliminar3,
							data:    params,
							dataType: 'JSON',
							success: function(resp){
								if(resp.resp == 1){
										listAsphaltRequests();
								} else {
									$('#respServer').html(resp.msg);
								}

							}
					});
	});
}

/*******************************************************************************/
/*******************************************************************************/
/*******************************************************************************/
/*****************************REPORTE DE ASFALTO********************************/
/*******************************************************************************/
/*******************************************************************************/
/*******************************************************************************/

$('#btnNewAsphaltReport').click(function(){
	if($('#frmAsphaltReport').is(':hidden')){
		$('#frmAsphaltReport').slideToggle();
	}
	if($('#btnNewAsphaltReport').is(':visible')){
		$('#btnNewAsphaltReport').slideToggle();
	}
});

$('#cancelAsphaltReport').click(function(){
	if($('#frmAsphaltReport').is(':visible')){
		$('#frmAsphaltReport').slideToggle();
	}
	if($('#btnNewAsphaltReport').is(':hidden')){
		$('#btnNewAsphaltReport').slideToggle();
	}
	$('#opcion').val('50');
	$('#id').val('');
	resetForm('frmAsphaltReport');
	$('#work').select2().next().show();
});

function listAsphaltReports(){
	$.ajax({
		beforeSend: function(){
			$('#cntnListAsphaltReports').html(cargando);
		},
		url: 'pg/reporte_asfalto_listado.php',
		type: 'POST',
		dataType: 'HTML',
		success: function(data){
				$('#cntnListAsphaltReports').html(data);
				loadDataTable('listAsphaltReports', true);
				$(function () {
				  $('[data-toggle="popover"]').popover({
						container: 'body'
					});
				});
		}
	});
}

$('#frmAsphaltReport').submit(function(event){
	event.preventDefault();
	if($('#work').val()>0){
		let formData = new FormData($(this)[0]);
		$.ajax({
			beforeSend: function(){
				$('#respServer').html(cargando);
			},
			type: 'POST',
			dataType: 'JSON',
			data: formData,
			url: urlSubir3,
			cache: false,
			contentType: false,
			processData: false,
			success: function(resp){
				if(resp.resp == 1){
					$('#cancelAsphaltReport').trigger('click');
					$('#respServer').html('');
					$('#opcion').val('50');
					$('#id').val('');
					listAsphaltReports();
				} else {
					$('#respServer').html('<div class="text-danger">'+resp.msg+'</div>');
				}
			}
		});
	} else {
		let opciones = {
			appendTo:'#frmAsphaltReport',
			minWidth:300,
			maxWidth: 350,
		};
		parent.mensaje("Debes seleccionar una obra",'warning',opciones);
	}

});

function editAsphaltReport(id){
	$.ajax({
		beforeSend: function(){
			$('#respServer').html(cargando);
		},
		type: 'POST',
		dataType: 'JSON',
		url: urlConsultas3,
		data: {id: id, opt: 30},
		success: function(resp){
			$('#work').val(resp.work);
			$('#work').select2().next().show();
			$('#reportDate').val(resp.reportDate);
			$('#asphaltLiters').val(resp.asphaltLiters);
			$('#asphaltConsumed').val(resp.asphaltConsumed);
			$('#emulsionLiters').val(resp.emulsionLiters);
			$('#emulsionConsumed').val(resp.emulsionConsumed);
			$('#termoCapacity').val(resp.termoCapacity);
			$('#plantOperator').val(resp.plantOperator);
			$('#btnNewAsphaltReport').trigger('click');
			$('#opcion').val(51);
			$('#id').val(id);
			$('#respServer').html('');
		}
	});
}

function deleteAsphaltReport(id){
	$('#cancelAsphaltReport').trigger('click');
	swal({
				html: true,
				title: '¿Está seguro?',
				text: 'Se eliminará el reporte <strong>#' + id + '</strong>',
				type: 'warning',
				showCancelButton: true,
				cancelButtonClass: 'btn-primary',
				confirmButtonColor: '#DD6B55',
				confirmButtonText: 'Aceptar',
				cancelButtonText: 'Cancelar',
				closeOnConfirm: true
			},
			function(){
					$.ajax({
						url: urlEliminar3,
						data: {id: id, opt: 23},
						type: 'POST',
						dataType: 'JSON',
						success: function(resp){
							if(resp.resp == 1){
								listAsphaltReports();
							}
						}
					});
	});

}

$('#btnNewAsphalftReportConsumption').click(function(){
	if($('#frmAsphaltReportConsumption').is(':hidden')){
		$('#frmAsphaltReportConsumption').slideToggle();
	}
	if($('#btnNewAsphalftReportConsumption').is(':visible')){
		$('#btnNewAsphalftReportConsumption').slideToggle();
	}
});

$('#cancelAsphalftReportConsumption').click(function(){
	if($('#frmAsphaltReportConsumption').is(':visible')){
		$('#frmAsphaltReportConsumption').slideToggle();
	}
	if($('#btnNewAsphalftReportConsumption').is(':hidden')){
		$('#btnNewAsphalftReportConsumption').slideToggle();
	}
	resetForm('frmAsphaltReportConsumption');
});

function listAsphaltReportConsumptions(id, name){
	$('#assignAsphaltReportConsumptionLabel').html('Obra: '+name);
	$.ajax({
		beforeSend: function(){
			$('#cntnListAsphaltReportsConsumption').html(cargando);
		},
		data: {id: id},
		url: 'pg/reporte_asfalto_modal_listado.php',
		type: 'POST',
		dataType: 'HTML',
		success: function(data){
				$('#cntnListAsphaltReportsConsumption').html(data);
				loadDataTable('listAsphaltReportsConsumption', true);
				$('#idModal').val(id);
		}
	});
}

$('#frmAsphaltReportConsumption').submit(function(event){
	event.preventDefault();
	let formData = new FormData($(this)[0]);
	$.ajax({
		beforeSend:	function(){
			$('#respServerModal').html(cargando);
			$('#buttonModal').slideToggle();
		},
		type: 'POST',
		dataType: 'JSON',
		url: urlSubir3,
		data: formData,
		cache: false,
		contentType: false,
		processData: false,
		success: function(resp){
			$('#respServerModal').html('');
			$('#buttonModal').slideToggle();
			if(resp.resp == 1){
				$('#cancelAsphalftReportConsumption').trigger('click');
				listAsphaltReportConsumptions($('#idModal').val());
			} else {
				$('#respServerModal').html('<div class="text-danger">'+resp.msg+'</div>')
			}
		}
	});
});

function deleteAsphaltConsumption(id){
	$('#cancelAsphalftReportConsumption').trigger('click');
	swal({
				html: true,
				title: '¿Está seguro?',
				text: 'Se eliminará el reporte <strong>#' + id + '</strong>',
				type: 'warning',
				showCancelButton: true,
				cancelButtonClass: 'btn-primary',
				confirmButtonColor: '#DD6B55',
				confirmButtonText: 'Aceptar',
				cancelButtonText: 'Cancelar',
				closeOnConfirm: true
			},
			function(){
					$.ajax({
						url: urlEliminar3,
						data: {id: id, opt: 24},
						type: 'POST',
						dataType: 'JSON',
						success: function(resp){
							if(resp.resp == 1){
								listAsphaltReportConsumptions($('#idModal').val());
							}
						}
					});
	});
}

/*******************************************************************************/
/*******************************************************************************/
/*******************************************************************************/
/*******************************CLIENTES MOROSOS********************************/
/*******************************************************************************/
/*******************************************************************************/
/*******************************************************************************/

function listSluggishClients(){
	$.ajax({
		beforeSend: function(){
			$('#cntnListSluggishClients').html(cargando);
		},
		url: 'pg/morosos_listado.php',
		type: 'POST',
		dataType: 'HTML',
		success: function(data){
				$('#cntnListSluggishClients').html(data);
				loadDataTable('listSluggishClients', true);
				if($('#slug').val() == 1){
					$('#buttonPrint').slideToggle();
				}
		}
	});
}

function openPDFSlugClients(){
	window.open('php/imprimir3.php?opcion=3','blank');
}

/*******************************************************************************/
/*******************************************************************************/
/*******************************************************************************/
/*****************************CLIENTES PARA FIRMA*******************************/
/*******************************************************************************/
/*******************************************************************************/
/*******************************************************************************/

function listSignClients(){
	$.ajax({
		beforeSend: function(){
			$('#cntnListSluggishClients').html(cargando);
		},
		url: 'pg/clientes_firma_listado.php',
		type: 'POST',
		dataType: 'HTML',
		success: function(data){
				$('#cntnListSignClients').html(data);
				loadDataTable('listSignClients', true);
				if($('#sign').val() == 1){
					$('#buttonPrint').slideToggle();
				}
		}
	});
}

function openPDFSignClients(){
	window.open('php/imprimir3.php?opcion=4','blank');
}

/*******************************************************************************/
/*******************************************************************************/
/*******************************************************************************/
/**************************FORMAT CURRENCY FUNCTIONS****************************/
/*******************************************************************************/
/*******************************************************************************/
/*******************************************************************************/

function openPDF(id){
	window.open('php/imprimir3.php?opcion=1&id='+id,'blank');
}

function openPDFBuyOrder(id){
	window.open('php/imprimir3.php?opcion=2&id='+id,'blank');
}

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

function formatMoney(number) {
	return parseFloat(number).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
}
