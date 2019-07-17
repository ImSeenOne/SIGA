<?php
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	date_default_timezone_set('America/Mexico_City');
	@session_start();
	if(isset($_SESSION['autentificado_siga']) && $_SESSION['autentificado_siga'] == md5('adminSys_siga')){

	}
	//++++++++++++++++++++++++++++++++++++++++++++++++++++++
	require ("clase_variables.php");
	require ("clase_mysql.php");
	require ("clase_funciones.php");
	require ("clase_querys.php");
	//++++++++++++++++++++++++++++++++++++++++++++++++++++++
	$funciones = new Funciones(1);
	$conexion  = new DB_mysql(1);
	$querys    = new Querys();
	//++++++++++++++++++++++++++++++++++++++++++++++++++++++
	$datos       = array(); $jsondata = array();
	$datos['fecha_actual'] = date("Y-m-d H:i:s");
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++

switch($_POST['opt']){
	case 201: //ELIMINAR UNA IMAGEN DEL CATÁLOGO DE ESTACIONAMIENTO
		$id   = $funciones->limpia($_POST['id']);
		$icono= $_POST['icono'];

		if($conexion->consulta($querys->eliminaCloset($id, $datos['fecha_actual'])) == 0){
			$jsondata['resp'] = 0;
		}else{
			$jsondata['resp'] = 1;
			if(unlink('../'.$icono) == false){
				$jsondata['resp'] = 2;
			}
		}
	break;

	case 202: //OPCIÓN PARA ELIMINAR UN REGITRO DEL CATÁLOGO DE NÚMERO DE BAÑOS
		$id   = $funciones->limpia($_POST['id']);
		$icono= $_POST['icono'];

		if($conexion->consulta($querys->eliminaRegWc($id, $datos['fecha_actual'])) == 0){
			$jsondata['resp'] = 0;
		}else{
			$jsondata['resp'] = 1;
			if(unlink('../'.$icono) == false){
				$jsondata['resp'] = 2;
			}
		}
	break;

	case 203: //OPCIÓN PARA ELIMINAR UN REGITRO DEL CATÁLOGO DE SERVICIO Y AMENIDADES
		$id   = $funciones->limpia($_POST['id']);
		$icono= $_POST['icono'];

		if($conexion->consulta($querys->eliminaServAmenidad($id, $datos['fecha_actual'])) == 0){
			$jsondata['resp'] = 0;
		}else{
			$jsondata['resp'] = 1;
			if(unlink('../'.$icono) == false){
				$jsondata['resp'] = 2;
			}
		}
	break;

	case 204: //OPCIÓN PARA ELIMINAR UN REGITRO DEL CATÁLOGO DE CLIENTES
		$id   = $funciones->limpia($_POST['id']);		
		if($conexion->consulta($querys->eliminaCliente($id, $datos['fecha_actual'])) == 0){
			$jsondata['resp'] = 0;
		}else{
			$jsondata['resp'] = 1;
		}
	break;

	case 205: //OPCIÓN PARA ELIMINAR UN REGITRO DEL CATÁLOGO DE ARCHIVOS PERSONALES DE UN CLIENTE
		$id   = $funciones->limpia($_POST['id']);
		if($conexion->consulta($querys->eliminaArchivoCte($id, $datos['fecha_actual'])) == 0){
			$jsondata['resp'] = 0;
		}else{
			$jsondata['resp'] = 1;
		}
	break;

	case 206: //OPCIÓN PARA ELIMINAR UN REGITRO DEL CATÁLOGO DE ARCHIVOS PERSONALES DE UN CLIENTE
		$id   = $funciones->limpia($_POST['id']);
		if($conexion->consulta($querys->eliminaReferenciaCte($id, $datos['fecha_actual'])) == 0){
			$jsondata['resp'] = 0;
		}else{
			$jsondata['resp'] = 1;
		}
	break;

	case 207: //OPCIÓN PARA ELIMINAR UN REGITRO DE ORDEN DE COMPRA
		$id   = $funciones->limpia($_POST['id']);
		if($conexion->consulta($querys->eliminaInteresCte($id, $datos['fecha_actual'])) == 0){
			$jsondata['resp'] = 0;
		}else{
			$jsondata['resp'] = 1;
		}
	break;

	case 208: //OPCIÓN PARA ELIMINAR UN REGITRO DEL CATÁLOGO DE ARCHIVOS PERSONALES DE UN CLIENTE		
		$id   = $funciones->limpia($_POST['id']);		
		if($conexion->consulta($querys->eliminaOrdenCompra($id, $datos['fecha_actual'])) == 0){
			$jsondata['resp'] = 0;
		}else{
			$jsondata['resp'] = 1;
		}
	break;

	case 209: //OPCIÓN PARA ELIMINAR UN REGITRO DEL CATÁLOGO DE ARCHIVOS PERSONALES DE UN CLIENTE		
		$id   = $funciones->limpia($_POST['id']);		
		if($conexion->consulta($querys->eliminaArticuloOrdComp($id, $datos['fecha_actual'])) == 0){
			$jsondata['resp'] = 0;
		}else{
			$jsondata['resp'] = 1;
		}
	break;

	case 210: //OPCIÓN PARA ELIMINAR UNA COTIZACIÓN DE UNA ORDEN DE COMPRA		
		$id   = $funciones->limpia($_POST['id']);
		if($conexion->consulta($querys->eliminaCotizacion($id, $datos['fecha_actual'])) == 0){
			$jsondata['resp'] = 0;
		}else{
			$jsondata['resp'] = 1;
		}
	break;
}

header('Content-type: application/json; charset=utf-8');
echo json_encode($jsondata);
?>
