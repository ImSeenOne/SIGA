let cargando = "<center><img src='img/cargaa.gif' width='25px' /><br>Cargando ...</center>",
    guardando = "<center><img src='img/cargaa.gif' width='25px' /><br>Guardando ...</center>",
    eliminando = "<center><img src='img/cargaa.gif' width='25px' /><br>Eliminando ...</center>",
    urlPag,
    urlConsultas1 = 'php/consultas.php',
    urlSave = 'php/subir.php',
    urlEliminar1 = 'php/eliminar.php',
    dataTable1,
    requireField = '* Campo requerido',
    idCboCptoObra,
    data_invInt,
    cntnCboProp,
    currentPage;


function selectFrm(clase) {
    $('.' + clase).select2({
        placeholder: 'Seleccionar...'
    });
}

function activaDatePicker(elemento) {
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

$('#btnNvoGasto, #btnCancelaGasto').on('click', function() {
    $('#frmGasto').slideToggle();
    $('#btnNvoGasto').slideToggle();
});

$('#btnBusquedaGastos').on('click', function() {
    $('#frmBusquedaGasto').slideToggle();
});

//CATÁLOGOS INMOBILIARIA +++++++++++++++++++++++++++++++++++++++++++++++++++++
//CATÁLOGO DE CLOSETS


//CATÁLOGO CLOSETS LISTADO
function closets_listado() {
    urlPag1 = 'pg/closets_listado.php';
    let cntnListClosets = $("#cntnListClosets");

    $.ajax({
        beforeSend: function() {
            cntnListClosets.html(cargando);
        },
        type: "post",
        url: urlPag1,
        //data:    params,
        dataType: 'html',
        success: function(data) {
            cntnListClosets.html(data);
            loadDataTable('listCloset', true);
        }
    });
}

//addCloset
$('#btnGuardarCloset').click(function() {
    let txtNombre = $('#txtNombre'),
        reqTxtNombre = $('#reqTxtNombre'),
        respServer = $("#respServer");

    if (txtNombre.val().length < 1) {
        txtNombre.focus();
        reqTxtNombre.html(requireField);
        return false;
    } else {
        reqTxtNombre.empty();
    }

    let formData = new FormData(document.getElementById("frmClosets"));

    $.ajax({
        beforeSend: function() {
            respServer.html(guardando);
        },
        url: urlSave,
        type: "post",
        dataType: "json",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(resp) {
            respServer.empty();
            if (resp.resp == 1) {
                closets_listado();
                $('#opcion').val(201);
                resetForm('frmClosets');
            } else {
                respServer.html('Ocurrió un error al intentar guardar en la base de datos');
            }
        }
    });
});

function editarCloset(id) {
    let respServer = $("#respServer"),
        params = { 'id': id, 'opt': 204 };
    $.ajax({
        beforeSend: function() {
            respServer.html(cargando);
        },
        type: "post",
        url: urlConsultas1,
        data: params,
        dataType: 'json',
        success: function(resp) {
            respServer.empty('');
            $('#txtNombre').val(resp.nombre);
            $('#hdFlIcono').val(resp.icono);
            $('#idCloset').val(resp.id_closet);
            $('#opcion').val(202);
        }
    });
}


function eliminarCloset(id, icono, nombre) {
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
        function() {
            let params = { 'id': id, 'icono': icono, 'opt': 201 };
            $.ajax({
                type: "post",
                url: urlEliminar1,
                data: params,
                dataType: 'json',
                success: function(resp) {
                    if (resp.resp == 1) {
                        closets_listado();
                    }
                }
            });
        });
}






//CATÁLOGO NÚMERO DE BAÑOS
function wc_listado() {
    urlPag1 = 'pg/wc_listado.php';
    let cntnListWc = $("#cntnListWc");

    $.ajax({
        beforeSend: function() {
            cntnListWc.html(cargando);
        },
        type: "post",
        url: urlPag1,
        //data:    params,
        dataType: 'html',
        success: function(data) {
            cntnListWc.html(data);
            loadDataTable('listWc', true);
        }
    });
}


//addwC
$('#idBtnGuardaWc').on('click', function() {
    let txtNombre = $('#txtNombre'),
        reqTxtNombre = $('#reqTxtNombre'),
        respServer = $("#respServer");

    if (txtNombre.val().length < 1) {
        txtNombre.focus();
        reqTxtNombre.html(requireField);
        return false;
    } else {
        reqTxtNombre.empty();
    }

    let formData = new FormData(document.getElementById("frmWc"));

    $.ajax({
        beforeSend: function() {
            respServer.html(guardando);
        },
        url: urlSave,
        type: "post",
        dataType: "json",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(resp) {
            respServer.empty();
            if (resp.resp == 1) {
                wc_listado();
                $('#opcion').val(203);
                resetForm('frmWc');
            } else {
                respServer.html('Ocurrió un error al intentar guardar en la base de datos');
            }
        }
    });
});

function editarRegWc(id) {
    let respServer = $("#respServer");
    params = { 'id': id, 'opt': 202 };
    $.ajax({
        beforeSend: function() {
            respServer.html(cargando);
        },
        type: "post",
        url: urlConsultas1,
        data: params,
        dataType: 'json',
        success: function(resp) {
            respServer.empty('');
            $('#txtNombre').val(resp.nombre);
            $('#hdFlIcono').val(resp.icono);
            $('#idWc').val(resp.id_num_banio);
            $('#opcion').val(204);
        }
    });
}

function eliminarRegWc(id, icono, nombre) {
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
        function() {
            let params = { 'id': id, 'icono': icono, 'opt': 202 };
            $.ajax({
                type: "post",
                url: urlEliminar1,
                data: params,
                dataType: 'json',
                success: function(resp) {
                    if (resp.resp == 1) {
                        wc_listado();
                    }
                }
            });
        });
}


$('#idBtnCancelarWc').on('click', function() {
    resetForm('frmWc');
});







//SERVICIOS Y AMENIDADES
function servicio_amenidades_listado() {
    urlPag1 = 'pg/servicios_amenidades_listado.php';
    let cntnListServicioAmenidades = $("#cntnListServicioAmenidades");

    $.ajax({
        beforeSend: function() {
            cntnListServicioAmenidades.html(cargando);
        },
        type: "post",
        url: urlPag1,
        //data:    params,
        dataType: 'html',
        success: function(data) {
            cntnListServicioAmenidades.html(data);
            loadDataTable('listAmenidades', true);
        }
    });
}


$('#btnGuardaServAmenidad').on('click', function() {
    let txtNombre = $('#txtNombre'),
        reqTxtNombre = $('#reqTxtNombre'),
        respServer = $("#respServer");

    if (txtNombre.val().length < 1) {
        txtNombre.focus();
        reqTxtNombre.html(requireField);
        return false;
    } else {
        reqTxtNombre.empty();
    }

    let formData = new FormData(document.getElementById("frmAmenidades"));

    $.ajax({
        beforeSend: function() {
            respServer.html(guardando);
        },
        url: urlSave,
        type: "post",
        dataType: "json",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(resp) {
            respServer.empty();
            if (resp.resp == 1) {
                servicio_amenidades_listado();
                $('#opcion').val(205);
                resetForm('frmAmenidades');
            } else {
                respServer.html('Ocurrió un error al intentar guardar en la base de datos');
            }
        }
    });
});


function editarServAmd(id) {
    let params = { 'id': id, 'opt': 203 },
        respServer = $("#respServer");

    $.ajax({
        beforeSend: function() {
            respServer.html(cargando);
        },
        type: "post",
        url: urlConsultas1,
        data: params,
        dataType: 'json',
        success: function(resp) {
            respServer.empty('');
            $('#txtNombre').val(resp.nombre);
            $('#hdFlIcono').val(resp.icono);
            $('#idServAmenidad').val(resp.id_servicio_amenidad);
            $('#opcion').val(206);
        }
    });
}


$('#btnCancelaServAmenidad').on('click', function() {
    resetForm('frmAmenidades');
});



function eliminarServAmd(id, icono, nombre) {
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
        function() {
            let params = { 'id': id, 'icono': icono, 'opt': 203 };
            $.ajax({
                type: "post",
                url: urlEliminar1,
                data: params,
                dataType: 'json',
                success: function(resp) {
                    if (resp.resp == 1) {
                        servicio_amenidades_listado();
                    }
                }
            });
        });
}





//SUBMÓDULO CLIENTES
$('#btnBusquedaCliente').on('click', function() {
    let cntnBusq = $('#cntnBusquedaCte');
    resetFrmBusqCte();

    if(cntnBusq.is(':visible')){
        cntnBusq.slideUp();
    }else{
        cntnBusq.slideDown();
        cntnCboProp = 'cntnBusquedaCte';
        $('#txtNombreBusqueda').focus();
        loadCboDesarrollos();
    }
});

$('input:radio[name=filterBusqCte]').on('ifChecked', function(){
    let txtBusqueda = $('#txtBusquedaCte'),
        optSelected = parseInt($('input:radio[name=filterBusqCte]:checked').val()),
        leyenda = '';

    switch (optSelected) {
        case 1:
            leyenda = 'Ingresar nombre...';
        break;

        case 2:
            leyenda = 'Ingresar el RFC...';
        break;

        case 3:
            leyenda = 'Ingresar la CURP...';
        break;
    }
    txtBusqueda.val('')
               .attr('placeholder', leyenda)
               .focus();
});

$(document).on('keyup', '#txtBusquedaCte', function(e) {
    if (e.which == 13 || e.which == 8 || (e.which >= 65 && e.which <= 90) || (e.which >= 97 && e.which <= 122)) {
        clientes_listado(1);
    }
});

$(document).on('change', '#cboTipoClienteBusq, #cboModalidadBusq', function() {
    clientes_listado(1);
});

$('#btnResetBusqCte').on('click', function() { resetFrmBusqCte(); });

function resetFrmBusqCte(){
    $('#txtBusquedaCte').val('');    
    $('#cboTipoClienteBusq').val(0);
    $('#cboModalidadBusq').val(0);
    $('div#'+cntnCboProp+' selected#cboDesarrollo').val(0);
    $('#cboNumEdificio, #cboPropiedad, #cboNivel').empty().attr('disabled', true);
    clientes_listado(1);
}

//MOTRAR/OCULTAR FORMULARIO DE REGISTRO
$('#btnNvoRegCliente, #btnCancelarRegClient').on('click', function() {
    dispFrmClient('Nuevo Cliente');
});

function dispFrmClient(titulo) {
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
function clientes_listado(pagina) {
    urlPag1 = 'pg/clientes_listado.php';
    let opt    = parseInt($('input:radio[name=filterBusqCte]:checked').val()),    
        params = {'optSelected': opt, 'busqueda': $('#txtBusquedaCte').val(), 'tipoCteBusq': $('#cboTipoClienteBusq').val(), 'modalidadBusq': $('#cboModalidadBusq').val(), 'idPropiedad': $('#cboPropiedad').val(), 'pagina': pagina },
        cntnListClientes = $("#cntnListClientes");

    $.ajax({
        beforeSend: function() {
            cntnListClientes.html(cargando);
        },
        type: "post",
        url: urlPag1,
        data: params,
        dataType: 'html',
        success: function(data) {
            //console.log(data);
            cntnListClientes.html(data);
            dispPopOverCte();
        }
    });
}

function dispPopOverCte(){    
    $('.popOver').each(function(){
        var $elem = $(this);
        $elem.popover({
            placement: 'auto',
            trigger: 'hover',            
            container: $elem
        });
    });
}

$('#cboModalidad').on('change', function(){
    let nss = $('#txtNss');
    if($(this).val() == 1){
        nss.attr('readonly', false);
        nss.focus();
    }else{
        nss.attr('readonly', true);
        $('#reqTxtNss').html('');
    }
});

$('#btnGuardarRegClient').on('click', function() {
    let cboTipoCliente = $('#cboTipoCliente'),
        reqCboTipoCliente = $('#reqCboTipoCliente'),
        txtRfc = $('#txtRfc'),
        reqTxtRfc = $('#reqTxtRfc'),
        txtNss = $('#txtNss'),
        reqTxtNss = $('#reqTxtNss');
        txtCurp = $('#txtCurp'),
        reqTxtCurp = $('#reqTxtCurp'),
        txtNombre = $('#txtNombre'),
        reqTxtNombre = $('#reqTxtNombre'),
        txtApellidoP = $('#txtApellidoP'),
        reqTxtApellidoP = $('#reqTxtApellidoP'),
        txtApellidoM = $('#txtApellidoM'),
        reqTxtApellidoM = $('#reqTxtApellidoM'),
        cboEstadoCivil = $('#cboEstadoCivil'),
        reqCboEstadoCivil = $('#reqCboEstadoCivil'),
        txtDomicilio = $('#txtDomicilio'),
        reqCboDomicilio = $('#reqCboDomicilio'),
        cboModalidad = $('#cboModalidad'),
        reqCboModalidad = $('#reqCboModalidad'),
        txtOtros = $('#txtOtros'),
        reqTxtOtros = $('#reqTxtOtros'),
        txtCorreo = $('#txtCorreo'),
        reqTxtCorreo = $('#reqTxtCorreo'),
        txtCelular = $('#txtCelular'),
        reqTxtCelular = $('#reqTxtCelular'),
        respServer = $("#respServer");

    if (cboTipoCliente.val() == 0) {
        cboTipoCliente.focus();
        reqCboTipoCliente.html(requireField);
        return false;
    } else {
        reqCboTipoCliente.empty();
    }

    if (txtRfc.val().length < 1) {
        txtRfc.focus();
        reqTxtRfc.html(requireField);
        return false;
    } else {
        reqTxtRfc.empty();
    }

    if(cboModalidad.val() == 1){
        if (txtNss.val().length < 11 || txtNss.val().length > 11) {
            txtNss.focus();
            reqTxtNss.html('* NSS debe de tener 11 caracteres');
            return false;
        } else {
            reqTxtNss.empty();
        }
    }


    if (txtCurp.val().length < 18 || txtCurp.val().length > 18) {
        txtCurp.focus();
        reqTxtCurp.html('* CURP debe de tener 18 caracteres');
        return false;
    } else {
        reqTxtCurp.empty();
    }

    if (txtNombre.val().length < 1) {
        txtNombre.focus();
        reqTxtNombre.html(requireField);
        return false;
    } else {
        reqTxtNombre.empty();
    }

    if (txtApellidoP.val().length < 1) {
        txtApellidoP.focus();
        reqTxtApellidoP.html(requireField);
        return false;
    } else {
        reqTxtApellidoP.empty();
    }

    if (txtApellidoM.val().length < 1) {
        txtApellidoM.focus();
        reqTxtApellidoM.html(requireField);
        return false;
    } else {
        reqTxtApellidoM.empty();
    }

    if (cboEstadoCivil.val() == 0) {
        cboEstadoCivil.focus();
        reqCboEstadoCivil.html(requireField);
        return false;
    } else {
        reqCboEstadoCivil.empty();
    }

    if (cboModalidad.val() == 0) {
        cboModalidad.focus();
        reqCboModalidad.html(requireField);
        return false;
    } else {
        reqCboModalidad.empty();
    }

    if (cboModalidad.val() == 5 && txtOtros.val().length < 1) {
        txtOtros.focus();
        reqTxtOtros.html(requireField);
        return false;
    } else {
        reqTxtOtros.empty();
    }

    if (txtCorreo.val().length < 1) {
        txtCorreo.focus();
        reqTxtCorreo.html(requireField);
        return false;
    } else {
        reqTxtCorreo.empty();
    }

    if (txtCelular.val().length < 1) {
        txtCelular.focus();
        reqTxtCelular.html(requireField);
        return false;
    } else {
        reqTxtCelular.empty();
    }

    let formData = new FormData(document.getElementById("frmNvoCliente"));

    $.ajax({
        beforeSend: function() {
            respServer.html(guardando);
        },
        url: urlSave,
        type: "post",
        dataType: "json",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(resp) {
            respServer.empty();
            if (resp.resp == 1) {
                clientes_listado(1);
                dispFrmClient();
                if ($('#opcion').val() == 208) {
                    $('#opcion').val(207);
                }
                resetForm('frmNvoCliente');
            } else {
                respServer.html('Ocurrió un error al intentar guardar en la base de datos');
            }
        }
    });
});

//para activar o desactivar el campo especifique del formulario agregar cliente
$('#cboModalidad').on('change', function() {
    let txtOtros = $('#txtOtros');
    if ($(this).val() == 5) {
        txtOtros.prop('disabled', false)
            .focus();
    } else {
        txtOtros.val('')
            .prop('disabled', true);
    }
});


function editarCliente(id) {
    dispFrmClient('Editar Cliente');
    let params = { 'id': id, 'opt': 205 },
        txtOtros = $('#txtOtros');

    $.ajax({
        type: "post",
        url: urlConsultas1,
        data: params,
        dataType: 'json',
        success: function(resp) {            
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
            $('#txtNss').val(resp.nss);
            $('#txtCurp').val(resp.curp);
            $('#cboModalidad').val(resp.id_modalidad);
            if (resp.id_modalidad == 5) {
                txtOtros.val(resp.otros);
                txtOtros.prop("disabled", false);
            } else {
                txtOtros.val('');
                txtOtros.prop("disabled", true);
            }

            $('#opcion').val(208);
        }
    });
}


function eliminarCliente(id, nombre) {
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
        function() {
            let params = { 'id': id, 'opt': 204 };
            $.ajax({
                type: "post",
                url: urlEliminar1,
                data: params,
                dataType: 'json',
                success: function(resp) {
                    if (resp.resp == 1) {
                        clientes_listado(1);
                    }
                }
            });
        });
}



//ARCHIVOS DEL CLIENTE
function cliente_archivos_listado(id, nombre) {
    $('#titleModFileClient').text(nombre);
    $('#idClienteArchivo').val(id);
    urlPag1 = 'pg/cliente_archivos_listado.php';
    let params = { 'id': id },
        cntnListadoArchivosCliente = $("#cntnListadoArchivosCliente");

    $.ajax({
        beforeSend: function() {
            cntnListadoArchivosCliente.html(cargando);
        },
        type: "post",
        url: urlPag1,
        data: params,
        dataType: 'html',
        success: function(data) {
            cntnListadoArchivosCliente.html(data);
            loadDataTable('listadoArchivosCliente', true);
        }
    });
}

$('#btnNvoArchivoCte').on('click', function() {
    dispFrmArchivoCte();
});

function dispFrmArchivoCte() {
    resetForm('frmArchivosCte');
    $('#cntnFrmArchivoCte').slideToggle();
    $('#btnNvoArchivoCte').slideToggle();
    $('#flArchivo').focus();
}

$('#flArchivo').on('change', function(){
    validaFrmFileUpload($(this).attr('id'), 'reqFlArchivo', 'btnGuardaArchivoCte');
});

$('#btnGuardaArchivoCte').on('click', function() {
    let txtDescricion = $('#txtDescricion'),
        reqTxtDescripcion = $('#reqTxtDescripcion'),
        respServer1 = $("#respServer1"),
        opcionAC = $('#opcionAC');

    if (txtDescricion.val() == 0) {
        txtDescricion.focus();
        reqTxtDescripcion.html(requireField);
        return false;
    } else {
        reqTxtDescripcion.empty();
    }

    let formData = new FormData(document.getElementById("frmArchivosCte"));

    $.ajax({
        beforeSend: function() {
            respServer1.html(guardando);
        },
        url: urlSave,
        type: "post",
        dataType: "json",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(resp) {
            respServer1.empty();
            if (resp.resp == 1) {
                cliente_archivos_listado($('#idClienteArchivo').val(), $('#titleModFileClient').text());
                dispFrmArchivoCte();
                if (opcionAC.val() == 210) {
                    opcionAC.val(209);
                }
                resetForm('frmArchivosCte');
            } else if (resp.resp == 2) {
                respServer1.html('Es necesario seleccionar un archivo');
                return false;
            } else {
                respServer1.html('Ocurrió un error al intentar guardar en la base de datos');
                return false;
            }
        }
    });
});

function editarArchivoCte(idCliente, idArchivo) {
    dispFrmArchivoCte();
    let params = { 'idCliente': idCliente, 'idArchivo': idArchivo, 'opt': 206 }
    $.ajax({
        type: "post",
        url: urlConsultas1,
        data: params,
        dataType: 'json',
        success: function(resp) {
            $('#respServer').empty('');
            $('#idArchivo').val(resp.id_archivo);
            $('#txtDescripcion').val(resp.descripcion);
            $('#hdFlArchivo').val(resp.ruta_archivo);
            $('#opcionAC').val(210);
        }
    });
}

function eliminarArchivoCte(id, nombre) {
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
        function() {
            let params = { 'id': id, 'opt': 205 };
            $.ajax({
                type: "post",
                url: urlEliminar1,
                data: params,
                dataType: 'json',
                success: function(resp) {
                    if (resp.resp == 1) {
                        cliente_archivos_listado($('#idClienteArchivo').val(), $('#titleModFileClient').text());
                    }
                }
            });
        });
}

$('#btnCancelaArchivoCte').on('click', function() {
    cancelarFrmArchivoCte();
});

function cancelarFrmArchivoCte() {
    dispFrmArchivoCte();
    $('#opcionAC').val(209);
    $('#btnGuardaArchivoCte').attr('disabled', false);
}



//REFERENCIAS DEL CLIENTE
function cliente_referencias_listado(id, nombre) {
    $('#titleModRefClient').text(nombre);
    $('#idClienteRef').val(id);
    urlPag1 = 'pg/cliente_referencias_listado.php';
    let params = { 'id': id },
        cntnListadoReferenciasCliente = $("#cntnListadoReferenciasCliente");

    $.ajax({
        beforeSend: function() {
            cntnListadoReferenciasCliente.html(cargando);
        },
        type: "post",
        url: urlPag1,
        data: params,
        dataType: 'html',
        success: function(data) {
            cntnListadoReferenciasCliente.html(data);
            loadDataTable('listadoRefenciasCliente', true);
        }
    });
}

$('#btnNvoRefCte').on('click', function() {
    dispFrmReferenciaCte();
});

function dispFrmReferenciaCte() {
    resetForm('frmReferenciaCte');
    $('#cntnFrmReferenciaCte').slideToggle();
    $('#btnNvoRefCte').slideToggle();
    $('#txtNombreRef').focus();
    frmTelefonico('txtTelefonoRef');
}

$('#btnCancelaRefCte').on('click', function() {
    cancelarFrmRefCte();
});

function cancelarFrmRefCte() {
    dispFrmReferenciaCte();
    $('#opcionAC').val(211);
}

$('#btnGuardaRefCte').on('click', function() {
    let txtNombreRef = $('#txtNombreRef'),
        reqTxtNombreRef = $('#reqTxtNombreRef'),
        txtApellidoPRef = $('#txtApellidoPRef'),
        reqTxtApellidoPRef = $('#reqTxtApellidoPRef'),
        txtApellidoMRef = $('#txtApellidoMRef'),
        reqTxtApellidoMRef = $('#reqTxtApellidoMRef'),
        cboTipoRef = $('#cboTipoRef'),
        reqCboTipoRef = $('#reqCboTipoRef'),
        txtDireccionRef = $('#txtDireccionRef'),
        reqTxtDireccionRef = $('#reqTxtDireccionRef'),
        respServer2 = $("#respServer2"),
        opcionRC = $('#opcionRC');

    if (txtNombreRef.val().length < 1) {
        txtNombreRef.focus();
        reqTxtNombreRef.html(requireField);
        return false;
    } else {
        reqTxtNombreRef.empty();
    }

    if (txtApellidoPRef.val().length < 1) {
        txtApellidoPRef.focus();
        reqTxtApellidoPRef.html(requireField);
        return false;
    } else {
        reqTxtApellidoPRef.empty();
    }

    if (txtApellidoMRef.val().length < 1) {
        txtApellidoMRef.focus();
        reqTxtApellidoMRef.html(requireField);
        return false;
    } else {
        reqTxtApellidoMRef.empty();
    }

    if (cboTipoRef.val() == 0) {
        cboTipoRef.focus();
        reqCboTipoRef.html(requireField);
        return false;
    } else {
        reqCboTipoRef.empty();
    }

    if (txtDireccionRef.val().length < 1) {
        txtDireccionRef.focus();
        reqTxtDireccionRef.html(requireField);
        return false;
    } else {
        reqTxtDireccionRef.empty();
    }

    let formData = new FormData(document.getElementById("frmReferenciaCte"));

    $.ajax({
        beforeSend: function() {
            respServer2.html(guardando);
        },
        url: urlSave,
        type: "post",
        dataType: "json",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(resp) {
            respServer2.empty();
            if (resp.resp == 1) {
                cliente_referencias_listado($('#idClienteRef').val(), $('#titleModRefClient').text());
                dispFrmReferenciaCte();
                if (opcionRC.val() == 212) {
                    opcionRC.val(211);
                }
                resetForm('frmReferenciaCte');
            } else {
                respServer2.html('Ocurrió un error al intentar guardar en la base de datos');
                return false;
            }
        }
    });
});

function editarRefCte(idCliente, idReferencia) {
    dispFrmReferenciaCte();
    let params = { 'idCliente': idCliente, 'idReferencia': idReferencia, 'opt': 207 }
    $.ajax({
        type: "post",
        url: urlConsultas1,
        data: params,
        dataType: 'json',
        success: function(resp) {
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

function eliminarRefCte(id, nombre) {
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
        function() {
            let params = { 'id': id, 'opt': 206 };
            $.ajax({
                type: "post",
                url: urlEliminar1,
                data: params,
                dataType: 'json',
                success: function(resp) {
                    if (resp.resp == 1) {
                        cliente_referencias_listado($('#idClienteRef').val(), $('#titleModRefClient').text());
                    }
                }
            });
        });
}



//PROPIEDADES DE INTERES PARA UN CLIENTE
function loadCboDesarrollos(id = '') {
    let params = { 'opt': 222 },
        cboDesarrollo,      
        element = '',
        itemSelected;
    
    cboDesarrollo = $('div#'+cntnCboProp+' select#cboDesarrollo'); 

    $.ajax({
        beforeSend: function() {
            cboDesarrollo.empty();
        },
        type: "post",
        url: urlConsultas1,
        data: params,
        dataType: "json",
        success: function(response) {            
            let desarrollos = response.desarrollos;
            element = '<option value="0">Seleccionar</option>';
            for (let i = 0; i < desarrollos.length; i++) {
                itemSelected = (desarrollos[i].id == id) ? 'selected' : '';
                element += '<option value="' + desarrollos[i].id + '" ' + itemSelected + ' >' + desarrollos[i].valor + '</option>';
            }

            cboDesarrollo.append(element).select2();
        }
    });
}

function activeCboEdificio(){    
    if ($('div#'+cntnCboProp+' select#cboDesarrollo').find(':selected').val() > 0) {
        $('div#'+cntnCboProp+' select#cboNumEdificio, select#cboNivel, select#cboPropiedad').removeAttr('disabled');
        loadCboNumEdificio();
    } else {
        $('div#'+cntnCboProp+' select#cboNumEdificio, select#cboNivel, select#cboPropiedad').empty('').prop('disabled', true);
    }
}

function loadCboNumEdificio(id = '') {
    let params = { 'opt': 223, 'idDesarrollo': $('div#'+cntnCboProp+' #cboDesarrollo').val() },
        cboNumEdificio,
        element = '',
        itemSelected;

    cboNumEdificio = $('div#'+cntnCboProp+' select#cboNumEdificio');

    $.ajax({
        beforeSend: function() {
            cboNumEdificio.empty();
        },
        type: "post",
        url: urlConsultas1,
        data: params,
        dataType: "json",
        success: function(response) {
            let numEdificio = response.numEdificio;
            element = '<option value="-1">Seleccionar</option>';
            for (let i = 0; i < numEdificio.length; i++) {
                itemSelected = (numEdificio[i].id == id) ? 'selected' : '';
                element += '<option value="' + numEdificio[i].id + '" ' + itemSelected + ' >' + numEdificio[i].valor + '</option>';
            }

            cboNumEdificio.append(element)
                .select2();
        }
    });
}

function activaNivel() {
    let cboNivel = $('div#'+cntnCboProp+' #cboNivel'),
        cboPropiedad = $('div#'+cntnCboProp+' #cboPropiedad');
    if ($('div#'+cntnCboProp+' #cboNumEdificio').val() != '-1') {
        cboNivel.prop('disabled', false);
        cboPropiedad.prop('disabled', false);
        loadCboNivel();
    } else {
        cboNivel.empty('').prop('disabled', true);
        cboPropiedad.empty('').prop('disabled', true);
    }
}

function loadCboNivel(id = '') {
    let cboNivel,
        params = { 'opt': 224, 'idDesarrollo': $('div#'+cntnCboProp+' #cboDesarrollo').val(), 'numEdificio': $('div#'+cntnCboProp+' #cboNumEdificio').val() },
        element = '',
        itemSelected, itemDisabled;

        cboNivel = $('div#'+cntnCboProp+' select#cboNivel');

    $.ajax({
        beforeSend: function() {
            cboNivel.empty();
        },
        type: "post",
        url: urlConsultas1,
        data: params,
        dataType: 'json',
        success: function(resp) {            
            let niveles = resp.niveles;
            element += '<option value="0">Seleccionar --</option>';
            for (let i = 0; i < niveles.length; i++) {
                itemSelected = (niveles[i].id == id) ? 'selected' : '';
                itemDisabled = (niveles[i].habilitado == 1) ? 'disabled' : '';
                element += '<option value="' + niveles[i].id + '" ' + itemSelected + ' ' + itemDisabled + ' >' + niveles[i].valor + '</option>';
            }

            cboNivel.append(element)
                .select2();
        }
    });
}

function activeCboPropiedad(){
    let cboPropiedad = $('div#'+cntnCboProp+' #cboPropiedad');
    if ($('div#'+cntnCboProp+' select#cboNivel').val() > 0) {
        cboPropiedad.prop('disabled', false);
        loadCboPropiedad();
    } else {
        cboPropiedad.empty('')
            .prop('disabled', true);
    }
}

function loadCboPropiedad(id = '') {
    let cboPropiedad,
        params = { 'opt': 208, 'idDesarrollo': $('div#'+cntnCboProp+' #cboDesarrollo').val(), 'numEdificio': $('div#'+cntnCboProp+' #cboNumEdificio').val(), 'nivel': $('div#'+cntnCboProp+' #cboNivel').val() },
        element = '',
        itemSelected, itemDisabled= '';

        cboPropiedad = $('div#'+cntnCboProp+' select#cboPropiedad');

    $.ajax({
        beforeSend: function() {
            cboPropiedad.empty();
        },
        type: "post",
        url: urlConsultas1,
        data: params,
        dataType: 'json',
        success: function(resp) {            
            element += '<option value="0">Seleccionar --</option>';
            for (let i = 0; i < resp.propiedades.length; i++) {
                itemSelected = (resp.propiedades[i].id == id) ? 'selected' : '';                
                element += '<option value="' + resp.propiedades[i].id + '" ' + itemSelected + ' ' + itemDisabled + ' >' + resp.propiedades[i].valor + '</option>';
            }

            cboPropiedad.append(element).select2();
        }
    });
}

//VALIDA SI UNA PROPIEDAD ESTÁ ASIGNADA A UN CLIENTE
function validaPropAsig(){
    let idProp = $('div#'+cntnCboProp+' select#cboPropiedad').val(),
        cntnMsg= $('#respServer3'),
        btnSave= $('#btnGuardaInteresCte'),
        txtLeyend, estAct,
        params = {idProp, 'opt':236};        

    $.ajax({
        type: "post",
        url: urlConsultas1,
        data: params,
        dataType: 'json',
        success: function(r) {            
            //console.log(r);
            if (parseInt(r.exist) === 1) {
                txtLeyend= '* La propiedad está asignada al cliente '+r.cte;
                estAct = true;
            } else {
                txtLeyend= '';
                estAct = false;
            }

            cntnMsg.html(txtLeyend);
            btnSave.attr('disabled', estAct);
        }
    });
}

function loadCboEstatusInteres(id = '') {
    let params = { 'opt': 209 },
        element = '',
        cboEstatusInt = $("#cboEstatusInt"),
        itemSelected;

    $.ajax({
        beforeSend: function() {
            cboEstatusInt.empty();
        },
        type: "post",
        url: urlConsultas1,
        data: params,
        dataType: 'json',
        success: function(resp) {
            element += '<option value="0">Seleccionar --</option>';
            for (let i = 0; i < resp.estatusInteres.length; i++) {
                itemSelected = (resp.estatusInteres[i].id == id) ? 'selected' : '';
                element += '<option value="' + resp.estatusInteres[i].id + '" ' + itemSelected + ' >' + resp.estatusInteres[i].valor + '</option>';
            }
            cboEstatusInt.append(element)
                .select2();
        }
    });
}


function cliente_interes_listado(id, nombre) {
    $('#titleModInteresClient').text(nombre);
    $('#idClienteInt').val(id);
    urlPag1 = 'pg/cliente_interes_listado.php';
    let params = { 'id': id },
        cntnListadoInteresCliente = $("#cntnListadoInteresCliente");

    $.ajax({
        beforeSend: function() {
            cntnListadoInteresCliente.html(cargando);
        },
        type: "post",
        url: urlPag1,
        data: params,
        dataType: 'html',
        success: function(data) {
            cntnListadoInteresCliente.html(data);
            //loadDataTable('listadoInteresCliente', true);
        }
    });
}

$('#btnNvoInteresCte').on('click', function() {
    dispFrmInteresCte();
});

function dispFrmInteresCte() {
    let cntnFrmInteresCte = $('#cntnFrmInteresCte'),
        btnNvoInteresCte  = $('#btnNvoInteresCte');
    resetForm('frmInteresCte');
    if(cntnFrmInteresCte.is(':visible')){
        cntnFrmInteresCte.slideUp();
        btnNvoInteresCte.show();
        cntnCboProp = 'cntnBusquedaCte';
    }else{
        cntnFrmInteresCte.slideDown();
        cntnCboProp = 'cntnFrmInteresCte';
        btnNvoInteresCte.hide();
        loadCboDesarrollos();
        loadCboEstatusInteres();
        $('#cboNumEdificio, #cboPropiedad, #cboNivel, #txtFechaFirma, #txtFechaEntrega').empty().attr('disabled', true);
    }
}

$('#btnCancelaInteresCte').on('click', function() {
    cancelarFrmInteresCte();
});

function cancelarFrmInteresCte() {
    dispFrmInteresCte();
    $('#btnGuardaInteresCte').removeAttr('disabled');
    $('#opcionIC').val(213);
}

$('#btnGuardaInteresCte').on('click', function() {
    let cboDesarrollo     = $('div#'+cntnCboProp+' #cboDesarrollo'),
        reqCboDesarrollo  = $('#reqCboDesarrollo'),
        cboEdificio       = $('div#'+cntnCboProp+' #cboNumEdificio'),
        reqCboNumEdificio = $('#reqCboNumEdificio'),
        cboNivel          = $('div#'+cntnCboProp+' #cboNivel'),
        reqCboNivel       = $('#reqCboNivel'),
        cboPropiedad      = $('div#'+cntnCboProp+' #cboPropiedad'),
        reqCboPropiedad   = $('#reqCboPropiedad'),
        cboEstatusInt     = $('#cboEstatusInt'),
        reqCboEstatusInt  = $('#reqCboEstatusInt'),
        respServer3       = $("#respServer3"),
        opcionIC          = $('#opcionIC');

    if (cboDesarrollo.val() == 0) {
        cboDesarrollo.focus();
        reqCboDesarrollo.html(requireField);
        return false;
    } else {
        reqCboDesarrollo.empty('');
    }

    if (cboEdificio.val() == -1) {
        cboEdificio.focus();
        reqCboNumEdificio.html(requireField);
        return false;
    } else {
        reqCboNumEdificio.empty();
    }

    if (cboNivel.val() == 0) {
        cboNivel.focus();
        reqCboNivel.html(requireField);
        return false;
    } else {
        reqCboNivel.empty();
    }

    if (cboPropiedad.val() == 0) {
        cboPropiedad.focus();
        reqCboPropiedad.html(requireField);
        return false;
    } else {
        reqCboPropiedad.empty();
    }

    if (cboEstatusInt.val() == 0) {
        cboEstatusInt.focus();
        reqCboEstatusInt.html(requireField);
        return false;
    } else {
        reqCboEstatusInt.empty();
    }
    
    let formData = new FormData(document.getElementById("frmInteresCte"));

    $.ajax({
        beforeSend: function() {
            respServer3.html(guardando);
        },
        url: urlSave,
        type: "post",
        dataType: "json",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(resp) {
            respServer3.empty();
            if (resp.resp == 1) {
                cliente_interes_listado($('#idClienteInt').val(), $('#titleModInteresClient').text());
                dispFrmInteresCte();
                if (opcionIC.val() == 214) {
                    opcionIC.val(213);
                }
                resetForm('frmInteresCte');
            } else {
                respServer3.html('Ocurrió un error al intentar guardar en la base de datos');
                return false;
            }
        }
    });
});


function editarInteresCte(idCliente, idInteres) {
    dispFrmInteresCte();
    let params          = { 'idCliente': idCliente, 'idInteres': idInteres, 'opt': 210 },
        txtFechaFirma   = $('#txtFechaFirma'),
        txtFechaEntrega = $('#txtFechaEntrega'),
        actFechaFirm, actFechaEnt, idDesarrollo, idEdificio, idNivel, idDepto;

    $.ajax({
        type: "post",
        url: urlConsultas1,
        data: params,
        dataType: 'json',
        beforeSend: function(){            
            $('div#'+cntnCboProp+' select#cboNumEdificio').removeAttr('disabled');
            $('div#'+cntnCboProp+' select#cboNivel').removeAttr('disabled');
            $('div#'+cntnCboProp+' select#cboPropiedad').removeAttr('disabled');            
        },
        success: function(resp) {                   
            if(resp.activar_firma == 1){
                txtFechaFirma.removeAttr('disabled');
            }else{
                txtFechaFirma.attr('disabled',true);
            }

            if(resp.activar_entrega == 1){
                txtFechaEntrega.removeAttr('disabled');
            }else{
                txtFechaEntrega.attr('disabled',true);
            }
            $('#respServer3').empty('');
            $('#idInteres').val(resp.id_interes);
            $('#txtAgente').val(resp.agente);
            $('#txtFechaFirma').val(resp.fecha_firma);
            $('#txtFechaEntrega').val(resp.fecha_entrega);
            idDesarrollo = resp.desarrollo;
            idEdificio   = resp.numero_edificio;
            idNivel      = resp.numero_nivel;
            idDepto      = resp.id_propiedad;
            /* setTimeout(function() {
                loadCboDesarrollos(parseInt(resp.desarrollo));
                setTimeout(function() {
                    loadCboNumEdificio(resp.numero_edificio);
                    setTimeout(function() {
                        loadCboNivel(resp.numero_nivel);
                        setTimeout(function() { loadCboPropiedad(resp.id_propiedad); }, 200);
                    }, 200);
                }, 200);                
            }, 200); */
            loadCboEstatusInteres(resp.estatus);
            $('#hdCboPropiedad').val(resp.id_propiedad);
            $('#txtMonto').val(resp.monto);
            $('#opcionIC').val(214);
        },
        complete:function(){
            setTimeout(function() {
                loadCboDesarrollos(parseInt(idDesarrollo));
                setTimeout(function() {
                    loadCboNumEdificio(idEdificio);
                    setTimeout(function() {
                        loadCboNivel(idNivel);
                        setTimeout(function() { loadCboPropiedad(idDepto); }, 200);
                    }, 200);
                }, 200);
            }, 200);
        }
    });
}

function eliminarInteresCte(id, nombre) {
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
        function() {
            let params = { 'id': id, 'opt': 207 };
            $.ajax({
                type: "post",
                url: urlEliminar1,
                data: params,
                dataType: 'json',
                success: function(resp) {
                    if (resp.resp == 1) {
                        cliente_interes_listado($('#idClienteInt').val(), $('#titleModInteresClient').text());
                    }
                }
            });
        });
}




//MÓDULO DE COMPRAS
$('#btnBusquedaProveedor').click(function() {
    $('#cntnBusquedaProv').slideToggle();
    $('.rdoProveedor').iCheck('check');
});

$('input').on('ifChecked', function(){
    let txtBusqueda = $('#txtBusqProv'),
        optSelected = parseInt($('input:radio[name=filterProvBusq]:checked').val()),
        leyenda     = '';

    switch (optSelected) {
        case 1:
            leyenda = 'Ingrese el nombre del proveedor...';
        break;

        case 2:
            leyenda = 'Ingrese el Rfc...';
        break;

        case 3:
            leyenda = 'Ingrese el nombre del agente...';
        break;
    }
    txtBusqueda.val('')
               .attr('placeholder', leyenda)
               .focus();
});

$("#txtBusqProv").on('keypress', function(e) {
    if (e.which == 13) {
        proveedores_listado(1);
    }
});

$('#btnResetBusqProv').click(function() {
    $('#txtBusqProv').val('');
    $('.rdoProveedor').iCheck('check');
    proveedores_listado(1);
});

//CATÁLOGO DE PROVEEDORES
function proveedores_listado(pagina) {
    let cntnListProveedores = $("#cntnListProveedores"),
        urlPag1 = 'pg/proveedores_listado.php',
        opt     = parseInt($('input:radio[name=filterProvBusq]:checked').val()),
        params  = {'opt':opt, 'busqueda':$('#txtBusqProv').val(), 'pagina': pagina };

    $.ajax({
        type: "post",
        url: urlPag1,
        data: params,
        dataType: 'html',
        beforeSend: function() {
            cntnListProveedores.html(cargando);
        },
        success: function(data) {
            cntnListProveedores.html(data);
        }
    });
}

$('#btnNvoProveedor, #btnCancelaRegProveedor').click(function() {
    dispFrmProveedores();
});

function dispFrmProveedores() {
    $('#cntnFrmNvoProveedor').slideToggle();
    $('#btnNvoProveedor').slideToggle();
    resetForm('frmNvoProveedor');
    $('#txtNombre').focus();
    frmTelefonico('txtTelefono');
    frmTelefonico('txtTelAgent');
}

$('#btnGuardaRegProveedor').click(function() {
    if ($('#txtNombre').val().length < 1) {
        $('#txtNombre').focus();
        $('#reqTxtNombre').html('* Campo requerido');
        return false;
    } else {
        $('#reqTxtNombre').empty();
    }

    if ($('#txtRazonSoc').val().length < 1) {
        $('#txtRazonSoc').focus();
        $('#reqTxtRazonSoc').html('* Campo requerido');
        return false;
    } else {
        $('#reqTxtRazonSoc').empty();
    }

    if ($('#txtRfc').val().length < 1) {
        $('#txtRfc').focus();
        $('#reqTxtRfc').html('* Campo requerido');
        return false;
    } else {
        $('#reqTxtRfc').empty();
    }

    if ($('#txtTelefono').val().length < 1) {
        $('#txtTelefono').focus();
        $('#reqTxtTelefono').html('* Campo requerido');
        return false;
    } else {
        $('#reqTxtTelefono').empty();
    }

    if ($('#txtDireccion').val().length < 1) {
        $('#txtDireccion').focus();
        $('#reqTxtDireccion').html('* Campo requerido');
        return false;
    } else {
        $('#reqTxtDireccion').empty();
    }

    if ($('#txtNombreAgente').val().length < 1) {
        $('#txtNombreAgente').focus();
        $('#reqTxtNombreAgent').html('* Campo requerido');
        return false;
    } else {
        $('#reqTxtNombreAgent').empty();
    }

    if ($('#txtCorreoAgent').val().length < 1) {
        $('#txtCorreoAgent').focus();
        $('#reqTxtCorreoAgent').html('* Campo requerido');
        return false;
    } else {
        $('#reqTxtCorreoAgent').empty();
    }

    if ($('#txtTelAgent').val().length < 1) {
        $('#txtTelAgent').focus();
        $('#reqTxtTelAgent').html('* Campo requerido');
        return false;
    } else {
        $('#reqTxtTelAgent').empty();
    }

    let formData = new FormData(document.getElementById("frmNvoProveedor"));

    $.ajax({
        beforeSend: function() {
            $("#respServer").html(guardando);
        },
        url: urlSave,
        type: "post",
        dataType: "json",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(resp) {
            $("#respServer").empty();
            if (resp.resp == 1) {
                proveedores_listado(1);
                dispFrmProveedores();
                if ($('#opcion').val() == 225) {
                    $('#opcion').val(224);
                }
            } else {
                $("#respServer").html('Ocurrió un error al intentar guardar en la base de datos');
            }
        }
    });
});

function editarProveedor(idProveedor) {
    dispFrmProveedores();
    let params = { 'idProveedor': idProveedor, 'opt': 215 }
    $.ajax({
        type: "post",
        url: urlConsultas1,
        data: params,
        dataType: 'json',
        success: function(resp) {
            //console.log(resp);
            $('#respServer').empty('');
            $('#idProveedor').val(resp.id_proveedor);
            $('#txtNombre').val(resp.nombre);
            $('#txtRazonSoc').val(resp.razon_social);
            $('#txtRfc').val(resp.rfc);
            $('#txtTelefono').val(resp.telefono);
            $('#txtDireccion').val(resp.direccion);
            $('#txtObservaciones').val(resp.observaciones);
            $('#txtNombreAgente').val(resp.nombre_agente);
            $('#txtCorreoAgent').val(resp.correo_agente);
            $('#txtTelAgent').val(resp.telefono_agente);
            $('#opcion').val(225);
        }
    });
}

function eliminarProveedor(id, nombre) {
    swal({
            html: true,
            title: "¿Está seguro?",
            text: "eliminar al proveedor: <strong>" + nombre + "</strong>",
            type: "warning",
            showCancelButton: true,
            cancelButtonClass: "btn-primary",
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Aceptar",
            cancelButtonText: "Cancelar",
            closeOnConfirm: true
        },
        function() {
            let params = { 'id': id, 'opt': 212 };
            $.ajax({
                type: "post",
                url: urlEliminar1,
                data: params,
                dataType: 'json',
                success: function(resp) {
                    //console.log(resp);
                    if (resp.resp == 1) {
                        proveedores_listado(1);
                    }
                }
            });
        });
}

function proveedor_cuentas_listado(id, nombre) {
    $('#titleModProvCtas').text(nombre);
    $('#idProv').val(id);
    urlPag1 = 'pg/proveedores_cuentas_listado.php';
    let params = { 'id': id };

    $.ajax({
        beforeSend: function() {
            $("#cntnListProvCtas").html(cargando);
        },
        type: "post",
        url: urlPag1,
        data: params,
        dataType: 'html',
        success: function(data) {
            $('#cntnListProvCtas').html(data);
            loadDataTable('listadoProvCtas', true);
        }
    });
}

function loadCboBancos(id = '') {
    let params = { 'opt': 216 }
    let element;
    let itemSelected;
    $('#cboBanco').empty();

    $.ajax({
        type: "post",
        url: urlConsultas1,
        data: params,
        dataType: 'json',
        success: function(resp) {
            //console.log(resp);
            element += '<option value="0">Seleccionar</option>';
            $.each(resp.bancos, function(i, y) {
                itemSelected = (y['id'] == id) ? 'selected' : '';

                element += '<option value="' + y['id'] + '" ' + itemSelected + ' >' + y['valor'] + '</option>';
            });

            $('#cboBanco').append(element);
        }
    });
}

$('#btnNvaCtaProv').click(function() {
    dispFrmProvCtaDown();
});

$('#btnCancelaProvCta').click(function() {
    dispFrmProvCtaUp();
});

function dispFrmProvCtaDown() {
    $('#cntnFrmProvCta').slideDown();
    $('#btnNvaCtaProv').slideUp();
    resetForm('frmProvCta');
    loadCboBancos();
    $('#cboBanco').select2();
    $('#cboBanco').focus();
    $('#opcionProvCta').val(226);
}

function dispFrmProvCtaUp() {
    $('#cntnFrmProvCta').slideUp();
    $('#btnNvaCtaProv').slideDown();
    resetForm('frmProvCta');
    $('#opcionProvCta').val(226);
}

$('#btnGuardaProvCta').click(function() {
    if ($('#cboBanco').val() == 0) {
        $('#cboBanco').focus();
        $('#reqcboBanco').html('* Campo requerido');
        return false;
    } else {
        $('#reqcboBanco').empty();
    }

    if ($('#txtNumCta').val().length < 1) {
        $('#txtNumCta').focus();
        $('#reqTxtNumCta').html('* Campo requerido');
        return false;
    } else {
        $('#reqTxtNumCta').empty();
    }

    if ($('#txtCbeInterbanc').val().length < 1) {
        $('#txtCbeInterbanc').focus();
        $('#reqTxtCbeInterbanc').html('* Campo requerido');
        return false;
    } else {
        $('#reqTxtCbeInterbanc').empty();
    }

    let formData = new FormData(document.getElementById("frmProvCta"));

    $.ajax({
        beforeSend: function() {
            $("#respServer2").html(guardando);
        },
        url: urlSave,
        type: "post",
        dataType: "json",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(resp) {
            $("#respServer2").empty();
            if (resp.resp == 1) {
                proveedor_cuentas_listado($('#idProv').val(), $('#titleModProvCtas').text());
                dispFrmProvCtaUp();
                if ($('#opcionProvCta').val() == 227) {
                    $('#opcionProvCta').val(226);
                }
            } else {
                $("#respServer2").html('Ocurrió un error al intentar guardar en la base de datos');
            }
        }
    });
});

function editarProveedorCta(idProvCta) {
    dispFrmProvCtaDown();
    let params = { 'idProveedor': $('#idProv').val(), 'idProvCta': idProvCta, 'opt': 217 }
    $.ajax({
        type: "post",
        url: urlConsultas1,
        data: params,
        dataType: 'json',
        success: function(resp) {
            $('#respServer2').empty('');
            $('#idProvCta').val(idProvCta);
            $('#cboBanco').val(resp.id_banco);
            $('#txtNumCta').val(resp.cuenta);
            $('#txtCbeInterbanc').val(resp.clabe_interbancaria);
            $('#opcionProvCta').val(227);
            $('#cboBanco').select2();
        }
    });
}

function eliminarProveedorCta(id, nombre) {
    swal({
            html: true,
            title: "¿Está seguro?",
            text: "eliminar a la cuenta del proveedor: <strong>" + nombre + "</strong>",
            type: "warning",
            showCancelButton: true,
            cancelButtonClass: "btn-primary",
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Aceptar",
            cancelButtonText: "Cancelar",
            closeOnConfirm: true
        },
        function() {
            let params = { 'id': id, 'opt': 213 };
            $.ajax({
                type: "post",
                url: urlEliminar1,
                data: params,
                dataType: 'json',
                success: function(resp) {
                    if (resp.resp == 1) {
                        proveedor_cuentas_listado($('#idProv').val(), $('#titleModProvCtas').text());
                    }
                }
            });
        });
}




//=====================================================================================

$('#btnNvaOrdenCompra, #btnCancelarOrdenComp').click(function() {
    dispFrmOrdenComp();
    $('#cboObra, #cboEmpresa').select2();
    $('#cbxEnviarA').bootstrapToggle('off');
});

function dispFrmOrdenComp() {
    $('#cntnFrmNvaOrdenComp').slideToggle();
    $('#btnNvaOrdenCompra').slideToggle();
    resetForm('frmNvaOrdenComp');
    $('#txtFolio').focus();
    $('#cboObra, #cboEmpresa').select2();
}

$('#btnBusqOrdenCompra').click(function() {
    $('#cntnBusqOrdenCompra').slideToggle();
    $('#cboObraBusq, #cboEmpresaBusq').select2();
});

$('#btnBusqOrdComp').click(function() {
    ordenes_compra_listado(1);
});

$("#txtFolioBusq").keypress(function(e) {
    if (e.which == 13) {
        ordenes_compra_listado(1);
    }
});

$('#cboObraBusq, #cboEmpresaBusq, #cboEstatusBusq, #cboTipoCompraBusq').change(function() {
    ordenes_compra_listado(1);
});

$('#btnResetBusqOrdComp').click(function() {
    $('#txtFolioBusq').val();
    $('#cboObraBusq').val(0);
    $('#cboEmpresaBusq').val(0);
    $('#cboEstatusBusq').val(-1);
    $('#cboTipoCompraBusq').val(0);
    $('#txtFechaDesde').val('');
    $('#txtFechaHasta').val('');
    ordenes_compra_listado(1);
});

//ORDENES DE COMPRA
function ordenes_compra_listado(pagina) {
    urlPag1 = 'pg/ordenes_compra_listado.php';
    let params = { 'folio': $('#txtFolioBusq').val(), 'obra': $('#cboObraBusq').val(), 'empresa': $('#cboEmpresaBusq').val(), 'estatus': $('#cboEstatusBusq').val(), 'tipoCompra': $('#cboTipoCompraBusq').val(), 'fechaDesde': $('#txtFechaDesde').val(), 'fechaHasta': $('#txtFechaHasta').val(), 'pagina': pagina };

    $.ajax({
        type: "post",
        url: urlPag1,
        data: params,
        dataType: 'html',
        beforeSend: function() {
            $("#cntnListOrdenesCompra").html(cargando);
        },
        success: function(data) {            
            $('#cntnListOrdenesCompra').html(data);
        }
    });
}

$('#btnGuardarOrdenComp').click(function() {
    if ($('#cboObra').val() == 0) {
        $('#cboObra').focus();
        $('#reqCboObra').html('* Campo requerido');
        return false;
    } else {
        $('#reqCboObra').empty();
    }

    if ($('#cboEmpresa').val() == 0) {
        $('#cboEmpresa').focus();
        $('#reqCboEmpresa').html('* Campo requerido');
        return false;
    } else {
        $('#reqCboEmpresa').empty();
    }

    if ($('#txtDireccionObra').val().length < 1) {
        $('#txtDireccionObra').focus();
        $('#reqTxtDireccionObra').html('* Campo requerido');
        return false;
    } else {
        $('#reqTxtDireccionObra').empty();
    }

    if ($('#txtResidente').val().length < 1) {
        $('#txtResidente').focus();
        $('#reqTxtResidente').html('* Campo requerido');
        return false;
    } else {
        $('#reqTxtResidente').empty();
    }

    let formData = new FormData(document.getElementById("frmNvaOrdenComp"));

    $.ajax({
        beforeSend: function() {
            $("#respServer").html(guardando);
        },
        url: urlSave,
        type: "post",
        dataType: "json",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(resp) {
            //console.log(resp);
            $("#respServer").empty();
            if (resp.resp == 1) {
                ordenes_compra_listado(1);
                dispFrmOrdenComp();
                if ($('#opcion').val() == 216) {
                    $('#opcion').val(215);
                }
            } else {
                $("#respServer").html('Ocurrió un error al intentar guardar en la base de datos');
            }
        }
    });
});


function editarOrdenC(idOrden) {
    dispFrmOrdenComp();
    let params = { 'idOrden': idOrden, 'opt': 211 }
    $.ajax({
        type: "post",
        url: urlConsultas1,
        data: params,
        dataType: 'json',
        success: function(resp) {            
            $('#respServer').empty('');
            $('#txtFolio').val(resp.folio);
            $('#cboObra').val(resp.id_obra);
            $('#cboEmpresa').val(resp.id_empresa);
            $('#txtDireccionObra').val(resp.direccion_obra);
            $('#txtFechaCapt').val(resp.fecha_captura);
            $('#txtResidente').val(resp.residente);
            $('#cboTipoComp').val(resp.id_tipo_compra);
            $('#cboEstatus').val(resp.estatus);
            let valEnvA = (resp.enviar_a == 1)? 'off':'on';
            $('#cbxEnviarA').bootstrapToggle(valEnvA);
            $('#idOrdenComp').val(resp.id_orden_compra);
            $('#opcion').val(216);
            $('#cboObra, #cboEmpresa').select2();
        }
    });
}


function eliminarOrdenC(id, nombre) {
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
        function() {
            let params = { 'id': id, 'opt': 208 };
            $.ajax({
                type: "post",
                url: urlEliminar1,
                data: params,
                dataType: 'json',
                success: function(resp) {                    
                    if (resp.resp == 1) {
                        ordenes_compra_listado(1);
                    }
                }
            });
        });
}

//PROPIEDADES DE INTERES PARA UN CLIENTE
//EVENTO PARA ESCOGER EL CATÁLOGO A CARGAR EN EL COMBO cboArticulo

//CARGAR EL COMBO DE CONCEPTOS DESDE EL CATÁLOGO DE EXPLOSIÓN DE INSUMOS
function loadCboConceptos(idObra, id = '') {
    let params = { 'idObra': idObra, 'opt': 218 },
        element = '',
        cboArticulo = $("#cboArticulo"),
        itemSelected;
        
    cboArticulo.empty('');

    $.ajax({
        type: "post",
        url: urlConsultas1,
        data: params,
        dataType: 'json',
        success: function(resp) {
            let cptos = resp.conceptos;
            element += '<option value="0"> Seleccionar </option>';
            for (let i = 0; i < cptos.length; i++) {
                itemSelected = (cptos[i].id == id) ? 'selected' : '';
                element += '<option data-existinv = "' + cptos[i].existInv + '" value="' + cptos[i].id + '" ' + itemSelected + ' >' + cptos[i].valor + '</option>';
            }
            cboArticulo.append(element);
        },
        complete: function(){            
            data_invInt = 0;            
        }
    });
}

//CARGAR EL COMBO DE CONCEPTOS DESDE EL CATÁLOGO DE EXPLOSIÓN DE INSUMOS
function loadCboCptosInvInt(id = ''){
    let params = {'opt': 220 };
    let element = '';
    let cboArticulo = $("#cboArticulo");
    cboArticulo.empty();
    let itemSelected;

    $.ajax({
        type: "post",
        url: urlConsultas1,
        data: params,
        dataType: 'json',
        success: function(resp) {
            let cptos = resp.conceptos;
            for (let i = 0; i < cptos.length; i++) {
                itemSelected = (cptos[i].id == id) ? 'selected' : '';
                element += '<option data-existinv = "' + cptos[i].existInv + '" value="' + cptos[i].id + '" ' + itemSelected + ' >' + cptos[i].valor + '</option>';
            }
            element += '<option value="-1">[Agregar Nuevo Concepto]</option>';
            cboArticulo.append(element)
                .select2();
        },
        complete: function(){            
            data_invInt = 1;            
        }
    });
}

function initBTModalFrmCtptosOrdComp(){
    let cntnFrmCatInvInt = $('#cntnFrmCatInvInt');

    $('#cbxCatInvent').change(function() {
        $('#dataConcept').empty().slideUp();
        if ($(this).prop('checked')) {
            loadCboCptosInvInt();
        } else {
            loadCboConceptos(idCboCptoObra);
            if(cntnFrmCatInvInt.is(':visible')){                
                cntnFrmCatInvInt.slideUp();
            }
        }
    })
}

$('#cboArticulo').on('change', function() {
    let dataConcept      = $('#dataConcept'),
        cntnFrmCatInvInt = $('#cntnFrmCatInvInt');
        $('#invInt').val(data_invInt);

    if (data_invInt == 0) {
        cntnFrmCatInvInt.slideUp();        
    } else {        
        if ($(this).find(':selected').val() == '-1') {            
            cntnFrmCatInvInt.slideDown();            
            frmInvInterno();
        } else {
            cntnFrmCatInvInt.slideUp();
            closeCntnFrmInvInt();
        }
    }

    if ($(this).find(':selected').val() == 0 || $(this).find(':selected').val() == '-1') {
        dataConcept.slideUp().empty();
    } else {
        dataConcept.slideDown();
    }

    let params = { 'idOrdComp': $('#idOrdComp').val(), 'cboArticulo': $(this).find(':selected').val(), 'data_invInt': data_invInt, 'opt': 219 };
    
        $.ajax({
            type: "post",
            url: urlConsultas1,
            data: params,
            dataType: 'json',
            success: function(resp) {
                //console.log(resp);
                $('#txtUnidad').val(resp.unidad);
                $('#txtCosto').val(number_format(resp.precio_unitario, 2));
                loadDataCepto(resp.cantidad, resp.unidad, resp.acumulado, resp.recDisponible);
            }
        });
});

function closeCntnFrmInvInt(){
    $('#cntnFrmCatInvInt').slideUp();
}

function validaImpMaxCpto() {
    let respServer2 = $('#respServer2');    
    let params = { 'idOrdComp': $('#idOrdComp').val(), 'invInt': data_invInt, 'cboArticulo': $('#cboArticulo').val(), 'cantidad': $('#txtCantidad').val(), 'costo': $('#txtCosto').val(), 'data_invInt': data_invInt, 'opt': 221 };

    $.ajax({
        type: "post",
        url: urlConsultas1,
        data: params,
        dataType: 'json',
        success: function(resp) {
            //console.log(resp);     
            if (resp.resp == 1) {
                respServer2.html('La cantidad acumulada supera a la autorizada para el concepto');
                $('#txtCantidad').select();                
                return true;
            } else {
                respServer2.html('');                
                return false;
            }
        }
    });
}

$(document).on('change keyup', '#txtCantidad', function() {    
    if (validaImpMaxCpto()) {
        return false;
    }
});

function loadDataCepto(cantidadAut, unidadMed, acumulado, cantDispnible) {
    let element;
    element = '<strong>Cantidad Asignada:</strong> <cite>' + cantidadAut + ' ' + unidadMed +  '</cite>&nbsp;&nbsp;|&nbsp;&nbsp;';
    element += '<strong>Cantidad Consumida:</strong> <cite>' + acumulado + ' ' + unidadMed +  '</cite>&nbsp;&nbsp;|&nbsp;&nbsp;';
    element += '<strong>Cantidad Disponible:</strong> <cite>' + cantDispnible + ' ' + unidadMed +  '</cite>';

    $('#dataConcept').html(element);
}

function ordenes_compra_articulos_listado(idOrdenComp, idObra, folio) {
    idCboCptoObra = idObra;
    $('#titleModOrdCompArt').text(folio);
    $('#idObraOrdComp').val(idObra);
    $('#idOrdComp').val(idOrdenComp);
    loadCboConceptos(idObra);
    let cntnListArt = $("#cntnListadoArticulos");
    urlPag1 = 'pg/orden_compra_articulos_listado.php';
    let params = { 'idOrdenComp': idOrdenComp };

    $.ajax({
        beforeSend: function() {
            cntnListArt.html(cargando);
        },
        type: "post",
        url: urlPag1,
        data: params,
        dataType: 'html',
        success: function(data) {
            cntnListArt.html(data);
            //loadDataTable('listadoOrdCompArticulos', true, currentPage);
        }
    });
}


$('#btnNvoArtOrdComp, #btnCancelaArtOrdComp').click(dispFrmArtOrdComp);

function dispFrmArtOrdComp() {
    $('#cntnFrmArtOrdComp').slideToggle();
    $('#btnNvoArtOrdComp').slideToggle();
    $('#cbxCatInvent').bootstrapToggle('off');
    $('#cntnFrmCatInvInt').slideUp();
    resetForm('frmArtOrdComp');
    $('#cboArticulo').focus();
    $('#cboArticulo').select2();
    $('#reqCboArticulo, #reqTxtUnidad, #reqTxtCantidad, #reqTxtCosto, #respServer2').html('');
    $('#dataConcept').empty();
    $('#dataConcept').slideUp();
    //getCurrentPage();
}

function frmInvInterno(){
    let cntnFrmCatInvInt = $('#cntnFrmCatInvInt'),
        element = '';

    element+'<form id="frmInvInt">';
        element+'<div class="row">';
            element+= '<div  class="col-lg-4">';
                element+= '<div class="form-group">';
                    element+= '<label for="txtCodigo">Código</label>';
                    element+= '<input type="text" id="txtCodigoInv" name="txtCodigoInv" class="form-control" autofocus />';
                    element+= '<div id="reqTxtCodigo" class="msgError text-danger"></div>';
                element+= '</div>';
            element+= '</div>';

            element+= '<div  class="col-lg-4">';
                element+= '<div class="form-group">';
                    element+= '<label for="txtConceptoInv">Concepto</label>';
                    element+= '<input type="text" id="txtConceptoInv" name="txtConceptoInv" class="form-control" />';
                    element+= '<div id="reqTxtConceptoInv" class="msgError text-danger"></div>';
                element+= '</div>';
            element+= '</div>';
            element+= '<div  class="col-lg-4">';
                element+= '<div class="form-group">';
                    element+= '<label for="txtUnidadInv">Unidad</label>';
                    element+= '<input type="text" id="txtUnidadInv" name="txtUnidadInv" class="form-control" />';
                    element+= '<div id="reqTxtUnidadInv" class="msgError text-danger"></div>';
                element+= '</div>';
            element+= '</div>';
        element+= '</div>';

        element+'<div class="row">';
            element+= '<div  class="col-lg-4">';
                element+= '<div class="form-group">';
                    element+= '<label for="txtCantidadInv">Cantidad</label>';
                    element+= '<input type="text" id="txtCantidadInv" name="txtCantidadInv" class="form-control validaNumeros" />';
                    element+= '<div id="reqTextCantidadInv" class="msgError text-danger"></div>';
                element+= '</div>';
            element+= '</div>';

            element+= '<div  class="col-lg-4">';
                element+= '<div class="form-group">';
                    element+= '<label for="txtPrecioUnitInv">Precio Unitario</label>';
                    element+= '<input type="text" id="txtPrecioUnitInv" name="txtPrecioUnitInv" class="form-control validaNumeros" />';
                    element+= '<div id="reqTxtPrecioUnitInv" class="msgError text-danger"></div>';
                element+= '</div>';
            element+= '</div>';

            element+= '<div  class="col-lg-4">';
                element+= '<div class="form-group">';
                    element+= '<label for="txtImporteInv">Importe</label>';
                    element+= '<input type="text" id="txtImporteInv" name="txtImporteInv" class="form-control validaNumeros" />';
                    element+= '<div id="reqTxtImporteInv" class="msgError text-danger"></div>';
                element+= '</div>';
            element+= '</div>';
        element+= '</div>';

        element+= '<div id="respServer3" class="col-lg-12 text-center text-danger mb-1em"></div>';

        element+= '<div  class="col-lg-12 text-center">';
            element+= '<div class="form-group">';
                element+= '<input type="hidden" id="opcionInvInt" name="opcion" value="2171" />';
                element+= '<button type="button" id="btnGuardaCtpoInt" class="btn btn-primary btn-sm mt-2-3 mr_04em" >Guardar</button>';
                element+= '<button type="button" id="btnCancelarCtpoInt" class="btn btn-secondary btn-sm mt-2-3" >Cancelar</button>';
            element+= '</div>';
        element+= '</div>';
    element+= '</form>';

    $('#cntnFrmCInt').html(element);
}

$(document).on('click', '#btnGuardaCtpoInt', function() {
    let txtCodigoInv        = $('#txtCodigoInv'),
        reqTxtCodigo        = $('#reqTxtCodigo'),
        txtConceptoInv      = $('#txtConceptoInv'),
        reqTxtConceptoInv   = $('#reqTxtConceptoInv'),
        txtUnidadInv        = $('#txtUnidadInv'),
        reqTxtUnidadInv     = $('#reqTxtUnidadInv'),
        txtCantidadInv      = $('#txtCantidadInv'),
        reqTextCantidadInv  = $('#reqTextCantidadInv'),
        txtPrecioUnitInv    = $('#txtPrecioUnitInv'),
        reqTxtPrecioUnitInv = $('#reqTxtPrecioUnitInv'),
        txtImporteInv       = $('#txtImporteInv'),
        reqTxtImporteInv    = $('#reqTxtImporteInv'),
        respServer3         = $('#respServer3'),
        formData;

    /* if (txtCodigoInv.val().length < 1) {
        txtCodigoInv.focus();
        reqTxtCodigo.html('* Campo requerido');
        return false;
    } else {
        reqTxtCodigo.empty();
    } */

    if (txtConceptoInv.val().length < 1) {
        txtConceptoInv.focus();
        reqTxtConceptoInv.html('* Campo requerido');
        return false;
    } else {
        reqTxtConceptoInv.empty();
    }

    if (txtCantidadInv.val().length < 1) {
        txtCantidadInv.focus();
        reqTextCantidadInv.html('* Campo requerido');
        return false;
    } else {
        reqTextCantidadInv.empty();
    }

    if (txtPrecioUnitInv.val().length < 1) {
        txtPrecioUnitInv.focus();
        reqTxtPrecioUnitInv.html('* Campo requerido');
        return false;
    } else {
        reqTxtPrecioUnitInv.empty();
    }

    if (txtPrecioUnitInv.val().length < 1) {
        txtPrecioUnitInv.focus();
        reqTxtPrecioUnitInv.html('* Campo requerido');
        return false;
    } else {
        reqTxtPrecioUnitInv.empty();
    }    

    formData = {'txtCodigoInv':txtCodigoInv.val(), 'txtConceptoInv': txtConceptoInv.val(), 'txtUnidadInv': txtUnidadInv.val(), 'txtCantidadInv': txtCantidadInv.val(), 'txtPrecioUnitInv': txtPrecioUnitInv.val(), 'txtImporteInv': txtImporteInv.val(), 'opcion': $('#opcionInvInt').val()}

    $.ajax({
        url: urlSave,
        type: "post",
        dataType: "json",
        data: formData,
        beforeSend: function() {
            $("#respServer3").html(guardando);
        },
        success: function(resp) {            
            $("#respServer3").empty();
            if (resp.resp == 1) {
                $('#cntnFrmCatInvInt').slideUp();
            } else {
                $("#respServer3").html('Ocurrió un error al intentar guardar en la base de datos');
            }
        },
        complete: function(){
            loadCboCptosInvInt();
        }
    });
});



$(document).on('click', '#btnGuardaArtOrdComp', function() {
    if ($('#cboArticulo').val() == 0) {
        $('#cboArticulo').focus();
        $('#reqCboArticulo').html('* Campo requerido');
        return false;
    } else {
        $('#reqCboArticulo').empty();
    }

    if ($('#txtUnidad').val().length < 1) {
        $('#txtUnidad').focus();
        $('#reqTxtUnidad').html('* Campo requerido');
        return false;
    } else {
        $('#reqTxtUnidad').empty();
    }

    if ($('#txtCantidad').val().length < 1) {
        $('#txtCantidad').focus();
        $('#reqTxtCantidad').html('* Campo requerido');
        return false;
    } else {
        $('#reqTxtCantidad').empty();
    }

    if ($('#txtCosto').val().length < 1) {
        $('#txtCosto').focus();
        $('#reqTxtCosto').html('* Campo requerido');
        return false;
    } else {
        $('#reqTxtCosto').empty();
    }

    let formData = new FormData(document.getElementById("frmArtOrdComp"));

    $.ajax({
        beforeSend: function() {
            $("#respServer2").html(guardando);
        },
        url: urlSave,
        type: "post",
        dataType: "json",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(resp) {            
            if (resp.resp == 1) {
                $("#respServer2").empty();
                dispFrmArtOrdComp();
                ordenes_compra_listado(1);
                ordenes_compra_articulos_listado($('#idOrdComp').val(), $('#idObraOrdComp').val(), $('#titleModOrdCompArt').text());
                if ($('#opcion').val() == 218) {
                    $('#opcion').val(217);
                }
            } else {
                $("#respServer").html('Ocurrió un error al intentar guardar en la base de datos');
            }
        }
    });
});

function editarArticulo(idOrdenComp, idArticulo) {
    dispFrmArtOrdComp();
    let params = { 'idOrdenComp': idOrdenComp, 'idArticulo': idArticulo, 'opt': 212 }
    $.ajax({
        type: "post",
        url: urlConsultas1,
        data: params,
        dataType: 'json',
        success: function(resp) {
            $('#respServer2').empty('');
            $('#txtArticulo').val(resp.articulo);
            $('#txtUnidad').val(resp.unidad);
            $('#txtCantidad').val(resp.cantidad);
            $('#txtCosto').val(resp.monto);
            $('#idArticulo').val(resp.id_articulo_compra);
            $('#opcionAC').val(218);
            $('#txtArticulo').select();
        }
    });
}

function eliminarArticulo(id, nombre) {
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
        function() {
            let params = { 'id': id, 'opt': 209 };
            $.ajax({
                type: "post",
                url: urlEliminar1,
                data: params,
                dataType: 'json',
                success: function(resp) {
                    if (resp.resp == 1) {
                        ordenes_compra_articulos_listado($('#idOrdComp').val(), $('#titleModOrdCompArt').text());
                    }
                }
            });
        });
}

$(document).on('click', '#btnCancelarCtpoInt', function(){
    closeCntnFrmInvInt();
    $('#cboArticulo').val(0);
});


//COTIZACIONES DE UNA ORDEN DE COMPRA
function ordenes_compra_cotizaciones_listado(idOrdenComp, folio) {
    $('#titleModOrdCompCotizaion').text(folio);
    $('#idOrdCompCot').val(idOrdenComp);
    urlPag1 = 'pg/orden_compra_cotizaciones_listado.php';
    let params = { 'idOrdenComp': idOrdenComp };

    $.ajax({
        beforeSend: function() {
            $("#cntnListadoCotizaciones").html(cargando);
        },
        type: "post",
        url: urlPag1,
        data: params,
        dataType: 'html',
        success: function(data) {
            $('#cntnListadoCotizaciones').html(data);
            loadDataTable('listadoOrdCompCotizaciones', true);
        }
    });
}


$('#btnNvoCotizOrdComp, #btnCancelaCotizOrdComp').click(function() {
    dispFrmCotizOrdComp();
    $('#cboProveedor').select2();
});

function dispFrmCotizOrdComp() {
    $('#cntnFrmCotizOrdComp').slideToggle();
    $('#btnNvoCotizOrdComp').slideToggle();
    resetForm('frmCotizOrdComp');
    //getCurrentPage();
}

$('#btnGuardaCotizOrdComp').click(function() {
    let cboProveedor = $('#cboProveedor'),
        reqCboProveedor = $('#reqCboProveedor'),
        txtCuenta = $('#txtCuenta'),
        reqTxtCuenta = $('#reqTxtCuenta'),
        txtMonto = $('#txtMonto'),
        reqTxtMonto = $('#reqTxtMonto'),
        respServer3 = $("#respServer3");


    if (cboProveedor.val() == '0') {
        cboProveedor.focus();
        reqCboProveedor.html('* Campo requerido');
        return false;
    } else {
        reqCboProveedor.empty();
    }

    if (txtCuenta.val().length < 1) {
        txtCuenta.focus();
        reqTxtCuenta.html('* Campo requerido');
        return false;
    } else {
        reqTxtCuenta.empty();
    }

    if (txtMonto.val().length < 1) {
        txtMonto.focus();
        reqTxtMonto.html('* Campo requerido');
        return false;
    } else {
        reqTxtMonto.empty();
    }

    let formData = new FormData(document.getElementById("frmCotizOrdComp"));

    $.ajax({
        beforeSend: function() {
            respServer3.html(guardando);
        },
        url: urlSave,
        type: "post",
        dataType: "json",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(resp) {
            respServer3.empty();
            if (resp.resp == 1) {
                ordenes_compra_cotizaciones_listado($('#idOrdCompCot').val(), $('#titleModOrdCompCotizaion').text());
                dispFrmCotizOrdComp();                
                ordenes_compra_listado(1);
                if ($('#opcionCotiz').val() == 220) {
                    $('#opcionCotiz').val(219);
                }
            } else if (resp.resp == 2) {
                respServer3.html('Es necesario cargar el archivo de la cotización');
                return false;
            } else {
                $("#respServer").html('Ocurrió un error al intentar guardar en la base de datos');
            }
        }
    });
});

function editarCotizacion(idOrdenComp, idCotizacion) {
    dispFrmCotizOrdComp();
    let cboProveedor = $('#cboProveedor');
    let params = { 'idOrdenComp': idOrdenComp, 'idCotizacion': idCotizacion, 'opt': 213 }
    $.ajax({
        type: "post",
        url: urlConsultas1,
        data: params,
        dataType: 'json',
        success: function(resp) {
            $('#respServer3').empty('');
            cboProveedor.val(resp.id_proveedor);
            $('#txtCuenta').val(resp.num_cuenta);
            $('#txtMonto').val(resp.monto);
            $('#hdFlImagen').val(resp.archivo);
            $('#txtObservaciones').val(resp.observaciones);
            $('#idCotizacion').val(resp.id_cotizacion);
            $('#opcionCotiz').val(220);
            cboProveedor.focus();
            cboProveedor.select2();
        }
    });
}

function eliminarCotizacion(id, nombre) {
    swal({
            html: true,
            title: "¿Está seguro?",
            text: "eliminar la cotización del proveedor: <strong>" + nombre + "</strong>",
            type: "warning",
            showCancelButton: true,
            cancelButtonClass: "btn-primary",
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Aceptar",
            cancelButtonText: "Cancelar",
            closeOnConfirm: true
        },
        function() {
            let params = { 'id': id, 'opt': 210 };
            $.ajax({
                type: "post",
                url: urlEliminar1,
                data: params,
                dataType: 'json',
                success: function(resp) {
                    if (resp.resp == 1) {
                        ordenes_compra_cotizaciones_listado($('#idOrdCompCot').val(), $('#titleModOrdCompCotizaion').text());
                    }
                }
            });
        });
}

function autorizaCotizacion(idOrdenComp, idCotizacion, idProveedor) {
    let params = { 'idOrdenComp': idOrdenComp, 'idCotizacion': idCotizacion, 'idProveedor':idProveedor, 'opcion': 221 };
    $.ajax({
        type: "post",
        url: urlSave,
        data: params,
        dataType: 'json',
        success: function(resp) {
            if (resp.resp == 1) {
                ordenes_compra_cotizaciones_listado($('#idOrdCompCot').val(), $('#titleModOrdCompCotizaion').text());
                if (resp.estatusOrdComp == 1) {
                    ordenes_compra_listado(1);
                }
            }
        }
    });
}



//APARTADO PARA CARGAR LOS ARCHIVOS DE TRANSFERENCIA Y FACTURA DE UNA UNA ORDEN DE COMPRA AUTORIZADA
function mdlTransferFile(idOrdenComp, folio) {
    $('#titleModFileTransf').text(folio);
    $('#idOrdComp4, #idOrdComp5').val(idOrdenComp);
}

$('#btnLoadFiles').click(function() {
    let iconAdd = $('#iconAdd');
    $('#cntnFrmLoadFilesOrdComp').slideToggle(500, "swing", function() {
        if (iconAdd.hasClass('fa fa-plus')) {
            iconAdd.removeClass('fa-plus');
            iconAdd.addClass('fa-minus');
        } else {
            iconAdd.removeClass('fa-minus');
            iconAdd.addClass('fa-plus');
        }
    });
});

//EVENTO PARA CARGAR EL ARCHIVO DE TRANSFERENCIA
function loadFileTransfer() {
    let respServer4 = $("#respServer4");
    let formData = new FormData(document.getElementById("frmLoadFilesTransfOrdComp"));

    $.ajax({
        beforeSend: function() {
            respServer4.html(guardando);
        },
        url: urlSave,
        type: "post",
        dataType: "json",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(resp) {
            //console.log(resp);
            respServer4.empty();
            if (resp.resp == 1) {
                respServer4.html('Se cargo correctamente el archivo de  transferencia');
            } else if (resp.resp == 2) {
                respServer4.html('Es necesario cargar el archivo de la transferencia');
                return false;
            } else {
                respServer4.html('Ocurrió un error al intentar guardar en la base de datos');
            }
        }
    });
}


//EVENTO PARA CARGAR EL ARCHIVO DE TRANSFERENCIA
function loadFileTransfer(){
  let formData = new FormData(document.getElementById("frmLoadFilesTransfOrdComp"));

    $.ajax({
      beforeSend: function(){
        $("#respServer4").html(guardando);
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
          $("#respServer4").empty();
          if(resp.resp == 1){
            ordenes_compra_listado(1);
            $('#flTransferencia').prop('disabled', true);
            $("#respServer4").html('Archivo de transferencia cargado correctamente');
          }else if(resp.resp == 2){
              $("#respServer4").html('Es necesario cargar el archivo de la transferencia');
              return false;
          }else{
            $("#respServer4").html('Ocurrió un error al intentar guardar en la base de datos');
          }
      }
    });
}

//EVENTO PARA CARGAR EL ARCHIVO DE FACTURA
function loadFileFactura() {
    let respServer4 = $("#respServer4");
    let formData = new FormData(document.getElementById("frmLoadFilesFactOrdComp"));

    $.ajax({
        beforeSend: function() {
            respServer4.html(guardando);
        },
        url: urlSave,
        type: "post",
        dataType: "json",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(resp) {
            //console.log(resp);
            respServer4.empty();
            if (resp.resp == 1) {
                ordenes_compra_listado(1);
                respServer4.html('Aarchivo de factura cargado correctamente');
            } else if (resp.resp == 2) {
                respServer4.html('Es necesario cargar el archivo de la transferencia');
                return false;
            } else {
                respServer4.html('Ocurrió un error al intentar guardar en la base de datos');
            }
        }
    });
}




//SERVICIO POSVENTA
function servicioPosVentaDown(idInteres) {
    $('#cntnMtto' + idInteres).slideDown();
    servicio_posventa_listado(idInteres);
}

function servicioPosVentaUp(idInteres) {
    $('#cntnMtto' + idInteres).slideUp();
}

function servicio_posventa_listado(idInteres) {
    urlPag1 = 'pg/servicio_posventa_listado.php';
    let params = { 'idInteres': idInteres },
        cntnListServPV = $("#cntnListServPV" + idInteres);

    $.ajax({
        beforeSend: function() {
            cntnListServPV.html(cargando);
        },
        type: "post",
        url: urlPag1,
        data: params,
        dataType: 'html',
        success: function(data) {
            cntnListServPV.html(data);
            loadDataTable('listadoServPV' + idInteres, true);
        }
    });
}


function dispFrmServPV(idInteres) {
    $('#cntFrmServPV' + idInteres).slideToggle();
    $('#btnNvoServPV' + idInteres).slideToggle();
    resetForm('frnServPv' + idInteres);
    $('#txtFolioPV' + idInteres).focus();
    $('#opcionServPV' + idInteres).val(222);
}


function guardaServPV(idInteres) {
    let txtFolioPV = $('#txtFolioPV' + idInteres),
        reqTxtFolioPV = $('#reqTxtFolioPV' + idInteres),
        txtFechaPV = $('#txtFechaPV' + idInteres),
        reqTxtFechaPV = $('#reqTxtFechaPV' + idInteres),
        cboMotivoPV = $('#cboMotivoPV' + idInteres),
        reqCboMotivoPV = $('#reqCboMotivoPV' + idInteres),
        respServ = $("#respServ" + idInteres),
        opcionServPV = $('#opcionServPV' + idInteres);

    if (txtFolioPV.val().length < 1) {
        txtFolioPV.focus();
        reqTxtFolioPV.html(requireField);
        return false;
    } else {
        reqTxtFolioPV.empty();
    }

    if (txtFechaPV.val().length < 1) {
        txtFechaPV.focus();
        reqTxtFechaPV.html(requireField);
        return false;
    } else {
        reqTxtFechaPV.empty();
    }

    if (cboMotivoPV.val() == 0) {
        cboMotivoPV.focus();
        reqCboMotivoPV.html('* Campo requerido');
        return false;
    } else {
        reqCboMotivoPV.empty();
    }

    let formData = new FormData(document.getElementById("frnServPv" + idInteres));

    $.ajax({
        beforeSend: function() {
            respServ.html(guardando);
        },
        url: urlSave,
        type: "post",
        dataType: "json",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(resp) {
            respServ.empty();
            if (resp.resp == 1) {
                servicio_posventa_listado(idInteres);
                dispFrmServPV(idInteres);
                if (opcionServPV.val() == 223) {
                    opcionServPV.val(222);
                }
            } else {
                respServ.html('Ocurrió un error al intentar guardar en la base de datos');
            }
        }
    });
};


function editarServPV(idInteres, idServPV) {
    dispFrmServPV(idInteres);
    let params = { 'idInteres': idInteres, 'idServPV': idServPV, 'opt': 214 };
    $.ajax({
        type: "post",
        url: urlConsultas1,
        data: params,
        dataType: 'json',
        success: function(resp) {
            $('#respServ' + idInteres).empty('');
            $('#idServPV' + idInteres).val(resp.id_servicio_posventa);
            $('#txtFolioPV' + idInteres).val(resp.folio);
            $('#txtFechaPV' + idInteres).val(resp.fecha_captura);
            $('#cboMotivoPV' + idInteres).val(resp.motivo);
            $('#txtDescripcion' + idInteres).val(resp.descripcion);
            $('#cboEstatus' + idInteres).val(resp.estatus);
            $('#txtFechaTerminoPV' + idInteres).val(resp.fecha_termino);
            $('#opcionServPV' + idInteres).val(223);
            $('#txtFolioPV' + idInteres).focus();
        }
    });
}


function eliminarServPV(idInteres, idServPV, folio) {
    swal({
            html: true,
            title: "¿Está seguro?",
            text: "eliminar el servicio posventa con folio: <strong>" + folio + "</strong>",
            type: "warning",
            showCancelButton: true,
            cancelButtonClass: "btn-primary",
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Aceptar",
            cancelButtonText: "Cancelar",
            closeOnConfirm: true
        },
        function() {
            let params = { 'id': idServPV, 'opt': 211 };
            $.ajax({
                type: "post",
                url: urlEliminar1,
                data: params,
                dataType: 'json',
                success: function(resp) {
                    if (resp.resp == 1) {
                        servicio_posventa_listado(idInteres);
                    }
                }
            });
        });
}



//MAQUINARIA Y EQUIPO
//CATÁLOGO DE TIPO DE MAQUINARIA
function listadoTipoMaquinaria(){
    let cntn = $('#cntnListTipoMaquinaria');
    urlPag = 'pg/tipo_maquinaria_listado.php';

    $.ajax({
        type: "post",
        url: urlPag,
        dataType: "html",
        beforeSend: function(){
            cntn.html(cargando);
        },
        success: function (r) {
            cntn.html(r);
            loadDataTable('listTipoMaquinaria', true, currentPage);
        }
    });
}

$('#idBtnGuardaTMaq').on('click', function(){
    let txtNombre     = $('#txtNombre'),
        reqTxtNombre  = $('#reqTxtNombre'),
        respServer    = $('#respServer');

    if (txtNombre.val().length < 1) {
        txtNombre.focus();
        reqTxtNombre.html(requireField);
        return false;
    } else {
        reqTxtNombre.empty('');
    }

    let formData = new FormData(document.getElementById("frmTMaquinaria"));

    $.ajax({
        url: urlSave,
        type: "post",
        dataType: "json",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function(){
            respServer.html(guardando);
        },
        success: function (r){            
            if (r.resp == 1) {
                respServer.html('¡El registro se guardó correctamente!');
                listadoTipoMaquinaria();
                resetFrmTipMaq();
            } else {
                respServer.html('¡Ocurrió un ERROR al intentar guardar el registro!');
            }
        }
    });
});

function editarTipoMaq(id){
    let params = {'id':id, 'opt':226}

    $.ajax({
        type: "post",
        url: urlConsultas1,
        data: params,
        dataType: "json",
        success: function (r) {
            $('#txtNombre').val(r.nombre);
            $('#idTMaquinaria').val(r.id_tipo_maquinaria);
            $('#opcion').val(233);
            getCurrentPage();
        }
    });
}

function eliminarTipoMaq(id, nombre) {
    swal({
            html: true,
            title: "¿Está seguro?",
            text: "eliminar el tipo de maquinaria: <br><strong>" + nombre + "</strong>",
            type: "warning",
            showCancelButton: true,
            cancelButtonClass: "btn-primary",
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Aceptar",
            cancelButtonText: "Cancelar",
            closeOnConfirm: true
        },
        function() {
            let params = {'id':id, 'opt':215};
            $.ajax({
                type: "post",
                url: urlEliminar1,
                data: params,
                dataType: 'json',
                success: function(r) {
                    if (r.resp == 1) {
                        listadoTipoMaquinaria();
                    }
                }
            });
        });
}

$('#idBtnCancelarTMaq').on('click', function(){
    resetFrmTipMaq();
});

function resetFrmTipMaq(){
    resetForm('frmTMaquinaria');
    $('#opcion').val(232);
}

//CATÁLOGO DE MAQUINARIA Y VEHÍCULOS
$('#btnBusqMaquinaria').on('click', function(){
    let cntnBusqMaquinaria = $('#cntnBusqMaquinaria');
    if (cntnBusqMaquinaria.is(':visible')) {
        cntnBusqMaquinaria.slideUp();
    } else {
        cntnBusqMaquinaria.slideDown();
        resetFrmBusquedaMaquinaria();
    }
});

$('input').on('ifChecked', function(){
    let txtBusqueda = $('#txtBusqueda'),
        optSelected = parseInt($('input:radio[name=filterBusq]:checked').val()),
        leyenda = '';

    switch (optSelected) {
        case 1:
            leyenda = 'Ingresar la marca...';
        break;

        case 2:
            leyenda = 'Ingresar el número económico...';
        break;

        case 3:
            leyenda = 'Ingresar número de serie...';
        break;

        case 4:
            leyenda = 'Ingresar número de placa...';
        break;
    }
    txtBusqueda.val('')
               .attr('placeholder', leyenda)
               .focus();
});

$("#txtBusqueda").on('keypress', function(e) {
    if (e.which == 13) {
        maquinaria_listado(1);
    }
});

$('#cboCategBusq, #cboTipoBusq').on('change', function(){
    maquinaria_listado(1);
});

$('#btnResetBusqOrdComp').on('click', function(){
    resetFrmBusquedaMaquinaria();
    maquinaria_listado(1);
});

function resetFrmBusquedaMaquinaria(){
    let txtBusqueda = $('#txtBusqueda');
    txtBusqueda.val('')
               .attr('placeholder', 'Ingresar la marca')
               .focus();
    $('#cboCategBusq, #cboTipoBusq').val(0);
    $('#rdoMarca').iCheck('check');
}

function maquinaria_listado(pagina) {
    let cntnListMaquinaria = $('#cntnListMaquinaria'),
        urlPag      = 'pg/maquinaria_vehiculos_listado.php',
        optSelected = parseInt($('input:radio[name=filterBusq]:checked').val()),
        params      = {'pagina':pagina, 'optSelected':optSelected, 'busqueda':$('#txtBusqueda').val(), 'idCateg':$('#cboCategBusq').val(), 'tipoMaquinaria':$('#cboTipoBusq').val()};

        $.ajax({
            type: "post",
            url: urlPag,
            data: params,
            dataType: "html",
            beforeSend: function() {
                cntnListMaquinaria.html(cargando);
            },
            success: function(response) {
                cntnListMaquinaria.html(response);
            }
        });
}

function verMas(id){
    let cntnVerMas = $('#cntnVerMas' + id),
        txtVerMas  = $('#txtVerMas' + id);
        txt       = '';

    if (cntnVerMas.is(':visible')) {
        cntnVerMas.slideUp();
        txt = 'Ver más...';
    } else {
        cntnVerMas.slideDown();        
        txt = 'Ver menos...';
    }
    txtVerMas.text(txt);
}

$('#btnNvaMaquinaria, #btnCancelarMaquinaria').on('click', function(){
    dispFrmMaquinaria('Nueva maquinaria/Vehículo');
});

function dispFrmMaquinaria(leyenda){
    let cntFrmNvaMaq = $('#cntnFrmMaquinaria'),
        txtLeyenda   = $('#txtTitleFrmMaquinaria');              

    resetForm('frmMaquinaria');

    if (cntFrmNvaMaq.is(':visible')) {
        cntFrmNvaMaq.slideUp();
    } else {
        cntFrmNvaMaq.slideDown();
        txtLeyenda.text(leyenda);        
        $('#opcion').val(230);
        $('#cboTipo').select2();
    }
}

$('#btnGuardarMaquinaria').on('click', function(){
    let cboCategoria       = $('#cboCategoria'),
        reqCboCategoria    = $('#reqCboCategoria')
        txtMarca           = $('#txtMarca') ,
        reqTxtMarca        = $('#reqTxtMarca'),
        txtModelo          = $('#txtModelo'  ),
        reqTxtModelo       = $('#reqTxtModelo'),
        cboTipo            = $('#cboTipo'),
        reqCboTipo         = $('#reqCboTipo'),
        txtNumEconomico    = $('#txtNumEconomico'),
        reqTxtNumEconomico = $("#reqTxtNumEconomico"),
        txtNumSerie        = $('#txtNumSerie'),
        reqTxtNumSerie     = $('#reqTxtNumSerie'),
        txtPlacas          = $('#txtPlacas'),
        reqTxtPlacas       = $('#reqTxtPlacas'),
        respServ           = $('#respServer'),
        opcion             = $('#opcion');

    if (cboCategoria.val() == 0) {
        cboCategoria.focus();
        reqCboCategoria.html(requireField);
        return false;
    } else {
        reqCboCategoria.empty();
    }

    if (txtMarca.val().length < 1) {
        txtMarca.focus();
        reqTxtMarca.html(requireField);
        return false;
    } else {
        reqTxtMarca.empty();
    }

    if (txtModelo.val().length < 1) {
        txtModelo.focus();
        reqTxtModelo.html(requireField);
        return false;
    } else {
        reqTxtModelo.empty();
    }

    if (cboTipo.val() == 0) {
        cboTipo.focus();
        reqCboTipo.html('* Campo requerido');
        return false;
    } else {
        reqCboTipo.empty();
    }

    if (txtNumEconomico.val().length < 1) {
        txtNumEconomico.focus();
        reqTxtNumEconomico.html(requireField);
        return false;
    } else {
        reqTxtNumEconomico.empty();
    }

    if (txtNumSerie.val().length < 1) {
        txtNumSerie.focus();
        reqTxtNumSerie.html(requireField);
        return false;
    } else {
        reqTxtNumSerie.empty();
    }

    if (txtPlacas.val().length < 1) {
        txtPlacas.focus();
        reqTxtPlacas.html(requireField);
        return false;
    } else {
        reqTxtPlacas.empty();
    }

    let formData = new FormData(document.getElementById("frmMaquinaria"));

    $.ajax({
        url: urlSave,
        type: "post",
        dataType: "json",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() {
            respServ.html(guardando);
        },
        success: function(resp) {
            respServ.empty();
            if (resp.resp == 1) {
                maquinaria_listado(1);
                dispFrmMaquinaria('');
                if (opcion.val() == 231) {
                    opcion.val(230);
                }
            } else {
                respServ.html('Ocurrió un error al intentar guardar en la base de datos');
            }
        }
    });
});

function editarMaquinaria(id){
    dispFrmMaquinaria('Editar vehículo');
    let params = {'id':id, 'opt':225};

    $.ajax({
        type: "post",
        url: urlConsultas1,
        data: params,
        dataType: "json",
        success: function (r) {            
            $('#cboCategoria').val(r.id_categoria);
            $('#txtMarca').val(r.marca);
            $('#txtModelo').val(r.modelo);
            $('#cboTipo').val(r.id_tipo_maquinaria);
            $('#txtNumEconomico').val(r.numero_economico);
            $('#txtNumSerie').val(r.numero_serie);
            $('#txtPlacas').val(r.placas);
            $('#txtPeso').val(r.peso);
            $('#hdFlSeguro').val(r.archivo_seguro);
            $('#hdFlFactura').val(r.archivo_factura);
            $('#idMaquinaria').val(r.id_maquinaria_vehiculo);
            $('#cboTipo').select2();
            $('#opcion').val(231);
        }
    });
}

function modificaKilometraje(id, kms){
    $('#txtKilometraje').focus().val(kms);
    $('#idMaqVehKms').val(id);
}

$('#btnGuardaKms').on('click', guardaKilometraje);

function guardaKilometraje(){
    let kms      = $('#txtKilometraje'),
        reqTxtKilometraje = $('#reqTxtKilometraje'),
        params   = {'id':$('#idMaqVehKms').val(), 'kms':kms.val(), 'opcion':242},
        respServ = $('#respServer3');

    if(kms.val().length < 1){
        kms.focus();
        reqTxtKilometraje.html(requireField);
        return false;
    }else{
        reqTxtKilometraje.empty('');
    }

    $.ajax({
        url: urlSave,
        type: "post",
        dataType: "json",
        data: params,
        beforeSend: function() {
            respServ.html(guardando);
        },
        success: function(resp) {
            //console.log(resp);
            respServ.empty();
            if (resp.resp == 1) {
                maquinaria_listado(1);
            } else {
                respServ.html('Ocurrió un error al intentar guardar en la base de datos');
            }
        }
    });
}

function eliminarMaquinaria(id, maquinaria) {
    swal({
            html: true,
            title: "¿Está seguro?",
            text: "eliminar la maquinaria: <br><strong>" + maquinaria + "</strong>",
            type: "warning",
            showCancelButton: true,
            cancelButtonClass: "btn-primary",
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Aceptar",
            cancelButtonText: "Cancelar",
            closeOnConfirm: true
        },
        function() {
            let params = {'id':id, 'opt':214};
            $.ajax({
                type: "post",
                url: urlEliminar1,
                data: params,
                dataType: 'json',
                success: function(resp) {                    
                    if (resp.resp == 1) {
                        maquinaria_listado(1);
                    }
                }
            });
        });
}


//SUBMÓDULO DE RESGUARDOS --------------------------------
$('#btnBusqMaqResguardo').on('click', function(){
    let cntnBusqMaqResguardo = $('#cntnBusqMaqResguardo');
    resetFrmBusqResg();

    if (cntnBusqMaqResguardo.is(':visible')) {
        cntnBusqMaqResguardo.slideUp();
    } else {
        cntnBusqMaqResguardo.slideDown();        
        $('#txtBusqueda').focus();        
    }
});

$('input:radio[name=filterResgBusq]').on('ifChecked', function(){
    let txtBusqueda = $('#txtBusqueda'),
        optSelected = parseInt($('input:radio[name=filterResgBusq]:checked').val()),
        leyenda     = '';

    switch (optSelected) {
        case 1:
            leyenda = 'Ingrese la marca y/o modelo del vehículo...';
        break;

        case 2:
            leyenda = 'Ingrese el nombre del usuario...';
        break;
    }
    txtBusqueda.val('')
               .attr('placeholder', leyenda)
               .focus();
});

$("#txtBusqueda").on('keypress', function(e) {
    if (e.which == 13) {
        vehiculosResguardos_listado(1);
    }
});

$('#txtFechaIni, #txtFechaFin, #cboEstatusBusq').on('change', function(){
    vehiculosResguardos_listado(1);
});

$('#btnResetBusqResg').on('click', function(){
    resetFrmBusqResg();
    vehiculosResguardos_listado(1);
});

function resetFrmBusqResg(){
    $('#txtBusqueda, #txtFechaIni, #txtFechaFin').val('');
    $('#cboEstatusBusq').val(-1);
}

function vehiculosResguardos_listado(pagina) {  
    let cntnListResg = $('#cntnListResguardos');
        urlPag       = 'pg/vehiculos_resguardo_listado.php',
        opt          = parseInt($('input:radio[name=filterResgBusq]:checked').val()),
        params       = {'opt':opt, 'busqueda':$('#txtBusqueda').val(), 'fechaIni':$('#txtFechaIni').val(), 'fechaFin':$('#txtFechaFin').val(), 'estatus':$('#cboEstatusBusq').val(), 'pagina':pagina};
        
        $.ajax({
            type: "post",
            url: urlPag,
            data: params,
            dataType: "html",
            beforeSend: function() {
                cntnListResg.html(cargando);
            },
            success: function(response) {                
                cntnListResg.html(response);
            }
        });
}

$(document).on('click', '#btnNvoMaqResguardo, #btnCancelarResgVehiculo', function(){
    dispFrmResgVehiculo('Nuevo Resguardo');
});

function dispFrmResgVehiculo(leyenda){
    let cntnFrmMaqResguardo = $('#cntnFrmMaqResguardo'),
        txtLeyenda   = $('#txtTitleFrmMaqResg');
    
    $('.minimal').iCheck('uncheck');
    resetForm('frmMaqResguardo');

    if (cntnFrmMaqResguardo.is(':visible')) {
        cntnFrmMaqResguardo.slideUp();
    } else {
        cntnFrmMaqResguardo.slideDown();
        txtLeyenda.text(leyenda);
        $('#txtUsuario').focus();
        $('#opcion').val(234);
    }
}


$('#btnGuardarResgVehiculo').on('click', function(){
    let txtUsuario           = $('#txtUsuario') ,
        reqTxtUsuario        = $('#reqTxtUsuario'),
        cboVehiculo          = $('#cboVehiculo'  ),
        reqCboVehiculo       = $('#reqCboVehiculo'),
        txtFechaResguardo    = $('#txtFechaResguardo'),
        reqTxtFechaResguardo = $('#reqTxtFechaResguardo'),
        cboNeumaticosEnt     = $('#cboNeumaticosEnt'),
        reqCboNeumaticosEnt  = $("#reqCboNeumaticosEnt"),
        cboCristalesEnt      = $('#cboCristalesEnt'),
        reqCboCristalesEnt   = $('#reqCboCristalesEnt'),
        cboCarroceriaEnt     = $('#cboCarroceriaEnt'),
        reqCboCarroceriaEnt  = $('#reqCboCarroceriaEnt'),
        respServ             = $('#respServer'),
        opcion               = $('#opcion');


    if (txtUsuario.val().length < 1) {
        txtUsuario.focus();
        reqTxtUsuario.html(requireField);
        return false;
    } else {
        reqTxtUsuario.empty();
    }

    if (cboVehiculo.val() == 0) {
        cboVehiculo.focus();
        reqCboVehiculo.html(requireField);
        return false;
    } else {
        reqCboVehiculo.empty();
    }

    if (txtFechaResguardo.val().lengthreqTxtFechaResguardo < 1) {
        txtFechaResguardo.focus();
        reqTxtFechaResguardo.html('* Campo requerido');
        return false;
    } else {
        reqTxtFechaResguardo.empty();
    }

    if (cboNeumaticosEnt.val() == 0) {
        cboNeumaticosEnt.focus();
        reqCboNeumaticosEnt.html(requireField);
        return false;
    } else {
        reqCboNeumaticosEnt.empty();
    }

    if (cboCristalesEnt.val() == 0) {
        cboCristalesEnt.focus();
        reqCboCristalesEnt.html(requireField);
        return false;
    } else {
        reqCboCristalesEnt.empty();
    }

    if (cboCarroceriaEnt.val() == 0) {
        cboCarroceriaEnt.focus();
        reqCboCarroceriaEnt.html(requireField);
        return false;
    } else {
        reqCboCarroceriaEnt.empty();
    }

    let formData = new FormData(document.getElementById("frmMaqResguardo"));

    $.ajax({
        url: urlSave,
        type: "post",
        dataType: "json",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() {
            respServ.html(guardando);
        },
        success: function(resp) {
            //console.log(resp);          
            respServ.empty();
            if (resp.resp == 1) {
                vehiculosResguardos_listado(1);
                dispFrmResgVehiculo('');
                if (opcion.val() == 235) {
                    opcion.val(234);
                }
            } else {
                respServ.html('Ocurrió un error al intentar guardar en la base de datos');
            }
        }
    });
});

function editarResgVehiculo(id){
    dispFrmResgVehiculo('Editar Resguardo');
    let params = {'id':id, 'opt':227};

    $.ajax({
        type: "post",
        url: urlConsultas1,
        data: params,
        dataType: "json",
        success: function (r) {            
            $('#idResgVehiculo').val(r.id_resguardo);
            $('#txtUsuario').val(r.usuario);
            $('#cboVehiculo').val(r.id_maquinaria).select2();
            $('#hdCboVehiculo').val(r.id_maquinaria);
            $('#txtFechaResguardo').val(r.fecha_asignacion);
            $('#idMaquinaria').val(r.id_maquinaria_vehiculo);
            $('#cboNeumaticosEnt').val(r.neumaticos_entrega);
            $('#cboCristalesEnt').val(r.cristales_entrega);
            $('#cboCarroceriaEnt').val(r.carroceria_entrega);
            $('#cboNeumaticosRecib').val(r.neumaticos_recibe);
            $('#cboCristalesRecib').val(r.cristales_recibe);
            $('#cboCarroceriaRecib').val(r.carroceria_recibe);
            let poliza  = (r.poliza == 1)? 'check':'uncheck',
                tarjeta = (r.tarjeta_circulacion == 1)? 'check':'uncheck',
                factura = (r.factura == 1)?'check':'uncheck';
            $('#cbxSeguro').iCheck(poliza);
            $('#cbxTarjeta').iCheck(tarjeta);
            $('#cbxFactura').iCheck(factura);
            $('#txtObservaciones').val(r.observaciones);
            $('#opcion').val(235);
        }
    });
}

function concluirResgVehiculo(id){
    let params = {'id':id, 'opcion':241};

    $.ajax({
        type: "post",
        url: urlSave,
        data: params,
        dataType: "json",
        success: function (r) {
            //console.log(r);
            if(r.resp == 1){
                vehiculosResguardos_listado(1);
            }
        }
    });
}

function eliminarResgVehiculo(id, nombre) {
    swal({
            html: true,
            title: "¿Está seguro?",
            text: "eliminar resguardo del usuario: <br><strong>" + nombre + "</strong>",
            type: "warning",
            showCancelButton: true,
            cancelButtonClass: "btn-primary",
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Aceptar",
            cancelButtonText: "Cancelar",
            closeOnConfirm: true
        },
        function() {
            let params = {'id':id, 'opt':216};
            $.ajax({
                type: "post",
                url: urlEliminar1,
                data: params,
                dataType: 'json',
                success: function(resp) {
                    if (resp.resp == 1) {
                        vehiculosResguardos_listado(1);
                    }
                }
            });
        });
}

//CATÁLOGO DE TIPO DE MANTENIMIENTO
function listadoTipoMtto(){
    let cntn = $('#cntnListTipoMtto');
    urlPag = 'pg/tipo_mtto_listado.php';

    $.ajax({
        type: "post",
        url: urlPag,
        dataType: "html",
        beforeSend: function(){
            cntn.html(cargando);
        },
        success: function (r) {
            cntn.html(r);
            loadDataTable('listTipoMtto', true, currentPage, 'DESC', 2);
        }
    });
}

$('#idBtnGuardaTMtto').on('click', function(){
    let txtNombre         = $('#txtNombre'),
        reqTxtNombre      = $('#reqTxtNombre'),
        txtKilometraje    = $('#txtKilometraje'),
        reqTxtKilometraje = $('#reqTxtKilometraje'),
        txtDiasEspera     = $('#txtDiasEspera'),
        reqTxtDiasEspera  = $('#reqTxtDiasEspera'),
        respServer        = $('#respServer');

    if (txtNombre.val().length < 1) {
        txtNombre.focus();
        reqTxtNombre.html(requireField);
        return false;
    } else {
        reqTxtNombre.empty('');
    }

    /* if (txtKilometraje.val().length < 1) {
        txtKilometraje.focus();
        reqTxtKilometraje.html(requireField);
        return false;
    } else {
        reqTxtKilometraje.empty('');
    }

    if (txtDiasEspera.val().length < 1) {
        txtDiasEspera.focus();
        reqTxtDiasEspera.html(requireField);
        return false;
    } else {
        reqTxtDiasEspera.empty('');
    } */

    let formData = new FormData(document.getElementById("frmTMtto"));

    $.ajax({
        url: urlSave,
        type: "post",
        dataType: "json",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function(){
            respServer.html(guardando);
        },
        success: function (r){                               
            if (r.resp == 1) {
                respServer.html('¡El registro se guardó correctamente!');
                listadoTipoMtto();
                resetFrmTipMtto();
            } else {
                respServer.html('¡Ocurrió un ERROR al intentar guardar el registro!');
            }
        }
    });
});

function editarTipoMtto(id){
    let params = {'id':id, 'opt':228}

    $.ajax({
        type: "post",
        url: urlConsultas1,
        data: params,
        dataType: "json",
        success: function (r) {
            $('#txtNombre').val(r.nombre).focus();
            $('#txtDiasEspera').val(r.dias_espera);
            $('#txtKilometraje').val(r.kilometraje);
            $('#txtDescripcion').val(r.descripcion);
            $('#idTipMtto').val(r.id_tipo_mtto);
            $('#opcion').val(237);
            getCurrentPage();
        }
    });
}

function eliminarTipoMtto(id, nombre) {
    swal({
            html: true,
            title: "¿Está seguro?",
            text: "eliminar el tipo de mantenimiento: <br><strong>" + nombre + "</strong>",
            type: "warning",
            showCancelButton: true,
            cancelButtonClass: "btn-primary",
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Aceptar",
            cancelButtonText: "Cancelar",
            closeOnConfirm: true
        },
        function() {
            let params = {'id':id, 'opt':217};
            $.ajax({
                type: "post",
                url: urlEliminar1,
                data: params,
                dataType: 'json',
                success: function(r) {
                    if (r.resp == 1) {
                        listadoTipoMtto();
                    }
                }
            });
        });
}

$('#idBtnCancelarTMtto').on('click', function(){
    resetFrmTipMtto();
});

function resetFrmTipMtto(){
    resetForm('frmTMtto');
    $('#opcion').val(236);
}

//CATÁLOGO DE REFACCIONES PARA EM MTTO DE MAQUINARIA/VEHÍCULO
function listadoRefacciones(){
    let cntn = $('#cntnListTipoMtto');
    urlPag = 'pg/refaccion_mtto_listado.php';

    $.ajax({
        type: "post",
        url: urlPag,
        dataType: "html",
        beforeSend: function(){
            cntn.html(cargando);
        },
        success: function (r) {
            cntn.html(r);
            loadDataTable('listRefaccionesMtto', true, currentPage);
        }
    });
}

$('#idBtnGuardaRefaccion').on('click', function(){
    let txtNombre    = $('#txtNombre'),
        reqTxtNombre = $('#reqTxtNombre'),
        respServer   = $('#respServer'),
        params = {'txtNombre':txtNombre.val(), 'id':$('#idRefaccion').val(), 'opcion':$('#opcion').val()};

    if (txtNombre.val().length < 1) {
        txtNombre.focus();
        reqTxtNombre.html(requireField);
        return false;
    } else {
        reqTxtNombre.empty('');
    }

    $.ajax({
        type: "post",
        url: urlSave,
        data: params,
        dataType: "json",
        beforeSend: function(){
            respServer.html(guardando);
        },
        success: function (r) {            
            if (r.resp == 1) {
                respServer.empty('');
                listadoRefacciones();
                resetForm('frmTMtto');
            } else {
                respServer.html('Ocurrió un Error al intentar guardar');
            }
        }
    });
});

function editarRefaccionMtto(id){
    let params = {'id':id, 'opt':231}

    $.ajax({
        type: "post",
        url: urlConsultas1,
        data: params,
        dataType: "json",
        success: function (r) {
            $('#idRefaccion').val(r.id_refaccion);
            $('#txtNombre').val(r.nombre).focus();            
            $('#opcion').val(246);
            getCurrentPage();
        }
    });
}

function eliminarRefaccionMtto(id, nombre) {
    swal({
            html: true,
            title: "¿Está seguro?",
            text: "eliminar la Refacción: <br><strong>" + nombre + "</strong>",
            type: "warning",
            showCancelButton: true,
            cancelButtonClass: "btn-primary",
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Aceptar",
            cancelButtonText: "Cancelar",
            closeOnConfirm: true
        },
        function() {
            let params = {'id':id, 'opt':221};
            $.ajax({
                type: "post",
                url: urlEliminar1,
                data: params,
                dataType: 'json',
                success: function(r) {
                    if (r.resp == 1) {
                        listadoRefacciones();
                    }
                }
            });
        });
}

$('#idBtnCancelarRefaccion').on('click', function(){
    resetForm('frmTMtto');
    $('#opcion').val(245);
});


//MÓDULO DE MANTENIMIENTO
function maquinaria_mtto_listado(pagina){
    let cntn   = $('#cntnListMttoVehiculo'),
        params = {'pagina':pagina};
        urlPag = 'pg/maquinaria_mtto_listado.php';

    $.ajax({
        type: "post",
        url: urlPag,
        data: params,
        dataType: "html",
        beforeSend: function(){
            cntn.html(cargando);
        },
        success: function (r) {
            cntn.html(r);            
        }
    });
}

$(document).on('click', '#btnNvoMttoVehiculo, #btnCancelarMttoVehiculo', function(){
    dispFrmMttoMaq('Nuevo Mantenimiento');
    if($(this).attr("id") == 'btnCancelarMttoVehiculo'){
        $('#cntnServiceData').slideUp();
    }
});

function dispFrmMttoMaq(leyenda){
    let cntnFrmMaqResguardo = $('#cntnFrmMttoVehiculo'),
        txtLeyenda   = $('#txtTitleFrmMttoVehiculo'),
        cboTipoMtoo  = $('#cboTipoMtoo'),
        estCboTipoMtoo;
        
    resetForm('frmMttoVehiculo'); closeAlertDesc();

    if (cntnFrmMaqResguardo.is(':visible')) {
        estCboTipoMtoo = ($('#cboVehiculo option:selected').val() == 0)? true: false;        
        cboTipoMtoo.prop('disabled', estCboTipoMtoo);
        cntnFrmMaqResguardo.slideUp();
    } else {
        cntnFrmMaqResguardo.slideDown();
        txtLeyenda.text(leyenda);
        $('#cboVehiculo').select2();     
        $('#opcion').val(243);
    }
}

function dispDescTMtto(itemSelected, title, descripcion){
    let cntnAlert = $('#descTMtto'),
        alrtTitle = $('#alrtTitle'),
        alrtDescripion = $('#alrtDescripion');

        alrtTitle.empty(''); alrtDescripion.empty('');        
   
        if(parseInt(itemSelected) == 0){            
            cntnAlert.slideUp();
        } else {            
            cntnAlert.slideDown();
            alrtTitle.text(title+': ');
            alrtDescripion.text(descripcion);
        }
}

$(document).on('change', '#cboVehiculo', function(){
    dispServDataFrm($(this));
});

function dispServDataFrm(tElement){
    let val     = tElement.find(':selected').val(),
        catg    = tElement.find(':selected').data('categoria'),
        kms     = tElement.find(':selected').data('kms'),
        cntn    = $('#cntnServiceData'),
        cboTipoMto = $('#cboTipoMtoo'),
        element, defType, leyendaLblInit, leyendaLblFin, valRangInit, valRangFin;
        $('#idCategMaqVeh').val(catg);
    
    switch (parseInt(catg)) {
        case 1:            
            defType = 'text';
            leyendaLblInit = 'Kilometraje Acumulado';
            leyendaLblFin  = 'Próximo Servicio (Kms)';
            valRangInit    = kms;
            break;
        
        case 2:            
            defType = 'date';
            let f   = new Date();    
            leyendaLblInit = 'Último Servicio Realizado';
            leyendaLblFin  = 'Próximo Servicio (Fecha)';
            valRangInit = f.getFullYear() + "-" + (f.getMonth() +1) + "-" + f.getDate();
            break;
        }
    
    if (val > 0) {
        cboTipoMto.attr('disabled', false);
        cntn.slideDown().empty('');
        element = '<div class="col-lg-3">';
            element+= '<div class="form-group">';
                element+= '<label id="lblRangoInit" for="txtRangoInit">' + leyendaLblInit + '</label>';
                element+= '<input type="' + defType + '" id="txtRangoInit" name="txtRangoInit" class="form-control" value="' + valRangInit + '" readonly />';
            element+= '</div>';    
        element+= '</div>';
        element+= '<div class="col-lg-3">';
            element+= '<div class="form-group">';
                element+= '<label id="lblRangoFin" for="txtRangoFin">' + leyendaLblFin + '</label>';
                element+= '<input type="' + defType + '" id="txtRangoFin" name="txtRangoFin" class="form-control" readonly />';
            element+= '</div>';    
        element+= '</div>';

        cntn.html(element);

    } else {
        cboTipoMto.attr('disabled', true);
        cntn.empty('').slideUp();
    }
}

$(document).on('change', '#cboTipoMtoo', function(){
    let cboVehiculo = $('#cboVehiculo'),        
        valSelected = $(this).find(':selected').val(),        
        txtRangoInit= $('#txtRangoInit'),
        txtRangoFin = $('#txtRangoFin'),
        categMaqVeh = parseInt(cboVehiculo.find(':selected').data('categoria')),
        kmsDefMtto  = $(this).find(':selected').data('kms'),
        diasDefMtto = $(this).find(':selected').data('dias'),
        prox_serv;        

        switch (categMaqVeh) {
            case 1:
                prox_serv = parseInt(txtRangoInit.val()) + parseInt(kmsDefMtto);
                break;
        
            case 2:
                prox_serv = addDiasaFecha(diasDefMtto, txtRangoInit.val());
                break;
        }
        
        txtRangoFin.val(prox_serv);        

});
    
$(document).on('change', '#cboTipoMtoo', function(){
    dispDescTMtto($(this).find(':selected').val(), $(this).find(':selected').text(), $(this).find(':selected').data('desc'));
});

    function closeAlertDesc(){
        $('#descTMtto').slideUp();
    }
    
    
$('#btnGuardarMttoVehiculo').on('click', function(){
    let cboVehiculo    = $('#cboVehiculo'),
        reqCboVehiculo = $('#reqTxtNombre'),
        cboTipoMtoo    = $('#cboTipoMtoo'),
        reqCboTipoMtoo = $('#reqCboTipoMtoo'),
        respServer        = $('#respServer');

    if (cboVehiculo.val() == 0) {
        cboVehiculo.focus();
        reqCboVehiculo.html(requireField);
        return false;
    } else {
        reqCboVehiculo.empty('');
    }

    if (cboTipoMtoo.val() == 0) {
        cboTipoMtoo.focus();
        reqCboTipoMtoo.html(requireField);
        return false;
    } else {
        reqCboTipoMtoo.empty('');
    }

    let formData = new FormData(document.getElementById("frmMttoVehiculo"));

    $.ajax({
        url: urlSave,
        type: "post",
        dataType: "json",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function(){
            respServer.html(guardando);
        },
        success: function (r){                            
            if (r.resp == 1) {
                respServer.html('¡El registro se guardó correctamente!');
                dispFrmMttoMaq('Nuevo Mantenimiento');
                maquinaria_mtto_listado(1);
            } else {
                respServer.html('¡Ocurrió un ERROR al intentar guardar el registro!');
            }
        }
    });
});

function editarMttoMaq(id){
    dispFrmMttoMaq('Editar Mantenimiento');
    let params       = {'id':id, 'opt':230},
        cboVehiculo = $('#cboVehiculo'),
        txtRangoInit, txtRangoFin;

    $.ajax({
        type: "post",
        url: urlConsultas1,
        data: params,
        dataType: "json",
        success: function (r) {
            $('#hdVehiculo').val(r.id_maquinaria_vehiculo);
            cboVehiculo.val(r.id_maquinaria_vehiculo).select2();
            $('#cboTipoMtoo').val(r.id_tipo_mantenimiento).prop('disabled', false);
            $('#cboEstatus').val(r.estatus);
            $('#txtFechaMtto').val(r.fecha_mtto);
            $('#txtObservaciones').val(r.observaciones);
            $('#idMttoVehiculo').val(r.id_maquinaria_mantenimiento);
            $('#idCategMaqVeh').val(r.id_categ_MV);
            txtRangoInit = r.txtRangoInit; txtRangoFin = r.txtRangoFin;
            $('#opcion').val(244);
        },
        complete: function(){            
            dispServDataFrm(cboVehiculo);            
            $('#txtRangoFin').val(txtRangoFin);
        }
    });
}

function eliminarMttoMaq(id, nombre) {
    swal({
            html: true,
            title: "¿Está seguro?",
            text: "eliminar el mantenimiento de la Maquinaria/Vehículo: <br><strong>" + nombre + "</strong>",
            type: "warning",
            showCancelButton: true,
            cancelButtonClass: "btn-primary",
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Aceptar",
            cancelButtonText: "Cancelar",
            closeOnConfirm: true
        },
        function() {
            let params = {'id':id, 'opt':220};
            $.ajax({
                type: "post",
                url: urlEliminar1,
                data: params,
                dataType: 'json',
                success: function(r) {                    
                    if (r.resp == 1) {
                        maquinaria_mtto_listado(1);
                    }
                }
            });
        });
}

//DETALLE MANTENIMIENTO
$(document).on('click', '#btnNvoDetalleMtto, #btnCancelaDetalleMtto', function(){
    dispFrmDetalleMtto();
});

function dispFrmDetalleMtto(){
    let cntnFrmDetalleMtto = $('#cntnFrmDetalleMtto');    
    resetForm('frmDetalleMtto'); $('#optSave').val(1);

    if (cntnFrmDetalleMtto.is(':visible')) {
        cntnFrmDetalleMtto.slideUp();
    } else {
        cntnFrmDetalleMtto.slideDown();
        $('#cboRefaccion').focus().select2();
        $('#opcionMttoDetalle').val(247);
    }
}

function datalleMttoListado(idMtto, maquinaria){
    $('#idMtto').val(idMtto);
    $('#titleModDetalleMtto').text(maquinaria);
    let cntn   = $('#cntnListadoDetalleMtto'),
        params = {'idMtto':idMtto};
        urlPag = 'pg/detalle_mtto_listado.php';

    $.ajax({
        type: "post",
        url: urlPag,
        data: params,
        dataType: "html",
        beforeSend: function(){            
            cntn.html(cargando);
        },
        success: function (r) {
            cntn.html(r);
            loadDataTable('listadoDetalleMtto', true);     
        }
    });
}

$(document).on('click', '#btnGuardaDetalleMtto', function(){
    let cboRefaccion    = $('#cboRefaccion'),
        reqCboRefaccion = $('#reqCboRefaccion'),
        txtCosto        = $('#txtCosto'),
        reqTxtCosto     = $('#reqTxtCosto'),
        respServer      = $('#respServer3'),
        formData        = new FormData(document.getElementById("frmDetalleMtto"));

    if (cboRefaccion.val() == 0) {
        reqCboRefaccion.html(requireField);
        return;
    } else {
        reqCboRefaccion.empty('');
    }

    if (txtCosto.val().length < 1) {
        txtCosto.focus();
        reqTxtCosto.html(requireField);
        return;
    } else {
        reqTxtCosto.empty('');
    }

    $.ajax({
        url: urlSave,
        type: "post",
        dataType: "json",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function(){
            respServer.html(guardando);
        },
        success: function(r){                              
            if (r.resp == 1) {
                respServer.html('¡El registro se guardó correctamente!');
                datalleMttoListado($('#idMtto').val(), $('#titleModDetalleMtto').text());
                maquinaria_mtto_listado(1);
                dispFrmDetalleMtto();
            }else{
                respServer.html('¡Ocurrió un ERROR al intentar guardar el registro!');
            }
        }
    });

});

function editarDetalleMtto(idMtto, idDetMtto){
    dispFrmDetalleMtto();
    let params = {'opt':232, idMtto, idDetMtto};

    $.ajax({
        type: "post",
        url: urlConsultas1,
        data: params,
        dataType: "json",
        success: function(r) {
            $('#idDetalleMtto').val(idDetMtto);
            $('#cboRefaccion').val(r.id_refaccion).select2();
            $('#txtCosto').val(r.costo);
            $('#txtObservacionesDet').val(r.observaciones);
            $('#optSave').val(2);
        }
    });
}

function eliminarDetalleMtto(id, nombre) {
    swal({
            html: true,
            title: "¿Está seguro?",
            text: "Eliminar la refacción: <br><strong>" + nombre + "</strong>",
            type: "warning",
            showCancelButton: true,
            cancelButtonClass: "btn-primary",
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Aceptar",
            cancelButtonText: "Cancelar",
            closeOnConfirm: true
        },
        function() {
            let params = {'id':id, 'opt':222};
            $.ajax({
                type: "post",
                url: urlEliminar1,
                data: params,
                dataType: 'json',
                success: function(r) {                    
                    if (r.resp == 1) {
                        datalleMttoListado($('#idMtto').val(), $('#titleModDetalleMtto').text());
                        maquinaria_mtto_listado(1);
                    }
                }
            });
        });
}

//MÓDULO DE ACARREOS ----------------------------------------------------
function acarreos_listado(pagina) {
    let cntnListAcarreo = $('#cntnListAcarreo');
        urlPag       = 'pg/acarreos_listado.php',        
        params       = {'pagina':pagina};
        
        $.ajax({
            type: "post",
            url: urlPag,
            data: params,
            dataType: "html",
            beforeSend: function() {
                cntnListAcarreo.html(cargando);
            },
            success: function(response) {                
                cntnListAcarreo.html(response);
            }
        });
}

$('#btnNvoAcarreo, #btnCancelarAcarreo').on('click', function(){
    dispFrmAcarreo('Nuevo Acarreo');
});

function dispFrmAcarreo(leyenda){
    let cntnFrmAcarreo = $('#cntnFrmAcarreo'),
        txtLeyenda     = $('#txtTitleFrmAcarreo'),
        respServer     = $('respServer');
        
    resetForm('frmAcarreo');

    if (cntnFrmAcarreo.is(':visible')) {
        cntnFrmAcarreo.slideUp();
        respServer.empty('');
    } else {
        cntnFrmAcarreo.slideDown();
        txtLeyenda.text(leyenda);        
        $('#opcion').val(238);
    }
}

$('#cboOrigen').on('change', function(e){
    let cboOrigenOtro = $('#cboOrigenOtro'), estatus;
    estatus = ($(this).find(':selected').val() == 999)? false:true;
    cboOrigenOtro.attr('disabled', estatus).val(0);
});

$('#cboDestino').on('change', function(e){
    let cboDestinoOtro = $('#cboDestinoOtro'), estatus;
    estatus =($(this).find(':selected').val() == 999)? false:true;
    cboDestinoOtro.attr('disabled', estatus).val(0);
});

function calculateCosteTot(){
    let txtTarifaAlimentacion= $('#txtTarifaAlimentacion'),
        txtDiasAlimentacion  = $('#txtDiasAlimentacion'),
        txtTarifaHospedaje   = $('#txtTarifaHospedaje'),
        txtDiasHospedaje     = $('#txtDiasHospedaje'),
        txtGastosAdicionales = $('#txtGastosAdicionales'),
        tA, dA, tH, dH, rA, rH, rGA, rTotal = 0;

    tA = (txtTarifaAlimentacion.val().length > 0)? parseFloat(txtTarifaAlimentacion.val()): 0;
    dA = (txtDiasAlimentacion.val().length > 0)? parseInt(txtDiasAlimentacion.val()): 0;
    rA = tA * dA;
    $('#txtSubtotalAlimentacion').val(number_format(rA, 2));

    tH = (txtTarifaHospedaje.val().length > 0)? parseFloat(txtTarifaHospedaje.val()): 0;
    dH = (txtDiasHospedaje.val().length > 0)? parseInt(txtDiasHospedaje.val()): 0;        
    rH = tH * dH;
    $('#txtSubtotalHospedaje').val(number_format(rH, 2));
    
    rGA = (txtGastosAdicionales.val().length > 0)? parseFloat(txtGastosAdicionales.val()): 0;    
    
    rTotal  = (rA + rH + rGA);
    $('#hdTotal').val(rTotal);
    $('#txtTotal').val(number_format(rTotal, 2));
}

$(document).on('change keyup', '#txtTarifaAlimentacion, #txtDiasAlimentacion, #txtTarifaHospedaje, #txtDiasHospedaje, #txtGastosAdicionales', function() {
    calculateCosteTot();    
});

$('#btnGuardarAcarreo').on('click', function(){
    let cboOrigen             = $('#cboOrigen'),
        reqCboOrigen          = $('#reqCboOrigen'),
        cboOrigenOtro         = $('#cboOrigenOtro'),
        reqCboOrigenOtro      = $('#reqCboOrigenOtro'),
        cboVehiculoTransp     = $('#cboVehiculoTransp'),
        reqCboVehiculoTransp  = $('#reqCboVehiculoTransp'),
        cboDestino            = $('#cboDestino'),
        reqCboDestino         = $('#reqCboDestino'),
        cboDestinoOtro        = $('#cboDestinoOtro'),
        reqCboDestinoOtro     = $('#reqCboDestinoOtro'),
        txtKilometraje        = $('#txtKilometraje'),   
        reqTxtKilometraje     = $('#reqTxtKilometraje'),
        txtCombustible        = $('#txtCombustible'),
        reqTxtCombustible     = $('#reqTxtCombustible'),
        txtFechaMovimiento    = $('#txtFechaMovimiento'),
        reqTxtFechaMovimiento = $('#reqTxtFechaMovimiento'),
        txtFechaLlegada       = $('#txtFechaLlegada'),        
        reqTxtFechaLlegada    = $('#reqTxtFechaLlegada'),
        txtTarifaAlimentacion = $('#txtTarifaAlimentacion'),
        reqTxtTarifaAlimentacion = $('#reqTxtTarifaAlimentacion'),
        txtDiasAlimentacion   = $('#txtDiasAlimentacion'),
        reqtxtDiasAlimentacion= $('#reqtxtDiasAlimentacion'),
        txtTarifaHospedaje    = $('#txtTarifaHospedaje'),
        reqtxtTarifaHospedaje = $('#reqtxtTarifaHospedaje'),
        txtDiasHospedaje      = $('#txtDiasHospedaje'),
        reqtxtDiasHospedaje   = $('#reqtxtDiasHospedaje'),        
        respServer            = $('#respServer');

    if (cboOrigen.val() == 0) {
        cboOrigen.focus();
        reqCboOrigen.html(requireField);
        return false;
    } else {
        reqCboOrigen.empty('');
    }

    if (cboOrigen.val() == 999 && cboOrigenOtro.val() == 0) {
        reqCboOrigenOtro.html(requireField);
        return false;
    }else{
        reqCboOrigenOtro.empty('');
    }

    if (cboDestino.val() == 0) {
        cboDestino.focus();
        reqCboDestino.html(requireField);
        return false;
    } else {
        reqCboDestino.empty('');
    }

    if (cboDestino.val() == 999 && cboDestinoOtro.val() == 0) {
        reqCboDestinoOtro.html(requireField);
        return false;
    }else{
        reqCboDestinoOtro.empty('');
    }

    if (cboVehiculoTransp.val() == 0) {
        cboVehiculoTransp.focus();
        reqCboVehiculoTransp.html(requireField);
        return false;
    } else {
        reqCboVehiculoTransp.empty('');
    }

    if(txtKilometraje.val().length < 1){
        txtKilometraje.focus();
        reqTxtKilometraje.html(requireField);
        return false;
    }else{
        reqTxtKilometraje.empty('');
    }

    if(txtCombustible.val().length < 1){
        txtCombustible.focus();
        reqTxtCombustible.html(requireField);
        return false;
    }else{
        reqTxtCombustible.empty('');
    }

    if(txtFechaMovimiento.val().length < 1){
        txtFechaMovimiento.focus();
        reqTxtFechaMovimiento.html(requireField);
        return false;
    }else{
        reqTxtFechaMovimiento.empty('');
    }

    if(txtFechaLlegada.val().length < 1){
        txtFechaLlegada.focus();
        reqTxtFechaLlegada.html(requireField);
        return false;
    }else{
        reqTxtFechaLlegada.empty('');
    }

    if(txtTarifaAlimentacion.val().length < 1){
        txtTarifaAlimentacion.focus();
        reqTxtTarifaAlimentacion.html(requireField);
        return false;
    }else{
        reqTxtTarifaAlimentacion.empty('');
    }

    if(txtDiasAlimentacion.val().length < 1){
        txtDiasAlimentacion.focus();
        reqtxtDiasAlimentacion.html(requireField);
        return false;
    }else{
        reqtxtDiasAlimentacion.empty('');
    }

    if(txtTarifaHospedaje.val().length < 1){
        txtTarifaHospedaje.focus();
        reqtxtTarifaHospedaje.html(requireField);
        return false;
    }else{
        reqtxtTarifaHospedaje.empty('');
    }

    if(txtDiasHospedaje.val().length < 1){
        txtDiasHospedaje.focus();
        reqtxtDiasHospedaje.html(requireField);
        return false;
    }else{
        reqtxtDiasHospedaje.empty('');
    }

    let formData = new FormData(document.getElementById("frmAcarreo"));

    $.ajax({
        url: urlSave,
        type: "post",
        dataType: "json",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function(){
            respServer.html(guardando);
        },
        success: function (r){
            //console.log(r);                    
            if (r.resp == 1) {
                respServer.html('¡El registro se guardó correctamente!');
                acarreos_listado(1);
                dispFrmAcarreo('');
            }else{
                respServer.html('¡Ocurrió un ERROR al intentar guardar el registro!');
            }
        }
    });
});

function editarAcarreo(id){
    dispFrmAcarreo('Editar Acarreo');
    let params = {'id':id, 'opt':229}

    $.ajax({
        type: "post",
        url: urlConsultas1,
        data: params,
        dataType: "json",
        success: function (r) {
            //console.log(r);
            $('#idAcarreo').val(r.id_acarreo);            
            $('#cboOrigen').val(r.origen).select2();
            let habilitaCboOrigOtro = (r.origen == 999)? false:true;
            $('#cboOrigenOtro').val(r.origen_otro).attr('disabled',habilitaCboOrigOtro);
            $('#cboDestino').val(r.destino).select2();
            let habilitaCboDestOtro = (r.destino == 999)? false:true;
            $('#cboDestinoOtro').val(r.destino_otro).attr('disabled',habilitaCboDestOtro);
            $('#cboVehiculoTransp').val(r.id_vehiculo_transportador).select2();
            $('#txtKilometraje').val(r.kilometraje);
            $('#txtCombustible').val(r.combustible);
            $('#txtRendimiento').val(r.rendimiento);
            $('#txtFechaMovimiento').val(r.fecha_movimiento);
            $('#txtFechaLlegada').val(r.fecha_llegada);
            $('#cboEstatus').val(r.estatus);
            $('#txtTarifaAlimentacion').val(r.tarifa_alimentacion);
            $('#txtDiasAlimentacion').val(r.dias_alimentacion);
            let subTotalAlim = parseFloat(r.tarifa_alimentacion) * parseFloat(r.dias_alimentacion);
            $('#txtSubtotalAlimentacion').val(number_format(subTotalAlim, 2));
            $('#txtTarifaHospedaje').val(r.tarifa_hospedaje);
            $('#txtDiasHospedaje').val(r.dias_hospedaje);
            let subTotalHosp = parseFloat(r.tarifa_hospedaje) * parseFloat(r.dias_hospedaje);
            $('#txtSubtotalHospedaje').val(number_format(subTotalHosp, 2));
            $('#txtGastosAdicionales').val(r.gastos_adicionales);
            $('#txtTotal').val(number_format(r.total));
            $('#hdTotal').val(r.total);
            $('#txtObservaciones').val(r.observaciones);
            $('#opcion').val(239);
        }
    });
}

function eliminarAcarreo(id, nombre) {
    swal({
            html: true,
            title: "¿Está seguro?",
            text: "eliminar el acarreo con Id: <br><strong>" + nombre + "</strong>",
            type: "warning",
            showCancelButton: true,
            cancelButtonClass: "btn-primary",
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Aceptar",
            cancelButtonText: "Cancelar",
            closeOnConfirm: true
        },
        function() {
            let params = {'id':id, 'opt':218};
            $.ajax({
                type: "post",
                url: urlEliminar1,
                data: params,
                dataType: 'json',
                success: function(r) {
                    if (r.resp == 1) {
                        acarreos_listado(1);
                    }
                }
            });
        });
}


//MODAL DEL LA MAQUINARIA ACARREADA
function maqVehAcarreo(idAcarreo){
    $('#idModAcarreo').val(idAcarreo);
    let cntnListMaqAcarreo = $('#cntnListMaqAcarreo'),
        params             = {'idAcarreo':idAcarreo},
        urlPag             = 'pg/modal_acarreo_listado.php';

    $.ajax({
        type: "post",
        url: urlPag,
        data: params,
        dataType: "html",
        beforeSend: function(){
            cntnListMaqAcarreo.html(cargando);
        },
        success: function (r) {
            cntnListMaqAcarreo.html(r);
            loadDataTable('listMaqAcarreo', true);
        }
    });
}

$('#btnAddMaqAcarreo, #btnCancelaMaqVehAc').on('click', function(){
    dispFrmModalMaqAcarreo('Agregar Maquinaria/Vehículo');
});

function dispFrmModalMaqAcarreo(leyenda){
    let cntnFrmMaqAcarreo = $('#cntnFrmMaqAcarreo'),
        txtLeyenda     = $('#titleMaqAcarreo'),
        respServer2    = $('respSerrespServer2ver');
        
    resetForm('frmAcarreo');
    $('#cboMaqVeh').val(null).trigger('change');

    if (cntnFrmMaqAcarreo.is(':visible')) {
        cntnFrmMaqAcarreo.slideUp();
        respServer2.empty('');
    } else {
        cntnFrmMaqAcarreo.slideDown();
        txtLeyenda.text(leyenda);        
        $('#opcionAMaqVeh').val(240);
    }
}

$('#btnGuardaMaqVehAc').on('click', function(){
    let cboMaqVeh    = $('#cboMaqVeh'),
        reqCboMaqVeh = $('#reqCboMaqVeh'),        
        respServer   = $('#respServer2');

    if (cboMaqVeh.val() == 0) {
        cboMaqVeh.focus();
        reqCboMaqVeh.html(requireField);
        return false;
    } else {
        reqCboMaqVeh.empty('');
    }

    let formData = new FormData(document.getElementById("frmMaqAcarreo"));

    $.ajax({
        url: urlSave,
        type: "post",
        dataType: "json",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function(){
            respServer.html(guardando);
        },
        success: function (r){                                       
            if (r.resp > 0) {
                respServer.html('¡Se agregaron correctamente ' + r.resp + ' unidades al acarreo!');
                maqVehAcarreo($('#idModAcarreo').val());
                acarreos_listado(1);
                dispFrmModalMaqAcarreo('');
            }else{
                respServer.html('¡Ocurrió un ERROR al intentar guardar el registro!');
            }
        }
    });
});

function eliminarMaqAcarreo(idAcarreo, idMaquinaria, nombre) {
    swal({
            html: true,
            title: "¿Está seguro?",
            text: "Quitar del acarreo el/la vehículo/maquinaria: <br><strong>" + nombre + "</strong>",
            type: "warning",
            showCancelButton: true,
            cancelButtonClass: "btn-primary",
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Aceptar",
            cancelButtonText: "Cancelar",
            closeOnConfirm: true
        },
        function() {
            let params = {'idAcarreo':idAcarreo, 'idMaquinaria':idMaquinaria, 'opt':219};
            $.ajax({
                type: "post",
                url: urlEliminar1,
                data: params,
                dataType: 'json',
                success: function(r) {
                    //console.log(r);
                    if (r.resp == 1) {
                        maqVehAcarreo(idAcarreo);
                    }
                }
            });
        });
}


//--------------------------------------------------------------------------------
//CATÁLOGO DE EMPRESAS
$(document).on('click', '#cancelEmpresa',function(){
	resetForm('frmEmpresa');
	$('#opcion').val(248);
});

function listEmpresas(){
    let cntnList = $('#cntnListEmpresas');

	$.ajax({
		type: 'post',
		dataType: 'html',
        url: 'pg/empresas_listado.php',
        beforeSend: function(){
			cntnList.html(cargando);
		},
		success: function(data){
			cntnList.html(data);			
        },
        complete: function(){
            loadDataTable('listEmpresas', true);
        }
        
	});
}

$(document).on('click', '#saveEmpresa', function(e){
	e.preventDefault();
    let formData   = new FormData(document.getElementById('frmEmpresa')),
        txtName    = $('#txtName'),
        reqTxtName = $('#reqTxtName'),
        txtAccount = $('#txtAccount'),
        reqTxtAccount = $('#reqTxtAccount'),
        respServer = $('#respServer');

    if (txtName.val().length < 1) {
        txtName.focus();
        reqTxtName.html(requireField);
        return;
    } else {
        reqTxtName.empty(requireField);
    }

    if (txtAccount.val().length < 1) {
        txtAccount.focus();
        reqTxtAccount.html(requireField);
        return;
    } else {
        reqTxtAccount.empty(requireField);
    }

	$.ajax({
		type: 'post',
		data: formData,
		dataType: 'json',
		url: urlSave,
		cache: false,
		contentType: false,
        processData: false,
        beforeSend: function(){
			respServer.html(cargando);
		},
		success: function(r){
            //console.log(r);
            if(r.resp == 1){
                respServer.empty('');
                listEmpresas();
                resetForm('frmEmpresa');
                $('#opcion').val(248);
            }else{
                respServer.html(r.msg);
            }
        }
	});
});

function editEmpresa(id){
	$.ajax({
		type: 'post',
		data: {id, opt:233},
		dataType: 'json',
        url: urlConsultas1,
        beforeSend: function(){
			$('#respServer').html(cargando);
		},
		success: function(r){
            //console.log(r);
			$('#respServer').empty('');
			$('#idEmpresa').val(r.id_empresa);
            $('#txtName').val(r.nombre);
            $('#txtAccount').val(r.num_cuenta);
			$('#opcion').val('249');
		}
	});
}


function deleteEmpresa(id, name){
	swal({
        html: true,
        title: '¿Está seguro?',
        text: 'Eliminar la empresa: <strong>' + name + '</strong>',
        type: 'warning',
        showCancelButton: true,
        cancelButtonClass: 'btn-primary',
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
        closeOnConfirm: true
      },
      function(){
          let params = {id, 'opt':223};
          $.ajax({
              type:    'post',
              url:     urlEliminar1,
              data:    params,
              dataType: 'json',
              success: function(r){
                  if (r.resp == 1) {
                      listEmpresas();
                  }
              }
          });
      });
}


//--------------------------------------------------------------------------
//MÓDULO DE ALMACÉN

function inventario_listado(page){
    let cntnList = $('#cntnListInventario'),
        params   = {page};

	$.ajax({
        type: 'post',
        data: params,
		dataType: 'html',
        url: 'pg/inventario_listado.php',
        beforeSend: function(){
			cntnList.html(cargando);
		},
		success: function(r){                  
			cntnList.html(r);			
        }
	});
}

function dispFrmInvAlm(){
    let cntnFrm     = $('#cntnFrmInventario'),
        cboObraInv  = $('#cboObraInv'),
        btnNvo      = $('#btnNvaEntradaInv');
    
    $('#cbxCatInventAlm').bootstrapToggle('off');
    resetFrmInvAlm();
    cboObraInv.removeAttr('disabled');
    selectFrm('select2');

    if (cntnFrm.is(':visible')) {        
        cntnFrm.slideUp();
        btnNvo.removeAttr('disabled');
    } else {        
        cntnFrm.slideDown();
        btnNvo.attr('disabled', true);
    }
}

$(document).on('click', '#btnNvaEntradaInv, #btnCancelaInvAlmcn', dispFrmInvAlm);

$(document).on('change', '#cbxCatInventAlm, #cboObraInv', function() {
    let optSwitched = $(this).prop('id'),
        cboObra     = $('#cboObraInv'),
        cboCpto     = $('#cboArticulo');

    switch (optSwitched) {
        case 'cbxCatInventAlm':
            cboObra.val(0);
            if ($(this).prop('checked')) {
                cboObra.val(0);
                cboObra.attr('disabled', true);
                loadCboCptosInvInt();
            } else {
                cboObra.removeAttr('disabled');
                cboCpto.empty('');
            }
        break;
    
        case 'cboObraInv':
            loadCboConceptos(cboObra.find(':selected').val());
        break;
    }
});

$(document).on('change', '#cboArticulo', function(){
    let txtExistencia     = $('#txtExistencia'),
        idInventario      = $('#idInventario'),
        txtStockMin       = $('#txtStockMin'),
        btnGuardaInvAlmcn = $('#btnGuardaInvAlmcn'),
        optInv            = ($('#cbxCatInventAlm').prop('checked'))? 1:0,
        respServer        = $('#respServer'),
        params            = {optInv, 'idArticulo':$(this).find(':selected').val(), 'opt':234};

    if($(this).find(':selected').data('existinv') == 1){
        btnGuardaInvAlmcn.attr('disabled', true);
        txtStockMin.val('');
        respServer.text('* Este concepto ya se encuentra en el Inventario');
        return;
    }else{
        btnGuardaInvAlmcn.removeAttr('disabled');
        respServer.empty('');
    }

    $.ajax({
        type: "post",
        url: urlConsultas1,
        data: params,
        dataType: "json",
        success: function (r) {              
            idInventario.val(r.id_almacen);            
            txtStockMin.val(r.stock_minimo);
        }
    });
});

$(document).on('click', '#btnGuardaInvAlmcn', function(){
    let cboObraInv       = $('#cboObraInv'),
        reqCboObraInv    = $('#reqCboObraInv'),
        cboArticulo      = $('#cboArticulo'),
        reqCboArticulo   = $('#reqCboArticulo'),
        txtExistencia    = $('#txtExistencia'),
        reqTxtExistencia = $('#reqTxtExistencia'),
        txtStockMin      = $('#txtStockMin'),
        reqTxtStockMin   = $('#reqTxtStockMin'),
        respServer       = $('#respServer');

    if(cboObraInv.is(':disabled') == false){        
        if (cboObraInv.find(':selected').val() == 0) {            
            reqCboObraInv.html(requireField);
            return;
        } else {
            reqCboObraInv.empty('');       
        }
    }
    
    if (cboArticulo.val() == 0) {
        reqCboArticulo.html(requireField);
        return;
    } else {
        reqCboArticulo.empty('');       
    }

    if (txtExistencia.val().length < 1) {
        txtExistencia.focus();
        reqTxtExistencia.html(requireField);
        return;
    } else {
        reqTxtExistencia.empty('');
    }

    if (txtStockMin.val().length < 1) {
        txtStockMin.focus();
        reqTxtStockMin.html(requireField);
        return;
    } else {
        reqTxtStockMin.empty('');
    }

    let formData = new FormData(document.getElementById('frmInventario'));

    $.ajax({
		type: 'post',
		data: formData,
		dataType: 'json',
		url: urlSave,
		cache: false,
		contentType: false,
        processData: false,
        beforeSend: function(){
            respServer.html(guardando);
            $(this).text('Guardando...');
		},
		success: function(r){            
            if(r.resp == 1){
                respServer.empty('');
                dispFrmInvAlm();
                inventario_listado(1);
                resetFrmInvAlm();
                $('#opcion').val(250);
            }else{
                respServer.html(r.msg);
            }
        },
        complete: function(){$(this).text('Guardar');}
	});
});

function histInOut(idAlm, cpto, uMed){
    $('#titleModHistESCpto').text(cpto);
    let params = {idAlm, 'opt':235},
        cntn   = $('#cntnListHistESAlm');
    
    $.ajax({
        type: "post",
        url: urlConsultas1,
        data: params,
        dataType: "json",
        beforeSend: function(){
            cntn.html(cargando);
        },
        success: function (r) {                             
            if (r.totRegs > 0) {
                cntn.html(createTableListHitESAlm(r.stats, r.list, uMed));
            } else {
                cntn.html('<center><h4>No Hay Registros en el Historial</h4></center>');
            }
        },
        complete: function(){
            loadDataTable('listHistESAlm', true, 0, 'DESC', 3);
        }
    });
}

function createTableListHitESAlm(stats, list, uMed){
    let element = '', totEnt = 0, totSal = 0;

    for (let i = 0; i < stats.length; i++) {
        switch (i) {
            case 0:
                totEnt = stats[i]['total'];
                break;
        
            case 1:
                totSal = stats[i]['total'];
                break;
        }
        
    }    
    element = '<div class="row">';
        element+= '<div class="col-lg-4 col-xs-6">';
            element+= '<div class="small-box bg-aqua">';
                element+= '<div class="inner">';
                    element+='<h3>' +  number_format(totEnt, 0) + '<sup class="supTxt">' + uMed + '</sup></h3>';
                    element+= '<p>Entradas</p>';
                element+= '</div>';
                element+= '<div class="icon">';
                    element+= '<i class="fa fa-plus"></i>';
                element+= '</div>';
            element+= '</div>';
        element+= '</div>';

        element+= '<div class="col-lg-4 col-xs-6">';
            element+= '<div class="small-box bg-green">';
                element+= '<div class="inner">';
                    element+= '<h3>' + number_format(totSal, 0) + '<sup class="supTxt">' + uMed + '</sup></h3>';
                    element+= '<p>Salidas</p>';
                element+= '</div>';
                element+= '<div class="icon">';
                    element+= '<i class="fa fa-minus"></i>';
                element+= '</div>';
            element+= '</div>';
        element+= '</div>';

        element+= '<div class="col-lg-4 col-xs-6">';
            element+= '<div class="small-box bg-yellow">';
                element+= '<div class="inner">';
                    element+= '<h3>' + number_format(totEnt - totSal, 0) + '<sup class="supTxt">' + uMed + '</sup></h3>';
                    element+= '<p>Existencia</p>';
                element+= '</div>';
                element+= '<div class="icon">';
                    element+= '<i class="fa fa-cubes"></i>';
                element+= '</div>';
            element+= '</div>';
        element+= '</div>';
    element+= '</div>';
    
    element+= '<br>';
    
    element+= '<table id="listHistESAlm" class="table table-bordered table-striped">';
        element+= '<thead>';
                   
            element+= '<tr>';
                element+= '<th class="text-center" style="width:35%;">Info</th>';
                element+= '<th class="text-center" style="width:15%;">Cantidad</th>';
                element+= '<th class="text-left" style="width:30%;">Descripción</th>';                
                element+= '<th class="text-center" style="width:20%;">Fecha</th>';
            element+= '</tr>';
        element+= '</thead>';
        element+= '<tbody>';
        for (let i = 0; i < list.length; i++) {
            element+= '<tr>';
                element+= '<td class="text-left v-align pt_2em">';
                    element+= '<p class="mg-1em"><label>Tipo:</label> <strong><cite>' + list[i]['tipoEnt'] + '</strong></p>';
                    if(list[i]['obra'] !== ''){
                        element+= '<p class="mg-1em"><label>Obra:</label> <cite>' + list[i]['obra'] + '</cite></p>';
                    }
                element+= '</td>';
                element+= '<td class="text-right v-align">' + number_format(list[i]['cantidad'],2) + ' ' + uMed + '</td>';                
                element+= '<td class="text-left v-align">' + list[i]['fObservaciones'] + '</td>';
                element+= '<td class="text-center v-align">' + list[i]['fecha_registro'] + '</td>';
                element+= '</tr>';
        }
        element+= '</tbody>';
    element+= '</table>';

    return element;
}

dispFrmOutputInv = function(idAlm, cpto, existencia){
    $('#titleModSalidaCpto').text(cpto);
    $('#idAlmacenModSal').val(idAlm);
    $('#hdExistInv').val(existencia);
    $('#cbxMovES').bootstrapToggle('off');
    $('select#cboObraBusq').val(0).select2();
    resetForm('frmESInvAlm');
}

$('form#frmESInvAlm').on('change', '#cbxMovES, #txtCantidadSalida', function(){
    let btn = $('#btnOutputInv'),
        msg = $('#respServer3'),
        act,
        txtL;
    
    if($(this).is(':checked')){        
        if ($('#hdExistInv').val() == 0) {
            txtL = '* Concepto sin existencias, no puede realizar salidas';
            act = true;
        }      
    }else{
        txtL= ''; act = false;
    }

    msg.html(txtL);
    btn.attr('disabled', act);
});

$('form#frmESInvAlm').on('change keyup', '#txtCantidadSalida', function(){
    let btn = $('#btnOutputInv'),
        msg = $('#respServer3'),
        act,
        txtL;

    if(parseFloat($(this).val()) > parseFloat($('#hdExistInv').val()) && $('#cbxMovES').is(':checked')){
        txtL = '* Se está superando la cantidad en existencia.';
        act = true;
    }else{
        txtL = '';
        act = false;
    }

    msg.html(txtL);
    btn.attr('disabled', act);
});

$(document).on('click', '#btnOutputInv', function(){
    let cantidad             = $('#txtCantidadSalida'),
        reqTxtCantidadSalida = $('#reqTxtCantidadSalida'),
        respServer           = $('#respServer3');

    if(cantidad.val().length < 1){        
        cantidad.focus();
        reqTxtCantidadSalida.html(requireField);
        return;
    }else{
        reqTxtCantidadSalida.empty('');
    }
    
    let formData = new FormData(document.getElementById('frmESInvAlm'));

    $.ajax({
		type: 'post',
		data: formData,
		dataType: 'json',
		url: urlSave,
		cache: false,
		contentType: false,
        processData: false,
        beforeSend: function(){
            respServer.html(guardando);            
		},
		success: function(r){
            if(r.resp == 1){
                respServer.empty('');                
                inventario_listado(1);
                $('#modal_salida_almacen').modal('hide');
                resetForm('frmESInvAlm');                
            }else{
                respServer.html(r.msg);
            }
        }        
	});
});

function resetFrmInvAlm(){
    resetForm('frmInventario');
    $('#cboObraInv').val(0);
    $('#cboArticulo').empty('');
}


//---------------------------------------------------------------------
//FUNCIONES++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    function resetForm(formulario) {
        $('#' + formulario)[0].reset();
        $('.msgError').empty();
    }



    function loadDataTable(table, setSearch = true, setPage = '', order='desc', colOrder = 0) {
        dataTable1 = '';
        dataTable1 = $('#' + table).DataTable({
            'order': [
                [colOrder, order]
            ],
            "sPaginationType": "full_numbers",
            'paging': true,
            'lengthChange': true,
            'searching': setSearch,
            'ordering': true,
            'info': true,
            'autoWidth': false,
            "language": {
                "search": "Buscar:",
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "Lo sentimos, no se encontraron resultados",
                "info": "Página _PAGE_ de _PAGES_",
                "infoEmpty": "No existen registros",
                "infoFiltered": "(filtrado de _MAX_ total registros)",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            }
        });
        if (setPage !== '') {
            setTimeout(function() {
                dataTable1.page(setPage).draw('page');
            }, 10);
        }
    }

    function getCurrentPage() {
        currentPage = dataTable1.page.info().page;
    }


    function frmNumerico(elemento) {
        $('#' + elemento).mask('000,000,000,000,000,000.00', {reverse: true});
    }

    function frmTelefonico(elemento) {
        $('#' + elemento).inputmask({ "mask": "(999) 999-9999" });
    }

    function number_format(amount, decimals) {
        amount += ''; // por si pasan un número en vez de un string
        amount = parseFloat(amount.replace(/[^0-9\.]/g, '')); // elimino cualquier cosa que no sea número o punto

        decimals = decimals || 0; // por si la variable no fue fue pasada

        // si no es un número o es igual a cero retorno el mismo cero
        if (isNaN(amount) || amount === 0)
            return parseFloat(0).toFixed(decimals);

        // si es mayor o menor que cero retorno el valor formateado como número
        amount = '' + amount.toFixed(decimals);

        var amount_parts = amount.split('.'),
            regexp = /(\d+)(\d{3})/;

        while (regexp.test(amount_parts[0]))
            amount_parts[0] = amount_parts[0].replace(regexp, '$1' + ',' + '$2');

        return amount_parts.join('.');
    }

    $(document).on('keypress', '.validaNumeros', function(e) {
        if(isNaN(this.value + String.fromCharCode(e.charCode))) 
         return false;
    });
    /* .on("cut copy paste",function(e){
        e.preventDefault();
      }); */

    function initRdoBtnMinimal(){
        $('input[type="radio"].minimal, input[type="checkbox"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass   : 'iradio_minimal-blue'
        });
    }

    function validaTipoArchivo(iFile){
        let fileName        = document.getElementById(iFile).files[0].name,
        aArchivosPermitidos = ['pdf', 'png', 'jpg', 'jpeg', 'gif'],
        rFName              = fileName.split('.');
        return aArchivosPermitidos.includes(rFName[1]);
     }

     function validaFrmFileUpload(idInpFl, reqTxtMsg, idBtn){
        let result       = validaTipoArchivo(idInpFl),
            reqFlArchivo = $('#' + reqTxtMsg),
            btn          = $('#' + idBtn);
    
        if (result === false) {
            reqFlArchivo.html('¡Formato no permitido!');
            btn.attr('disabled', true);
        } else {
            btn.attr('disabled', false);
            reqFlArchivo.empty('');
        }
    }

 function addDiasaFecha(d, fecha){
    let sep = fecha.indexOf('/') != -1 ? '/' : '-',
        vfecha = new Date(fecha);
    
    vfecha.setDate(vfecha.getDate()+parseInt(d + 1));
    let anio=vfecha.getFullYear(),
        mes= vfecha.getMonth()+1,
        dia= vfecha.getDate();

    mes = (mes < 10) ? ("0" + mes) : mes;
    dia = (dia < 10) ? ("0" + dia) : dia;
    let fechaFinal = anio + sep + mes + sep + dia;
    
    return fechaFinal;
 }