// let urlPag;
urlConsultas = 'php/consultas3.php';
urlSubir     = 'php/subir3.php';
urlEliminar  = 'php/eliminar3.php';
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
          if(resp.resp == 1 ){
            desarrollo_listado();
            $('#opcion').val(1);
            resetForm('frmDesarrollo');
          }else{
            $("#respServer").html('Ocurrió un error al intentar guardar en la base de datos');
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
	$('#opcion').val(3);
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
	var date1 = date1.split('-');
	var date2 = date2.split('-');
	var dateS = new Date(date1[2],date1[1],date1[0]);
	var dateF = new Date(date2[2],date2[1],date2[0]);
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

		var date1 = $('#date1').val().split('-');
		$('#date1').val(date1[2] + "-" + date1[1] + "-" + date1[0]);
		var date2 = $('#date2').val().split('-');
		$('#date2').val(date2[2] + "-" + date2[1] + "-" + date2[0]);

    let formData = new FormData(document.getElementById("frmWork"));

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
						$('#frmWork').slideToggle();
					  $('#btnNewWork').slideToggle();
            work_list();
            $('#opcion').val(3);
            resetForm('frmWork');
          }else{
            $("#respServer").html('Ocurrió un error al intentar guardar en la base de datos');
          }
      }
    });
});

function eliminarRegObra(id, nombre){
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
          let params = {'id':id, 'opt':2};
          $.ajax({
              type:    "post",
              url:     urlEliminar,
              data:    params,
              dataType: 'json',
              success: function(resp){
                    console.log(resp);
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
            $("#respServer").html(cargando);
        },
        type:    "post",
        url:     urlConsultas,
        data:    params,
        dataType: 'json',
        success: function(resp){
            console.log(resp);
            $('#respServer').empty('');
            $('#txtName').val(resp.nombre);
						$('#inputType').val(resp.tipo);
						$('#txtDependency').val(resp.dependencia);
            $('#inputAmount').val(resp.monto);
            $('#date1').val(resp.fecha_inicio);
            $('#date2').val(resp.fecha_finalizacion);
						$('#txtFolderVol').val(resp.volumenes_carpeta);
						$('#addedType').val(resp.tipo_agregado);
						$('#txtConcreteVol').val(resp.volumen_concreto);
						$('#txtWorkArea').val(resp.area_obra);
        }
  });
	$('#frmWork').slideToggle();
  $('#btnNewWork').slideToggle();
	$('#txtName').focus();
}
/*********************************************************************************/
/*********************************************************************************/
/*********************************************************************************/
/*****************************FUNCIONES ESTIMACIONES******************************/
/*********************************************************************************/
/*********************************************************************************/
/*********************************************************************************/


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
            $("#cntnListPagos").html(cargando);
        },
        type:    "post",
        url:     urlPag,
        //data:    params,
        dataType: 'html',
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

		if(!($('#date2').val() != "0000-00-00") || !($('#date2').val() != "00-00-0000")){
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
				$('#date2').val(date2[2] + "-" + date2[1] + "-" + date2[0]);
			} else {
				if(date2[2].length == 2){
					$('#date2').val(date2[0] + "-" + date2[1] + "-" + date2[2]);
				} else {
					$('#date1').focus();
					$('#reqDate1').html('Ingrese fechas en el formato DD-MM-YYYY ó YYYY-MM-DD');
					return false;
				}
			}
		}
		if(date1[2].length == 4){
			$('#date1').val(date1[2] + "-" + date1[1] + "-" + date1[0]);
		} else {
			if(date1[2].length == 2){
				$('#date1').val(date1[0] + "-" + date1[1] + "-" + date1[2]);
			} else {
				$('#date1').focus();
				$('#reqDate1').html('Ingrese fechas en el formato DD-MM-YYYY ó YYYY-MM-DD');
				return false;
			}
		}



    let formData = new FormData(document.getElementById("frmEstTrack"));

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
          if(resp.resp == 1 ){
            estimation_list();
            $('#opcion').val(4);
            resetForm('frmEstTrack');
						$('#frmEstTrack').slideToggle();
						$('#btnNewEstTrack').slideToggle();
          }else{
            $("#respServer").html('Ocurrió un error al intentar guardar en la base de datos');
          }
      }
    });
});

//ESTA FUNCIÓN EDITA SEGUIMIENTOS DE ESTIMACIONES
function editarRegSegEst(id){
  let params = {'id':id, 'opt':3}
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
            $('#inputTrackEst').val(resp.nombre_obra);
						$('#inputEstimateNum').val(resp.numero_estimacion);
						$('#inputAmount').val(resp.monto);
            $('#date1').val(resp.fecha_inicio);
            $('#date2').val(resp.fecha_finalizacion);
						$('#inputPhysicAdv').val(resp.avance_fisico);
						$('#inputStatus').val(resp.status);
						$('#hdFlsImg').val(resp.imagen);
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
          let params = {'id':id, 'opt':3};
          $.ajax({
              type:    "post",
              url:     urlEliminar,
              data:    params,
              dataType: 'json',
              success: function(resp){
                    console.log(resp);
                    if(resp.resp == 1 || resp.resp == 2){
                        estimation_list();
                    }
              }
          });
      });
}

//LISTADO ANTIGUEDAD

function antiquity_list(){
  urlPag = 'pg/antiguedad_listado.php';

  $.ajax({
        beforeSend: function(){
            $("#cntnListAntiguedad").html(cargando);
        },
        type:    "post",
        url:     urlPag,
        dataType: 'html',
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

    let formData = new FormData(document.getElementById("frmAntique"));

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
          if(resp.resp == 1 ){
            antiquity_list();
            $('#opcion').val(5);
            resetForm('frmAntique');
          }else{
            $("#respServer").html('Ocurrió un error al intentar guardar en la base de datos');
          }
      }
    });
});


//FUNCION APRA EDITAR UN REGISTRO DE ANTIGUEDAD
function editarRegAntiguedad(id){
  let params = {'id':id, 'opt':4}
  $.ajax({
        beforeSend: function(){
            $("#respServer").html(cargando);
        },
        type:    "post",
        url:     urlConsultas,
        data:    params,
        dataType: 'json',
        success: function(resp){
						antiquity_list();
            console.log(resp);
						$('#txtNombre').val(resp.nombre);
						$('#hdFlIcono').val(resp.icono);
						$('#idAntiguedad').val(resp.id_antiguedad);
						$('#opcion').val("6");
            $('#respServer').empty('');

        }
  });

	$('#txtNombre').focus();
}

//FUNCIÓN PARA ELIMINAR UN REGISTRO DE ANTIGUEDAD
function eliminarRegAntiguedad(id, nombre, icono){
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
          let params = {'id':id, 'opt':4};
          $.ajax({
              type:    "post",
              url:     urlEliminar,
              data:    params,
              dataType: 'json',
              success: function(resp){
                    console.log(resp);
                    if(resp.resp == 1 || resp.resp == 2){
                        antiquity_list();
                    }
              }
          });
      });
}

/**
FORMAT CURRENCY FUNCTIONS
**/

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
