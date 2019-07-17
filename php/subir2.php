<?Php
	@session_start();

	require_once("clase_variables.php");
	require_once("clase_mysql.php");
	include_once("clase_querys2.php");
	include_once("clase_funciones2.php");
	include_once("clase_upload.php");


	//$push = new PushNotifications();
	$funciones = new FuncionesB();
	//LLAMAMOS A LA CLASE CONEXION
	$conexion = new DB_mysql(1);
	//llamamos a la clase upload para cargar archivos
	$querys    = new QuerysB();
	$upload    = new upload();


	$datos = array(); $jsondata = array();
	$datos['fecha_actual'] = date("Y-m-d H:i:s");

	switch($_POST['opcion']){

		//OPCIÓN para Agregar,Modificar, Eliminar un REGISTRO del CATÁLOGO CALIDAD Y ACABADO.
		case 1:
			$nombre = $funciones->limpia($_POST['txtNombre']);
			$idFecha = $funciones->limpia($_POST['txtFecha']);
			$id = $funciones->limpia($_POST['txtId']);
			if($idFecha == 0){
				if(isset($_FILES["flIcono"]["tmp_name"]) and $_FILES["flIcono"]["tmp_name"] != ""){
					if($upload->load("flIcono") === false){
						echo '<script languaje="javascript">
										parent.msg_alerta_default("ERROR! Formato de archivo no permitido...","Notificación!!","'.$upload->msj_error.'");
									</script>';
						exit(0);
					}
					$archivo = "archivos/acabados/".$upload->nombre_final;
					$upload->setisimage(false);
					if($upload->save('../'.$archivo) === false){
						echo '<script languaje="javascript">
										parent.msg_alerta_default("ERROR! Fallo al guardar el archivo: '.$archivo.'...","Notificación!!","'.$upload->msj_error.'");
									</script>';
						exit(0);
					}
					$datos['flIcono'] = $archivo;
				}
				else{
					$datos['flIcono'] = $_POST["txtIcono"];
				}
			}
			else{
				$datos['flIcono'] = $_POST["txtIcono"];
				$borrar = '../' . $_POST["txtIcono"];
				if(file_exists($borrar)) unlink($borrar);
			}
			$strQuery = "CALL sp_cCalidadAcabado('".$nombre."','".$datos['flIcono']."','".$datos['fecha_actual']."',";
			if($idFecha == 0) $strQuery .= "NULL," . $id . ")";
			else $strQuery .= "'" . $datos['fecha_actual'] . "'," . $id . ")";

			if($conexion->consulta($strQuery) == 0){
				$jsondata['resp'] = 0;
				$jsondata['msg'] = 0;
			}
			else{
				$jsondata['resp'] = 1;
			}

			header('Content-type: application/json; charset=utf-8');
			echo json_encode($jsondata);
		break;
		//OPCIÓN para Agregar,Modificar, Eliminar un REGISTRO del CATÁLOGO COCINA
		case 2:
			$nombre = $funciones->limpia($_POST['txtNombre']);
			$idFecha = $funciones->limpia($_POST['txtFecha']);
			$id = $funciones->limpia($_POST['txtId']);
			if($idFecha == 0){
				if(isset($_FILES["flIcono"]["tmp_name"]) and $_FILES["flIcono"]["tmp_name"] != ""){
					if($upload->load("flIcono") === false){
						echo '<script languaje="javascript">
										parent.msg_alerta_default("ERROR! Formato de archivo no permitido...","Notificación!!","'.$upload->msj_error.'");
									</script>';
						exit(0);
					}
					$archivo = "archivos/cocinas/".$upload->nombre_final;
					$upload->setisimage(false);
					if($upload->save('../'.$archivo) === false){
						echo '<script languaje="javascript">
										parent.msg_alerta_default("ERROR! Fallo al guardar el archivo: '.$archivo.'...","Notificación!!","'.$upload->msj_error.'");
									</script>';
						exit(0);
					}
					$datos['flIcono'] = $archivo;
				}
				else{
					$datos['flIcono'] = $_POST["txtIcono"];
				}
			}
			else{
				$datos['flIcono'] = $_POST["txtIcono"];
				$borrar = '../' . $_POST["txtIcono"];
				if(file_exists($borrar)) unlink($borrar);
			}
			$strQuery = "CALL sp_cCocina('".$nombre."','".$datos['flIcono']."','".$datos['fecha_actual']."',";
			if($idFecha == 0) $strQuery .= "NULL," . $id . ")";
			else $strQuery .= "'" . $datos['fecha_actual'] . "'," . $id . ")";

			if($conexion->consulta($strQuery) == 0){
				$jsondata['resp'] = 0;
				$jsondata['msg'] = 0;
			}
			else{
				$jsondata['resp'] = 1;
			}

			header('Content-type: application/json; charset=utf-8');
			echo json_encode($jsondata);
		break;

		//OPCIÓN PARA ACTUALIZAR EL REGISTRO DEL CATÁLOGO ESTACIONAMIENTO
		case 3:
			$nombre = $funciones->limpia($_POST['txtNombre']);
			$idFecha = $funciones->limpia($_POST['txtFecha']);
			$id = $funciones->limpia($_POST['txtId']);
			if($idFecha == 0){
				if(isset($_FILES["flIcono"]["tmp_name"]) and $_FILES["flIcono"]["tmp_name"] != ""){
					if($upload->load("flIcono") === false){
						echo '<script languaje="javascript">
										parent.msg_alerta_default("ERROR! Formato de archivo no permitido...","Notificación!!","'.$upload->msj_error.'");
									</script>';
						exit(0);
					}
					$archivo = "archivos/estacionamiento/".$upload->nombre_final;
					$upload->setisimage(false);
					if($upload->save('../'.$archivo) === false){
						echo '<script languaje="javascript">
										parent.msg_alerta_default("ERROR! Fallo al guardar el archivo: '.$archivo.'...","Notificación!!","'.$upload->msj_error.'");
									</script>';
						exit(0);
					}
					$datos['flIcono'] = $archivo;
				}
				else{
					$datos['flIcono'] = $_POST["txtIcono"];
				}
			}
			else{
				$datos['flIcono'] = $_POST["txtIcono"];
				$borrar = '../' . $_POST["txtIcono"];
				if(file_exists($borrar)) unlink($borrar);
			}
			$strQuery = "CALL sp_cEstacionamiento('".$nombre."','".$datos['flIcono']."','".$datos['fecha_actual']."',";
			if($idFecha == 0) $strQuery .= "NULL," . $id . ")";
			else $strQuery .= "'" . $datos['fecha_actual'] . "'," . $id . ")";

			if($conexion->consulta($strQuery) == 0){
				$jsondata['resp'] = 0;
				$jsondata['msg'] = 0;
			}
			else{
				$jsondata['resp'] = 1;
			}

			header('Content-type: application/json; charset=utf-8');
			echo json_encode($jsondata);
		break;
		//OPCIÓN PARA ACTUALIZAR EL REGISTRO DEL CATÁLOGO ESTATUS PROPIEDADES
		case 4:
			$nombre = $funciones->limpia($_POST['txtNombre']);
			$idFecha = $funciones->limpia($_POST['txtFecha']);
			$id = $funciones->limpia($_POST['txtId']);
			if($idFecha == 0){
				if(isset($_FILES["flIcono"]["tmp_name"]) and $_FILES["flIcono"]["tmp_name"] != ""){
					if($upload->load("flIcono") === false){
						echo '<script languaje="javascript">
										parent.msg_alerta_default("ERROR! Formato de archivo no permitido...","Notificación!!","'.$upload->msj_error.'");
									</script>';
						exit(0);
					}
					$archivo = "archivos/estacionamiento/".$upload->nombre_final;
					$upload->setisimage(false);
					if($upload->save('../'.$archivo) === false){
						echo '<script languaje="javascript">
										parent.msg_alerta_default("ERROR! Fallo al guardar el archivo: '.$archivo.'...","Notificación!!","'.$upload->msj_error.'");
									</script>';
						exit(0);
					}
					$datos['flIcono'] = $archivo;
				}
				else{
					$datos['flIcono'] = $_POST["txtIcono"];
				}
			}
			else{
				$datos['flIcono'] = $_POST["txtIcono"];
				$borrar = '../' . $_POST["txtIcono"];
				if(file_exists($borrar)) unlink($borrar);
			}
			$strQuery = "CALL sp_cEstatusPropiedades('".$nombre."','".$datos['flIcono']."','".$datos['fecha_actual']."',";
			if($idFecha == 0) $strQuery .= "NULL," . $id . ")";
			else $strQuery .= "'" . $datos['fecha_actual'] . "'," . $id . ")";

			if($conexion->consulta($strQuery) == 0){
				$jsondata['resp'] = 0;
				$jsondata['msg'] = 0;
			}
			else{
				$jsondata['resp'] = 1;
			}

			header('Content-type: application/json; charset=utf-8');
			echo json_encode($jsondata);
		break;
		//OPCIÓN PARA ACTUALIZAR EL REGISTRO DEL CATÁLOGO PROPIETARIOS
	case 5:
		$nombre = $funciones->limpia($_POST['txtNombre']);
		$idFecha = $funciones->limpia($_POST['txtFecha']);
		$id = $funciones->limpia($_POST['txtId']);
		$strQuery = "CALL sp_cPropietarioPropiedades('".$nombre."','".$datos['fecha_actual']."',";
		if($idFecha == 0) $strQuery .= "NULL," . $id . ")";
		else $strQuery .= "'" . $datos['fecha_actual'] . "'," . $id . ")";

		if($conexion->consulta($strQuery) == 0){
			$jsondata['resp'] = 0;
			$jsondata['msg'] = 0;
		}else{
			$jsondata['resp'] = 1;
		}

		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata);
	break;

	//OPCIÓN PARA ACTUALIZAR EL REGISTRO DEL CATÁLOGO PROPIETARIOS
	case 6:
		$txtFolio 						= (isset($_POST["txtFolio"]))?$funciones->limpia($_POST["txtFolio"]):'';
		$txtClaveU 						= (isset($_POST["txtClaveU"]))?$funciones->limpia($_POST["txtClaveU"]):'';
		$txtDescripcion	 			= (isset($_POST["txtDescripcion"]))?$funciones->limpia($_POST["txtDescripcion"]):'';
		$txtTipo 							= (isset($_POST["txtTipo"]))?$funciones->limpia($_POST["txtTipo"]):0;
		$txtAlias 						= (isset($_POST["txtAlias"]))?$funciones->limpia($_POST["txtAlias"]):'';
		$txtDesarrollo 				= (isset($_POST["txtDesarrollo"]))?$funciones->limpia($_POST["txtDesarrollo"]):0;
		$txtCodigoP 					= (isset($_POST["txtCodigoP"]))?$funciones->limpia($_POST["txtCodigoP"]):'';
		$txtDireccion 				= (isset($_POST["txtDireccion"]))?$funciones->limpia($_POST["txtDireccion"]):'';
		$txtNExterior					= (isset($_POST["txtNExterior"]))?$funciones->limpia($_POST["txtNExterior"]):'';
		$txtNEdificio 				= (isset($_POST["txtNEdificio"]))?$funciones->limpia($_POST["txtNEdificio"]):'';
		$txtNDepartamento			= (isset($_POST["txtNDepartamento"]))?$funciones->limpia($_POST["txtNDepartamento"]):'';
		$txtEstatus 					= (isset($_POST["txtEstatus"]))?$funciones->limpia($_POST["txtEstatus"]):0;
		$txtPropietario 			= (isset($_POST["txtPropietario"]))?$funciones->limpia($_POST["txtPropietario"]):0;
		$txtMetros2 					= (isset($_POST["txtMetros2"]))?$funciones->limpia($_POST["txtMetros2"]):0;
		$txtRecamaras 				= (isset($_POST["txtRecamaras"]))?$funciones->limpia($_POST["txtRecamaras"]):0;
		$txtNoBanos 					= (isset($_POST["txtNoBanos"]))?$funciones->limpia($_POST["txtNoBanos"]):0;
		$txtAcbado 						= (isset($_POST["txtAcbado"]))?$funciones->limpia($_POST["txtAcbado"]):0;
		$txtEstacionamiento 	= (isset($_POST["txtEstacionamiento"]))?$funciones->limpia($_POST["txtEstacionamiento"]):0;
		$txtAntiguedad 				= (isset($_POST["txtAntiguedad"]))?$funciones->limpia($_POST["txtAntiguedad"]):0;
		$txtCloset 						= (isset($_POST["txtCloset"]))?$funciones->limpia($_POST["txtCloset"]):0;
		$txtCocina 						= (isset($_POST["txtCocina"]))?$funciones->limpia($_POST["txtCocina"]):0;
		$txtMonto 						= (isset($_POST["txtMonto"]))?$funciones->limpia($_POST["txtMonto"]):0;
		$txtOtros1 						= (isset($_POST["txtOtros1"]))?$funciones->limpia($_POST["txtOtros1"]):'';
		$txtOtros2 						= (isset($_POST["txtOtros2"]))?$funciones->limpia($_POST["txtOtros2"]):'';
		$txtObservaciones 		= (isset($_POST["txtObservaciones"]))?$funciones->limpia($_POST["txtObservaciones"]):'';
		$latitud 							= (isset($_POST["latitud"]))?$funciones->limpia($_POST["latitud"]):'';
		$longitud 						= (isset($_POST["longitud"]))?$funciones->limpia($_POST["longitud"]):'';
		$id 									= (isset($_POST["id"]))?$funciones->limpia($_POST["id"]):0;
		$idFecha 							= (isset($_POST["idFecha"]))?$funciones->limpia($_POST["idFecha"]):0;
		$tipo_coordenada 			= (isset($_POST["tipo_coordenada"]))?$funciones->limpia($_POST["tipo_coordenada"]):0;
		$coordenadas 					= (isset($_POST["coordenadas"]))?$_POST["coordenadas"]:'';
		$txtServicios = "";
		if(isset($_POST["txtServicios"])){
			foreach ($_POST["txtServicios"] as $indice => $idServicios) {
					$txtServicios .= $idServicios .",";
				}
				$txtServicios = substr($txtServicios,0,-1);
		}

		if(isset($_POST["txtLavado"])){
			$txtLavado = 1;
		}
		else $txtLavado = 0;
		if(isset($_POST["txtDiscapacitado"])){
			$txtDiscapacitado = 1;
		}
		else $txtDiscapacitado = 0;
		if(isset($_POST["txtEcotecnologia"])){
			$txtEcotecnologia = 1;
		}
		else $txtEcotecnologia = 0;

		$quitar = array(",", "$");
		$txtMonto = str_replace($quitar,"",$txtMonto);

		switch ($tipo_coordenada) {
			case 'marker':
				$tipo_coordenada = 1;
			break;

			case 'polyline':
				$tipo_coordenada = 2;
			break;

			case 'polygon':
				$tipo_coordenada = 3;
			break;
		}

		$cerrar='';
		if ($tipo_coordenada == 3){
			$poligono = explode(' ', $coordenadas);
			$cerrar = ' ' . trim($poligono[0]);
		}
		$coordenadas = trim($coordenadas).$cerrar;

		$strQuery = "CALL sp_Propiedades(";
		$strQuery .= $id . ",";
		$strQuery .= "'" . $txtClaveU . "',";
		$strQuery .= "'" . $txtDescripcion . "',";
		$strQuery .= $txtTipo . ",";
		$strQuery .= "'" . $txtAlias . "',";
		$strQuery .= $txtDesarrollo . ",";
		$strQuery .= "'" . $txtCodigoP . "',";
		$strQuery .= "'" . $txtDireccion . "',";
		$strQuery .= "'" . $txtNExterior . "',";
		$strQuery .= "'" . $txtNEdificio  . "',";
		$strQuery .= "'" . $txtNDepartamento  . "',";
		$strQuery .= $txtEstatus . ",";
		$strQuery .= $txtPropietario . ",";
		$strQuery .= $txtMetros2 . ",";
		$strQuery .= $txtRecamaras . ",";
		$strQuery .= $txtNoBanos . ",";
		$strQuery .= $txtAcbado . ",";
		$strQuery .= $txtEstacionamiento . ",";
		$strQuery .= $txtAntiguedad . ",";
		$strQuery .= $txtCloset . ",";
		$strQuery .= $txtCocina . ",";
		$strQuery .= "'" . $txtServicios  . "',";
		$strQuery .= "'" . $txtOtros1  . "',";
		$strQuery .= "'" . $txtOtros2  . "',";
		$strQuery .= $txtLavado . ",";
		$strQuery .= $txtDiscapacitado . ",";
		$strQuery .= $txtEcotecnologia . ",";
		$strQuery .= "'" . $txtObservaciones  . "',";
		$strQuery .= "'" . $tipo_coordenada  . "',";
		$strQuery .= "'" . $coordenadas  . "',";
		$strQuery .= $idFecha . ",";
		$strQuery .= "'" . $txtFolio  . "',";
		$strQuery .= $txtMonto . ",@vrFolio,@vrId);";

		if($conexion->consulta($strQuery) == 0){
			$jsondata['resp'] = 0;
			$jsondata['msg'] = 0;
		}
		else{
			$resultado = @$conexion->obtenerlista("SELECT @vrFolio AS Folio,@vrId AS Id");
			$jsondata['resp'] = 1;
			foreach ($resultado as $key) {
				$jsondata['folio'] = $key->Folio;
				$jsondata['id'] = $key->Id;
			}
		}


		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata);
	break;
	//OPCIÓN PARA ACTUALIZAR/AGREGAR/ELIMINAR IMAGENES DE LAS PROPIEDADES
	case 7:
		$descripcion 		= (isset($_POST['txtDescripcion']))?$funciones->limpia($_POST['txtDescripcion']):'';
		$idFecha 			= (isset($_POST['idFecha']))?$funciones->limpia($_POST['idFecha']):'';
		$idPropiedad 		= (isset($_POST['id_propiedad']))?$funciones->limpia($_POST['id_propiedad']):'';
		$idImagen 			= (isset($_POST['id_imagen']))?$funciones->limpia($_POST['id_imagen']):'';
		$idTipo					= (isset($_POST['txtTipo']))?$funciones->limpia($_POST['txtTipo']):'';

		if($idFecha == 0){
			if(isset($_FILES["flImagen"]["tmp_name"]) and $_FILES["flImagen"]["tmp_name"] != ""){
				if($upload->load("flImagen") === false){
					$jsondata['resp'] = 0;
					$jsondata['msg'] = 'Formato de archivo no valido.';
					header('Content-type: application/json; charset=utf-8');
					echo json_encode($jsondata);
					exit(0);
				}
				$carpeta = "../archivos/propiedades/imagenes/".$idPropiedad;
				$archivo = "archivos/propiedades/imagenes/".$idPropiedad."/".$upload->nombre_final;
				if(!file_exists($carpeta)) mkdir($carpeta, 0777, true);
				$upload->setisimage(false);
				if($upload->save('../'.$archivo) === false){
					$jsondata['resp'] = 0;
					$jsondata['msg'] = "Error al subir la imagen.";
					header('Content-type: application/json; charset=utf-8');
					echo json_encode($jsondata);
					exit(0);
				}
				$datos['flImagen'] = $archivo;
			}
			else{
				$datos['flImagen'] = $_POST["txtImagen"];
			}
		}
		else{
			$datos['flImagen'] = $_POST["txtImagen"];
			$borrar = '../' . $_POST["txtImagen"];
			if(file_exists($borrar)) unlink($borrar);
		}
		$strQuery = "CALL sp_imagenPropiedades(".$idPropiedad.",'".$descripcion."','".$datos['flImagen']."',";
		$strQuery .= $idTipo . ",'" . $datos["fecha_actual"] . "'," . $idFecha . "," . $idImagen . ")";
		if($conexion->consulta($strQuery) == 0){
			$jsondata['resp'] = 0;
			$jsondata['msg'] = 0;
		}
		else{
			$jsondata['resp'] = 1;
		}

		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata);
	break;
            
    case 8:
        $txtTipoDocumento   = (isset($_POST["txtTipoDocumento"]))? $funciones->limpia($_POST["txtTipoDocumento"]):0;
        $txtOtro            = (isset($_POST["txtOtro"]))? $funciones->limpia($_POST["txtOtro"]):'';
        $txtEstatus         = (isset($_POST["txtEstatus"]))? $funciones->limpia($_POST["txtEstatus"]):0;
        $txtMonto           = (isset($_POST["txtMonto"]))? $funciones->limpia($_POST["txtMonto"]):0;
        $txtVigencia        = (isset($_POST["txtVigencia"]))? $funciones->limpia($_POST["txtVigencia"]):'';
        $txtTipoArchivo     = (isset($_POST["txtTipoArchivo"]))? $funciones->limpia($_POST["txtTipoArchivo"]):0;
        $txtObservaciones   = (isset($_POST["txtObservaciones"]))? $funciones->limpia($_POST["txtObservaciones"]):'';
        $idFecha            = (isset($_POST["idFecha"]))? $funciones->limpia($_POST["idFecha"]):0;
        $id_propiedad       = (isset($_POST["id_propiedad"]))? $funciones->limpia($_POST["id_propiedad"]):0;
        $id_documento       = (isset($_POST["id_documento"]))? $funciones->limpia($_POST["id_documento"]):0;
		
		$formatea_monto = array('$',',');
		$txtMonto = str_replace($formatea_monto,'',$txtMonto);
		$txtVigencia = $funciones->formatoFecha($txtVigencia);
        if($idFecha == 0){
			if(isset($_FILES["flArchivo"]["tmp_name"]) and $_FILES["flArchivo"]["tmp_name"] != ""){
				if($upload->load("flArchivo") === false){
					$jsondata['resp'] = 0;
					$jsondata['msg'] = 'Formato de archivo no valido.';
					header('Content-type: application/json; charset=utf-8');
					echo json_encode($jsondata);
					exit(0);
				}
				$carpeta = "../archivos/propiedades/documentos/".$id_propiedad;
				$archivo = "archivos/propiedades/documentos/".$id_propiedad."/".$upload->nombre_final;
				if(!file_exists($carpeta)) mkdir($carpeta, 0777, true);
				$upload->setisimage(false);
				if($upload->save('../'.$archivo) === false){
					$jsondata['resp'] = 0;
					$jsondata['msg'] = "Error al subir el archivo.";
					header('Content-type: application/json; charset=utf-8');
					echo json_encode($jsondata);
					exit(0);
				}
				$datos['flArchivo'] = $archivo;
			}
			else{
				$datos['flArchivo'] = $_POST["txtArchivo"];
			}
		}
		else{
			$datos['flArchivo'] = $_POST["txtArchivo"];
			$borrar = '../' . $_POST["txtArchivo"];
			if(file_exists($borrar)) unlink($borrar);
		}
        
        $strQuery = "CALL spDocumentosPropiedades(";
        $strQuery .= $id_propiedad . ",";
	    $strQuery .= $txtTipoDocumento . ",'";
	    $strQuery .= $txtOtro . "','";
	    $strQuery .= $datos['flArchivo'] . "',";
	    $strQuery .= $txtTipoArchivo . ",";
	    $strQuery .= $txtEstatus . ",";
	    $strQuery .= $txtMonto . ",'";
	    $strQuery .= $txtVigencia . "','";
	    $strQuery .= $datos["fecha_actual"] . "','";
	    $strQuery .= $txtObservaciones . "',";
	    $strQuery .= $idFecha . ",";
	    $strQuery .= $id_documento . ");";
     
        if($conexion->consulta($strQuery) == 0){
			$jsondata['resp'] = 0;
			$jsondata['msg'] = 0;
		}
		else{
			$jsondata['resp'] = 1;
		}

		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata);
            
    break;
    case 9:
        session_destroy();
        echo "index.php";
    break;
}
?>
