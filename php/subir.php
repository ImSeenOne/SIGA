<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
date_default_timezone_set('America/Mexico_City');
@session_start();

require_once("clase_variables.php");
require_once("clase_mysql.php");
include_once("clase_querys.php");
include_once("clase_funciones.php");
include_once("clase_upload.php");

$funciones = new Funciones();
$conexion  = new DB_mysql(1);
$querys    = new Querys();
$upload    = new upload();


$datos = array(); $jsondata = array();
$datos['fecha_actual'] = date("Y-m-d H:i:s");

switch($_POST['opcion']){
	case 201: //OPCIÓN PARA AGREGAR UN REGISTRO A LA TABLA DE ESTACIONAMIENTO
		$nombre = $funciones->limpia($_POST['txtNombre']);

		if(isset($_FILES["flIcono"]["tmp_name"]) and $_FILES["flIcono"]["tmp_name"] != ""){
				if($upload->load("flIcono") === false){
					echo '<script languaje="javascript">
							parent.msg_alerta_default("ERROR! Formato de archivo no permitido...","Notificación!!","'.$upload->msj_error.'");
						  </script>';
					exit(0);
				}
				$archivo = "archivos/closets/".$upload->nombre_final;
				$upload->setisimage(false);
				if($upload->save('../'.$archivo) === false){
					echo '<script languaje="javascript">
							parent.msg_alerta_default("ERROR! Fallo al guardar el archivo: '.$archivo.'...","Notificación!!","'.$upload->msj_error.'");
						  </script>';
					exit(0);
				}
				$datos['flIcono'] = $archivo;
		}else{
				$datos['flIcono'] = null;
		}

		if($conexion->consulta($querys->addCloset($nombre, $datos['flIcono'], $datos['fecha_actual'])) == 0){
			$jsondata['resp'] = 0;
		}else{
			$jsondata['resp'] = 1;
		}

		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata);
	break;

	case 202: //OPCIÓN PARA ACTUALIZAR EL REGISTRO DEL CATÁLOGO ESTACIONAMIENTO
		$id     = $funciones->limpia($_POST['idCloset']);
		$nombre = $funciones->limpia($_POST['txtNombre']);

		if(isset($_FILES["flIcono"]["tmp_name"]) and $_FILES["flIcono"]["tmp_name"] != ""){
				if($upload->load("flIcono") === false){
					echo '<script languaje="javascript">
							parent.msg_alerta_default("ERROR! Formato de archivo no permitido...","Notificación!!","'.$upload->msj_error.'");
						  </script>';
					exit(0);
				}
				$archivo = "archivos/closets/".$upload->nombre_final;
				$upload->setisimage(false);
				if($upload->save('../'.$archivo) === false){
					echo '<script languaje="javascript">
							parent.msg_alerta_default("ERROR! Fallo al guardar el archivo: '.$archivo.'...","Notificación!!","'.$upload->msj_error.'");
						  </script>';
					exit(0);
				}
				$datos['flIcono'] = $archivo;
		}else{
				$datos['flIcono'] = $_POST['hdFlIcono'];
		}
		
		if($conexion->consulta($querys->updateCloset($id, $nombre, $datos['flIcono'])) == 0){
			$jsondata['resp'] = 0;
		}else{
			$jsondata['resp'] = 1;
		}

		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata);
	break;

	case 203: //OPCIÓN PARA GUARDAR UN REGISTRO EN EL CATÁLOGO tblc_num_banios
		$nombre = $funciones->limpia($_POST['txtNombre']);

		if(isset($_FILES["flIcono"]["tmp_name"]) and $_FILES["flIcono"]["tmp_name"] != ""){
				if($upload->load("flIcono") === false){
					echo '<script languaje="javascript">
							parent.msg_alerta_default("ERROR! Formato de archivo no permitido...","Notificación!!","'.$upload->msj_error.'");
						  </script>';
					exit(0);
				}
				$archivo = "archivos/banios/".$upload->nombre_final;
				$upload->setisimage(false);
				if($upload->save('../'.$archivo) === false){
					echo '<script languaje="javascript">
							parent.msg_alerta_default("ERROR! Fallo al guardar el archivo: '.$archivo.'...","Notificación!!","'.$upload->msj_error.'");
						  </script>';
					exit(0);
				}
				$datos['flIcono'] = $archivo;
		}else{
				$datos['flIcono'] = null;
		}

		if($conexion->consulta($querys->addCatWc($nombre, $datos['flIcono'], $datos['fecha_actual'])) == 0){
			$jsondata['resp'] = 0;
		}else{
			$jsondata['resp'] = 1;
		}

		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata);
	break;


	case 204: //OPCIÓN PARA ACTUALIZAR EL REGISTRO DEL CATÁLOGO NÚMERO DE BAÑOS
		$id     = $funciones->limpia($_POST['idWc']);
		$nombre = $funciones->limpia($_POST['txtNombre']);

		if(isset($_FILES["flIcono"]["tmp_name"]) and $_FILES["flIcono"]["tmp_name"] != ""){
				if($upload->load("flIcono") === false){
					echo '<script languaje="javascript">
							parent.msg_alerta_default("ERROR! Formato de archivo no permitido...","Notificación!!","'.$upload->msj_error.'");
						  </script>';
					exit(0);
				}
				$archivo = "archivos/banios/".$upload->nombre_final;
				$upload->setisimage(false);
				if($upload->save('../'.$archivo) === false){
					echo '<script languaje="javascript">
							parent.msg_alerta_default("ERROR! Fallo al guardar el archivo: '.$archivo.'...","Notificación!!","'.$upload->msj_error.'");
						  </script>';
					exit(0);
				}
				$datos['flIcono'] = $archivo;
		}else{
				$datos['flIcono'] = $_POST['hdFlIcono'];
		}

		if($conexion->consulta($querys->updateCatWc($id, $nombre, $datos['flIcono'])) == 0){
			$jsondata['resp'] = 0;
		}else{
			$jsondata['resp'] = 1;
		}

		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata);
	break;

	case 205: //OPCIÓN PARA GUARDAR UN REGISTRO EN EL CATÁLOGO SERVICIOS/AMENIDADES
		$nombre = $funciones->limpia($_POST['txtNombre']);

		if(isset($_FILES["flIcono"]["tmp_name"]) and $_FILES["flIcono"]["tmp_name"] != ""){
				if($upload->load("flIcono") === false){
					echo '<script languaje="javascript">
							parent.msg_alerta_default("ERROR! Formato de archivo no permitido...","Notificación!!","'.$upload->msj_error.'");
						  </script>';
					exit(0);
				}
				$archivo = "archivos/amenidades/".$upload->nombre_final;
				$upload->setisimage(false);
				if($upload->save('../'.$archivo) === false){
					echo '<script languaje="javascript">
							parent.msg_alerta_default("ERROR! Fallo al guardar el archivo: '.$archivo.'...","Notificación!!","'.$upload->msj_error.'");
						  </script>';
					exit(0);
				}
				$datos['flIcono'] = $archivo;
		}else{
				$datos['flIcono'] = null;
		}

		if($conexion->consulta($querys->addServAmenidad($nombre, $datos['flIcono'], $datos['fecha_actual'])) == 0){
			$jsondata['resp'] = 0;
		}else{
			$jsondata['resp'] = 1;
		}

		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata);
	break;

	case 206: //OPCIÓN PARA ACTUALIZAR EL REGISTRO DEL CATÁLOGO AMENIDADES
		$id     = $funciones->limpia($_POST['idServAmenidad']);
		$nombre = $funciones->limpia($_POST['txtNombre']);

		if(isset($_FILES["flIcono"]["tmp_name"]) and $_FILES["flIcono"]["tmp_name"] != ""){
				if($upload->load("flIcono") === false){
					echo '<script languaje="javascript">
							parent.msg_alerta_default("ERROR! Formato de archivo no permitido...","Notificación!!","'.$upload->msj_error.'");
						  </script>';
					exit(0);
				}
				$archivo = "archivos/amenidades/".$upload->nombre_final;
				$upload->setisimage(false);
				if($upload->save('../'.$archivo) === false){
					echo '<script languaje="javascript">
							parent.msg_alerta_default("ERROR! Fallo al guardar el archivo: '.$archivo.'...","Notificación!!","'.$upload->msj_error.'");
						  </script>';
					exit(0);
				}
				$datos['flIcono'] = $archivo;
		}else{
				$datos['flIcono'] = $_POST['hdFlIcono'];
		}

		if($conexion->consulta($querys->updateServAmenidad($id, $nombre, $datos['flIcono'])) == 0){
			$jsondata['resp'] = 0;
		}else{
			$jsondata['resp'] = 1;
		}

		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata);
	break;

	case 207: //OPCIÓN PARA REGISTRAR A UN NUEVO CLIENTE		
		$idTipo = $funciones->limpia($_POST['cboTipoCliente']);
		$rfc    = $funciones->limpia($_POST['txtRfc']);
		$nombre = $funciones->limpia($_POST['txtNombre']);
		$apellidoP = $funciones->limpia($_POST['txtApellidoP']);
		$apellidoM = $funciones->limpia($_POST['txtApellidoM']);
		$estadoCivil = $funciones->limpia($_POST['cboEstadoCivil']);
		$domicilio = $funciones->limpia($_POST['txtDomicilio']);
		$correo = $funciones->limpia($_POST['txtCorreo']);
		$telefono  = $funciones->limpia($_POST['txtTelefono']);
		$celular   = (isset($_POST['txtCelular']))? $funciones->limpia($_POST['txtCelular']):'';
		$estaCivil = $funciones->limpia($_POST['cboEstadoCivil']);
		$observaciones = (isset($_POST['txtObservaciones']))? $funciones->limpia($_POST['txtObservaciones']):'';

		if($conexion->consulta($querys->addCliente($idTipo, $nombre, $apellidoP, $apellidoM, $rfc, $correo, $domicilio, $telefono, $celular, $estadoCivil, $observaciones, $datos['fecha_actual'])) == 0){
			$jsondata['resp'] = 0;
		}else{
			$jsondata['resp'] = 1;
		}

		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata);
	break;

	case 208: //OPCIÓN PARA REGISTRAR ACTUALIZAR LOS DATOS DE UN CLIENTE
		$idCliente = $funciones->limpia($_POST['idCliente']);
		$idTipo    = $funciones->limpia($_POST['cboTipoCliente']);
		$rfc       = $funciones->limpia($_POST['txtRfc']);
		$nombre    = $funciones->limpia($_POST['txtNombre']);
		$apellidoP = $funciones->limpia($_POST['txtApellidoP']);
		$apellidoM = $funciones->limpia($_POST['txtApellidoM']);
		$estadoCivil = $funciones->limpia($_POST['cboEstadoCivil']);
		$domicilio = $funciones->limpia($_POST['txtDomicilio']);
		$correo    = $funciones->limpia($_POST['txtCorreo']);
		$telefono  = $funciones->limpia($_POST['txtTelefono']);
		$celular   = (isset($_POST['txtCelular']))? $funciones->limpia($_POST['txtCelular']):'';
		$estaCivil = $funciones->limpia($_POST['cboEstadoCivil']);
		$observaciones = (isset($_POST['txtObservaciones']))? $funciones->limpia($_POST['txtObservaciones']):'';

		if($conexion->consulta($querys->actualizaCliente($idCliente, $idTipo, $nombre, $apellidoP, $apellidoM, $rfc, $correo, $domicilio, $telefono, $celular, $estadoCivil, $observaciones)) == 0){
			$jsondata['resp'] = 0;
		}else{
			$jsondata['resp'] = 1;
		}

		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata);
	break;


	case 209: //OPCIÓN PARA AGREGAR UN REGISTRO A LA TABLA ARCHIVOS DEL CLIENTE
		$id          = $funciones->limpia($_POST['idClienteArchivo']);
		$descripcion = $funciones->limpia($_POST['txtDescripcion']);

		if(isset($_FILES["flArchivo"]["tmp_name"]) and $_FILES["flArchivo"]["tmp_name"] != ""){
				if($upload->load("flArchivo") === false){
					echo '<script languaje="javascript">
							parent.msg_alerta_default("ERROR! Formato de archivo no permitido...","Notificación!!","'.$upload->msj_error.'");
						  </script>';
					exit(0);
				}
				$archivo = "archivos/archivos_clientes/".$upload->nombre_final;
				$upload->setisimage(false);
				if($upload->save('../'.$archivo) === false){
					echo '<script languaje="javascript">
							parent.msg_alerta_default("ERROR! Fallo al guardar el archivo: '.$archivo.'...","Notificación!!","'.$upload->msj_error.'");
						  </script>';
					exit(0);
				}
				$datos['flArchivo'] = $archivo;
		}else{
				$jsondata['resp'] = 2;
				header('Content-type: application/json; charset=utf-8');
				echo json_encode($jsondata);
				exit();
		}

		if($conexion->consulta($querys->addArchivoCte($id, $datos['flArchivo'], $descripcion, $datos['fecha_actual'])) == 0){
			$jsondata['resp'] = 0;
		}else{
			$jsondata['resp'] = 1;
		}

		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata);
	break;

	case 210: //OPCIÓN PARA ACTUALIZAR LOS DATOS DE UN ARCHIVO PERSONAL DE UN CLIENTE
		$idCliente   = $funciones->limpia($_POST['idClienteArchivo']);
		$idArchivo   = $funciones->limpia($_POST['idArchivo']);
		$descripcion = $funciones->limpia($_POST['txtDescripcion']);

		if(isset($_FILES["flArchivo"]["tmp_name"]) and $_FILES["flArchivo"]["tmp_name"] != ""){
				if($upload->load("flArchivo") === false){
					echo '<script languaje="javascript">
							parent.msg_alerta_default("ERROR! Formato de archivo no permitido...","Notificación!!","'.$upload->msj_error.'");
						  </script>';
					exit(0);
				}
				$archivo = "archivos/archivos_clientes/".$upload->nombre_final;
				$upload->setisimage(false);
				if($upload->save('../'.$archivo) === false){
					echo '<script languaje="javascript">
							parent.msg_alerta_default("ERROR! Fallo al guardar el archivo: '.$archivo.'...","Notificación!!","'.$upload->msj_error.'");
						  </script>';
					exit(0);
				}
				$datos['flArchivo'] = $archivo;
		}else{
				$datos['flArchivo'] = $_POST['hdFlArchivo'];
		}

		if($conexion->consulta($querys->actualizaArchivoCte($idCliente, $idArchivo, $datos['flArchivo'], $descripcion)) == 0){
			$jsondata['resp'] = 0;
		}else{
			$jsondata['resp'] = 1;
		}

		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata);
	break;

	case 211: //OPCIÓN PARA REGISTRAR UNA REFERENCIA A UN CLIENTE
		$idCliente = $funciones->limpia($_POST['idClienteRef']);		
		$idTipoRef = $funciones->limpia($_POST['cboTipoRef']);		
		$nombre    = $funciones->limpia($_POST['txtNombreRef']);
		$apellidoP = $funciones->limpia($_POST['txtApellidoPRef']);
		$apellidoM = $funciones->limpia($_POST['txtApellidoMRef']);		
		$domicilio = $funciones->limpia($_POST['txtDireccionRef']);				
		$telefono  = (isset($_POST['txtTelefonoRef']))? $funciones->limpia($_POST['txtTelefonoRef']):'';

		if($conexion->consulta($querys->addRefenciaCte($idCliente, $idTipoRef, $nombre, $apellidoP, $apellidoM, $domicilio, $telefono, $datos['fecha_actual'])) == 0){
			$jsondata['resp'] = 0;
		}else{
			$jsondata['resp'] = 1;
		}

		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata);
	break;

	case 212: //OPCIÓN PARA ACTUALIZAR UNA REFERENCIA A UN CLIENTE		
		$idCliente = $funciones->limpia($_POST['idClienteRef']);
		$idReferencia = $funciones->limpia($_POST['idReferencia']);
		$idTipoRef = $funciones->limpia($_POST['cboTipoRef']);
		$nombre    = $funciones->limpia($_POST['txtNombreRef']);
		$apellidoP = $funciones->limpia($_POST['txtApellidoPRef']);
		$apellidoM = $funciones->limpia($_POST['txtApellidoMRef']);		
		$domicilio = $funciones->limpia($_POST['txtDireccionRef']);
		$telefono  = (isset($_POST['txtTelefonoRef']))? $funciones->limpia($_POST['txtTelefonoRef']):'';

		if($conexion->consulta($querys->actualizaReferenciaCte($idCliente, $idReferencia, $idTipoRef, $nombre, $apellidoP, $apellidoM, $domicilio, $telefono)) == 0){
			$jsondata['resp'] = 0;
		}else{
			$jsondata['resp'] = 1;
		}

		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata);
	break;

	case 213: //OPCIÓN PARA AGREGAR UNA PROPIEDAD AL INTERES DE UN CLIENTE		
		$idCliente   = $funciones->limpia($_POST['idClienteInt']);
		$idPropiedad = $funciones->limpia($_POST['cboPropiedad']);
		$idUsuario   = 0;
		$agente      = $funciones->limpia($_POST['txtAgente']);
		$monto       = (isset($_POST['txtMonto']) && $_POST['txtMonto'] != '')? $funciones->limpia($_POST['txtMonto']):0;
		$idEstatus   = $funciones->limpia($_POST['cboEstatusInt']);
		
		if($conexion->consulta($querys->addInteresPropiedad($idCliente, $idPropiedad, $idUsuario, $agente, $monto, $idEstatus, $datos['fecha_actual'])) == 0){
			$jsondata['resp'] = 0;
		}else{
			$jsondata['resp'] = 1;
		}

		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata);
	break;

	case 214: //OPCIÓN PARA ACTUALIZAR UNA PROPIEDAD AL INTERES DE UN CLIENTE		
		$idCliente   = $funciones->limpia($_POST['idClienteInt']);
		$idInteres   = $funciones->limpia($_POST['idInteres']);
		$idPropiedad = $funciones->limpia($_POST['cboPropiedad']);
		$idUsuario   = 0;
		$agente      = $funciones->limpia($_POST['txtAgente']);
		$fechaFirma  = (isset($_POST['txtFechaFirma']))? $funciones->limpia($_POST['txtFechaFirma']):'';
		$fechaEntrega= (isset($_POST['txtFechaEntrega']))? $funciones->limpia($_POST['txtFechaEntrega']):'';
		$monto       = (isset($_POST['txtMonto']) && $_POST['txtMonto'] != '')? $funciones->limpia($_POST['txtMonto']):0;
		$idEstatus   = $funciones->limpia($_POST['cboEstatusInt']);
		
		if($conexion->consulta($querys->actualizaInteres($idCliente, $idInteres, $idPropiedad, $idUsuario, $agente, $fechaFirma, $fechaEntrega, $monto, $idEstatus)) == 0){
			$jsondata['resp'] = 0;
		}else{
			$jsondata['resp'] = 1;
		}

		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata);
	break;

	case 215: //OPCIÓN PARA GUARDAR UNA ORDEN DE COMPRA		
		$folio         = $funciones->limpia($_POST['txtFolio']);
		$idObra        = $funciones->limpia($_POST['cboObra']);
		$idEmpresa     = $funciones->limpia($_POST['cboEmpresa']);
		$direccionObra = $funciones->limpia($_POST['txtDireccionObra']);
		$fechaCaptura  = $funciones->limpia($_POST['txtFechaCapt']);
		$residente     = $funciones->limpia($_POST['txtResidente']);
		$idTipoCompra  = $funciones->limpia($_POST['cboTipoComp']);
		$estatus       = $funciones->limpia($_POST['cboEstatus']);
		
		if($conexion->consulta($querys->addOrdenCompra($folio, $idObra, $idEmpresa, $direccionObra, $fechaCaptura, $datos['fecha_actual'], $residente, $idTipoCompra, $estatus)) == 0){
			$jsondata['resp'] = 0;
		}else{
			$jsondata['resp'] = 1;
		}

		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata);
	break;

	case 216: //OPCIÓN PARA ACTUALIZAR LOS DATOS DE UNA ORDEN DE COMPRA
		$idOrdenComp   = $funciones->limpia($_POST['idOrdenComp']);
		$folio         = $funciones->limpia($_POST['txtFolio']);
		$idObra        = $funciones->limpia($_POST['cboObra']);
		$idEmpresa     = $funciones->limpia($_POST['cboEmpresa']);
		$direccionObra = $funciones->limpia($_POST['txtDireccionObra']);
		$fechaCaptura  = $funciones->limpia($_POST['txtFechaCapt']);
		$residente     = $funciones->limpia($_POST['txtResidente']);
		$idTipoCompra  = $funciones->limpia($_POST['cboTipoComp']);
		$estatus       = $funciones->limpia($_POST['cboEstatus']);
		
		if($conexion->consulta($querys->actualizarOrdenComp($idOrdenComp, $folio, $idObra, $idEmpresa, $direccionObra, $fechaCaptura, $residente, $idTipoCompra, $estatus)) == 0){
			$jsondata['resp'] = 0;
		}else{
			$jsondata['resp'] = 1;
		}

		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata);
	break;

	case 217: //OPCIÓN PARA AGREGAR UN ARTÍCULO A LA ORDEN DE COMPRA
		$idOrdenComp = $funciones->limpia($_POST['idOrdComp']);
		$articulo    = $funciones->limpia($_POST['txtArticulo']);
		$unidad      = $funciones->limpia($_POST['txtUnidad']);
		$cantidad    = $funciones->limpia($_POST['txtCantidad']);
		$costo       = $funciones->limpia($_POST['txtCosto']);
		
		if($conexion->consulta($querys->addArticuloOrdComp($idOrdenComp, $articulo, $unidad, $cantidad, $costo, $datos['fecha_actual'])) == 0){
			$jsondata['resp'] = 0;
		}else{
			$jsondata['resp'] = 1;
		}

		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata);
	break;

	case 218:
		$idArticulo = $funciones->limpia($_POST['idArticulo']);
		$articulo   = $funciones->limpia($_POST['txtArticulo']);
		$unidad     = $funciones->limpia($_POST['txtUnidad']);
		$cantidad   = $funciones->limpia($_POST['txtCantidad']);
		$costo      = $funciones->limpia($_POST['txtCosto']);
		
		if($conexion->consulta($querys->actualizaArtOrdComp($idArticulo, $articulo, $unidad, $cantidad, $costo)) == 0){
			$jsondata['resp'] = 0;
		}else{
			$jsondata['resp'] = 1;
		}

		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata);
	break;

	case 219: //OPCIÓN PARA GUARDAR UNA COTIZACIÓN
		$idOrdenComp   = $funciones->limpia($_POST['idOrdCompCot']);
		$idProveedor   = $funciones->limpia($_POST['cboProveedor']);
		$numCuenta     = $funciones->limpia($_POST['txtCuenta']);
		$monto         = $funciones->limpia($_POST['txtMonto']);
		$observaciones = (isset($_POST['txtObservaciones']))? $funciones->limpia($_POST['txtObservaciones']):'';

		if(isset($_FILES["flImagen"]["tmp_name"]) and $_FILES["flImagen"]["tmp_name"] != ""){
				if($upload->load("flImagen") === false){
					echo '<script languaje="javascript">
							parent.msg_alerta_default("ERROR! Formato de archivo no permitido...","Notificación!!","'.$upload->msj_error.'");
						  </script>';
					exit(0);
				}
				$archivo = "archivos/cotizaciones/".$upload->nombre_final;
				$upload->setisimage(false);
				if($upload->save('../'.$archivo) === false){
					echo '<script languaje="javascript">
							parent.msg_alerta_default("ERROR! Fallo al guardar el archivo: '.$archivo.'...","Notificación!!","'.$upload->msj_error.'");
						  </script>';
					exit(0);
				}
				$datos['flImagen'] = $archivo;
		}else{
				//$datos['flImagen'] = $_POST['hdFlArchivo'];
				$jsondata['resp'] = 2;
				header('Content-type: application/json; charset=utf-8');
				echo json_encode($jsondata);
				exit();

		}
		
		if($conexion->consulta($querys->addCotizacion($idOrdenComp, $idProveedor, $numCuenta, $monto, $datos['flImagen'], $observaciones, $datos['fecha_actual'])) == 0){
			$jsondata['resp'] = 0;
		}else{
			$jsondata['resp'] = 1;
		}

		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata);
	break;

	case 220: //OPCIÓN PARA ACTUALIZAR LOS DATOS DE UNA COTIZACIÓN
		$idOrdenComp   = $funciones->limpia($_POST['idOrdCompCot']);
		$idCotizacion   = $funciones->limpia($_POST['idCotizacion']);
		$idProveedor   = $funciones->limpia($_POST['cboProveedor']);
		$numCuenta     = $funciones->limpia($_POST['txtCuenta']);
		$monto         = $funciones->limpia($_POST['txtMonto']);
		$observaciones = (isset($_POST['txtObservaciones']))? $funciones->limpia($_POST['txtObservaciones']):'';

		if(isset($_FILES["flImagen"]["tmp_name"]) and $_FILES["flImagen"]["tmp_name"] != ""){
				if($upload->load("flImagen") === false){
					echo '<script languaje="javascript">
							parent.msg_alerta_default("ERROR! Formato de archivo no permitido...","Notificación!!","'.$upload->msj_error.'");
						  </script>';
					exit(0);
				}
				$archivo = "archivos/cotizaciones/".$upload->nombre_final;
				$upload->setisimage(false);
				if($upload->save('../'.$archivo) === false){
					echo '<script languaje="javascript">
							parent.msg_alerta_default("ERROR! Fallo al guardar el archivo: '.$archivo.'...","Notificación!!","'.$upload->msj_error.'");
						  </script>';
					exit(0);
				}
				$datos['flImagen'] = $archivo;
		}else{
				$datos['flImagen'] = $_POST['hdFlImagen'];
		}
		
		if($conexion->consulta($querys->actualizaCotizacion($idOrdenComp, $idCotizacion, $idProveedor, $numCuenta, $monto, $datos['flImagen'], $observaciones)) == 0){
			$jsondata['resp'] = 0;
		}else{
			$jsondata['resp'] = 1;
		}

		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata);
	break;

	case 221: //OPCIÓN PARA MARCAR CÓMO AUTORIZADA UNA COTIZACIÓN
		$idCotizacion = $funciones->limpia($_POST['idCotizacion']);

		if($conexion->consulta($querys->autorizaCotizacion($idCotizacion)) == 0){
			$jsondata['resp'] = 0;
		}else{
			$jsondata['resp'] = 1;
		}

		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata);
	break;

	case 222: //OPCIÓN PARA MARCAR CÓMO AUTORIZADA UNA COTIZACIÓN
		$idInteres    = $funciones->limpia($_POST['idServPV']);
		$folio        = $funciones->limpia($_POST['txtFolioPV'.$idInteres]);
		$fechaCaptura = $funciones->limpia($_POST['txtFechaPV'.$idInteres]);
		$motivo       = $funciones->limpia($_POST['cboMotivoPV'.$idInteres]);
		$descripcion  = (isset($_POST['txtDescripcion'.$idInteres]))? $funciones->limpia($_POST['txtDescripcion'.$idInteres]):'';
		$estatus      = $funciones->limpia($_POST['cboEstatus'.$idInteres]);
		//exit($querys->addServPV($idInteres, $folio, $motivo, $descripcion, $estatus, $fechaCaptura, $datos['fecha_actual']));
		if($conexion->consulta($querys->addServPV($idInteres, $folio, $motivo, $descripcion, $estatus, $fechaCaptura, $datos['fecha_actual'])) == 0){
			$jsondata['resp'] = 0;
		}else{
			$jsondata['resp'] = 1;
		}

		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata);
	break;
}
?>