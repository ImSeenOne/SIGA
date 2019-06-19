<?Php
	//require "php/clase_variables.php";
	//require "php/clase_mysql.php";
	require "php/clase_funciones.php";
	//require "php/clase_querys.php";
	
	//$conexion  = new DB_MySql(1);
	$funciones = new Funciones();
	//$querys    = new Querys();

    $modulo = isset($_GET['modulo']) ? $_GET['modulo'] : 'presentacion';
?>