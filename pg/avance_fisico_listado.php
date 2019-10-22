<?php
  require '../php/inicializandoDatosExterno.php';
  $listado = @$conexion->obtenerlista($querys3->getPhysProg());
  $totRegs = $conexion->numregistros();
  $permission = false;
  if($totRegs > 0){
?>
<table id="listPhysicalProgress" class="table table-bordered table-striped table-hover">
  <thead>
    <tr>
      <th scope="col" style="width: 5%;">ID</th>
      <th scope="col" style="width: 5%;">Folio</th>
      <th scope="col" style="width: 7%;">Residente</th>
      <th scope="col" style="width: 20%;">Obra</th>
      <th scope="col" style="width: 8%;">Porcentaje de avance</th>
      <th scope="col" style="width: 35%;">Período</th>
      <?php if($_SESSION["dUsuario"]["editar"] == 1 || $_SESSION["dUsuario"]["eliminar"] == 1){?>
      <th class="text-center" scope="col" style="width: 20%;">Acciones</th>
      <?php } ?>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($listado as $key) {?>
        <tr>
          <td><?= $key->id ?></td>
          <td><?= $key->folio ?></td>
          <td><?= $key->residente ?></td>
          <td>
            <?php
              $resp = @$conexion->fetch_array($querys3->getListadoObras($key->id_obra));
              echo $resp['nombre'];
            ?>
          </td>
          <td class="text-center">
            <?php
              $respBudget = @$conexion->fetch_array($querys3->getTotalBudget($key->id_obra))['total_quantity'];
              $respPhysProg = @$conexion->obtenerlista($querys3->getPhysProg($key->id));
              $sumTotal = 0;
              foreach ($respPhysProg as $currentPhysProg) {
                $respSum = @$conexion->fetch_array($querys3->getAddedConcept('', $currentPhysProg->id));
                $sumTotal = $respSum['quantity_used'];
              }
              $percentage = ($sumTotal*100)/$respBudget;
              echo number_format($percentage,5).'%';
            ?>
          </td>
          <td class="text-center">de <?=date("d/m/Y", strtotime($key->fecha_inicio))?> a <?=date("d/m/Y", strtotime($key->fecha_termino))?></td>

            <td class="text-center">
              <div class="row">
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#modalPhysProgDetails" onclick="addConcepts(<?= $key->id ?>);"><i class="fa fa-plus"></i></button>
                <!-- <button type="button" class="btn btn-info btn-sm" onclick="lookDetails(<?= $key->id ?>)"><i class="fa fa-eye"></i></button> -->
                <?php if($_SESSION["dUsuario"]["editar"] == 1){?>
                  <button type="button" class="btn btn-success btn-sm" onclick="editProgress(<?= $key->id ?>);"><i class="fa fa-edit"></i></button>
                <?php } ?>
                <?php if($_SESSION["dUsuario"]['eliminar'] == 1){?>
                  <button type="button" class="btn btn-danger btn-sm" onclick="deleteProgress(<?= $key->id ?>);"><i class="fa fa-trash"></i></button>
                <?php } ?>
              </div>
            </td>
        </tr>
    <?php } ?>
  </tbody>
</table>
<?php } else{ ?>
  <center><h4>¡No existen registros!</h4></center>
<?php } ?>
