//funciones Marco Molina
let urlSubir_     = 'php/subir2.php';
let urlEliminar_  = 'php/eliminar.php';
let dataTable_;
let currentPage_;
let id_;
let idFecha_ = 0;
let opcion_;

//variables Google maps
var selectedShape;
var colors = ['#1E90FF', '#FF1493', '#32CD32', '#FF8C00', '#4B0082'];
var selectedColor;
var colorButtons = {};
var drawingManager;
var marker, i, map;
var placeMarkers = [];
var input;
var searchBox;
var curposdiv;
var curseldiv;
var map;
var features = new Array();
var infowindow = new google.maps.InfoWindow();
var infowindow1 = new google.maps.InfoWindow();
var marker, i, map;
var bounds = new google.maps.LatLngBounds();

//CATÁLOGO CALIDAD ACABADO
function calidad_acabado_listado(){
  urlPag = 'pg/calidad_acabado_listado.php';

  $.ajax({
        beforeSend: function(){
            $("#cntnListCalidadAcabado").html(cargando);
        },
        type:    "post",
        url:     urlPag,
        dataType: 'html',
        success: function(data){
            $('#cntnListCalidadAcabado').html(data);
            loadDataTable('listCalidadAcabado', true);
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
        dataType: 'html',
        success: function(data){
            $('#cntnListCocina').html(data);
            loadDataTable('listCocina', true);
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
        dataType: 'html',
        success: function(data){
            $('#cntnListEstacionamiento').html(data);
            loadDataTable('listEstacionamiento', true);
        }
  });
}
//CATÁLOGO Estatus PROPIEDADES
function estatus_propiedades_listado(){
  urlPag = 'pg/estatus_propiedades_listado.php';

  $.ajax({
        beforeSend: function(){
            $("#cntnListEstatus").html(cargando);
        },
        type:    "post",
        url:     urlPag,
        dataType: 'html',
        success: function(data){
            $('#cntnListEstatus').html(data);
            loadDataTable('listEstatus', true);
        }
  });
}

//CATALOGO DE PROPIEDADES
function propiedades_listado(){
  urlPag        = 'pg/propiedades_lista.php';
  var folio     = $("#txtFolio");
  var alias     = $("#txtAlias");
  var direccion = $("#txtDireccion");
  var cliente   = $("#txtCliente");
  $.ajax({
        beforeSend: function(){
            $("#listado").html(cargando);
        },
        type:    "post",
        data:{
              'folio': folio.val(),
              'alias':alias.val(),
              'direccion':direccion.val(),
              'cliente':cliente.val()
            },
        url:     urlPag,
        dataType: 'html',
        cache: false,
        success: function(data){
            $('#listado').html(data);
            $("#btnverImagenes").trigger( "click" );
            loadDataTable('listClientes', false);
            frmNumerico_('monto',2);
        }
  });
}

//CATÁLOGO Propietario PROPIEDADES
function propietario_propiedades_listado(){
  urlPag = 'pg/propietario_propiedades_listado.php';

  $.ajax({
        beforeSend: function(){
            $("#cntnListPropietarios").html(cargando);
        },
        type:    "post",
        url:     urlPag,
        dataType: 'html',
        success: function(data){
            $('#cntnListPropietarios').html(data);
            loadDataTable('ListPropietarios', true);
        }
  });
}

/******************************* BOTONES ******************************/

//Agrega Registro a la tabla PROPIEDADES
$("#btnGuardarPropiedad").click(function(){
  spPropiedades();
});

// Agrega Registros al catalago de Calidad y Acabado
$("#btnGuardarAcabado").click(function(){
    spCalidadAcabado();
});

// Agrega Registros al catalago de Estacionamiento
$("#btnGuadarEstacionamiento").click(function(){
    spEstacionamiento();
});

// Agrega Resgistos al catalogo de cocina
$("#bntAddCocina").on("click",function(){
  spCocina();
});

// Agrega Resgistos al catalogo de estatus propiedades
$("#bntAddEstatusPropiedades").on("click",function(){
  spEstatusPropiedades();
});

$("#bntAddPropietarioPropiedades").on("click",function(){
  spPropietarioPropiedades();
});

$("#ContenidoGeneral").on('click','#btnGuardaDocumento',function() {
    spDocumentosPropiedades();   
    
});

$("#ContenidoGeneral").on("change",'#txtTipoDocumento',function(){
    if(this.value == 4){
        $("#txtOtro").removeAttr('disabled');
        $("#txtOtro").focus();
    }
    else{
        $("#txtOtro").val("");
        $("#txtOtro").attr('disabled',true);
    }
        
});
/*********************** FIN BOTONES *****************************/

//Abre el modulo de propiedades_imagenes
function propiedades_imagenes(id){
  urlPag = 'pg/propiedades_imagenes.php';
  formData = new FormData();
  formData.append('id_propiedad',id);

  $.ajax({
        beforeSend: function(){
            $("#ContenidoGeneral").html(cargando);
        },
        type        : "post",
        data        : formData,
        url         : urlPag,
        dataType    : 'html',
        processData : false,
        contentType : false,
        cache       : false,
        success: function(data){
          $('#ContenidoGeneral').html(data);
          movil('divAgregaImagen','.cerrarAgregaImagen');
          loadDataTable('listImagenes', true);
        }
  });
}

//Abre el modulo de propiedades_documentos
function propiedades_documentos(id){
  urlPag = 'pg/propiedades_documentos.php';
  formData = new FormData();
  formData.append('id_propiedad',id);

  $.ajax({
        beforeSend: function(){
            $("#ContenidoGeneral").html(cargando);
        },
        type        : "post",
        data        : formData,
        url         : urlPag,
        dataType    : 'html',
        processData : false,
        contentType : false,
        cache       : false,
        success: function(data){
          $('#ContenidoGeneral').html(data);
          movil('divAgregaDocumento','.cerrarAgregaDocumento');
          loadDataTable('listDocumentos', true);
          frmNumerico_('classNum',2);
          dateControl('txtVigencia');
        }
  });
}

//carga los datos para edicion catalago de Calidad y Acabado
function ModRegCalidadAcabado(id,nombre,icono,fecha=0){
    $("#txtNombre").val(nombre);
    $("#txtIcono").val(icono);
    $("#txtId").val(id);
    $("#txtFecha").val(fecha);
    if(fecha != 0){
			swal({
				title: "Borrar Registro",
				text: "Se borra el registro seleccionado. ¿Está seguro?",
				type: "warning",
				showCancelButton: true,
				confirmButtonClass: "btn-danger",
				confirmButtonText: "Aceptar",
				cancelButtonText: "Cancelar",
				closeOnConfirm: false,
				closeOnCancel: true
				},
				function(isConfirm) {
				if (isConfirm) {
					spCalidadAcabado();
					swal("Borrado!", "El registro ha sido eliminado.", "success");
				}
				});
        //
    }
}

//edita-elimina una imagen de propiedades
function btnEditarPropiedadImagen(list,flag){
  descripcion 		= list.descripcion;
  idFecha 				= flag;
  idPropiedad 		= list.id_propiedad;
  idImagen   			= list.id_imagen;
  idTipo					= list.tipo;
  imagen          = list.imagen;

  $("#txtImagen").val(imagen);
  $("#txtTipo").val(idTipo);
  $("#txtDescripcion").val(descripcion);
  $("#idFecha").val(idFecha);
  $("#id_propiedad").val(idPropiedad);
  $("#id_imagen").val(idImagen);

  if(idFecha == 1){
    swal({
      title: "Borrar Registro",
      text: "Se borra el registro seleccionado. ¿Está seguro?",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Aceptar",
      cancelButtonText: "Cancelar",
      closeOnConfirm: false,
      closeOnCancel: true
      },
      function(isConfirm) {
      if (isConfirm) {
        funAgregaImagenP(idPropiedad);
        swal("Borrado!", "El registro ha sido eliminado.", "success");
      }
      });
  }
  else{
    $("#btnCollapseImg").trigger("click");
  }
}

//edita-elimina un documento de propiedades
function btnEditarPropiedadDocumemnto(list,flag){
  $("#txtTipoDocumento").val(list.tipo_documento);
  $("#txtOtro").val(list.descripcion_otros);
  $("#txtEstatus").val(list.id_estatus);
  $("#txtMonto").val(list.monto);
  $("#txtVigencia").val(list.fVigencia);
  $("#txtTipoArchivo").val(list.tipo_archivo);
  $("#txtArchivo").val(list.archivo);
  $("#txtObservaciones").val(list.observaciones);
  $("#idFecha").val(flag);
  $("#id_propiedad").val(list.id_propiedad);
  $("#id_documento").val(list.id_documento);

  if(flag == 1){
    swal({
      title: "Borrar Registro",
      text: "Se borra el registro seleccionado. ¿Está seguro?",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Aceptar",
      cancelButtonText: "Cancelar",
      closeOnConfirm: false,
      closeOnCancel: true
      },
      function(isConfirm) {
      if (isConfirm) {
        spDocumentosPropiedades();
        swal("Borrado!", "El registro ha sido eliminado.", "success");
      }
      });
  }
  else{
    $("#btnCollapseDoc").trigger("click");
  }
}

function btnEliminarPropiedad(id){
  
  id_ = id;
  idFecha_ = 1;
  opcion_ = 6;
  swal({
    title: "Borrar Registro",
    text: "Se borrara el registro seleccionado. ¿Está seguro?",
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    confirmButtonText: "Aceptar",
    cancelButtonText: "Cancelar",
    closeOnConfirm: false,
    closeOnCancel: true
    },
    function(isConfirm) {
    if (isConfirm) {
      spPropiedades();
      swal("Borrado!", "El registro ha sido eliminado.", "success");
    }
    });
}


//carga los datos para edicion catalago de ESTACIONAMIENTO
function ModRegEstacionamiento(id,nombre,icono,fecha=0){
    $("#txtNombre").val(nombre);
    $("#txtIcono").val(icono);
    $("#txtId").val(id);
    $("#txtFecha").val(fecha);
    if(fecha != 0){
			swal({
				title: "Borrar Registro",
				text: "Se borra el registro seleccionado. ¿Está seguro?",
				type: "warning",
				showCancelButton: true,
				confirmButtonClass: "btn-danger",
				confirmButtonText: "Aceptar",
				cancelButtonText: "Cancelar",
				closeOnConfirm: false,
				closeOnCancel: true
				},
				function(isConfirm) {
				if (isConfirm) {
					spEstacionamiento();
					swal("Borrado!", "El registro ha sido eliminado.", "success");
				}
				});
        //
    }
}

//carga los datos para edicion catalago de Cocina
function ModRegCocina(id,nombre,icono,fecha=0){
    $("#txtNombre").val(nombre);
    $("#txtIcono").val(icono);
    $("#txtId").val(id);
    $("#txtFecha").val(fecha);
    if(fecha != 0){
			swal({
				title: "Borrar Registro",
				text: "Se borra el registro seleccionado. ¿Está seguro?",
				type: "warning",
				showCancelButton: true,
				confirmButtonClass: "btn-danger",
				confirmButtonText: "Aceptar",
				cancelButtonText: "Cancelar",
				closeOnConfirm: false,
				closeOnCancel: true
				},
				function(isConfirm) {
				if (isConfirm) {
					spCocina();
					swal("Borrado!", "El registro ha sido eliminado.", "success");
				}
				});
        //
    }
}

//carga los datos para edicion catalago de Estatus propiedades
function ModRegEstatusPropiedades(id,nombre,icono,fecha=0){
    $("#txtNombre").val(nombre);
    $("#txtIcono").val(icono);
    $("#txtId").val(id);
    $("#txtFecha").val(fecha);
    if(fecha != 0){
			swal({
				title: "Borrar Registro",
				text: "Se borra el registro seleccionado. ¿Está seguro?",
				type: "warning",
				showCancelButton: true,
				confirmButtonClass: "btn-danger",
				confirmButtonText: "Aceptar",
				cancelButtonText: "Cancelar",
				closeOnConfirm: false,
				closeOnCancel: true
				},
				function(isConfirm) {
				if (isConfirm) {
					spEstatusPropiedades();
					swal("Borrado!", "El registro ha sido eliminado.", "success");
				}
				});
        //
    }
}

//guardar/eliminar una imagen de propiedades
function funAgregaImagenP(id){
  flFile  = $("#flImagen")[0].value;
  txtFile = $("#txtImagen").val();
  if(flFile == '' && txtFile == ''){
    swal("Error!", 'Debe seleccionar una imágen.', "error");
  }
  else {
    formData = new FormData($("#form_AgregaI")[0]);
    $.ajax({
      beforeSend: function(){
        $("#mensajeServer").html(cargando);
      },
      url: urlSubir_,
      type: "post",
      dataType: "json",
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      success: function(resp){
        $("#mensajeServer").empty;
        if(resp.resp == 1) propiedades_imagenes(id);
        else{
          swal("Error!", resp.msg, "warning");
        }
      }
    });
  }
}

//carga el modulo de regristro de propiedades
function propiedades_registro(id=0){
  $.ajax({
    beforeSend: function(){
      $("#ContenidoGeneral").html(cargando);
    },
    url: 'pg/propiedades_registro.php',
    type: "post",
    dataType: "html",
    data: {'id':id},
    success: function(resp){
      $("#ContenidoGeneral").html(resp);
      fnCambiaCodigoP('txtDesarrollo');
      //Initialize Select2 Elements
      parent.selectFrm('select2');
      //formato numerico
      frmNumerico_('txtMonto',1);
      //Google maps
      setTimeout(initMap, 1000);
    }
  });
}

//carga los datos para edicion catalago de Propietario propiedades
function ModRegPropietarioPropiedades(id,nombre,fecha=0){
    $("#txtNombre").val(nombre);
    $("#txtId").val(id);
    $("#txtFecha").val(fecha);
    if(fecha != 0){
			swal({
				title: "Borrar Registro",
				text: "Se borra el registro seleccionado. ¿Está seguro?",
				type: "warning",
				showCancelButton: true,
				confirmButtonClass: "btn-danger",
				confirmButtonText: "Aceptar",
				cancelButtonText: "Cancelar",
				closeOnConfirm: false,
				closeOnCancel: true
				},
				function(isConfirm) {
				if (isConfirm) {
					spPropietarioPropiedades();
					swal("Borrado!", "El registro ha sido eliminado.", "success");
				}
				});
        //
    }
}

/****************** STORED PROCEDURES ****************************/
// Agrega, Edita y Elimina catalago de Calidad y Acabado
function spCalidadAcabado(){
    formData = new FormData($("#frmAcabado")[0]);
    $.ajax({
      beforeSend: function(){
        $("#cntnListCalidadAcabado").html(guardando);
      },
      url: urlSubir_,
      type: "post",
      dataType: "json",
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      success: function(resp){
          if(resp.resp == 1){
            calidad_acabado_listado();
            $('#txtId').val(0);
            $('#txtFecha').val(0);
            resetForm('frmAcabado');
          }else{
            $("#respServer").html('Ocurrió un error al intentar guardar en la base de datos');
          }
      }
    });
}

// Agrega, Edita y Elimina catalago de ESTACIONAMIENTO
function spEstacionamiento(){
    formData = new FormData($("#frmEstacionamiento")[0]);
    $.ajax({
      beforeSend: function(){
        $("#cntnListEstacionamiento").html(guardando);
      },
      url: urlSubir_,
      type: "post",
      dataType: "json",
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      success: function(resp){
          if(resp.resp == 1){
            estacionamiento_listado();
            $('#txtId').val(0);
            $('#txtFecha').val(0);
            resetForm('frmEstacionamiento');
          }else{
            $("#respServer").html('Ocurrió un error al intentar guardar en la base de datos');
          }
      }
    });
}

// Agrega, Edita y Elimina catalago de Cocina
function spCocina(){
    formData = new FormData($("#frmCocina")[0]);
    $.ajax({
      beforeSend: function(){
        $("#cntnListCocina").html(guardando);
      },
      url: urlSubir_,
      type: "post",
      dataType: "json",
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      success: function(resp){
          if(resp.resp == 1){
            cocina_listado();
            $('#txtId').val(0);
            $('#txtFecha').val(0);
            resetForm('frmCocina');
          }else{
            $("#respServer").html('Ocurrió un error al intentar guardar en la base de datos');
          }
      }
    });
}

// Agrega, Edita y Elimina catalago de Estatus propiedades
function spEstatusPropiedades(){
    formData = new FormData($("#frmEstatus")[0]);
    $.ajax({
      beforeSend: function(){
        $("#cntnListEstatus").html(guardando);
      },
      url: urlSubir_,
      type: "post",
      dataType: "json",
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      success: function(resp){
          if(resp.resp == 1){
            estatus_propiedades_listado();
            $('#txtId').val(0);
            $('#txtFecha').val(0);
            resetForm('frmEstatus');
          }else{
            $("#respServer").html('Ocurrió un error al intentar guardar en la base de datos');
          }
      }
    });
}

// Agrega, Edita y Elimina catalago de Propietario propiedades
function spPropietarioPropiedades(){
    formData = new FormData($("#frmPropietarios")[0]);
    $.ajax({
      beforeSend: function(){
        $("#cntnListPropietarios").html(guardando);
      },
      url: urlSubir_,
      type: "post",
      dataType: "json",
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      success: function(resp){
          if(resp.resp == 1){
            propietario_propiedades_listado();
            $('#txtId').val(0);
            $('#txtFecha').val(0);
            resetForm('frmPropietarios');
          }else{
            $("#respServer").html('Ocurrió un error al intentar guardar en la base de datos');
          }
      }
    });
}

function spPropiedades($flag=0){
  if($flag == 0){
    mensaje = "agregó";
  }
  else{
    mensaje = 'modifico';
  }
  if(idFecha_ == 0){
    formData = new FormData($("#frmPropiedades")[0]);
  }
  else{
    formData = new FormData();
    formData.append('id',id_);
    formData.append('idFecha',idFecha_);
    formData.append('opcion',opcion_);
  }
  $.ajax({
    beforeSend: function(){
      $("#respServer").html(guardando);
    },
    url: urlSubir_,
    type: "post",
    dataType: "json",
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
    success: function(resp){
        $("#respServer").empty();
        if(resp.resp == 1){
          if(idFecha_ == 0){
            swal({
              title: "Inmuebles",
              text: "Se "+ mensaje + " el inmuble con Folio:" + resp.folio
            });
            propiedades_registro(resp.id);
          }
          else{
            idFecha_ = 0;
            propiedades_listado();
          }
        }else{
          idFecha_ = 0;
          $("#respServer").html('Ocurrió un error al intentar guardar en la base de datos');
        }
    }
  });
}

function spDocumentosPropiedades(){
    formData = new FormData($("#form_AgregaD")[0]);
    id = formData.get("id_propiedad");
    $.ajax({
      beforeSend: function(){
        $("#mensajeServer").html(guardando);
      },
      url: urlSubir_,
      type: "post",
      dataType: "json",
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      success: function(resp){
          if(resp.resp == 1){
            propiedades_documentos(id);
          }else{
            $("#mensajeServer").html('Ocurrió un error al intentar guardar en la base de datos');
          }
      }
    });
}


/******************** FIN STORED PROCEDURES *******************/

/**********************  Funciones de OnChange **************/
function fnCambiaCodigoP(elemento){
  var newFolio;
  var parteUno;
  var parteDos;
  var dataId = $("#"+elemento).find(':selected').data('id');
  var arreglo = dataId.split(";");
  var valor = $("#txtFolio").val();

  $("#txtCodigoP").val(arreglo[1]);
  if(valor.length > 3){
    parteUno = valor.substring(0,2);
    parteDos = valor.substring(3,valor.length);
    newFolio = parteUno + arreglo[0] + parteDos;
  }
  else newFolio = valor + arreglo[0];
  $("#txtFolio").val(newFolio);

}

function fnCambiaTipo(elemento){
  var newFolio;
  var parteUno;
  var parteDos;
  var valor = $("#txtFolio").val();
  if($("#"+elemento).val() == 1){
    if(valor.length > 2){
      
      parteUno = valor.substring(0,1);
      parteDos = valor.substring(2,valor.length);
      
      newFolio = parteUno + "V" + parteDos;
    }
    else newFolio = "VV";
    $("#txtFolio").val(newFolio);
  }
  else if($("#"+elemento).val() == 2){
    if(valor.length > 2){
      
      parteUno = valor.substring(0,1);
      parteDos = valor.substring(2,valor.length);
      
      newFolio = parteUno + "R" + parteDos;
    }
    else newFolio = "VR";
    $("#txtFolio").val(newFolio);
  }
  else{

  }

}
/***************** Fin de Funciones de OnChange **************/


//Para usar google Maps
function mapa_formregistro(){
    var latitud = $('#latitud').val();
    var longitud = $('#longitud').val();

    drawmapcoords(latitud, longitud);
}

function initMap(){
  var latitud = $('#latitud').val();
  var longitud = $('#longitud').val();
  var tipo_coordenada = $("#tipo_coordenada").val();
  var coordenadas = $("#coordenadas").val();
  var nombre = $("#txtDescripcion").val();
  initialize(latitud, longitud);
  if($('#id').val() != 0) mostrarCapa(1, $('#id').val(),tipo_coordenada,coordenadas,nombre);
}

function initialize(latitud, longitud) {
  var latlng = new google.maps.LatLng(latitud, longitud);
  map = new google.maps.Map(document.getElementById("map_canvas"), {
      zoom: 16,
      center: new google.maps.LatLng(latitud, longitud),
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      disableDefaultUI: false,
      zoomControl: true
  });

  var marcador = new google.maps.Marker({
      map: map,
      draggable: false,
      position:latlng,
      visible: false
  });
  var infowindow = new google.maps.InfoWindow();
  curseldiv = document.getElementById('cursel');

  var polyOptions = {
      strokeWeight: 0,
      fillOpacity: 0.45,
      editable: true
  };
  // Crea un administrador de dibujo adjunto al mapa que permite al usuario dibujar
  // markers, lines, and shapes.
  /* Crea un gestor de dibujo adjunto al mapa que permite al usuario dibujar marcadores , líneas y formas.*/
  // drawingModes: ['marker', 'polygon', 'polyline']
  drawingManager = new google.maps.drawing.DrawingManager({
      drawingMode: google.maps.drawing.OverlayType.POLYGON,
      drawingControl: true,
      drawingControlOptions: {
          position: google.maps.ControlPosition.TOP_CENTER,
          drawingModes: ['polygon', 'polyline']
      },
      markerOptions: {
          draggable: true,
          editable: true,
      },
      polylineOptions: {
          editable: true
      },
      rectangleOptions: polyOptions,
      circleOptions: polyOptions,
      polygonOptions: polyOptions,
      map: map
  });

  google.maps.event.addListener(drawingManager, 'overlaycomplete', function(e) {
    //~ if (e.type != google.maps.drawing.OverlayType.MARKER) {
      var isNotMarker = (e.type != google.maps.drawing.OverlayType.MARKER);
      // Cambie al modo sin dibujo después de dibujar una forma.
      drawingManager.setDrawingMode(null);

      // Add an event listener that selects the newly-drawn shape when the user
      // mouses down on it.
      var newShape = e.overlay;
      newShape.type = e.type;
      google.maps.event.addListener(newShape, 'click', function() {
        setSelection(newShape, isNotMarker);
      });
      google.maps.event.addListener(newShape, 'drag', function() {
        updateCurSelText(newShape);
      });
      google.maps.event.addListener(newShape, 'dragend', function() {
        updateCurSelText(newShape);
      });
      setSelection(newShape, isNotMarker);
    //~ }// end if
  });

  // Clear the current selection when the drawing mode is changed, or when the
  // map is clicked.
  google.maps.event.addListener(drawingManager, 'drawingmode_changed', clearSelection);
  google.maps.event.addListener(map, 'click', clearSelection);
  google.maps.event.addDomListener(document.getElementById('delete-button'), 'click', deleteSelectedShape);

  buildColorPalette();

  //~ initSearch();
  // Create the search box and link it to the UI element.
   input = /** @type {HTMLInputElement} */( //var
      document.getElementById('pac-input'));
  map.controls[google.maps.ControlPosition.TOP_RIGHT].push(input);
  //
  var DelPlcButDiv = document.createElement('div');
  //~ DelPlcButDiv.style.color = 'rgb(25,25,25)'; // no effect?
  DelPlcButDiv.style.backgroundColor = '#fff';
  DelPlcButDiv.style.cursor = 'pointer';
  DelPlcButDiv.innerHTML = 'DEL';
  map.controls[google.maps.ControlPosition.TOP_RIGHT].push(DelPlcButDiv);
  google.maps.event.addDomListener(DelPlcButDiv, 'click', deletePlacesSearchResults);

}

function clearSelection() {
    if (selectedShape) {
      if (typeof selectedShape.setEditable == 'function') {
        selectedShape.setEditable(false);
      }
      selectedShape = null;
    }
    curseldiv.innerHTML = "";
}

function setSelection(shape, isNotMarker) {
  clearSelection();
  selectedShape = shape;
  if (isNotMarker)
      shape.setEditable(true);
  selectColor(shape.get('fillColor') || shape.get('strokeColor'));
  updateCurSelText(shape);
}

function updateCurSelText(shape) {
  posstr = "" + selectedShape.position;
  if (typeof selectedShape.position == 'object') {
    posstr = selectedShape.position.toUrlValue();
  }
  pathstr = "" + selectedShape.getPath;
  if (typeof selectedShape.getPath == 'function') {
    pathstr = "";
    for (var i = 0; i < selectedShape.getPath().getLength(); i++) {
      // .toUrlValue(5) Limita el número de decimales; el valor predeterminado es 6, pero puede hacer más
      pathstr += selectedShape.getPath().getAt(i).toUrlValue() + " ";
    }
    pathstr += "";
  }

  if (typeof selectedShape.getBounds == 'function') {
    var tmpbounds = selectedShape.getBounds();
    cntstr = "" + tmpbounds.getCenter().toUrlValue();
    bndstr = "[NE: " + tmpbounds.getNorthEast().toUrlValue() + " SW: " + tmpbounds.getSouthWest().toUrlValue() + "]";
  }
  cntrstr = "" + selectedShape.getCenter;
  if (typeof selectedShape.getCenter == 'function') {
    cntrstr = "" + selectedShape.getCenter().toUrlValue();
  }
  radstr = "" + selectedShape.getRadius;
  if (typeof selectedShape.getRadius == 'function') {
    radstr = "" + selectedShape.getRadius();
  }
  //curseldiv.innerHTML = "<b>cursel</b>: " + selectedShape.type + " " + selectedShape + "; <i>pos</i>: " + posstr + " ; <i>path</i>: " + pathstr + " ; <i>bounds</i>: " + bndstr + " ; <i>Cb</i>: " + cntstr + " ; <i>radius</i>: " + radstr + " ; <i>Cr</i>: " + cntrstr ;
  var coordenadas='';
  if(posstr ==='undefined'){
    coordenadas = pathstr;
  }else{
    coordenadas = posstr;
  }

  window.parent.document.getElementById('coordenadas').value = coordenadas;
  window.parent.document.getElementById('tipo_coordenada').value = selectedShape.type;
}


function deleteSelectedShape() {
  
  if (selectedShape) {
      selectedShape.setMap(null);
  }
}

function buildColorPalette() {
  var colorPalette = document.getElementById('color-palette');
  for (var i = 0; i < colors.length; ++i) {
      var currColor = colors[i];
      var colorButton = makeColorButton(currColor);
      colorPalette.appendChild(colorButton);
      colorButtons[currColor] = colorButton;
  }
  selectColor(colors[0]);
}

function makeColorButton(color) {
  var button = document.createElement('span');
  button.className = 'color-button';
  button.style.backgroundColor = color;
  google.maps.event.addDomListener(button, 'click', function() {
      selectColor(color);
      setSelectedShapeColor(color);
  });

  return button;
}

function selectColor(color) {
    selectedColor = color;
    for (var i = 0; i < colors.length; ++i) {
      var currColor = colors[i];
      colorButtons[currColor].style.border = currColor == color ? '2px solid #789' : '2px solid #fff';
    }

    var polylineOptions = drawingManager.get('polylineOptions');
    polylineOptions.strokeColor = color;
    drawingManager.set('polylineOptions', polylineOptions);

    var rectangleOptions = drawingManager.get('rectangleOptions');
    rectangleOptions.fillColor = color;
    drawingManager.set('rectangleOptions', rectangleOptions);

    var circleOptions = drawingManager.get('circleOptions');
    circleOptions.fillColor = color;
    drawingManager.set('circleOptions', circleOptions);

    var polygonOptions = drawingManager.get('polygonOptions');
    polygonOptions.fillColor = color;
    drawingManager.set('polygonOptions', polygonOptions);
}

function deletePlacesSearchResults() {
    for (var i = 0, marker; marker = placeMarkers[i]; i++) {
        marker.setMap(null);
    }
    placeMarkers = [];
    input.value = '';
}

function mostrarCapa(capa,id,tipo,coordenadas,nombre){
    $.getJSON('php/data_layer_propiedades.php',{'id':id,'tipo':tipo,'coordenadas':coordenadas,'nombre':nombre},function(data){
        features[capa] = map.data.addGeoJson(data);
    });

    //OBTENCIÓN DE LAS PROPIEDADES PARA APLICARLAS A LAS FORMAS DEL DATA LAYER
    map.data.setStyle(function(feature){
        return {title:feature.getProperty('title'), icon:feature.getProperty('icon'), strokeColor:feature.getProperty('stroke'), strokeWeight:feature.getProperty('stroke-width'), fillColor:feature.getProperty('fill'), fillOpacity:feature.getProperty('fill-opacity'), clickable:feature.getProperty('clickable')};
     });

    //EVENTO PARA MOSTRAR LA VENTANA DE INFORMACIÓN AL HACER CLICK SOBRE ALGÚN PUNTO DE LAS CAPAS DE INFORMACIÓN
      map.data.addListener('click', function(event) {
          var myInfoPopUp = event.feature.getProperty("info");
          infowindow1.setContent(myInfoPopUp);
          infowindow1.setPosition(event.latLng);
          infowindow1.setOptions({pixelOffset: new google.maps.Size(0,0)});
          infowindow1.open(map);
      });

}

//funciones de Formato
function frmNumerico_(elemento,tipo){
  if(tipo == 1) $('#' + elemento).inputmask({ alias : "currency", prefix: '' });
  else $('.' + elemento).inputmask({ alias : "currency", prefix: '' });
}

function movil(elemento,cerrar){
  $('#' + elemento).boxWidget({
    animationSpeed: 500,
    collapseTrigger: cerrar,
    //removeTrigger: '#my-remove-button-trigger',
    collapseIcon: 'fa-minus',
    expandIcon: 'fa-plus',
    removeIcon: 'fa-times'
  });
}

//galeria de IMAGENES
function GalleryI(elemento,tipo,imagenes){
  
  if(tipo == 1){
    $("#" + elemento).magnificPopup({
      items:imagenes,
      gallery: {
        enabled: true
      },
      type: 'image' // this is a default type
    });
  }
  else{
    $("." + elemento).magnificPopup({
      items:imagenes,
      gallery: {
        enabled: true
      },
      type: 'image' // this is a default type
    });
  }
}

function dateControl(elemento){
    $('#' + elemento).daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        minYear: 1901,
        maxYear: parseInt(moment().format('YYYY'),10),
        locale: {
          format: 'DD/MM/YYYY'
        }
    }
);

}

// fin funciones Marco Molina
