<?php
  require '../php/inicializandoDatosExterno.php';
   $listado = @$conexion->obtenerlista($querys3->getListadoDesarrollo());
  $totRegs = $conexion->numregistros();
   if($totRegs > 0){
?>
<table id="listDesarrollo" class="table table-bordered table-striped">
  <thead>
    <tr>
      <th class="text-center" style="width:15%;">Id</th>
      <th class="text-left" style="width:30%;">Nombre</th>
      <th class="text-left" style="width:5%;">Alias</th>
      <th class="text-left" style="width:15%">Número</th>
      <th class="text-center" style="width:10%;">C.P.</th>
      <th class="text-center" style="width:10%;">Icono</th>
      <th class="text-center" style="width:20%;">Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($listado as $key) { ?>
    <tr>
      <td class="text-center"><?= $key->id_desarrollo ?></td>
      <td class="text-left"><?= $key->nombre ?></td>
      <td class="text-left"><?= $key->alias ?></td>
      <td class="text-left"><?= $key->numero_etapa_oferta ?></td>
      <td class="text-center"><?= $key->codigo_postal ?></td>
      <td class="text-center"><img src="<?= $key->icono ?>" class="iconSize"/></td>
      <td class="text-center">
       	<button type="button" class="btn btn-success btn-sm" onclick="editarRegDesarrollo(<?= $key->id_desarrollo ?>);"><i class="fa fa-edit"></i></button>
       	<button type="button" class="btn btn-danger btn-sm" onclick="eliminarRegDesarrollo(<?= $key->id_desarrollo ?>, '<?= $key->icono ?>', '<?= $key->nombre ?>');"><i class="fa fa-trash"></i></button>
      </td>
    </tr>
    <?php } ?>
  </tbody>
  <tfoot>
    <tr>
      <th class="text-center">Id</th>
      <th class="text-center">Nombre</th>
      <th class="text-center">Alias</th>
      <th class="text-center">C.P.</th>
      <th class="text-center">Icono</th>
      <th class="text-center">Acciones</th>
    </tr>
  </tfoot>
</table>
<?php }else{ ?>
  <center><h4>¡No existen registros!</h4></center>
<?php } ?>
