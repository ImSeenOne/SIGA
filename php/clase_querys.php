<?php
class Querys {
	//***************************************************************************************
	//*********************INICIA QUERYS PARA INICIO DE SESIÓN ******************************


	//QUERY PARA AGREGAR UN REGISTRO AL CATÁLOGO DE ESTACIONAMIENTO
	public function addCatEstacionamiento($nombre, $icono, $fechaRegistro){
		$strQuery = 'INSERT INTO tblc_estacionamiento ';
		$strQuery.= '(nombre, icono, fecha_registro) ';
		$strQuery.= 'VALUES("'.$nombre.'", "'.$icono.'", "'.$fechaRegistro.'")';

		return $strQuery;
	}

	//QUERY PARA EDITAR UN REGISTRO DEL CATÁLOGO ESTACIONAMIENTO
	public function updateCatEstacionamiento($idEstacionamiento, $nombre, $icono){
		$strQuery = 'UPDATE tblc_estacionamiento ';
		$strQuery.= 'SET nombre = "'.$nombre.'", icono = "'.$icono.'" ';
		$strQuery.= 'WHERE id_estacionamiento = '.$idEstacionamiento;

		return $strQuery;
	}

	//QUERY PARA OBTENER EL LISTADO DEL CATÁLOGO DE ESTACIONAMIENTO
	public function getListadoEstacionamiento($id = ''){
		$cond = ($id != '')? ' AND id_estacionamiento = '.$id.' ':' ';

		$strQuery = 'SELECT id_estacionamiento, nombre, icono, fecha_registro ';
		$strQuery.= 'FROM tblc_estacionamiento ';
		$strQuery.= 'WHERE fecha_eliminado IS NULL'.$cond;
		$strQuery.= 'ORDER BY fecha_registro DESC, id_estacionamiento DESC';

		return $strQuery;
	}

	//QUERY PARA MARCAR CÓMO ELIMINADO UN REGISTRO DEL CATÁLOGO DE ESTACIONAMIENTO
	public function eliminaRegCatEstacionamiento($id, $fecha){
		$strQuery = 'UPDATE tblc_estacionamiento ';
		$strQuery.= 'SET fecha_eliminado = "'.$fecha.'" ';
		$strQuery.= 'WHERE id_estacionamiento = '.$id;

		return $strQuery;
	}
}
?>