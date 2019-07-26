<?php
  require '../php/inicializandoDatosExterno.php';
  $listado = @$conexion->obtenerlista($querys3->searchAdmPayments());
  $totRegs = $conexion->numregistros();
  if($totRegs > 0){
 ?>
<div class="container col-lg-12 col-md-12 col-sm-12">
  <table id="listAdmPayments" name="listAdmPayments" class="table table-bordered table-striped">
    <thead>
      <th class="col">Empleado</th>
      <th class="col">Monto</th>
      <th class="col">Período</th>
      <th class="col">Status</th>
    </thead>
    <tbody>
      <?php foreach ($listado as $key) { ?>
        <tr>
          <td>
            <?php
              $resp = @$conexion->fetch_array($querys3->getEmpleadosById($key->id_empleado));
              $nombre = $resp['nombre'];
              $apellidos = $resp['apellido_paterno'].' '.$resp['apellido_materno'];
              echo $nombre.' '.$apellidos;
            ?>
          </td>
          <td>$<?= number_format($key->total_nomina,2) ?></td>
          <td><?= $key->fecha_inicio ?> a <?= $key->fecha_finalizacion ?></td>
          <td>
            <?php
              switch ($key->status) {
                case 1:
                  echo "Pagado";
                break;
                case 2:
                echo "Pendiente";
                break;

                case 3:
                echo "Cancelado";
                break;
              }
            ?>
          </td>
        </tr>
      <?php } ?>
    </tbody>
    <tfoot>
      <th class="col">Empleado</th>
      <th class="col">Monto</th>
      <th class="col">Período</th>
      <th class="col">Status</th>
    </tfoot>
  </table>
</div>
<?php }else{ ?>
  <center><h4>¡No se encontraron registros!</h4></center>
<?php } ?>
