<?php
require '../php/inicializandoDatosExterno.php';
$id = $_POST['id'];
$resp = @$conexion->obtenerlista($querys3->getAssAddedActivities('',$id,''));
$totRegs = $conexion->numregistros();
if($totRegs > 0){
?>
<table class="table table-bordered table-striped">
  <thead>
    <th>Tipo</th>
    <th>Monto</th>
    <th>Acción</th>
  </thead>
  <tbody>
    <?php
      foreach ($resp as $key) {
    ?>
    <tr>
      <td>
        <?php
          $actAnName = @$conexion->fetch_array($querys3->getAddedActivities($key->id_act_an_rrhh))['nombre'];
          echo $actAnName;
        ?>
      </td>
      <td>$<?= number_format($key->monto, 2) ?></td>
      <td> <button type="button" class="btn btn-danger btn-sm" onclick="deleteAssAddedActivity(<?= $key->id_act_an ?>, '<?= $actAnName ?>', '$ <?= number_format($key->monto, 2) ?>')"> <i class="fa fa-trash"></i> </button></td>
    </tr>
    <?php
      }
     ?>
  </tbody>
</table>
<?php
} else {
?>
<center> <h4>¡No se encontraron actividades añadidas para éste pago!</h4> </center>
<?php
}
?>
