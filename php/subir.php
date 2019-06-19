<?Php
@session_start();

require_once("clase_variables.php");
require_once("clase_mysql.php");
include_once("clase_querys.php");

//$push = new PushNotifications();
$funciones = new Funciones();
//LLAMAMOS A LA CLASE CONEXION
$conexion = new DB_mysql(1);
//llamamos a la clase upload para cargar archivos

$querys    = new Querys();

?>
