<?php
class Funciones{
	public function rutaAbsoluta(){
		return 'http://demosistemas.com/siga';
	}
	
	public function llenarcombo($resultados) {
		foreach($resultados as $resultado){
			echo '
			<option value="'.$resultado->id.'" name="'.$resultado->valor.'">'.$this->cdetectUtf8($resultado->valor).'</option>';
			}
		}
	
	public function llenarcombomodifica($resultados,$id) {
		// mostrarmos los registros
		foreach($resultados as $resultado){			
			if($id == $resultado->id) echo '<option value="'.$resultado->id.'" selected="selected">'.$this->cdetectUtf8($resultado->valor).'</option>';
			else echo '<option value="'.$resultado->id.'">'.$this->cdetectUtf8($resultado->valor).'</option>';		
		}
	}

	public function llenarcombomodifica2($resultados,$id) {
		// mostrarmos los registros
		foreach($resultados as $resultado){	
			if($id != $rows[0]) echo '<option value="'.$resultado->id.'">'.$this->cdetectUtf8($resultado->valor).'</option>';
		}
	}
	
	public function llenarcombomodificaarreglo2($resultados,$arregloid) {
		// mostrarmos los registros
		foreach($resultados as $resultado){	
			if(!in_array($resultado->id, $arregloid)) echo '<option value="'.$resultado->id.'">'.$resultado->valor.'</option>';		
		}
	}	
	
	public function llenarcombomodificaarreglo($resultados,$arregloid) {
		// mostrarmos los registros
		foreach($resultados as $resultado){	
			if(in_array($resultado->id, $arregloid)) echo '<option value="'.$resultado->id.'" selected="selected">'.$resultado->valor.'</option>';
			else echo '<option value="'.$resultado->id.'">'.$resultado->valor.'</option>';		
		}
	}

	/* Muestra opciones con input tipo radio */
	
	public function llenaradio($resultados,$nombre) {
		$x = 1;
		// mostrarmos los registros
		foreach($resultados as $resultado){	
			if($x == 1){
				echo '<input type="radio" name="'.$nombre.'" id="'.$nombre.$resultado->id.'" value="'.$nombre.$resultado->id.'" checked="checked" />'.$resultado->valor.'&nbsp;&nbsp;';
				$x++;
			}
			else
				echo '<input type="radio" name="'.$nombre.'" id="'.$nombre.$resultado->id.'" value="'.$nombre.$resultado->id.'" />'.$resultado->valor.'&nbsp;&nbsp;';
				
		}
	}
	
	public function llenaradiomodifica($resultados,$id,$nombre) {
		// mostrarmos los registros
		foreach($resultados as $resultado){			
			if($id == $resultado->id) echo '<input type="radio" name="'.$nombre.'" id="'.$nombre.$resultado->id.'" value="'.$nombre.$resultado->id.'" checked="checked" />'.$resultado->valor.'&nbsp;&nbsp;';
			else echo '<input type="radio" name="'.$nombre.'" id="'.$nombre.$resultado->id.'" value="'.$nombre.$resultado->id.'" />'.$resultado->valor.'&nbsp;&nbsp;';		
		}
	}

	public function cortarTexto($string, $chars = 100, $elipsis = '...') {
	    // elimino tags y returns y separo en cadenas de $chars caracteres (o menos)
	    // luego tokenizo las cadenas con el caracter "\n", el mismo que usé
	    // antes para separar la cadena
	    $cut = strtok(wordwrap(strip_tags(nl2br($string)), $chars,"\n"), "\n");

	    // elimino puntuaciones y espacios finales
	    $cut = rtrim($cut, " \t\n\r\0\x0B,;.?-");

	    // si la longitud de la cadena es mayor que la longitud del recorte
	    // y la longitud del recorte es mayor que 0, agrego $elipsis
	    if(strlen($string)>strlen($cut) && strlen($cut)>0){
	        $cut .= $elipsis;
	    }

	    return $cut;
	}
	function textoTruncate($string, $limit, $break=" ", $pad="...") {
		// return with no change if string is shorter than $limit
		if(strlen($string) <= $limit)
		return $string;
		// is $break present between $limit and the end of the string?
		if(false !== ($breakpoint = strpos($string, $break, $limit))) {
			if($breakpoint < strlen($string) - 1) {
				$string = substr($string, 0, $breakpoint) . $pad;
			}
		}
		return $string;
	}

	//convierte la fecha a formato año / mes / dia
	public function cambiarFormatoFecha($fecha){
		if(strstr($fecha,"-")){
			list($anio,$mes,$dia)=explode("-",$fecha);
		}
		else{
			list($anio,$mes,$dia)=explode("/",$fecha);
		}
    	return $dia."<strong>.</strong>".$mes."<strong>.</strong>".$anio; 
	}
	//convierte la fecha a formato año - mes - dia
	public function cambiarFormatoFechabase($fecha){
		if(strstr($fecha,"-")){
			list($dia,$mes,$anio)=explode("-",$fecha);
		}
		else{
			list($dia,$mes,$anio)=explode("/",$fecha);
		}
    	return $anio."-".$mes."-".$dia; 
	}

	//convierte la fecha a formato dia / mes / año
	public function cambiarFormatoFechaform($fecha){
		if(strstr($fecha,"-")){
			list($anio,$mes,$dia)=explode("-",$fecha);
		}
		else{
			list($anio,$mes,$dia)=explode("/",$fecha);
		}
    	return $dia."/".$mes."/".$anio; 
	}

	//convierte color exadecimal a RGB
	public function rgbColor($fondo)	{
		$red = (int) hexdec(substr($fondo, 0, 2));
		$green = (int) hexdec(substr($fondo, 2, 2));
		$blue = (int) hexdec(substr($fondo, 4, 2));
		return array($red, $green, $blue);
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

	public function comillas_formulario($string)
	{
	
		$string = trim($string);
	
		$string = str_replace(
			array('"', "'"),
			array(htmlentities('"'), htmlentities("'")),
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

	public function fecha(){
		$fecha = getdate();
		$dia = $fecha["mday"];
		$mes = $fecha["mon"];

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
           
		$año = $fecha["year"];
		echo "$dia de $mes del $año";		
		}

	public function mes($mes){
		
		/*if(strstr($fecha,"-")){
			list($anio,$mes,$dia)=explode("-",$fecha);
		}
		else{
			list($anio,$mes,$dia)=explode("/",$fecha);
		}*/

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


	public function fecha2($fecha){
		
		if(strstr($fecha,"-")){
			list($anio,$mes,$dia)=explode("-",$fecha);
		}
		else{
			list($anio,$mes,$dia)=explode("/",$fecha);
		}

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
           
		return "$dia de $mes $anio";		
		}
	
	public function fecha3($fecha){
		
		if(strstr($fecha,"-")){
			list($anio,$mes,$dia)=explode("-",$fecha);
		}
		else{
			list($anio,$mes,$dia)=explode("/",$fecha);
		}
		$i = strtotime($fecha);
		$dia1 = date("w",mktime(0, 0, 0, $mes, $dia, $anio));
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
			  
           switch($dia1)
              {
				  case 0:
                  $dia1='Domingo';
                  break;        
               case 1:
                  $dia1='Lunes';
                  break;     
               case 2:
                  $dia1='Martes';
                  break;     
               case 3:
                  $dia1='Miércoles';
                  break;
               case 4:
                  $dia1='Jueves';
                  break;
               case 5:
                  $dia1='Viernes';
                  break;
               case 6:
                  $dia1='Sabado';
                  break;
              }
           
		return "$dia1, $dia de $mes $anio";		
		}

	public function tipo_redsocial($id){
		switch($id){
			case 1: $publicado = 'Facebook'; break;
			case 2: $publicado = 'Twitter'; break;
			case 3: $publicado = 'Google+'; break;
			case 4: $publicado = 'Youtube'; break;
			case 5: $publicado = 'Flikr'; break;
			case 6: $publicado = 'Instagram'; break;
			}
		return $publicado;
	}

	function ordenaFechaHora($fechaHora){
		$aFecha_Hora    = explode(' ', $fechaHora);
		$fechaOrdenada  = $this->fecha4($aFecha_Hora[0]);
		$hora           = $aFecha_Hora[1];

		return $fechaOrdenada.' '.$hora;
	}

	public function fecha4($fecha){
		
		if(strstr($fecha,"-")){
			list($anio,$mes,$dia)=explode("-",$fecha);
		}
		else{
			list($anio,$mes,$dia)=explode("/",$fecha);
		}
           
		return "$dia/$mes/$anio";		
	}

	public function fecha5($fecha){
		
		if(strstr($fecha,"-")){
			list($anio,$mes,$dia)=explode("-",$fecha);
		}
		else{
			list($anio,$mes,$dia)=explode("/",$fecha);
		}
           
		return "$dia-$mes-$anio";		
	}
		
	public function activo($id = 2){
		switch($id){
			case 1: $publicado = "SI"; break;
			case 0: $publicado = '<div style="color:#C00">NO</div>'; break;
			default: $publicado = "nada";
			}
		return $publicado;
	}
	
	public function tipo_sexo($id){
		switch($id){
			case 1: $publicado = "Hombre"; break;
			case 2: $publicado = 'Mujer'; break;
			}
		return $publicado;
	}

	public function getComboActivo($value)
	{
		$array_visible=array('-1'=>'Estatus(Todos)', 1=>"SI", 0=>"NO");
		foreach($array_visible as $t => $visible)
		{
			if($value==$t) echo "<option value='".$t."' selected='selected'>".$visible."</option>";
			else echo "<option value='".$t."'>".$visible."</option>";
		}
	}
	public function getComboEstatus($value)
	{
		$array_visible=array(1=>"SI", 0=>"NO");
		foreach($array_visible as $t => $visible)
		{
			if($value==$t) echo "<option value='".$t."' selected='selected'>".$visible."</option>";
			else echo "<option value='".$t."'>".$visible."</option>";
		}
	}

	public function getcombosexo($value){
		$array_visible=array(1=>"Hombre", 2=>"Mujer");
		foreach($array_visible as $t => $visible)
		{
			if($value==$t) echo "<option value='".$t."' selected='selected'>".$visible."</option>";
			else echo "<option value='".$t."'>".$visible."</option>";
		}
	}

	public function getcombosexo2($value){
		$array_visible=array(1=>"Hombre", 2=>"Mujer");
		$cadena = "";
		foreach($array_visible as $t => $visible)
		{
			if($value==$t) $cadena .= "<option value='".$t."' selected='selected'>".$visible."</option>";
			else $cadena .= "<option value='".$t."'>".$visible."</option>";
		}
		return $cadena;
	}
	
	public function getComboVisible($value = 2)
	{
		$array_visible=array(1=>"SI", 2=>"NO");
		foreach($array_visible as $t => $visible)
		{
			if($value==$t) echo "<option value='".$t."' selected='selected'>".$visible."</option>";
			else echo "<option value='".$t."'>".$visible."</option>";
		}
	}

	public function getcombotipousuario($value = 1)
	{
		$array_visible=array(1=>"Administrador", 2=>"Secretario");
		foreach($array_visible as $t => $visible)
		{
			if($value==$t) echo "<option value='".$t."' selected='selected'>".$visible."</option>";
			else echo "<option value='".$t."'>".$visible."</option>";
		}
	}

	public function getMonthDays($Month, $Year){ 
	   //Si la extensión que mencioné está instalada, usamos esa. 
	   if( is_callable("cal_days_in_month")) 
	   { 
		  return cal_days_in_month(CAL_GREGORIAN, $Month, $Year); 
	   } 
	   else 
	   { 
		  //Lo hacemos a mi manera. 
		  return date("t",mktime(0,0,0,$Month,1,$Year)); 
	   } 
	}

	/*function create_password($password){
		
		$salt = '123%45678"$9%%9&/((&87654321';
		$password_array = str_split($password, 4);
		$hash = sha1($password_array[0].$password_array[3].$salt.$password_array[2].$password_array[1]);
		$md5 = md5($hash);
		
		return $md5;
	}*/
	
	function create_password($password){
		
		$password = '((&876%!"·¿?!"·$'.$password.'12$&¿?3%%9&/';
		$base = base64_encode($password);
		$md5 = md5($base);
		$resultado = password_hash($md5, PASSWORD_DEFAULT);

		return $resultado;
	}

	function verify_password($password, $hash){
		
		$password = '((&876%!"·¿?!"·$'.$password.'12$&¿?3%%9&/';
		$base = base64_encode($password);
		$md5 = md5($base);

		if (password_verify($md5, $hash)) {
		    return 1;
		} else {
		    return 0;
		}
	}

	function queBrowserIE() {
	
		$user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';  
		
		if (strpos($user_agent, 'MSIE') !== false) {  
		   $browser = true; 
		} else {  
		   $browser = false;  
		}
		
		return $browser;

	}
	
	function html2txt($document){
		$search = array('@<script[^>]*?>.*?</script>@si',  // Strip out javascript
					   '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
					   '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
					   '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments including CDATA
		);
		$text = preg_replace($search, '', $document);
		return $text;
		}
	
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

	function download_file($archivo, $downloadfilename = null) {
		/*
		$downloadfilename = $downloadfilename !== null ? $downloadfilename : basename($archivo);
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename=' . $downloadfilename);
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header('Content-Length: ' . filesize($archivo));

		ob_clean();
		flush();
		readfile($archivo);
		exit;*/

		if (!file_exists($archivo))
        {
            return FALSE;
        }

        $downloadfilename = $downloadfilename !== null ? $downloadfilename : basename($archivo);
        // Grab the file extension
        $x = explode('.', $downloadfilename);
        $extension = end($x);

        // Set a default mime if we can't find it
        if ( ! isset($mimes[$extension]))
        {
            $mime = 'application/octet-stream';
        }
        else
        {
            $mime = (is_array($mimes[$extension])) ? $mimes[$extension][0] : $mimes[$extension];
        }

        // Generate the server headers
        if (strpos($_SERVER['HTTP_USER_AGENT'], "MSIE") !== FALSE)
        {
            header('Content-Type: "'.$mime.'"');
            header('Content-Disposition: attachment; filename="'.$downloadfilename.'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header("Content-Transfer-Encoding: binary");
            header('Pragma: public');
            header("Content-Length: ".filesize($archivo));
        }
        else
        {
            header('Content-Type: "'.$mime.'"');
            header('Content-Disposition: attachment; filename="'.$downloadfilename.'"');
            header("Content-Transfer-Encoding: binary");
            header('Expires: 0');
            header('Pragma: no-cache');
            header("Content-Length: ".filesize($archivo));
        }

        $this->readfile_chunked($archivo);
        die;
	}

	function readfile_chunked($file, $retbytes=TRUE)
    {
       $chunksize = 1 * (1024 * 1024);
       $buffer = '';
       $cnt =0;

       $handle = fopen($file, 'r');
       if ($handle === FALSE)
       {
           return FALSE;
       }

       while (!feof($handle))
       {
           $buffer = fread($handle, $chunksize);
           echo $buffer;
           ob_flush();
           flush();

           if ($retbytes)
           {
               $cnt += strlen($buffer);
           }
       }

       $status = fclose($handle);

       if ($retbytes AND $status)
       {
           return $cnt;
       }

       return $status;
    }

	function div_extracto ($contenido, $cantidadPalabras) {
		$contenido = explode(' ', $contenido);
		$contenido = array_slice($contenido, 0, $cantidadPalabras);
		$contenido = implode(' ', $contenido);
		return $contenido;
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

	function getmultimedia_documento($var) {
		/*
			1.- Multimedia
			2.- Archivos documentos
		*/
		$result = 1;

		$formatos = array(
		  'jpg' => '2',
		  'jpeg' => '2',
		  'gif' => '2',
		  'png' => '2',
		  'JPG' => '2',
		  'JPEG' => '2',
		  'GIF' => '2',
		  'PNG' => '2',

		  'mp3' => '4',
		  'midi' => '4',
		  'wma' => '4',
		  'ogg' => '4',
		  'wav' => '4',
		  'aac' => '4',
		  'MP3' => '4',
		  'MIDI' => '4',
		  'WMA' => '4',
		  'OGG' => '4',
		  'WAV' => '4',
		  'AAC' => '4',

		  'mp4' => '3',
		  'mov' => '3',
		  'flv' => '3',
		  'mkv' => '3',
		  'wmv' => '3',
		  'avi' => '3',
		  'mpg' => '3',
		  'MP4' => '3',
		  'MOV' => '3',
		  'FLV' => '3',
		  'MKV' => '3',
		  'WMV' => '3',
		  'AVI' => '3',
		  'MPG' => '3',

		  'doc' => '1',
		  'docx' => '1',
		  'xls' => '1',
		  'xlsx' => '1',
		  'ppt' => '1',
		  'pptx' => '1',
		  'txt' => '1',
		  'rar' => '1',
		  'zip' => '1',
		  'DOC' => '1',
		  'DOCX' => '1',
		  'XLS' => '1',
		  'XLSX' => '1',
		  'PPT' => '1',
		  'PPTX' => '1',
		  'TXT' => '1',
		  'RAR' => '1',
		  'ZIP' => '1'
	   );
	   foreach($formatos as $formato=>$valor){
		  if (eregi($formato, $var))
			 $result = $valor;
	   }
	   return $result ;
	}
	
	function cdetectUtf8($str){ 
		if( mb_detect_encoding($str,"UTF-8, ISO-8859-1")!="UTF-8" ){ 
		
			return  utf8_encode($str); 
			} 
		else{ 
			return $str; 
			} 
	
		}

	function getporcentaje($numero,$total){
		$porcentaje = ($numero * 100) / $total;
	    return $porcentaje;
	}

	function fb_fan_count($fb_page){
		$data = json_decode(file_get_contents('https://graph.facebook.com/'.$fb_page));
	//$datos= json_decode(file_get_contents('http://graph.facebook.com/?id='.$fb_page2));

		//$dato= ('http://graph.facebook.com/fql?q=SELECT%20friend_count%20FROM%20user%20WHERE%20uid%20=%20100001027712565');

		$resultados = array('nombre'=>$data->name, 'id'=>$data->id, 'visitas'=>$data->checkins, 'likes'=>$data->likes, 'hablando'=>$data->talking_about_count);
		return $resultados;

		}

	function FileSizeConvert($bytes)
	{
	    $bytes = floatval($bytes);
	        $arBytes = array(
	            0 => array(
	                "UNIT" => "TB",
	                "VALUE" => pow(1024, 4)
	            ),
	            1 => array(
	                "UNIT" => "GB",
	                "VALUE" => pow(1024, 3)
	            ),
	            2 => array(
	                "UNIT" => "MB",
	                "VALUE" => pow(1024, 2)
	            ),
	            3 => array(
	                "UNIT" => "KB",
	                "VALUE" => 1024
	            ),
	            4 => array(
	                "UNIT" => "B",
	                "VALUE" => 1
	            ),
	        );

	    foreach($arBytes as $arItem)
	    {
	        if($bytes >= $arItem["VALUE"])
	        {
	            $result = $bytes / $arItem["VALUE"];
	            $result = str_replace(",", "." , strval(round($result, 2)))." ".$arItem["UNIT"];
	            break;
	        }
	    }
	    return $result;
	}

	public function envio_correo($folio, $fecha, $correoDestinatario, $nombreDestinatario, $categoria, $descServ){

		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=utf-8\r\n";
		$headers .= "From: atc@demosistemas.com\r\n";
		// asunto del email
		$subject = "Notificación - Atención Ciudadana";					   
		// Cuerpo del mensaje

		$mensaje = '
		<!doctype html>
			<html>
				<head>
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
					<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
					<meta http-equiv="x-ua-compatible" content="ie=edge">
				</head>
				<body>
					<div id="contentCorreo" style="border: 2px solid #E9E9E9; border-radius: 0.4em; margin: 0.5em auto; padding: 1em; width: 50%; ">
						<img src="http://demosistemas.com/atencion_ciudadana/img/header_correo.png" style="width: 10em; float:left;" />
						<div style="margin-top: 1.5em; margin-right: 1em; text-align: right;"><br>'.$fecha.'<br></div>
						<br>
						<h1 class="text-center">Gracias por registrar su reporte.</h1>
						<div dir="messageBody">
							<p>Datos del Reporte:</p>
							Folio del reporte: <strong>'.$folio.'</strong><br>
							Nombre del solicitante: <strong>'.$nombreDestinatario.'</strong><br>
							Categoría: <strong>'.$categoria.'</strong><br>
							Reporte: <strong>'.$descServ.'</strong>
							
						</div>
						<p>Con tu folio podrás consultar el seguimiento de tu solicitud en la Aplicación Móvil de Inteligencia Urbana Ciudad 2.0</p>
						<p><strong>IMPORTANTE:</strong> Este correo ha sido generado automaticamente por el sistema y es de carácter informativo, favor de no responder.</p>
						<p style="text-align: center;"><a href="#" style="color: #71bf46; text-decoration: none; font-size: 1.3em;">demosistemas.com</a></p>
					</div>
				</body>
			</html>
		';
					
		$bool = mail($correoDestinatario, $subject, $mensaje, $headers);
		if(!$bool){
		    return false;
		}
		return true;
	}


	function wordTruncate($string, $limit, $break=" ", $pad="...") {
		// return with no change if string is shorter than $limit
		if(strlen($string) <= $limit)
		return $string;
		// is $break present between $limit and the end of the string?
		if(false !== ($breakpoint = strpos($string, $break, $limit))) {
			if($breakpoint < strlen($string) - 1) {
				$string = substr($string, 0, $breakpoint) . $pad;
			}
		}
		return $string;
	}

} //fin de la Clse Funciones

?>