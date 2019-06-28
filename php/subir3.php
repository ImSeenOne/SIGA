<?Php
@session_start();

require_once("clase_variables.php");
require_once("clase_mysql.php");
include_once("clase_querys3.php");
include_once("clase_funciones.php");
include_once("clase_upload.php");


//$push = new PushNotifications();
$funciones = new Funciones();
//LLAMAMOS A LA CLASE CONEXION
$conexion = new DB_mysql(1);
//llamamos a la clase upload para cargar archivos
$querys    = new Querys3();
$upload    = new upload();


$datos = array(); $jsondata = array();
$datos['fecha_actual'] = date("Y-m-d H:i:s");

switch($_POST['opcion']){

	//AGREGA UN REGISTRO DE DESARROLLO
	case 1:
		$nombre = $funciones->limpia($_POST['txtNombre']);
		$alias = $funciones->limpia($_POST['txtAlias']);
		$cp = $funciones->limpia($_POST['txtCp']);

		if(isset($_FILES["flIcono"]["tmp_name"]) and $_FILES["flIcono"]["tmp_name"] != ""){
				if($upload->load("flIcono") === false){
					echo '<script languaje="javascript">
							parent.msg_alerta_default("ERROR! Formato de archivo no permitido...","Notificación!!","'.$upload->msj_error.'");
							</script>';
					exit(0);
				}
				$archivo = "archivos/desarrollos/".$upload->nombre_final;
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

		if($conexion->consulta($querys->addCatDesarrollo($nombre,$alias, $cp, $datos['flIcono'], $datos['fecha_actual'])) == 0){
			$jsondata['resp'] = 0;
			$jsondata['msg'] = 0;
		}else{
			$jsondata['resp'] = 1;
		}

		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata);
break;
//ACTUALIZA UN REGISTRO DE DESARROLLO
case 2:
	$id     = $funciones->limpia($_POST['idDesarrollo']);
	$nombre = $funciones->limpia($_POST['txtNombre']);
	$alias = $funciones->limpia($_POST['txtAlias']);
	$cp = $funciones->limpia($_POST['txtCp']);

	if(isset($_FILES["flIcono"]["tmp_name"]) and $_FILES["flIcono"]["tmp_name"] != ""){
			if($upload->load("flIcono") === false){
				echo '<script languaje="javascript">
						parent.msg_alerta_default("ERROR! Formato de archivo no permitido...","Notificación!!","'.$upload->msj_error.'");
						</script>';
				exit(0);
			}
			$archivo = "archivos/desarrollos/".$upload->nombre_final;
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

			if($conexion->consulta($querys->updateCatDesarrollo($id, $nombre, $alias, $cp, $datos['flIcono'])) == 0){
				$jsondata['resp'] = 0;
			}else{
				$jsondata['resp'] = 1;
			}

		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata);
	break;

	//AGREGAR UNA OBRA
	case 3:
		$name = $funciones->limpia($_POST['txtName']);
		$type = $funciones->limpia($_POST['inputType']);
		$dependency = $funciones->limpia($_POST['txtDependency']);
		$amount = $funciones->limpia($_POST['inputAmount']);
		$dateStart = $funciones->limpia($_POST['date1']);
		$dateFinish = $funciones->limpia($_POST['date2']);
		$folderVol = $funciones->limpia($_POST['txtFolderVol']);
		$addedType = $funciones->limpia($_POST['addedType']);
		$concreteVol = $funciones->limpia($_POST['txtConcreteVol']);
		$workArea = $funciones->limpia($_POST['txtWorkArea']);

		$amount = str_replace(",","",$amount);

		if($conexion->consulta($querys->addObra($name, $type, $dependency, $amount, $dateStart, $dateFinish, $folderVol, $addedType, $concreteVol, $workArea, $datos['fecha_actual'])) == 0){
			$jsondata['resp'] = 0;
			$jsondata['msg'] = 0;
		}else{
			$jsondata['resp'] = 1;
		}

		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata);
	break;

	//AGREGA UN NUEVO SEGUIMIENTO DE ESTIMACIONES
	case 4:
		$name = $funciones->limpia($_POST['inputTrackEst']);
		$est_number = $funciones->limpia($_POST['inputEstimateNum']);
		$amountmp = $funciones->limpia($_POST['inputAmount']);
		$amount = str_replace(",", "", $amountmp);
		$dateStart = $funciones->limpia($_POST['date1']);
		$dateFinish = $funciones->limpia($_POST['date2']);
		$physic_adv = $funciones->limpia($_POST['inputPhysicAdv']);
		$status = $funciones->limpia($_POST['inputStatus']);

		if(isset($_FILES["flsImg"]["tmp_name"]) and $_FILES["flsImg"]["tmp_name"] != ""){
				if($upload->load("flsImg") === false){
					echo '<script languaje="javascript">
							parent.msg_alerta_default("Formato de archivo no permitido...","Notificación","'.$upload->msj_error.'");
							</script>';
					exit(0);
				}
				$archivo = "archivos/estimaciones/".$upload->nombre_final;
				$upload->setisimage(false);
				if($upload->save('../'.$archivo) === false){
					echo '<script languaje="javascript">
							parent.msg_alerta_default("ERROR! Fallo al guardar el archivo: '.$archivo.'...","Notificación!!","'.$upload->msj_error.'");
							</script>';
					exit(0);
				}
				$datos['flsImg'] = $archivo;
		}else{
				$datos['flsImg'] = null;
		}


		if($conexion->consulta($querys->addSegEst($name,$est_number,$amount,$dateStart,$dateFinish,$physic_adv,$status,$datos['flsImg'], $datos['fecha_actual'])) == 0){
			$jsondata['resp'] = 0;
			$jsondata['msg'] = 0;
		}else{
			$jsondata['resp'] = 1;
		}

		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata);
	break;

	case 5:
		$name = $funciones->limpia($_POST['txtNombre']);

		if(isset($_FILES["flIcono"]["tmp_name"]) and $_FILES["flIcono"]["tmp_name"] != ""){
				if($upload->load("flIcono") === false){
					echo '<script languaje="javascript">
							parent.msg_alerta_default("Formato de archivo no permitido...","Notificación","'.$upload->msj_error.'");
							</script>';
					exit(0);
				}
				$archivo = "archivos/antiguedad/".$upload->nombre_final;
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


		if($conexion->consulta($querys->addAntiguedad($name,$datos['flIcono'],$datos['fecha_actual'])) == 0){
			$jsondata['resp'] = 0;
			$jsondata['msg'] = 0;
		}else{
			$jsondata['resp'] = 1;
		}

		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata);
	break;

	case 6:
		$name = $funciones->limpia($_POST['txtNombre']);
		$id = $funciones->limpia($_POST['idAntiguedad']);

		if(isset($_FILES["flIcono"]["tmp_name"]) and $_FILES["flIcono"]["tmp_name"] != ""){
				if($upload->load("flIcono") === false){
					echo '<script languaje="javascript">
							parent.msg_alerta_default("Formato de archivo no permitido...","Notificación","'.$upload->msj_error.'");
							</script>';
					exit(0);
				}
				$archivo = "archivos/antiguedad/".$upload->nombre_final;
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


		if($conexion->consulta($querys->updateAntiguedad($id, $name, $datos['flIcono'])) == 0){
			$jsondata['resp'] = 0;
			$jsondata['msg'] = 0;
		}else{
			$jsondata['resp'] = 1;
		}

		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata);
	break;

}
?>
