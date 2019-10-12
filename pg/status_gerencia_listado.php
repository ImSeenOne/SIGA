<?php
  require '../php/inicializandoDatosExterno.php';
  $listado = @$conexion->obtenerlista($querys3->listInsFuelExpStatus());
  $totRegs = $conexion->numregistros();
  if($totRegs > 0){
 ?>
<div class="container col-lg-12 col-md-12 col-sm-12">
  <table id="listStatusInsFuel" class="table table-striped table-bordered ">
    <thead>
      <tr>
        <th class="text-center">Id</th>
        <th class="text-center">Nombre</th>
        <?php if($_SESSION["dUsuario"]["editar"] == 1 || $_SESSION["dUsuario"]["eliminar"] == 1){?>
        <th style="width: 30%;" class="text-center">Acciones</th>
        <?php } ?>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($listado as $key) { ?>
      <tr>
        <td class="text-left"><?= $key->id_status ?></td>
        <td class="text-left"><?= $key->nombre ?></td>
        <td class="">
          <?php if($_SESSION["dUsuario"]["editar"] == 1){?>
         	<button type="button" class="btn btn-success btn-sm" onclick="editInsFuelStatus(<?= $key->id_status ?>)"><i class="fa fa-edit"></i></button>
          <?php } ?>
          <?php if($_SESSION["dUsuario"]["eliminar"] == 1){?>
         	<button type="button" class="btn btn-danger btn-sm" onclick="deleteInsFuelStatus(<?= $key->id_status ?>, '<?= $key->nombre ?>')"><i class="fa fa-trash" ></i></button>
          <?php } ?>
        </td>
      </tr>
    <?php } ?>
    </tbody>
    <tfoot>
      <tr>
        <th class="text-center">Id</th>
        <th class="text-center">Nombre</th>
        <?php if($_SESSION["dUsuario"]["editar"] == 1 || $_SESSION["dUsuario"]["eliminar"] == 1){?>
        <th class="text-center">Acciones</th>
        <?php } ?>
      </tr>
    </tfoot>
  </table>
</div>
<?php }else{ ?>
  <center><h4>¡No existen registros!</h4></center>
<?php } ?>