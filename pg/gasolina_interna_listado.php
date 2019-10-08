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
      <th style="width: 15%;">Litros disponibles</th>
      <th style="width: 15%;">Monto disponible</th>
      <th>Monto total</th>
      <th>Fecha Inicio</th>
      <th style="width: 13%">Fecha Final</th>

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
               $totalLiters = 0;
               if($totRegsTmp > 0){
                 $sum = 0;

                 foreach ($respC as $keyC) {
                   $sum += $keyC->litros;
                 }

                 settype($sum, 'float');
                 settype($key->litros_magna, 'float');
                 settype($key->litros_premium, 'float');
                 settype($key->litros_diesel, 'float');

                 $totalLiters = $key->litros_diesel+$key->litros_premium+$key->litros_magna;

                 echo number_format($totalLiters-$sum, 2).' lts.';
               } else {
                 echo number_format($key->litros_diesel+$key->litros_premium+$key->litros_magna, 2).' lts';
               }
             ?>
           </td>
           <td>
             <?php
               $respC = @$conexion->obtenerlista($querys3->getInsFuelExpEmployees($key->id_gas_int));
               $totRegsTmp = $conexion->numregistros();
               if($totRegsTmp > 0){
                 $sum = 0;

                 foreach ($respC as $keyC) {
                   $sum += $keyC->monto_asignado;
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
          <td>$<?= number_format($key->monto,2) ?></td>
          <td><?= date("d/m/Y", strtotime($key->fecha_inicio)) ?></td>
          <td><?= date("d/m/Y", strtotime($key->fecha_final)) ?></td>

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
