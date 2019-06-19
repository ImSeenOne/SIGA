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
				$this->Servidor = "localhost";
				$this->Usuario = "demosystem_siga";
				$this->Clave = "35JG0xdwrK";
			break;
			
			default:
				header('Location: http://demosistemas.com/siga');
				exit(0);
			break;
		} 
	}
}
?>