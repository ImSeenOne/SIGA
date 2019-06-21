<?Php
@session_start();

require_once("clase_variables.php");
require_once("clase_mysql.php");
include_once("clase_querys.php");
include_once("clase_funciones.php");
include_once("clase_upload.php");


//$push = new PushNotifications();
$funciones = new Funciones();
//LLAMAMOS A LA CLASE CONEXION
$conexion = new DB_mysql(1);
//llamamos a la clase upload para cargar archivos
$querys    = new Querys();
$upload    = new upload();


$datos = array(); $jsondata = array();
$datos['fecha_actual'] = date("Y-m-d H:i:s");

switch($_POST['opcion']){
	//AGREGAR UN DESARROLLO
	case 1:
	$nombre = $funciones->limpia($_POST['txtNombre']);
	$alias = $funciones->limpia($_POST['txtAlias']);//flIcono
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
	//EDITAR UN DESARROLLO
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
	//AGREGAR UN REGISTRO
	case 201:
		$nombre = $funciones->limpia($_POST['txtNombre']);

		if(isset($_FILES["flIcono"]["tmp_name"]) and $_FILES["flIcono"]["tmp_name"] != ""){
				if($upload->load("flIcono") === false){
					echo '<script languaje="javascript">
							parent.msg_alerta_default("ERROR! Formato de archivo no permitido...","Notificación!!","'.$upload->msj_error.'");
						  </script>';
					exit(0);
				}
				$archivo = "archivos/estacionamiento/".$upload->nombre_final;
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

		if($conexion->consulta($querys->addCatEstacionamiento($nombre, $datos['flIcono'], $datos['fecha_actual'])) == 0){
			$jsondata['resp'] = 0;
			$jsondata['msg'] = 0;
		}else{
			$jsondata['resp'] = 1;
		}

		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata);
	break;

	case 202: //OPCIÓN PARA ACTUALIZAR EL REGISTRO DEL CATÁLOGO ESTACIONAMIENTO
		$id     = $funciones->limpia($_POST['idEstacionamiento']);
		$nombre = $funciones->limpia($_POST['txtNombre']);

		if(isset($_FILES["flIcono"]["tmp_name"]) and $_FILES["flIcono"]["tmp_name"] != ""){
				if($upload->load("flIcono") === false){
					echo '<script languaje="javascript">
							parent.msg_alerta_default("ERROR! Formato de archivo no permitido...","Notificación!!","'.$upload->msj_error.'");
						  </script>';
					exit(0);
				}
				$archivo = "archivos/estacionamiento/".$upload->nombre_final;
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

		if($conexion->consulta($querys->updateCatEstacionamiento($id, $nombre, $datos['flIcono'])) == 0){
			$jsondata['resp'] = 0;
		}else{
			$jsondata['resp'] = 1;
		}

		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata);
	break;
}
?>
