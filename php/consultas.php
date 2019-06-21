<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
header('Content-type: application/json; charset=utf-8');
require 'inicializandoDatosExterno.php';

$datos = array(); $jsondata = array();

switch($_POST['opt']){
	case 1:
		$id = $funciones->limpia($_POST['id']);
		$resp = @$conexion->fetch_array($querys->getListadoDesarrollo($id));

		$jsondata['id_desarrollo'] = $resp['id_desarrollo'];
		$jsondata['nombre'] = $resp['nombre'];
		$jsondata['alias'] = $resp['alias'];
		$jsondata['codigo_postal'] = $resp['codigo_postal'];
		$jsondata['icono']  = $resp['icono'];
	break;
	case 201: //OPCIÓN PARA CARGAR EL LISTADO DE ESTADOS
		$id   = $funciones->limpia($_POST['id']);
		$resp = @$conexion->fetch_array($querys->getListadoEstacionamiento($id));

		$jsondata['id_estacionamiento'] = $resp['id_estacionamiento'];
		$jsondata['nombre'] = $resp['nombre'];
		$jsondata['icono']  = $resp['icono'];

	break;
}

echo json_encode($jsondata);
?>
