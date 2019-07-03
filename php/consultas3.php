<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
header('Content-type: application/json; charset=utf-8');
require 'inicializandoDatosExterno.php';

$datos = array(); $jsondata = array();

switch($_POST['opt']){
	case 1:
		$id = $funciones->limpia($_POST['id']);
		$resp = @$conexion->fetch_array($querys3->getListadoDesarrollo($id));

		$jsondata['id_desarrollo'] = $resp['id_desarrollo'];
		$jsondata['nombre'] = $resp['nombre'];
		$jsondata['alias'] = $resp['alias'];
		$jsondata['codigo_postal'] = $resp['codigo_postal'];
		$jsondata['icono']  = $resp['icono'];
	break;

	case 2:
		$id = $funciones->limpia($_POST['id']);
		$resp = @$conexion->fetch_array($querys3->getListadoObras($id));

		$fechaini = explode("-",$resp['fecha_inicio']);
		$fechafin = explode("-",$resp['fecha_finalizacion']);

		$jsondata['id_obra'] = $resp['id_obras'];
		$jsondata['nombre'] = $resp['nombre'];
		$jsondata['tipo'] = $resp['tipo'];
		$jsondata['dependencia'] = $resp['dependencia'];
		$jsondata['monto'] = $resp['monto'];
		$jsondata['fecha_inicio'] = $fechaini[2]."-".$fechaini[1]."-".$fechaini[0];
		$jsondata['fecha_finalizacion'] = $fechafin[2]."-".$fechafin[1]."-".$fechafin[0];
		$jsondata['volumenes_carpeta'] = $resp['volumenes_carpeta'];
		$jsondata['tipo_agregado'] = $resp['tipo_agregado'];
		$jsondata['volumen_concreto'] = $resp['volumen_concreto'];
		$jsondata['area_obra'] = $resp['area_obra'];
	break;

	case 3:
		$id = $funciones->limpia($_POST['id']);
		$resp = @$conexion->fetch_array($querys3->getListadoSeguimiento($id));

		$jsondata['id_seg_est'] = $resp['id_seg_est'];
		$jsondata['nombre_obra'] = $resp['nombre_obra'];
		$jsondata['monto'] = $resp['monto'];
		$jsondata['avance_fisico'] = $resp['avance_fisico'];
		$jsondata['numero_estimacion'] = $resp['numero_estimacion'];
		$jsondata['fecha_inicio'] = $resp['fecha_inicio'];
		$jsondata['fecha_finalizacion'] = $resp['fecha_finalizacion'];
		$jsondata['status'] = $resp['status'];
		$jsondata['imagen'] = $resp['imagen'];
	break;

	case 4:
		$id = $funciones->limpia($_POST['id']);
		$resp = @$conexion->fetch_array($querys3->getListadoAntiguedad($id));

		$jsondata['nombre'] = $resp['nombre'];
		$jsondata['icono'] = $resp['icono'];
	break;

	case 5:
		$id = $funciones->limpia($_POST['id']);
		$resp = @$conexion->fetch_array($querys3->getEmpleadosById($id));

		$fechaadmi = explode("-",$resp['fecha_admision']);

		$jsondata['id_empleado'] = $resp['id_empleado'];
		$jsondata['nombre'] = $resp['nombre'];
		$jsondata['apellido_paterno'] = $resp['apellido_paterno'];
		$jsondata['apellido_materno'] = $resp['apellido_materno'];
		$jsondata['direccion'] = $resp['direccion'];
		$jsondata['rfc'] = $resp['rfc'];
		$jsondata['imss'] = $resp['imss'];
		$jsondata['curp'] = $resp['curp'];
		$jsondata['fecha_admision'] = $fechaadmi[2]."-".$fechaadmi[1]."-".$fechaadmi[0];
		$jsondata['tipo'] = $resp['tipo'];
		$jsondata['estado_civil'] = $resp['estado_civil'];
		$jsondata['genero'] = $resp['genero'];
		$jsondata['categoria'] = $resp['categoria'];
		$jsondata['departamento'] = $resp['departamento'];
		$jsondata['area'] = $resp['area'];
	break;

	case 6:
		$id = $funciones->limpia($_POST['id']);
		$resp = @$conexion->fetch_array($querys3->getListadoAntiguedad($id));

		$jsondata['id_antiguedad'] = $resp['id_antiguedad'];
		$jsondata['nombre'] = $resp['nombre'];
		$jsondata['icono'] = $resp['icono'];
	break;
}

echo json_encode($jsondata);
?>
