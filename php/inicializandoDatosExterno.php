<?php
	date_default_timezone_set('America/Mexico_City');
	@session_start();

	/*if(isset($_SESSION['autentificado_siga']) && $_SESSION['autentificado_siga'] == md5('autentificado_siga')){
	}*/
	require_once("../php/clase_variables.php");
	require_once("../php/clase_mysql.php");
	include_once("../php/clase_querys.php");
	include_once("../php/clase_querys3.php");
	include_once("../php/clase_funciones.php");
	include_once("../php/clase_paginador.php");
	//--------------------------------------------------
	$idConexion = $_SESSION["idConexion"];
	$conexion  = new DB_MySql($idConexion);
	$funciones = new Funciones();
	$querys    = new Querys();
	$querys3   = new Querys3();
?>
