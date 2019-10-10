<?php
require 'inicializandoDatosExterno.php';

$datos = array(); $jsondata = array();

switch($_POST['opt']){
	//OBTIENE LOS DATOS DE UN DESARROLLO PARA SER EDITADOS
	case 1:
		$id = $funciones->limpia($_POST['id']);
		$resp = @$conexion->fetch_array($querys3->getListadoDesarrollo($id));

		$jsondata['id_desarrollo'] = $resp['id_desarrollo'];
		$jsondata['nombre'] = $resp['nombre'];
		$jsondata['alias'] = $resp['alias'];
		$jsondata['numero_etapa_oferta'] = $resp['numero_etapa_oferta'];
		$jsondata['codigo_postal'] = $resp['codigo_postal'];
		$jsondata['icono']  = $resp['icono'];
	break;
	//OBTIENE TODOS LOS DATOS DE UNA OBRA PARA SER EDITADOS
	case 2:
		$id = $funciones->limpia($_POST['id']);
		$resp = @$conexion->fetch_array($querys3->getListadoObras($id));

		$fechaini = explode("-",$resp['fecha_inicio']);
		$fechafin = explode("-",$resp['fecha_finalizacion']);

		$jsondata['id_obra'] = $resp['id_obras'];
		$jsondata['nombre'] = $resp['nombre'];
		$jsondata['tipo'] = $resp['tipo'];
		$jsondata['dependencia'] = $resp['dependencia'];
		$jsondata['monto'] = $resp['monto'];
		$jsondata['fecha_inicio'] = $resp['fecha_inicio'];//$fechaini[2]."-".$fechaini[1]."-".$fechaini[0];
		$jsondata['fecha_finalizacion'] = $resp['fecha_finalizacion'];//$fechafin[2]."-".$fechafin[1]."-".$fechafin[0];
		$jsondata['volumenes_carpeta'] = $resp['volumenes_carpeta'];
		$jsondata['tipo_agregado'] = $resp['tipo_agregado'];
		$jsondata['volumen_concreto'] = $resp['volumen_concreto'];
		$jsondata['area_obra'] = $resp['area_obra'];
	break;
	//OBTIENE LOS DATOS DE UN LISTADO DE SEGUIMIENTO PARA SER EDITADOS
	case 3:
		$id = $funciones->limpia($_POST['id']);
		$resp = @$conexion->fetch_array($querys3->getListadoSeguimiento($id));

		$jsondata['id_seg_est'] = $resp['id_seg_est'];
		$jsondata['nombre_obra'] = $resp['nombre_obra'];
		$jsondata['monto'] = $resp['monto'];
		$jsondata['avance_fisico'] = $resp['avance_fisico'];
		$jsondata['numero_estimacion'] = $resp['numero_estimacion'];
		$jsondata['fecha_inicio'] = $resp['fecha_inicio'];
		$jsondata['fecha_finalizacion'] = $resp['fecha_finalizacion'];
		$jsondata['status'] = $resp['status'];
		$jsondata['imagen'] = $resp['imagen'];
	break;
	//obtiene datos de una antiguedad
	case 4:
		$id = $funciones->limpia($_POST['id']);
		$resp = @$conexion->fetch_array($querys3->getListadoAntiguedad($id));

		$jsondata['nombre'] = $resp['nombre'];
		$jsondata['icono'] = $resp['icono'];
	break;

	//obtiene datos de un empleado
	case 5:
		$id = $funciones->limpia($_POST['id']);
		$resp = @$conexion->fetch_array($querys3->getEmpleadosById($id));

		$fechaadmi = explode("-",$resp['fecha_admision']);

		$jsondata['id_empleado'] = $resp['id_empleado'];
		$jsondata['nombre'] = $resp['nombre'];
		$jsondata['apellido_paterno'] = $resp['apellido_paterno'];
		$jsondata['apellido_materno'] = $resp['apellido_materno'];
		$jsondata['direccion'] = $resp['direccion'];
		$jsondata['rfc'] = $resp['rfc'];
		$jsondata['imss'] = $resp['imss'];
		$jsondata['curp'] = $resp['curp'];
		$jsondata['fecha_admision'] = $fechaadmi[2]."-".$fechaadmi[1]."-".$fechaadmi[0];
		$jsondata['tipo'] = $resp['tipo'];
		$jsondata['estado_civil'] = $resp['estado_civil'];
		$jsondata['genero'] = $resp['genero'];
		$jsondata['categoria'] = $resp['categoria'];
		$jsondata['departamento'] = $resp['departamento'];
		$jsondata['area'] = $resp['area'];
	break;

	//obtiene datos de una antiguedad
	case 6:
		$id = $funciones->limpia($_POST['id']);
		$resp = @$conexion->fetch_array($querys3->getListadoAntiguedad($id));

		$jsondata['id_antiguedad'] = $resp['id_antiguedad'];
		$jsondata['nombre'] = $resp['nombre'];
		$jsondata['icono'] = $resp['icono'];
	break;

	//obtiene datos de un contrato
	case 7:
		$id = $funciones->limpia($_POST['id']);
		$resp = @$conexion->fetch_array($querys3->getContracts($id));

		$dateContract = explode("-",$resp['fecha_realizacion']);
		$validity = explode("-",$resp['vigencia']);

		$jsondata['id_contrato'] = $_POST['id'];
		$jsondata['folio'] = $resp['folio'];
		$jsondata['id_cliente'] = $resp['id_cliente'];
		$jsondata['id_propiedad'] = $resp['id_propiedad'];
		$jsondata['fecha_realizacion'] = $dateContract[2].'-'.$dateContract[1].'-'.$dateContract[0];
		$jsondata['vigencia'] = $validity[2].'-'.$validity[1].'-'.$validity[0];
		$jsondata['tipo_contrato'] = $resp['tipo_contrato'];
		$jsondata['monto'] = $resp['monto'];
		$jsondata['id_arrendatario'] = $resp['id_arrendatario'];
		$jsondata['id_propietario'] = $resp['id_propietario'];
		$jsondata['enganche_deposito'] = $resp['enganche_deposito'];
		$jsondata['archivo'] = $resp['archivo'];
		$jsondata['periodo'] = $resp['periodo'];
		$jsondata['observaciones'] = $resp['observaciones'];
	break;
	//OBTIENE LOS DATOS DE UN AVANCE FÍSICO/REPORTE DE AVANCES PARA SER EDITADOS
	//RETORNA ID, NOMBRE DEL RESIDENTE, PERÍODO, OBRA Y FOLIO
	case 8:
		$id = $funciones->limpia($_POST['id']);
		$resp = @$conexion->fetch_array($querys3->getPhysProg($id, ''));
		$jsondata['id'] = $resp['id'];
		$jsondata['resident'] = $resp['residente'];
		$jsondata['dateStart'] = $resp['fecha_inicio'];
		$jsondata['dateFinish'] = $resp['fecha_termino'];
		$jsondata['work'] = $resp['id_obra'];
		$jsondata['folio'] = $resp['folio'];

		$physprog = @$conexion->obtenerlista($querys3->getUsedConcept($resp['id']));
		foreach ($physprog as $key) {
			$respC = @$conexion->fetch_array($querys3->getConceptFromBudget($key->id_concepto));
			$datos[] = array('id' => $respC['id'], 'cantidad' => $key->cantidad, 'rId' => $key->id);
		}

		$jsondata['concepts'] = $datos;

	break;
	//OBTIENE LOS DATOS DEL NIVEL PARA SER EDITADOS, RETORNA EL NOMBRE Y EL ID
	case 9:
		$id = $funciones->limpia($_POST['id']);
		$resp = @$conexion->fetch_array($querys3->getLevels($id));
		$jsondata['id'] = $resp['id_nivel'];
		$jsondata['name'] = $resp['nombre'];
	break;
	//OBTIENE LOS DATOS DE LA EMPRESA PARA SER EDITADOS, RETORNA EL NOMBRE Y EL ID
	case 10:
		$id = $funciones->limpia($_POST['id']);
		$resp = @$conexion->fetch_array($querys3->getCompanies($id));
		$jsondata['id'] = $resp['id_empresa'];
		$jsondata['name'] = $resp['nombre'];
	break;
	//OBTIENE LOS DATOS DE UNA LICITACIÓN PARA SER EDITADOS, RETORNA NOMBRE Y EL ID
	case 11:
		$id = $funciones->limpia($_POST['id']);
		$resp = @$conexion->fetch_array($querys3->getBiddings($id));
		$jsondata['id'] = $resp['id_licitacion'];
		$jsondata['bidNumber'] = $resp['numero_licitacion'];
		$jsondata['work'] = $resp['nombre_obra'];
		$jsondata['propDelivery'] = $resp['entrega_propuesta'];
		$jsondata['place'] = $resp['lugar'];
		$jsondata['failDate'] = $resp['fecha_fallo'];
		$jsondata['file'] = $resp['archivo'];
	break;

	case 12:
		$id = $funciones->limpia($_POST['id']);
		$resp = @$conexion->fetch_array($querys3->getTypesOfExpenses($id));
		$jsondata['id'] = $resp['id_tipo_gasto'];
		$jsondata['name'] = $resp['nombre'];
	break;

	//FUNCION PARA OBTENER LOS DATOS DE UNA CATEGORÍA DE EMPLEADOS
	case 13:
		$id = $funciones->limpia($_POST['id']);
		$resp = @$conexion->fetch_array($querys3->listEmployeeCategories($id));
		$jsondata['id'] = $resp['id_categoria'];
		$jsondata['name'] = $resp['nombre'];
		$jsondata['workDays'] = $resp['dias'];
		$jsondata['payment'] = $resp['sueldo'];
	break;
	//FUNCIÓN PARA OBTENER LOS DATOS DE UN STATUS DE GERENCIA
	case 14:
		$id = $funciones->limpia($_POST['id']);
		$resp = @$conexion->fetch_array($querys3->listInsFuelExpStatus($id));
		$jsondata['id'] = $resp['id_status'];
		$jsondata['name'] = $resp['nombre'];
	break;
	//FUNCIÓN PARA OBTENER LA CATEGPRÍA DE UN EMPLEADO POR ID, RETORNA EL NOMBRE DE LA CATEGORÍA, LOS DÍAS
	//DE TRABAJO Y EL SUELDO POR DÍA
	case 20:
	$category = $funciones->limpia($_POST['category']);
	$strQuery = 'SELECT nombre, dias, sueldo FROM tblc_categorias WHERE id_categoria = '.$category.' AND fecha_eliminacion IS NULL';
	$resp = @$conexion->fetch_array($strQuery);

	$jsondata['name'] = $resp['nombre'];
	$jsondata['days'] = $resp['dias'];
	$jsondata['pay'] = $resp['sueldo'];
	break;

	//FUNCIÓN PARA LLENAR EL COMBOBOX (SELECT) DE LOS CONCEPTOS PERTENECIENTES A UNA OBRA EN ESPECÍFICO
	case 21:
		$work = $funciones->limpia($_POST['work']);
		$strQuery = 'SELECT concepto, id_presupuesto_obra as id, codigo, cantidad FROM tbl_presupuesto_obra WHERE fecha_eliminado IS NULL AND id_obra = '.$work;

		$resp = @$conexion->obtenerlista($strQuery);
		$totRegs = $conexion->numregistros();

		foreach ($resp as $key) {
			$datos[] = array('id' => $key->id, 'concepto' => $key->concepto, 'codigo' => $key->codigo, 'cantidad' => $key->cantidad);
		}

		$jsondata['conceptos'] = $datos;
		$jsondata['total']     = $totRegs;
	break;

	//FUNCIÓN PARA OBTENER LA CANTIDAD USADA DE CIERTO CONCEPTO, POR SU ID
	case 22:
		$physprog = $funciones->limpia($_POST['id']);
		$resp = @$conexion->fetch_array($querys3->getAddedConcept('',$physprog));
		if($resp['quantity_used'] != null){
				$jsondata['used'] = $resp['quantity_used'];
		} else {
			$jsondata['used'] = 0;
		}
	break;
	//OBTIENE LOS CONCEPTOS QUE PERTENECEN A UN ID DE AVANCE FÍSICO/REPORTE DE AVANCES
	case 23:
		$physprog = $funciones->limpia($_POST['id']);
		$resp = @$conexion->obtenerlista($querys3->getUsedConcept($physprog));
		$totRegs = $conexion->numregistros();

		foreach ($resp as $key) {
			$respC = @$conexion->fetch_array($querys3->getConceptFromBudget($key->id_concepto));
			$datos[] = array('id' => $respC['id'], 'concepto' => $respC['concepto'], 'codigo' => $respC['codigo'], 'cantidad' => $key->cantidad);
		}

		$resp = @$conexion->fetch_array($querys3->getPhysProg($physprog));
		$work = @$conexion->fetch_array($querys3->getListadoObras($resp['id_obra']));

		$jsondata['resident'] = $resp['residente'];
		$jsondata['folio'] = $resp['folio'];
		$jsondata['work'] = $work['nombre'];
		$jsondata['concepts'] = $datos;
	break;

	//FUNCION PARA OBTENER LAS PROPIEDADES QUE LE INTERESAN AL CLIENTE
	case 24:
		$idClient = $funciones->limpia($_POST['idClient']);
		$resp = @$conexion->obtenerlista('SELECT * FROM tbl_interes_cliente WHERE fecha_eliminado IS NULL AND id_cliente = '.$idClient);
		foreach ($resp as $key) {
			$respC = @$conexion->fetch_array($querys3->getPropiedades($key->id_propiedad));
			//print_r($respC);
			$datos[] = array('id_property' => $key->id_propiedad, 'name'=>$respC['valor'], 'amount' => $key->monto, 'development'=>$respC['id_desarrollo'],
							'owner' => $respC['propietario'],'type' => $respC['id_tipo']);
		}
		$jsondata['properties'] = $datos;
	break;

}

header('Content-type: application/json; charset=utf-8');
echo json_encode($jsondata);
?>
