<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
header('Content-type: application/json; charset=utf-8');
require 'inicializandoDatosExterno.php';

$datos = array(); $jsondata = array();

switch($_POST['opt']){
	case 1:
		$id = $funciones->limpia($_POST['id']);
		$resp = @$conexion->fetch_array($querys->getListadoDesarrollo($id));

		$jsondata['id_desarrollo'] = $resp['id_desarrollo'];
		$jsondata['nombre'] = $resp['nombre'];
		$jsondata['alias'] = $resp['alias'];
		$jsondata['codigo_postal'] = $resp['codigo_postal'];
		$jsondata['icono']  = $resp['icono'];
	break;
	case 201: //OPCIÓN PARA CARGAR EL LISTADO DE ESTADOS
		$id   = $funciones->limpia($_POST['id']);
		$resp = @$conexion->fetch_array($querys->getListadoEstacionamiento($id));

		$jsondata['id_estacionamiento'] = $resp['id_estacionamiento'];
		$jsondata['nombre'] = $resp['nombre'];
		$jsondata['icono']  = $resp['icono'];

	break;

	case 202: //OPCIÓN PARA OBTENER LOS DATOS PARA EDICIÓN: NÚMERO DE BAÑOS
		$id   = $funciones->limpia($_POST['id']);
		$resp = @$conexion->fetch_array($querys->getListadoWc($id));

		$jsondata['id_num_banio'] = $resp['id_num_banio'];
		$jsondata['nombre'] = $resp['nombre'];
		$jsondata['icono']  = $resp['icono'];		
		
	break;

	case 203: //OPCIÓN PARA OBTENER INFORMACIÓN Y SER EDITADA / SERIVICIO/AMENIDADES
		$id   = $funciones->limpia($_POST['id']);
		$resp = @$conexion->fetch_array($querys->getServAmenidades_listado($id));

		$jsondata['id_servicio_amenidad'] = $resp['id_servicio_amenidad'];
		$jsondata['nombre'] = $resp['nombre'];
		$jsondata['icono']  = $resp['icono'];		
		
	break;

	case 204: //OPCIÓN PARA OBTENER LOS DATOS DE UN REGISTRO DEL CATÁLOGO CLOSET
		$id   = $funciones->limpia($_POST['id']);
		$resp = @$conexion->fetch_array($querys->getClosetListado($id));

		$jsondata['id_closet'] = $resp['id_closet'];
		$jsondata['nombre'] = $resp['nombre'];
		$jsondata['icono']  = $resp['icono'];
	break;

	case 205: //OPCIÓN PARA OBTENER LOS DATOS DE UN CLIENTE PARA SER EDITADOS
		$id   = $funciones->limpia($_POST['id']);		
		$resp = @$conexion->fetch_array($querys->getClientesData($id));

		$jsondata['id_cliente'] = $resp['id_cliente'];
		$jsondata['rfc']        = $resp['rfc'];
		$jsondata['nombre']     = $resp['nombre'];
		$jsondata['apellido_p'] = $resp['apellido_p'];
		$jsondata['apellido_m'] = $resp['apellido_m'];
		$jsondata['correo']     = $resp['correo'];
		$jsondata['telefono']   = $resp['telefono'];
		$jsondata['celular']    = $resp['celular'];
		$jsondata['estado_civil'] = $resp['estado_civil'];
		$jsondata['domicilio']    = $resp['domicilio'];
		$jsondata['id_tipo']    = $resp['id_tipo'];
		$jsondata['observaciones'] = $resp['observaciones'];
	break;

	case 206: //OPCIÓN PARA OBTENER LOS DATOS DE UN ARCHIVO PERSONAL DE UN CLIENTE PARA SER EDITADOS
		$idCliente   = $funciones->limpia($_POST['idCliente']);
		$idArchivo   = $funciones->limpia($_POST['idArchivo']);
		$resp = @$conexion->fetch_array($querys->getArchivosClientesListado($idCliente, $idArchivo));

		$jsondata['id_archivo']   = $resp['id_archivo'];
		$jsondata['ruta_archivo'] = $resp['ruta_archivo'];
		$jsondata['descripcion'] = $resp['descripcion'];
	break;

	case 207: //OPCIÓN PARA OBTENER LOS DATOS DE UNA REFERENCIA DE UN CLIENTE PARA SER EDITADOS
		$idCliente    = $funciones->limpia($_POST['idCliente']);
		$idReferencia = $funciones->limpia($_POST['idReferencia']);
		$resp = @$conexion->fetch_array($querys->getListadoReferenciasCte($idCliente, $idReferencia));

		$jsondata['id_referencia'] = $resp['id_referencia'];
		$jsondata['nombre']        = $resp['nombre'];
		$jsondata['apellido_p']    = $resp['apellido_p'];
		$jsondata['apellido_m']    = $resp['apellido_m'];
		$jsondata['id_tipo']       = $resp['id_tipo'];
		$jsondata['direccion']     = $resp['direccion'];
		$jsondata['telefono']      = $resp['telefono'];
	break;


	case 208: //OPCIÓN PARA CARGAR EL COMBO DE PROPIEDADES DEL FORMULARIO DE PROPIEDADES DE INTERES DE UN CLIENTE		
		$resp = @$conexion->obtenerlista($querys->loadCboPropiedades());
		$totRegs = $conexion->numregistros();

		foreach ($resp as $key) {
			$datos[] = array('id' => $key->id_propiedad, 'valor' => $key->descripcion);
		}

		$jsondata['propiedades'] = $datos;
		$jsondata['total']       = $totRegs;
	break;

	case 209://OPCIÓN PARA CARGAR EL COMBO DE ESTATUS DEL FORMULARIO DE PROPIEDADES DE INTERES DE UN CLIENTE
		$resp = @$conexion->obtenerlista($querys->loadCboeEstatusInteres());
		$totRegs = $conexion->numregistros();

		foreach ($resp as $key) {
			$datos[] = array('id' => $key->id_estatus, 'valor' => $key->nombre);
		}

		$jsondata['estatusInteres'] = $datos;
		$jsondata['total']          = $totRegs;
	break;

	case 210: //OPCIÓN PARA OBTENER LOS DATOS DE UNA REFERENCIA DE UN CLIENTE PARA SER EDITADOS
		$idCliente = $funciones->limpia($_POST['idCliente']);
		$idInteres = $funciones->limpia($_POST['idInteres']);
		$resp = @$conexion->fetch_array($querys->getInteresListadoCte($idCliente, $idInteres));

		$jsondata['id_interes']   = $resp['id_interes'];
		$jsondata['id_propiedad'] = $resp['id_propiedad'];
		$jsondata['agente']       = $resp['agente'];
		$jsondata['estatus']      = $resp['estatus'];
		$jsondata['monto']        = $resp['monto'];
	break;

	case 211: //OPCIÓN PARA OBTENER LOS DATOS DE UNA REFERENCIA DE UN CLIENTE PARA SER EDITADOS
		$idOrdenComp = $funciones->limpia($_POST['idOrden']);		
		$resp = @$conexion->fetch_array($querys->ordenes_compra_listado('', 0, 0, -1, 0, '', '', $idOrdenComp));

		$jsondata['id_orden_compra'] = $resp['id_orden_compra'];
		$jsondata['folio']           = $resp['folio'];
		$jsondata['id_obra']         = $resp['id_obra'];
		$jsondata['id_empresa']      = $resp['id_empresa'];
		$jsondata['dirección_obra']  = $resp['dirección_obra'];
		$jsondata['fecha_captura']   = $resp['fecha_captura'];
		$jsondata['id_tipo_compra']  = $resp['id_tipo_compra'];
		$jsondata['residente']       = $resp['residente'];
		$jsondata['estatus']         = $resp['estatus'];
		$jsondata['archivo_transferencia'] = $resp['archivo_transferencia'];
	break;

	case 212: //OPCIÓN PARA OBTENER LOS DATOS DE UN ARTÍCULO DE UNA ORDEN DE COMPRA
		$idOrdenComp = $funciones->limpia($_POST['idOrdenComp']);
		$idArticulo  = $funciones->limpia($_POST['idArticulo']);
		$resp = @$conexion->fetch_array($querys->articulosListado($idOrdenComp, $idArticulo));

		$jsondata['id_articulo_compra'] = $resp['id_articulo_compra'];
		$jsondata['articulo']           = $resp['articulo'];
		$jsondata['cantidad']           = $resp['cantidad'];
		$jsondata['unidad']             = $resp['unidad'];
		$jsondata['monto']              = $resp['monto'];
	break;

	case 213: //OPCIÓN PARA OBTENER LOS DATOS DE UNA COTIZACIÓN DE UNA ORDEN DE COMPRA PARA SER EDITADOS
		$idOrdenComp  = $funciones->limpia($_POST['idOrdenComp']);
		$idCotizacion = $funciones->limpia($_POST['idCotizacion']);		
		$resp = @$conexion->fetch_array($querys->getCotizaciones($idOrdenComp, $idCotizacion));

		$jsondata['id_cotizacion'] = $resp['id_cotizacion'];
		$jsondata['id_proveedor']  = $resp['id_proveedor'];
		$jsondata['num_cuenta']    = $resp['num_cuenta'];
		$jsondata['monto']         = $resp['monto'];
		$jsondata['archivo']       = $resp['archivo'];
		$jsondata['observaciones'] = $resp['observaciones'];
	break;
}

echo json_encode($jsondata);
?>