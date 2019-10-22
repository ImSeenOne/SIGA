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
	$idConexion = $_SESSION["idConexion"];
	$conexion  = new DB_MySql($idConexion);
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

	case 2://ELIMINA UN REGISTRO DE OBRAS
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
	//elimina un empleado
	case 5:
		$id = $funciones->limpia($_POST['id']);

		if(@$conexion->consulta($querys->deleteEmpleado($id, $datos['fecha_actual'])) == 0){
			$jsondata['resp'] = 0;
		} else {
			$jsondata['resp'] = 1;
		}
	break;

	case 6:
		$id = $funciones->limpia($_POST['id']);

		if(@$conexion->consulta($querys->deleteContract($id, $datos['fecha_actual'])) == 0){
			$jsondata['resp'] = 0;
		} else {
			$jsondata['resp'] = 1;
				//verifica si el campo de icono no está vacío
				if(isset($_POST['archivo'])) {
					//verifica que el icono se pudo eliminar
					if(!@unlink('../'.$_POST['archivo'])) {
						$jsondata['resp'] = 2;
					}
				}
		}
	break;

	//ELIMINA UN AVANCE FÍSICO/REPORTE DE AVANCES
	case 7:
		$id = $funciones->limpia($_POST['id']);
		if(@$conexion->consulta($querys->deletePhysProg($id, $datos['fecha_actual'])) == 0){
			$jsondata['resp'] = 0;
		} else {
			@$conexion->consulta("UPDATE tbl_avance_fisico_conceptos SET cantidad = 0 WHERE (id_avance_fisico = ".$id.");");
			$jsondata['resp'] = 1;
		}
	break;
	//ELIMINA UN NIVEL
	case 8:
		$id = $funciones->limpia($_POST['id']);
		if(@$conexion->consulta($querys->deleteLevel($id, $datos['fecha_actual'])) == 0){
			$jsondata['resp'] = 0;
		} else {
			$jsondata['resp'] = 1;
		}
	break;
	//ELIMINA UNA EMPRESA
	case 9:
		$id = $funciones->limpia($_POST['id']);
		if(@$conexion->consulta($querys->deleteCompany($id, $datos['fecha_actual'])) == 0){
			$jsondata['resp'] = 0;
		} else {
			$jsondata['resp'] = 1;
		}
	break;
	//ELIMINA UNA LICITACIÓN
	case 10:
		$id = $funciones->limpia($_POST['id']);
		if(@$conexion->consulta($querys->deleteBidding($id, $datos['fecha_actual'])) == 0){
			$jsondata['resp'] = 0;
		} else {
			$jsondata['resp'] = 1;
		}
	break;
	//ELIMINA UN TIPO DE GASTO
	case 11:
		$id = $funciones->limpia($_POST['id']);
		if(@$conexion->consulta($querys->deleteTypeOfExpenses($id, $datos['fecha_actual'])) == 0){
			$jsondata['resp'] = 0;
		} else {
			$jsondata['resp'] = 1;
		}
	break;

	case 12:
		$id = $funciones->limpia($_POST['id']);
		if(@$conexion->consulta($querys->deleteExpense($id)) == 0){
			$jsondata['resp'] = 0;
		} else {
			$jsondata['resp'] = 1;
		}
	break;
	case 13:
		$id = $funciones->limpia($_POST['id']);
		if(@$conexion->consulta($querys->deleteEmployeeCategory($id, $datos['fecha_actual'])) == 0){
			$jsondata['resp'] = 0;
			$jsondata['msg'] = 'Ocurrió un error al intentar eliminar, intente de nuevo más tarde';
		} else {
			$jsondata['resp'] = 1;
		}
	break;
	case 14:
		$id = $funciones->limpia($_POST['id']);
		if(@$conexion->consulta($querys->deleteInsFuelStatus($id, $datos['fecha_actual'])) == 0){
			$jsondata['resp'] = 0;
			$jsondata['msg'] = 'Ocurrió un error al intentar eliminar, intente de nuevo más tarde';
		} else {
			$jsondata['resp'] = 1;
		}
	break;
	case 15:
		$id = $funciones->limpia($_POST['id']);
		if(@$conexion->consulta($querys->deleteInsFuelExp($id, $datos['fecha_actual'])) == 0){
			$jsondata['resp'] = 0;
			$jsondata['msg'] = 'Ocurrió un error al intentar eliminar, intente de nuevo más tarde';
		} else {
			$jsondata['resp'] = 1;
		}
	break;
	case 16:
		$id = $funciones->limpia($_POST['id']);
		if(@$conexion->consulta($querys->deleteInsFuelExpEmpl($id, $datos['fecha_actual'])) == 0){
			$jsondata['resp'] = 0;
			$jsondata['msg'] = 'Ocurrió un error al intentar eliminar, intente de nuevo más tarde';
		} else {
			$jsondata['resp'] = 1;
		}
	break;
	case 20:
		$idR = $funciones->limpia($_POST['id_r_concept']);
		if(@$conexion->consulta($querys->deletePPConcept($idR)) == 0){
			$jsondata['resp'] = 0;
		} else {
			$jsondata['resp'] = 1;
		}
	break;
}


header('Content-type: application/json; charset=utf-8');
echo json_encode($jsondata);
?>
