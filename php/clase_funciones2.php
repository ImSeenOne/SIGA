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
	
	function formatoFecha($fecha){
		$arrayF = explode("/",$fecha);
		$nuevaFecha = "";
		//print_r($arrayF);		
		if(is_array($arrayF)) $nuevaFecha = $arrayF[2] . "-" . $arrayF[1] . "-" . $arrayF[0];

		return $nuevaFecha;
	}
    
    // FUNCION PARA GENERAR CONTRASEÑAS
    
    function create_password($pwd){
        $opciones = [
            'cost' => 12,
        ];
        $pwd = 'sisSiga' . $pwd;
        return password_hash($pwd, PASSWORD_BCRYPT, $opciones);
    }
    
    function verifica_password($pwd,$hash){
        $pwd = 'sisSiga' . $pwd;
        return password_verify($pwd,$hash);
    }
    
    //Obtiene la ip real
    function getRealIP() {
		if(!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip=$this->limpia($_SERVER['HTTP_CLIENT_IP']);
			}
		elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip=$this->limpia($_SERVER['HTTP_X_FORWARDED_FOR']);
			}
		else {
			$ip=$this->limpia($_SERVER['REMOTE_ADDR']);
		}
		
		return $ip;
	}
    
    function getBrowser() { 
		$user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : ''; 
		$navegadores = array(
			'Opera' => 'Opera',
			'Mozilla Firefox'=> '(Firebird)|(Firefox)',
			'Google Chrome'=>'Chrome',
			'Galeon' => 'Galeon',
			'Mozilla'=>'Gecko',
			'MyIE'=>'MyIE',
			'Lynx' => 'Lynx',
			'Google Chrome'=>'Chrome',
			'Konqueror'=>'Konqueror',
			'Internet Explorer 7' => '(MSIE 7\.[0-9]+)',
			'Internet Explorer 6' => '(MSIE 6\.[0-9]+)',
			'Internet Explorer 5' => '(MSIE 5\.[0-9]+)',
			'Internet Explorer 4' => '(MSIE 4\.[0-9]+)',
			'Internet Explorer' => 'MSIE',
			'Flock'             => 'Flock',
		    'Shiira'            => 'Shiira',
		    'Chimera'           => 'Chimera',
		    'Phoenix'           => 'Phoenix',
		    'Camino'            => 'Camino',
		    'Netscape'          => 'Netscape',
		    'OmniWeb'           => 'OmniWeb',
		    'Safari'            => 'Safari',
		    'icab'              => 'iCab',
		    'Links'             => 'Links',
		    'hotjava'           => 'HotJava',
		    'amaya'             => 'Amaya',
		    'IBrowse'           => 'IBrowse'
			);
			
		foreach($navegadores as $navegador=>$pattern){
			if(strpos($user_agent, $pattern) !== false) return $this->limpia($navegador);
			}
			
		}
	
	function getOs() {
		$user_agent= strtolower($_SERVER['HTTP_USER_AGENT']);

		$plataformas = array(
		  	'/windows nt 6.3/i'     =>  'Windows 8.1',
			'/windows nt 6.2/i'     =>  'Windows 8',
			'/windows nt 6.1/i'     =>  'Windows 7',
			'/windows nt 6.0/i'     =>  'Windows Vista',
			'/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
			'/windows nt 5.1/i'     =>  'Windows XP',
			'/windows xp/i'         =>  'Windows XP',
			'/windows nt 5.0/i'     =>  'Windows 2000',
			'/windows nt 6.3/i'     =>  'Windows 8.1',
			'/windows me/i'         =>  'Windows ME',
			'/win98/i'              =>  'Windows 98',
			'/win95/i'              =>  'Windows 95',
			'/win16/i'              =>  'Windows 3.11',
			'/macintosh|mac os x/i' =>  'Mac OS X',
			'/mac_powerpc/i'        =>  'Mac OS 9',
			'/linux/i'              =>  'Linux',
			'/ubuntu/i'             =>  'Ubuntu',
			'/iphone/i'             =>  'iPhone',
			'/ipod/i'               =>  'iPod',
			'/ipad/i'               =>  'iPad',
			'/android/i'            =>  'Android',
			'/blackberry/i'         =>  'BlackBerry',
			'/webos/i'              =>  'Mobile WebOS'
	   );
	
		foreach ($plataformas as $regex => $plataforma) { 

		    if (preg_match($regex, $user_agent)) {
		        return $this->limpia($plataforma);
		    }
		}   

	   return 'Sistema Operativo Desconocido';
	}


} //fin de la Clse Funciones

?>
