<?php
  require '../php/inicializandoDatosExterno.php';
  $id      = $funciones->limpia($_POST['id']);
  $listado = @$conexion->obtenerlista($querys->getArchivosClientesListado($id));
  $totRegs = $conexion->numregistros();

  if($totRegs > 0){
?>
<table id="listadoArchivosCliente" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th class="text-center">Id</th>
      <th class="text-left">Archivo</th>
      <th class="text-left">Descripción</th>
      <th class="text-center">Fecha registro</th>
      <th class="text-center">Acción</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($listado as $key) { ?>
    <tr>
      <td class="text-center"><?= $key->id_archivo ?></td>
      <td class="text-center"><a href="<?= $key->ruta_archivo ?>" target="_blank"><i class="fa fa-file-text-o"></i></a></td>
      <td class="text-left"><?= $key->descripcion ?></td>
      <td class="text-center"><?= $funciones->ordenaFechaHora($key->fecha_registro) ?></td>
      <td class="text-center">
        <button type="button" class="btn btn-success btn-sm" onclick="editarArchivoCte(<?= $id ?>, <?= $key->id_archivo ?>);"><i class="fa fa-edit"></i></button>
        <button type="button" class="btn btn-danger btn-sm" onclick="eliminarArchivoCte(<?= $key->id_archivo ?>, '<?= $key->descripcion ?>');"><i class="fa fa-trash"></i></button>
      </td>
    </tr>
  <?php } ?>
  </tbody>
  <tfoot>
    <th>Id</th>
    <th>Archivo</th>
    <th>Descripción</th>
    <th>Fecha registro</th>
    <th>Acción</th>
  </tfoot>                
</table>
<?php }else{ ?>
  <center><h4>¡No existen registros!</h4></center>
<?php } ?>