<?php
  require '../php/inicializandoDatosExterno.php';
  $listado = @$conexion->obtenerlista($querys3->searchPayments());
  $totRegs = $conexion->numregistros();
  if($totRegs > 0){
 ?>
<div class="container col-lg-12 col-md-12 col-sm-12">
  <table id="listPayments" name="listPayments" class="table table-bordered table-striped">
    <thead>
      <th class="col">Empleado</th>
      <th class="col">Obra</th>
      <th class="col">Monto</th>
      <th class="col" style="width: 20%;">Período</th>
      <th class="col">Status</th>
      <th class="col">Detalle</th>
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
              $employee = $nombre.' '.$apellidos;;
            ?>
          </td>
          <td>
            <?php
            $resp = @$conexion->fetch_array($querys3->getListadoObras($key->id_obra));
            $nombre = $resp['nombre'];
            echo $nombre;
            $work = $nombre;
            ?>
          </td>
          <td>$<?= number_format($key->total_raya,2) ?></td>
          <td><?= date('d/m/Y', strtotime($key->fecha_inicio)) ?> a <?= date('d/m/Y', strtotime($key->fecha_finalizacion)) ?></td>
          <td class="text-center">
            <?php
              switch ($key->status) {
                case 1:
                  echo '<span class="badge progress-bar-success">Pagado</span>';
                break;
                case 2:
                echo '<span class="badge progress-bar-warning">Pendiente</span>';
                break;

                case 3:
                echo '<span class="badge progress-bar-danger">Cancelado</span>';
                break;
              }
            ?>
          </td>
          <td>
            <button class="btn btn-primary btn-sm" type="button" onclick="seePaymentDetails(<?= $key->id_raya ?>)" data-toggle="modal" data-target="#paymentDetails"> <i class="fa fa-eye"></i> </button>
            <button class="btn btn-success btn-sm" type="button" onclick="addPaymentActivities(<?= $key->id_raya ?>, '<?= $employee ?>', '<?= $work ?>', '<?= date('d/m/Y', strtotime($key->fecha_inicio)) ?> a <?= date('d/m/Y', strtotime($key->fecha_finalizacion)) ?>')" data-toggle="modal" data-target="#paymentDetails">
              <i class="fa fa-plus"></i>
            </button>
          </td>
        </tr>
      <?php } ?>
    </tbody>
    <tfoot>
      <th class="col">Empleado</th>
      <th class="col">Obra</th>
      <th class="col">Monto</th>
      <th class="col">Período</th>
      <th class="col">Status</th>
      <th class="col" style="width: 15%;">Detalle</th>
    </tfoot>
  </table>
</div>
<?php }else{ ?>
  <center><h4>¡No se encontraron registros!</h4></center>
<?php } ?>
