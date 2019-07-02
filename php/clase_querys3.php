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

		$strQuery = 'SELECT id_desarrollo, nombre, alias, codigo_postal, icono, fecha_registro ';
		$strQuery.= 'FROM tblc_desarrollo ';
		$strQuery.= 'WHERE fecha_eliminacion IS NULL'.$cond;
		$strQuery.= 'ORDER BY fecha_registro DESC, id_desarrollo DESC';

		return $strQuery;
	}

	//QUERY PARA AGREGAR UN REGISTRO AL CATÁLOGO DE DESARROLLO
	public function addCatDesarrollo($nombre, $alias, $codigo_postal, $icono, $fechaRegistro){
		$strQuery = 'INSERT INTO tblc_desarrollo ';
		$strQuery.= '(nombre, alias, codigo_postal, icono, fecha_registro) ';
		$strQuery.= 'VALUES("'.$nombre.'", "'.$alias.'", "'.$codigo_postal.'", "'.$icono.'", "'.$fechaRegistro.'")';

		return $strQuery;
	}

	//QUERY PARA EDITAR UN REGISTRO DEL CATÁLOGO DESARROLLO
	public function updateCatDesarrollo($idDesarrollo, $nombre, $alias, $codigo_postal, $icono){
		$strQuery = 'UPDATE tblc_desarrollo ';
		$strQuery.= 'SET nombre = "'.$nombre.'", alias = "'.$alias.'", codigo_postal = "'.$codigo_postal.'", icono = "'.$icono.'" ';
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

		$strQuery = 'SELECT id_obras, nombre, tipo, dependencia, monto, fecha_inicio, fecha_finalizacion, volumenes_carpeta, tipo_agregado, volumen_concreto, area_obra,  fecha_registro ';
		$strQuery.= 'FROM tbl_obras ';
		$strQuery.= 'WHERE fecha_eliminacion IS NULL'.$cond;
		$strQuery.= 'ORDER BY fecha_registro DESC, id_obras	 DESC';

		return $strQuery;
	}

	//QUERY PARA MARCAR CÓMO ELIMINADO UN REGISTRO DEL CATALOGO DESARROLLO
	public function eliminarRegObra($id, $fecha){
		$strQuery = 'UPDATE tbl_obras ';
		$strQuery.= 'SET fecha_eliminacion = "'.$fecha.'" ';
		$strQuery.= 'WHERE id_obras = '.$id;

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
		$strQuery = 'SELECT id_empleado, nombre, apellido_paterno, apellido_materno, direccion, rfc, imss, curp, fecha_admision, tipo, estado_civil, genero, categoria, departamento, area, fecha_registro ';
		$strQuery.= 'FROM tbl_empleados ';
		$strQuery.= 'WHERE fecha_eliminacion IS NULL'.$cond;
		$strQuery.= 'ORDER BY fecha_registro DESC, id_empleado DESC';

		return $strQuery;
	}
	//QUERY AGREGAR EMPLEADOS
	public function addEmpleado($nombre,$apellido_paterno,$apellido_materno, $direccion, $rfc, $imss, $curp, $fecha_admision, $tipo, $estado_civil, $genero, $categoria, $departamento, $area, $fecha_registro){
		$strQuery = 'INSERT INTO tbl_empleados ';
		$strQuery.= '(nombre, apellido_paterno, apellido_materno, direccion, rfc, imss, curp, fecha_admision, tipo, estado_civil, genero, categoria, departamento, area, fecha_registro) ';
		$strQuery.= 'VALUES("'.$nombre.'", "'.$apellido_paterno.'", "'.$apellido_materno.'", "'.$direccion.'", "'.$rfc.'", "'.$imss.'", "'.$curp.'", "'.$fecha_admision.'", "'.$tipo.'", "'.$estado_civil.'", "'.$genero.'", "'.$categoria.'", "'.$departamento.'","'.$area.'", "'.$fecha_registro.'")';

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
}
?>
