<?php
  require '../php/inicializandoDatosExterno.php';
  $idReport = $funciones->limpia($_POST['id']);
  $resp = @$conexion->obtenerlista($querys3->listAsphaltReportConsumption('',$idReport));
  $totRegsM = $conexion->numregistros();
  if($totRegsM > 0){
?>
<div>
  <table class="table table-bordered table-striped table-hover" id="listAsphaltReportsConsumption">
    <thead>
      <tr>
        <th>ID</th>
        <th>Número de Viajes</th>
        <th>Cons. Comb. Planta</th>
        <th>Cons. Comb. Generador</th>
        <th>Cons. Comb. Caldera</th>
        <th>Cons. Comb. Auxiliar</th>
        <th>Fecha Registro</th>
        <th style="width: 5%;">Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($resp as $key){ ?>
        <tr>
          <td><?= $key->id_consumo ?></td>
          <td><?= $key->numero_viajes ?></td>
          <td><?= number_format($key->consumo_planta, 2) ?></td>
          <td><?= number_format($key->consumo_generador, 2) ?></td>
          <td><?= number_format($key->consumo_caldera, 2) ?></td>
          <td><?= number_format($key->consumo_auxiliar, 2) ?></td>
          <td><?= date('d/m/Y', strtotime($key->fecha_registro)) ?></td>
          <td> <button type="button" class="btn btn-danger" onclick="deleteAsphaltConsumption(<?= $key->id_consumo ?>)"> <i class="fa fa-trash"></i> </button> </td>
        </tr>
      <?php } ?>
    </tbody>
    <tfoot>
      <tr>
        <th>ID</th>
        <th>Número de Viajes</th>
        <th>Cons. Comb. Planta</th>
        <th>Cons. Comb. Generador</th>
        <th>Cons. Comb. Caldera</th>
        <th>Cons. Comb. Auxiliar</th>
        <th>Fecha Registro</th>
        <th>Acciones</th>
      </tr>
    </tfoot>
  </table>
</div>
<?php
} else {
?>
  <center><h4>¡No existen registros para éste ingreso!</h4></center>
<?php
}
?>
