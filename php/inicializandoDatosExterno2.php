<?php
	//error_reporting(E_ALL);
	date_default_timezone_set('America/Mexico_City');
	@session_start();
	$_SESSION["id_propiedad"] = 0;
	//if(isset($_SESSION['autentificado_siga']) && $_SESSION['autentificado_siga'] == md5('AutenticadoRap_web')){

	//}
	require_once("clase_variables.php");
	require_once("clase_mysql.php");
	include_once("clase_querys2.php");
	include_once("clase_funciones2.php");
	//--------------------------------------------------
	$conexionB  = new DB_MySql(1);
	$funcionesB = new FuncionesB();
	$querysB    = new QuerysB();
?>
