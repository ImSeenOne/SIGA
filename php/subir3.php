<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
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
		$numero_etapa_oferta = $funciones->limpia($_POST['txtNumeroOferta']);
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

		if($conexion->consulta($querys->addCatDesarrollo($nombre,$alias, $numero_etapa_oferta, $cp, $datos['flIcono'], $datos['fecha_actual'])) == 0){
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
	$numero_etapa_oferta = $funciones->limpia($_POST['txtNumeroOferta']);
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

			if($conexion->consulta($querys->updateCatDesarrollo($id, $nombre, $alias, $numero_etapa_oferta, $cp, $datos['flIcono'])) == 0){
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
		$dateStartTmp = $funciones->limpia($_POST['date1']);
		$dateFinishTmp = $funciones->limpia($_POST['date2']);
		$folderVol = (isset($_POST['txtFolderVol']))?$funciones->limpia($_POST['txtFolderVol']):0;
		$addedType = $funciones->limpia($_POST['addedType']);
		$concreteVol = (isset($_POST['txtConcreteVol']))?$funciones->limpia($_POST['txtConcreteVol']):0;
		$workArea = $funciones->limpia($_POST['txtWorkArea']);

		$dateStart = strtotime($dateStartTmp);
		$dateFinish = strtotime($dateFinishTmp);


		$amount = str_replace(",","",$amount);

		if($conexion->consulta($querys->addObra($name, $type, $dependency, $amount, date('Y-m-d',$dateStart), date('Y-m-d',$dateFinish), $folderVol, $addedType, $concreteVol, $workArea, $datos['fecha_actual'])) == 0){
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
	//AGREGA UNA NUEVA ANTIGUEDAD
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

	//EDITA UNA ANTIGUEDAD
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
	//AGREGA UN NUEVO EMPLEADO
	case 7:
	$fechaadmi = explode("-", $funciones->limpia($_POST['admissionDate']));

	$nombre = $funciones->limpia($_POST['txtName']);
	$apellido_paterno = $funciones->limpia($_POST['txtLastName']);
	$apellido_materno = $funciones->limpia($_POST['txtMLastName']);
	$direccion = $funciones->limpia($_POST['txtAddress']);
	$imss = $funciones->limpia($_POST['txtIMSS']);
	$rfc = $funciones->limpia($_POST['txtRFCi']);
	$curp = $funciones->limpia($_POST['txtCURP']);
	$fecha_admision = $fechaadmi[2]."-".$fechaadmi[1]."-".$fechaadmi[0];
	$estado_civil = $funciones->limpia($_POST['txtCivilSts']);
	$genero = $funciones->limpia($_POST['txtGender']);
	$categoria = $funciones->limpia($_POST['txtCategory']);
	$departamento = $funciones->limpia($_POST['txtDepartment']);
	$area = $funciones->limpia($_POST['txtArea']);
	$tipo = $funciones->limpia($_POST['txtType']);

		if(@$conexion->consulta($querys->addEmpleado($nombre,$apellido_paterno,
		$apellido_materno,$direccion,$rfc,$imss,$curp,$fecha_admision,$tipo,
		$estado_civil,$genero,$categoria,$departamento,$area,
		$datos['fecha_actual'])) == 0){
			$jsondata['resp'] = 0;
			$jsondata['msg'] = 0;

		}else{
			$jsondata['resp'] = 1;
		}
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($jsondata);
	break;

	//EDITA UN EMPLEADO
	case 8:

	$fechaadmi = explode("-", $funciones->limpia($_POST['admissionDate']));

	$id = $funciones->limpia($_POST['id_employee']);
	$nombre = $funciones->limpia($_POST['txtName']);
	$apellido_paterno = $funciones->limpia($_POST['txtLastName']);
	$apellido_materno = $funciones->limpia($_POST['txtMLastName']);
	$direccion = $funciones->limpia($_POST['txtAddress']);
	$imss = $funciones->limpia($_POST['txtIMSS']);
	$rfc = $funciones->limpia($_POST['txtRFCi']);
	$curp = $funciones->limpia($_POST['txtCURP']);
	$fecha_admision = $fechaadmi[2]."-".$fechaadmi[1]."-".$fechaadmi[0];
	$estado_civil = $funciones->limpia($_POST['txtCivilSts']);
	$genero = $funciones->limpia($_POST['txtGender']);
	$categoria = $funciones->limpia($_POST['txtCategory']);
	$departamento = $funciones->limpia($_POST['txtDepartment']);
	$area = $funciones->limpia($_POST['txtArea']);
	$tipo = $funciones->limpia($_POST['txtType']);

		if($conexion->consulta($querys->updateEmpleado($id, $nombre, $apellido_paterno, $apellido_materno, $direccion, $rfc, $imss, $curp, $fecha_admision, $tipo, $estado_civil, $genero, $categoria, $departamento, $area)) == 0){
			$jsondata['resp'] = 0;
			$jsondata['msg'] = 0;
		}else{
			$jsondata['resp'] = 1;
		}
	break;

	//EDITA UNA OBRA
	case 9:
		$id = $funciones->limpia($_POST['idWork']);
		$name = $funciones->limpia($_POST['txtName']);
		$type = $funciones->limpia($_POST['inputType']);
		$dependency = $funciones->limpia($_POST['txtDependency']);
		$amount = $funciones->limpia($_POST['inputAmount']);
		$dateStartT = $funciones->limpia($_POST['date1']);
		$dateFinishT = $funciones->limpia($_POST['date2']);
		$folderVol = (isset($_POST['txtFolderVol']))?$funciones->limpia($_POST['txtFolderVol']):0;
		$addedType = $funciones->limpia($_POST['addedType']);
		$concreteVol = (isset($_POST['txtConcreteVol']))?$funciones->limpia($_POST['txtConcreteVol']):0;
		$workArea = $funciones->limpia($_POST['txtWorkArea']);
		$amount = str_replace(",","",$amount);
		$dateStart = explode("-", $dateStartT);
		$dateFinish = explode("-", $dateFinishT);
		// exit($id.$name.$type.$dependency.$amount. $dateStart[2]."-".$dateStart[1]."-".$dateStart[0]. $dateFinish[2]."-".$dateFinish[1]."-".$dateFinish[0]. $folderVol. $addedType. $concreteVol. $workArea);
		if($conexion->consulta($querys->updateObra($id, $name, $type, $dependency, $amount, $dateStart[2]."-".$dateStart[1]."-".$dateStart[0], $dateFinish[2]."-".$dateFinish[1]."-".$dateFinish[0], $folderVol, $addedType, $concreteVol, $workArea)) == 0){
		$jsondata['resp'] = 0;
		$jsondata['msg'] = 0;
		}else{
		$jsondata['resp'] = 1;
	}
	header('Content-type: application/json; charset=utf-8');
	echo json_encode($jsondata);
break;

	//EDITA UN SEGUIMIENTO DE OBRA

	case 10:
		$id = $funciones->limpia($_POST['idEstTrack']);
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


		if($conexion->consulta($querys->updateSegEst($id,$name,$est_number,$amount,$dateStart,$dateFinish,$physic_adv,$status,$datos['flsImg'])) == 0){
			$jsondata['resp'] = 0;
			$jsondata['msg'] = 0;
		}else{
			$jsondata['resp'] = 1;
		}

		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata);
	break;
	//AGREGA UNA NUEVA RAYA (PAGO DE NÓMINA)
	case 11:

		$dateStartTmp = $funciones->limpia($_POST['dateStart']);
		$dateFinishTmp = $funciones->limpia($_POST['dateFinish']);

		$dateStart = explode("-", $dateStartTmp);
		$dateFinish = explode("-", $dateFinishTmp);

		$addedActivities = $funciones->limpia($_POST['addedActivities']);
		$employeeSelected = $funciones->limpia($_POST['employeeSelected']);
		$workSelected = $funciones->limpia($_POST['workSelected']);
		$paymentStatus = $funciones->limpia($_POST['paymentStatus']);
		$observations = $funciones->limpia($_POST['remarks']);

		$totalAmountTmp = $funciones->limpia($_POST['totalAmount']);//
		$totalAmount = str_replace(",", "", $totalAmountTmp);
		$addedActAmountTmp = $funciones->limpia($_POST['addedActAmount']);//
		$addedActAmount = str_replace(",", "", $addedActAmountTmp);
		$paymentTmp = $funciones->limpia($_POST['paymentAmount']);//
		$payment = str_replace(",", "", $paymentTmp);
		$foodTotalAmountTmp = $funciones->limpia($_POST['foodTotalAmount']);//
		$foodTotalAmount = str_replace(",", "", $foodTotalAmountTmp);
		//$ = $funciones->limpia($_POST['']);

		if($conexion->consulta($querys->addPayment($dateStart[2].'-'.$dateStart[1].'-'.$dateStart[0], $dateFinish[2].'-'.$dateFinish[1].'-'.$dateFinish[0], $payment, $foodTotalAmount, $addedActivities, $addedActAmount, $totalAmount, $paymentStatus, $observations, $employeeSelected, $workSelected, $datos['fecha_actual'])) == 0){
			$jsondata['resp'] = 0;
			$jsondata['msg'] = 0;
		}else{
			$jsondata['resp'] = 1;
		}
		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata);
	break;

	//AGREGA UN NUEVO CONTRATO
	case 12:
	//$ = $funciones->limpia($_POST['']);
		$dateContractTmp = $funciones->limpia($_POST['dateContract']);
		$validityTmp = $funciones->limpia($_POST['contractValidity']);

		$validity = explode("/", $validityTmp);
		$dateContract = explode("/", $dateContractTmp);

		$property = $funciones->limpia($_POST['propertySelected']);
		$period = $funciones->limpia($_POST['period']);
		$client = $funciones->limpia($_POST['clientSelected']);
		$type = $funciones->limpia($_POST['contractType']);
		$remarks = $funciones->limpia($_POST['remarks']);
		$amountTmp = $funciones->limpia($_POST['contractAmount']);
		$hitchTmp = $funciones->limpia($_POST['hitch']);

		$dev = $funciones->limpia($_POST['idDevelopment']);

		$res = @$conexion->obtenerlista($querys->getListadoDesarrollo($dev));

		foreach ($res as $key) {
			$folio=$key->alias;
		}
		$folio.="-";
		$folios = @$conexion->obtenerlista($querys->checkExistingFolio($folio));
		$major = "0001";
		$pre = "000";
		foreach ($folios as $key) {
			$tmp = explode("-",$key->folio);
			if(((int)$major)<((int)$tmp[1])){
				if(((int)$tmp[1])+1 > 10 && ((int)$tmp[1])+1 < 100){$pre = "00";}

				if(((int)$tmp[1])+1 > 100 && ((int)$tmp[1])+1 < 1000){$pre = "0";}

				if(((int)$tmp[1])+1 > 1000 && ((int)$tmp[1])+1 < 10000){$pre="";}
				$value=((int)$tmp[1])+2;
				$major = $pre.$value;
			}
		}
		$folio.=$major;

		switch ($type) {
			case '1':
					$lessee = $funciones->limpia($_POST['contractLessee']);
					$owner = 0;
				break;

			case '2':
				$owner = $funciones->limpia($_POST['contractOwner']);
				$lessee = 0;
			break;
		}

		$amount = str_replace(",", "", $amountTmp);
		$hitch = str_replace(",", "", $hitchTmp);

		if(isset($_FILES["flContract"]["tmp_name"]) and $_FILES["flContract"]["tmp_name"] != ""){
				if($upload->load("flContract") === false){
					echo '<script languaje="javascript">
							parent.msg_alerta_default("Formato de archivo no permitido...","Notificación","'.$upload->msj_error.'");
							</script>';
					exit(0);
				}
				$archivo = "archivos/contratos/".$upload->nombre_final;
				$upload->setisimage(false);
				if($upload->save('../'.$archivo) === false){
					echo '<script languaje="javascript">
							parent.msg_alerta_default("ERROR! Fallo al guardar el archivo: '.$archivo.'...","Notificación!!","'.$upload->msj_error.'");
							</script>';
					exit(0);
				}
				$datos['flContract'] = $archivo;
		}else{
				$datos['flContract'] = null;
		}

		if($conexion->consulta($querys->addContract($folio,$client,$period,$property,$dateContract[2].'-'.$dateContract[1].'-'.$dateContract[0],$validity[2].'-'.$validity[1].'-'.$validity[0],$type,$amount,$lessee,$owner,$hitch,$archivo,$remarks,$datos['fecha_actual'])) == 0){
			$jsondata['resp'] = 0;
			$jsondata['msg'] = 0;
		} else {
			$jsondata['resp'] = 1;
		}

		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata);
	break;

	//edita un contrato
	case 13:

		$id = $funciones->limpia($_POST['idContract']);

		$dateContractTmp = $funciones->limpia($_POST['dateContract']);
		$validityTmp = $funciones->limpia($_POST['contractValidity']);

		$validity = explode("-", $validityTmp);
		$dateContract = explode("-", $dateContractTmp);

		$property = $funciones->limpia($_POST['propertySelected']);
		$client = $funciones->limpia($_POST['clientSelected']);
		$type = $funciones->limpia($_POST['contractType']);
		$remarks = $funciones->limpia($_POST['remarks']);
		$amountTmp = $funciones->limpia($_POST['contractAmount']);
		$hitchTmp = $funciones->limpia($_POST['hitch']);
		$period =  $funciones->limpia($_POST['period']);
		$dev = $funciones->limpia($_POST['idDevelopment']);

		$res = @$conexion->obtenerlista($querys->getListadoDesarrollo($dev));

		foreach ($res as $key) {
			$folio=$key->alias;
		}
		$folio.="-";
		$folios = @$conexion->obtenerlista($querys->checkExistingFolio($folio));
		$major = "0001";
		$pre = "000";
		foreach ($folios as $key) {
			$tmp = explode("-",$key->folio);
			if(((int)$major)<((int)$tmp[1])){
				if(((int)$tmp[1])+1 > 10 && ((int)$tmp[1])+1 < 100){$pre = "00";}

				if(((int)$tmp[1])+1 > 100 && ((int)$tmp[1])+1 < 1000){$pre = "0";}

				if(((int)$tmp[1])+1 > 1000 && ((int)$tmp[1])+1 < 10000){$pre="";}
				$value=((int)$tmp[1])+2;
				$major = $pre.$value;
			}
		}
		$folio.=$major;

		$owner = $funciones->limpia($_POST['contractOwner']);
		$lessee = 0;

		/*switch ($type) {
			case '2':
					$lessee = $funciones->limpia($_POST['contractLessee']);
					$owner = 0;
				break;

			case '1':
				$owner = $funciones->limpia($_POST['contractOwner']);
				$lessee = 0;
			break;
		}*/

		$amount = str_replace(",", "", $amountTmp);
		$hitch = str_replace(",", "", $hitchTmp);

		if(isset($_FILES["flContract"]["tmp_name"]) and $_FILES["flContract"]["tmp_name"] != ""){
				if($upload->load("flContract") === false){
					echo '<script languaje="javascript">
							parent.msg_alerta_default("Formato de archivo no permitido...","Notificación","'.$upload->msj_error.'");
							</script>';
					exit(0);
				}
				$archivo = "archivos/contratos/".$upload->nombre_final;
				$upload->setisimage(false);
				if($upload->save('../'.$archivo) === false){
					echo '<script languaje="javascript">
							parent.msg_alerta_default("ERROR! Fallo al guardar el archivo: '.$archivo.'...","Notificación!!","'.$upload->msj_error.'");
							</script>';
					exit(0);
				}
				$datos['flContract'] = $archivo;
		}else{
				$datos['flContract'] = $_POST['hdFlContract'];
		}

		if($conexion->consulta($querys->updateContract($id,$folio,$client,$period,$property,$dateContract[2].'-'.$dateContract[1].'-'.$dateContract[0],$validity[2].'-'.$validity[1].'-'.$validity[0],$type,$amount,$lessee,$owner,$hitch,$datos['flContract'],$remarks,$datos['fecha_actual'])) == 0){
			$jsondata['resp'] = 0;
			$jsondata['msg'] = 0;
		} else {
			$jsondata['resp'] = 1;
		}

		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata);
	break;

	//AGREGA UN NUEVO PAGO DE NÓMINA ADMINISTRATIVA
	case 14:
	$dateStartTmp = $funciones->limpia($_POST['dateStart']);
	$dateFinishTmp = $funciones->limpia($_POST['dateFinish']);

	$dateStart = explode("-", $dateStartTmp);
	$dateFinish = explode("-", $dateFinishTmp);

	$addedActivities = $funciones->limpia($_POST['addedActivities']);
	$employeeSelected = $funciones->limpia($_POST['employee']);
	$paymentStatus = $funciones->limpia($_POST['paymentStatus']);
	$observations = $funciones->limpia($_POST['remarks']);

	$totalAmountTmp = $funciones->limpia($_POST['totalAmount']);//
	$totalAmount = str_replace(",", "", $totalAmountTmp);
	$addedActAmountTmp = $funciones->limpia($_POST['addedActAmount']);//
	$addedActAmount = str_replace(",", "", $addedActAmountTmp);
	$paymentTmp = $funciones->limpia($_POST['paymentAmount']);//
	$payment = str_replace(",", "", $paymentTmp);
	$foodTotalAmountTmp = $funciones->limpia($_POST['foodTotalAmount']);//
	$foodTotalAmount = str_replace(",", "", $foodTotalAmountTmp);
	//$ = $funciones->limpia($_POST['']);

	if($conexion->consulta($querys->addAdmPayment($dateStart[2].'-'.$dateStart[1].'-'.$dateStart[0], $dateFinish[2].'-'.$dateFinish[1].'-'.$dateFinish[0], $payment, $foodTotalAmount, $addedActivities, $addedActAmount, $totalAmount, $paymentStatus, $observations, $employeeSelected, $datos['fecha_actual'])) == 0){
		$jsondata['resp'] = 0;
		$jsondata['msg'] = 0;
	}else{
		$jsondata['resp'] = 1;
	}
	header('Content-type: application/json; charset=utf-8');
	echo json_encode($jsondata);
	break;

	//AGREGA UN NUEVO AVANCE FISICO
	case 15:
		$dateStart = date('Y-m-d',strtotime(str_replace('/', '-', $funciones->limpia($_POST['dateStart']))));
		$dateFinish = date('Y-m-d',strtotime(str_replace('/', '-', $funciones->limpia($_POST['dateFinish']))));

		$work = $funciones->limpia($_POST['work']);

		$resident = $funciones->limpia($_POST['resident']);

		$quantities = json_decode($funciones->limpia($_POST['quantities']),true);

		$concepts = json_decode($funciones->limpia($_POST['concepts']),true);

		if(@$conexion->consulta($querys->addNewPhysProg($work, $resident, $dateStart, $dateFinish, $datos['fecha_actual'])) == 0){
			$jsondata['resp'] = 0;
			$jsondata['msg'] = 0;
		} else {
			$current = $conexion->ultimoid();
			$folio = 'RA'.str_pad($current, 5, '0', STR_PAD_LEFT);
			@$conexion->consulta($querys->addFolioToNewPhysProg($current, $folio));

			$transactions = true;
			for ($i=0; $i < sizeof($concepts); $i++) {
				if(@$conexion->consulta($querys->addPPConcept($current, $concepts[$i], $quantities[$i])) == 0){
					$transactions = false;
				}
			}
			$jsondata['resp'] = 1;
			if(!$transactions){
				$jsondata['msg'] = 'No se pudo agregar uno o más conceptos, verifique el listado para ver cuáles no se agregaron';
			}
		}

		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata);
	break;
	//EDITA UN AVANCE FÍSICO
	case 16:
		$id = $funciones->limpia($_POST['id']);

		$dateStart = date('Y-m-d',strtotime(str_replace('/', '-', $funciones->limpia($_POST['dateStart']))));
		$dateFinish = date('Y-m-d',strtotime(str_replace('/', '-', $funciones->limpia($_POST['dateFinish']))));

		$work = $funciones->limpia($_POST['work']);

		$resident = $funciones->limpia($_POST['resident']);

		$quantities = json_decode($funciones->limpia($_POST['quantities']),true);

		$concepts = json_decode($funciones->limpia($_POST['concepts']),true);

		$r_concepts = json_decode($funciones->limpia($_POST['r_concepts']),true);

		if(@$conexion->consulta($querys->updatePhysProg($id, $work, $resident, $dateStart, $dateFinish)) == 0){
			$jsondata['resp'] = 0;
			$jsondata['msg'] = 0;
		} else {
			$transactions = true;
			for ($i=0; $i < sizeof($concepts); $i++) {
				$respC = @$conexion->obtenerlista('SELECT id_concepto FROM tbl_avance_fisico_conceptos WHERE id_concepto = '.$concepts[$i].' AND id_avance_fisico = '.$id);
				$totRegs = $conexion->numregistros();
				if($totRegs == 0 && !is_null($r_concepts[$i])){
					if(@$conexion->consulta($querys->addPPConcept($id, $concepts[$i], $quantities[$i])) == 0){
						$transactions = false;
					}
				} else {
					@$conexion->consulta($querys->updatePPConcept($concepts[$i], $quantities[$i]));
				}
			}
			$jsondata['resp'] = 1;
			if(!$transactions){
				$jsondata['msg'] = 'No se pudo agregar uno o más conceptos, verifique el listado para ver cuáles no se agregaron';
			}
		}

		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata);
	break;
	//AGREGA UN NUEVO NIVEL
	case 17:
		$name = $_POST['name'];
		$date = $datos['fecha_actual'];
		if(@$conexion->consulta($querys->addLevel($name, $date)) == 0){
			$jsondata['resp'] = 0;
			$jsondata['msg'] = 'Ocurrió un error al guardar en la base de datos';
		} else {
			$jsondata['resp'] = 1;
		}
		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata);
	break;
	//EDITA UN NIVEL EXISTENTE
	case 18:
		$name = $_POST['name'];
		$id = $_POST['id'];
		if(@$conexion->consulta($querys->editLevel($id, $name)) == 0){
			$jsondata['resp'] = 0;
			$jsondata['msg'] = 'Ocurrió un error al guardar en la base de datos';
		} else {
			$jsondata['resp'] = 1;
		}
		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata);
	break;
	//AGREGA UNA NUEVA EMPRESA
	case 19:
	$name = $_POST['name'];
	$date = $datos['fecha_actual'];
	if(@$conexion->consulta($querys->addCompany($name, $date)) == 0){
		$jsondata['resp'] = 0;
		$jsondata['msg'] = 'Ocurrió un error al guardar en la base de datos';
	} else {
		$jsondata['resp'] = 1;
	}
	header('Content-type: application/json; charset=utf-8');
	echo json_encode($jsondata);
	break;
	//EDITA UNA EMPRESA
	case 20:
		$name = $_POST['name'];
		$id = $_POST['id'];
		if(@$conexion->consulta($querys->editCompany($id, $name)) == 0){
			$jsondata['resp'] = 0;
			$jsondata['msg'] = 'Ocurrió un error al guardar en la base de datos';
		} else {
			$jsondata['resp'] = 1;
		}

	break;
	//AGREGA UNA NUEVA LICITACIÓN
	case 21:
	$bidNumber = $funciones->limpia($_POST['bidNum']);
	$work = $funciones->limpia($_POST['work']);
	$proposedDelivery = date('Y-m-d',strtotime($funciones->limpia($_POST['propDelivery'])));
	$failDate = date('Y-m-d',strtotime($funciones->limpia($_POST['failDate'])));
	$place = $funciones->limpia($_POST['place']);

	if(isset($_FILES["file"]["tmp_name"]) and $_FILES["file"]["tmp_name"] != ""){
			if($upload->load("file") === false){
				echo '<script languaje="javascript">
						parent.msg_alerta_default("Formato de archivo no permitido...","Notificación","'.$upload->msj_error.'");
						</script>';
				exit(0);
			}
			$archivo = "archivos/licitaciones/".$upload->nombre_final;
			$upload->setisimage(false);
			if($upload->save('../'.$archivo) === false){
				echo '<script languaje="javascript">
						parent.msg_alerta_default("ERROR! Fallo al guardar el archivo: '.$archivo.'...","Notificación!!","'.$upload->msj_error.'");
						</script>';
				exit(0);
			}
			$datos['file'] = $archivo;
	}else{
			$datos['file'] = $_POST['hdFile'];
	}

	if(@$conexion->consulta($querys->addBidding($bidNumber, $work, $proposedDelivery, $place, $failDate, $_FILES["file"]["tmp_name"], $datos['fecha_actual'])) == 0){
		$jsondata['resp'] = 0;
		$jsondata['msg'] = 'Ocurrió un error al intentar almacenar en la base de datos';
	} else {
		$jsondata['resp'] = 1;
	}

	header('Content-type: application/json; charset=utf-8');
	echo json_encode($jsondata);
	break;
	//EDITA UNA LICITACIÓN EXISTENTE
	case 22:
	$id = $funciones->limpia($_POST['idBid']);
	$bidNumber = $funciones->limpia($_POST['bidNum']);
	$work = $funciones->limpia($_POST['work']);
	$proposedDelivery = date('Y-m-d',strtotime($funciones->limpia($_POST['propDelivery'])));
	$failDate = date('Y-m-d',strtotime($funciones->limpia($_POST['failDate'])));
	$place = $funciones->limpia($_POST['place']);

	if(isset($_FILES["file"]["tmp_name"]) and $_FILES["file"]["tmp_name"] != ""){
			if($upload->load("file") === false){
				echo '<script languaje="javascript">
						parent.msg_alerta_default("Formato de archivo no permitido...","Notificación","'.$upload->msj_error.'");
						</script>';
				exit(0);
			}
			$archivo = "archivos/licitaciones/".$upload->nombre_final;
			$upload->setisimage(false);
			if($upload->save('../'.$archivo) === false){
				echo '<script languaje="javascript">
						parent.msg_alerta_default("ERROR! Fallo al guardar el archivo: '.$archivo.'...","Notificación!!","'.$upload->msj_error.'");
						</script>';
				exit(0);
			}
			$datos['file'] = $archivo;
	}else{
			$datos['file'] = $_POST['hdFile'];
	}

	if(@$conexion->consulta($querys->editBidding($id, $bidNumber, $work, $proposedDelivery, $place, $failDate, $_FILES["file"]["tmp_name"], $datos['fecha_actual'])) == 0){
		$jsondata['resp'] = 0;
		$jsondata['msg'] = 'Ocurrió un error al intentar almacenar en la base de datos';
	} else {
		$jsondata['resp'] = 1;
	}

	header('Content-type: application/json; charset=utf-8');
	echo json_encode($jsondata);
	break;
	//AGREGA UN NUEVO TIPO DE GASTO
	case 23:
		$name = $funciones->limpia($_POST['name']);

		if(@$conexion->consulta($querys->addTypeOfExpenses($name)) == 0){
			$jsondata['resp'] = 0;
			$jsondata['msg'] = 'Ocurrió un error al intentar almacenar en la base de datos';
		} else {
			$jsondata['resp'] = 1;
		}

		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata);

	break;
	//EDITA UN TIPO DE GASTO
	case 24:
		$id = $funciones->limpia($_POST['id']);
		$name = $funciones->limpia($_POST['name']);

		if(@$conexion->consulta($querys->updateTypeOfExpenses($id, $name)) == 0){
			$jsondata['resp'] = 0;
			$jsondata['msg'] = 'Ocurrió un error al intentar almacenar en la base de datos';
		} else {
			$jsondata['resp'] = 1;
		}

		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata);
	break;
	//AGREGA UN NUEVO GASTO
	case 25:
		$property = $funciones->limpia($_POST['property']);
		$expenseType = $funciones->limpia($_POST['typeExpense']);
		$amountmp = $funciones->limpia($_POST['amount']);
		$amount = str_replace(",", "", $amountmp);

		$date = date('Y-m-d',strtotime( str_replace('/', '-', $funciones->limpia($_POST['date']) ) ) );

		$remarks = $funciones->limpia($_POST['remarks']);

		if(@$conexion->consulta($querys->addExpense($_SESSION['dUsuario']['id_usuario'], $property, $expenseType, $amount, $remarks, $date, $datos['fecha_actual'], 1)) == 0){
			$jsondata['resp'] = 0;
			$jsondata['msg'] = 'Ocurrió un error al intentar almacenar en la base de datos';
		} else {
			$jsondata['resp'] = 1;
		}

		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata);
	break;
	//EDITA UN GASTO
	case 26:
		$id = $funciones->limpia($_POST['id']);
		$property = $funciones->limpia($_POST['property']);
		$expenseType = $funciones->limpia($_POST['typeExpense']);
		$amountmp = $funciones->limpia($_POST['amount']);
		$amount = str_replace(",", "", $amountmp);

		$date = date('Y-m-d',strtotime( str_replace('/', '-', $funciones->limpia($_POST['date']) ) ) );

		$remarks = $funciones->limpia($_POST['remarks']);

		if(@$conexion->consulta($querys->updateExpense($id, $_SESSION['dUsuario']['id_usuario'], $property, $expenseType, $amount, $remarks, $date, $datos['fecha_actual'], 1)) == 0){
			$jsondata['resp'] = 0;
			$jsondata['msg'] = 'Ocurrió un error al intentar almacenar en la base de datos';
		} else {
			$jsondata['resp'] = 1;
		}

		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata);
	break;
	//AGREGA UN NUEVO REGISTRO DE COMBUSTIBLE
	case 27:
		$initDate = date('Y-m-d',strtotime( str_replace('/', '-', $funciones->limpia($_POST['dateStart']) ) ) );

		$status = $funciones->limpia($_POST['status']);

		$magnaPrice = $funciones->limpia($_POST['magna']);
		$magnaPrice = str_replace(",", "", $magnaPrice);

		$premiumPrice = $funciones->limpia($_POST['premium']);
		$premiumPrice = str_replace(",", "", $premiumPrice);

		$dieselPrice = $funciones->limpia($_POST['diesel']);
		$dieselPrice = str_replace(",", "", $dieselPrice);

		$magnaLiters = $funciones->limpia($_POST['magnaLts']);
		$premiumLiters = $funciones->limpia($_POST['premiumLts']);
		$dieselLiters = $funciones->limpia($_POST['dieselLts']);

		$finishDate = date('Y-m-d', strtotime($initDate.' + 7 days' ));

		$amount = ($magnaPrice * $magnaLiters) + ($premiumPrice * $premiumLiters) + ($dieselPrice * $dieselLiters);

		if(@$conexion->consulta($querys->addInsFuelExp($initDate, $finishDate, $magnaLiters, $premiumLiters,
														$dieselLiters, $magnaPrice, $premiumPrice, $dieselPrice,
														$status, $amount, $datos['fecha_actual'])) == 0){
															$jsondata['resp'] = 0;
															$jsondata['msg'] = 'Ocurrió un error al intentar almacenar en la base de datos';
														} else {
															$current = $conexion->ultimoid();
															$folio = 'GI-'.str_pad($current, 4, '0', STR_PAD_LEFT);
															if($conexion->consulta($querys->addInsFuelExpFolio($current, $folio)) == 0){
																$jsondata['msg'] = 'folio no guardado';
															} else {
																$jsondata['folio'] = $folio;
															}
															$jsondata['resp'] = 1;
														}
		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata);
	break;
	//ASIGNA UN GASTO DE COMBUSTIBLE A UN EMPLEADO
	case 28:
		$id = $funciones->limpia($_POST['idModal']);
		$employee = $funciones->limpia($_POST['employeeModal']);
		$liters = floatval($funciones->limpia($_POST['litersModal']));
		$type = intval($funciones->limpia($_POST['fuelTypeModal']));
		$location = $funciones->limpia($_POST['locationModal']);
		$machineryType = $funciones->limpia($_POST['machineryModal']);

		$amount = 0;

		$resp = @$conexion->fetch_array($querys->listInsFuelExp($id));
		switch ($type) {
			case 1:
				$amount = $liters * floatval($resp['precio_magna']);
			break;

			case 2:
				$amount = $liters * floatval($resp['precio_premium']);
			break;

			case 3:
				$amount = $liters * floatval($resp['precio_diesel']);
			break;
		}

		//echo $querys->addAssignedFuelExpEmployee($employee, $id, $liters, $amount, $type, $machineryType, $location);

		if($conexion->consulta($querys->addAssignedFuelExpEmployee($employee, $id, $liters, $amount, $type, $machineryType, $location)) == 0){
			$jsondata['resp'] = 0;
			$jsondata['msg'] = 'Ocurrió un error al guardar en la base de datos';
		} else {
			$jsondata['resp'] = 1;
		}

		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata);

	break;

	case 29:
		$name = $funciones->limpia($_POST['name']);
		$workDays = $funciones->limpia($_POST['workDays']);
		$payment = str_replace(",","",$funciones->limpia($_POST['payment']));

		if($conexion->consulta($querys->addEmployeeCategory($name, $workDays, $payment)) == 0){
			$jsondata['resp'] = 0;
			$jsondata['msg'] = 'Ocurrió un error al guardar en la base de datos';
		} else {
			$jsondata['resp'] = 1;
		}

		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata);
	break;
	//EDITA UNA CATEGORÍA DE EMPLEADO
	case 30:
		$id = $funciones->limpia($_POST['id']);
		$name = $funciones->limpia($_POST['name']);
		$workDays = $funciones->limpia($_POST['workDays']);
		$payment = $funciones->limpia($_POST['payment']);
		if($conexion->consulta($querys->editEmployeeCategory($id, $name, $workDays, $payment)) == 0){
			$jsondata['resp'] = 0;
			$jsondata['msg'] = 'Ocurrió un error al editar en la base de datos';
		} else {
			$jsondata['resp'] = 1;
		}
		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata);
	break;
	//AGREGA UN NUEVO STATUS EN GERENCIA
	case 31:
	$name = $funciones->limpia($_POST['name']);
	if($conexion->consulta($querys->addInsFuelExpStatus($name)) == 0){
		$jsondata['resp'] = 0;
		$jsondata['msg'] = 'Ocurrió un error al editar en la base de datos';
	} else {
		$jsondata['resp'] = 1;
	}
	header('Content-type: application/json; charset=utf-8');
	echo json_encode($jsondata);
	break;
	//EDITA UN STATUS EN GERENCIA
	case 32:
	$id = $funciones->limpia($_POST['id']);
	$name = $funciones->limpia($_POST['name']);
	if($conexion->consulta($querys->updateInsFuelExpStatus($id, $name)) == 0){
		$jsondata['resp'] = 0;
		$jsondata['msg'] = 'Ocurrió un error al editar en la base de datos';
	} else {
		$jsondata['resp'] = 1;
	}
	header('Content-type: application/json; charset=utf-8');
	echo json_encode($jsondata);
	break;
}
?>
