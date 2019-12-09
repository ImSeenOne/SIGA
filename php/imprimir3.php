<?php
header('Content-type: application/pdf; charset=utf-8');
require 'inicializandoDatosExterno.php';
require_once '../vendor/autoload.php';
include_once("clase_querys3.php");
include_once("clase_funciones.php");
date_default_timezone_set('america/mexico_city');
require 'mpdf/mpdf.php';
$mpdf = new mPDF('utf-8', 'Letter');
$datos = array();
$jsondata = array();
$date = date('d/m/Y h:i:s A');
$querys3 = new Querys3();
switch($funciones->limpia($_GET['opcion'])){
    case 1:
        $strQuery = 'SELECT * FROM tblc_propiedades WHERE fecha_eliminado IS NULL AND id_propiedad ='.$_GET['idProperty'];
        $property = @$conexion->fetch_array($strQuery);

        $address = $property['direccion'].' '.$property['numero_exterior'].'; Edificio '.$property['numero_edificio'].', Nivel '.$property['numero_nivel'].', Departamento '.$property['numero_departamento'];
        $dvlpmt = @$conexion->fetch_array($querys3->getListadoDesarrollo($property['desarrollo']))['nombre'];
        $coordinates = 'https://www.google.com/maps/@'.$property['coordenadas'].',15z';
        $mainImg = @$conexion->fetch_array('SELECT imagen FROM tbl_propiedad_imagen WHERE fecha_eliminado IS NULL AND tipo = 1 AND id_propiedad = '.$property['id_propiedad'].';')['imagen'];
        $antiquity = @$conexion->fetch_array($querys3->getListadoAntiguedad($property['antiguedad']))['nombre'];
        $closet = @$conexion->fetch_array('SELECT * FROM tblc_closet WHERE fecha_eliminado IS NULL AND id_closet ='.$property['closet'])['nombre'];
        $cocina = @$conexion->fetch_array('SELECT * FROM tblc_cocina WHERE fecha_eliminado IS NULL AND id_cocina ='.$property['cocina'])['nombre'];
        $servicesArr = explode(',',$property['servicios_amenidades']);

        $titleAmount = ($property['id_tipo'] == 1) ? 'Monto de Venta:' : (($property['tipo'] == 2) ? 'Renta Mensual:' : '');

        foreach ($servicesArr as $key) {
          $services.= ' '.@$conexion->fetch_array('SELECT * FROM tblc_servicio_amenidad WHERE fecha_eliminado IS NULL AND id_servicio_amenidad = '.$key)['nombre'].' —';
        }

        $others1 = $property['otros1'];
        $others2 = $property['otros2'];

        $type = $property['id_tipo'];
        //--------------------------------------------------------------------------
        $mpdf->SetHTMLHeader('
          <table width="100%">
          <tr>
            <th class="fancy title4">
              Ficha Descriptiva
            </th>
            <th rowspan="6" style="width: 5%;"><img style="display:flex;align-items: center; width:100px" src="../img/LOGOASG_.png"/></th>
          </tr>
          </table>
        ');
        $mpdf->SetHTMLFooter('
        <table class="col-100">
          <tr>
            <th style="width: 33.33%" >&nbsp;</th>
            <th style="width: 33.33%" class="title2 text-center fancy">Quejas y sugerencias:</th>
            <th>&nbsp;</th>
          </tr>
          <tr class="col-100">
            <th style="width: 33.33%" class="pull-left title1 fancy warning">*El tanque de gas puede <br> no estar incluido</th>
            <th style="width: 33.33%" class="text-center title2 fancy-lot">inmobiliaria.asg@gmail.com</th>
            <th class="fancy title2 pull-right">{PAGENO}</th>
          </tr>
        </table>
        ');
        $mpdf->WriteHTML(file_get_contents('../css/pdf-styles.css'),1);
        $mpdf->WriteHTML('
                <br><br><br><br>
                <table>
                  <tr>
                    <td class="fancy title2 col-50 pull-left">Dirección:</td>
                  </tr>
                  <tr>
                    <th class="fancy col-100 text-center title2">'.$address.'</th>
                  </tr>
                  <br><br><br><br>
                  <tr>
                    <th class="col-100">
                    <img src="../'.$mainImg.'" class="main-img" style="margin-top: 25px;"></th>
                  </tr>
                  <tr>
                    <td class="col-100 fancy-lot text-center">
                      — '.$antiquity.' — '.$closet.' — '.$cocina.' —'.$services.'
                    </td>
                  </tr>
                  <br><br>
                  <tr>
                    <td class="col-100 pull-left title3 fancy-lot">
                      '.$titleAmount.'
                    </td>
                  </tr>
                  <tr>
                    <th class="col-100 text-center fancy important title4">
                      $'.number_format($property['monto'], 2).'
                    </th>
                  </tr>
                </table>
        ');
        $mpdf->AddPage();
        $imgs = @$conexion->obtenerlista('SELECT imagen FROM tbl_propiedad_imagen WHERE fecha_eliminado IS NULL AND tipo = 2 AND id_propiedad = '.$property['id_propiedad'].';');
        $counter = 0;
        if($conexion->numregistros() % 2 == 0){
          foreach ($img as $imgs) {
            $counter++;
            if($counter % 2 == 0){
              $listImg = '<tr>'.$listImg.'<th class="text-center col-50"><img src="../'.$img->imagen.'" style="margin-top: 25px;"></th></tr>';
            } else {
              $listImg.= '<th class="text-center col-50"> <img src="../'.$img->imagen.'" style="margin-top: 25px;> </th>';
            }
            $listImg.= $img->imagen;
          }
        } else {
          foreach ($img as $imgs) {
            $counter++;
            if($counter % 2 == 0){
              $listImg = '<tr>'.$listImg.'<th class="text-center col-50"><img src="../'.$img->imagen.'" style="margin-top: 25px;"></th></tr>';
            } else {
              if($counter == $conexion->numregistros()){
                $listImg.= '<tr><th class="text-center col-10"> <img src="../'.$img->imagen.'" style="margin-top: 25px;> </th></tr>';
              } else {
                $listImg.= '<th class="text-center col-50"> <img src="../'.$img->imagen.'" style="margin-top: 25px;> </th>';
              }
            }
            $listImg.= $img->imagen;
          }
        }

        $mpdf->WriteHTML('

        ');

        $mpdf->SetTitle('Propiedad '.$_GET['idProperty']);
        $mpdf->Output('propiedad'.$_GET['idProperty'].'.pdf', 'I');

    break;

}

function getMonth($date){
    $newDate = array();
    $dateAsInt = strtotime($date);
    $month = date("m", $dateAsInt);
    $day = date("d", $dateAsInt);
    $year = date("Y", $dateAsInt);
    $newDate[0] = $year;
    $newDate[2] = $day;
    switch($mes){
        case 1:
            $newDate[1] = "ENERO";
        break;
        case 2:
            $newDate[1] = "FEBRERO";
        break;
        case 3:
            $newDate[1] = "MARZO";
        break;
        case 4:
            $newDate[1] = "ABRIL";
        break;
        case 5:
            $newDate[1] = "MAYO";
        break;
        case 6:
            $newDate[1] = "JUNIO";
        break;
        case 7:
            $newDate[1] = "JULIO";
        break;
        case 8:
            $newDate[1] = "AGOSTO";
        break;
        case 9:
            $newDate[1] = "SEPTIEMBRE";
        break;
        case 10:
            $newDate[1] = "OCTUBRE";
        break;
        case 11:
            $newDate[1] = "NOVIEMBRE";
        break;
        case 12:
            $newDate[1] = "DICIEMBRE";
        break;
    }
    return $newDate;
}
//echo json_encode($jsondata);
?>
