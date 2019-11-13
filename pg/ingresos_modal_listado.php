<?php
  require '../php/inicializandoDatosExterno.php';
  $id = $funciones->limpia($_POST['id']);
  $resp = @$conexion->obtenerlista($querys3->listAssConceptsAcc('', $id));
  $totRegsM = $conexion->numregistros();
  if($totRegsM > 0){
?>
<table class="table table-bordered table-striped table-hover">
  <thead>
    <tr>
      <th>ID</th>
      <th>Concepto</th>
      <th>Monto</th>
      <th>Fecha Registro</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($resp as $key){ ?>
      <tr>
        <td><?= $key->id_concepto ?></td>
        <td><?= $key->nombre ?></td>
        <td>$<?= number_format($key->monto,2) ?></td>
        <td><?= date('d/m/Y', strtotime($key->fecha_registro)) ?></td>
        <td> <button type="button" class="btn btn-danger" onclick="deleteConceptIncome(<?= $key->id_concepto ?>, '<?= $key->nombre ?>')"> <i class="fa fa-trash"></i> </button> </td>
      </tr>
    <?php } ?>
  </tbody>
  <tfoot>
    <tr>
      <th>ID</th>
      <th>Concepto</th>
      <th>Monto</th>
      <th>Fecha Registro</th>
      <th>Acciones</th>
    </tr>
  </tfoot>
</table>
<?php
} else {
?>
<center><h4>¡No existen registros para éste ingreso!</h4></center>
<br><br><br><br><br>
<?php
}
?>
