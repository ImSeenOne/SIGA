<?php
  require '../php/inicializandoDatosExterno.php';
  $idInsFuelExpense = $_POST['id'];
  $listado = @$conexion->obtenerlista($querys3->getInsFuelExpEmployees($idInsFuelExpense));
  $totRegsM = $conexion->numregistros();
  if ($totRegsM > 0) {
?>
<table id="tableAssignedUsers" class="table table-striped table-bordered">
  <thead>
    <th>Empleado</th>
    <th>Litros</th>
    <th>Tipo de combustible</th>
    <th>Ubicación</th>
    <th>Tipo de vehículo</th>
  </thead>
  <tbody>
    <?php foreach ($listado as $key) {
    ?>
    <tr>
      <td style="overflow: hidden; text-overflow: ellipsis white-space: nowrap;">
        <?php
          $resp = @$conexion->fetch_array($querys3->getEmpleadosById($key->id_empleado));
          $nombre = $resp['nombre'];
          $apellidos = $resp['apellido_paterno'].' '.$resp['apellido_materno'];
          echo $nombre.' '.$apellidos;
        ?>
      </td>
      <td>
        <?= $key->litros ?>
      </td>
      <td>
        <?php
          switch ($key->tipo_combustible) {
            case 1:
              echo 'Magna';
            break;
            case 2:
            echo 'Premium';
            break;
            case 3:
            echo 'Diesel';
            break;
          }
        ?>
      </td>
      <td style="overflow: hidden; text-overflow: ellipsis white-space: nowrap;">
        <?=
          $key->ubicacion
         ?>
      </td>
      <td>
        <?php
          $resp = @$conexion->fetch_array($querys3->listMachineryTypes($key->tipo_vehiculo));
          echo $resp['nombre'];
        ?>
      </td>
    </tr>
    <?php
    } ?>
  </tbody>
</table>
<?php
} else {
?>
<center><h4>¡No hay empleados asignados para éste gasto!</h4></center>
<?php
}
?>
