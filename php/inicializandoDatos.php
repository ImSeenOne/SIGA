<?Php
	@session_start();
    $autenticado_sis = $_SESSION["autentificado_sis"]; 
    $dUsuario = $_SESSION["dUsuario"];
    $nombreC = $_SESSION["nombreC"];
    
    require ("php/clase_variables.php");
	require ("php/clase_mysql.php");
	require ("php/clase_funciones2.php");
    require ("php/clase_funciones.php");
    require ('php/clase_querys.php');
    require ('php/clase_querys2.php');
    require ('php/clase_querys3.php');
    	
    $funciones  = new Funciones();
    $funcionesB = new FuncionesB();
    $conexion   = new  DB_MySql(1);
    $querys     = new QuerysB();
    $querys1    = new Querys();
    $querys3    = new Querys3();
    
	if($autenticado_sis == md5("sistemagrupoaguilera")){
        $modulo = isset($_GET['modulo']) ? $_GET['modulo'] : 'inicio';
    }
    else{
        @session_destroy();
        echo'<script languaje="javascript">
				var msg = alert("Acceso Denegado");
				location.href="index.php";
			</script>';
        exit(0);
    }
    $permiso = @$conexion->consultaregistro($querys->obtenerPermisoModulo($dUsuario["id_usuario"], $modulo));
?>