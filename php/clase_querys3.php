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

		$strQuery = 'SELECT id_desarrollo, nombre, alias, numero_etapa_oferta, codigo_postal, icono, fecha_registro ';
		$strQuery.= 'FROM tblc_desarrollo ';
		$strQuery.= 'WHERE fecha_eliminacion IS NULL'.$cond;
		$strQuery.= 'ORDER BY fecha_registro DESC, id_desarrollo DESC';

		return $strQuery;
	}

	//QUERY PARA AGREGAR UN REGISTRO AL CATÁLOGO DE DESARROLLO
	public function addCatDesarrollo($nombre, $alias, $numero_etapa_oferta, $codigo_postal, $icono, $fechaRegistro){
		$strQuery = 'INSERT INTO tblc_desarrollo ';
		$strQuery.= '(nombre, alias, numero_etapa_oferta, codigo_postal, icono, fecha_registro) ';
		$strQuery.= 'VALUES("'.$nombre.'", "'.$alias.'", "'.$numero_etapa_oferta.'", "'.$codigo_postal.'", "'.$icono.'", "'.$fechaRegistro.'")';

		return $strQuery;
	}

	//QUERY PARA EDITAR UN REGISTRO DEL CATÁLOGO DESARROLLO
	public function updateCatDesarrollo($idDesarrollo, $nombre, $alias, $numero_etapa_oferta, $codigo_postal, $icono){
		$strQuery = 'UPDATE tblc_desarrollo ';
		$strQuery.= 'SET nombre = "'.$nombre.'", alias = "'.$alias.'", numero_etapa_oferta = "'.$numero_etapa_oferta.'", codigo_postal = "'.$codigo_postal.'", icono = "'.$icono.'" ';
		$strQuery.= 'WHERE id_desarrollo = '.$idDesarrollo;

		return $strQuery;
	}

	//QUERY PARA MARCAR CÓMO ELIMINADO UN REGISTRO DEL CATALOGO DESARROLLO
	public function eliminaRegCatDesarrollo($id, $fecha){
		$strQuery = 'UPDATE tblc_desarrollo ';
		$strQuery.= 'SET fecha_eliminacion = "'.$fecha.'" ';
		$strQuery.= 'WHERE id_obras = '.$id;

		return $strQuery;
	}

	//QUERY PARA AGREGAR UNA OBRA
	public function addObra($name, $type, $dependency, $amount, $dateStart, $dateFinish, $folderVol, $addedType, $concreteVol, $workArea, $fechaRegistro){
		$strQuery = 'INSERT INTO tbl_obras ';
		$strQuery.= '(nombre, tipo, dependencia, monto, fecha_inicio, fecha_finalizacion, volumenes_carpeta, tipo_agregado, volumen_concreto, area_obra,  fecha_registro) ';
		$strQuery.= 'VALUES("'.$name.'", "'.$type.'", "'.$dependency.'", "'.$amount.'", "'.$dateStart.'", "'.$dateFinish.'", "'.$folderVol.'", "'.$addedType.'", "'.$concreteVol.'", "'.$workArea.'", "'.$fechaRegistro.'")';

		return $strQuery;
	}

	//QUERY PARA OBTENER LISTADO OBRAS
	public function getListadoObras($id = ''){
		$cond = ' ';

		if($id != '') {
			$cond = ' AND id_obras = '.$id.' ';
		}

		$strQuery = 'SELECT id_obras, id_obras AS id, nombre, nombre AS valor, tipo, dependencia, monto, fecha_inicio, fecha_finalizacion, volumenes_carpeta, tipo_agregado, volumen_concreto, area_obra,  fecha_registro ';
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

	//QUERY PARA EDITAR UNA OBRA
	public function updateObra($id, $name, $type, $dependency, $amount, $dateStart, $dateFinish, $folderVol, $addedType, $concreteVol, $workArea) {

		$strQuery = 'UPDATE tbl_obras SET nombre = "'.$name.'"';
	  $strQuery .= ',tipo = "'.$type.'"';
	  $strQuery .= ',dependencia = "'.$dependency.'"';
	  $strQuery .= ',monto = "'.$amount.'",';
	  $strQuery .= 'fecha_inicio = "'.$dateStart.'",';
	  $strQuery .= 'fecha_finalizacion = "'.$dateFinish.'",';
	  $strQuery .= 'volumenes_carpeta = "'.$folderVol.'",';
	  $strQuery .= 'tipo_agregado = "'.$addedType.'",';
	  $strQuery .= 'volumen_concreto = "'.$concreteVol.'",';
	  $strQuery .= 'area_obra = "'.$workArea.'" ';
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
	public function getListadoEmpleados($nombre = '', $rfc = '', $imss = ''){
		$cond = ' ';

		if($nombre != '') {
			$cond = ' AND nombre LIKE "%'.$nombre.'%" ';
		}

		if($rfc != '') {
			$cond = ' AND rfc LIKE "%'.$rfc.'%" ';
		}

		if($imss != '') {
			$cond = ' AND imss LIKE "%'.$imss.'%" ';
		}
		//DON'T DELETE DUPLICATED ALIASES; THOSE ARE USED IN RAYAS MODULE
		$strQuery = 'SELECT id_empleado, id_empleado AS id,  nombre, CONCAT(nombre, " ",apellido_paterno, " ",apellido_materno) AS valor, categoria AS category, apellido_paterno, apellido_materno, direccion, rfc, imss, curp, fecha_admision, tipo, estado_civil, genero, categoria, departamento, area, fecha_registro ';
		$strQuery.= 'FROM tbl_empleados ';
		$strQuery.= 'WHERE fecha_eliminacion IS NULL'.$cond;
		$strQuery.= 'ORDER BY fecha_registro DESC, id_empleado DESC';

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

	//QUERY FOR ADDING RAYAS
	public function addPayment($dateStart, $dateFinish, $payment, $foodTotalAmount,
	$addedActivities, $addedActAmount, $totalAmount, $status, $observations, $employeeSelected,
	$workSelected, $currentDate){
	$strQuery = 'INSERT INTO tbl_rayas ';
	$strQuery.=	'(fecha_inicio, fecha_finalizacion, sueldo, alimentos, ot_act,
		ot_act_monto, total_raya, status, observaciones, id_empleado, id_obra, fecha_registro) VALUES ';

	$strQuery.= '("'.$dateStart.'","'.$dateFinish.'",'.$payment.','.$foodTotalAmount.','.$addedActivities.','.$addedActAmount.','.$totalAmount.','.$status.',"'.$observations.'",'.$employeeSelected.','.$workSelected.',"'.$currentDate.'")';

	return $strQuery;
	}

	//QUERY FOR SEARCHING RAYAS
	public function searchPayments(){

		return 'SELECT * FROM tbl_rayas';
	}

	//QUERY FOR ADDING NEW CONTRACTS
	public function addContract($folio, $id_cliente, $id_propiedad,
	$fecha_realizacion, $vigencia, $tipo_contrato, $monto, $id_arrendatario = '0',
	$id_propietario = '0', $enganche_deposito, $archivo, $observaciones, $fecha_actual){

		$strQuery = "INSERT INTO tblc_contratos (folio, id_cliente, id_propiedad, fecha_realizacion, vigencia, tipo_contrato, monto, id_arrendatario, id_propietario, enganche_deposito, archivo, observaciones, fecha_registro)
		VALUES ('".$folio."','".$id_cliente."','".$id_propiedad."','".$fecha_realizacion."','".$vigencia."','".$tipo_contrato."','".$monto."','".$id_arrendatario."','".$id_propietario."','".$enganche_deposito."','".$archivo."','".$observaciones."','".$fecha_actual."')";

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

	public function updateContract($id,$folio, $id_cliente, $id_propiedad,
	$fecha_realizacion, $vigencia, $tipo_contrato, $monto, $id_arrendatario = '0',
	$id_propietario = '0', $enganche_deposito, $archivo, $observaciones, $fecha_actual){
		$strQuery = 'UPDATE tblc_contratos SET folio='.$folio.', id_cliente = '.$id_cliente.', id_propiedad ='.$id_propiedad.', fecha_realizacion = '.$fecha_realizacion.', vigencia = '.$vigencia.', tipo_contrato = '.$tipo_contrato.', monto = '.$monto.', id_arrendatario = '.$id_arrendatario.', id_propietario'.$id_propietario.',
		 enganche_deposito = '.$enganche_deposito.', archivo = '.$archivo.', observaciones = '.$observaciones.' WHERE (id_contrato = '.$id.' )';
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

	public function listClientes($id = '',$nombre='', $rfc='', $tipoCte=''){
		$cond = '';

		$cond = ($id != '')? ' AND id_cliente = '.$id.' ':'';
		$cond.= ($nombre != '')? ' AND CONCAT(nombre," ",apellido_p," ", apellido_m) LIKE "%'.$nombre.'%" ':' ';
		$cond.= ($rfc != '')? ' AND rfc LIKE "%'.$rfc.'%" ':' ';
		$cond.= ($tipoCte != 0)? ' AND id_tipo = '.$tipoCte.' ':' ';

		$strQuery = 'SELECT id_cliente, id_cliente AS id, rfc, nombre, apellido_p, apellido_m, CONCAT(nombre," ",apellido_p," ",apellido_m) AS valor, correo, telefono, celular, estado_civil, domicilio, id_tipo, fecha_registro, observaciones ';
		$strQuery.= 'FROM tblc_clientes ';
		$strQuery.= 'WHERE fecha_eliminado IS NULL'.$cond;
		$strQuery.= 'ORDER BY fecha_registro DESC, id_cliente DESC';

		return $strQuery;
	}


	 public function getListadoPropietarios($id = ''){
	   $sentencia = ($id != '')? ' WHERE id_propietario = ' . $id:'';

	   $strQuery = "SELECT @rownum:=@rownum+1 numero, t.id_propietario id, t.nombre valor,";
	   $strQuery .= "t.nombre, t.fecha_registro ";
	   $strQuery .= "FROM vw_catPropietarios t , (SELECT @rownum:=0) r " . $sentencia;
	   $strQuery .= " ORDER BY numero;";

	   return $strQuery;
	 }

	 function getPropiedades($id = ''){
		 $sentencia = ($id != '')? ' WHERE id_propiedad = ' . $id:'';
		 $strQuery = "SELECT @rownum:=@rownum+1 numero, t.*,t.id_propiedad id,t.descripcion valor,t.desarrollo id_desarrollo,t.monto monto ";
		 $strQuery .= "FROM tblc_propiedades t , (SELECT @rownum:=0) r " . $sentencia;
		 $strQuery .= " ORDER BY t.id_propiedad DESC;";

		 return $strQuery;
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
}
?>
