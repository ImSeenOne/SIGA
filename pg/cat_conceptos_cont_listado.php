<?php
  require '../php/inicializandoDatosExterno.php';
  $listado = @$conexion->obtenerlista($querys3->listConceptsAcc());
  $totRegs = $conexion->numregistros();
  if($totRegs > 0){
 ?>
<div class="container col-lg-12 col-md-12 col-sm-12">
  <table id="listConceptsAcc" class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Fecha Registro</th>
        <?php if($_SESSION["dUsuario"]["editar"] == 1 || $_SESSION["dUsuario"]["eliminar"] == 1){?>
        <th>Acciones</th>
        <?php } ?>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($listado as $key) { ?>
      <tr>
        <td ><?= $key->id_concepto ?></td>
        <td ><?= $key->nombre ?></td>
        <td ><?= date('d/m/Y H:i:s', strtotime($key->fecha_registro)) ?></td>
        <td >
          <?php if($_SESSION["dUsuario"]["editar"] == 1){?>
         	<button type="button" class="btn btn-success btn-sm" onclick="editConceptAcc(<?= $key->id_concepto ?>)"><i class="fa fa-edit"></i></button>
          <?php } ?>
          <?php if($_SESSION["dUsuario"]["eliminar"] == 1){?>
         	<button type="button" class="btn btn-danger btn-sm" onclick="deleteConceptAcc(<?= $key->id_concepto ?>, '<?= $key->nombre ?>')"><i class="fa fa-trash"></i></button>
          <?php } ?>
        </td>
      </tr>
    <?php } ?>
    </tbody>
    <tfoot>
      <tr>
        <th >Id</th>
        <th >Nombre</th>
        <th >Fecha Registro</th>
        <?php if($_SESSION["dUsuario"]["editar"] == 1 && $_SESSION["dUsuario"]["eliminar"] == 1){?>
        <th >Acciones</th>
        <?php } ?>
      </tr>
    </tfoot>
  </table>
</div>
<?php }else{ ?>
  <center>
    <h4>
      ¡No existen registros!
    </h4>
  </center>
<?php } ?>
