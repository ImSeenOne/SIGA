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
    <th>Vehículo</th>
    <th>Fecha Asignación</th>
    <th>Kilometraje</th>
    <th>Acción</th>
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
          $resp = @$conexion->fetch_array($querys3->listMachineryAndVehicles($key->tipo_vehiculo));
          echo $resp['valor'];
        ?>
      </td>
      <td><?= date('d/m/Y', strtotime($key->fecha_asignacion)) ?></td>
      <td><?= number_format($key->kilometraje, 0) ?></td>
      <td> <button type="button" class="btn btn-danger btn-sm" onclick="deleteInsFuelExpEmp(<?= $key->id_gas_int_empl ?>, '<?= $nombre.' '.$apellidos ?>')"> <i class="fa fa-trash"></i> </button> </td>
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
