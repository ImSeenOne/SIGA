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
}
?>
