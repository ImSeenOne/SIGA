<?php
	//error_reporting(E_ALL);
	date_default_timezone_set('America/Mexico_City');
	@session_start();

	if(isset($_SESSION['autentificado_siga']) && $_SESSION['autentificado_siga'] == md5('AutenticadoRap_web')){

	}
	require "clase_variables.php";
	require "clase_mysql.php";
	require "clase_funciones.php";
	require "clase_querys.php";
	require "clase_querys3.php";
	//--------------------------------------------------
	$conexion  = new DB_MySql(1);
	$funciones = new Funciones();
	$querys    = new Querys();
	$querys3	 = new Querys3();
?>
