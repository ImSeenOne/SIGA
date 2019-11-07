<?php
class Variables {
	var $BaseDatos;
	var $Servidor;
	var $Usuario;
	var $Clave;
	var $Puerto;
	public function opcion($opc){
		switch($opc){
			case 1:
				$this->BaseDatos = "demosystem_siga";
				//$this->Servidor = "mysql.us.cloudlogin.co";
				$this->Servidor = "localhost";
				$this->Usuario = "demosystem_siga";
				$this->Clave = "35JG0xdwrK";
			break;
			case 2:
				$this->BaseDatos = "demosystem_sigap";
				//$this->Servidor = "mysql.us.cloudlogin.co";
				$this->Servidor = "localhost";
				$this->Usuario = "demosystem_sigap";
				$this->Clave = "fd1d5o1UIR";
			break;
			default:
				header('Location: http://demosistemas.com/siga');
				exit(0);
			break;
		}
	}
}
?>
