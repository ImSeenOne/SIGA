<?php
class Querys {
	//***************************************************************************************
	//*********************INICIA QUERYS PARA INICIO DE SESIÓN ******************************
    //Consultas Marco Molina


    //Obtiene todos los datos de las PROPIEDADES
    function getPropiedadades($id = 0){
      $sentencia = ($id != 0)? ' WHERE id_propiedad = ' . $id:'';
      $strQuery = "SELECT @rownum:=@rownum+1 numero, t.* ";
      $strQuery .= "FROM tblc_propiedades t , (SELECT @rownum:=0) r " . $sentencia;
      $strQuery .= " ORDER BY t.id_propiedad DESC;";

      return $strQuery;
    }

    //Obtiene la lista de propiedades
    function ListPropiedades($folio,$alias,$direccion,$cliente){
      $strQueryS = "SELECT id_propiedad FROM tbl_interes_cliente i ";
      $strQueryS .= "INNER JOIN tblc_clientes c ON i.id_cliente = c.id_cliente ";
      $strQueryS .= "WHERE i.fecha_eliminado IS NULL AND c.fecha_eliminado IS NULL ";
      $strQueryS .= "AND CONCAT_WS(' ',c.nombre,c.apellido_p,c.apellido_m) like '%" . $cliente . "%'";

      $sentencia = ($folio != '')? " AND folio like '%". $folio ."%'" : '';
      $sentencia .= ($alias != '')? " AND alias like '%". $alias ."%'" : '';
      $sentencia .= ($direccion != '')? " AND direccion like '%". $direccion ."%'" : '';
      $sentencia .= ($cliente != '')? " AND p.id_propiedad IN (" . $strQueryS . ")" : '';

      $strQuery = "SELECT p.*,(SELECT imagen FROM tbl_propiedad_imagen i ";
      $strQuery .= "WHERE i.id_propiedad = p.id_propiedad AND i.tipo = 1 ";
      $strQuery .= "AND i.fecha_eliminado IS NULL LIMIT 1) imagen ";
      $strQuery .= "FROM tblc_propiedades p ";
      $strQuery .= "WHERE p.fecha_eliminado IS NULL".$sentencia;
      return $strQuery;
    }

    //Consulta para optener la lista del catalogo Calidad y Acabado
    public function getListadoCalidadAcabado($id = ''){
        $sentencia = ($id != '')? ' WHERE id_calidad_acabado = ' . $id:'';

        $strQuery = "SELECT @rownum:=@rownum+1 numero, t.id_calidad_acabado,";
        $strQuery .= "t.nombre, t.icono, t.fecha_registro ";
        $strQuery .= "FROM vw_catCalidadAcabado t , (SELECT @rownum:=0) r " . $sentencia;
        $strQuery .= " ORDER BY numero;";

        return $strQuery;

    }

    public function getListadoCocina($id = ''){
      $sentencia = ($id != '')? ' WHERE id_cocina = ' . $id:'';

      $strQuery = "SELECT @rownum:=@rownum+1 numero, t.id_cocina,";
      $strQuery .= "t.nombre, t.icono, t.fecha_registro ";
      $strQuery .= "FROM vw_catCocina t , (SELECT @rownum:=0) r " . $sentencia;
      $strQuery .= " ORDER BY numero;";

      return $strQuery;
    }

    public function getListadoEstacionamiento($id = ''){
      $sentencia = ($id != '')? ' WHERE id_estacionamiento = ' . $id:'';

      $strQuery = "SELECT @rownum:=@rownum+1 numero, t.id_estacionamiento,";
      $strQuery .= "t.nombre, t.icono, t.fecha_registro ";
      $strQuery .= "FROM vw_catEstacionamiento t , (SELECT @rownum:=0) r " . $sentencia;
      $strQuery .= " ORDER BY numero;";

      return $strQuery;
    }

    public function getListadoEstatus($id = ''){
      $sentencia = ($id != '')? ' WHERE id_estatus = ' . $id:'';

      $strQuery = "SELECT @rownum:=@rownum+1 numero, t.id_estatus,";
      $strQuery .= "t.nombre, t.icono, t.fecha_registro ";
      $strQuery .= "FROM vw_catEstatusPropiedades t , (SELECT @rownum:=0) r " . $sentencia;
      $strQuery .= " ORDER BY numero;";

      return $strQuery;
    }

    public function getListadoPropietario($id = ''){
      $sentencia = ($id != '')? ' WHERE id_propietario = ' . $id:'';

      $strQuery = "SELECT @rownum:=@rownum+1 numero, t.id_propietario,";
      $strQuery .= "t.nombre, t.fecha_registro ";
      $strQuery .= "FROM vw_catPropietarios t , (SELECT @rownum:=0) r " . $sentencia;
      $strQuery .= " ORDER BY numero;";

      return $strQuery;
    }

    public function getListCombo($tabla,$campos,$where=''){
      $strQuery = "SELECT 0 AS id,'Seleccionar..' AS valor,'0;0' AS dataId ";
      $strQuery .= " UNION ALL ";
      $strQuery .= "SELECT " . $campos . " FROM " . $tabla;
      $strQuery .= ($where != '')? ' WHERE ' . $where : $where;
      return $strQuery;
    }

    function getListImagenPropiedades($id){
      $strQuery = "SELECT i.*, CASE i.tipo ";
      $strQuery .= "WHEN 0 THEN 'Normal' ";
      $strQuery .= "WHEN 1 THEN 'Principal' END txtTipo,";
      $strQuery .= "(SELECT COUNT(id_imagen) FROM tbl_propiedad_imagen i2 where i2.id_propiedad = i.id_propiedad AND ";
      $strQuery .= "i2.tipo = 1) principal FROM tbl_propiedad_imagen i WHERE i.id_propiedad = " . $id . " ";
      $strQuery .= "AND i.fecha_eliminado IS NULL ORDER BY i.tipo DESC, i.fecha_registro DESC;";
      return $strQuery;
    }
    //Fin consultas Marco Molina
}
?>
