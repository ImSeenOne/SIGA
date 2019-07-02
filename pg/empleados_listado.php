<?php
  require '../php/inicializandoDatosExterno.php';

  $nombre = $funciones->limpia($_POST["txtEmployee"]);
  $rfc = $funciones->limpia($_POST["txtSS"]);
  $imss = $funciones->limpia($_POST["txtRFC"]);

  $listado = @$conexion->obtenerlista($querys3->getListadoEmpleados($nombre, $rfc, $imss));
  $totRegs = $conexion->numregistros();
  if($totRegs > 0){
 ?>
<div class="container col-lg-12 col-md-12 col-sm-12">
  <table id="employees_list" name="employees_list" class="table table-bordered table-striped">
    <thead>
      <th class="col">Nombre</th>
      <th class="col">RFC</th>
      <th class="col">Tipo</th>
      <th class="col">IMSS</th>
      <th class="col">Acciones</th>
    </thead>
    <tbody>
      <?php foreach ($listado as $key) { ?>
        <tr>
          <td><?= $key->nombre ?></td>
          <td><?= $key->rfc ?></td>
          <td><?= $key->tipo ?></td>
          <td><?= $key->imss ?></td>
          <td>
            <button type="button" class="btn btn-success btn-sm" name="editEmployee" onclick="editEmployee(<?= $key->id_empleado ?>)"><i class="fa fa-edit"></i></button>
            <button class="btn btn-danger btn-sm" name="deleteEmployee" onclick="deleteEmployee(<?= $key->id_empleado ?>, '<?= $key->nombre ?>')"><i class="fa fa-trash"></i></button>
          </td>
        </tr>
      <?php } ?>
    </tbody>
    <tfoot>
      <th class="col">Nombre</th>
      <th class="col">RFC</th>
      <th class="col">Tipo</th>
      <th class="col">IMSS</th>
      <th class="col">Acciones</th>
    </tfoot>
  </table>
</div>
<?php }else{ ?>
  <center><h4>¡No se encontraron registros!</h4></center>
<?php } ?>
