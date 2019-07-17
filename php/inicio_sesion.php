<?php
//*****************SE INICIA SESIÓN********************
	session_start();
//*****************************************************
	require "clase_variables.php";
	require "clase_mysql.php";
	require "clase_funciones2.php";
	require 'clase_querys2.php';

    
	$error = null;
	
	$conexion  = new DB_mysql(1);
	$funciones = new FuncionesB();
	$querys    = new QuerysB();

	$ip = $funciones->getRealIP();
	$navegador = $funciones->getBrowser();
	$so = $funciones->getOs();
	$fecha_actual = date("Y")."-".date("m")."-".date("d");
	$hora_actual = date("H").":".date("i").":".date("s");
	date_default_timezone_set('America/Mexico_City');

	$usuario  = $funciones->limpia($_POST["login_name"]);
	$pwd      = $_POST["login_pw"];
	//$pwd      = $funciones->verifica_password($pwd);		
		
	//ENVIANDO USUARIO A CONSULTA PARA OBTENER INFORMACIÓN EN CASO DE EXISTIR EN LA BD.
    
	
    $dato = @$conexion->fetch_array($querys->existeUsuario($usuario));

	//VERIFICANDO SI EXISTEN EL USUARIO EN LA BASE DE DATOS
    $resultados = @$conexion->numregistros();
    if($resultados == 0){
        //OPCIÓN PARA USUARIO NO REGISTRADO
        echo 'incorrectoU';
        exit();
    }else if(!$funciones->verifica_password($pwd,$dato["password"])){
            //OPCIÓN PARA CONTRASEÑA INCORRECTA
        echo 'incorrectoP';
        exit();
    }
    else{
        //INICIALIZANDO VARIABLES DE SESIÓN*************************
        $_SESSION["autentificado_sis"]  = md5("sistemagrupoaguilera");
        $_SESSION["nombreC"]            = $dato["nombre"] . ' ' . $dato["apellido_p"] . ' ' . $dato["apellido_m"];
        $_SESSION["dUsuario"]           = $dato;
        
        //OPCIÓN PARA DIRECCIONAR A LA PÁGINA DE INICIO TRAS LOGUEO EXITOSO
        echo 'correcto';
        exit();
    }
  ?>

