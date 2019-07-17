<?php
//**************************************************************************
	$datos = array();
	session_start();


	$datos['id'] = $_GET['id'];
	//$datos = $conexion->fetch_array($querys->getPropiedadades($id));
	$datos['tipo'] = $_GET['tipo'];
	$datos['coordenadas'] = trim($_GET['coordenadas']);
	$color = "#2bbbea";
	if(isset($_GET['nombre'])) $datos["nombre"] = $_GET['nombre'];
	else $datos["nombre"]="";
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
		switch ($datos['tipo']) {
			case '1':
				$aCoordsPoint = explode(',', $datos['coordenadas']);
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
					'coordinates' => create_polyline($datos['coordenadas'])
					)
				);
			break;

			case '3':
				$feature [] = array(
					'type' => 'Feature',
					'geometry' => array(
						'type' => 'Polygon',
						'title' => $datos['nombre'],
						'coordinates' => create_polygon($datos['coordenadas'])
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
	//$conexion->cerrarconexion();
	// convertimos el array de datos a formato json
	$output = json_encode($geojson, JSON_NUMERIC_CHECK);
	header('Content-type: application/json');
	echo $output;

	exit();
