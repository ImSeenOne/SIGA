<?php
  require '../php/inicializandoDatosExterno.php';

  $listado = @$conexion->obtenerlista($querys->getListadoEstacionamiento());
  $totRegs = $conexion->numregistros();

  if($totRegs > 0){
?>
<table id="listEstacionamiento" class="table table-bordered table-striped">
  <thead>
    <tr>
      <th class="text-center" style="width:10%;">Id</th>
      <th class="text-left" style="width:30%;">Nombre</th>
      <th class="text-center" style="width:10%;">Icono</th>
      <th class="text-left" style="width:20%;">Fecha registro</th>
      <th class="text-center" style="width:20%;">Acciones</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($listado as $key) { ?>
    <tr>
      <td class="text-center"><?= $key->id_estacionamiento ?></td>
      <td class="text-left"><?= $key->nombre ?></td>
      <td class="text-center"><img src="<?= $key->icono ?>" class="iconSize" /></td>
      <td class="text-center"><?= $funciones->ordenaFechaHora($key->fecha_registro); ?></td>
      <td class="text-center">
       	<button type="button" class="btn btn-success btn-sm" onclick="editarRegEstacionamiento(<?= $key->id_estacionamiento ?>);"><i class="fa fa-edit"></i></button>
       	<button type="button" class="btn btn-danger btn-sm" onclick="eliminarRegEstacionamiento(<?= $key->id_estacionamiento ?>, '<?= $key->icono ?>', '<?= $key->nombre ?>');"><i class="fa fa-trash"></i></button>
      </td>
    </tr>
  <?php } ?>
  </tbody>
  <tfoot>
    <tr>
      <th class="text-center">Id</th>
      <th class="text-center">Nombre</th>
      <th class="text-center">Icono</th>
      <th class="text-center">Fecha registro</th>
      <th class="text-center">Acciones</th>
    </tr>
  </tfoot>
</table>
<?php }else{ ?>
  <center><h4>¡No existen registros!</h4></center>
<?php } ?>
