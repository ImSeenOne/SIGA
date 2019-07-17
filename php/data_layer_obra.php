<?php
//**************************************************************************
	$datos = array();
	session_start();
//**************************************************************************
	require 'clase_variables.php';
	require 'clase_mysql.php';
	require 'clase_funciones.php';
	require ('clase_querys2.php');
//**************************************************************************
	$funciones = new Funciones();
	$conexion  = new DB_mysql(1);
	$querys    = new Querys();
//**************************************************************************
	//exit($querys->getElementsCat($idsCategoria, $edo, $mun));

	$id = $funciones->limpia($_GET['id']);
	$datos = $conexion->fetch_array($querys->getPropiedadaes($id));
	$tipo = $datos['tipo_coordenada'];
	$coordenadas = trim($datos['coordenadas']);
	$color = "#2bbbea";

	function random_color_part() {
	    return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
	}

	function random_color() {
	    return random_color_part() . random_color_part() . random_color_part();
	}


	$geojson = array();
	$feature = array();
	$geojson['type'] = 'FeatureCollection';

	if($datos['coordenadas'] != ""){
		$i=0;
		//$color = "#".random_color();
		$color = "#54a86f";

		$InfoPopUp ='<h2>'.$datos['nombre'].'</h2>';
		switch ($tipo) {
			case '1':
				$aCoordsPoint = explode(',', $coordenadas);
				$icono = '';
				$feature [] = array(
					      'type'  => 'Feature',
					'properties'  =>  array(
						 'title'  => $datos['nombre'],
						  'icon'  => $icono,
						  'info'  => $InfoPopUp
					),
					   'geometry' => array(
						   'type' => 'Point',
						   'icon' => $icono,
				    'coordinates' => (array) json_decode('['.$aCoordsPoint[1].','.$aCoordsPoint[0].']')
					)
				);
			break;

			case '2':
				$feature []= array(
				      'type' => 'Feature',
					'properties' =>  array(
						'title'  =>  $color,
					   'stroke'  => $color,
				  'stroke-width' => 5,
				'stroke-opacity' => 1,
				   'Description' => $datos['nombre'],
				     'clickable' => true,
						  'info' => $InfoPopUp
					),
					  'geometry' => array(
						  'type' => 'MultiLineString',
				   'coordinates' => create_polyline($coordenadas)
					)
				);
			break;

			case '3':
				$feature [] = array(
				      'type' => 'Feature',
				  'geometry' => array(
					  'type' => 'Polygon',
				     'title' => $datos['nombre'],
				   'coordinates' => create_polygon($coordenadas)
					),
					'properties' =>  array(
						'stroke' => $color,
				  'stroke-width' => 1,
						  'fill' => $color,
				  'fill-opacity' => 0.6,
				     'clickable' => true,
						  'info' => $InfoPopUp
					)
				);
			break;
		}

		$geojson['features'] = $feature;
		$i++;
	}

function create_polygon($data_polygon){
			$PoligonoArray= explode(' ',$data_polygon);
			if(count($PoligonoArray)>0){
				$Coordenadas = array();
				foreach($PoligonoArray as $value){
					$aCoordsPoint = explode(',', $value);
					$Coordenadas[]= (array) json_decode('['.$aCoordsPoint[1].','.$aCoordsPoint[0].']');
					/*$Coordenadas[]= (array) json_decode('['.$value.']');*/

				}

			}
			return array($Coordenadas);
}

function create_polyline($data_polyline){
			$PolilineaArray= explode(' ',$data_polyline);
			if(count($PolilineaArray)>0){
				$Coordenadas = array();
				foreach($PolilineaArray as $value){
					$aCoordsPoint = explode(',', $value);
					$Coordenadas[]= (array) json_decode('['.$aCoordsPoint[1].','.$aCoordsPoint[0].']');
				}
			}
			return array($Coordenadas);
}
	$conexion->cerrarconexion();
	// convertimos el array de datos a formato json
	$output = json_encode($geojson, JSON_NUMERIC_CHECK);
	header('Content-type: application/json');
	echo $output;

	exit();
