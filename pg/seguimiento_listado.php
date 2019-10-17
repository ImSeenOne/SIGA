<?php
  require '../php/inicializandoDatosExterno.php';
   $listado = @$conexion->obtenerlista($querys3->getListadoSeguimiento());
  $totRegs = $conexion->numregistros();
   if($totRegs > 0){
?>
<br><div class="">
  <table id="listEstimations" class="table table-bordered table-striped table-hover">
    <thead>
      <tr>
        <th style="width:5%;">ID</th>
        <th style="width:25%;">Obra</th>
        <th style="width:5%;">Status</th>
        <th style="width:16%;">Período</th>
        <th style="width:10%;">Monto</th>
        <th>Imagen</th>
        <th style="width:12%;">Acción</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($listado as $key) { ?>
      <tr>
        <td><?= $key->id_seg_est ?></td>
        <td><?php
              $resp = @$conexion->fetch_array($querys3->getListadoObras($key->nombre_obra));
              echo $resp['nombre'];
            ?>
        </td>
        <td><?php switch ($key->status) {
          case 1:
            echo "Elaboración";
          break;

          case 2:
            echo "Revisión/Supervisión";
          break;

          case 3:
            echo "Terminada";
          break;
        } ?></td>
        <td>de <?= date('d/m/Y', strtotime($key->fecha_inicio)) ?> a
          <?php
            if($key->fecha_finalizacion == "0000-00-00"){
              echo "la fecha";
            } else {
              echo date('d/m/Y', strtotime($key->fecha_finalizacion));
            }
           ?>
        </td>
        <td>$<?= number_format($key->monto,2) ?></td>
        <td><img src="<?= $key->imagen ?>" class="iconSize"/></td>
        <td>
          <div class="margin mx-auto">
              <div class="btn-group">
                <a type="button" onclick="editarRegSegEst(<?= $key->id_seg_est ?>);" class="btn btn-inline btn-sm btn-primary" title="Editar">
                      <i class="fa fa-edit"></i>
                </a>
                <a type="button" onclick="eliminarRegSegEst(<?= $key->id_seg_est ?>, '<?= $key->imagen ?>', '<?= $key->nombre_obra ?>');" class="btn btn-inline btn-sm btn-danger" title="eliminar">
                      <i class="fa fa-trash"></i>
                </a>
                </div>
          </div>
        </td>
      </tr>
      <?php } ?>
    </tbody>
    <tfoot>
      <tr>
        <th>Obra</th>
        <th>Status</th>
        <th>Período</th>
        <th>Monto</th>
        <th>Acción</th>
      </tr>
    </tfoot>
  </table>
<?php }else{ ?>
  <center><h4>¡No existen registros!</h4></center>
<?php } ?>
</div>
