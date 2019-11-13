<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  <?php
    require '../php/inicializandoDatosExterno.php';
    $listado = @$conexion->obtenerlista($querys3->listIncomes());
    $totRegs = $conexion->numregistros();
    if($totRegs > 0){
  ?>
  <table id="listIncomes" class="table table-striped table-bordered">
    <thead>
      <tr>
        <th style="width: 3%">ID</th>
        <th style="width: 11%">No. factura</th>
        <th>Concepto</th>
        <th style="width: 8%">Fecha Factura</th>
        <th style="width: 8%">Fecha Cobro</th>
        <th>Proveedor</th>
        <?php if($_SESSION["dUsuario"]["editar"] == 1 || $_SESSION["dUsuario"]["eliminar"] == 1){?>
        <th style="width: 15%">Acciones</th>
        <?php } ?>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($listado as $key) {?>
        <tr>
          <td><?= $key->id_ingreso ?></td>
          <td><?= $key->numero_factura ?></td>
          <td><?= $key->concepto ?></td>
          <td><?= date('d/m/Y', strtotime($key->fecha_factura)) ?></td>
          <td><?= date('d/m/Y', strtotime($key->fecha_cobro)) ?></td>
          <td>
            <?php
              echo @$conexion->fetch_array($querys3->listProvidersAcc($key->id_proveedor))['nombre'];
            ?>
          </td>
          <td>
            <button type="button" class="btn btn-info btn-sm" title="Ver factura" name="button" data-toggle="modal" data-target="#assignConceptAccModal" onclick="viewIncomeDetails(<?= $key->id_ingreso ?>)"><i class="fa fa-eye"></i></button>
            <?php if($_SESSION["dUsuario"]["editar"] == 1){?>
            <button type="button" class="btn btn-primary btn-sm" title="Asignar conceptos a la factura" name="button" data-toggle="modal" data-target="#assignConceptAccModal" onclick="listAssConceptsAcc(<?= $key->id_ingreso ?>)"><i class="fa fa-dollar"></i></button>
            <button type="button" class="btn btn-success btn-sm" onclick="editIncome(<?= $key->id_ingreso ?>)"> <i class="fa fa-edit"></i> </button>
            <?php } ?>
            <?php if($_SESSION["dUsuario"]["eliminar"] == 1){?>
            <button type="button" class="btn btn-danger btn-sm" onclick="deleteIncome(<?= $key->id_ingreso ?>, '<?= $key->concepto ?>')"><i class="fa fa-trash"></i></button>
            <?php } ?>
          </td>
        </tr>
      <?php } ?>
    </tbody>
    <tfoot>
      <tr>
        <th style="width: 3%">ID</th>
        <th style="width: 11%">No. factura</th>
        <th>Concepto</th>
        <th style="width: 8%">Fecha factura</th>
        <th style="width: 8%">Fecha Cobro</th>
        <th>Proveedor</th>
        <?php if($_SESSION["dUsuario"]["editar"] == 1 || $_SESSION["dUsuario"]["eliminar"] == 1){?>
        <th style="width: 5%">Acciones</th>
        <?php } ?>
      </tr>
    </tfoot>
  </table>
<?php }else{ ?>
  <center><h4>¡No existen registros!</h4></center>
<?php } ?>
</div>
