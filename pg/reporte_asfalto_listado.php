<?php
  require '../php/inicializandoDatosExterno.php';
  $listado = @$conexion->obtenerlista($querys3->listAsphaltReports('', '', 1));
  $totRegs = $conexion->numregistros();

  if($totRegs > 0){
?>
<table id="listAsphaltReports" class="table table-bordered table-striped table-hover">
  <thead>
    <tr>
      <th scope="col" style="width: 5%;">ID</th>
      <th scope="col" style="width: 30%;">Obra</th>
      <th scope="col" style="width: 7%;">Fecha Reporte</th>
      <th scope="col" style="width: 7%;">Fecha Registro</th>
      <?php if($_SESSION["dUsuario"]["editar"] == 1 || $_SESSION["dUsuario"]["eliminar"] == 1){?>
      <th class="text-center" scope="col" style="width: 15%;">Acciones</th>
      <?php } ?>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($listado as $key) {?>
        <tr>
          <td><?= $key->id_reporte ?></td>
          <td>
            <?php
              $resp = @$conexion->fetch_array($querys3->getListadoObras($key->id_obra));
              echo $resp['nombre'];
            ?>
          </td>
          <td class="text-center"><?= date('d/m/Y', strtotime($key->fecha_reporte)) ?></td>
          <td class="text-center"><?= date('d/m/Y', strtotime($key->fecha_registro)) ?></td>
          <td class="text-center">
            <div class="row">
              <button style="z-index: 10000 !important; max-width: 50%;" type="button" class="btn btn-sm btn-info" rel="popover" data-html="true" data-trigger="focus" data-placement="left" data-toggle="popover"
                                          title="Datos de la solicitud"
                                          data-content='
                                            <?php
                                              echo '<p class="mg-1em"><b>Litros Asfalto:</b> '.$key->litros_asfalto.'<br>';
                                              echo '<b>Asfalto Consumido:</b> '.$key->asfalto_consumido.'</p>';
                                              echo '<p class="mg-1em"><b>Litros Emulsión:</b> '.$key->litros_emulsion.'<br>';
                                              echo '<b>Emulsión Consumida:</b> '.$key->emulsion_consumida.'</p>';
                                              echo '<p class="mg-1em"><b>Capacidad Termo:</b> '.$key->capacidad_termo.'<br>';
                                              echo '<b>Nombre del Operador:</b> '.$key->nombre_operador.'</p>';
                                            ?>'>

                <i class="fa fa-eye"></i>
              </button>
              <?php if($_SESSION["dUsuario"]["editar"] == 1){?>
                <button type="button" class="btn btn-primary btn-sm" onclick="listAsphaltReportConsumptions(<?= $key->id_reporte ?>, '<?= $resp['nombre'] ?>')" title="Asignar consumo al reporte" name="button" data-toggle="modal" data-target="#assignAsphaltReportConsumptionModal"><i class="fa fa-plus"></i></button>
                <button type="button" class="btn btn-success btn-sm" onclick="editAsphaltReport(<?= $key->id_reporte ?>);"><i class="fa fa-edit"></i></button>
              <?php } ?>
              <?php if($_SESSION["dUsuario"]['eliminar'] == 1){?>
                <button type="button" class="btn btn-danger btn-sm" onclick="deleteAsphaltReport(<?= $key->id_reporte ?>);"><i class="fa fa-trash"></i></button>
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
