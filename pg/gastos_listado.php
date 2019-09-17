<?php
  require '../php/inicializandoDatosExterno.php';
  $month = date('m');
  $year = date('Y');

  if(isset($_POST['month'])){
    $month = $funciones->limpia($_POST['month']);
    settype($month, 'integer');
    if($month < 1){
      $month = date('m');
    }
  }

  if(isset($_POST['year'])){
    $year = $funciones->limpia($_POST['year']);
    settype($year, 'integer');
    if($year < 1){
      $year = date('Y');
    }
  }

  if(isset($_POST['expenseType'])){
    $expenseType = $funciones->limpia($_POST['expenseType']);
    settype($expenseType, 'integer');
  }

  $listado = ($expenseType > 0) ? @$conexion->obtenerlista($querys3->getExpenses('', $month, $year, $expenseType)) : @$conexion->obtenerlista($querys3->getExpenses('', $month, $year, ''));

  $totRegs = $conexion->numregistros();

  switch ($month) {
    case 1:
      $current = 'Enero';
    break;

    case 2:
      $current = 'Febrero';
    break;
    case 3:
      $current = 'Marzo';
    break;
    case 4:
      $current = 'Abril';
    break;
    case 5:
      $current = 'Mayo';
    break;
    case 6:
      $current = 'Junio';
    break;
    case 7:
      $current = 'Julio';
    break;
    case 8:
      $current = 'Agosto';
    break;
    case 9:
      $current = 'Septiembre';
    break;
    case 10:
      $current = 'Octubre';
    break;
    case 11:
      $current = 'Noviembre';
    break;
    case 12:
      $current = 'Diciembre';
    break;
  }

?>
<div class="col-lg-12 col-md-12 col-sm-12 text-center">
 <h3>Gastos del mes de <cite class="cite"><?php echo $current.', '.$year; ?></cite></h3>
</div>
<?php
  if($totRegs > 0){
?>
<table id="listExpenses" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th class="text-center">ID</th>
        <th class="text-center">Propiedad</th>
        <th class="text-center">Tipo de gasto</th>
        <th class="text-center">Descripción</th>
        <th class="text-center">Monto</th>
        <th class="text-center">Fecha</th>
        <th class="text-center">Status</th>
        <th class="text-center">Acciones</th>
      </tr>
      </thead>
      <tbody>
        <?php foreach ($listado as $key){ ?>
          <tr>
            <td class="text-center"><?= $key->id_gasto ?></td>
            <td class="text-center"><?= @$conexion->fetch_array($querys3->getPropiedades($key->id_propiedad))['descripcion'] ?></td>
            <td class="text-center"><?= @$conexion->fetch_array($querys3->getTypesOfExpenses($key->id_tipo_gasto))['nombre'] ?></td>
            <td class="text-center"><?= $key->descripcion ?></td>
            <td class="text-center"><?= $key->monto ?></td>
            <td class="text-center"><?= $key->fecha_pago ?></td>
            <td class="text-center"><?php switch ($key->estatus) {
              case 1:
                echo '<span class="badge progress-bar-success">Activo</span>';
              break;

              case 2:
                echo '<span class="badge progress-bar-danger">Cancelado</span>';
              break;
            } ?></td>
            <td class="text-center"><button type="button" class="btn btn-danger btn-sm" title="Cancelar" onclick="cancelExpense(<?= $key->id_gasto ?>, '<?= $key->descripcion ?>')"><i class="fa fa-times"></i></button></td>
          </tr>
        <?php } ?>
      </tbody>
      <tfoot>
      <tr>
        <th class="text-center">Propiedad</th>
        <th class="text-center">Tipo de gasto</th>
        <th class="text-center">Descripción</th>
        <th class="text-center">Monto</th>
        <th class="text-center">Fecha</th>
        <th class="text-center">Status</th>
        <th class="text-center">Acciones</th>
      </tr>
      </tfoot>
    </table>
<?php } else { ?>
  <br>
  <br>
  <br>
  <center><h4>¡No existen registros!</h4></center>
<?php } ?>
