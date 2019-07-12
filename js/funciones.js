let cargando  = "<center><img src='img/cargaa.gif' width='25px' /><br>Cargando ...</center>";
let guardando = "<center><img src='img/cargaa.gif' width='25px' /><br>Guardando ...</center>";
let eliminando= "<center><img src='img/cargaa.gif' width='25px' /><br>Eliminando ...</center>";
let urlPag;
let urlConsultas1 = 'php/consultas.php';
let urlSave     = 'php/subir.php';
let urlEliminar1  = 'php/eliminar.php';
let dataTable1;
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
//CATÁLOGO DE CLOSETS


//CATÁLOGO CLOSETS LISTADO
function closets_listado(){
  urlPag1 = 'pg/closets_listado.php';

  $.ajax({
        beforeSend: function(){
            $("#cntnListClosets").html(cargando);
        },
        type:    "post",
        url:     urlPag1,
        //data:    params,
        dataType: 'html',
        success: function(data){
            $('#cntnListClosets').html(data);
            loadDataTable('listCloset', true);
        }
  });
}

//addCloset
$('#btnGuardarCloset').click(function(){
    if($('#txtNombre').val().length < 1){
      $('#txtNombre').focus();
      $('#reqTxtNombre').html('*');
      return false;
    }else{
      $('#reqTxtNombre').empty();
    }

    let formData = new FormData(document.getElementById("frmClosets"));

    $.ajax({
      beforeSend: function(){
        $("#respServer").html(guardando);
      },
      url: urlSave,
      type: "post",
      dataType: "json",
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      success: function(resp){          
          $("#respServer").empty();
          if(resp.resp == 1){
            closets_listado();
            $('#opcion').val(201);
            resetForm('frmClosets');
          }else{
            $("#respServer").html('Ocurrió un error al intentar guardar en la base de datos');
          }
      }
    });
});

function editarCloset(id){
  let params = {'id':id, 'opt':204}
  $.ajax({
        beforeSend: function(){
            $("#respServer").html(cargando);
        },
        type:    "post",
        url:     urlConsultas1,
        data:    params,
        dataType: 'json',
        success: function(resp){
            $('#respServer').empty('');
            $('#txtNombre').val(resp.nombre);
            $('#hdFlIcono').val(resp.icono);
            $('#idCloset').val(resp.id_closet);
            $('#opcion').val(202);
        }
  });
}


function eliminarCloset(id, icono, nombre){
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
          let params = {'id':id, 'icono':icono, 'opt':201};
          $.ajax({
              type:    "post",
              url:     urlEliminar1,
              data:    params,
              dataType: 'json',
              success: function(resp){
                    if(resp.resp == 1){
                        closets_listado();
                    }
              }
          });
      });
}






//CATÁLOGO NÚMERO DE BAÑOS
function wc_listado(){
  urlPag1 = 'pg/wc_listado.php';

  $.ajax({
        beforeSend: function(){
            $("#cntnListWc").html(cargando);
        },
        type:    "post",
        url:     urlPag1,
        //data:    params,
        dataType: 'html',
        success: function(data){            
            $('#cntnListWc').html(data);
            loadDataTable('listWc', true);
        }
  });
}


//addwC
$('#idBtnGuardaWc').click(function(){
    if($('#txtNombre').val().length < 1){
      $('#txtNombre').focus();
      $('#reqTxtNombre').html('*');
      return false;
    }else{
      $('#reqTxtNombre').empty();
    }

    let formData = new FormData(document.getElementById("frmWc"));

    $.ajax({
      beforeSend: function(){
        $("#respServer").html(guardando);
      },
      url: urlSave,
      type: "post",
      dataType: "json",
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      success: function(resp){
          $("#respServer").empty();
          if(resp.resp == 1){
            wc_listado();
            $('#opcion').val(203);
            resetForm('frmWc');
          }else{
            $("#respServer").html('Ocurrió un error al intentar guardar en la base de datos');
          }
      }
    });
});

function editarRegWc(id){
  let params = {'id':id, 'opt':202}
  $.ajax({
        beforeSend: function(){
            $("#respServer").html(cargando);
        },
        type:    "post",
        url:     urlConsultas1,
        data:    params,
        dataType: 'json',
        success: function(resp){
            $('#respServer').empty('');
            $('#txtNombre').val(resp.nombre);
            $('#hdFlIcono').val(resp.icono);
            $('#idWc').val(resp.id_num_banio);
            $('#opcion').val(204);
        }
  });
}

function eliminarRegWc(id, icono, nombre){
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
          let params = {'id':id, 'icono':icono, 'opt':202};
          $.ajax({
              type:    "post",
              url:     urlEliminar1,
              data:    params,
              dataType: 'json',
              success: function(resp){
                    if(resp.resp == 1){
                        wc_listado();
                    }
              }
          });
      });
}


$('#idBtnCancelarWc').click(function(){
  resetForm('frmWc');
});







//SERVICIOS Y AMENIDADES
function servicio_amenidades_listado(){
  urlPag1 = 'pg/servicios_amenidades_listado.php';

  $.ajax({
        beforeSend: function(){
            $("#cntnListServicioAmenidades").html(cargando);
        },
        type:    "post",
        url:     urlPag1,
        //data:    params,
        dataType: 'html',
        success: function(data){
            $('#cntnListServicioAmenidades').html(data);
            loadDataTable('listAmenidades', true);
        }
  });
}


$('#btnGuardaServAmenidad').click(function(){
    if($('#txtNombre').val().length < 1){
      $('#txtNombre').focus();
      $('#reqTxtNombre').html('*');
      return false;
    }else{
      $('#reqTxtNombre').empty();
    }

    let formData = new FormData(document.getElementById("frmAmenidades"));

    $.ajax({
      beforeSend: function(){
        $("#respServer").html(guardando);
      },
      url: urlSave,
      type: "post",
      dataType: "json",
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      success: function(resp){          
          $("#respServer").empty();
          if(resp.resp == 1){
            servicio_amenidades_listado();
            $('#opcion').val(205);
            resetForm('frmAmenidades');
          }else{
            $("#respServer").html('Ocurrió un error al intentar guardar en la base de datos');
          }
      }
    });
});


function editarServAmd(id){
  let params = {'id':id, 'opt':203}
  $.ajax({
        beforeSend: function(){
            $("#respServer").html(cargando);
        },
        type:    "post",
        url:     urlConsultas1,
        data:    params,
        dataType: 'json',
        success: function(resp){
            $('#respServer').empty('');
            $('#txtNombre').val(resp.nombre);
            $('#hdFlIcono').val(resp.icono);
            $('#idServAmenidad').val(resp.id_servicio_amenidad);
            $('#opcion').val(206);
        }
  });
}


$('#btnCancelaServAmenidad').click(function(){
  resetForm('frmAmenidades');
});



function eliminarServAmd(id, icono, nombre){
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
          let params = {'id':id, 'icono':icono, 'opt':203};
          $.ajax({
              type:    "post",
              url:     urlEliminar1,
              data:    params,
              dataType: 'json',
              success: function(resp){                    
                    if(resp.resp == 1){
                        servicio_amenidades_listado();
                    }
              }
          });
      });
}





//SUBMÓDULO CLIENTES
$('#btnBusquedaCliente').click(function(){
  $('#cntnBusquedaCte').slideToggle();
  $('#txtNombreBusqueda').focus();
});

$("#txtNombreBusqueda,#txtRfcBusqueda ").keypress(function(e) {
  if(e.which == 13) {
    clientes_listado(1);
  }
});

$('#cboTipoClienteBusq').change(function(){clientes_listado(1);});

$('#btnBuscarCte').click(function(){clientes_listado(1)});
$('#btnResetBusqCte').click(function(){
  $('#txtNombreBusqueda').val('');
  $('#txtRfcBusqueda').val('');
  $('#cboTipoClienteBusq').val(0);
  clientes_listado(1);
});

//MOTRAR/OCULTAR FORMULARIO DE REGISTRO
$('#btnNvoRegCliente, #btnCancelarRegClient').click(function (){
  dispFrmClient('Nuevo Cliente');
});

function dispFrmClient(titulo){
  resetForm('frmNvoCliente');
  $('#opcion').val(207);
  $('#txtTitleFrmClient').text(titulo);
  $('#cntnFrmNvoClient').slideToggle();
  $('#btnNvoRegCliente').slideToggle();
  $('#cboTipoCliente').focus();
  frmTelefonico('txtTelefono');
  frmTelefonico('txtCelular');
}

//LISTADO CLIENTES
function clientes_listado(pagina){
  urlPag1 = 'pg/clientes_listado.php';
  let params = {'nombreBusq':$('#txtNombreBusqueda').val(), 'rfcBusq':$('#txtRfcBusqueda').val(), 'tipoCteBusq':$('#cboTipoClienteBusq').val(), 'pagina':pagina};

  $.ajax({
        beforeSend: function(){
            $("#cntnListClientes").html(cargando);
        },
        type:    "post",
        url:     urlPag1,
        data:    params,
        dataType: 'html',
        success: function(data){
            //console.log(data);
            $('#cntnListClientes').html(data);            
        }
  });
}

$('#btnGuardarRegClient').click(function(){
    if($('#cboTipoCliente').val() == 0){
      $('#cboTipoCliente').focus();
      $('#reqCboTipoCliente').html('* Campo requerido');
      return false;
    }else{
      $('#reqCboTipoCliente').empty();
    }

    if($('#txtRfc').val().length < 1){
      $('#txtRfc').focus();
      $('#reqTxtRfc').html('* Campo requerido');
      return false;
    }else{
      $('#reqTxtRfc').empty();
    }

    if($('#txtNombre').val().length < 1){
      $('#txtNombre').focus();
      $('#reqTxtNombre').html('* Campo requerido');
      return false;
    }else{
      $('#reqTxtNombre').empty();
    }

    if($('#txtApellidoP').val().length < 1){
      $('#txtApellidoP').focus();
      $('#reqTxtApellidoP').html('* Campo requerido');
      return false;
    }else{
      $('#reqTxtApellidoP').empty();
    }

    if($('#txtApellidoM').val().length < 1){
      $('#txtApellidoM').focus();
      $('#reqTxtApellidoM').html('* Campo requerido');
      return false;
    }else{
      $('#reqTxtApellidoM').empty();
    }

    if($('#cboEstadoCivil').val() == 0){
      $('#cboEstadoCivil').focus();
      $('#reqCboEstadoCivil').html('* Campo requerido');
      return false;
    }else{
      $('#reqCboEstadoCivil').empty();
    }

    if($('#txtDomicilio').val().length < 1){
      $('#txtDomicilio').focus();
      $('#reqCboDomicilio').html('* Campo requerido');
      return false;
    }else{
      $('#reqCboDomicilio').empty();
    }

    if($('#txtCorreo').val().length < 1){
      $('#txtCorreo').focus();
      $('#reqTxtCorreo').html('* Campo requerido');
      return false;
    }else{
      $('#reqTxtCorreo').empty();
    }

    if($('#txtTelefono').val().length < 1){
      $('#txtTelefono').focus();
      $('#reqTxtTelefono').html('* Campo requerido');
      return false;
    }else{
      $('#reqTxtTelefono').empty();
    }

    let formData = new FormData(document.getElementById("frmNvoCliente"));

    $.ajax({
      beforeSend: function(){
        $("#respServer").html(guardando);
      },
      url: urlSave,
      type: "post",
      dataType: "json",
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      success: function(resp){
          $("#respServer").empty();
          if(resp.resp == 1){
            clientes_listado(1); dispFrmClient();
            if($('#opcion').val() == 208){
              $('#opcion').val(207);
            }
            resetForm('frmNvoCliente');
          }else{
            $("#respServer").html('Ocurrió un error al intentar guardar en la base de datos');
          }
      }
    });
});


function editarCliente(id){
  dispFrmClient('Editar Cliente');
  let params = {'id':id, 'opt':205}
  $.ajax({
        type:    "post",
        url:     urlConsultas1,
        data:    params,
        dataType: 'json',
        success: function(resp){            
            $('#respServer').empty('');
            $('#cboTipoCliente').val(resp.id_tipo);
            $('#txtRfc').val(resp.rfc);
            $('#txtNombre').val(resp.nombre);
            $('#txtApellidoP').val(resp.apellido_p);
            $('#txtApellidoM').val(resp.apellido_m);
            $('#cboEstadoCivil').val(resp.estado_civil);
            $('#txtDomicilio').val(resp.domicilio);
            $('#txtCorreo').val(resp.correo);
            $('#txtTelefono').val(resp.telefono);
            $('#txtCelular').val(resp.celular);
            $('#txtObservaciones').val(resp.observaciones);
            $('#idCliente').val(resp.id_cliente);
            $('#opcion').val(208);
        }
  });
}


function eliminarCliente(id, nombre){
  swal({
        html: true,
        title: "¿Está seguro?",
        text: "eliminar al cliente: <strong>" + nombre + "</strong>",
        type: "warning",
        showCancelButton: true,
        cancelButtonClass: "btn-primary",
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Aceptar",
        cancelButtonText: "Cancelar",
        closeOnConfirm: true
      },
      function(){
          let params = {'id':id, 'opt':204};
          $.ajax({
              type:    "post",
              url:     urlEliminar1,
              data:    params,
              dataType: 'json',
              success: function(resp){                    
                    if(resp.resp == 1){
                        clientes_listado(1);
                    }
              }
          });
      });
}



//ARCHIVOS DEL CLIENTE
function cliente_archivos_listado(id, nombre){
  $('#titleModFileClient').text(nombre);
  $('#idClienteArchivo').val(id);
  urlPag1 = 'pg/cliente_archivos_listado.php';
  let params = {'id':id};

  $.ajax({
        beforeSend: function(){
            $("#cntnListadoArchivosCliente").html(cargando);
        },
        type:    "post",
        url:     urlPag1,
        data:    params,
        dataType: 'html',
        success: function(data){            
            $('#cntnListadoArchivosCliente').html(data);
            loadDataTable('listadoArchivosCliente', true);
        }
  });
}

$('#btnNvoArchivoCte').click(function (){
  dispFrmArchivoCte();
});

function dispFrmArchivoCte(){
  resetForm('frmArchivosCte');
  $('#cntnFrmArchivoCte').slideToggle();
  $('#btnNvoArchivoCte').slideToggle();
  $('#flArchivo').focus();
}

$('#btnGuardaArchivoCte').click(function(){
    if($('#txtDescricion').val() == 0){
      $('#txtDescricion').focus();
      $('#reqTxtDescripcion').html('* Campo requerido');
      return false;
    }else{
      $('#reqTxtDescripcion').empty();
    }

    let formData = new FormData(document.getElementById("frmArchivosCte"));

    $.ajax({
      beforeSend: function(){
        $("#respServer1").html(guardando);
      },
      url: urlSave,
      type: "post",
      dataType: "json",
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      success: function(resp){          
          $("#respServer1").empty();
          if(resp.resp == 1){
            cliente_archivos_listado($('#idClienteArchivo').val(), $('#titleModFileClient').text()); dispFrmArchivoCte();
            if($('#opcion').val() == 210){
              $('#opcion').val(209);
            }
            resetForm('frmArchivosCte');
          }else if(resp.resp == 2){
            $("#respServer1").html('Es necesario seleccionar un archivo');
            return false;
          }else{
            $("#respServer1").html('Ocurrió un error al intentar guardar en la base de datos');
            return false;
          }
      }
    });
});

function editarArchivoCte(idCliente, idArchivo){
  dispFrmArchivoCte();
  let params = {'idCliente':idCliente, 'idArchivo':idArchivo, 'opt':206}
  $.ajax({
        type:    "post",
        url:     urlConsultas1,
        data:    params,
        dataType: 'json',
        success: function(resp){
            console.log(resp);          
            $('#respServer').empty('');
            $('#idArchivo').val(resp.id_archivo);
            $('#txtDescripcion').val(resp.descripcion);
            $('#hdFlArchivo').val(resp.ruta_archivo);
            $('#opcionAC').val(210);
        }
  });
}

function eliminarArchivoCte(id, nombre){
  swal({
        html: true,
        title: "¿Está seguro?",
        text: "eliminar el archivo: <strong>" + nombre + "</strong>",
        type: "warning",
        showCancelButton: true,
        cancelButtonClass: "btn-primary",
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Aceptar",
        cancelButtonText: "Cancelar",
        closeOnConfirm: true
      },
      function(){
          let params = {'id':id, 'opt':205};
          $.ajax({
              type:    "post",
              url:     urlEliminar1,
              data:    params,
              dataType: 'json',
              success: function(resp){                    
                    if(resp.resp == 1){
                        cliente_archivos_listado($('#idClienteArchivo').val(), $('#titleModFileClient').text());
                    }
              }
          });
      });
}

$('#btnCancelaArchivoCte').click(function(){
  cancelarFrmArchivoCte();
});

function cancelarFrmArchivoCte(){
  dispFrmArchivoCte();
  $('#opcionAC').val(209);
}



//REFERENCIAS DEL CLIENTE
function cliente_referencias_listado(id, nombre){
  $('#titleModRefClient').text(nombre);
  $('#idClienteRef').val(id);
  urlPag1 = 'pg/cliente_referencias_listado.php';
  let params = {'id':id};

  $.ajax({
        beforeSend: function(){
            $("#cntnListadoReferenciasCliente").html(cargando);
        },
        type:    "post",
        url:     urlPag1,
        data:    params,
        dataType: 'html',
        success: function(data){            
            $('#cntnListadoReferenciasCliente').html(data);
            loadDataTable('listadoRefenciasCliente', true);
        }
  });
}

$('#btnNvoRefCte').click(function (){
  dispFrmReferenciaCte();
});

function dispFrmReferenciaCte(){
  resetForm('frmReferenciaCte');
  $('#cntnFrmReferenciaCte').slideToggle();
  $('#btnNvoRefCte').slideToggle();
  $('#txtNombreRef').focus();
  frmTelefonico('txtTelefonoRef');
}

$('#btnCancelaRefCte').click(function(){
  cancelarFrmRefCte();
});

function cancelarFrmRefCte(){
  dispFrmReferenciaCte();
  $('#opcionAC').val(211);
}

$('#btnGuardaRefCte').click(function(){
    if($('#txtNombreRef').val().length < 1){
      $('#txtNombreRef').focus();
      $('#reqTxtNombreRef').html('* Campo requerido');
      return false;
    }else{
      $('#reqTxtNombreRef').empty();
    }

    if($('#txtApellidoPRef').val().length < 1){
      $('#txtApellidoPRef').focus();
      $('#reqTxtApellidoPRef').html('* Campo requerido');
      return false;
    }else{
      $('#reqTxtApellidoPRef').empty();
    }

    if($('#txtApellidoMRef').val().length < 1){
      $('#txtApellidoMRef').focus();
      $('#reqTxtApellidoMRef').html('* Campo requerido');
      return false;
    }else{
      $('#reqTxtApellidoMRef').empty();
    }

    if($('#cboTipoRef').val() == 0){
      $('#cboTipoRef').focus();
      $('#reqCboTipoRef').html('* Campo requerido');
      return false;
    }else{
      $('#reqCboTipoRef').empty();
    }

    if($('#txtDireccionRef').val().length < 1){
      $('#txtDireccionRef').focus();
      $('#reqTxtDireccionRef').html('* Campo requerido');
      return false;
    }else{
      $('#reqTxtApellidoMRef').empty();
    }

    let formData = new FormData(document.getElementById("frmReferenciaCte"));

    $.ajax({
      beforeSend: function(){
        $("#respServer2").html(guardando);
      },
      url: urlSave,
      type: "post",
      dataType: "json",
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      success: function(resp){          
          $("#respServer2").empty();
          if(resp.resp == 1){
            cliente_referencias_listado($('#idClienteRef').val(), $('#titleModRefClient').text()); dispFrmReferenciaCte();
            if($('#opcionRC').val() == 212){
              $('#opcionRC').val(211);
            }
            resetForm('frmReferenciaCte');
          }else{
            $("#respServer2").html('Ocurrió un error al intentar guardar en la base de datos');
            return false;
          }
      }
    });
});

function editarRefCte(idCliente, idReferencia){
  dispFrmReferenciaCte();
  let params = {'idCliente':idCliente, 'idReferencia':idReferencia, 'opt':207}
  $.ajax({
        type:    "post",
        url:     urlConsultas1,
        data:    params,
        dataType: 'json',
        success: function(resp){
            $('#respServer2').empty('');
            $('#idReferencia').val(resp.id_referencia);
            $('#txtNombreRef').val(resp.nombre);
            $('#txtApellidoPRef').val(resp.apellido_p);
            $('#txtApellidoMRef').val(resp.apellido_m);
            $('#cboTipoRef').val(resp.id_tipo);
            $('#txtDireccionRef').val(resp.direccion);
            $('#txtTelefonoRef').val(resp.telefono);
            $('#opcionRC').val(212);
        }
  });
}

function eliminarRefCte(id, nombre){
  swal({
        html: true,
        title: "¿Está seguro?",
        text: "eliminar a la referencia: <strong>" + nombre + "</strong>",
        type: "warning",
        showCancelButton: true,
        cancelButtonClass: "btn-primary",
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Aceptar",
        cancelButtonText: "Cancelar",
        closeOnConfirm: true
      },
      function(){
          let params = {'id':id, 'opt':206};
          $.ajax({
              type:    "post",
              url:     urlEliminar1,
              data:    params,
              dataType: 'json',
              success: function(resp){
                    if(resp.resp == 1){
                        cliente_referencias_listado($('#idClienteRef').val(), $('#titleModRefClient').text());
                    }
              }
          });
      });
}



//PROPIEDADES DE INTERES PARA UN CLIENTE
function loadCboPropiedad(id=''){
    let params = {'opt':208};
    let element = '';
    $("#cboPropiedad").empty();
    let itemSelected;

    $.ajax({
        type:    "post",
        url:     urlConsultas1,
        data:    params,
        dataType: 'json',
        success: function(resp){
            element+= '<option value="0">Seleccionar --</option>';           
            $.each(resp.propiedades,function(i,y){
                itemSelected = (y['id'] == id)? 'selected':'';

                element+= '<option value="' + y['id'] + '" ' + itemSelected + ' >' + y['valor'] + '</option>';
            });

            $('#cboPropiedad').append(element);
            $('#cboPropiedad').select2();
        }
    });
}

function loadCboEstatusInteres(id=''){
    let params = {'opt':209};
    let element = '';
    $("#cboEstatusInt").empty();
    let itemSelected;

    $.ajax({
        type:    "post",
        url:     urlConsultas1,
        data:    params,
        dataType: 'json',
        success: function(resp){
            element+= '<option value="0">Seleccionar --</option>';
            $.each(resp.estatusInteres,function(i,y){
                itemSelected = (y['id'] == id)? 'selected':'';

                element+= '<option value="' + y['id'] + '" ' + itemSelected + ' >' + y['valor'] + '</option>';
            });

            $('#cboEstatusInt').append(element);
            $('#cboEstatusInt').select2();
        }
    });
}


function cliente_interes_listado(id, nombre){
  $('#titleModInteresClient').text(nombre);
  $('#idClienteInt').val(id);
  urlPag1 = 'pg/cliente_interes_listado.php';
  let params = {'id':id};

  $.ajax({
        beforeSend: function(){
            $("#cntnListadoInteresCliente").html(cargando);
        },
        type:    "post",
        url:     urlPag1,
        data:    params,
        dataType: 'html',
        success: function(data){            
            $('#cntnListadoInteresCliente').html(data);
            loadDataTable('listadoInteresCliente', true);
        }
  });
}

$('#btnNvoInteresCte').click(function (){
  dispFrmInteresCte();
});

function dispFrmInteresCte(){
  resetForm('frmInteresCte');
  $('#cntnFrmInteresCte').slideToggle();
  $('#btnNvoInteresCte').slideToggle();
  loadCboPropiedad(); loadCboEstatusInteres();
  $('#cboPropiedad').focus();
}

$('#btnCancelaInteresCte').click(function(){
  cancelarFrmInteresCte();
});

function cancelarFrmInteresCte(){
  dispFrmInteresCte();
  $('#opcionIC').val(213);
}

$('#btnGuardaInteresCte').click(function(){
    if($('#cboPropiedad').val() == 0){
      $('#cboPropiedad').focus();
      $('#reqCboPropiedad').html('* Campo requerido');
      return false;
    }else{
      $('#reqCboPropiedad').empty();
    }

    if($('#cboEstatusInt').val() == 0){
      $('#cboEstatusInt').focus();
      $('#reqCboEstatusInt').html('* Campo requerido');
      return false;
    }else{
      $('#reqCboEstatusInt').empty();
    }

    let formData = new FormData(document.getElementById("frmInteresCte"));

    $.ajax({
      beforeSend: function(){
        $("#respServer3").html(guardando);
      },
      url: urlSave,
      type: "post",
      dataType: "json",
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      success: function(resp){
          $("#respServer3").empty();
          if(resp.resp == 1){
            cliente_interes_listado($('#idClienteInt').val(), $('#titleModInteresClient').text()); dispFrmInteresCte();
            if($('#opcionIC').val() == 214){
              $('#opcionIC').val(213);
            }
            resetForm('frmInteresCte');
          }else{
            $("#respServer3").html('Ocurrió un error al intentar guardar en la base de datos');
            return false;
          }
      }
    });
});


function editarInteresCte(idCliente, idInteres){
  dispFrmInteresCte();
  let params = {'idCliente':idCliente, 'idInteres':idInteres, 'opt':210}
  $.ajax({
        type:    "post",
        url:     urlConsultas1,
        data:    params,
        dataType: 'json',
        success: function(resp){            
            $('#respServer3').empty('');
            $('#idInteres').val(resp.id_interes);            
            setTimeout(function(){
              loadCboPropiedad(resp.id_propiedad); loadCboEstatusInteres(resp.estatus);
            },200);
            $('#txtMonto').val(resp.monto);
            $('#opcionIC').val(214);
        }
  });
}

function eliminarInteresCte(id, nombre){
  swal({
        html: true,
        title: "¿Está seguro?",
        text: "eliminar el interes por: <strong>" + nombre + "</strong>",
        type: "warning",
        showCancelButton: true,
        cancelButtonClass: "btn-primary",
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Aceptar",
        cancelButtonText: "Cancelar",
        closeOnConfirm: true
      },
      function(){
          let params = {'id':id, 'opt':207};
          $.ajax({
              type:    "post",
              url:     urlEliminar1,
              data:    params,
              dataType: 'json',
              success: function(resp){                    
                    if(resp.resp == 1){
                        cliente_interes_listado($('#idClienteInt').val(), $('#titleModInteresClient').text());
                    }
              }
          });
      });
}




//MÓDULO DE COMPRAS
$('#btnNvaOrdenCompra, #btnCancelarOrdenComp').click(function(){
  dispFrmOrdenComp(); $('#cboObra, #cboEmpresa').select2();
});

function dispFrmOrdenComp(){
  $('#cntnFrmNvaOrdenComp').slideToggle();
  $('#btnNvaOrdenCompra').slideToggle();
  resetForm('frmNvaOrdenComp');
  $('#txtFolio').focus(); $('#cboObra, #cboEmpresa').select2();
}

//ORDENES DE COMPRA
function ordenes_compra_listado(pagina){
  urlPag1 = 'pg/ordenes_compra_listado.php';
  let params = {'pagina':pagina};

  $.ajax({
        beforeSend: function(){
            $("#cntnListOrdenesCompra").html(cargando);
        },
        type:    "post",
        url:     urlPag1,
        data:    params,
        dataType: 'html',
        success: function(data){
            //console.log(data);
            $('#cntnListOrdenesCompra').html(data);            
        }
  });
}

$('#btnGuardarOrdenComp').click(function(){
    if($('#txtFolio').val().length < 1){
      $('#txtFolio').focus();
      $('#reqTxtFolio').html('* Campo requerido');
      return false;
    }else{
      $('#reqTxtFolio').empty();
    }

    if($('#cboObra').val() == 0){
      $('#cboObra').focus();
      $('#reqCboObra').html('* Campo requerido');
      return false;
    }else{
      $('#reqCboObra').empty();
    }

    if($('#cboEmpresa').val() == 0){
      $('#cboEmpresa').focus();
      $('#reqCboEmpresa').html('* Campo requerido');
      return false;
    }else{
      $('#reqCboEmpresa').empty();
    }

    if($('#txtDireccionObra').val().length < 1){
      $('#txtDireccionObra').focus();
      $('#reqTxtDireccionObra').html('* Campo requerido');
      return false;
    }else{
      $('#reqTxtDireccionObra').empty();
    }

    if($('#txtDireccionObra').val().length < 1){
      $('#txtDireccionObra').focus();
      $('#reqTxtDireccionObra').html('* Campo requerido');
      return false;
    }else{
      $('#reqTxtDireccionObra').empty();
    }

    if($('#txtResidente').val().length < 1){
      $('#txtResidente').focus();
      $('#reqTxtResidente').html('* Campo requerido');
      return false;
    }else{
      $('#reqTxtResidente').empty();
    }

    

    let formData = new FormData(document.getElementById("frmNvaOrdenComp"));

    $.ajax({
      beforeSend: function(){
        $("#respServer").html(guardando);
      },
      url: urlSave,
      type: "post",
      dataType: "json",
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      success: function(resp){
          //console.log(resp);
          $("#respServer").empty();
          if(resp.resp == 1){
            ordenes_compra_listado(1); dispFrmOrdenComp();
            if($('#opcion').val() == 216){
              $('#opcion').val(215);
            }
          }else{
            $("#respServer").html('Ocurrió un error al intentar guardar en la base de datos');
          }
      }
    });
});


function editarOrdenC(idOrden){
  dispFrmOrdenComp();
  let params = {'idOrden':idOrden, 'opt':211}
  $.ajax({
        type:    "post",
        url:     urlConsultas1,
        data:    params,
        dataType: 'json',
        success: function(resp){
            //console.log(resp);                      
            $('#respServer').empty('');
            $('#txtFolio').val(resp.folio);
            $('#cboObra').val(resp.id_obra);
            $('#cboEmpresa').val(resp.id_empresa);
            $('#txtDireccionObra').val(resp.dirección_obra);
            $('#txtFechaCapt').val(resp.fecha_captura);
            $('#txtResidente').val(resp.residente);
            $('#cboTipoComp').val(resp.id_tipo_compra);
            $('#cboEstatus').val(resp.estatus);
            $('#idOrdenComp').val(resp.id_orden_compra);
            $('#opcion').val(216); $('#cboObra, #cboEmpresa').select2();
        }
  });
}


function eliminarOrdenC(id, nombre){
  swal({
        html: true,
        title: "¿Está seguro?",
        text: "eliminar orden de compra con folio: <strong>" + nombre + "</strong>",
        type: "warning",
        showCancelButton: true,
        cancelButtonClass: "btn-primary",
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Aceptar",
        cancelButtonText: "Cancelar",
        closeOnConfirm: true
      },
      function(){
          let params = {'id':id, 'opt':208};
          $.ajax({
              type:    "post",
              url:     urlEliminar1,
              data:    params,
              dataType: 'json',
              success: function(resp){                    
                    console.log(resp);
                    if(resp.resp == 1){
                        ordenes_compra_listado(1);
                    }
              }
          });
      });
}


function ordenes_compra_articulos_listado(idOrdenComp, folio){
  $('#titleModOrdCompArt').text(folio);
  $('#idOrdComp').val(idOrdenComp);
  urlPag1 = 'pg/orden_compra_articulos_listado.php';
  let params = {'idOrdenComp':idOrdenComp};

  $.ajax({
        beforeSend: function(){
            $("#cntnListadoArticulos").html(cargando);
        },
        type:    "post",
        url:     urlPag1,
        data:    params,
        dataType: 'html',
        success: function(data){            
            $('#cntnListadoArticulos').html(data);
            loadDataTable('listadoOrdCompArticulos', true, currentPage);
        }
  });
}


$('#btnNvoArtOrdComp, #btnCancelaArtOrdComp').click(function(){
  dispFrmArtOrdComp();
});

function dispFrmArtOrdComp(){
  $('#cntnFrmArtOrdComp').slideToggle();
  $('#btnNvoArtOrdComp').slideToggle();
  resetForm('frmArtOrdComp');
  $('#txtArticulo').focus();
  getCurrentPage();
}

$('#btnGuardaArtOrdComp').click(function(){
    if($('#txtArticulo').val().length < 1){
      $('#txtArticulo').focus();
      $('#reqTxtArticulo').html('* Campo requerido');
      return false;
    }else{
      $('#reqTxtArticulo').empty();
    }

    if($('#txtUnidad').val().length < 1){
      $('#txtUnidad').focus();
      $('#reqTxtUnidad').html('* Campo requerido');
      return false;
    }else{
      $('#reqTxtUnidad').empty();
    }

    if($('#txtCantidad').val().length < 1){
      $('#txtCantidad').focus();
      $('#reqTxtCantidadtxtCosto').html('* Campo requerido');
      return false;
    }else{
      $('#reqTxtCantidadtxtCosto').empty();
    }

    if($('#txtCosto').val().length < 1){
      $('#txtCosto').focus();
      $('#reqTxtCosto').html('* Campo requerido');
      return false;
    }else{
      $('#reqTxtCosto').empty();
    }  

    let formData = new FormData(document.getElementById("frmArtOrdComp"));

    $.ajax({
      beforeSend: function(){
        $("#respServer2").html(guardando);
      },
      url: urlSave,
      type: "post",
      dataType: "json",
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      success: function(resp){          
          $("#respServer2").empty();
          if(resp.resp == 1){
            ordenes_compra_articulos_listado($('#idOrdComp').val(), $('#titleModOrdCompArt').text()); dispFrmArtOrdComp();
            ordenes_compra_listado(1);
            if($('#opcion').val() == 218){
              $('#opcion').val(217);
            }
          }else{
            $("#respServer").html('Ocurrió un error al intentar guardar en la base de datos');
          }
      }
    });
});

function editarArticulo(idOrdenComp, idArticulo){
  dispFrmArtOrdComp();
  let params = {'idOrdenComp':idOrdenComp, 'idArticulo':idArticulo, 'opt':212}
  $.ajax({
        type:    "post",
        url:     urlConsultas1,
        data:    params,
        dataType: 'json',
        success: function(resp){
            $('#respServer2').empty('');
            $('#txtArticulo').val(resp.articulo);
            $('#txtUnidad').val(resp.unidad);
            $('#txtCantidad').val(resp.cantidad);
            $('#txtCosto').val(resp.monto);
            $('#idArticulo').val(resp.id_articulo_compra);
            $('#opcionAC').val(218); $('#txtArticulo').select();
        }
  });
}

function eliminarArticulo(id, nombre){
  swal({
        html: true,
        title: "¿Está seguro?",
        text: "eliminar el artículo: <strong>" + nombre + "</strong>",
        type: "warning",
        showCancelButton: true,
        cancelButtonClass: "btn-primary",
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Aceptar",
        cancelButtonText: "Cancelar",
        closeOnConfirm: true
      },
      function(){
          let params = {'id':id, 'opt':209};
          $.ajax({
              type:    "post",
              url:     urlEliminar1,
              data:    params,
              dataType: 'json',
              success: function(resp){                    
                    if(resp.resp == 1){
                        ordenes_compra_articulos_listado($('#idOrdComp').val(), $('#titleModOrdCompArt').text());
                    }
              }
          });
      });
}


//COTIZACIONES DE UNA ORDEN DE COMPRA
function ordenes_compra_cotizaciones_listado(idOrdenComp, folio){
  $('#titleModOrdCompCotizaion').text(folio);
  $('#idOrdCompCot').val(idOrdenComp);
  urlPag1 = 'pg/orden_compra_cotizaciones_listado.php';
  let params = {'idOrdenComp':idOrdenComp};

  $.ajax({
        beforeSend: function(){
            $("#cntnListadoCotizaciones").html(cargando);
        },
        type:    "post",
        url:     urlPag1,
        data:    params,
        dataType: 'html',
        success: function(data){            
            $('#cntnListadoCotizaciones').html(data);
            loadDataTable('listadoOrdCompCotizaciones', true);
        }
  });
}


$('#btnNvoCotizOrdComp, #btnCancelaCotizOrdComp').click(function(){
  dispFrmCotizOrdComp();
});

function dispFrmCotizOrdComp(){
  $('#cntnFrmCotizOrdComp').slideToggle();
  $('#btnNvoCotizOrdComp').slideToggle();

  resetForm('frmCotizOrdComp');
  $('#cboProveedor').select2();
  //getCurrentPage();
}

$('#btnGuardaCotizOrdComp').click(function(){
    if($('#cboProveedor').val() == '0'){
      $('#cboProveedor').focus();
      $('#reqCboProveedor').html('* Campo requerido');
      return false;
    }else{
      $('#reqCboProveedor').empty();
    }

    if($('#txtCuenta').val().length < 1){
      $('#txtCuenta').focus();
      $('#reqTxtCuenta').html('* Campo requerido');
      return false;
    }else{
      $('#reqTxtCuenta').empty();
    }

    if($('#txtMonto').val().length < 1){
      $('#txtMonto').focus();
      $('#reqTxtMonto').html('* Campo requerido');
      return false;
    }else{
      $('#reqTxtMonto').empty();
    }

    let formData = new FormData(document.getElementById("frmCotizOrdComp"));

    $.ajax({
      beforeSend: function(){
        $("#respServer3").html(guardando);
      },
      url: urlSave,
      type: "post",
      dataType: "json",
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      success: function(resp){
          console.log(resp);          
          $("#respServer3").empty();
          if(resp.resp == 1){
            ordenes_compra_cotizaciones_listado($('#idOrdCompCot').val(), $('#titleModOrdCompCotizaion').text()); dispFrmArtOrdComp();
            if($('#opcionCotiz').val() == 220){
              $('#opcionCotiz').val(219);
            }
          }else{
            $("#respServer").html('Ocurrió un error al intentar guardar en la base de datos');
          }
      }
    });
});

function editarCotizacion(idOrdenComp, idCotizacion){
  dispFrmCotizOrdComp();
  let params = {'idOrdenComp':idOrdenComp, 'idCotizacion':idCotizacion, 'opt':213}
  $.ajax({
        type:    "post",
        url:     urlConsultas1,
        data:    params,
        dataType: 'json',
        success: function(resp){
            $('#respServer2').empty('');
            $('#txtArticulo').val(resp.articulo);
            $('#txtUnidad').val(resp.unidad);
            $('#txtCantidad').val(resp.cantidad);
            $('#txtCosto').val(resp.monto);
            $('#idArticulo').val(resp.id_articulo_compra);
            $('#opcionAC').val(218); $('#txtArticulo').select();
        }
  });
}









//FUNCIONES++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function resetForm(formulario){
  $('#'+formulario)[0].reset();
}



function loadDataTable(table, busqueda, setPage = ''){
    dataTable1 = '';
    dataTable1 = $('#'+table).DataTable({
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
                dataTable1.page(setPage).draw('page');
            }, 10 );
        }
}

function getCurrentPage(){
    currentPage = dataTable1.page.info().page;    
}


function frmNumerico(elemento){
	$('#' + elemento).mask('000,000,000,000,000.00', {reverse: true});
}

function frmTelefonico(elemento){  
  $('#' + elemento).inputmask({"mask": "(999) 999-9999"});
}
