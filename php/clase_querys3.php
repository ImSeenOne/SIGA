<?php
class Querys3 {
	//***************************************************************************************
	//*********************INICIA QUERYS PARA INICIO DE SESIÓN ******************************

	//QUERY PARA OBTENER EL LISTADO DEL CATÁLOGO DE DESARROLLO
		public function getListadoDesarrollo($id = ''){
			$cond = ' ';

			if($id != '') {
				$cond = ' AND id_desarrollo = '.$id.' ';
			}

			$strQuery = 'SELECT id_desarrollo, nombre, alias, numero_etapa_oferta, codigo_postal, icono, fecha_registro, coordenadas ';
			$strQuery.= 'FROM tblc_desarrollo ';
			$strQuery.= 'WHERE fecha_eliminacion IS NULL'.$cond;
			$strQuery.= 'ORDER BY fecha_registro DESC, id_desarrollo DESC';

			return $strQuery;
		}

	//QUERY PARA AGREGAR UN REGISTRO AL CATÁLOGO DE DESARROLLO
		public function addCatDesarrollo($nombre, $alias, $numero_etapa_oferta, $codigo_postal, $icono, $fechaRegistro,$latitud,$longitud){
			$coordenadas = $latitud.",".$longitud;
			$strQuery = 'INSERT INTO tblc_desarrollo ';
			$strQuery.= '(nombre, alias, numero_etapa_oferta, codigo_postal, icono, fecha_registro,coordenadas) ';
			$strQuery.= 'VALUES("'.$nombre.'", "'.$alias.'", "'.$numero_etapa_oferta.'", "'.$codigo_postal.'", "'.$icono.'", "'.$fechaRegistro.'", "'.$coordenadas.'")';

			return $strQuery;
		}

		//QUERY PARA EDITAR UN REGISTRO DEL CATÁLOGO DESARROLLO
			public function updateCatDesarrollo($idDesarrollo, $nombre, $alias, $numero_etapa_oferta, $codigo_postal, $icono, $latitud, $longitud){
				$coordenadas = $latitud.",".$longitud;
				$strQuery = 'UPDATE tblc_desarrollo ';
				$strQuery.= 'SET nombre = "'.$nombre.'", alias = "'.$alias.'", numero_etapa_oferta = "'.$numero_etapa_oferta.'", codigo_postal = "'.$codigo_postal.'", icono = "'.$icono.'", coordenadas= "' . $coordenadas . '" ';
				$strQuery.= 'WHERE id_desarrollo = '.$idDesarrollo;

				return $strQuery;
			}

	//QUERY PARA MARCAR CÓMO ELIMINADO UN REGISTRO DEL CATALOGO DESARROLLO
	public function eliminaRegCatDesarrollo($id, $fecha){
		$strQuery = 'UPDATE tblc_desarrollo ';
		$strQuery.= 'SET fecha_eliminacion = "'.$fecha.'" ';
		$strQuery.= 'WHERE id_desarrollo = '.$id;

		return $strQuery;
	}

	//QUERY PARA AGREGAR UNA OBRA
	public function addObra($name, $type, $dependency, $amount, $dateStart, $dateFinish, $folderVol, $addedType, $concreteVol, $workArea, $fechaRegistro,$txtDireccion,$latitud,$longitud){
		$factorImpregnacion = $workArea * 1.2;
		$factorLiga = $workArea * 0.8;
		$coordenadas= $latitud . "," . $longitud;
		$strQuery = 'INSERT INTO tbl_obras ';
		$strQuery.= '(nombre, tipo, dependencia, monto, fecha_inicio, fecha_finalizacion, volumenes_carpeta, tipo_agregado, volumen_concreto, area_obra,  fecha_registro,factor_impregnacion,factor_liga,direccion,coordenadas) ';
		$strQuery.= 'VALUES("'.$name.'", "'.$type.'", "'.$dependency.'", "'.$amount.'", "'.$dateStart.'", "'.$dateFinish.'", "'.$folderVol.'", "'.$addedType.'", "'.$concreteVol.'", "'.$workArea.'", "'.$fechaRegistro.'",'.$factorImpregnacion.','.$factorLiga.',"'.$txtDireccion.'","'. $coordenadas .'")';

		return $strQuery;
	}

	//QUERY PARA OBTENER LISTADO OBRAS
		public function getListadoObras($id = ''){
			$cond = ' ';

			if($id != '') {
				$cond.= 'AND id_obras = '.$id.' ';
			}

			$strQuery = 'SELECT id_obras, id_obras AS id, nombre, nombre AS valor, tipo, dependencia, monto, fecha_inicio, fecha_finalizacion, volumenes_carpeta, tipo_agregado, volumen_concreto, area_obra,  fecha_registro, direccion, coordenadas ';
			$strQuery.= 'FROM tbl_obras ';
			$strQuery.= 'WHERE fecha_eliminacion IS NULL'.$cond;
			$strQuery.= 'ORDER BY fecha_registro DESC, id_obras	 DESC';

			return $strQuery;
		}

	//QUERY PARA MARCAR CÓMO ELIMINADO UN REGISTRO DE UNA OBRA
	public function eliminarRegObra($id, $fecha){
		$strQuery = 'UPDATE tbl_obras ';
		$strQuery.= 'SET fecha_eliminacion = "'.$fecha.'" ';
		$strQuery.= 'WHERE id_obras = '.$id;

		return $strQuery;
	}

	public function updateObra($id, $name, $type, $dependency, $amount, $dateStart, $dateFinish, $folderVol, $addedType, $concreteVol, $workArea,$direccion,$latitud,$longitud) {
				$factorImpregnacion = $workArea * 1.2;
				$factorLiga = $workArea * 0.8;
				$coordenadas = $latitud.",".$longitud;
			  $strQuery = 'UPDATE tbl_obras SET nombre = "'.$name.'"';
			  $strQuery .= ',tipo = "'.$type.'"';
			  $strQuery .= ',dependencia = "'.$dependency.'"';
			  $strQuery .= ',monto = "'.$amount.'",';
			  $strQuery .= 'fecha_inicio = "'.$dateStart.'",';
			  $strQuery .= 'fecha_finalizacion = "'.$dateFinish.'",';
			  $strQuery .= 'volumenes_carpeta = "'.$folderVol.'",';
			  $strQuery .= 'tipo_agregado = "'.$addedType.'",';
			  $strQuery .= 'volumen_concreto = "'.$concreteVol.'",';
			  $strQuery .= 'area_obra = "'.$workArea.'", ';
			  $strQuery .= 'direccion = "'.$direccion.'", ';
			  $strQuery .= 'coordenadas = "'.$coordenadas.'", ';
			  $strQuery .= 'factor_impregnacion = "'.$factorImpregnacion.'", ';
			  $strQuery .= 'factor_liga = "'.$factorLiga.'" ';
			  $strQuery .= 'WHERE id_obras = "'.$id.'";';

				return $strQuery;
			}

	//QUERY PARA OBTENER LISTADO SEGUIMIENTO
	public function getListadoSeguimiento($id = ''){
		$cond = ' ';

		if($id != '') {
			$cond = ' AND id_seg_est = '.$id.' ';
		}

		$strQuery = 'SELECT id_seg_est, nombre_obra, monto, avance_fisico, numero_estimacion, fecha_inicio, fecha_finalizacion, status, imagen, fecha_registro ';
		$strQuery.= 'FROM tbl_seguimiento_estimaciones ';
		$strQuery.= 'WHERE fecha_eliminacion IS NULL'.$cond;
		$strQuery.= 'ORDER BY fecha_registro DESC, id_seg_est	 DESC';

		return $strQuery;
	}

	//QUERY PARA AGREGAR UN NUEVO SEGUIMIENTO DE ESTIMACIONES
	public function addSegEst($name,$est_number,$amount,$dateStart,$dateFinish,$physic_adv,$status,$imagen, $fecha_registro){
		$strQuery = 'INSERT INTO tbl_seguimiento_estimaciones ';
		$strQuery.= '(nombre_obra, monto, avance_fisico, numero_estimacion, fecha_inicio, fecha_finalizacion, status, imagen, fecha_registro) ';
		$strQuery.= 'VALUES("'.$name.'", "'.$amount.'", "'.$physic_adv.'", "'.$est_number.'", "'.$dateStart.'", "'.$dateFinish.'", "'.$status.'", "'.$imagen.'", "'.$fecha_registro.'")';

		return $strQuery;
	}
	//QUERY PARA ELIMINAR UN SEGUIMIENTO DE ESTIMACIONES
	public function eliminarRegSegEst($id, $fecha){
		$strQuery = 'UPDATE tbl_seguimiento_estimaciones ';
		$strQuery.= 'SET fecha_eliminacion = "'.$fecha.'" ';
		$strQuery.= 'WHERE id_seg_est = '.$id;

		return $strQuery;
	}

	//QUERY PARA EDITAR UN SEGUIMIENTO DE ESTIMACIONES
	public function updateSegEst($id,$name,$est_number,$amount,$dateStart,$dateFinish,$physic_adv,$status,$archivo){

		return $strQuery='UPDATE tbl_seguimiento_estimaciones
											SET nombre_obra = "'.$name.'",
											monto = "'.$amount.'",
											avance_fisico = "'.$physic_adv.'",
											numero_estimacion = "'.$est_number.'",
											fecha_inicio = "'.$dateStart.'",
											fecha_finalizacion = "'.$dateFinish.'",
											status = "'.$status.'",
											imagen = "'.$archivo.'"
											WHERE id_seg_est = "'.$id.'"
											';
	}

	//COMIENZAN QUERYS PARA MODULO ANTIGUEDAD

	//QUERY PARA LISTAR TODAS LAS ANTIGUEDADES
	public function getListadoAntiguedad($id = ''){
		$cond = ' ';

		if($id != '') {
			$cond = ' AND id_antiguedad = '.$id.' ';
		}
		$strQuery = 'SELECT id_antiguedad, nombre, icono, fecha_registro ';
		$strQuery.= 'FROM tblc_antiguedad ';
		$strQuery.= 'WHERE fecha_eliminacion IS NULL'.$cond;
		$strQuery.= 'ORDER BY fecha_registro DESC, id_antiguedad	 DESC';

		return $strQuery;
	}

	//QUERY PARA GREGAR NUEVA ANTIGUEDAD
	public function addAntiguedad($nombre,$icono, $fecha_registro){
		$strQuery = 'INSERT INTO tblc_antiguedad ';
		$strQuery.= '(nombre, icono, fecha_registro) ';
		$strQuery.= 'VALUES("'.$nombre.'", "'.$icono.'", "'.$fecha_registro.'")';

		return $strQuery;
	}

	//QUERY PARA ELIMINAR UNA ANTIGUEDAD
	public function eliminarAntiguedad($id, $fecha){
		$strQuery = 'UPDATE tblc_antiguedad ';
		$strQuery.= 'SET fecha_eliminacion = "'.$fecha.'" ';
		$strQuery.= 'WHERE id_antiguedad = '.$id;

		return $strQuery;
	}

	//QUERY PARA EDITAR UNA ANTIGUEDAD
	public function updateAntiguedad($id_antiguedad, $nombre,  $icono){
		$strQuery = 'UPDATE tblc_antiguedad ';
		$strQuery.= 'SET nombre = "'.$nombre.'", icono = "'.$icono.'" ';
		$strQuery.= 'WHERE id_antiguedad = '.$id_antiguedad;

		return $strQuery;
	}

	//QUERY PARA OBTENER EMPLEADOS POR ID
	public function getEmpleadosById($id = ''){
		$cond = ' ';

		if($id != '') {
			$cond = ' AND id_empleado = '.$id.' ';
		}

		$strQuery = 'SELECT id_empleado, nombre, apellido_paterno, apellido_materno, direccion, rfc, imss, curp, fecha_admision, tipo, estado_civil, genero, categoria, departamento, area, fecha_registro ';
		$strQuery.= 'FROM tbl_empleados ';
		$strQuery.= 'WHERE fecha_eliminacion IS NULL'.$cond;
		$strQuery.= 'ORDER BY fecha_registro DESC, id_empleado DESC';

		return $strQuery;
	}
	//QUERY PARA LISTAR EMPLEADOS
	public function getListadoEmpleados($tipo='', $nombre = '', $rfc = '', $imss = ''){
		$cond = ' ';

		if($tipo != ''){
			$cond.= 'AND tipo = '.$tipo;
		}

		if($nombre != '') {
			$cond.= 'AND nombre LIKE "%'.$nombre.'%" ';
		}

		if($rfc != '') {
			$cond.= 'AND rfc LIKE "%'.$rfc.'%" ';
		}

		if($imss != '') {
			$cond.= 'AND imss LIKE "%'.$imss.'%" ';
		}
		//DON'T DELETE DUPLICATED ALIASES; THOSE ARE USED IN RAYAS MODULE
		$strQuery = 'SELECT *, id_empleado AS id,  nombre, CONCAT(nombre, " ",apellido_paterno, " ",apellido_materno) AS valor, categoria AS category ';
		$strQuery.= 'FROM tbl_empleados ';
		$strQuery.= 'WHERE fecha_eliminacion IS NULL'.$cond;
		$strQuery.= ' ORDER BY CONCAT(nombre, " ",apellido_paterno, " ",apellido_materno) ASC';

		return $strQuery;
	}
	//QUERY AGREGAR EMPLEADOS
	public function addEmpleado($nombre,$apellido_paterno,$apellido_materno, $direccion, $rfc, $imss, $curp, $fecha_admision, $tipo, $estado_civil, $genero, $categoria, $departamento, $area, $fecha_registro){
		$strQuery = 'INSERT INTO tbl_empleados ';
		$strQuery.= '(nombre, apellido_paterno, apellido_materno, direccion, rfc, imss, curp, fecha_admision, tipo, estado_civil, genero, categoria, departamento, area, fecha_registro) ';
		$strQuery.= 'VALUES("'.$nombre.'", "'.$apellido_paterno.'", "'.$apellido_materno.'", "'.$direccion.'", "'.$rfc.'", "'.$imss.'", "'.$curp.'", "'.$fecha_admision.'", "'.$tipo.'", "'.$estado_civil.'", "'.$genero.'", "'.$categoria.'", "'.$departamento.'", "'.$area.'", "'.$fecha_registro.'")';

		return $strQuery;
	}

	public function updateEmpleado($id_empleado, $nombre, $apellido_paterno, $apellido_materno, $direccion, $rfc, $imss, $curp, $fecha_admision, $tipo, $estado_civil, $genero, $categoria, $departamento, $area){
		$strQuery = 'UPDATE tbl_empleados ';
		$strQuery.= 'SET nombre = "'.$nombre.'", apellido_paterno = "'.$apellido_paterno.'", apellido_materno = "'.$apellido_materno.'", direccion = "'.$direccion.'", rfc = "'.$rfc.'", imss = "'.$imss.'", curp = "'.$curp.'", fecha_admision = "'.$fecha_admision.'", tipo = "'.$tipo.'", estado_civil = "'.$estado_civil.'", genero = "'.$genero.'", categoria = "'.$categoria.'", departamento = "'.$departamento.'", area = "'.$area.'" ';
		$strQuery.= 'WHERE id_empleado = '.$id_empleado;

		return $strQuery;
	}

	public function deleteEmpleado($id, $fecha) {
		$strQuery = 'UPDATE tbl_empleados ';
		$strQuery.= 'SET fecha_eliminacion = "'.$fecha.'" ';
		$strQuery.= 'WHERE id_empleado = '.$id;

		return $strQuery;
	}

	//****************************************************************************
	//****************************************************************************
	//****************************************************************************
	//*************************CATEGORÍA DE EMPLEADOS*****************************
	//****************************************************************************
	//****************************************************************************
	//****************************************************************************

	//QUERY PARA AGREGAR UNA CATEGORÍA DE EMPLEADOS
	public function addEmployeeCategory($name, $workDays, $payment){
		$strQuery = 'INSERT INTO tblc_categorias (nombre, dias, sueldo) VALUES (\''.$name.'\', '.$workDays.', '.$payment.')';
		return $strQuery;
	}

	//QUERY PARA OBTENER TODAS LAS CATEGORÍAS DE EMPLEADOS
	public function listEmployeeCategories($id=''){
		$cond = '';
		if($id != ''){
			$cond = ' AND id_categoria = '.$id;
		}
		$strQuery = 'SELECT *, CONCAT(nombre, " ($", FORMAT(sueldo*dias,2), ", por ", dias," dias)") as valor, id_categoria as id FROM tblc_categorias WHERE fecha_eliminacion IS NULL'.$cond;
		return $strQuery;
	}

	//QUERY PARA EDITAR UNA CATEGORÍA DE EMPLEADO
	function editEmployeeCategory($id, $name, $workDays, $payment){
		$strQuery = 'UPDATE tblc_categorias SET nombre = \''.$name.'\',
		dias = '.$workDays.',
		sueldo = \''.$payment.'\'
		WHERE (id_categoria = '.$id.')';
		return $strQuery;
	}

	function deleteEmployeeCategory($id, $date){
		$strQuery = 'UPDATE tblc_categorias SET fecha_eliminacion = \''.$date.'\' WHERE id_categoria = '.$id.'';
		return $strQuery;
	}

	//****************************************************************************
	//****************************************************************************
	//****************************************************************************
	//**********************************RAYA**************************************
	//****************************************************************************
	//****************************************************************************
	//****************************************************************************

	//QUERY FOR ADDING RAYA
	public function addPayment($dateStart, $dateFinish, $payment, $foodTotalAmount,
	$addedActivities, $totalAmount, $status, $observations, $employeeSelected,
	$workSelected, $currentDate){
	$strQuery = 'INSERT INTO tbl_rayas ';
	$strQuery.=	'(fecha_inicio, fecha_finalizacion, sueldo, alimentos, ot_act,
	total_raya, status, observaciones, id_empleado, id_obra, fecha_registro) VALUES ';

	$strQuery.= '("'.$dateStart.'","'.$dateFinish.'",'.$payment.','.$foodTotalAmount.','.$addedActivities.','.$totalAmount.','.$status.',"'.$observations.'",'.$employeeSelected.','.$workSelected.',"'.$currentDate.'")';

	return $strQuery;
	}

	//QUERY FOR SEARCHING RAYA
	public function searchPayments($id = ''){
		$cond = '';
		if($id != ''){
			$cond = ' WHERE id_raya = '.$id;
		}
		return 'SELECT * FROM tbl_rayas'.$cond;
	}



	//QUERY FOR ADDING NEW CONTRACTS
	public function addContract($folio, $id_cliente, $periodo, $id_propiedad,
	$fecha_realizacion, $vigencia, $tipo_contrato, $monto, $id_arrendatario = '0',
	$id_propietario = '0', $enganche_deposito, $archivo, $observaciones, $fecha_actual){

		$strQuery = "INSERT INTO tblc_contratos (folio, id_cliente, id_propiedad, fecha_realizacion, vigencia, tipo_contrato, monto, id_arrendatario, id_propietario, enganche_deposito, archivo, observaciones, fecha_registro, periodo)
		VALUES ('".$folio."','".$id_cliente."','".$id_propiedad."','".$fecha_realizacion."',
		'".$vigencia."','".$tipo_contrato."','".$monto."','".$id_arrendatario."','".$id_propietario."',
		'".$enganche_deposito."','".$archivo."','".$observaciones."','".$fecha_actual."','".$periodo."')";

		return $strQuery;
	}

	//QUERY TO FIND EXISTING Folio
	public function checkExistingFolio($folio){
		$strQuery = 'SELECT folio FROM tblc_contratos WHERE folio LIKE "'.$folio.'%"';
		return $strQuery;
	}

public function getContracts($id = 0){

		$cond='';

		if($id > 0){
			$cond = ' AND id_contrato = '.$id.' ';
		}

		$strQuery = 'SELECT * FROM tblc_contratos WHERE fecha_eliminacion IS NULL'.$cond;

		return $strQuery;
	}

	public function deleteContract($id,$fecha){
		$strQuery = 'UPDATE tblc_contratos SET archivo="", fecha_eliminacion = "'.$fecha.'" WHERE (id_contrato = '.$id.' );';
		return $strQuery;
	}

	public function updateContract($id,$folio, $id_cliente, $periodo, $id_propiedad,
	$fecha_realizacion, $vigencia, $tipo_contrato, $monto, $id_arrendatario = '0',
	$id_propietario = '0', $enganche_deposito, $archivo, $observaciones, $fecha_actual){
		$strQuery = 'UPDATE tblc_contratos SET folio="'.$folio.'", id_cliente = '.$id_cliente.', id_propiedad ='.$id_propiedad.', fecha_realizacion = "'.$fecha_realizacion.'", vigencia = "'.$vigencia.'", tipo_contrato = '.$tipo_contrato.', monto = '.$monto.', id_arrendatario = '.$id_arrendatario.', id_propietario ='.$id_propietario.',
		 enganche_deposito = '.$enganche_deposito.', archivo = "'.$archivo.'", observaciones = "'.$observaciones.'", periodo = '.$periodo.' WHERE (id_contrato = '.$id.' )';
		 return $strQuery;
	}

	/**Administration Payments**/
	public function searchAdmPayments($id = ''){
		$cond = '';
		if($id != ''){
			$cond.= ' WHERE id_nom_adm = '.$id;
		}
		$strQuery = 'SELECT * FROM tbl_nomina_adm'.$cond;
		return $strQuery;
	}
	//AGREGA UN NUEVO PAGO
	public function addAdmPayment($dateStart, $dateFinish, $payment, $foodTotalAmount,
		$totalAmount, $status, $observations,
		$employeeSelected, $currentDate){
		$strQuery = 'INSERT INTO tbl_nomina_adm ';
		$strQuery.=	'(fecha_inicio, fecha_finalizacion, sueldo, alimentos,
		total_nomina, status, observaciones, id_empleado, fecha_registro) VALUES ';

		$strQuery.= '("'.$dateStart.'","'.$dateFinish.'",'.$payment.','.$foodTotalAmount.','.$totalAmount.','.$status.',"'.$observations.'",'.$employeeSelected.',"'.$currentDate.'")';

		return $strQuery;
	}
	//OBTIENE LAS ACTIVIDADES AÑADIDAS DE UN PAGO DE NÓMINA
	public function getAssAdmAddedActivities($id, $idPayment, $idCatalog){
		$cond = '';
		if($id != ''){
			$cond.= ' AND id_act_an = '.$id;
		}
		if($idPayment != ''){
			$cond.= ' AND id_nom_adm = '.$idPayment;
		}
		if($idCatalog != ''){
			$cond.= ' AND id_act_an_rrhh = '.$idCatalog;
		}
		$strQuery = 'SELECT * FROM tbl_act_an_nom WHERE fecha_eliminacion IS NULL'.$cond.' ORDER BY fecha_registro DESC';
		return $strQuery;
	}
	// AGREGA UNA ACTIVIDAD AÑADIDA A UN PAGO DE NÓMINA
	public function assignAdmAddedActivitiesPayment($idPayment, $idAddedAct, $name, $amount, $date){
		$strQuery = 'INSERT INTO tbl_act_an_nom (id_nom_adm, id_act_an_rrhh, concepto, monto, fecha_registro) VALUES ('.$idPayment.', '.$idAddedAct.', \''.$name.'\','.$amount.', \''.$date.'\');';
		return $strQuery;
	}
	//ELIMINA UNA ACTIVIDAD AÑADIDA A UN PAGO DE NÓMINA
	public function deleteAdmAddedActivitiesPayment($id, $date){
		$strQuery = 'UPDATE tbl_act_an_nom SET fecha_eliminado = \''.$date.'\' WHERE id_act_an = '.$id;
		return $strQuery;
	}
	//OBTIENE LAS ACTIVIDADES AÑADIDAS DE UN PAGO DE RAYA
	public function getAssAddedActivities($id, $idPayment, $idCatalog){
		$cond = '';
		if($id != ''){
			$cond.= ' AND id_act_an = '.$id;
		}
		if($idPayment != ''){
			$cond.= ' AND id_raya = '.$idPayment;
		}
		if($idCatalog != ''){
			$cond.= ' AND id_act_an_rrhh = '.$idCatalog;
		}
		$strQuery = 'SELECT * FROM tbl_act_an_raya WHERE fecha_eliminado IS NULL'.$cond.' ORDER BY fecha_registro DESC';
		return $strQuery;
	}
	// AGREGA UNA ACTIVIDAD AÑADIDA A UN PAGO DE RAYA
	public function assignAddedActivitiesPayment($idPayment, $idAddedAct, $name, $amount, $date){
		$strQuery = 'INSERT INTO tbl_act_an_raya (id_raya, id_act_an_rrhh, concepto, monto, fecha_registro) VALUES ('.$idPayment.', '.$idAddedAct.', \''.$name.'\', '.$amount.', \''.$date.'\');';
		return $strQuery;
	}
	//ELIMINA UNA ACTIVIDAD AÑADIDA A UN PAGO DE RAYA
	public function deleteAddedActivitiesPayment($id, $date){
		$strQuery = 'UPDATE tbl_act_an_raya SET fecha_eliminado = \''.$date.'\' WHERE id_act_an = '.$id;
		return $strQuery;
	}
	//OBTIENE EL CATÁLOGO DE ACTIVIDADES AÑADIDAS
	public function getAddedActivities($id=""){
		$cond = '';
		if($id != ''){
			$cond.= ' AND id_actividad = '.$id;
		}
		$strQuery = 'SELECT *, id_actividad as id, nombre as valor FROM tblc_act_anadidas_rrhh WHERE fecha_eliminado IS NULL'.$cond.' ORDER BY fecha_registro DESC';
		return $strQuery;
	}

	public function deleteAddedActivity($id, $date){
		$strQuery = 'UPDATE tblc_act_anadidas_rrhh SET fecha_eliminado = \''.$date.'\' WHERE id_actividad = '.$id;
		return $strQuery;

	}
	/****************************************************************************/
	/****************************************************************************/
	/****************************************************************************/
	/************************AVANCE FISICO***************************************/
	/*****************************o**********************************************/
	/**********************REPORTE DE AVANCES************************************/
	/****************************************************************************/
	/****************************************************************************/
	//AGREGA UN AVANCE FÍSICO SIN FOLIO, YA QUE ÉSTE SE GENERA EN BASE AL ID QUE SE LE ASIGNÓ
	public function addNewPhysProg($id_work, $resident, $dateStart, $dateFinish, $date){
		$strQuery = 'INSERT INTO tbl_avance_fisico (id_obra, residente, fecha_inicio, fecha_termino, fecha_registro)';
		$strQuery.= ' VALUES ('.$id_work.', "'.$resident.'", "'.$dateStart.'", "'.$dateFinish.'", "'.$date.'")';
		return $strQuery;
	}

	//AGREGA UN FOLIO A UN AVANCE FÍSICO RECIÉN AGREGADO
	public function addFolioToNewPhysProg($id, $folio){
		$strQuery = 'UPDATE tbl_avance_fisico SET folio = "'.$folio.'" WHERE (id_avance_fisico = '.$id.');';
		return $strQuery;
	}
	//AGREGA UN CONCEPTO Y LA CANTIDAD USADA, QUE PERTENECEN A UN AVANCE FÍSICO
	public function addPPConcept($physprog, $concept, $quantity, $date){
		$strQuery = "INSERT INTO tbl_avance_fisico_conceptos(id_avance_fisico, id_concepto, cantidad, fecha_registro) ";
		$strQuery.= "VALUES (".$physprog.", ".$concept.", ".$quantity.", '".$date."');";
		return $strQuery;
	}
	//OBTIENE UN AVANCE FÍSICO POR ID, O POR ID DE LA OBRA A LA QUE PERTENECE
	public function getPhysProg($id = '', $id_obra=''){
		$cond = ' ';
		if($id != ''){
			$cond.='AND id_avance_fisico = '.$id.' ';
		}
		if($id_obra != ''){
			$cond.='AND id_obra = '.$id_obra.' ';
		}

		$strQuery = 'SELECT id_avance_fisico as id, id_obra, folio, residente, fecha_inicio, fecha_termino FROM tbl_avance_fisico WHERE fecha_eliminacion IS NULL AND verificado = 0'.$cond;
		return $strQuery;
	}

	//OBTIENE EL ID DEL CONCEPTO QUE PERTENECE A UN REPORTE DE AVANCE/AVANCE FÍSICO EN ESPECÍFICO
	public function getUsedConcept($id){
		$strQuery = 'SELECT id_avance_concepto as id, id_concepto, cantidad FROM tbl_avance_fisico_conceptos WHERE id_avance_fisico = '.$id.' ORDER BY fecha_registro DESC;';
		return $strQuery;
	}

	public function deleteConcept($id){
		$strQuery = 'DELETE FROM tbl_avance_fisico_conceptos WHERE id_avance_concepto = '.$id;
		return $strQuery;
	}

	//OBTIENE LA SUMA DE UN CONCEPTO AÑADIDO. SI NECESITAS ALGUNO CON UN AVANCE FÍSICO
	//EN ESPECÍFICO, LLAMA EL MÉTODO ASÍ: getAddedConcept('', $id_avance_fisico)
	//SI NECESITAS SÓLO UN CONCEPTO EN BASE A SU ID, LLAMA EL MÉTODO ASÍ:
	//getAddedConcept($id_concepto, '') ó getAddedConcept($id_concepto)
	public function getAddedConcept($id_concepto = '', $id_avance_fisico = ''){
		$cond = ' ';
		if($id_concepto != ''){
			$cond.= 'AND id_concepto = '.$id_concepto.' ';
		}
		if($id_avance_fisico != ''){
			$cond.= 'AND id_avance_fisico = '.$id_avance_fisico;
		}
		$strQuery = 'SELECT SUM(cantidad) as quantity_used FROM tbl_avance_fisico_conceptos WHERE id_avance_fisico IS NOT NULL'.$cond;
		return $strQuery;
	}
	//FUNCIÓN PARA OBTENER LA CANTIDAD TOTAL DE CONCEPTOS DE UN PRESUPUESTO
	public function getTotalBudget($id){
		$strQuery = 'SELECT SUM(cantidad) as total_quantity FROM tbl_presupuesto_obra WHERE fecha_eliminado IS NULL AND id_obra = '.$id;
		return $strQuery;
	}

	public function getConceptFromBudget($id_budget){
		$strQuery = 'SELECT id_presupuesto_obra as id, codigo, concepto, unidad, cantidad FROM tbl_presupuesto_obra WHERE fecha_eliminado IS NULL AND id_presupuesto_obra = '.$id_budget.';';
		return $strQuery;
	}

	public function deletePhysProg($id, $date){
		$strQuery = 'UPDATE tbl_avance_fisico SET fecha_eliminacion = "'.$date.'" WHERE (id_avance_fisico = '.$id.');';
		return $strQuery;
	}

	public function updatePhysProg($id_phys_prog, $id_work, $resident, $dateStart, $dateFinish){
		$strQuery = "UPDATE tbl_avance_fisico SET id_obra= '".$id_work."', residente = '".$resident."', fecha_inicio = '".$dateStart."', fecha_termino= '".$dateFinish."' WHERE id_avance_fisico = '".$id_phys_prog."'";
		return $strQuery;
	}

	public function updatePPConcept($id, $quantity){
		$strQuery = "UPDATE tbl_avance_fisico_conceptos SET cantidad = ".$quantity." WHERE id_avance_concepto = ".$id."";
		return $strQuery;
	}

	/****************************************************************************/
	/****************************************************************************/
	/****************************************************************************/
	/******************************CATÁLOGO**************************************/
	/********************************NIVEL***************************************/
	/****************************************************************************/
	/****************************************************************************/
	/****************************************************************************/
	public function getLevels($id=''){
		$cond = ' ';
		if($id != ''){
			$cond.= 'AND id_nivel = '.$id;
		}
		$strQuery = 'SELECT * FROM tblc_nivel WHERE fecha_eliminacion IS NULL'.$cond;
		return $strQuery;
	}

	public function addLevel($name, $date){
		$strQuery = 'INSERT INTO tblc_nivel (nombre, fecha_registro) VALUES ("'.$name.'", "'.$date.'")';
		return $strQuery;
	}

	public function editLevel($id, $name){
		$strQuery = 'UPDATE tblc_nivel SET nombre = "'.$name.'" WHERE (id_nivel = '.$id.');';
		return $strQuery;
	}

	public function deleteLevel($id, $date){
		$strQuery = 'UPDATE tblc_nivel SET fecha_eliminacion = "'.$date.'" WHERE (id_nivel = '.$id.');';
		return $strQuery;
	}

	/****************************************************************************/
	/****************************************************************************/
	/****************************************************************************/
	/******************************CATÁLOGO**************************************/
	/******************************EMPRESAS**************************************/
	/****************************************************************************/
	/****************************************************************************/
	/****************************************************************************/
	public function getCompanies($id=''){
		$cond = ' ';
		if($id != ''){
			$cond.= 'AND id_empresa = '.$id;
		}
		$strQuery = 'SELECT * FROM tblc_empresas WHERE fecha_eliminacion IS NULL'.$cond;
		return $strQuery;
	}

	public function addCompany($name, $date){
		$strQuery = 'INSERT INTO tblc_empresas (nombre, fecha_registro) VALUES ("'.$name.'", "'.$date.'")';
		return $strQuery;
	}

	public function editCompany($id, $name){
		$strQuery = 'UPDATE tblc_empresas SET nombre = "'.$name.'" WHERE (id_empresa = '.$id.');';
		return $strQuery;
	}

	public function deleteCompany($id, $date){
		$strQuery = 'UPDATE tblc_empresas SET fecha_eliminacion = "'.$date.'" WHERE (id_empresa = '.$id.');';
		return $strQuery;
	}

	/****************************************************************************/
	/****************************************************************************/
	/****************************************************************************/
	/******************************LICITACIONES**********************************/
	/****************************************************************************/
	/****************************************************************************/
	/****************************************************************************/
	/****************************************************************************/
	public function getBiddings($id = ''){
		$cond = ' ';
		if($id != ''){
			$cond.= 'AND id_licitacion = '.$id;
		}
		$strQuery = 'SELECT * FROM tbl_licitaciones WHERE fecha_eliminacion IS NULL'.$cond;
		return $strQuery;
	}

	public function addBidding($bidNumber, $work, $proposedDelivery, $place, $failDate, $file, $date){
		$strQuery = 'INSERT INTO tbl_licitaciones (numero_licitacion, nombre_obra, entrega_propuesta, lugar, fecha_fallo, archivo, fecha_registro) VALUES ('.$bidNumber.', \''.$work.'\',\''.$proposedDelivery.'\','.$place.',\''.$failDate.'\',\''.$file.'\',\''.$date.'\')';
		return $strQuery;
	}

	public function editBidding($id, $bidNumber, $work, $proposedDelivery, $place, $failDate, $file, $date){
		$strQuery = 'UPDATE tbl_licitaciones SET numero_licitacion = '.$bidNumber.', nombre_obra = \''.$work.'\', entrega_propuesta = \''.$proposedDelivery.'\', lugar = '.$place.', fecha_fallo = \''.$failDate.'\', archivo = \''.$file.'\' WHERE id_licitacion = '.$id;
		return $strQuery;
	}

	public function deleteBidding($id, $date){
		$strQuery = 'UPDATE tbl_licitaciones SET fecha_eliminacion = \''.$date.'\' WHERE id_licitacion = '.$id;
		return $strQuery;
	}

	/****************************************************************************/
	/****************************************************************************/
	/***************************CATÁLOGO DE TIPO*********************************/
	/******************************DE GASTOS*************************************/
	/****************************************************************************/
	/****************************************************************************/

	public function getTypesOfExpenses($id = ''){
		$cond = '';
		if($id != ''){
			$cond.= ' AND id_tipo_gasto = '.$id;
		}

		$strQuery = 'SELECT id_tipo_gasto, id_tipo_gasto as id, nombre, nombre as valor FROM tblc_tipo_gasto WHERE fecha_eliminado IS NULL'.$cond;

		return $strQuery;
	}

	public function addTypeOfExpenses($name){
		$strQuery = 'INSERT INTO tblc_tipo_gasto (nombre) VALUES (\''.$name.'\')';
		return $strQuery;
	}

	public function updateTypeOfExpenses($id, $name){
		$strQuery = 'UPDATE tblc_tipo_gasto SET nombre = \''.$name.'\' WHERE (id_tipo_gasto = '.$id.')';
		return $strQuery;
	}

	public function deleteTypeOfExpenses($id, $date){
		$strQuery = 'UPDATE tblc_tipo_gasto SET fecha_eliminado = \''.$date.'\' WHERE (id_tipo_gasto = '.$id.')';
		return $strQuery;
	}

	/****************************************************************************/
	/****************************************************************************/
	/****************************************************************************/
	/*********************************GASTOS*************************************/
	/****************************************************************************/
	/****************************************************************************/
	/****************************************************************************/

	public function getExpenses($id = '', $month = '', $year = '', $expenseType = ''){
		$cond = '';
		if($id != ''){
			$cond.= ' AND id_gasto';
		}
		if($month != ''){
			$cond.= ' AND MONTH(fecha_pago) = \''.$month.'\'';
		}
		if($year != ''){
			$cond.= ' AND YEAR(fecha_pago) = \''.$year.'\'';
		}

		$strQuery = 'SELECT * FROM tbl_gastos WHERE fecha_registro IS NOT NULL'.$cond;

		return $strQuery;
	}

	//$_SESSION['dUsuario']['id_usuario']

	public function addExpense($idUser, $idProperty, $idTOExpense, $amount, $description, $datePayment, $date, $status){
		$strQuery = 'INSERT INTO tbl_gastos (id_usuario, id_propiedad, id_tipo_gasto, monto, descripcion, fecha_pago, fecha_registro, estatus)
		VALUES (\''.$idUser.'\', \''.$idProperty.'\', \''.$idTOExpense.'\', \''.$amount.'\', \''.$description.'\', \''.$datePayment.'\', \''.$date.'\', \''.$status.'\')';
		return $strQuery;
	}

	public function updateExpense($idExpense, $idUser, $idProperty, $idTOExpense, $amount, $remarks, $datePayment, $date, $status){
		$strQuery = 'UPDATE tbl_gastos SET
		 id_usuario = '.$idUser.', id_propiedad = '.$idProperty.', id_tipo_gasto = '.$idTOExpense.',
		 monto = '.$amount.', descripcion = \''.$description.'\', fecha_pago = \''.$datePayment.'\',
		 fecha_registro = \''.$date.'\', estatus = '.$status.' WHERE (id_gasto = '.$idExpense.')';
		return $strQuery;
	}

	public function deleteExpense($id){
		$strQuery = 'UPDATE tbl_gastos SET estatus = 2 WHERE (id_gasto = '.$id.')';
		return $strQuery;
	}

	/****************************************************************************/
	/****************************************************************************/
	/****************************************************************************/
	/****************************GASOLINA INTERNA********************************/
	/****************************************************************************/
	/****************************************************************************/
	/****************************************************************************/
	function listInsFuelExp($id = ''){
		$cond = '';
		if($id != ''){
			$cond = ' AND id_gas_int = '.$id;
		}
		$strQuery = 'SELECT * FROM tbl_gasolina_interna WHERE fecha_eliminado IS NULL'.$cond.' ORDER BY fecha_registro DESC';

		return $strQuery;
	}

	function addInsFuelExpFolio($id, $folio){
		$strQuery = 'UPDATE tbl_gasolina_interna SET folio = \''.$folio.'\' WHERE id_gas_int = '.$id;
		return $strQuery;
	}

	function addInsFuelExp($dateS, $dateF, $magnaLiters, $premiumLiters,
													$dieselLiters, $magnaPrice, $premiumPrice, $dieselPrice,
													$status, $amount, $date, $work){
		$strQuery = 'INSERT INTO tbl_gasolina_interna ';
		$strQuery.= '(fecha_inicio, fecha_final, id_obra, litros_magna, litros_premium,
									litros_diesel, precio_magna, precio_premium, precio_diesel, status, monto,
									fecha_registro) ';
		$strQuery.= 'VALUES (\''.$dateS.'\', \''.$dateF.'\', '.$work.',
									'.$magnaLiters.', '.$premiumLiters.', '.$dieselLiters.',
									'.$magnaPrice.', '.$premiumPrice.', '.$dieselPrice.', '.$status.',
									'.$amount.', \''.$date.'\')';

		return $strQuery;
	}

	function getInsFuelExpEmployees($idInsFuelExp = ''){
		$cond = '';

		if($idInsFuelExp != ''){
			$cond = ' AND id_gas_int = '.$idInsFuelExp;
		}

		$strQuery = 'SELECT * FROM tbl_gas_int_empleados WHERE fecha_eliminado IS NULL'.$cond;

		return $strQuery;
	}

	function addAssignedFuelExpEmployee($idEmployee, $idInsFuelExp, $liters, $amount, $fuelType, $machineryType, $location, $date, $kilometers){
		$strQuery = 'INSERT INTO `demosystem_siga`.`tbl_gas_int_empleados`
									(id_empleado, id_gas_int, litros, monto_asignado, tipo_combustible, tipo_vehiculo, ubicacion, fecha_asignacion, kilometraje)
									VALUES ('.$idEmployee.', '.$idInsFuelExp.', '.$liters.', '.$amount.', '.$fuelType.', '.$machineryType.', \''.$location.'\', \''.$date.'\', '.$kilometers.')';
		return $strQuery;
	}

	function getTotalLitersByType($fuelType, $insFuelExp){
		switch ($fuelType) {
			case 1:
				$strQuery = 'SELECT litros_magna as total FROM tbl_gasolina_interna WHERE fecha_eliminado IS NULL AND id_gas_int = '.$insFuelExp;
			break;
			case 2:
				$strQuery = 'SELECT litros_premium as total FROM tbl_gasolina_interna WHERE fecha_eliminado IS NULL AND id_gas_int = '.$insFuelExp;
			break;
			case 3:
				$strQuery = 'SELECT litros_diesel as total FROM tbl_gasolina_interna WHERE fecha_eliminado IS NULL AND id_gas_int = '.$insFuelExp;
			break;
		}
		return $strQuery;
	}

	function getUsedLitersByType($fuelType, $insFuelExp){
		$strQuery = 'SELECT * FROM tbl_gas_int_empleados WHERE fecha_eliminado IS NULL AND tipo_combustible = '.$fuelType.' AND id_gas_int = '.$insFuelExp;
		return $strQuery;
	}

	function updateInsFuelExp($id, $initDate, $finishDate, $magnaLiters, $premiumLiters,
													$dieselLiters, $magnaPrice, $premiumPrice, $dieselPrice,
													$status, $amount, $work){
		$strQuery = 'UPDATE tbl_gasolina_interna SET fecha_inicio = \''.$initDate.'\', fecha_final = \''.$finishDate.'\', id_obra = '.$work.', litros_magna = '.$magnaLiters.', litros_premium = '.$premiumLiters.', litros_diesel = '.$dieselLiters.', precio_magna = '.$magnaPrice.', precio_premium = '.$premiumPrice.', precio_diesel = '.$dieselPrice.', status = '.$status.', monto = '.$amount.' WHERE (id_gas_int = '.$id.');';
		return $strQuery;
	}

	function deleteInsFuelExp($id, $date){
		$strQuery = 'UPDATE tbl_gasolina_interna SET fecha_eliminado = \''.$date.'\' WHERE (id_gas_int = '.$id.')';
		return $strQuery;
	}

	function deleteInsFuelExpEmpl($id, $date){

		$strQuery = 'UPDATE tbl_gas_int_empleados SET fecha_eliminado = \''.$date.'\' WHERE (id_gas_int_empl = '.$id.')';

		return $strQuery;
	}

	//****************************************************************************
	//****************************************************************************
	//***********************QUERYS PARA CATÁLOGO STATUS**************************
	//****************************************************************************
	//****************************************************************************

	public function listInsFuelExpStatus($id=''){
		$cond = '';
		if($id != ''){
			$cond = ' AND id_status = '.$id;
		}
		$strQuery = 'SELECT * FROM tblc_status_gerencia WHERE fecha_eliminado IS NULL'.$cond;

		return $strQuery;
	}

	public function addInsFuelExpStatus($name){
		$strQuery = 'INSERT INTO tblc_status_gerencia (nombre) VALUES (\''.$name.'\');';
		return $strQuery;
	}

	public function updateInsFuelExpStatus($id, $name){
		$strQuery = 'UPDATE tblc_status_gerencia SET nombre = \''.$name.'\' WHERE id_status = '.$id.';';
		return $strQuery;
	}

	public function deleteInsFuelStatus($id, $date){
		$strQuery = 'UPDATE tblc_status_gerencia SET fecha_eliminado = \''.$date.'\' WHERE id_status = '.$id.';';
		return $strQuery;
	}

	/****************************************************************************/
	/****************************************************************************/
	/****************************************************************************/
	/*********************QUERYS PARA CATÁLOGO CONCEPTOS*************************/
	/*****************************CONTABILIDAD***********************************/
	/****************************************************************************/
	/****************************************************************************/

	public function listConceptsAcc($id = ''){
		$cond = '';
		if($id != ''){
			$cond = ' AND id_concepto = '.$id;
		}

		$strQuery = 'SELECT id_concepto as id, id_concepto, nombre as valor, nombre, fecha_registro FROM tblc_conceptos_cont WHERE fecha_eliminado IS NULL'.$cond.' ORDER BY fecha_registro DESC';

		return $strQuery;
	}

	public function addConceptAcc($name, $date){
		$strQuery = 'INSERT INTO tblc_conceptos_cont (nombre, fecha_registro) VALUES (\''.$name.'\', \''.$date.'\')';
		return $strQuery;
	}

	public function updateConceptAcc($id, $name){
		$strQuery = 'UPDATE tblc_conceptos_cont SET nombre = \''.$name.'\' WHERE id_concepto = '.$id;
		return $strQuery;
	}

	public function deleteConceptAcc($id, $date){
		$strQuery = 'UPDATE tblc_conceptos_cont SET fecha_eliminado = \''.$date.'\' WHERE id_concepto = '.$id;
		return $strQuery;
	}

	/****************************************************************************/
	/****************************************************************************/
	/****************************************************************************/
	/********************QUERYS PARA CATÁLOGO PROVEEDORES************************/
	/*****************************CONTABILIDAD***********************************/
	/****************************************************************************/
	/****************************************************************************/

	public function listProvidersAcc($id = ''){
		$cond = '';
		if($id != ''){
			$cond = ' AND id_proveedor = '.$id;
		}

		$strQuery = 'SELECT id_proveedor as id, id_proveedor, nombre as valor, nombre, fecha_registro FROM tblc_proveedores_cont WHERE fecha_eliminado IS NULL'.$cond.' ORDER BY fecha_registro DESC';

		return $strQuery;
	}

	public function addProviderAcc($name, $date){
		$strQuery = 'INSERT INTO tblc_proveedores_cont (nombre, fecha_registro) VALUES (\''.$name.'\', \''.$date.'\')';
		return $strQuery;
	}

	public function updateProviderAcc($id, $name){
		$strQuery = 'UPDATE tblc_proveedores_cont SET nombre = \''.$name.'\' WHERE id_proveedor = '.$id;
		return $strQuery;
	}

	public function deleteProviderAcc($id, $date){
		$strQuery = 'UPDATE tblc_proveedores_cont SET fecha_eliminado = \''.$date.'\' WHERE id_proveedor = '.$id;
		return $strQuery;
	}

	/****************************************************************************/
	/****************************************************************************/
	/****************************************************************************/
	/**********************QUERYS PARA MÓDULO INGRESOS***************************/
	/*****************************CONTABILIDAD***********************************/
	/****************************************************************************/
	/****************************************************************************/

	public function listIncomes($id = ''){
		$cond = '';

		if($id != ''){
			$cond = ' AND id_ingreso = '.$id;
		}

		$strQuery = 'SELECT * FROM tbl_ingresos WHERE fecha_eliminado IS NULL'.$cond.' ORDER BY id_ingreso DESC';

		return $strQuery;
	}

	public function addIncome($billNum, $billDate, $chargeDate, $concept, $provider,
	 $conceptText, $withhold, $repAvance, $repIVA, $date, $iva, $subtotal){
		 $strQuery = 'INSERT INTO tbl_ingresos (numero_factura, fecha_factura,
			 fecha_cobro, monto_total, id_tipo_concepto, id_proveedor, concepto, retencion_iva, amort_anticipo,
			 iva_amort, fecha_registro, iva, subtotal) VALUES (\''.$billNum.'\', \''.$billDate.'\',
				 \''.$chargeDate.'\', '.$subtotal.','.$concept.', '.$provider.', \''.$conceptText.'\',
				 '.$withhold.', '.$repAvance.', '.$repIVA.', \''.$date.'\', '.$iva.', '.$subtotal.')';
		 return $strQuery;
	 }

	public function updateIncome($id, $billNum, $billDate, $chargeDate, $concept, $provider,
	 $conceptText, $withhold, $repAvance, $repIVA, $iva, $subtotal){
		 $strQuery = 'UPDATE tbl_ingresos SET numero_factura = \''.$billNum.'\', fecha_factura = \''.$billDate.'\',
			 fecha_cobro = \''.$chargeDate.'\', id_tipo_concepto = '.$concept.', id_proveedor = '.$provider.', concepto = \''.$conceptText.'\', retencion_iva = '.$withhold.', amort_anticipo = '.$repAvance.',
			 iva_amort = '.$repIVA.', fecha_registro = \''.$date.'\', iva = '.$iva.', subtotal = '.$subtotal.' WHERE id_ingreso = '.$id;
		 return $strQuery;
	 }

	 public function deleteIncome($id, $date){
		 $strQuery = 'UPDATE tbl_ingresos set fecha_eliminado = \''.$date.'\' WHERE id_ingreso ='.$id;
		 return $strQuery;
	 }

	 public function listAssConceptsAcc($id = '', $idIncome = ''){
		 $cond = '';
		 if($id != ''){
			 $cond.= ' AND id_concepto = '.$id;
		 }
		 if($idIncome != ''){
			 $cond.= ' AND id_ingreso = '.$idIncome;
		 }
		 $strQuery = 'SELECT * FROM tbl_conceptos_ingr WHERE fecha_eliminado IS NULL'.$cond;
		 return $strQuery;
	 }

	 public function addAssConceptAcc($idIncome, $name, $amount, $date){
		 $strQuery = 'INSERT INTO tbl_conceptos_ingr
		 							(id_ingreso, nombre, monto, fecha_registro) VALUES
									('.$idIncome.', \''.$name.'\', '.$amount.', \''.$date.'\')';
		return $strQuery;
	 }

	 public function deleteAssConceptAcc($id, $date){
		 $strQuery = 'UPDATE tbl_conceptos_ingr SET fecha_eliminado = \''.$date.'\' WHERE id_concepto = '.$id;
		 return $strQuery;
	 }

	 /****************************************************************************/
	 /****************************************************************************/
	 /****************************************************************************/
	 /**************************CATÁLOGO DEPARTAMENTOS****************************/
	 /****************************************************************************/
	 /****************************************************************************/
	 /****************************************************************************/

	 public function listDepartments($id='', $order = ''){
		 $cond = '';
		 if($id != ''){
			 $cond.= ' AND id_departamento = '.$id;
		 }

		 if($order == ''){
			 $cond.= ' ORDER BY nombre ASC';
		 } else {
			 switch($order){
				 case 0:
				 	$cond.= '';
				 break;
				 case 1:
				 	$cond.= ' ORDER BY id_departamento DESC';
				 break;
			 }
		 }

		 $strQuery = 'SELECT *, nombre as valor, id_departamento as id FROM tblc_departamentos WHERE fecha_eliminado IS NULL'.$cond;
		 return $strQuery;
	 }

	 public function addDepartment($name, $date){
		 $strQuery = 'INSERT INTO tblc_departamentos (nombre) VALUES (\''.$name.'\')';
		 return $strQuery;
	 }

	 public function updateDepartment($id, $name){
		 $strQuery = 'UPDATE tblc_departamentos set nombre = \''.$name.'\' WHERE id_departamento = '.$id;
		 return $strQuery;
	 }

	 public function deleteDepartment($id, $date){
		 $strQuery = 'UPDATE tblc_departamentos set fecha_eliminado = \''.$date.'\' WHERE id_departamento = '.$id;
		return $strQuery;
	 }

	 /****************************************************************************/
	 /****************************************************************************/
	 /****************************************************************************/
	 /*******************************CATÁLOGO AREA********************************/
	 /****************************************************************************/
	 /****************************************************************************/
	 /****************************************************************************/

	 public function listAreas($id='', $idDpt = ''){
		 $cond = '';
		 if($id != ''){
			 $cond.= ' AND id_area = '.$id;
		 }
		 if($idDpt != ''){
			 $cond.= ' AND id_departamento = '.$idDpt;
		 }

		 $strQuery = 'SELECT *, nombre as valor, id_area as id FROM tblc_areas WHERE fecha_eliminado IS NULL'.$cond.' ORDER BY id_area DESC';
		 return $strQuery;
	 }

	 /****************************************************************************/
	 /****************************************************************************/
	 /****************************************************************************/
	 /**************************MODULO SOLICITUD ASFALTO**************************/
	 /****************************************************************************/
	 /****************************************************************************/
	 /****************************************************************************/

	 public function listAsphaltRequests($id = '', $work = '', $ord = ''){
		 $cond = '';
		 if($id != ''){
			 $cond.= ' AND id_solicitud ='.$id;
		 }

		 if($work != ''){
			 $cond.= ' AND id_obra ='.$work;
		 }

		 $order = '';

		 switch ($ord) {
			case 1:
				$order = ' ORDER BY fecha_registro DESC';
			break;
			default:
				$order = ' ORDER BY id_solicitud ASC';
			break;
		 }

		 $strQuery = 'SELECT * FROM tbl_solicitudes_asfalto WHERE fecha_eliminado IS NULL'.$cond.$order;
		 return $strQuery;
	 }

	 public function addAsphaltRequest($work, $workR, $asphalt, $asphaltR, $emul, $emulR, $fuel, $fuelR, $date){
		 $strQuery = 'INSERT INTO tbl_solicitudes_asfalto
		 							(id_obra, fecha_entrega, litros_asfalto, entrega_asfalto, litros_emulsion,
									entrega_emulsion, litros_combust_alt, entrega_combust, fecha_registro) VALUES
									('.$work.', \''.$workR.'\', '.$asphalt.', \''.$asphaltR.'\', '.$emul.', \''.$emulR.'\', '.$fuel.', \''.$fuelR.'\', \''.$date.'\');';
		 return $strQuery;
	 }

	 public function updateAsphaltRequest($id, $work, $workR, $asphalt, $asphaltR, $emul, $emulR, $fuel, $fuelR){
		 $strQuery = 'UPDATE tbl_solicitudes_asfalto SET id_obra = '.$work.', fecha_entrega = \''.$workR.'\', litros_asfalto = '.$asphalt.', entrega_asfalto = \''.$asphaltR.'\', litros_emulsion = '.$emul.', entrega_emulsion = \''.$emulR.'\', litros_combust_alt = '.$fuel.', entrega_combust = \''.$fuelR.'\' WHERE (id_solicitud = '.$id.');';
		 return $strQuery;
	 }

	 public function deleteAsphaltRequest($id, $date){
		 $strQuery = 'UPDATE tbl_solicitudes_asfalto SET fecha_eliminado = \''.$date.'\' WHERE (id_solicitud = '.$id.');';
		 return $strQuery;
	 }

	 /****************************************************************************/
	 /****************************************************************************/
	 /****************************************************************************/
	 /**************************MODULO SOLICITUD ASFALTO**************************/
	 /****************************************************************************/
	 /****************************************************************************/
	 /****************************************************************************/

	 public function listAsphaltReports($id = '', $work = '', $ord = ''){
		 $cond = '';
		 if($id != ''){
			 $cond.= ' AND id_reporte ='.$id;
		 }

		 if($work != ''){
			 $cond.= ' AND id_obra ='.$work;
		 }

		 $order = '';

		 switch ($ord) {
			case 1:
				$order = ' ORDER BY fecha_registro DESC';
			break;
			default:
				$order = ' ORDER BY id_reporte ASC';
			break;
		 }

		 $strQuery = 'SELECT * FROM tbl_reportes_asfalto WHERE fecha_eliminado IS NULL'.$cond.$order;
		 return $strQuery;
	 }

	 public function addAsphaltReport($date, $work, $asphalt, $conAsphalt, $emul, $conEmul, $termoCapacity, $operatorName, $dateRegister){
		 $strQuery = 'INSERT INTO tbl_reportes_asfalto
		 							(fecha_reporte, id_obra, litros_asfalto, asfalto_consumido,
										litros_emulsion, emulsion_consumida, capacidad_termo,
										nombre_operador, fecha_registro) VALUES
										(\''.$date.'\', '.$work.', '.$asphalt.', '.$conAsphalt.', '.$emul.', '.$conEmul.', '.$termoCapacity.', \''.$operatorName.'\', \''.$dateRegister.'\');';
		 return $strQuery;
	 }

	 public function editAsphaltReport($id, $reportDate, $work, $asphaltLiters, $asphaltConsumed, $emulsionLiters, $emulsionConsumed, $termoCapacity, $plantOperator){
		 $strQuery = 'UPDATE tbl_reportes_asfalto SET fecha_reporte = \''.$reportDate.'\', id_obra = '.$work.', litros_asfalto = '.$asphaltLiters.', asfalto_consumido = '.$asphaltConsumed.', litros_emulsion = '.$emulsionLiters.', emulsion_consumida = '.$emulsionConsumed.', capacidad_termo = '.$termoCapacity.', nombre_operador = \''.$plantOperator.'\' WHERE (id_reporte = '.$id.');';
		 return $strQuery;
	 }

	 public function deleteAsphaltReport($id, $date){
		 $strQuery = 'UPDATE tbl_reportes_asfalto SET fecha_eliminado = \''.$date.'\' WHERE (id_reporte = '.$id.');';
		 return $strQuery;
	 }

	 public function listAsphaltReportConsumption($id, $idReport){
		 $cond = '';

		 if($id != ''){
			 $cond = ' AND id_consumo = '.$id;
		 }

		 if($idReport != ''){
			 $cond = ' AND id_reporte = '.$idReport;
		 }

		 $strQuery = 'SELECT * FROM tbl_reporte_asfalto_consumo WHERE fecha_eliminado IS NULL'.$cond;
		 return $strQuery;
	 }

	 public function addAsphaltReportConsumption($idReport, $carries, $plant, $generator, $caldrown, $auxiliar, $date){
		 $strQuery = 'INSERT INTO tbl_reporte_asfalto_consumo (id_reporte, numero_viajes, consumo_planta, consumo_generador, consumo_caldera, consumo_auxiliar, fecha_registro) VALUES ('.$idReport.', '.$carries.','.$plant.', '.$generator.', '.$caldrown.', '.$auxiliar.', \''.$date.'\');';
		 return $strQuery;
	 }

	 public function deleteAsphaltReportConsumption($id, $date){
		 $strQuery = 'UPDATE tbl_reporte_asfalto_consumo SET fecha_eliminado = \''.$date.'\' WHERE (id_consumo = '.$id.');';
		return $strQuery;
	 }
	/****************************************************************************/
	/****************************************************************************/
	/****************************************************************************/
	/****************************************************************************/
	/****************************************************************************/
	/****************************************************************************/
	/****************************************************************************/
	/****************************************************************************/


	public function fillSelectInsFuelExpStatus($results){
		foreach ($results as $result) {
			echo '<option value ="'.$result->id_status.'">'.$this->cdetectUtf8($result->nombre).'</option>';
		}
	}

	public function listMachineryTypes($id = ''){
		$cond = '';
		if($id != ''){
			$cond = ' AND id_tipo_maquinaria = '.$id;
		}
		$strQuery = 'SELECT id_tipo_maquinaria as id, nombre FROM tblc_tipo_maquinaria WHERE fecha_eliminado IS NULL'.$cond;
		return $strQuery;
	}

	public function fillSelectMachineryTypes($results){
		foreach($results as $result){
			echo '<option value="'.$result->id.'">'.$this->cdetectUtf8($result->nombre).'</option>';
		}
	}

	public function listConcepts(){
		$strQuery = 'SELECT id_presupuesto_obra as id, codigo as codigo, id_obra as obra, concepto as concepto FROM tbl_presupuesto_obra ';
		$strQuery.= 'WHERE fecha_eliminado IS NULL ';
		return $strQuery;
	}

	public function llenarComboConceptos($resultados) {
		foreach($resultados as $resultado){
			echo '
			<option value="'.$resultado->id.'" id="concept'.$resultado->id.'" data-code="'.$resultado->codigo.'" data-work="'.$resultado->obra.'">'.$this->cdetectUtf8($resultado->concepto).'</option>
			';
			}
		}

		public function listClientes($id = '',$nombre='', $rfc='', $tipoCte='',$interes=0){
				$cond = '';

				$cond = ($id != '')? ' AND id_cliente = '.$id.' ':'';
				$cond.= ($nombre != '')? ' AND CONCAT(nombre," ",apellido_p," ", apellido_m) LIKE "%'.$nombre.'%" ':' ';
				$cond.= ($rfc != '')? ' AND rfc LIKE "%'.$rfc.'%" ':' ';
				$cond.= ($tipoCte != 0)? ' AND id_tipo = '.$tipoCte.' ':' ';

				$strQuery = 'SELECT id_cliente, id_cliente AS id, rfc, nombre, apellido_p, apellido_m, CONCAT(nombre," ",apellido_p," ",apellido_m) AS valor, correo, telefono, celular, estado_civil, domicilio, id_tipo, fecha_registro, observaciones ';
				$strQuery.= 'FROM tblc_clientes ';
				$strQuery.= 'WHERE fecha_eliminado IS NULL ';
				if($interes != 0)
				$strQuery.= 'AND id_cliente IN (SELECT id_cliente FROM tbl_interes_cliente WHERE fecha_eliminado IS NULL) ';
				//$strQuery.= $cond.'ORDER BY fecha_registro DESC, id_cliente DESC';
				$strQuery.= $cond.'ORDER BY valor';

				return $strQuery;
			}


		public function getListadoPropietarios($id = ''){
			$sentencia = ($id != '')? ' WHERE id_propietario = ' . $id:'';

			$strQuery = "SELECT @rownum:=@rownum+1 numero, t.id_propietario id, t.nombre valor,";
			$strQuery .= "t.nombre, t.fecha_registro ";
			$strQuery .= "FROM vw_catPropietarios t , (SELECT @rownum:=0) r " . $sentencia;
			$strQuery .= " ORDER BY valor;";

			return $strQuery;
		}

	 function getPropiedades($id = ''){
		 $sentencia = ($id != '')? ' WHERE id_propiedad = ' . $id . ' AND fecha_eliminado IS NULL':' WHERE fecha_eliminado IS NULL';
		 $strQuery = "SELECT @rownum:=@rownum+1 numero, t.*,t.id_propiedad id,t.descripcion valor,t.desarrollo id_desarrollo,t.monto monto ";
		 $strQuery .= "FROM tblc_propiedades t , (SELECT @rownum:=0) r " . $sentencia;
		 $strQuery .= " ORDER BY t.id_propiedad DESC;";

		 return $strQuery;
	 }

	 function getDetailedPropiedades($id = ''){
		 $strQuery = ' SELECT * FROM tblc_propiedades WHERE fecha_eliminado IS NULL';
		 return $strQuery;
	 }

	 public function llenarComboEmpleadoCat($resultados){
		 foreach($resultados as $resultado){
			 echo '
			 <option value="'.$resultado->id.'" name="'.$resultado->valor.'" data-cat="'.$resultado->category.'">'.$this->cdetectUtf8($resultado->valor).'</option>';
			 }
	 }

	 public function llenarcomboPropiedades($resultados) {
		 foreach($resultados as $resultado){
			 echo '
			 <option value="'.$resultado->id.'" name="'.$resultado->valor.'" data-development="'.$resultado->id_desarrollo.'" data-amount="'.$resultado->monto.'">'.$this->cdetectUtf8($resultado->valor).'</option>
			 ';
			 }
		 }

		 public function cdetectUtf8($str){
			 if( mb_detect_encoding($str,"UTF-8, ISO-8859-1")!="UTF-8" ){

				 return  utf8_encode($str);
				 }
			 else{
				 return $str;
				 }

			 }

			 public function listMachineryAndVehicles(){
				 $strQuery = 'SELECT id_tipo_maquinaria as id, CONCAT(marca, ", ", modelo, ", ", numero_economico) as valor FROM tblc_maquinaria_vehiculo WHERE fecha_eliminado IS NULL ORDER BY valor ASC';
				 return $strQuery;
			 }
}
?>
