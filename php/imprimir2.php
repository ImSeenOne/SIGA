<?php
header('Content-type: application/pdf; charset=utf-8');
require 'inicializandoDatosExterno2.php';
require_once '../vendor/autoload.php';
date_default_timezone_set('america/mexico_city');
$mpdf = new \Mpdf\Mpdf([
    'mode' => 'utf-8',
    'format' => 'Letter',
    'orientation' => 'L',
    'margin_top' => 38,
    'default_font_size' => 9
]);

$datos = array(); $jsondata = array();
$date = date('d/m/Y h:i:s A');
switch($_GET['opcion']){
    case 1:
        $strQuery = "SELECT * FROM vw_CobrosVista ";
        $strQuery .= "WHERE id_propiedad =". $_GET['idProperty'].";";
        $datos = @$conexion->fetch_array($strQuery);
        $fechas = NombreMes($datos["fecha_pago2"]);

        $strQuery = "SELECT * FROM vw_Cobros WHERE id_propiedad=".$datos["id_propiedad"].";";
        $datosP = @$conexionB->fetch_array($strQuery);
        $mpdf->SetHTMLHeader(
            '<table width="100%" >
            <tr>
            <th style="font-size:14px">GRUPO INMOBILIARIA AGUILERA SOLIS</th>
            <th rowspan="6"><img style="display:flex;align-items: center; width:100px" src="../img/LOGOASG2_.png"/></th>
            </tr>
            <tr>
            <th style="font-size:14px">SUC. CARRETERA TUXTLA-CHICOASEN KM. 2.5</th>
            </tr>
            <tr>
            <th style="font-size:14px">COLONIA SAN JOSE YEGUISTE, TUXTLA GUTIERREZ, CHIAPAS CP. 29025</th>
            </tr>
            <tr>
            <th style="font-size:11px">TEL: (961) 615 11 98 Ext. 105, (961) 117 6429, (961) 236 09 69</th>
            </tr>
            <tr>
            <th style="font-size:11px">E-MAIL: inmobiliaria.asg@gmail.com, MANTENIMIENTO: mantenimiento.asg@gmail.com</th>
            </tr>
            <tr>
            <td style="font-size:8px; text-align: lefth;">Fecha de Impresión:'.$date.'</td>
            </tr>
            </table>'
        );
        $mpdf->WriteHTML(
            '<p style="text-align: right;">TUXTLA GUTIEREZ, CHIAPAS, <u>'.$fechas[2] . ' DE ' . $fechas[1] . " DE " . $fechas[0] .'</u></p>
            <p style="text-align: justify; width:100%;">RECIBI DE&nbsp;&nbsp; <u>&nbsp;&nbsp;&nbsp;'. $datos["nombre"].'&nbsp;&nbsp;&nbsp;</u>&nbsp;&nbsp;LA CANTIDAD DE $&nbsp;&nbsp;<u>&nbsp;&nbsp;&nbsp;'.$datos["pago"].'&nbsp;&nbsp;&nbsp;</u>,&nbsp;&nbsp;&nbsp; EN EFECTIVO
            POR CONCEPTO DE PAGO DEL MES DE:&nbsp;&nbsp;<u>&nbsp;&nbsp;&nbsp;'. $fechas[1] . '&nbsp;&nbsp;&nbsp;</u>
            POR ARRENDAMIENTO DE LA VIVIENDA EN:&nbsp;&nbsp;&nbsp;<u>&nbsp;&nbsp;&nbsp;EDIFICIO &nbsp;&nbsp;&nbsp;'.
            $datosP["numero_edificio"].'&nbsp;&nbsp;&nbsp;NIVEL&nbsp;&nbsp;&nbsp;'.
            $datosP["nivel"].'&nbsp;&nbsp;&nbsp; DEPARTAMENTO &nbsp;&nbsp;&nbsp;'.
            $datosP["numero_departamento"].'&nbsp;&nbsp;&nbsp;</u>&nbsp;&nbsp;&nbsp;FRACCIONAMIENTO&nbsp;&nbsp;&nbsp;
            <u>&nbsp;&nbsp;&nbsp;'. $datosP["desarrollo"].'&nbsp;&nbsp;&nbsp;,</u>TUXTLA GUTIERREZ, CHIAPAS.</p>
            <br><br><br>
            <span><p style="text-align: left;">FIRMA DEL CLIENTES:<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></p></span>'
        );
        $mpdf->Output();

    break;

}

function NombreMes($fecha){
    $arrayFecha = array();
    $fechaComoEntero = strtotime($fecha);
    $mes = date("m", $fechaComoEntero);
    $dia = date("d", $fechaComoEntero);
    $anio = date("Y", $fechaComoEntero);
    $arrayFecha[0] = $anio;
    $arrayFecha[2] = $dia;
    switch($mes){
        case 1:
            $arrayFecha[1] = "ENERO";
        break;
        case 2:
            $arrayFecha[1] = "FEBRERO";
        break;
        case 3:
            $arrayFecha[1] = "MARZO";
        break;
        case 4:
            $arrayFecha[1] = "ABRIL";
        break;
        case 5:
            $arrayFecha[1] = "MAYO";
        break;
        case 6:
            $arrayFecha[1] = "JUNIO";
        break;
        case 7:
            $arrayFecha[1] = "JULIO";
        break;
        case 8:
            $arrayFecha[1] = "AGOSTO";
        break;
        case 9:
            $arrayFecha[1] = "SEPTIEMBRE";
        break;
        case 10:
            $arrayFecha[1] = "OCTUBRE";
        break;
        case 11:
            $arrayFecha[1] = "NOVIEMBRE";
        break;
        case 12:
            $arrayFecha[1] = "DICIEMBRE";
        break;
    }
    return $arrayFecha;
}
//echo json_encode($jsondata);
?>
