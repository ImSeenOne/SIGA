<?php
  require '../php/inicializandoDatosExterno.php';
  $listado = @$conexion->obtenerlista($querys3->getListadoAntiguedad());
  $totRegs = $conexion->numregistros();
  if($totRegs > 0){
 ?>
<div class="container col-lg-12 col-md-12 col-sm-12">
  <table id="listAntiguedad" class="table table-striped table-bordered ">
    <thead>
      <tr>
        <th class="text-center">Id</th>
        <th class="text-center">Nombre</th>
        <th class="text-center">Icono</th>
        <th class="text-center">Fecha registro</th>
        <?php if($_SESSION["dUsuario"]["editar"] == 1 || $_SESSION["dUsuario"]["eliminar"] == 1){?>
        <th class="text-center">Acciones</th>
        <?php } ?>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($listado as $key) { ?>
      <tr>
        <td class="text-center"><?= $key->id_antiguedad ?></td>
        <td class="text-left"><?= $key->nombre ?></td>
        <td class="text-center"><img src="<?= $key->icono ?>" class="iconSize" /></td>
        <td class="text-center"><?= date("d/m/Y", strtotime($key->fecha_registro)) ?></td>
        <td class="text-center">
          <?php if($_SESSION["dUsuario"]["editar"] == 1){?>
         	<button type="button" class="btn btn-success btn-sm" onclick="editarRegAntiguedad(<?= $key->id_antiguedad ?>)"><i class="fa fa-edit"></i></button>
          <?php } ?>
          <?php if($_SESSION["dUsuario"]["eliminar"] == 1){?>
         	<button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash" onclick="eliminarRegAntiguedad(<?= $key->id_antiguedad ?>, '<?= $key->nombre ?>')"></i></button>
          <?php } ?>
        </td>
      </tr>
    <?php } ?>
    </tbody>
    <tfoot>
      <tr>
        <th class="text-center">Id</th>
        <th class="text-center">Nombre</th>
        <th class="text-center">Icono</th>
        <th class="text-center">Fecha registro</th>
        <th class="text-center">Acciones</th>
      </tr>
    </tfoot>
  </table>
</div>
<?php }else{ ?>
  <center><h4>¡No existen registros!</h4></center>
<?php } ?>
