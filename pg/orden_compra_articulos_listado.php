<?php
  require '../php/inicializandoDatosExterno.php';
  $idOrdenComp      = $funciones->limpia($_POST['idOrdenComp']);  
  $listado = @$conexion->obtenerlista($querys->articulosListado($idOrdenComp));
  $totRegs = $conexion->numregistros(); $montoTotal = 0;

  if($totRegs > 0){
?>
<table id="listadoOrdCompArticulos" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th class="text-left">Artículo</th>
      <th class="text-center">Unidad</th>
      <th class="text-center">Cantidad</th>
      <th class="text-center">Monto</th>      
      <th class="text-center">Acción</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($listado as $key) {
    $montoTotal+= $key->monto;
  ?>
    <tr>
      <td class="text-left"><?= $key->articulo ?></td>
      <td class="text-center"><?= $key->unidad ?></td>
      <td class="text-right"><?= number_format($key->cantidad, 0) ?></td>
      <td class="text-right">$<?= number_format($key->monto, 2) ?></td>
      <td class="text-center">
        <button type="button" class="btn btn-success btn-sm" onclick="editarArticulo(<?= $idOrdenComp ?>, <?= $key->id_articulo_compra ?>);"><i class="fa fa-edit"></i></button>
        <button type="button" class="btn btn-danger btn-sm" onclick="eliminarArticulo(<?= $key->id_articulo_compra ?>, '<?= $key->articulo ?>');"><i class="fa fa-trash"></i></button>
      </td>
    </tr>
  <?php } ?>
  </tbody>
  <tfoot>
    <th class="text-left">&nbsp;</th>
    <th class="text-center">&nbsp;</th>
    <th class="text-center">&nbsp;</th>
    <th class="text-right">$<?= number_format($montoTotal, 2) ?></th>      
    <th class="text-center">&nbsp;</th>
  </tfoot>                
</table>
<?php }else{ ?>
  <center><h4>¡No existen registros!</h4></center>
<?php } ?>