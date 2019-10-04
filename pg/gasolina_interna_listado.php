<?php
  require '../php/inicializandoDatosExterno.php';

  $listado = @$conexion->obtenerlista($querys3->listInsFuelExp());
  $totRegs = $conexion->numregistros();

  if($totRegs > 0){
 ?>
<table class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>Folio</th>
      <th>Total Litros</th>
      <th style="width: 15%;">Cantidad sin asignar</th>
      <th>Fecha Inicio</th>
      <th style="width: 13%">Fecha Final</th>
      <th>Monto</th>
      <?php if($_SESSION["dUsuario"]["editar"] == 1 || $_SESSION["dUsuario"]["eliminar"] == 1){?>
      <th style="width: 13%">Acciones</th>
      <?php } ?>
    </tr>
  </thead>
  <tbody>
    <?php
      foreach ($listado as $key) {
    ?>
        <tr id="ins_fuel_<?= $key->id_gas_int ?>">
          <td><?= $key->folio ?></td>
          <td><?= number_format(floatval($key->litros_magna)+floatval($key->litros_premium)+floatval($key->litros_diesel), 2) ?> lts.</td>
          <td>
            <?php
              $respC = @$conexion->obtenerlista($querys3->getInsFuelExpEmployees($key->id_gas_int));
              $totRegsTmp = $conexion->numregistros();
              if($totRegsTmp > 0){
                $sum = 0;

                foreach ($respC as $keyC) {
                  $sum = $keyC->monto_asignado;
                }

                settype($sum, 'float');
                settype($key->monto, 'float');

                if($sum<$key->monto){
                  echo '<span class="badge progress-bar-warning">$'.number_format($key->monto-$sum,2).'</span>';
                }
                if($sum===$key->monto){
                  echo '<span class="badge progress-bar-success">$'.number_format($key->monto-$sum,2).'</span>';
                }
                if($sum > $key->monto){
                  echo '<span class="badge progress-bar-danger">$'.number_format($key->monto-$sum,2).'</span>';
                }
              } else {
                echo '<span class="badge progress-bar-warning">$'.number_format($key->monto,2).'</span>';
              }
            ?>
         </td>
          <td><?= date("d/m/Y", strtotime($key->fecha_inicio)) ?></td>
          <td><?= date("d/m/Y", strtotime($key->fecha_final)) ?></td>
          <td>$<?= number_format($key->monto,2) ?></td>
          <td>
            <button type="button" class="btn btn-primary btn-sm"title="Asignar gastos de gasolina" name="button" data-toggle="modal" data-target="#assignExpenseModal" onclick="listFuelExpAssEmployees(<?= $key->id_gas_int ?>)"><i class="fa fa-user"></i></button>
            <button type="button" class="btn btn-success btn-sm" name="button" onclick=""><i class="fa fa-edit"></i></button>
            <button type="button" class="btn btn-danger btn-sm" name="button"  onclick=""><i class="fa fa-trash"></i></button>
          </td>
        </tr>
    <?php
      }
    ?>
  </tbody>
</table>
<?php } else {
  ?>
  <center><h4>¡No se encontraron registros!</h4></center>
  <?php
} ?>
