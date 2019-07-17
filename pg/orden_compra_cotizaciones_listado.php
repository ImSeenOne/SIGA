<?php
  require '../php/inicializandoDatosExterno.php';
  $idOrdenComp      = $funciones->limpia($_POST['idOrdenComp']);
  $flagAutorizado = $conexion->fetch_array($querys->validaAutorizacionCotiz($idOrdenComp));
  $listado = @$conexion->obtenerlista($querys->getCotizaciones($idOrdenComp));
  $totRegs = $conexion->numregistros(); $montoTotal = 0;
  $aAutorizado  = array(0 => 'fa fa-times', 1 => 'fa fa-check');
  $bgRowAoturizada = '';

  $aColorEstAut = array(0 => 'colorNoAutorizado', 1 => 'colorAutorizado');

  if($totRegs > 0){
?>
<style type="text/css">
  .aling-vertica-middle{vertical-align:middle!important;}
  .pt_2em{padding-top:2em!important;}
  .colorAutorizado{color:#48b147!important;}
  .colorNoAutorizado{color:#ff0000!important;}
  .cntnObservaciones{border:1px solid #e9e9e9!important;border-radius:0.4em!important;background-color:#e9e9e9;padding:0.3em 0.6em!important;text-align:left!important;}
</style>
<table id="listadoOrdCompCotizaciones" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th class="text-left" style="width:25%;">Info</th>      
      <th class="text-center" style="width:15%;">Monto</th>
      <th class="text-center" style="width:10%;">Autorizada</th>     
      <th class="text-center" style="width:20%;">Observaciones</th>
      <th class="text-center" style="width:10%;">Fecha</th>
      <th class="text-center" style="width:20%;">Acción</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($listado as $key) {
      $observaciones = (!is_null($key->observaciones))? $key->observaciones:'Sin observaciones';      
      $bgRowAoturizada = ($key->autorizado == 1)? '#f5f5f5':'transparent';
  ?>
    <tr style="background-color:<?= $bgRowAoturizada ?>!important;">
      <td class="text-left aling-vertica-middle pt_2em">
        <p class="mg-1em"><label>PROVEEDOR:</label> <strong><cite><?= $key->id_proveedor ?></cite></strong></p>
        <p class="mg-1em"><label>NUM. CUENTA:</label> <?= $key->num_cuenta ?></p>
        <p class="mg-1em"><label>ARCHIVO COTIZACIÓN:&nbsp;&nbsp;</label><?php if(!is_null($key->archivo) && $key->archivo != ''){ ?><a href="<?= $key->archivo ?>"><i class="fa fa-files-o"></i></a><?php } ?></p>
      </td>
      <td class="text-right aling-vertica-middle">$<?= number_format($key->monto, 2) ?></td>
      <td class="text-center aling-vertica-middle"><i class="<?= $aAutorizado[$key->autorizado].' '.$aColorEstAut[$key->autorizado] ?>"></i></td>
      <td class="text-left aling-vertica-middle"><?= $observaciones ?></td>
      <td class="text-center aling-vertica-middle"><?= $funciones->ordenaFechaHora($key->fecha_registro) ?></td>
      <td class="text-center aling-vertica-middle">
        <?php if($flagAutorizado['totAut'] == 0){ ?>
          <button type="button" class="btn btn-warning btn-sm" onclick="autorizaCotizacion(<?= $key->id_cotizacion ?>);" title="Autozar cotización"><i class="fa fa-check"></i></button>
        <?php } ?>
        <button type="button" class="btn btn-success btn-sm" onclick="editarCotizacion(<?= $idOrdenComp ?>, <?= $key->id_cotizacion ?>);"><i class="fa fa-edit"></i></button>
        <button type="button" class="btn btn-danger btn-sm" onclick="eliminarCotizacion(<?= $key->id_cotizacion ?>, '<?= $key->id_proveedor ?>');"><i class="fa fa-trash"></i></button>
      </td>
    </tr>
  <?php } ?>
  </tbody>
  <tfoot>
    <th class="text-left" >Info</th>      
    <th class="text-center" >Monto</th>
    <th class="text-center" >Autorizada</th>     
    <th class="text-center" >Observaciones</th>
    <th class="text-center" >Fecha</th>
    <th class="text-center" >Acción</th>
  </tfoot>                
</table>
<?php }else{ ?>
  <center><h4>¡No existen registros!</h4></center>
<?php } ?>