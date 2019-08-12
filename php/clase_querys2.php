<?php
class QuerysB {
	//***************************************************************************************
	//*********************INICIA QUERYS PARA INICIO DE SESIÓN ******************************
    //Consultas Marco Molina
    
    //Obtiene los datos del usuario del sistema
    function existeUsuario($usuario=''){
        $sentencia = ($usuario != '')? " AND u.usuario = '" . $usuario . "'":"";
        $strQuery = "SELECT u.*,d.nombre nDepartamento,a.nombre nArea ";
        $strQuery .= "FROM demosystem_siga.tblc_usuario u ";
        $strQuery .= "INNER JOIN tblc_areas a on u.id_area = a.id_area ";
        $strQuery .= "AND a.fecha_eliminado IS NULL ";
        $strQuery .= "INNER JOIN tblc_departamentos d ON a.id_departamento = d.id_departamento ";
        $strQuery .= "AND d.fecha_eliminado IS NULL ";
        $strQuery .= "WHERE u.fecha_eliminado IS NULL".$sentencia;
        return $strQuery;
    }
    
    
    
    //Obtiene permiso de los usuarios por módulo
    function obtenerPermisoModulo($idUsuario, $modulo){
        $strQuery = "SELECT COUNT(up.id_permiso) AS PERMISO ";
        $strQuery.= "FROM tblc_usuario_permiso up ";
        $strQuery.= "JOIN tblc_permiso p ";
        $strQuery.= "ON(up.id_permiso = p.id_permiso) ";
        $strQuery.= "WHERE up.id_usuario = ".$idUsuario." AND p.archivo LIKE '".$modulo."'";

        return $strQuery;
    }
    
    //---------------------------TABLA PERMISO-----------------------------
	function permisosmenuusuario($id_usuario_sis){
		$strQuery = "SELECT DISTINCT up.id_permiso as id, p.* FROM tblc_permiso AS p";
		$strQuery .= " INNER JOIN tblc_usuario_permiso AS up ON p.id_permiso = up.id_permiso";
		$strQuery .= "  WHERE up.id_usuario =".$id_usuario_sis." AND p.id_padre = 0 AND p.estatus = 1 ORDER BY p.ordenamiento";

		return $strQuery;
	}
    
    // Obtiene los hijos del menu
    function permisosubmenuusuario($id_usuario_sis, $idpadre){
		$strQuery = "SELECT DISTINCT up.id_permiso as id, p.* FROM tblc_permiso AS p";
		$strQuery .= " INNER JOIN tblc_usuario_permiso AS up ON p.id_permiso = up.id_permiso";
		$strQuery .= " WHERE up.id_usuario =".$id_usuario_sis." AND p.id_padre = ".$idpadre." AND p.estatus = 1 ORDER BY p.ordenamiento";

		return $strQuery;
	}
    
    // Cuenta los hijos del menu
    function Conteopermisosubmenuusuariomodulo($id_usuario_sis, $idpadre){
		$strQuery = "SELECT COUNT(up.id_permiso) FROM tblc_permiso AS p";
		$strQuery .= " INNER JOIN tblc_usuario_permiso AS up ON p.id_permiso = up.id_permiso";
		$strQuery .= " WHERE up.id_usuario =".$id_usuario_sis." AND p.id_padre = ".$idpadre." AND p.estatus = 1;";

		return $strQuery;
	}
    
    //Obtiene todos los datos de las PROPIEDADES
    function getPropiedadades($id = 0){
      $sentencia = ($id != 0)? ' WHERE id_propiedad = ' . $id:'';
      $strQuery = "SELECT @rownum:=@rownum+1 numero, t.*,t.id_propiedad id,t.descripcion valor ";
      $strQuery .= ",DATE_FORMAT(t.DTU,'%d/%m/%Y') DTUF ";
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
      $strQuery .= "AND i.fecha_eliminado IS NULL LIMIT 1) imagen, ";
      $strQuery .= "IFNULL((SELECT ep.nombre FROM demosystem_siga.tbl_interes_cliente c ";
      $strQuery .= "inner join tblc_estatus_propiedades ep on c.estatus = ep.id_estatus ";
      $strQuery .= "WHERE c.fecha_eliminado IS NULL AND c.id_propiedad = p.id_propiedad),'DISPONIBLE') estatusR ";
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
    
    //Consulta para optener la lista del catalogo oferta o paquete
    public function getListadoOfertaPaquete($id = ''){
        $sentencia = ($id != '')? ' WHERE id_oferta = ' . $id:'';

        $strQuery = "SELECT @rownum:=@rownum+1 numero, t.id_oferta,";
        $strQuery .= "t.nombre, t.fecha_registro ";
        $strQuery .= "FROM vw_catOfertaPaquete t , (SELECT @rownum:=0) r " . $sentencia;
        $strQuery .= " ORDER BY numero;";

        return $strQuery;

    }
    
    //Consulta para optener la lista del catalogo oferente
    public function getListadoOferente($id = ''){
        $sentencia = ($id != '')? ' WHERE id_oferente = ' . $id:'';

        $strQuery = "SELECT @rownum:=@rownum+1 numero, t.id_oferente,";
        $strQuery .= "t.nombre, t.fecha_registro ";
        $strQuery .= "FROM vw_catOferente t , (SELECT @rownum:=0) r " . $sentencia;
        $strQuery .= " ORDER BY numero;";

        return $strQuery;

    }
    
    //Consulta para optener la lista del catalogo cuentas bancarias
    public function getListadoCuentasB($id = ''){
        $sentencia = ($id != '')? ' WHERE id_cuenta = ' . $id:'';

        $strQuery = "SELECT @rownum:=@rownum+1 numero, t.id_cuenta,";
        $strQuery .= "t.nombre,t.banco,t.titular, t.fecha_registro ";
        $strQuery .= "FROM vw_catCuentasB t , (SELECT @rownum:=0) r " . $sentencia;
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
      $catalogosC = array('tblc_desarrollo','tblc_antiguedad');
      $strQuery = "SELECT -1 AS id,'Seleccionar..' AS valor,'0;0' AS dataId ";
      $strQuery .= " UNION ALL ";
      $strQuery .= "SELECT " . $campos . " FROM " . $tabla;
      $strQuery .= (in_array($tabla,$catalogosC))?" WHERE fecha_eliminacion IS NULL":" WHERE fecha_eliminado IS NULL";
      $strQuery .= ($where != '')? ' AND ' . $where : $where;
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
    
    function getListDocumentosPropiedades($id){
      $strQuery = "SELECT d.*,DATE_FORMAT(d.vigencia,'%d/%m/%Y') fVigencia, CASE d.tipo_documento ";
      $strQuery .= "WHEN 1 THEN 'Avalúo Comercial' ";
      $strQuery .= "WHEN 2 THEN 'Avalúo Catastral' ";
      $strQuery .= "WHEN 3 THEN 'Certificado liberación de Gravamen' ";
      $strQuery .= "WHEN 4 THEN d.descripcion_otros END txtTipo, d.tipo_documento,";
      $strQuery .= "CASE d.estatus ";
      $strQuery .= "WHEN 1 THEN 'Solicitado' ";
      $strQuery .= "WHEN 2 THEN 'Entregado' ";
      $strQuery .= "WHEN 3 THEN 'No Aplica' END estatus, d.estatus id_estatus,";
      $strQuery .= "d.monto,d.vigencia,d.tipo_archivo,d.archivo ";
      $strQuery .= "FROM tbl_propiedades_documentos d WHERE d.id_propiedad = " . $id . " ";
      $strQuery .= "AND d.fecha_eliminado IS NULL ORDER BY d.id_documento DESC;";
      return $strQuery;
    }
    //Fin consultas Marco Molina
}
?>
