<?php
header('Content-type: application/pdf; charset=utf-8');
require 'inicializandoDatosExterno.php';
require_once '../vendor/autoload.php';
include_once("clase_querys3.php");
include_once("clase_funciones.php");
date_default_timezone_set('america/mexico_city');
require 'mpdf/mpdf.php';
$datos = array();
$jsondata = array();
$date = date('d/m/Y h:i:s A');
$querys3 = new Querys3();

switch($funciones->limpia($_GET['opcion'])){
    case 1:
        $mpdf = new mPDF('utf-8', 'Letter', '', '', '15', '15', '35', '30', '8', '8', 'P');
        $mpdf->WriteHTML(file_get_contents('../css/pdf-styles.css'),1);
        $strQuery = 'SELECT * FROM tblc_propiedades WHERE fecha_eliminado IS NULL AND id_propiedad ='.$_GET['id'];
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

        $mpdf->WriteHTML('
                <table>
                  <tr>
                    <td class="fancy title2 col-50 pull-left">Dirección:</td>
                  </tr>
                  <tr>
                    <th class="fancy col-100 text-center title2">'.$address.'</th>
                  </tr>
                  <tr>
                    <th class="col-100">
                    <img src="../'.$mainImg.'" class="main-img" style="margin-top: 25px;"></th>
                  </tr>
                  <tr>
                    <td class="col-100 fancy-lot text-center">
                      — '.$antiquity.' — '.$closet.' — '.$cocina.' —'.$services.'
                    </td>
                  </tr>
                  <br>
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
        // $mpdf->WriteHTML('<br><br><br><br>');
        $imgs = @$conexion->obtenerlista('SELECT imagen FROM tbl_propiedad_imagen WHERE fecha_eliminado IS NULL AND tipo = 0 AND id_propiedad = '.$property['id_propiedad'].';');
        $rows = $conexion->numregistros();
        $listImg = '';
        foreach ($imgs as $img) {
          $listImg.='<img src="../'.$img->imagen.'" class="secondary-img col-50">';
        }

        $mpdf->WriteHTML(/*'<table> <thead><th>&nbsp;</th><th>&nbsp;</th></thead><tbody>'.*/$listImg/*.'</tbody></table>'*/);
        $mpdf->setAutoBottomMargin = 'stretch';
        $mpdf->SetTitle('Propiedad '.$_GET['id']);
        $mpdf->Output('propiedad'.$_GET['id'].'.pdf', 'I');
    break;
    //ORDENES DE COMPRA
    case 2:
      $mpdf = new mPDF('utf-8', 'Letter', '', '', '15', '15', '55', '40', '9', '9', 'P');
      $mpdf->WriteHTML(file_get_contents('../css/pdf-styles.css'),1);
      $strQuery = 'SELECT * FROM tbl_artculo_compra WHERE fecha_eliminado IS NULL AND id_orden_compra = '.$_GET['id'];
      $concepts = @$conexion->obtenerlista($strQuery);
      $html = '';
      foreach ($concepts as $concept) {
        $html.= '<tr>';
        $html.= '<td class="fancy">'.number_format($concept->cantidad, 2).'</td>';
        $html.= '<td class="fancy">'.$concept->unidad.'</td>';
        $respC = @$conexion->fetch_array('SELECT * FROM tbl_explosion_insumos WHERE fecha_eliminado IS NULL AND id_exposion_insumos = '.$concept->id_explosion_insumos);
        $html.= '<td class="fancy">'.$respC['concepto'].'</td>';
        $html.= '<td class="fancy">$'.number_format($respC['precio_unitario'], 2).'</td>';
        $html.= '<td class="fancy">$'.number_format($concept->cantidad * $respC['precio_unitario'], 2).'</td>';
        $html.= '</tr>';
      }
      $mpdf->SetHTMLHeader('
        <h1 class="fancy-lot text-center">Ing. Francisco Aguilera Gómez</h1>
        <h2 class="fancy text-center">RFC AUGF-901221-E86</h2>
        <h4 class="fancy text-center">Calle Río Balsas #101 Interior 2A Col. Cuauhtémoc Delegación Cuauhtémoc</h3>
        <h4 class="fancy text-center">Ciudad de México CP 06500 Email: facturacion_aguilera@outlook.com</h3>
      ');
      $mpdf->SetHTMLFooter('
      <table class="col-100">
        <tr class="col-100">
          <td colspan="2" class="fancy text-center title2">Solicitó: área de compras</td>
        </tr>
        <tr class="col-100">
          <td class="fancy warning title2 pull-left col-25" style="font-size: 12px;">Nota: Sr. proveedor, al elaborar su factura anotar el número de nuestro vale</td>
          <td class="fancy warning pull-right col-25" style="font-size: 12px;">Para el pago de su factura favor de traer el PDF y XML impresos.</td>
        </tr>
      </table>
      ');
      $strQuery = 'SELECT * FROM tbl_orden_compra WHERE fecha_eliminado IS NULL AND id_orden_compra = '.$_GET['id'];
      $resp = @$conexion->fetch_array($strQuery);
      $provider = @$conexion->fetch_array('SELECT * FROM tblc_proveedor WHERE fecha_eliminado IS NULL')['nombre'];
      $buyingOrder = '
      <div class="fancy danger title2" style="margin-left: 500px;"><b>Folio:</b>&nbsp;&nbsp;'.$resp['folio'].'</div>
      <div class="pull-left fancy" style="margin-left: 73px;">
        <b>Vale a:</b>&nbsp;&nbsp;'.$provider.'<br>
        <b>Fecha:</b>&nbsp;&nbsp;'.date('d/m/Y', strtotime($resp['fecha_captura'])).'<br>
        <b>Obra:</b>&nbsp;&nbsp;'.@$conexion->fetch_array($querys3->getListadoObras($resp->id_obra))['nombre'].'
      </div>
      ';
      $mpdf->setAutoTopMargin = 'stretch';
      $mpdf->WriteHTML('
      <body>
      '.$buyingOrder.'
      <div class="table-wrapper">
        <table class="fl-table">
          <thead>
            <tr>
              <th class="fancy">Cantidad</th>
              <th class="fancy">Unidad</th>
              <th class="fancy">Concepto</th>
              <th class="fancy">P. U.</th>
              <th class="fancy">Importe</th>
            </tr>
          </thead>
          <tbody>
          '.$html.'
          </tbody>
        </table>
      </div>
      </body>
      ');
      $mpdf->Output('orden-compra'.$_GET['id'].'.pdf', 'I');
    break;

    case 3:
      $mpdf = new mPDF('utf-8', 'Letter', '', '', '15', '15', '55', '40', '9', '9', 'P');
      $mpdf->WriteHTML(file_get_contents('../css/pdf-styles.css'),1);
      $mpdf->SetHTMLHeader('
      <table width="100%">
      <tr>
        <th class="fancy title4">
          Reporte de Clientes Morosos
        </th>
        <th rowspan="6" style="width: 5%;"><img style="display:flex;align-items: center; width:100px" src="../img/LOGOASG_.png"/></th>
      </tr>
      </table>
      ');
      $strQuery = 'SELECT * FROM tbl_calendarizado_detalle WHERE fecha_moroso <= NOW();';
      $clients = @$conexion->obtenerlista($strQuery);
      $totRegs = $conexion->numregistros();
      $html = '';
      if($totRegs > 0){
        foreach ($clients as $key) {
          $resp = @$conexion->fetch_array('SELECT * FROM tbl_calendarizado WHERE id_calendarizado = '.$key->id_calendarizado);
          $resp = @$conexion->fetch_array($querys3->getContracts($resp['id_contrato']));
          $resp = @$conexion->fetch_array($querys3->listClientes($resp['id_cliente']));
          $html = '
            <tr>
              <td class="fancy">
                '.$resp['nombre'].' '.$resp['apellido_p'].' '.$resp['apellido_m'].'
              </td>
              <td class="fancy pull-right">$'.number_format($key->monto, 2).'</td>
              <td class="fancy">'.$key->no_pago.'</td>
              <td class="fancy">
                '.date("d/m/Y", strtotime($key->fecha_programada)).'
              </td>
              <td class="fancy">
                '.date("d/m/Y", strtotime($key->fecha_moroso)).'
              </td>
            </tr>
          ';
        }
        $mpdf->WriteHTML('
        <body>
          <div class="table-wrapper">
            <table class="fl-table">
              <thead>
                <tr>
                  <th class="fancy">Cliente</th>
                  <th class="pull-right fancy">Monto</th>
                  <th class="fancy">Nro. Pago</th>
                  <th class="fancy">Fecha</th>
                  <th class="fancy">Fecha Moroso</th>
                </tr>
              </thead>
              <tbody>
              '.$html.'
              </tbody>
            </table>
          </div>
        </body>
        ');
      } else {
        $html = '<center><h4 class="fancy danger title4">Clientes morosos inexistentes</h4></center>';
        $mpdf->WriteHTML($html);
      }
      $mpdf->Output('clientes-morosos.pdf', 'I');
    break;

}

// function getMonth($date){
//     $newDate = array();
//     $dateAsInt = strtotime($date);
//     $month = date("m", $dateAsInt);
//     $day = date("d", $dateAsInt);
//     $year = date("Y", $dateAsInt);
//     $newDate[0] = $year;
//     $newDate[2] = $day;
//     switch($mes){
//         case 1:
//             $newDate[1] = "ENERO";
//         break;
//         case 2:
//             $newDate[1] = "FEBRERO";
//         break;
//         case 3:
//             $newDate[1] = "MARZO";
//         break;
//         case 4:
//             $newDate[1] = "ABRIL";
//         break;
//         case 5:
//             $newDate[1] = "MAYO";
//         break;
//         case 6:
//             $newDate[1] = "JUNIO";
//         break;
//         case 7:
//             $newDate[1] = "JULIO";
//         break;
//         case 8:
//             $newDate[1] = "AGOSTO";
//         break;
//         case 9:
//             $newDate[1] = "SEPTIEMBRE";
//         break;
//         case 10:
//             $newDate[1] = "OCTUBRE";
//         break;
//         case 11:
//             $newDate[1] = "NOVIEMBRE";
//         break;
//         case 12:
//             $newDate[1] = "DICIEMBRE";
//         break;
//     }
//     return $newDate;
// }
//echo json_encode($jsondata);
?>
