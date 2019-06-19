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
//++++++++++++++++++++++++++++++++++++++++++++++++++++++

switch($_POST['opt']){
	case 1: //ELIMINAR UNA IMAGEN DE LA GALERÍA DE UNA VEHÍCULO					
		$id   = $funciones->limpia($_POST['id']);
		$icono= $_POST['icono'];
		
		if($conexion->consulta($querys->eliminaRegCatEstacionamiento($id, $datos['fecha_actual'])) == 0){
			$jsondata['resp'] = 0;
		}else{
			$jsondata['resp'] = 1;
			if(unlink('../'.$icono) == false){
				$jsondata['resp'] = 2;
			}
		}
		
	break;

	
	

}

header('Content-type: application/json; charset=utf-8');
echo json_encode($jsondata);
?>