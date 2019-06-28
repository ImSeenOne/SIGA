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
	require ("clase_querys3.php");
	//++++++++++++++++++++++++++++++++++++++++++++++++++++++
	$funciones = new Funciones(1);
	$conexion  = new DB_mysql(1);
	$querys    = new Querys3();
	//++++++++++++++++++++++++++++++++++++++++++++++++++++++
	$datos       = array(); $jsondata = array();
	$datos['fecha_actual'] = date("Y-m-d H:i:s");
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++
switch($_POST['opt']){
	case 1: //ELIMINAR UN REGISTRO DE DESARROLLO Y SU RESPECTIVA IMAGEN DE LA GALERÍA DE DESARROLLO
		$id   = $funciones->limpia($_POST['id']);
		$icono= $_POST['icono'];

		if($conexion->consulta($querys->eliminaRegCatDesarrollo($id, $datos['fecha_actual'])) == 0){
			$jsondata['resp'] = 0;
		}else{
			$jsondata['resp'] = 1;
			if(unlink('../'.$icono) == false){
				$jsondata['resp'] = 2;
			}
		}

	break;

	case 2://ELIMINA UN REGISTRO DE OBRAS Y SU RESPECTIVA IMAGEN DE LA GALERÍA DE DESARROLLO
		$id = $funciones->limpia($_POST['id']);

		if($conexion->consulta($querys->eliminarRegObra($id, $datos['fecha_actual'])) == 0){
			$jsondata['resp'] = 0;
		}else{
			$jsondata['resp'] = 1;
		}
	break;

	case 3: //ELIMINA UN REGISTRO DE SEGUIMIENTO DE ESTIMACIONES Y SU RESPECTIVA IMAGEN DE LA GALERÍA DE ESTIMACIONES
		$id   = $funciones->limpia($_POST['id']);
		if(isset($_POST['imagen'])){
			$icono = $_POST['imagen'];
		}

		if($conexion->consulta($querys->eliminarRegSegEst($id, $datos['fecha_actual'])) == 0){
			$jsondata['resp'] = 0;
		}else{
			$jsondata['resp'] = 1;
			if(!empty($icono)) {
				if(unlink('../'.$icono) == false){
					$jsondata['resp'] = 2;
				}
			}
		}
	break;

	case 4:
		$id = $funciones->limpia($_POST['id']);
		if(isset($_POST['icono'])){
			$icono = $_POST['icono'];
		}

		if($conexion->consulta($querys->eliminarAntiguedad($id, $datos['fecha_actual'])) == 0){
			$jsondata['resp'] = 0;
		} else {
			$jsondata['resp'] = 1;
			//verifica si el campo de icono no está vacío
			if(!empty($icono)) {
				//verifica que el icono se pudo eliminar
				if(!unlink('../'.$icono)) {
					$jsondata['resp'] = 2;
				}
			}
		}
	break;
}

header('Content-type: application/json; charset=utf-8');
echo json_encode($jsondata);
?>
