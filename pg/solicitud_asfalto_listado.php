<?php
  require '../php/inicializandoDatosExterno.php';
  // echo $querys3->listAsphaltRequests();
  $listado = @$conexion->obtenerlista($querys3->listAsphaltRequests());
  $totRegs = $conexion->numregistros();

  if($totRegs > 0){
?>
<table id="listAsphaltRequests" class="table table-bordered table-striped table-hover">
  <thead>
    <tr>
      <th scope="col" style="width: 5%;">ID</th>
      <th scope="col" style="width: 30%;">Obra</th>
      <th scope="col" style="width: 7%;">Fecha Entrega</th>
      <?php if($_SESSION["dUsuario"]["editar"] == 1 || $_SESSION["dUsuario"]["eliminar"] == 1){?>
      <th class="text-center" scope="col" style="width: 15%;">Acciones</th>
      <?php } ?>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($listado as $key) {?>
        <tr>
          <td><?= $key->id_solicitud ?></td>
          <td>
            <?php
              $resp = @$conexion->fetch_array($querys3->getListadoObras($key->id_obra));
              echo $resp['nombre'];
            ?>
          </td>
          <td><?= date('d/m/Y', strtotime($key->fecha_entrega)) ?></td>

          <td class="text-center">
            <div class="row">
              <button style="z-index: 10000 !important; max-width: 50%;" type="button" class="btn btn-sm btn-info" rel="popover" data-html="true" data-trigger="focus" data-placement="left" data-toggle="popover"
                                          title="Datos de la solicitud"
                                          data-content='
                                            <?php
                                              echo '<p class="mg-1em"><b>Litros Asfalto:</b> '.$key->litros_asfalto.'<br>';
                                              echo '<b>Fecha de Entrega:</b> '.date('d/m/Y', strtotime($key->entrega_asfalto)).'</p>';
                                              echo '<p class="mg-1em"><b>Litros Emulsión:</b> '.$key->litros_emulsion.'<br>';
                                              echo '<b>Fecha Entrega:</b> '.date('d/m/Y', strtotime($key->entrega_emulsion)).'</p>';
                                              echo '<p class="mg-1em"><b>Litros Comb. Alt:</b> '.$key->litros_combust_alt.'<br>';
                                              echo '<b>Fecha Entrega:</b> '.date('d/m/Y', strtotime($key->entrega_combust)).'</p>';
                                            ?>'>

                <i class="fa fa-eye"></i>
              </button>
              <?php if($_SESSION["dUsuario"]["editar"] == 1){?>
                <button type="button" class="btn btn-success btn-sm" onclick="editAsphaltRequest(<?= $key->id_solicitud ?>);"><i class="fa fa-edit"></i></button>
              <?php } ?>
              <?php if($_SESSION["dUsuario"]['eliminar'] == 1){?>
                <button type="button" class="btn btn-danger btn-sm" onclick="deleteAsphaltRequest(<?= $key->id_solicitud ?>);"><i class="fa fa-trash"></i></button>
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
