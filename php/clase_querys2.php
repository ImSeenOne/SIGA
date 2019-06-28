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

	//QUERY PARA MARCAR CÓMO ELIMINADO UN REGISTRO DEL CATÁLOGO DE ESTACIONAMIENTO
	public function eliminaRegCatDesarrollo($id, $fecha){
		$strQuery = 'UPDATE tblc_desarrollo ';
		$strQuery.= 'SET fecha_eliminacion = "'.$fecha.'" ';
		$strQuery.= 'WHERE id_desarrollo = '.$id;

		return $strQuery;
	}

    //Consultas Marco Molina
    //Consulta para optener la lista del catalogo Calidad y Acabado
    public function getListadoCalidadAcabado($id = ''){
        $sentencia = ($id != '')? ' WHERE id_calidad_acabado = ' . $id:'';

        $strQuery = "SELECT @rownum:=@rownum+1 numero, t.id_calidad_acabado,";
        $strQuery .= "t.nombre, t.icono, t.fecha_registro ";
        $strQuery .= "FROM vw_catCalidadAcabado t , (SELECT @rownum:=0) r " . $sentencia;
        $strQuery .= " ORDER BY numero;";

        return $strQuery;

    }
    //Fin consultas Marco Molina
}
?>
