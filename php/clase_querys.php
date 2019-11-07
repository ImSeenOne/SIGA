<?php
class Querys {
	//***************************************************************************************
	//*********************INICIA QUERYS PARA INICIO DE SESIÓN ******************************
	//CATÁLOGO CLOSET
	//QUERY PARA CARCAR EL LISTADO/OBTENER INFORMACIÓN DEL CATÁLOGO
	public function getClosetListado($id = ''){
		$cond = ($id != '')? ' AND id_closet = '.$id.' ':' ';

		$strQuery = 'SELECT id_closet, nombre, icono, fecha_registro ';
		$strQuery.= 'FROM tblc_closet ';
		$strQuery.= 'WHERE fecha_eliminado IS NULL'.$cond;
		$strQuery.= 'ORDER BY fecha_registro DESC, id_closet DESC';

		return $strQuery;
	}

	//QUERY PARA AGREGAR UN REGISTRO AL CATÁLOGO DE NÚMERO DE BAÑOS
	public function addCloset($nombre, $icono, $fechaRegistro){
		$strQuery = 'INSERT INTO tblc_closet ';
		$strQuery.= '(nombre, icono, fecha_registro) ';
		$strQuery.= 'VALUES("'.$nombre.'", "'.$icono.'", "'.$fechaRegistro.'")';

		return $strQuery;
	}


	//QUERY PARA EDITAR UN REGISTRO DEL CATÁLOGO ESTACIONAMIENTO
	public function updateCloset($id, $nombre, $icono){
		$strQuery = 'UPDATE tblc_closet ';
		$strQuery.= 'SET nombre = "'.$nombre.'", icono = "'.$icono.'" ';
		$strQuery.= 'WHERE id_closet = '.$id;

		return $strQuery;
	}

	//QUERY PARA MARCAR CÓMO ELIMINADO UN REGISTRO DEL CATÁLOGO DE CLOSETS
	public function eliminaCloset($id, $fecha){
		$strQuery = 'UPDATE tblc_closet ';
		$strQuery.= 'SET fecha_eliminado = "'.$fecha.'" ';
		$strQuery.= 'WHERE id_closet = '.$id;

		return $strQuery;
	}




	//CATÁLOGO NÚMERO DE BAÑOS++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	//QUERY PARA CARCAR EL LISTADO/OBTENER INFORMACIÓN DEL CATÁLOGO
	public function getListadoWc($id = ''){
		$cond = ($id != '')? ' AND id_num_banio = '.$id.' ':' ';

		$strQuery = 'SELECT id_num_banio, nombre, icono, fecha_registro ';
		$strQuery.= 'FROM tblc_num_banios ';
		$strQuery.= 'WHERE fecha_eliminado IS NULL'.$cond;
		$strQuery.= 'ORDER BY fecha_registro DESC, id_num_banio DESC';

		return $strQuery;
	}


	//QUERY PARA AGREGAR UN REGISTRO AL CATÁLOGO DE NÚMERO DE BAÑOS
	public function addCatWc($nombre, $icono, $fechaRegistro){
		$strQuery = 'INSERT INTO tblc_num_banios ';
		$strQuery.= '(nombre, icono, fecha_registro) ';
		$strQuery.= 'VALUES("'.$nombre.'", "'.$icono.'", "'.$fechaRegistro.'")';

		return $strQuery;
	}

	//QUERY PARA EDITAR UN REGISTRO DEL CATÁLOGO ESTACIONAMIENTO
	public function updateCatWc($idEstacionamiento, $nombre, $icono){
		$strQuery = 'UPDATE tblc_num_banios ';
		$strQuery.= 'SET nombre = "'.$nombre.'", icono = "'.$icono.'" ';
		$strQuery.= 'WHERE id_num_banio = '.$idEstacionamiento;

		return $strQuery;
	}

	//QUERY PARA MARCAR CÓMO ELIMINADO UN REGISTRO DEL CATÁLOGO DE NÚMERO DE BAÑOS
	public function eliminaRegWc($id, $fecha){
		$strQuery = 'UPDATE tblc_num_banios ';
		$strQuery.= 'SET fecha_eliminado = "'.$fecha.'" ';
		$strQuery.= 'WHERE id_num_banio = '.$id;

		return $strQuery;
	}



	//SERVICIOS-AMENIDADES+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

	//QUERY PARA OBTENER EL LISTADO DE LOS REGISTROS DEL CATÁLOGO DE SERVICIOS-AMENIDADES
	public function getServAmenidades_listado($id = ''){
		$cond = ($id != '')? ' AND id_servicio_amenidad = '.$id.' ':' ';

		$strQuery = 'SELECT id_servicio_amenidad, nombre, icono, fecha_registro ';
		$strQuery.= 'FROM tblc_servicio_amenidad ';
		$strQuery.= 'WHERE fecha_eliminado IS NULL'.$cond;
		$strQuery.= 'ORDER BY fecha_registro DESC, id_servicio_amenidad DESC';

		return $strQuery;
	}

	//QUERY PARA AGREGAR UN REGISTRO A LA TABLA DE SERVICIO-AMENIDADES
	public function addServAmenidad($nombre, $icono, $fechaRegistro){
		$strQuery = 'INSERT INTO tblc_servicio_amenidad ';
		$strQuery.= '(nombre, icono, fecha_registro) ';
		$strQuery.= 'VALUES("'.$nombre.'", "'.$icono.'", "'.$fechaRegistro.'")';

		return $strQuery;
	}

	//QUERY PARA EDITAR UN REGISTRO DEL CATÁLOGO SERVICIO-AMENIDADES
	public function updateServAmenidad($id, $nombre, $icono){
		$strQuery = 'UPDATE tblc_servicio_amenidad ';
		$strQuery.= 'SET nombre = "'.$nombre.'", icono = "'.$icono.'" ';
		$strQuery.= 'WHERE id_servicio_amenidad = '.$id;

		return $strQuery;
	}

	//QUERY PARA MARCAR CÓMO ELIMINADO UN REGISTRO DEL CATÁLOGO SERVICIO-AMENIDADES
	public function eliminaServAmenidad($id, $fecha){
		$strQuery = 'UPDATE tblc_servicio_amenidad ';
		$strQuery.= 'SET fecha_eliminado = "'.$fecha.'" ';
		$strQuery.= 'WHERE id_servicio_amenidad = '.$id;

		return $strQuery;
	}



	//APARTADO DE CLIENTES
	//QUERY PARA OBTENER EL ESTATUS DE LAS PROPIEDADES INTERES DE UN CLIENTE
	public function getEstatusPropIntCte($idCte){
		$strQuery = 'SELECT prop.id_propiedad, des.nombre AS desarrollo, prop.numero_edificio, nvl.nombre AS nivel, prop.numero_departamento, prop.direccion, tep.nombre AS estatus_propiedad ';
		$strQuery.= 'FROM tbl_interes_cliente AS tic ';
		$strQuery.= 'INNER JOIN tblc_propiedades AS prop ';
		$strQuery.= 'ON tic.id_propiedad = prop.id_propiedad ';
		$strQuery.= 'INNER JOIN tblc_estatus_propiedades AS tep ';
		$strQuery.= 'ON tic.estatus = tep.id_estatus ';
		$strQuery.= 'INNER JOIN tblc_desarrollo AS des ';
		$strQuery.= 'ON prop.desarrollo = des.id_desarrollo ';
		$strQuery.= 'INNER JOIN tblc_nivel AS nvl ';
		$strQuery.= 'ON prop.numero_nivel = nvl.id_nivel ';
		$strQuery.= 'WHERE tic.id_cliente = '.$idCte.' ';
		$strQuery.= 'ORDER BY tic.fecha_registro DESC';

		return $strQuery;
	}

	//QUERY PARA OBTENER EL LISTADO Y LOS DATOS DE LOS CLIENTES
	public function getClientesData($id = '',$optSelected=0, $txtBusqueda='', $tipoCte=0, $modalidad=0, $idPropiedad = 0){
		$cond = ''; $fieldFilter = '';
		$cond = ($id != '')? ' AND tc.id_cliente = '.$id.' ':'';

		switch ($optSelected) {
			case 1:
				$fieldFilter = 'CONCAT(tc.nombre," ",tc.apellido_p," ",tc.apellido_m)';
			break;

			case 2:
				$fieldFilter = 'tc.rfc';
			break;

			case 3:
				$fieldFilter = 'tc.curp';
			break;
		}
		$cond.= ($txtBusqueda != '')? ' AND '.$fieldFilter.' LIKE "%'.$txtBusqueda.'%" ':' ';
		$cond.= ($tipoCte != 0)? ' AND tc.id_tipo = '.$tipoCte.' ':' ';
		$cond.= ($modalidad != 0)? ' AND tc.id_modalidad = '.$modalidad.' ':' ';
		$cond.= ($idPropiedad != 0)? ' AND tic.id_propiedad = '.$idPropiedad.' ':' ';

		$strQuery = 'SELECT tc.id_cliente, tc.id_cliente AS id, tc.id_modalidad, tc.rfc, tc.curp, tc.nombre, tc.apellido_p, apellido_m, CONCAT(tc.nombre," ",tc.apellido_p," ",tc.apellido_m) AS valor, tc.correo, tc.telefono, tc.celular, tc.estado_civil, tc.domicilio, tc.id_tipo, tc.modalidad_otro, tc.fecha_registro, tc.observaciones, tc.nss, tc.curp, tc.modalidad_otro ';
		$strQuery.= 'FROM tblc_clientes AS tc ';
		$strQuery.= 'INNER JOIN tbl_interes_cliente AS tic ';
		$strQuery.= 'ON tc.id_cliente = tic.id_cliente ';
		$strQuery.= 'WHERE tc.fecha_eliminado IS NULL'.$cond;
		$strQuery.= 'ORDER BY tc.fecha_registro DESC, tc.id_cliente DESC';

		return $strQuery;
	}

	//QUERY PARA AGREGAR UN NUEVO REGISTRO DE LA TABLA DE CLINTES
	public function addCliente($idTipo,$idUsuario, $nombre, $apellidoP, $apellidoM, $rfc, $correo, $domicilio, $telefono, $celular, $estadoCivil, $observaciones, $fecha, $nss, $curp, $modalidad, $otros){
		$strQuery = 'INSERT INTO tblc_clientes ';
		$strQuery.= '(id_tipo,id_usuario, nombre, apellido_p, apellido_m, rfc, correo, domicilio, telefono, celular, estado_civil, observaciones, fecha_registro,nss, curp, id_modalidad, modalidad_otro) ';
		$strQuery.= 'VALUES('.$idTipo.',' . $idUsuario . ', "'.$nombre.'", "'.$apellidoP.'", "'.$apellidoM.'", "'.$rfc.'", "'.$correo.'", NULLIF("'.$domicilio.'",""), NULLIF("'.$telefono.'",""), "'.$celular.'", "'.$estadoCivil.'", NULLIF("'.$observaciones.'",""), "'.$fecha.'","'.$nss.'","'.$curp.'",'.$modalidad.', NULLIF("'.$otros.'",""))';

		return $strQuery;
	}


	//QUERY PARA ACTUALIZAR UN REGISTRO DE LA TABLA DE CLINTES
	public function actualizaCliente($id, $idTipo, $nombre, $apellidoP, $apellidoM, $rfc, $correo, $domicilio, $telefono, $celular, $estadoCivil, $observaciones,$nss,$curp,$modalidad,$otros){
		$strQuery = 'UPDATE tblc_clientes ';
		$strQuery.= 'SET id_tipo = '.$idTipo.', nombre = "'.$nombre.'", apellido_p = "'.$apellidoP.'", apellido_m = "'.$apellidoM.'", rfc = "'.$rfc.'", correo = "'.$correo.'", domicilio = "'.$domicilio.'", telefono = "'.$telefono.'", celular = NULLIF("'.$celular.'",""), estado_civil = '.$estadoCivil.', observaciones = NULLIF("'.$observaciones.'",""),nss = "'.$nss .'",curp = "'.$curp.'",id_modalidad = '.$modalidad .',modalidad_otro = "' . $otros . '" ';
		$strQuery.= 'WHERE id_cliente = '.$id;

		return $strQuery;
	}

	//QUERY PARA MARCAR CÓMO ELIMINADO EL REGISTRO DE UN CLIENTE
	public function eliminaCliente($id, $fecha){
		$strQuery = 'UPDATE tblc_clientes ';
		$strQuery.= 'SET fecha_eliminado = "'.$fecha.'" ';
		$strQuery.= 'WHERE id_cliente = '.$id;

		return $strQuery;
	}


	//CLIENTES - ARCHIVOS
	//QUERY PARA OBTENER LOS ARCHIVOS DE LOS CLIENTES
	public function getArchivosClientesListado($idCliente, $idArchivo = ''){
		$cond = ($idArchivo != '')? ' AND id_archivo = '.$idArchivo.' ':' ';

		$strQuery = 'SELECT id_archivo, ruta_archivo, descripcion, fecha_registro ';
		$strQuery.= 'FROM tbl_archivos_clientes ';
		$strQuery.= 'WHERE fecha_eliminado IS NULL  AND id_cliente = '.$idCliente.$cond;
		$strQuery.= 'ORDER BY fecha_registro DESC, id_archivo DESC';

		return $strQuery;
	}

	//QUERY PARA AGREGAR UN REGISTRO A LA TABLA DE ARCHIVOS CLIENTE
	public function addArchivoCte($idCliente, $archivo, $descripcion, $fecha){
		$strQuery = 'INSERT INTO tbl_archivos_clientes ';
		$strQuery.= '(id_cliente, ruta_archivo, descripcion, fecha_registro) ';
		$strQuery.= 'VALUES('.$idCliente.', "'.$archivo.'", "'.$descripcion.'", "'.$fecha.'")';

		return $strQuery;
	}

	//QUERY PARA ACTUALIZAR EL REGISTRO DEL ARCHIVO PERSONAL DE UN CLIENTE
	public function actualizaArchivoCte($idCliente, $idArchivo, $archivo, $descripcion){
		$strQuery = 'UPDATE tbl_archivos_clientes ';
		$strQuery.= 'SET ruta_archivo = "'.$archivo.'", descripcion = "'.$descripcion.'" ';
		$strQuery.= 'WHERE id_archivo = '.$idArchivo.' AND id_cliente = '.$idCliente;

		return $strQuery;
	}

	//QUERY PARA MARCAR CÓMO ELIMINADO EL ARCHIVO PERSONAL DE UN CLIENTE
	public function eliminaArchivoCte($idArchivo, $fecha){
		$strQuery = 'UPDATE tbl_archivos_clientes ';
		$strQuery.= 'SET fecha_eliminado = "'.$fecha.'" ';
		$strQuery.= 'WHERE id_archivo = '.$idArchivo;

		return $strQuery;
	}


	//REFERENCIAS DEL CLIENTE
	//QUERY PARA OBTENER EL LISTADO/DATOS DE LAS REFERENCIAS DE UN CLIENTE
	public function getListadoReferenciasCte($idCliente, $idReferencia = ''){
		$cond = ($idReferencia != '')? ' AND id_referencia = '.$idReferencia.' ':' ';

		$strQuery = 'SELECT id_referencia, nombre, apellido_p, apellido_m, id_tipo, direccion, telefono, fecha_registro ';
		$strQuery.= 'FROM tblc_referencias_clientes ';
		$strQuery.= 'WHERE fecha_eliminado IS NULL AND id_cliente = '.$idCliente.$cond;
		$strQuery.= 'ORDER BY fecha_registro DESC, id_referencia DESC';

		return $strQuery;
	}

	//QUERY PARA AGREGAR UN REGISTRO A LA TABLA DE ARCHIVOS CLIENTE
	public function addRefenciaCte($idCliente, $idTipo, $nombre, $apellidoP, $apellidoM, $direccion, $telefono, $fecha_registro){
		$strQuery = 'INSERT INTO tblc_referencias_clientes ';
		$strQuery.= '(id_cliente, id_tipo, nombre, apellido_p, apellido_m, direccion, telefono, fecha_registro) ';
		$strQuery.= 'VALUES('.$idCliente.', '.$idTipo.', "'.$nombre.'", "'.$apellidoP.'", "'.$apellidoM.'", "'.$direccion.'", "'.$telefono.'", "'.$fecha_registro.'")';

		return $strQuery;
	}

	//QUERY PARA ACTUALIZAR LOS DATOS DE UN REGISTRO DE REFERENCIA DE UN CLIENTE
	public function actualizaReferenciaCte($idCliente, $idReferencia, $idTipo, $nombre, $apellidoP, $apellidoM, $direccion, $telefono){
		$strQuery = 'UPDATE tblc_referencias_clientes ';
		$strQuery.= 'SET id_tipo = '.$idTipo.', nombre = "'.$nombre.'", apellido_p = "'.$apellidoP.'", apellido_m = "'.$apellidoM.'", direccion = "'.$direccion.'", telefono = "'.$telefono.'" ';
		$strQuery.= 'WHERE id_cliente = '.$idCliente.' AND id_referencia = '.$idReferencia;

		return $strQuery;
	}

	//QUERY PARA MARCAR CÓMO ELIMINADO UN REGISTRO DE UNA REFERENCIA DE UN CLIENTE
	public function eliminaReferenciaCte($idReferencia, $fecha){
		$strQuery = 'UPDATE tblc_referencias_clientes ';
		$strQuery.= 'SET fecha_eliminado = "'.$fecha.'" ';
		$strQuery.= 'WHERE id_referencia = '.$idReferencia;

		return $strQuery;
	}

	//APARTADO DE PROPIEDADES DE INTENERES PARA EL CLIENTE
	//QUERY PARA CARGAR EL COMBO DE PROPIEDADES
	public function loadCboPropiedades($idDesarrollo, $numEdificio, $nivel){
		$strQuery = 'SELECT tp.id_propiedad, tp.numero_departamento, IF(tic.id_propiedad IS NULL, 0, 1) AS habilitado ';
		$strQuery.= 'FROM  tblc_propiedades AS tp ';
		$strQuery.= 'LEFT JOIN tbl_interes_cliente AS tic ';
		$strQuery.= 'ON tp.id_propiedad = tic.id_propiedad ';
		$strQuery.= 'WHERE tp.fecha_eliminado IS NULL AND tp.desarrollo = '.$idDesarrollo.' AND tp.numero_edificio = "'.$numEdificio.'" AND tp.numero_nivel = '.$nivel.' ';
		$strQuery.= 'ORDER BY tp.descripcion ASC';

		return $strQuery;
	}

	//QUERY PARA CARGAR EL COMBO DE NIVEL DEL FORMULARIO DE REGISTRO DE SEGUIMIENTO DE CLIENTES
	public function loadCboNivel($idDesarrollo, $numEdificio){
		$strQuery = 'SELECT nvl.id_nivel AS id, nvl.nombre AS valor ';
		$strQuery.= 'FROM tblc_propiedades AS tp ';
		$strQuery.= 'INNER JOIN tblc_nivel AS nvl ';
		$strQuery.= 'ON tp.numero_nivel = nvl.id_nivel ';
		$strQuery.= 'WHERE nvl.fecha_eliminacion IS NULL AND tp.desarrollo = '.$idDesarrollo.' AND tp.numero_edificio = "'.$numEdificio.'" ';
		$strQuery.= 'GROUP BY nvl.id_nivel ';
		$strQuery.= 'ORDER BY valor ASC';

		return $strQuery;
	}

	//QUERY PARA CARGAR EL COMBO DE PROPIEDADES
	public function loadCboeEstatusInteres($idArea){
		$strQuery = 'CALL sp_EstatusPropiedades('.$idArea.')';

		return $strQuery;
	}

	//QUERY PARA OBTENER EL LISTADO/INFORMACIÓN DE LOS INTENRES DEL CLIENTE
	public function getInteresListadoCte($idCliente, $idInteres = ''){
		$cond = ($idInteres != '')? ' AND id_interes = '.$idInteres.' ':' ';

		$strQuery = 'SELECT tic.id_interes, prop.desarrollo, td.nombre AS nombreDesarrollo, prop.numero_edificio, prop.numero_nivel, nvl.nombre AS nivel, prop.numero_departamento, tic.id_propiedad, prop.Descripcion, tic.monto, tic.agente, tic.estatus, tep.nombre AS txtestatus, tep.activar_firma, tep.activar_entrega , tic.fecha_firma, tic.fecha_entrega, tic.fecha_registro ';
		$strQuery.= 'FROM tbl_interes_cliente AS tic ';
		$strQuery.= 'INNER JOIN tblc_propiedades AS prop ';
		$strQuery.= 'ON tic.id_propiedad = prop.id_propiedad ';
		$strQuery.= 'INNER JOIN tblc_estatus_propiedades AS tep ';
		$strQuery.= 'ON tic.estatus = tep.id_estatus ';
		$strQuery.= 'INNER JOIN tblc_desarrollo AS td ';
		$strQuery.= 'ON prop.desarrollo = td.id_desarrollo ';
		$strQuery.= 'INNER JOIN tblc_nivel AS nvl ';
		$strQuery.= 'ON prop.numero_nivel = nvl.id_nivel ';
		$strQuery.= 'WHERE tic.fecha_eliminado IS NULL AND tic.id_cliente = '.$idCliente.$cond;
		$strQuery.= 'ORDER BY tic.fecha_registro DESC, tic.id_interes DESC';

		return $strQuery;
	}

	//QUERY PARA CARGAR EL COMBO DE DESARROLLO
	public function loadCboDesarrollo(){
		$strQuery = 'SELECT id_desarrollo AS id, nombre AS valor  ';
		$strQuery.= 'FROM tblc_desarrollo ';
		$strQuery.= 'WHERE fecha_eliminacion IS NULL ';
		$strQuery.= 'ORDER BY nombre ASC';

		return $strQuery;
	}

	//QUERY PARA CARGAR EL COMBO DE NÚMERO DE EDIFICIO
	public function loadCboNumEdificio($idDesarrollo){
		$strQuery = 'SELECT numero_edificio AS id, CONCAT("Edificio número"," ", numero_edificio) AS valor ';
		$strQuery.= 'FROM tblc_propiedades ';
		$strQuery.= 'WHERE desarrollo = '.$idDesarrollo.' ';
		$strQuery.= 'GROUP BY numero_edificio ';
		$strQuery.= 'ORDER BY valor ASC, CAST(numero_edificio AS UNSIGNED) ASC';

		return $strQuery;
	}


	//QUERY PARA VERIFICAR SI UNA PROPIEDAD HA SIDO ASIGNADA A UN CLIENTE
	public function validaProdAsigCte($idProp){
		$strQuery = 'SELECT COUNT(tic.id_interes) AS exist, CONCAT(cte.nombre," ",cte.apellido_p," ",cte.apellido_m) AS cliente ';
		$strQuery.= 'FROM tbl_interes_cliente AS tic ';
		$strQuery.= 'INNER JOIN tblc_clientes AS cte ';
		$strQuery.= 'ON tic.id_cliente = cte.id_cliente ';
		$strQuery.= 'WHERE tic.id_propiedad = '.$idProp;

		return $strQuery;
	}


	//QUERY PARA AGREGAR UNA PROPIEDAD AL INTERES DE UN CLIENTE
	public function addInteresPropiedad($idCliente, $idPropiedad, $idUsuario, $agente, $monto, $estatus, $fecha){
		$strQuery = 'INSERT INTO tbl_interes_cliente ';
		$strQuery.= '(id_cliente, id_propiedad, id_usuario, agente, monto, estatus , fecha_registro) ';
		$strQuery.= 'VALUES('.$idCliente.', '.$idPropiedad.', '.$idUsuario.', "'.$agente.'", '.$monto.', '.$estatus.', "'.$fecha.'")';

		return $strQuery;
	}

	//QUERY PARA ACTUALIZAR UN REGISRO DE INTERES DE UN CLIENTE EN UN PROPIEDAD
	public function actualizaInteres($idCliente, $idInteres, $idPropiedad, $idUsuario, $agente, $fechaFirma, $fechaEntrega, $monto, $estatus){
		$strQuery = 'UPDATE tbl_interes_cliente ';
		$strQuery.= 'SET id_propiedad = '.$idPropiedad.', estatus = '.$estatus.', id_usuario = '.$idUsuario.', agente = "'.$agente.'", fecha_firma = NULLIF("'.$fechaFirma.'",""), fecha_entrega = NULLIF("'.$fechaEntrega.'",""), monto = '.$monto.' ';
		$strQuery.= 'WHERE id_cliente = '.$idCliente.' AND id_interes = '.$idInteres;

		return $strQuery;
	}

	//QUERY PARA MARCAR CÓMO ELIMINADO UN REGISTRO DE INTERES POR UNA PROPIEDAD DE UN CLIENTE
	public function eliminaInteresCte($idInteres, $fecha){
		$strQuery = 'UPDATE tbl_interes_cliente ';
		$strQuery.= 'SET fecha_eliminado = "'.$fecha.'" ';
		$strQuery.= 'WHERE id_interes = '.$idInteres;

		return $strQuery;
	}




	//MÓDULO DE ORDEN DE COMPRAS
	//CATÁLOGO DE PROVEEDORES

	//QUERY PARA CARGAR EL COMBO DE PROVEEDORES PARA EL FORMULARIO DE REGISTRO DE COTIZACIONES EN LAS ORDENES DE COMPRA
	public function loadCboProvedor(){
		$strQuery = 'SELECT id_proveedor AS id, nombre AS valor ';
		$strQuery.= 'FROM tblc_proveedor ';
		$strQuery.= 'WHERE fecha_eliminado IS NULL ';
		$strQuery.= 'ORDER BY nombre ASC';

		return $strQuery;
	}

	public function getProveedoresData($idProveedor = '', $opt, $busqueda){
		$cond = '';
		$cond = ($idProveedor != '')? ' AND id_proveedor = '.$idProveedor.' ':' ';
		switch ($opt) {
			case 1:				
				$cond.= ($busqueda != '')? ' AND nombre LIKE "%'.$busqueda.'%" ':' ';
			break;
			
			case 2:				
				$cond.= ($busqueda != '')? ' AND rfc LIKE "%'.$busqueda.'%" ':' ';
			break;

			case 3:				
				$cond.= ($busqueda != '')? ' AND nombre_agente LIKE "%'.$busqueda.'%" ':' ';
			break;
		}

		$strQuery = 'SELECT id_proveedor, nombre, razon_social, rfc, telefono, direccion, estatus, observaciones, nombre_agente, telefono_agente, correo_agente, fecha_registro ';
		$strQuery.= 'FROM tblc_proveedor ';
		$strQuery.= 'WHERE fecha_eliminado IS NULL AND estatus = 1'.$cond;
		$strQuery.= 'ORDER BY fecha_registro DESC, id_proveedor DESC';

		return $strQuery;
	}

	//QUERY PARA AGREGAR UN NUEVO PROVEEDOR
	public function addProveedor($nombre, $razonSocial, $rfc, $telefono, $direccion, $estatus, $observaciones, $nombreAgente, $telefonoAgente, $correoAgente, $fechaRegistro){
		$strQuery = 'INSERT INTO tblc_proveedor ';
		$strQuery.= '(nombre, razon_social, rfc, telefono, direccion, estatus, observaciones, nombre_agente, telefono_agente, correo_agente, fecha_registro) ';
		$strQuery.= 'VALUES("'.$nombre.'", "'.$razonSocial.'", "'.$rfc.'", "'.$telefono.'", "'.$direccion.'", '.$estatus.', NULLIF("'.$observaciones.'",""), "'.$nombreAgente.'", "'.$telefonoAgente.'", "'.$correoAgente.'", "'.$fechaRegistro.'")';

		return $strQuery;
	}

	//QUERY PARA ACTUALIZAR LOS DATOS DE UN PROVEEDOR
	public function actualizaProveedor($idProveedor, $nombre, $razonSocial, $rfc, $telefono, $direccion, $observaciones, $nombreAgente, $telefonoAgente, $correoAgente){
		$strQuery = 'UPDATE tblc_proveedor ';
		$strQuery.= 'SET nombre = "'.$nombre.'", razon_social = "'.$razonSocial.'", rfc = "'.$rfc.'", telefono = "'.$telefono.'", direccion = "'.$direccion.'", observaciones = NULLIF("'.$observaciones.'",""), nombre_agente = "'.$nombreAgente.'", telefono_agente = "'.$telefonoAgente.'", correo_agente = "'.$correoAgente.'" ';
		$strQuery.= 'WHERE id_proveedor = '.$idProveedor;

		return $strQuery;
	}

	//QUERY PARA MARCAR CÓMO ELIMINADO A UN PROVEEDOR
	public function eliminaProveedor($id, $fecha){
		$strQuery = 'UPDATE tblc_proveedor ';
		$strQuery.= 'SET fecha_eliminado = "'.$fecha.'" ';
		$strQuery.= 'WHERE id_proveedor = '.$id;

		return $strQuery;
	}

	//CUENTAS BANCARIAS DEL PROVEEDOR
	//QUERY PARA CARGAR EL COMBO DE BANCOS PARA EL REGISTRO DE UNA CUENTA BANCARIA DE UN PROVEEDOR
	public function loadCboBanco(){
		$strQuery = 'SELECT id_banco AS id, nombre AS valor ';
		$strQuery.= 'FROM tblc_banco ';
		$strQuery.= 'WHERE estatus = 1 AND fecha_eliminado IS NULL ';
		$strQuery.= 'ORDER BY nombre ASC';

		return $strQuery;
	}

	//QUERY PARA OBTENER LOS DATOS DE LAS CUENTAS BANCARIAS DE LOS PROVEEDORES
	public function getDataProveedorCta($idProveedor, $idProvCta = ''){
		$cond = ($idProvCta != '')? ' AND tcp.id_cuenta_proveedor = '.$idProvCta.' ':' ';

		$strQuery = 'SELECT tcp.id_cuenta_proveedor, tcp.id_banco, bco.nombre AS banco, tcp.cuenta, tcp.clabe_interbancaria, tcp.fecha_registro ';
		$strQuery.= 'FROM tblc_cuenta_proveedor AS tcp ';
		$strQuery.= 'INNER JOIN tblc_banco AS bco ';
		$strQuery.= 'ON tcp.id_banco = bco.id_banco ';
		$strQuery.= 'WHERE tcp.fecha_eliminado IS NULL AND tcp.id_proveedor = '.$idProveedor.$cond;
		$strQuery.= 'ORDER BY tcp.fecha_registro DESC, tcp.id_cuenta_proveedor DESC';

		return $strQuery;
	}

	//QUERY PARA GUARDAR UNA CUENTA BANCARIA DE UN PROVEEDOR
	public function addProvCtaBanc($idProveedor, $idBanco, $cuenta, $cbeInterbanc, $fecha){
		$strQuery = 'INSERT INTO tblc_cuenta_proveedor ';
		$strQuery.= '(id_proveedor, id_banco, cuenta, clabe_interbancaria, fecha_registro) ';
		$strQuery.= 'VALUES('.$idProveedor.', '.$idBanco.', "'.$cuenta.'", "'.$cbeInterbanc.'", "'.$fecha.'")';

		return $strQuery;
	}

	//QUERY PARA ACTUALIZAR LOS DATOS DE UNA CUENTA BANCARIA DE UN PROVEEDOR
	public function actualizaProvCtaBanc($idProveedor, $idProvCta, $idBanco, $cuenta, $cbeInterbanc){
		$strQuery = 'UPDATE tblc_cuenta_proveedor ';
		$strQuery.= 'SET id_banco = '.$idBanco.', cuenta = "'.$cuenta.'", clabe_interbancaria = "'.$cbeInterbanc.'" ';
		$strQuery.= 'WHERE id_proveedor = '.$idProveedor.' AND id_cuenta_proveedor = '.$idProvCta;

		return $strQuery;
	}

	//QUERY PARA MARCAR CÓMO ELIMINADA UNA CUENTA BANCARIA DE UN PROVEEDOR
	public function eliminaProvCtaBanc($idProvCta, $fecha){
		$strQuery = 'UPDATE tblc_cuenta_proveedor ';
		$strQuery.= 'SET fecha_eliminado = "'.$fecha.'" ';
		$strQuery.= 'WHERE id_cuenta_proveedor = '.$idProvCta;

		return $strQuery;
	}


	//QUERY PARA CARGAR EL COMBO DE OBRA
	public function loadCboObras(){
		$strQuery = 'SELECT id_obras as id, nombre AS valor ';
		$strQuery.= 'FROM tbl_obras ';
		$strQuery.= 'ORDER BY nombre ASC';

		return $strQuery;
	}

	//QUERY PARA OBTENER LOS DATOS NECESARIOS DEL ÁREA DEL USUARIO Y VERIFICAR SI ES JEFE DE DEPTO O NO.
	public function getDataAreaUsr($idArea){
		$strQuery = 'SELECT id_permiso, id_departamento ';
		$strQuery.= 'FROM tblc_areas ';
		$strQuery.= 'WHERE id_area = '.$idArea;

		return $strQuery;
	}

	//QUERY PARA OBTENER LAS ÁREAS DEPENDIENTES DE UN JEFE DE DEPARTAMENTO
	public function getIdsAreasDep($idDepto, $idAreaP){
		$strQuery = 'SELECT id_area ';
		$strQuery.= 'FROM tblc_areas ';
		$strQuery.= 'WHERE id_departamento = '.$idDepto.' AND id_area != '.$idAreaP.' ';
		$strQuery.= 'ORDER BY id_area ASC';

		return $strQuery;
	}

	//QUERY PARA OBTENER EL LISTADO/DATOS DE ORDENES DE COMPRA
	public function ordenes_compra_listado($idsArea, $folio, $obra, $empresa, $estatus, $tipoComp, $fechaDesde, $fechaHasta, $id = ''){
		$cond ='';
		$cond.= ($idsArea != '')? ' AND toc.id_Area IN('.$idsArea.') ':' ';
		$cond.= ($folio != '')? ' AND folio = "'.$folio.'" ':' ';
		$cond.= ($obra != 0)? ' AND id_obra = "'.$obra.'" ':' ';
		$cond.= ($empresa != 0)? ' AND id_empresa = "'.$empresa.'" ':' ';
		$cond.= ($estatus != -1)? ' AND estatus = "'.$estatus.'" ':' ';
		$cond.= ($tipoComp != 0)? ' AND id_tipo_compra = "'.$tipoComp.'" ':' ';
		$cond.= ($fechaDesde != '' && $fechaHasta != '')? ' AND fecha_captura BETWEEN "'.$fechaDesde.'" AND "'.$fechaHasta.'" ':' ';
		$cond.= ($id != '')? ' AND id_orden_compra = '.$id.' ':' ';

		$strQuery = 'SELECT id_orden_compra, folio, id_obra, tob.nombre AS obra, toc.id_empresa, emp.nombre AS empresa, toc.fecha_captura, toc.id_tipo_compra, toc.id_proveedor, prov.nombre AS proveedor, toc.residente, toc.archivo_transferencia, toc.archivo_factura, toc.fecha_archivo_transferencia, toc.direccion_obra, toc.estatus, toc.enviar_a ';
		$strQuery.= 'FROM tbl_orden_compra AS toc ';
		$strQuery.= 'INNER JOIN tbl_obras AS tob ';
		$strQuery.= 'ON toc.id_obra = tob.id_obras ';
		$strQuery.= 'LEFT JOIN tblc_proveedor AS prov ';
		$strQuery.= 'ON toc.id_proveedor = prov.id_proveedor ';
		$strQuery.= 'INNER JOIN tblc_empresas AS emp ';
		$strQuery.= 'ON toc.id_empresa = emp.id_empresa ';
		$strQuery.= 'WHERE toc.fecha_eliminado IS NULL'.$cond;
		$strQuery.= 'ORDER BY toc.fecha_registro DESC, toc.id_orden_compra DESC';

		return $strQuery;
	}

	//QUERY PARA AGREGAR UN NUEVO REGISTRO DE ORDEN DE COMPRA
	public function addOrdenCompra($idObra, $idArea, $idEmpresa, $direccionObra, $fechaCaptura, $fechaRegistro, $residente, $idTipoCompra, $estatus, $enviarA){
		$strQuery = 'INSERT INTO tbl_orden_compra ';
		$strQuery.= '(id_obra, id_area, id_empresa, id_tipo_compra, direccion_obra, fecha_captura, residente, fecha_registro, estatus, enviar_a) ';
		$strQuery.= 'VALUES('.$idObra.', '.$idArea.', '.$idEmpresa.', '.$idTipoCompra.', "'.$direccionObra.'", "'.$fechaCaptura.'", "'.$residente.'", "'.$fechaRegistro.'", '.$estatus.', '.$enviarA.')';

		return $strQuery;
	}

	//QUERY PARA AGREGAR EL FOLIO A UNA NUEVA ORDEN DE COMPRA
	public function addFolioOrdenCompra($idOrdenComp, $folio){
		$strQuery = 'UPDATE tbl_orden_compra ';
		$strQuery.= 'SET folio = "'.$folio.'" ';
		$strQuery.= 'WHERE id_orden_compra = '.$idOrdenComp;

		return $strQuery;
	}

	//QUERY PARA ACTUALIZAR EL REGISTRO DE UNA ORDEN DE PAGO
	public function actualizarOrdenComp($idOrdenComp, $idObra, $idEmpresa, $direccionObra, $fechaCaptura, $residente, $idTipoCompra, $enviarA){
		$strQuery = 'UPDATE tbl_orden_compra ';
		$strQuery.= 'SET id_obra = "'.$idObra.'", id_empresa = "'.$idEmpresa.'", id_tipo_compra = "'.$idTipoCompra.'", direccion_obra = "'.$direccionObra.'", fecha_captura = "'.$fechaCaptura.'", residente = "'.$residente.'", enviar_a = '.$enviarA.' ';
		$strQuery.= 'WHERE id_orden_compra = '.$idOrdenComp;

		return $strQuery;
	}

	//QUERY PARA AGREGAR EL ARCHIVO DE TRANSFERENCIA/FACTURA
	public function addFileTransFactOrdComp($idOrdenComp, $field, $file, $fecha){
		$strQuery = 'UPDATE tbl_orden_compra ';
		$strQuery.= 'SET '.$field.' = "'.$file.'", fecha_archivo_transferencia = "'.$fecha.'" ';
		$strQuery.= 'WHERE id_orden_compra = '.$idOrdenComp;

		return $strQuery;
	}

	//QUERY PARA MARCAR CÓMO ELIMINADO UN REGISTRO DE ORDEN DE COMPRA
	public function eliminaOrdenCompra($id, $fecha){
		$strQuery = 'UPDATE tbl_orden_compra ';
		$strQuery.= 'SET fecha_eliminado = "'.$fecha.'" ';
		$strQuery.= 'WHERE id_orden_compra = '.$id;

		return $strQuery;
	}

	//QUERY PARA OBTENER LOS CONCEPTOS DE UNA OBRA PARA LA ORDEN DE COMPRA
	public function getObraConceptos($idObra){
		$strQuery = 'SELECT tei.id_exposion_insumos AS id, tei.concepto AS valor, IF(alm.id_explosion_insumo IS NULL, 0, 1) AS exist ';
		$strQuery.= 'FROM tbl_explosion_insumos AS tei ';
		$strQuery.= 'LEFT JOIN tbl_almacen AS alm ';
		$strQuery.= 'ON tei.id_exposion_insumos = alm.id_explosion_insumo ';		
		$strQuery.= 'WHERE tei.id_obra = '.$idObra.' ';
		$strQuery.= 'ORDER BY tei.concepto ASC';

		return $strQuery;
	}

	//QUERY PARA CARGAR EL COMBO DE CONCEPTOS DEL INVENTARIO INTERNO
	public function loadCboInvInterno(){
		$strQuery = 'SELECT 0 AS id, " Seleccionar.." AS valor, -1 AS existInv ';
		$strQuery.= 'UNION ALL ';
		$strQuery.= 'SELECT tii.id_inventario_interno, tii.concepto, IF(alm.id_inventario_interno IS NULL, 0, 1) ';
		$strQuery.= 'FROM tblc_inventario_interno AS tii ';
		$strQuery.= 'LEFT JOIN tbl_almacen AS alm ';
		$strQuery.= 'ON tii.id_inventario_interno = alm.id_inventario_interno ';
		$strQuery.= 'WHERE tii.fecha_eliminado IS NULL ';
		$strQuery.= 'ORDER BY valor ASC, id ASC';

		return $strQuery;
	}

	//QUERY PARA AGREGAR UN NUEVO REGISTRO AL CATÁLOGO DE INVENTARIO INTERNO - ORDEN DE COMPRA
	public function addInvIntOrdComp($codigo, $concepto, $unidad, $cantidad, $precioUnitario, $importe, $fecha){
		$strQuery = 'INSERT INTO tblc_inventario_interno ';
		$strQuery.= '(codigo, concepto, unidad, cantidad, precio_unitario, importe, fecha_registro) ';
		$strQuery.= 'VALUES(NULLIF("'.$codigo.'",""), "'.$concepto.'", "'.$unidad.'", '.$cantidad.', '.$precioUnitario.', '.$importe.', "'.$fecha.'")';

		return $strQuery;
	}

	//QUERY PARA OBTENER EL DETALLE DE UN COCEPTO PARA REGISTRAR UNA ORDEN DE COMPRA
	public function getDataCpto($id, $invInt){
		$table = ''; $idTableCpto = '';
		switch ($invInt) {
			case 0:
				$table       = 'tbl_explosion_insumos';
				$idTableCpto = 'id_exposion_insumos';
			break;
			
			case 1:
				$table       = 'tblc_inventario_interno';
				$idTableCpto = 'id_inventario_interno';	
			break;
		}

		$strQuery = 'SELECT '.$idTableCpto.', unidad, cantidad, precio_unitario, importe ';
		$strQuery.= 'FROM '.$table.' ';
		$strQuery.= 'WHERE '.$idTableCpto.' = '.$id;

		return $strQuery;
	}

	//QUERY PARA OBTENER EL TOTAL ACUMULADO DE UN CONCEPTO PARA UNA ORDEN DE COMPRA
	public function getTotAcumCptoOrdComp($idOrdComp, $idExpInsumos){
		$strQuery = 'SELECT SUM(tac.cantidad) AS totCantAcumulado, tei.cantidad-SUM(tac.cantidad) AS cantDisponible ';
		$strQuery.= 'FROM tbl_artculo_compra AS tac ';
		$strQuery.= 'RIGHT JOIN tbl_explosion_insumos AS tei ';
		$strQuery.= 'ON tac.id_explosion_insumos = tei.id_exposion_insumos ';
		$strQuery.= 'WHERE tac.id_orden_compra = '.$idOrdComp.' AND tac.id_explosion_insumos = '.$idExpInsumos;

		return $strQuery;
	}

	//QUERY PARA OBTENER EL TOTAL ACUMULADO DE UN CONCEPTO PARA UNA ORDEN DE COMPRA
	public function getTotAcumCptoInvIntOrdComp($idOrdComp, $idInvInt){
		$strQuery = 'SELECT SUM(tac.cantidad) AS totCantAcumulado, tii.cantidad-SUM(tac.cantidad) AS cantDisponible ';
		$strQuery.= 'FROM tbl_artculo_compra AS tac ';
		$strQuery.= 'RIGHT JOIN tblc_inventario_interno AS tii ';
		$strQuery.= 'ON tac.id_inventario_interno = tii.id_inventario_interno ';
		$strQuery.= 'WHERE tac.id_orden_compra = '.$idOrdComp.' AND tac.id_inventario_interno = '.$idInvInt;

		return $strQuery;
	}


	//QUERY PARA OBTENER EL TOTAL DE IMPORTE Y CANTIDAD DE UN CONCEPTO
	public function getCptoCantImp($idExpInsumos){
		$strQuery = 'SELECT importe, cantidad ';
		$strQuery.= 'FROM tbl_explosion_insumos ';
		$strQuery.= 'WHERE id_exposion_insumos = '.$idExpInsumos;

		return $strQuery;
	}

	//QUERY PARA OBTENER LA INFO/LISTADO DE LOS ARTÍCULOS DE UNA ORDEN DE COMPRA
	public function articulosListado($idOrdenComp, $idArticulo = ''){
		$cond = ($idArticulo != '')? ' AND id_articulo_compra = '.$idArticulo.' ':' ';

		$strQuery = 'SELECT tac.id_articulo_compra, tac.id_explosion_insumos, tac.id_inventario_interno, tei.concepto, tac.cantidad, tac.monto, tac.unidad, tii.concepto AS cptoInt ';
		$strQuery.= 'FROM tbl_artculo_compra AS tac ';
		$strQuery.= 'LEFT JOIN tbl_explosion_insumos AS tei ';
		$strQuery.= 'ON tac.id_explosion_insumos = tei.id_exposion_insumos ';
		$strQuery.= 'LEFT JOIN tblc_inventario_interno AS tii ';
		$strQuery.= 'ON tac.id_inventario_interno = tii.id_inventario_interno ';
		$strQuery.= 'WHERE tac.fecha_eliminado IS NULL AND tac.id_orden_compra = '.$idOrdenComp.$cond;
		$strQuery.= 'ORDER BY tac.id_articulo_compra DESC';

		return $strQuery;
	}

	//QUERY PARA AGREGAR ARTÍCULOS A LA ORDEN DE COMPRA
	public function addArticuloOrdComp($idOrdenComp, $dataInv, $idAticulo, $unidad, $cantidad, $costo, $fecha){
		$idInvt = ($dataInv == 0)? 'id_explosion_insumos':'id_inventario_interno';

		$strQuery = 'INSERT INTO tbl_artculo_compra ';
		$strQuery.= '(id_orden_compra, '.$idInvt.', unidad, cantidad, monto, fecha_registro) ';
		$strQuery.= 'VALUES('.$idOrdenComp.', '.$idAticulo.', "'.$unidad.'", '.$cantidad.', '.$costo.', "'.$fecha.'")';

		return $strQuery;
	}

	//QUERY PARA ACTUALIZAR LOS DATOS DE UN ARTÍCULO DE UNA ORDEN DE COMPRA
	public function actualizaArtOrdComp($idArticulo, $articulo, $unidad, $cantidad, $costo){
		$strQuery = 'UPDATE tbl_artculo_compra ';
		$strQuery.= 'SET articulo = "'.$articulo.'", unidad = "'.$unidad.'", cantidad = '.$cantidad.', monto = '.$costo.' ';
		$strQuery.= 'WHERE id_articulo_compra = '.$idArticulo;

		return $strQuery;
	}

	//QUERY PARA SUMAR EL TOTAL DE LOS ARTÍCULOS AGREGADOS A LA ORDEN DE COMPRA
	public function getSumMontoArtOrdComp($idOrdenComp){
		$strQuery = 'SELECT SUM(monto*cantidad) AS total ';
		$strQuery.= 'FROM tbl_artculo_compra ';
		$strQuery.= 'WHERE id_orden_compra = '.$idOrdenComp.' AND fecha_eliminado IS NULL';		

		return $strQuery;
	}

	//QUERY PARA MARCAR CÓMO ELIMINADO UN ARTÍCULO DE UNA ORDEN DE COMPRA
	public function eliminaArticuloOrdComp($id, $fecha){
		$strQuery = 'UPDATE tbl_artculo_compra ';
		$strQuery.= 'SET fecha_eliminado = "'.$fecha.'" ';
		$strQuery.= 'WHERE id_articulo_compra = '.$id;

		return $strQuery;
	}

	//COTIZACIONES

	//QUERY PARA DETERMINAR SI UNA COTIZACIÓN DE UNA ORDEN DE ENTREGA HA SIDO AUTORIZADA
	public function validaAutorizacionCotiz($idOrdenComp){
		$strQuery = 'SELECT COUNT(id_cotizacion) AS totAut FROM tbl_cotizacion ';
		$strQuery.= 'WHERE id_orden_compra = '.$idOrdenComp.' AND autorizado = 1';

		return $strQuery;
	}

	//QUERY PARA OBTENER LA INFORMACIÓN DE LAS COTIZACIONES: LISTADO-EDICIÓN
	public function getCotizaciones($idOrdenComp, $idCotizacion = ''){
		$cond = ($idCotizacion != '')? ' AND cot.id_cotizacion = '.$idCotizacion.' ':' ';

		$strQuery = 'SELECT cot.id_cotizacion, cot.id_proveedor, prov.nombre AS proveedor, cot.num_cuenta, cot.monto, cot.archivo, cot.observaciones, cot.autorizado, cot.fecha_registro  ';
		$strQuery.= 'FROM tbl_cotizacion AS cot ';
		$strQuery.= 'INNER JOIN tblc_proveedor AS prov ';
		$strQuery.= 'ON cot.id_proveedor = prov.id_proveedor ';
		$strQuery.= 'WHERE cot.fecha_eliminado IS NULL AND cot.id_orden_compra = '.$idOrdenComp.$cond;
		$strQuery.= 'ORDER BY cot.fecha_registro DESC, cot.id_cotizacion DESC';

		return $strQuery;
	}

	//QUERY PARA AGREGAR UNA COTIZACIÓN A UNA ORDEN DE COMPRA
	public function addCotizacion($idOrdenComp, $idProveedor, $numCuenta, $monto, $archivo, $observaciones, $fecha){
		$strQuery = 'INSERT INTO tbl_cotizacion ';
		$strQuery.= '(id_orden_compra, id_proveedor, num_cuenta, monto, archivo, observaciones, fecha_registro) ';
		$strQuery.= 'VALUES('.$idOrdenComp.', '.$idProveedor.', '.$numCuenta.', '.$monto.', "'.$archivo.'", NULLIF("'.$observaciones.'",""), "'.$fecha.'")';

		return $strQuery;
	}

	//QUERY PARA ACTUALIZAR LOS DATOS DE UNA COTIZACIÓN
	public function actualizaCotizacion($idOrdenComp, $idCotizacion, $idProveedor, $numCuenta, $monto, $archivo, $observaciones){
		$strQuery = 'UPDATE tbl_cotizacion ';
		$strQuery.= 'SET id_proveedor = '.$idProveedor.', num_cuenta = "'.$numCuenta.'", monto = '.$monto.', archivo = "'.$archivo.'", observaciones = "'.$observaciones.'" ';
		$strQuery.= 'WHERE id_orden_compra = '.$idOrdenComp.' AND id_cotizacion = '.$idCotizacion;

		return $strQuery;
	}

	//QUERY PARA CAMBIAR EL ESTATUS DE UNA COTIZACIÓN A AUTORIZADA
	public function autorizaCotizacion($idCotizacion){
		$strQuery = 'UPDATE tbl_cotizacion ';
		$strQuery.= 'SET autorizado = 1 ';
		$strQuery.= 'WHERE id_cotizacion = '.$idCotizacion;

		return $strQuery;
	}

	//QUERY PARA CONTABILIZAR EL NÚMERO DE COTIZACIONES HECHAS PARA UNA ORDEN DE COMPRA
	public function countCotizacionesOrdComp($idOrdenComp){
		$strQuery = 'SELECT COUNT(id_cotizacion) AS total ';
		$strQuery.= 'FROM tbl_cotizacion ';
		$strQuery.= 'WHERE id_orden_compra = '.$idOrdenComp;

		return $strQuery;
	}

	//QUERY PARA OBTENER EL ID DEL PROVEEDOR AUTORIZADO PARA LA COMPRA
	public function getIdProovAut($idOrdComp){
		$strQuery = 'SELECT id_proveedor ';
		$strQuery.= 'FROM tbl_cotizacion ';
		$strQuery.= 'WHERE id_orden_compra = '.$idOrdComp.' AND autorizado = 1';

		return $strQuery;
	}

	//QUERY PARA ACTUALIZAR EL ESTATUS DE UNA ORDEN DE COMPRA
	public function actualizaEstatusOrdComp($idOrdenComp, $idProveedor, $estatus){
		$strQuery = 'UPDATE tbl_orden_compra ';
		$strQuery.= 'SET id_proveedor = '.$idProveedor.', estatus = '.$estatus.' ';
		$strQuery.= 'WHERE id_orden_compra = '.$idOrdenComp;

		return $strQuery;
	}

	//QUERY PARA ELIMINAR UNA COTIZACIÓN DE UNA ORDEN DE COMPRA
	public function eliminaCotizacion($id, $fecha){
		$strQuery = 'UPDATE tbl_cotizacion ';
		$strQuery.= 'SET fecha_eliminado = "'.$fecha.'" ';
		$strQuery.= 'WHERE id_cotizacion = '.$id;

		return $strQuery;
	}


	//SERVICIO POSVENTA
	//QUERY PARA OBTENER LOS REGISTROS DE LOS SERVICIOS POSVENTA DE UN CLIENTE
	public function getDataServPVCte($idInteres, $idServPV = ''){
		$cond = ($idServPV != '')? ' AND id_servicio_posventa = '.$idServPV.' ':' ';

		$strQuery = 'SELECT id_servicio_posventa, folio, motivo, descripcion, estatus, fecha_captura, fecha_termino ';
		$strQuery.= 'FROM tbl_servicio_posventa ';
		$strQuery.= 'WHERE fecha_eliminado IS NULL AND id_interes = '.$idInteres.$cond;
		$strQuery.= 'ORDER BY fecha_registro DESC';

		return $strQuery;
	}

	//QUERY PARA AGREGAR UN NUEVO SERVICIO POSVENTA
	public function addServPV($idInteres, $folio, $motivo, $descripcion, $estatus, $fechaCaptura, $fechaRegistro){
		$strQuery = 'INSERT INTO tbl_servicio_posventa ';
		$strQuery.= '(id_interes, folio, motivo, descripcion, estatus, fecha_captura, fecha_registro) ';
		$strQuery.= 'VALUES('.$idInteres.', "'.$folio.'", '.$motivo.', NULLIF("'.$descripcion.'",""), '.$estatus.', "'.$fechaCaptura.'", "'.$fechaRegistro.'")';

		return $strQuery;
	}

	//QUERY PARA ACTUALIZAR LOS DATOS DE UN SERVICIO POSVENTA
	public function actualizaServPV($idInteres, $idServPV, $folio, $motivo, $descripcion, $estatus, $fechaCaptura, $fechaTermino){
		$strQuery = 'UPDATE tbl_servicio_posventa ';
		$strQuery.= 'SET folio = "'.$folio.'", motivo = '.$motivo.', descripcion = "'.$descripcion.'", estatus = '.$estatus.', fecha_captura = "'.$fechaCaptura.'", fecha_termino = NULLIF("'.$fechaTermino.'","") ';
		$strQuery.= 'WHERE id_interes = '.$idInteres.' AND id_servicio_posventa = '.$idServPV;

		return $strQuery;
	}

	//QUERY PARA MARCAR CÓMO ELIMINADO UN REGISTRO DE UN SERVICIO POSVENTA
	public function eliminaServPV($idServPV, $fecha){
		$strQuery = 'UPDATE tbl_servicio_posventa ';
		$strQuery.= 'SET fecha_eliminado = "'.$fecha.'" ';
		$strQuery.= 'WHERE id_servicio_posventa = '.$idServPV;

		return $strQuery;
	}

	//MÓDULO DE MAQUINARIA Y EQUIPO --------------------------------------------------------
	//QUERY PARA CARGAR EL COMBO DE TIPO DE MAQUINARIA
	public function loadCboTipoMaquinaria(){
		$strQuery = 'SELECT id_tipo_maquinaria AS id, nombre AS valor ';
		$strQuery.= 'FROM tblc_tipo_maquinaria ';
		$strQuery.= 'WHERE fecha_eliminado IS NULL ';
		$strQuery.= 'ORDER BY nombre ASC';

		return $strQuery;
	}

	//QUERY PARA OBTENER EL LISTADO DE MAQUINARIA Y VEHÍCULOS
	public function listadoCatMaqVehic($id = '', $optSelected = 0, $busqueda = '', $tipoMaquinaria = 0, $idCateg = 0){
		$fieldFilter = '';
		switch ($optSelected) {
			case 1:
				$fieldFilter = 'marca';
			break;

			case 2:
				$fieldFilter = 'numero_economico';
			break;

			case 3:
				$fieldFilter = 'numero_serie';
			break;

			case 4:
				$fieldFilter = 'placas';
			break;
		}
		$cond = ($id != '')? ' AND tmv.id_maquinaria_vehiculo = '.$id.' ':' ';
		$cond.= ($busqueda != '')? ' AND tmv.'.$fieldFilter.' LIKE "%'.$busqueda.'%" ':' ';
		$cond.= ($idCateg != 0)? ' AND tmv.id_categoria = '.$idCateg.' ':' ';
		$cond.= ($tipoMaquinaria != 0)? ' AND tmv.id_tipo_maquinaria = '.$tipoMaquinaria.' ':' ';

		$strQuery = 'SELECT tmv.*, ttm.nombre AS tipo_maquinaria ';
		$strQuery.= 'FROM tblc_maquinaria_vehiculo AS tmv ';
		$strQuery.= 'INNER JOIN tblc_tipo_maquinaria AS ttm ';
		$strQuery.= 'ON tmv.id_tipo_maquinaria = ttm.id_tipo_maquinaria ';
		$strQuery.= 'WHERE tmv.fecha_eliminado IS NULL'.$cond;
		$strQuery.= 'ORDER BY tmv.fecha_registro DESC, tmv.id_maquinaria_vehiculo DESC';

		return $strQuery;
	}

	//QUERY PARA GUARDAR UN NUEVO VEHÍCULO/MAQUINARIA
	public function guardaMaquinaria($categoria, $marca, $modelo, $idTipoMaq, $numEcon, $numSerie, $placas, $peso, $archSeguro, $archFactura, $fecha){
		$strQuery = 'INSERT INTO tblc_maquinaria_vehiculo ';
		$strQuery.= '(id_categoria, marca, modelo, id_tipo_maquinaria, numero_economico, numero_serie, placas, peso, archivo_seguro, archivo_factura, fecha_registro) ';
		$strQuery.= 'VALUES('.$categoria.', "'.$marca.'", "'.$modelo.'", '.$idTipoMaq.', "'.$numEcon.'", "'.$numSerie.'", "'.$placas.'", '.$peso.', NULLIF("'.$archSeguro.'",""), NULLIF("'.$archFactura.'",""), "'.$fecha.'")';

		return $strQuery;
	}

	//QUERY PARA ACTUALIZAR LOS DATOS DE UN VEHÍCULO/MAQUINARIA
	public function actualizaMaquinaria($id, $categoria, $marca, $modelo, $idTipoMaq, $numEcon, $numSerie, $placas, $peso, $archSeguro, $archFactura){
		$strQuery = 'UPDATE tblc_maquinaria_vehiculo ';
		$strQuery.= 'SET id_categoria = '.$categoria.', marca = "'.$marca.'", modelo = "'.$modelo.'", id_tipo_maquinaria = '.$idTipoMaq.', numero_economico = "'.$numEcon.'", numero_serie = "'.$numSerie.'", placas = "'.$placas.'", peso = '.$peso.', archivo_seguro = NULLIF("'.$archSeguro.'",""), archivo_factura = NULLIF("'.$archFactura.'","") ';
		$strQuery.= 'WHERE id_maquinaria_vehiculo = '.$id;

		return $strQuery;
	}

	//QUERY PARA ACTUALIZAR EL KILOMETRAJE DE UN VEHÍCULO
	public function actualizaKms($id, $kms){
		$strQuery = 'UPDATE tblc_maquinaria_vehiculo ';
		$strQuery.= 'SET kilometraje = '.$kms.' ';
		$strQuery.= 'WHERE id_maquinaria_vehiculo = '.$id;

		return $strQuery;
	}

	//QUERY PARA MARCAR CÓMO ELIMINADO UN REGISTRO DEL CATÁGLO DE MAQUINARIA/VEHÍCULOS
	public function eliminaMaquinaria($id, $fecha){
		$strQuery = 'UPDATE tblc_maquinaria_vehiculo ';
		$strQuery.= 'SET fecha_eliminado = "'.$fecha.'" ';
		$strQuery.= 'WHERE id_maquinaria_vehiculo = '.$id;

		return $strQuery;
	}

	//CATÁLOGO DE TIPO DE MAQUINARIA
	public function listadoTipoMaq($id = ''){
		$cond = ($id != '')? ' AND id_tipo_maquinaria = '.$id.' ':' ';

		$strQuery = 'SELECT id_tipo_maquinaria, nombre, fecha_registro ';
		$strQuery.= 'FROM tblc_tipo_maquinaria ';
		$strQuery.= 'WHERE fecha_eliminado IS NULL'.$cond;
		$strQuery.= 'ORDER BY fecha_registro DESC, id_tipo_maquinaria DESC';

		return $strQuery;
	}

	//QUERY PARA AGREGAR UN NUEVO REGISTRO AL CATÁLOGO DE TIPO DE MAQUINARIA
	public function addTipoMaquinaria($nombre, $fecha){
		$strQuery = 'INSERT INTO tblc_tipo_maquinaria ';
		$strQuery.= '(nombre, fecha_registro) ';
		$strQuery.= 'VALUES("'.$nombre.'", "'.$fecha.'")';

		return $strQuery;
	}

	//QUERY PARA ACTUALIZAR UN REGISTRO DEL CATÁLOGO DE TIPO DE MAQUINARIA
	public function actualizaTipoMaquinaria($id, $nombre){
		$strQuery = 'UPDATE tblc_tipo_maquinaria ';
		$strQuery.= 'SET nombre = "'.$nombre.'" ';
		$strQuery.= 'WHERE id_tipo_maquinaria = '.$id;

		return $strQuery;
	}

	//QUERY PARA MARCAR CÓMO ELIMINADO UN REGISTRO DEL CATÁLOGO DE TIPO DE MAQUINARIA
	public function eliminaTipoMaquinaria($id, $fecha){
		$strQuery = 'UPDATE tblc_tipo_maquinaria ';
		$strQuery.= 'SET fecha_eliminado = "'.$fecha.'" ';
		$strQuery.= 'WHERE id_tipo_maquinaria = '.$id;

		return $strQuery;
	}

	//REGUARDO DE VEHÍCULOS
	public function vehiculosResgListado($id = '', $opt, $busqueda, $fechaIni, $fechaHasta, $estatus){
		$cond = ($id != '')? ' AND treg.id_resguardo = '.$id.' ':' ';
		switch ($opt) {
			case 1:
				$cond.= ($busqueda != '') ? ' AND CONCAT(tmv.marca," ",tmv.modelo) LIKE "%'.$busqueda.'%" ':' ';			
			break;
			
			case 2:
				$cond.= ($busqueda != '')? ' AND treg.usuario LIKE "%'.$busqueda.'%" ':' ';
			break;
		}
		$cond.= ($fechaIni != '' && $fechaHasta != '')? ' AND fecha_asignacion BETWEEN "'.$fechaIni.'" AND "'.$fechaHasta.'" ':' ';
		$cond.= ($estatus > -1)? ' AND estatus = '.$estatus.' ':' ';

		$strQuery = 'SELECT treg.id_resguardo, treg.usuario, treg.id_maquinaria, CONCAT(tmv.marca," ",tmv.modelo) AS vehiculo, treg.neumaticos_entrega, treg.cristales_entrega, treg.carroceria_entrega, treg.neumaticos_recibe, treg.cristales_recibe, treg.carroceria_recibe, treg.poliza, treg.tarjeta_circulacion, treg.factura, treg.fecha_asignacion, fecha_conclusion, treg.observaciones, treg.estatus, treg.fecha_registro ';
		$strQuery.= 'FROM tbl_resguardo AS treg ';
		$strQuery.= 'INNER JOIN tblc_maquinaria_vehiculo tmv ';
		$strQuery.= 'ON treg.id_maquinaria = tmv.id_maquinaria_vehiculo ';
		$strQuery.= 'WHERE treg.fecha_eliminado IS NULL'.$cond;
		$strQuery.= 'ORDER BY treg.fecha_registro DESC, treg.id_resguardo DESC';

		return $strQuery;
	}

	//QUERY PARA CARGAR EL COMBO DE VEHÍCULOS PARA EL FORMULARIO DE REGISTR DE RESGUARDOS
	public function loadCboVehiculos(){
		$strQuery = 'SELECT tmv.id_maquinaria_vehiculo AS id, CONCAT(tmv.marca," ",tmv.modelo, " - ", numero_economico) AS valor, IF(tr.estatus = 1, 1, 0) AS habilitado ';
		$strQuery.= 'FROM tblc_maquinaria_vehiculo AS tmv ';
		$strQuery.= 'LEFT JOIN tbl_resguardo AS tr ';
		$strQuery.= 'ON tmv.id_maquinaria_vehiculo = tr.id_maquinaria ';
		$strQuery.= 'WHERE tmv.fecha_eliminado IS NULL AND tr.fecha_eliminado IS NULL ';
		$strQuery.= 'ORDER BY valor ASC';

		return $strQuery;
	}

	public function loadCboMaquinaria(){
		$strQuery = 'SELECT id_maquinaria_vehiculo AS id, CONCAT(marca," ",modelo, " - ", numero_economico) AS valor ';
		$strQuery.= 'FROM tblc_maquinaria_vehiculo ';
		$strQuery.= 'WHERE fecha_eliminado IS NULL ';
		$strQuery.= 'ORDER BY valor ASC';

		return $strQuery;
	}

	//QUERY PARA REGISTRAR UN NUEVO RESGUARDO
	public function addResguardoMaq($idMaquinaria, $usuario, $neumaticosEnt, $cristalesEnt, $carroceriaEnt, $poliza, $tarjeta, $factura, $observaciones, $fechaAsignacion, $fechaRegistro){
		$strQuery = 'INSERT INTO tbl_resguardo ';
		$strQuery.= '(id_maquinaria, usuario, neumaticos_entrega, cristales_entrega, carroceria_entrega, poliza, tarjeta_circulacion, factura, observaciones, estatus, fecha_asignacion, fecha_registro) ';
		$strQuery.= 'VALUES('.$idMaquinaria.', "'.$usuario.'", '.$neumaticosEnt.', '.$cristalesEnt.', '.$carroceriaEnt.', '.$poliza.', '.$tarjeta.', '.$factura.', NULLIF("'.$observaciones.'",""), 1, "'.$fechaAsignacion.'", "'.$fechaRegistro.'")';

		return $strQuery;
	}

	//QUERY PARA ACTUALIZAR UN REGISTRO DE UN RESGUARDO
	public function actualizaResguardo($id, $idMaquinaria, $usuario, $neumaticosEnt, $cristalesEnt, $carroceriaEnt, $neumaticosRec, $cristalesRec, $carroceriaRec, $poliza, $tarjeta, $factura, $observaciones, $fechaAsignacion){
		$strQuery = 'UPDATE tbl_resguardo ';
		$strQuery.= 'SET id_maquinaria = '.$idMaquinaria.', usuario = "'.$usuario.'", neumaticos_entrega = '.$neumaticosEnt.', cristales_entrega = '.$cristalesEnt.', carroceria_entrega = '.$carroceriaEnt.', neumaticos_recibe = '.$neumaticosRec.', cristales_recibe = '.$cristalesRec.' , carroceria_recibe = '.$carroceriaRec.', poliza = '.$poliza.', tarjeta_circulacion = '.$tarjeta.', factura = '.$factura.', observaciones = NULLIF("'.$observaciones.'",""), fecha_asignacion = "'.$fechaAsignacion.'" ';
		$strQuery.= 'WHERE id_resguardo = '.$id;

		return $strQuery;
	}

	//QUERY PARA MARCAR CÓMO CONCLUIDO EL RESGUARDO DE UN VEHÍCULO/MAQUINARIA
	public function concluirResguardo($id, $fecha){
		$strQuery = 'UPDATE tbl_resguardo ';
		$strQuery.= 'SET estatus = 0, fecha_conclusion = "'.$fecha.'" ';
		$strQuery.= 'WHERE id_resguardo = '.$id;

		return $strQuery;
	}

	//QUERY PARA MARCAR CÓMO ELIMINADO UN REGISTRO DEL RESGUARDO DE MAQUINARIA/VEHÍCULOS
	public function eliminaResguardo($id, $fecha){
		$strQuery = 'UPDATE tbl_resguardo ';
		$strQuery.= 'SET fecha_eliminado = "'.$fecha.'" ';
		$strQuery.= 'WHERE id_resguardo = '.$id;

		return $strQuery;
	}

	//CATÁLOGO TIPO DE MANTENIMIENTO ---------------------------------------------
	//QUERY PARA CARGAR EL COMBO DE TIPO DE MTTO
	public function loadCboTpoMtto(){
		$strQuery = 'SELECT id_tipo_mtto AS id, nombre AS valor, descripcion AS tooltip, kilometraje, dias_espera ';
		$strQuery.= 'FROM tblc_tipo_mtto ';
		$strQuery.= 'WHERE fecha_eliminado IS NULL ';
		$strQuery.= 'ORDER BY nombre ASC';

		return $strQuery;
	}

	//QUERY PARA OBTENER EL LISTADO/INFORMACIÓN DEL TIPO DE MANTENIMIENTO
	public function getInfoTipoMtto($id = ''){
		$cond = ($id != '')? ' AND id_tipo_mtto = '.$id.' ':' ';

		$strQuery = 'SELECT id_tipo_mtto, nombre, descripcion, kilometraje, dias_espera, fecha_registro ';
		$strQuery.= 'FROM tblc_tipo_mtto ';
		$strQuery.= 'WHERE fecha_eliminado IS NULL'.$cond;
		$strQuery.= 'ORDER BY id_tipo_mtto DESC';

		return $strQuery;
	}

	//QUERY PARA AGREGAR UN NUEVO REGISTRO AL CATÁLOGO DE TIPO DE MANTENIMIENTO
	public function addTipoMtto($nombre, $kilometraje, $dias, $descripcion, $fecha){
		$strQuery = 'INSERT INTO tblc_tipo_mtto ';
		$strQuery.= '(nombre, kilometraje, dias_espera, descripcion, fecha_registro) ';
		$strQuery.= 'VALUES("'.$nombre.'", '.$kilometraje.', '.$dias.', NULLIF("'.$descripcion.'",""), "'.$fecha.'")';

		return $strQuery;
	}

	//QUERY PARA ACTUALIZAR UN REGISTRO DEL CATÁLOGO DE TIPO DE MANTENIMIENTO
	public function actualizaTipoMtto($id, $nombre, $kilometraje, $dias, $descripcion){
		$strQuery = 'UPDATE tblc_tipo_mtto ';
		$strQuery.= 'SET nombre = "'.$nombre.'", kilometraje = '.$kilometraje.', dias_espera = '.$dias.', descripcion = "'.$descripcion.'" ';
		$strQuery.= 'WHERE id_tipo_mtto = '.$id;

		return $strQuery;
	}

	//QUERY PARA MARCAR CÓMO ELIMINADO UN REGISTRO DEL CATÁLOGO DE TIPO DE MANTINIMIENTO
	public function eliminaTipoMtto($id, $fecha){
		$strQuery = 'UPDATE tblc_tipo_mtto ';
		$strQuery.= 'SET fecha_eliminado = "'.$fecha.'" ';
		$strQuery.= 'WHERE id_tipo_mtto = '.$id;

		return $strQuery;
	}

	//MÓDULO DE MANTENIMENTO DE MAQUINARIA/VEHÍCULOS
	//QUERY PARA CARGAR EL COMBO DE VEHÍCULOS PARA EL FORMULARIO DE REGISTR DE RESGUARDOS
	public function loadCboVehiculosMtto(){
		$strQuery = 'SELECT tmv.id_maquinaria_vehiculo AS id, CONCAT(tmv.marca," ",tmv.modelo, " - ", tmv.numero_economico) AS valor, tmv.id_categoria AS categoria, tmv.kilometraje AS data, IF(tmm.estatus = 1 || tmm.estatus = 2, 1, 0) AS habilitado ';
		$strQuery.= 'FROM tblc_maquinaria_vehiculo AS tmv ';
		$strQuery.= 'LEFT JOIN tbl_maquinaria_mantenimiento AS tmm ';
		$strQuery.= 'ON tmv.id_maquinaria_vehiculo = tmm.id_maquinaria_vehiculo ';
		$strQuery.= 'WHERE tmv.fecha_eliminado IS NULL AND tmv.fecha_eliminado IS NULL ';
		$strQuery.= 'ORDER BY valor ASC';

		return $strQuery;
	}

	public function getDataMttoMaqVeh($idMaMtto = ''){
		$cond = ($idMaMtto != '')? ' AND tmm.id_maquinaria_mantenimiento = '.$idMaMtto.' ':' ';

		$strQuery = 'SELECT tmm.id_maquinaria_mantenimiento, tmm.id_maquinaria_vehiculo, tmv.id_categoria, tmv.marca, tmv.modelo, tmv.numero_economico, tmv.placas, tmv.kilometraje, tmm.id_tipo_mantenimiento, ctm.nombre AS tpoMtto, tmm.fecha_mtto, kms_acumulados, kms_servicio, fecha_servicio_proximo, tmm.fecha_registro, tmm.estatus, tmm.observaciones ';
		$strQuery.= 'FROM tbl_maquinaria_mantenimiento AS tmm ';
		$strQuery.= 'INNER JOIN tblc_maquinaria_vehiculo AS tmv ';
		$strQuery.= 'ON tmm.id_maquinaria_vehiculo = tmv.id_maquinaria_vehiculo ';
		$strQuery.= 'INNER JOIN tblc_tipo_mtto AS ctm ';
		$strQuery.= 'ON tmm.id_tipo_mantenimiento = ctm.id_tipo_mtto ';
		$strQuery.= 'WHERE tmm.fecha_eliminado IS NULL'.$cond;
		$strQuery.= 'ORDER BY tmm.fecha_registro DESC, tmm.id_maquinaria_mantenimiento ASC';

		return $strQuery;
	}

	//QUERY PARA OBTENER EL TOTAL DEL COSTO DEL MANTENIMIENTO A PARTIR DE EL DETALLE DEL MISMO
	public function getTotalMtto($idMtto){
		$strQuery = 'SELECT SUM(costo) AS total ';
		$strQuery.= 'FROM tbl_detalle_mtto ';
		$strQuery.= 'WHERE id_mantenimiento = '.$idMtto.' AND fecha_eliminado IS NULL';

		return $strQuery;
	}

	//QUERY PARA AGREGAR UN REGISTRO A LA TABLA DE MANTENIMIENTO DE MAQUINARIA
	public function addMaqMtto($idTpoMtto, $idMaqVeh, $estatus, $fechaMtto, $idCategMV, $rangoInit, $rangoFin, $observaciones, $fechaR){
		$valKmsAcumulados = 0; $valKmsServ = 0; $fechaServProx = '';
		switch ($idCategMV) {
			case 1:
				$valKmsAcumulados = $rangoInit;
				$valKmsServ       = $rangoFin;
				break;
			
			case 2:
				$fechaServProx = $rangoFin;
				break;
		}

		$strQuery = 'INSERT INTO tbl_maquinaria_mantenimiento ';
		$strQuery.= '(id_tipo_mantenimiento, id_maquinaria_vehiculo, estatus, fecha_mtto, fecha_servicio_proximo, kms_acumulados, kms_servicio, observaciones, fecha_registro) ';
		$strQuery.= 'VALUES('.$idTpoMtto.', '.$idMaqVeh.', '.$estatus.', NULLIF("'.$fechaMtto.'",""), NULLIF("'.$fechaServProx.'",""), '.$valKmsAcumulados.', '.$valKmsServ.', NULLIF("'.$observaciones.'",""), "'.$fechaR.'")';

		return $strQuery;
	}

	//QUERY PARA ACTUALIZAR LOS DATOS DE UN REGISTRO DE MANTENIMIENTO DE UN VEHÍCULO/MAQUINARIA
	public function actualizarMaqMtto($idMtto, $idTpoMtto, $idMaqVeh, $estatus, $fechaMtto, $idCategMV, $rangoInit, $rangoFin, $observaciones){
		$valKmsAcumulados = 0; $valKmsServ = 0; $fechaServProx = '';
		switch ($idCategMV) {
			case 1:
				$valKmsAcumulados = $rangoInit;
				$valKmsServ       = $rangoFin;
				break;
			
			case 2:
				$fechaServProx = $rangoFin;
				break;
		}

		$strQuery = 'UPDATE tbl_maquinaria_mantenimiento ';
		$strQuery.= 'SET id_tipo_mantenimiento = '.$idTpoMtto.', id_maquinaria_vehiculo = '.$idMaqVeh.', estatus = '.$estatus.', fecha_mtto = NULLIF("'.$fechaMtto.'",""), fecha_servicio_proximo = NULLIF("'.$fechaServProx.'",""), kms_acumulados = '.$valKmsAcumulados.', kms_servicio = '.$valKmsServ.', observaciones = NULLIF("'.$observaciones.'","") ';
		$strQuery.= 'WHERE id_maquinaria_mantenimiento = '.$idMtto;

		return $strQuery;
	}

	//QUERY PARA MARCAR CÓMO ELIMINADO UN REGISTRO DE LA TABLA tbl_maquinaria_mantenimiento
	public function eliminaMaqMtto($id, $fecha){
		$strQuery = 'UPDATE tbl_maquinaria_mantenimiento ';
		$strQuery.= 'SET fecha_eliminado = "'.$fecha.'" ';
		$strQuery.= 'WHERE id_maquinaria_mantenimiento = '.$id;

		return $strQuery;
	}

	//CATÁLOGO DE RACCIONES PARA EL MTTO DE MAQUINARIA/VEÍCULOS
	//QUERY PARA CARGAR EL COMBO DE REFACCIÓN EN EL FORMULARIO DE DETALLE DEL MTTO
	public function loadCboRefaccciones(){
		$strQuery = 'SELECT id_refaccion AS id, nombre AS valor ';
		$strQuery.= 'FROM tblc_refaccion_mtto ';
		$strQuery.= 'WHERE fecha_eliminado IS NULL ORDER BY nombre ASC';

		return $strQuery;
	}

	//QUERY PARA OBTENER LOS DATOS DEL LISTADO DEL DETALLE DE MTTO/MAQUINARIA
	public function getDataRefaccionMtto($id = ''){
		$cond = ($id != '')? ' AND id_refaccion = '.$id.' ':' ';
		$strQuery = 'SELECT id_refaccion, nombre, fecha_registro ';
		$strQuery.= 'FROM tblc_refaccion_mtto ';
		$strQuery.= 'WHERE fecha_eliminado IS NULL'.$cond;
		$strQuery.= 'ORDER BY id_refaccion DESC';

		return $strQuery;
	}

	//QUERY PARA AGREGAR UN REGISTRO AL CATÁLOGO DE REFACCIONES
	public function addRefaccion($nombre, $fecha){
		$strQuery = 'INSERT INTO tblc_refaccion_mtto ';
		$strQuery.= '(nombre, fecha_registro) ';
		$strQuery.= 'VALUES("'.$nombre.'", "'.$fecha.'")';

		return $strQuery;
	}

	//QUERY PARA ACTUALIZAR LOS DATOS DE UNA REFACCIÓN
	public function actualizaRefaccionMtto($id, $nombre){
		$strQuery = 'UPDATE tblc_refaccion_mtto ';
		$strQuery.= 'SET nombre = "'.$nombre.'" ';
		$strQuery.= 'WHERE id_refaccion = '.$id;

		return $strQuery;
	}

	//QUERY PARA MARCAR CÓMO ELIMINADO EL REGISTRO DEL CATÁLOGO DE REFACCIONES
	public function eliminaRefaccionMtto($id, $fecha){
		$strQuery = 'UPDATE tblc_refaccion_mtto ';
		$strQuery.= 'SET fecha_eliminado = "'.$fecha.'" ';
		$strQuery.= 'WHERE id_refaccion = '.$id;

		return $strQuery;
	}

	//MÓDULO DE DETALLE DE MTTO DE MAQUINARIA/VEHÍCULOS
	public function getDataDetalleMttoMaq($idMtto, $id = ''){
		$cond = ($id != '')? ' AND tdm.id_detalle_mantenimiento = '.$id.' ':' ';
		$strQuery = 'SELECT tdm.id_detalle_mantenimiento, tdm.id_mantenimiento, tdm.id_refaccion, cfm.nombre AS refaccion, tdm.observaciones, tdm.costo, tdm.fecha_registro  ';
		$strQuery.= 'FROM tbl_detalle_mtto AS tdm ';
		$strQuery.= 'INNER JOIN tblc_refaccion_mtto AS cfm ';
		$strQuery.= 'ON tdm.id_refaccion = cfm.id_refaccion ';
		$strQuery.= 'WHERE tdm.id_mantenimiento = '.$idMtto.' AND tdm.fecha_eliminado IS NULL'.$cond;
		$strQuery.= 'ORDER BY tdm.id_detalle_mantenimiento DESC';

		return $strQuery;
	}

	//AGREGA UN REGISTRO A LA TABLA tbl_detalle_mtto
	public function addDetalleMtto($idMantenimiento, $idRefaccion, $costo, $observaciones, $fecha){
		$strQuery = 'INSERT INTO tbl_detalle_mtto ';
		$strQuery.= '(id_mantenimiento, id_refaccion, costo, observaciones, fecha_registro) ';
		$strQuery.= 'VALUES('.$idMantenimiento.', '.$idRefaccion.', '.$costo.', NULLIF("'.$observaciones.'",""), "'.$fecha.'")';

		return $strQuery;
	}

	//QUERY PARA ACTUALIZAR UN REGISTRO DE LA TRABLA tbl_detalle_mtto
	public function actualizaDetMtto($idMtto, $idDetMtto, $idRefaccion, $costo, $observaciones){
		$strQuery = 'UPDATE tbl_detalle_mtto ';
		$strQuery.= 'SET id_refaccion = '.$idRefaccion.', costo = '.$costo.', observaciones = NULLIF("'.$observaciones.'","") ';
		$strQuery.= 'WHERE id_mantenimiento = '.$idMtto.' AND id_detalle_mantenimiento = '.$idDetMtto;

		return $strQuery;
	}

	//QUERY PARA MARCAR CÓMO ELIMINADO UN REGISTRO DE LA TABLA tbl_detalle_mtto
	public function eliminaDetMtto($id, $fecha){
		$strQuery = 'UPDATE tbl_detalle_mtto ';
		$strQuery.= 'SET fecha_eliminado = "'.$fecha.'" ';
		$strQuery.= 'WHERE id_detalle_mantenimiento = '.$id;

		return $strQuery;
	}

	//MÓDULO DE ACARREOS------------------------------------------------------

	//QUERY PARA OBTENER EL LISTADO O DATOS DE ACARREOS
	public function getDataAcarreos($id = ''){
		$strQuery = 'SELECT ta.*, CONCAT(tmv.marca," ",tmv.modelo) AS vehiculoTransportador ';
		$strQuery.= 'FROM tbl_acarreo AS ta ';
		$strQuery.= 'INNER JOIN tblc_maquinaria_vehiculo AS tmv ';
		$strQuery.= 'ON ta.id_vehiculo_transportador = tmv.id_maquinaria_vehiculo ';
		$strQuery.= 'WHERE ta.fecha_eliminado IS NULL ';
		$strQuery.= 'ORDER BY ta.fecha_registro DESC, ta.id_acarreo DESC';

		return $strQuery;
	}

	//QUERY PARA OBTENER LA OBRA A TRAVÉS DE SU ID
	public function getObra($id){
		$strQuery = 'SELECT nombre FROM tbl_obras ';
		$strQuery.= 'WHERE id_obras = '.$id;

		return $strQuery;
	}

	//QUERY PARA OBTENER EL KILOMETRAJE DE UN ACARREO
	public function getKilometrajeAcarreo($idAcarreo){
		$strQuery = 'SELECT kilometraje ';
		$strQuery.= 'FROM tbl_acarreo ';
		$strQuery.= 'WHERE id_acarreo = '.$idAcarreo;

		return $strQuery;
	}

	//QUERY PARA AGREGAR UN NUEVO REGISTRO A LA TABLA DE ACARREO
	public function addAcarreo($origen, $origenOtro, $destino, $destinoOtro, $idVehiculoTransp, $kilometraje, $combustible, $fechaMovimiento, $fechaLlegada, $estatus, $tarifaAlimentacion, $diasAlimentacion, $tarifaHospedaje, $diasHospedaje, $gastosAdicionales, $total, $observaciones, $fechaRegistro){
		$strQuery = 'INSERT INTO tbl_acarreo ';
		$strQuery.= '(origen, origen_otro, destino, destino_otro, id_vehiculo_transportador, kilometraje, combustible, fecha_movimiento, fecha_llegada, estatus, tarifa_alimentacion, dias_alimentacion, tarifa_hospedaje, dias_hospedaje, gastos_adicionales, total, observaciones, fecha_registro) ';
		$strQuery.= 'VALUES('.$origen.', NULLIF("'.$origenOtro.'",""), '.$destino.', NULLIF("'.$destinoOtro.'",""), '.$idVehiculoTransp.', '.$kilometraje.', "'.$combustible.'", "'.$fechaMovimiento.'", "'.$fechaLlegada.'", '.$estatus.', '.$tarifaAlimentacion.', '.$diasAlimentacion.', '.$tarifaHospedaje.', '.$diasHospedaje.', '.$gastosAdicionales.', '.$total.', NULLIF("'.$observaciones.'",""), "'.$fechaRegistro.'")';

		return $strQuery;
	}

	//QUERY PARA ACTUALIZAR UN REGISTRO DE LA TABLA DE ACARREOS
	public function actualizaAcarreo($id, $origen, $origenOtro, $destino, $destinoOtro, $idVehiculoTransp, $kilometraje, $combustible, $fechaMovimiento, $fechaLlegada, $estatus, $tarifaAlimentacion, $diasAlimentacion, $tarifaHospedaje, $diasHospedaje, $gastosAdicionales, $total, $observaciones){
		$strQuery = 'UPDATE tbl_acarreo ';
		$strQuery.= 'SET origen = '.$origen.', origen_otro = NULLIF("'.$origenOtro.'",""), destino = '.$destino.', destino_otro = NULLIF("'.$destinoOtro.'",""), id_vehiculo_transportador = '.$idVehiculoTransp.', kilometraje = '.$kilometraje.', combustible = "'.$combustible.'", fecha_movimiento = "'.$fechaMovimiento.'", fecha_llegada = "'.$fechaLlegada.'", estatus = '.$estatus.', tarifa_alimentacion = '.$tarifaAlimentacion.', dias_alimentacion = '.$diasAlimentacion.', tarifa_hospedaje = '.$tarifaHospedaje.', dias_hospedaje = '.$diasHospedaje.', gastos_adicionales = '.$gastosAdicionales.', total = '.$total.', observaciones = NULLIF("'.$observaciones.'","") ';
		$strQuery.= 'WHERE id_acarreo = '.$id;

		return $strQuery;
	}

	//QUERY PARA ACTUALIZAR EL RENDIMIENT DE UN ACARREO
	public function actualizaRendimientoAcarreo($idAcarreo, $rendimiento, $combustible){
		$strQuery = 'UPDATE tbl_acarreo ';
		$strQuery.= 'SET rendimiento = '.$rendimiento.', combustible = "'.$combustible.'" ';
		$strQuery.= 'WHERE id_acarreo = '.$idAcarreo;

		return $strQuery;
	}

	//QUERY PARA MARCAR CÓMO ELIMINADO UN REGISTRO DE LA TABLA ACARREO
	public function eliminarAcarreo($id,  $fecha){
		$strQuery = 'UPDATE tbl_acarreo ';
		$strQuery.= 'SET fecha_eliminado = "'.$fecha.'" ';
		$strQuery.= 'WHERE id_acarreo = '.$id;

		return $strQuery;
	}

	//QUERYS PARA OBTENER LOS DATOS/LISTADO DE LA MAQUINARIA/VEHÍCULOS DE UN ACARREO
	public function getMaquinariaAcarreoListado($idAcarreo, $id = ''){
		$cond = ($id != '')? ' AND tam.id_maquinaria = '.$id.' ':' ';

		$strQuery = 'SELECT tam.id_maquinaria, tam.id_acarreo, CONCAT(tmv.marca," ",tmv.modelo) AS maquinaria, tmv.numero_economico, tmv.numero_serie, tmv.placas, tmv.peso, tam.fecha_registro ';
		$strQuery.= 'FROM tbl_acarreo_maquinaria AS tam ';
		$strQuery.= 'INNER JOIN tblc_maquinaria_vehiculo AS tmv ';
		$strQuery.= 'ON tam.id_maquinaria = tmv.id_maquinaria_vehiculo ';
		$strQuery.= 'WHERE tam.fecha_eliminado IS NULL AND tam.id_acarreo = '.$idAcarreo.$cond;
		$strQuery.= 'ORDER BY tam.fecha_registro DESC';

		return $strQuery;
	}

	//QUERY PARA OBTENER EL RENDIMIENTO DEL VEHÍCULO DE TRANSPORTE DE MAQUINARIA EN EL ACARREO
	public function getRendimientoMaqAcarreo($idAcarreo){
		$strQuery = 'SELECT SUM(tmv.peso) AS totPesoMaq, IF(SUM(tmv.peso) <= 20, "1.5", "1.0") AS rendimiento ';
		$strQuery.= 'FROM tbl_acarreo_maquinaria AS tam ';
		$strQuery.= 'INNER JOIN tblc_maquinaria_vehiculo AS tmv ';
		$strQuery.= 'ON tam.id_maquinaria = tmv.id_maquinaria_vehiculo ';
		$strQuery.= 'WHERE tam.fecha_eliminado IS NULL AND tam.id_acarreo = '.$idAcarreo;

		return $strQuery;
	}

	//QUERY PARA AGREGAR UN REGISTRO A LA TABLA DE tbl_acarreo_maquinaria
	public function addAcarreoMaqVeh($idAcarreo, $idMaquinaria, $fecha){
		$strQuery = 'INSERT INTO tbl_acarreo_maquinaria ';
		$strQuery.= '(id_acarreo, id_maquinaria, fecha_registro) ';
		$strQuery.= 'VALUES('.$idAcarreo.', '.$idMaquinaria.', "'.$fecha.'")';

		return $strQuery;
	}

	//QUERY PARA ELIMINAR EL REGISTRO DE UNA MAQUINARIA DE LA TABLA tbl_acarreo_maquinaria
	public function eliminaAcarreoMaqVeh($idAcarreo, $idMaquinaria, $fecha){
		$strQuery = 'UPDATE tbl_acarreo_maquinaria ';
		$strQuery.= 'SET fecha_eliminado = "'.$fecha.'" ';
		$strQuery.= 'WHERE id_acarreo = '.$idAcarreo.' AND id_maquinaria = '.$idMaquinaria;

		return $strQuery;
	}


	//---------------------------------------------------------------------------------
	//CATÁLOGO DE EMPRESAS
	public function getEmpresa($id=''){
		$cond = ($id != '')? ' AND id_empresa = '.$id.' ':' ';
		$strQuery = 'SELECT * FROM tblc_empresas ';
		$strQuery.= 'WHERE fecha_eliminacion IS NULL'.$cond;
		return $strQuery;
	}

	public function addEmpresa($name, $account, $date){
		$strQuery = 'INSERT INTO tblc_empresas ';
		$strQuery.= '(nombre, num_cuenta, fecha_registro) ';
		$strQuery.= 'VALUES("'.$name.'", "'.$account.'", "'.$date.'")';
		return $strQuery;
	}

	public function updateEmpresa($id, $name, $account){
		$strQuery = 'UPDATE tblc_empresas ';
		$strQuery.= 'SET nombre = "'.$name.'", num_cuenta = "'.$account.'" ';
		$strQuery.= 'WHERE id_empresa = '.$id;
		return $strQuery;
	}

	public function deleteEmpresa($id, $date){
		$strQuery = 'UPDATE tblc_empresas ';
		$strQuery.= 'SET fecha_eliminacion = "'.$date.'" ';
		$strQuery.= 'WHERE id_empresa = '.$id;
		return $strQuery;
	}

	//QUERY PARA CARGAR EL COMBO DE EMPRESAS
	public function loadCboEmpresas(){
		$strQuery = 'SELECT 0 AS id, " Seleccionar.." AS valor ';
		$strQuery.= 'UNION ALL ';
		$strQuery.= 'SELECT id_empresa, nombre ';
		$strQuery.= 'FROM tblc_empresas ';
		$strQuery.= 'WHERE fecha_eliminacion IS NULL ';
		$strQuery.= 'ORDER BY valor ASC, id ASC';

		return $strQuery;
	}

	//------------------------------------------------------------------------------------------
	//MÓDULO DE ALMACÉN
	//------------------------------------------------------------------------------------------

	//QUERY PARA CARGAR EL LISTADO DE INVENTARIO
	public function getInventarioData($id=''){
		$cond = ($id!='')? ' AND acn.id_almacen = '.$id.' ':' ';
		$strQuery = 'SELECT acn.*, tob.nombre AS obra, tei.codigo AS codExpIn, tei.concepto AS cptoExpIn, tei.unidad AS unidadExpIn, tii.codigo AS codInvInt, tii.concepto AS cptoInvInt, tii.unidad AS unidadInvInt ';
		$strQuery.= 'FROM tbl_almacen AS acn ';
		$strQuery.= 'LEFT JOIN tbl_explosion_insumos AS tei ';
		$strQuery.= 'ON acn.id_explosion_insumo = tei.id_exposion_insumos ';
		$strQuery.= 'LEFT JOIN tblc_inventario_interno AS tii ';
		$strQuery.= 'ON acn.id_inventario_interno = tii.id_inventario_interno ';
		$strQuery.= 'LEFT JOIN tbl_obras AS tob ';
		$strQuery.= 'ON tei.id_obra = tob.id_obras ';
		$strQuery.= 'WHERE acn.fecha_eliminado IS NULL'.$cond;
		$strQuery.= 'ORDER BY acn.fecha_actualizacion DESC';

		return $strQuery;
	}

	//QUERY PARA OBTENER LA EXISTENCIA DE UN ARTÍCULO DE LA EXPLOSIÓN DE INSUMOS/INVENTARIO INTERNO
	public function getExistsProdsAlm($optInv, $idArticulo){
		$fielInv  = ($optInv == 0)? 'id_explosion_insumo': 'id_inventario_interno';
		$strQuery = 'SELECT id_almacen, existencia, stock_minimo ';
		$strQuery.= 'FROM tbl_almacen ';
		$strQuery.= 'WHERE fecha_eliminado IS NULL AND '.$fielInv.' = '.$idArticulo;

		return $strQuery;
	}

	//QUERY PARA AGREGAR EXISTENCIA A UN PRODUCTO DEL INVENTARIO
	public function addExistProdAlm($optTansac, $optInv, $idAlm, $idArticulo, $existencia, $stockMin, $tipoMov, $fecha){
		$strQuery = '';
		$fielInv  = ($optInv == 0)? 'id_explosion_insumo': 'id_inventario_interno';
		$tipoMov  = ($tipoMov == 1)? '+':'-';
		switch ($optTansac) {
			case 0:
				$strQuery = 'INSERT INTO tbl_almacen ';
				$strQuery.= '('.$fielInv.', existencia, stock_minimo, fecha_actualizacion) ';
				$strQuery.= 'VALUES('.$idArticulo.', '.$existencia.', '.$stockMin.', "'.$fecha.'")';
			break;
			
			case 1:
				$strQuery = 'UPDATE tbl_almacen ';
				$strQuery.= 'SET existencia = (existencia'.$tipoMov.$existencia.'), fecha_actualizacion = "'.$fecha.'" ';
				$strQuery.= 'WHERE id_almacen = '.$idAlm;
			break;
		}

		return $strQuery;
	}

	//QUERY PARA CONSULTAR SI EXISTEN EL REGISTRO EN LA TABLA DE ALMACÉN
	public function existRegAlm($field, $id){
		$strQuery = 'SELECT id_almacen ';
		$strQuery.= 'FROM tbl_almacen ';
		$strQuery.= 'WHERE '.$field.' = '.$id;

		return $strQuery;
	}

	//QUERY PARA AGREGAR UN REGISTRO AL HISTORIAL DE ENTRADAS/SALIDAS
	public function addHistInOutAlm($idAlmacen, $cantidad, $observaciones, $tipo, $fecha){
		$strQuery = 'INSERT INTO tbl_almacen_historial ';
		$strQuery.= '(id_almacen, cantidad, observaciones, tipo, fecha_registro) ';
		$strQuery.= 'VALUES('.$idAlmacen.', '.$cantidad.', NULLIF("'.$observaciones.'",""), '.$tipo.', "'.$fecha.'")';

		return $strQuery;
	}

	//QUERY PARA OBTENER EL HISTORIAL DE ENTRADA Y SALIDA DE UN CONCEPTO DEL ALMACÉN
	public function getLisHistESAlm($idAlmacen){
		$strQuery = 'SELECT cantidad, tipo, IF(tipo = 1, "Entrada", "Salida") AS tipoEnt, IFNULL(observaciones, "Sin Observaciones") AS fObservaciones, fecha_registro ';
		$strQuery.= 'FROM tbl_almacen_historial ';
		$strQuery.= 'WHERE id_almacen = '.$idAlmacen;

		return $strQuery;
	}

	//QUERY PARA OBTENER EL MATERIAL DE LA ORDEN DE COMPRA QUE SE AGREGARÁ AL ALMACÉN Y EL HISTORIAL DE ENTRADA/SALIDA
	public function getCptoOrdCompAut($idOrdComp){
		$strQuery = 'SELECT tac.id_explosion_insumos, tac.id_inventario_interno, tac.cantidad, toc.enviar_a ';
		$strQuery.= 'FROM tbl_artculo_compra AS tac ';
		$strQuery.= 'INNER JOIN tbl_orden_compra AS toc ';
		$strQuery.= 'ON tac.id_orden_compra = toc.id_orden_compra ';
		$strQuery.= 'WHERE tac.id_orden_compra = '.$idOrdComp.' ';
		$strQuery.= 'ORDER BY tac.id_articulo_compra ASC';

		return $strQuery;
	}

}
?>