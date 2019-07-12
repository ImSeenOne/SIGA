<?php
class FuncionesB{
	public function rutaAbsoluta(){
		return 'http://demosistemas.com/siga';
	}

	public function llenarcombo($resultados,$id) {
		// mostrarmos los registros
		foreach($resultados as $resultado){
			if($id == $resultado->id) {
				echo '<option data-id="' . $resultado->dataId .
						 '" value="'.$resultado->id.'" selected="selected">'.
						 $this->cdetectUtf8($resultado->valor).'</option>';
			}
			else{
				echo '<option data-id="' . $resultado->dataId .
						'" value="'.$resultado->id.'">'.
						$this->cdetectUtf8($resultado->valor).'</option>';
			}
		}
	}
	public function llenarcomboM($resultados,$id) {
		$porciones = explode(",", $id);
		// mostrarmos los registros
		foreach($resultados as $resultado){
			if(in_array($resultado->id,$porciones)) {
				echo '<option data-id="' . $resultado->dataId .
						 '" value="'.$resultado->id.'" selected="selected">'.
						 $this->cdetectUtf8($resultado->valor).'</option>';
			}
			else{
				echo '<option data-id="' . $resultado->dataId .
						'" value="'.$resultado->id.'">'.
						$this->cdetectUtf8($resultado->valor).'</option>';
			}
		}
	}

	function cdetectUtf8($str){
		if( mb_detect_encoding($str,"UTF-8, ISO-8859-1")!="UTF-8" ){

			return  utf8_encode($str);
			}
		else{
			return $str;
			}

		}


	//limpia cadena para evitar inyeccion SQL
	public function limpia($var){
		$var = strip_tags($var);
		$malo = array("\\",";","+","\'","'","$","%","!","(",")",'"',"*","{","}","xor","XOR","FROM","from","WHERE","where","ORDER","order","GROUP","group","by","BY","UPDATE","update","DELETE","delete",".php",".asp",".aspx",".html",".xml",".js",".css",".exe",".tar",".rar",".ocx"); // Aqui poner caracteres no permitidos
		$i=0;
		$o=count($malo);
		$o= $o-1;
		while($i<=$o){
			$var = str_replace($malo[$i],"",$var);
			$i++;
		}

		return $var;
	}

	public function sanear_string($string)
	{

		$string = trim($string);

		$string = str_replace(
			array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
			array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
			$string
		);

		$string = str_replace(
			array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
			array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
			$string
		);

		$string = str_replace(
			array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
			array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
			$string
		);

		$string = str_replace(
			array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
			array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
			$string
		);

		$string = str_replace(
			array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
			array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
			$string
		);

		$string = str_replace(
			array('ñ', 'Ñ', 'ç', 'Ç'),
			array('n', 'N', 'c', 'C',),
			$string
		);

		//Esta parte se encarga de eliminar cualquier caracter extraño
		$string = str_replace(
			array("\\", "¨", "º", "~",
				 "#", "@", "|", "!", "\"",
				 "·", "$", "%", "&", "/",
				 "(", ")", "?", "'", "¡",
				 "¿", "[", "^", "`", "]",
				 "+", "}", "{", "¨", "´",
				 ">", "< ", ";", ",", ":",
				 ".", "'", '"','“','”'),
			'',
			$string
		);


		return $string;
	}



	public function mes_nombre($mes){

		 switch($mes)
              {
               case 1:
                  $mes='Enero';
                  break;
               case 2:
                  $mes='Febrero';
                  break;
               case 3:
                  $mes='Marzo';
                  break;
               case 4:
                  $mes='Abril';
                  break;
               case 5:
                  $mes='Mayo';
                  break;
               case 6:
                  $mes='Junio';
                  break;
               case 7:
                  $mes='Julio';
                  break;
               case 8:
                  $mes='Agosto';
                  break;
               case 9:
                  $mes='Septiembre';
                  break;
               case 10:
                  $mes='Octubre';
                  break;
               case 11:
                  $mes='Noviembre';
                  break;
               case 12:
                  $mes='Diciembre';
                  break;
              }
			return $mes;
		}



} //fin de la Clse Funciones

?>
