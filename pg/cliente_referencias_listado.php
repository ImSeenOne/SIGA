<?php
  require '../php/inicializandoDatosExterno.php';
  $id      = $funciones->limpia($_POST['id']);
  $listado = @$conexion->obtenerlista($querys->getListadoReferenciasCte($id));
  $totRegs = $conexion->numregistros();
  $aTipo = array(1 => 'Principal', 2 => 'Normal');

  if($totRegs > 0){
?>
<table id="listadoRefenciasCliente" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th class="text-left">Nombre</th>
      <th class="text-center">Tipo</th>
      <th class="text-center">Teléfono</th>
      <th class="text-center">Fecha registro</th>
      <th class="text-center">Acción</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($listado as $key) { ?>
    <tr>
      <td class="text-left"><?= $key->nombre.' '.$key->apellido_p.' '.$key->apellido_m ?></td>
      <td class="text-center"><?= $aTipo[$key->id_tipo] ?></td>
      <td class="text-center"><?= $key->telefono ?></td>
      <td class="text-center"><?= $funciones->ordenaFechaHora($key->fecha_registro) ?></td>
      <td class="text-center">
        <button type="button" class="btn btn-success btn-sm" onclick="editarRefCte(<?= $id ?>, <?= $key->id_referencia ?>);"><i class="fa fa-edit"></i></button>
        <button type="button" class="btn btn-danger btn-sm" onclick="eliminarRefCte(<?= $key->id_referencia ?>, '<?= $key->nombre.' '.$key->apellido_p.' '.$key->apellido_m ?>');"><i class="fa fa-trash"></i></button>
      </td>
    </tr>
  <?php } ?>
  </tbody>
  <tfoot>
    <th class="text-left">Nombre</th>
    <th class="text-center">Tipo</th>
    <th class="text-center">Teléfono</th>
    <th class="text-center">Fecha registro</th>
    <th class="text-center">Acción</th>
  </tfoot>                
</table>
<?php }else{ ?>
  <center><h4>¡No existen registros!</h4></center>
<?php } ?>