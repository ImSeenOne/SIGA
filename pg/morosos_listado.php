<?php
  require '../php/inicializandoDatosExterno.php';
  $listado = @$conexion->obtenerlista('SELECT * FROM tbl_calendarizado_detalle WHERE fecha_moroso <= NOW();');
  $totRegs = $conexion->numregistros();
  if($totRegs > 0){
    $sluggish = 1;
 ?>
<div class="col-lg-12 col-md-12 col-sm-12">
  <table id="listSluggishClients" class="table table-bordered table-striped">
    <thead>
      <th scope="col">Cliente</th>
      <th scope="col">Monto</th>
      <th scope="col">Nro. Pago</th>
      <th scope="col" class="text-center" style="width: 10%;">Fecha</th>
      <th scope="col" class="text-center" style="width: 10%;">Fecha Moroso</th>
    </thead>
    <tbody>
      <?php foreach ($listado as $key) { ?>
        <tr>
          <td>
            <?php
              $resp = @$conexion->fetch_array('SELECT * FROM tbl_calendarizado WHERE id_calendarizado = '.$key->id_calendarizado);
              $resp = @$conexion->fetch_array($querys3->getContracts($resp['id_contrato']));
              $resp = @$conexion->fetch_array($querys3->listClientes($resp['id_cliente']));
              echo $resp['nombre'].' '.$resp['apellido_p'].' '.$resp['apellido_m'];
            ?>
          </td>
          <td>$<?= number_format($key->monto, 2) ?></td>
          <td><?= $key->no_pago ?></td>
          <td>
            <?= date("d/m/Y", strtotime($key->fecha_programada)) ?>
          </td>
          <td>
            <?= date("d/m/Y", strtotime($key->fecha_moroso)) ?>
          </td>
        </tr>
      <?php } ?>
    </tbody>
    <tfoot>
      <th scope="col">Cliente</th>
      <th scope="col">Monto</th>
      <th scope="col">Nro. Pago</th>
      <th scope="col" class="text-center" style="width: 10%;">Fecha</th>
      <th scope="col" class="text-center" style="width: 10%;">Fecha Moroso</th>
    </tfoot>
  </table>
</div>
<?php }else{
        $sluggish = 0;?>
  <center><h4>¡No se encontraron clientes morosos!</h4></center>
<?php } ?>
<input type="hidden" id="slug" value="<?= $sluggish ?>">
