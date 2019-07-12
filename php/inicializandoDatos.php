<?Php
error_reporting(E_ALL);
ini_set('display_errors', '1');
	require "php/clase_variables.php";
	require "php/clase_mysql.php";
	require "php/clase_funciones.php";
	require "php/clase_querys3.php";

	$conexion  = new DB_MySql(1);
	$funciones = new Funciones();
	$querys3    = new Querys3();

    $modulo = isset($_GET['modulo']) ? $_GET['modulo'] : 'presentacion';
?>
