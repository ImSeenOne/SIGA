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

	//QUERY PARA OBTENER EL LISTADO Y LOS DATOS DE LOS CLIENTES
	public function getClientesData($id = '',$nombre, $rfc, $tipoCte){
		$cond = '';

		$cond = ($id != '')? ' AND id_cliente = '.$id.' ':'';
		$cond.= ($nombre != '')? ' AND CONCAT(nombre," ",apellido_p," ", apellido_m) LIKE "%'.$nombre.'%" ':' ';
		$cond.= ($rfc != '')? ' AND rfc LIKE "%'.$rfc.'%" ':' ';
		$cond.= ($tipoCte != 0)? ' AND id_tipo = '.$tipoCte.' ':' ';

		$strQuery = 'SELECT id_cliente, rfc, nombre, apellido_p, apellido_m, correo, telefono, celular, estado_civil, domicilio, id_tipo, fecha_registro, observaciones ';
		$strQuery.= 'FROM tblc_clientes ';
		$strQuery.= 'WHERE fecha_eliminado IS NULL'.$cond;
		$strQuery.= 'ORDER BY fecha_registro DESC, id_cliente DESC';

		return $strQuery;
	}

	//QUERY PARA AGREGAR UN NUEVO REGISTRO DE LA TABLA DE CLINTES
	public function addCliente($idTipo, $nombre, $apellidoP, $apellidoM, $rfc, $correo, $domicilio, $telefono, $celular, $estadoCivil, $observaciones, $fecha){
		$strQuery = 'INSERT INTO tblc_clientes ';
		$strQuery.= '(id_tipo, nombre, apellido_p, apellido_m, rfc, correo, domicilio, telefono, celular, estado_civil, observaciones, fecha_registro) ';
		$strQuery.= 'VALUES('.$idTipo.', "'.$nombre.'", "'.$apellidoP.'", "'.$apellidoM.'", "'.$rfc.'", "'.$correo.'", "'.$domicilio.'", "'.$telefono.'", NULLIF("'.$celular.'",""), "'.$estadoCivil.'", NULLIF("'.$observaciones.'",""), "'.$fecha.'")';

		return $strQuery;

		return $strQuery;
	}


	//QUERY PARA ACTUALIZAR UN REGISTRO DE LA TABLA DE CLINTES
	public function actualizaCliente($id, $idTipo, $nombre, $apellidoP, $apellidoM, $rfc, $correo, $domicilio, $telefono, $celular, $estadoCivil, $observaciones){
		$strQuery = 'UPDATE tblc_clientes ';
		$strQuery.= 'SET id_tipo = '.$idTipo.', nombre = "'.$nombre.'", apellido_p = "'.$apellidoP.'", apellido_m = "'.$apellidoM.'", rfc = "'.$rfc.'", correo = "'.$correo.'", domicilio = "'.$domicilio.'", telefono = "'.$telefono.'", celular = NULLIF("'.$celular.'",""), estado_civil = '.$estadoCivil.', observaciones = NULLIF("'.$observaciones.'","") ';
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
	public function loadCboPropiedades(){
		$strQuery = 'SELECT id_propiedad , descripcion ';
		$strQuery.= 'FROM  tblc_propiedades ';
		$strQuery.= 'ORDER BY descripcion ASC';

		return $strQuery;
	}

	//QUERY PARA CARGAR EL COMBO DE PROPIEDADES
	public function loadCboeEstatusInteres(){
		$strQuery = 'SELECT id_estatus , nombre ';
		$strQuery.= 'FROM  tblc_estatus_interes ';
		$strQuery.= 'ORDER BY nombre ASC';

		return $strQuery;
	}

	//QUERY PARA OBTENER EL LISTADO/INFORMACIÓN DE LOS INTENRES DEL CLIENTE
	public function getInteresListadoCte($idCliente, $idInteres = ''){
		$cond = ($idInteres != '')? ' AND id_interes = '.$idInteres.' ':' ';

		$strQuery = 'SELECT tic.id_interes, tic.id_propiedad, prop.Descripcion, tic.monto, tic.agente, tic.estatus, tei.nombre AS txtestatus, tic.fecha_registro ';
		$strQuery.= 'FROM tbl_interes_cliente AS tic ';
		$strQuery.= 'INNER JOIN tblc_propiedades AS prop ';
		$strQuery.= 'ON tic.id_propiedad = prop.id_propiedad ';
		$strQuery.= 'INNER JOIN tblc_estatus_interes AS tei ';
		$strQuery.= 'ON tic.estatus = tei.id_estatus ';
		$strQuery.= 'WHERE tic.fecha_eliminado IS NULL AND tic.id_cliente = '.$idCliente.$cond;
		$strQuery.= 'ORDER BY tic.fecha_registro DESC, tic.id_interes DESC';

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

	//QUERY PARA CARGAR EL COMBO DE OBRA
	public function loadCboObras(){
		$strQuery = 'SELECT id_obras as id, nombre AS valor ';
		$strQuery.= 'FROM tbl_obras ';
		$strQuery.= 'ORDER BY nombre ASC';

		return $strQuery;
	}

	//QUERY PARA OBTENER EL LISTADO/DATOS DE ORDENES DE COMPRA
	public function ordenes_compra_listado($folio, $obra, $empresa, $estatus, $tipoComp, $fechaDesde, $fechaHasta, $id = ''){
		$cond ='';
		$cond.= ($folio != '')? ' AND folio = "'.$folio.'" ':' ';
		$cond.= ($obra != 0)? ' AND id_obra = "'.$obra.'" ':' ';
		$cond.= ($empresa != 0)? ' AND id_empresa = "'.$empresa.'" ':' ';
		$cond.= ($estatus != -1)? ' AND estatus = "'.$estatus.'" ':' ';
		$cond.= ($tipoComp != 0)? ' AND id_tipo_compra = "'.$tipoComp.'" ':' ';
		$cond.= ($fechaDesde != '' && $fechaHasta != '')? ' AND fecha_captura BETWEEN "'.$fechaDesde.'" AND "'.$fechaHasta.'" ':' ';
		$cond.= ($id != '')? ' AND id_orden_compra = '.$id.' ':' ';

		$strQuery = 'SELECT id_orden_compra, folio, id_obra, tob.nombre AS obra, id_empresa, toc.fecha_captura, toc.id_tipo_compra, toc.residente, toc.archivo_transferencia, toc.dirección_obra, toc.estatus ';
		$strQuery.= 'FROM tbl_orden_compra AS toc ';
		$strQuery.= 'INNER JOIN tbl_obras AS tob ';
		$strQuery.= 'ON toc.id_obra = tob.id_obras ';
		$strQuery.= 'WHERE toc.fecha_eliminado IS NULL'.$cond;
		$strQuery.= 'ORDER BY toc.fecha_registro DESC, toc.id_orden_compra DESC';

		return $strQuery;
	}

	//QUERY PARA AGREGAR UN NUEVO REGISTRO DE ORDEN DE COMPRA
	public function addOrdenCompra($folio, $idObra, $idEmpresa, $direccionObra, $fechaCaptura, $fechaRegistro, $residente, $idTipoCompra, $estatus){
		$strQuery = 'INSERT INTO tbl_orden_compra ';
		$strQuery.= '(id_obra, id_empresa, id_tipo_compra, folio, dirección_obra, fecha_captura, residente, fecha_registro, estatus) ';
		$strQuery.= 'VALUES('.$idObra.', '.$idEmpresa.', '.$idTipoCompra.', "'.$folio.'", "'.$direccionObra.'", "'.$fechaCaptura.'", "'.$residente.'", "'.$fechaRegistro.'", '.$estatus.')';

		return $strQuery;
	}

	//QUERY PARA ACTUALIZAR EL REGISTRO DE UNA ORDEN DE PAGO
	public function actualizarOrdenComp($idOrdenComp, $folio, $idObra, $idEmpresa, $direccionObra, $fechaCaptura, $residente, $idTipoCompra, $estatus){
		$strQuery = 'UPDATE tbl_orden_compra ';
		$strQuery.= 'SET folio = "'.$folio.'", id_obra = "'.$idObra.'", id_empresa = "'.$idEmpresa.'", id_tipo_compra = "'.$idTipoCompra.'", dirección_obra = "'.$direccionObra.'", fecha_captura = "'.$fechaCaptura.'", residente = "'.$residente.'", estatus = "'.$estatus.'" ';
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

	//QUERY PARA OBTENER LA INFO/LISTADO DE LOS ARTÍCULOS DE UNA ORDEN DE COMPRA
	public function articulosListado($idOrdenComp, $idArticulo = ''){
		$cond = ($idArticulo != '')? ' AND id_articulo_compra = '.$idArticulo.' ':' ';

		$strQuery = 'SELECT id_articulo_compra, articulo, cantidad, monto, unidad ';
		$strQuery.= 'FROM tbl_artculo_compra ';
		$strQuery.= 'WHERE fecha_eliminado IS NULL AND id_orden_compra = '.$idOrdenComp.$cond;
		$strQuery.= 'ORDER BY id_articulo_compra DESC';

		return $strQuery;
	}

	//QUERY PARA AGREGAR ARTÍCULOS A LA ORDEN DE COMPRA
	public function addArticuloOrdComp($idOrdenComp, $articulo, $unidad, $cantidad, $costo, $fecha){
		$strQuery = 'INSERT INTO tbl_artculo_compra ';
		$strQuery.= '(id_orden_compra, articulo, unidad, cantidad, monto, fecha_registro) ';
		$strQuery.= 'VALUES('.$idOrdenComp.', "'.$articulo.'", "'.$unidad.'", '.$cantidad.', '.$costo.', "'.$fecha.'")';

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
		$strQuery = 'SELECT SUM(monto) AS total ';
		$strQuery.= 'FROM tbl_artculo_compra ';
		$strQuery.= 'WHERE id_orden_compra = '.$idOrdenComp;

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
		$cond = ($idCotizacion != '')? ' AND id_cotizacion = '.$idCotizacion.' ':' ';

		$strQuery = 'SELECT id_cotizacion, id_proveedor, num_cuenta, monto, archivo, observaciones, autorizado, fecha_registro  ';
		$strQuery.= 'FROM tbl_cotizacion ';
		$strQuery.= 'WHERE fecha_eliminado IS NULL AND id_orden_compra = '.$idOrdenComp.$cond;
		$strQuery.= 'ORDER BY fecha_registro DESC, id_cotizacion DESC';

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

	//QUERY PARA ELIMINAR UNA COTIZACIÓN DE UNA ORDEN DE COMPRA
	public function eliminaCotizacion($id, $fecha){
		$strQuery = 'UPDATE tbl_cotizacion ';
		$strQuery.= 'SET fecha_eliminado = "'.$fecha.'" ';
		$strQuery.= 'WHERE id_cotizacion = '.$id;

		return $strQuery;
	}


	//SERVICIO POSVENTA
	//QUERY PARA OBTENER LOS REGISTROS DE LOS SERVICIOS POSVENTA DE UN CLIENTE
	public function getDataServPVCte($idInteres){
		$strQuery = 'SELECT id_servicio_posventa, motivo, descripcion, estatus, fecha_captura, fecha_termino ';
		$strQuery.= 'FROM tbl_servicio_posventa ';
		$strQuery.= 'WHERE fecha_eliminado IS NULL AND id_interes = '.$idInteres.' ';
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

}
?>
