<?php
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
  require '../php/inicializandoDatosExterno.php';
  $idInteres = $funciones->limpia($_POST['idInteres']);
  $listado = @$conexion->obtenerlista($querys->getDataServPVCte($idInteres));
  $totRegs = $conexion->numregistros();
  $aMotivos = array(1 => 'Reparación', 2 => 'Quejas', 3 => 'Otros');  
  $aEstatus = array(1 => 'Revisión', 2 => 'Proceso', 3 => 'Terminado');

  if($totRegs > 0){
?>
<style type="text/css">
  .aling-vertica-middle{vertical-align:middle!important;}
  .pt_2em{padding-top:2em!important;}
  .colorAutorizado{color:#48b147!important;}
  .colorNoAutorizado{color:#ff0000!important;}
  .cntnObservaciones{border:1px solid #e9e9e9!important;border-radius:0.4em!important;background-color:#e9e9e9;padding:0.3em 0.6em!important;text-align:left!important;}
</style>
<table id="listadoServPV<?= $idInteres; ?>" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th class="text-center" style="width:25%;">Info</th>       
      <th class="text-center" style="width:25%;">Descripción</th>     
      <th class="text-center" style="width:15%;">Fecha</th>
      <th class="text-center" style="width:15%;">Fecha termino</th>
      <th class="text-center" style="width:20%;">Acción</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($listado as $key) {
      $fechaTermino = (!is_null($key->fecha_termino))? $funciones->fecha4($key->fecha_termino):'--';
  ?>
    <tr>
      <td class="text-left aling-vertica-middle pt_2em">
        <p><strong>ID:</strong> <cite><?= $key->id_servicio_posventa; ?></cite></p>
        <p class="mg-1em"><strong>MOTIVO:</strong> <cite><?= $aMotivos[$key->motivo]; ?></cite></p>
        <p class="mg-1em"><strong>ESTATUS:</strong> <cite><?= $aEstatus[$key->estatus]; ?></cite></p>
      </td>      
      <td class="text-left aling-vertica-middle"><?= $key->descripcion ?></td>
      <td class="text-center aling-vertica-middle"><?= $funciones->fecha4($key->fecha_captura) ?></td>
      <td class="text-center aling-vertica-middle"><?= $fechaTermino ?></td>
      <td class="text-center aling-vertica-middle">
        <button type="button" class="btn btn-success btn-sm" onclick="editarServPV(<?= $key->id_servicio_posventa ?>);"><i class="fa fa-edit"></i></button>
        <button type="button" class="btn btn-danger btn-sm" onclick="eliminarServPV(<?= $key->id_servicio_posventa ?>, '<?= $aMotivos[$key->motivo] ?>');"><i class="fa fa-trash"></i></button>
      </td>
    </tr>
  <?php } ?>
  </tbody>
  <tfoot>
      <th class="text-center">Info</th>       
      <th class="text-center">Descripción</th>     
      <th class="text-center">Fecha</th>
      <th class="text-center">Fecha termino</th>
      <th class="text-center">Acción</th>
  </tfoot>                
</table>
<?php }else{ ?>
  <center><h4>¡No existen registros!</h4></center>
<?php } ?>