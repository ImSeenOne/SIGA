<?Php
    require '../php/inicializandoDatosExterno2.php';

    $listado = @$conexionB->obtenerlista($querysB->getListadoCocina());
    $totRegs = $conexionB->numregistros();
    if($totRegs > 0){
?>
<table id="listCocina" class="table table-bordered table-striped">
  <thead>
    <tr>
      <th class="text-center" style="width:10%;">Id</th>
      <th class="text-left" style="width:30%;">Nombre</th>
      <th class="text-center" style="width:10%;">Icono</th>
      <th class="text-left" style="width:20%;">Fecha registro</th>
      <th class="text-center" style="width:20%;">Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?Php foreach($listado as $list){ ?>
      <tr>
        <td class="text-center"><?php echo $list->numero?></td>
        <td class="text-left"><?php echo $list->nombre?></td>
        <td class="text-center"><img src="<?php echo $list->icono?>" class="iconSize" /></td>
        <td class="text-center"><?php echo $list->fecha_registro?></td>
        <td class="text-center">
          <button type="button" class="btn btn-success btn-sm" onclick="ModRegCocina(<?= $list->id_cocina ?>,'<?= $list->nombre ?>','<?= $list->icono ?>');"><i class="fa fa-edit"></i></button>
          <button type="button" class="btn btn-danger btn-sm" onclick="ModRegCocina(<?= $list->id_cocina ?>,'<?= $list->nombre ?>','<?= $list->icono ?>',1);"><i class="fa fa-trash"></i></button>
        </td>
      </tr>
    <?Php } ?>

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
<?Php } else { ?>
    <center><h4>¡No existen registros!</h4></center>
<?Php }?>
