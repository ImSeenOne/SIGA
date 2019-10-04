<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  <?php
    require '../php/inicializandoDatosExterno.php';
    $listado = @$conexion->obtenerlista($querys3->getBiddings());
    $totRegs = $conexion->numregistros();
    if($totRegs > 0){
  ?>
  <table id="listBiddings" class="table table-striped table-bordered">
    <thead>
      <tr>
        <th class="text-center" style="width: 3%">ID</th>
        <th class="text-center" style="width: 8%">No. licitación</th>
        <th class="text-center">Obra</th>
        <th class="text-center" style="width: 8%">Fecha de entrega propuesta</th>
        <th class="text-center" style="width: 10%">Fecha fallo</th>
        <th class="text-center" style="width: 5%">Lugar</th>
        <?php if($_SESSION["dUsuario"]["editar"] == 1 || $_SESSION["dUsuario"]["eliminar"] == 1){?>
        <th class="text-center"  style="width: 5%">Acciones</th>
        <?php } ?>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($listado as $key) {?>
        <tr>
          <td class="text-center"><?= $key->id_licitacion ?></td>
          <td class="text-center"><?= $key->numero_licitacion ?></td>
          <td class="text-center"><?= $key->nombre_obra ?></td>
          <td class="text-center"><?= date('d/m/Y', strtotime($key->entrega_propuesta)) ?></td>
          <td class="text-center"><?= date('d/m/Y', strtotime($key->fecha_fallo)) ?></td>
          <td class="text-center"><?= $key->lugar ?></td>
          <td class="text-center">
            <?php if($_SESSION["dUsuario"]["editar"] == 1){?>
            <button type="button" class="btn btn-success btn-sm" name="button" onclick="editBidding(<?= $key->id_licitacion ?>)"> <i class="fa fa-edit"></i> </button>
            <?php } ?>
            <?php if($_SESSION["dUsuario"]["eliminar"] == 1){?>
            <button type="button" class="btn btn-danger btn-sm" name="button"  onclick="deleteBidding(<?= $key->id_licitacion ?>, <?= $key->numero_licitacion ?>)"><i class="fa fa-trash"></i></button>
            <?php } ?>
          </td>
        </tr>
      <?php } ?>
    </tbody>
    <tfoot>
      <tr>
        <th class="text-center" style="width: 3%">ID</th>
        <th class="text-center" style="width: 8%">No. licitación</th>
        <th class="text-center">Obra</th>
        <th class="text-center" style="width: 8%">Entrega propuesta</th>
        <th class="text-center" style="width: 10%">Fecha fallo</th>
        <th class="text-center" style="width: 5%">Lugar</th>
        <?php if($_SESSION["dUsuario"]["editar"] == 1 || $_SESSION["dUsuario"]["eliminar"] == 1){?>
        <th class="text-center"  style="width: 5%">Acciones</th>
        <?php } ?>
      </tr>
    </tfoot>
  </table>
<?php }else{ ?>
  <center><h4>¡No existen registros!</h4></center>
<?php } ?>
</div>
