<?php
  require '../php/inicializandoDatosExterno.php';
   $listado = @$conexion->obtenerlista($querys3->getListadoObras());
  $totRegs = $conexion->numregistros();
   if($totRegs > 0){
?>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Listado de obras</h3>
        </div>
        <div class="box-body">
          <table id="listWorks" class="table table-bordered table-hover">
            <thead>
            <tr>
              <th>Obra</th>
              <th>Dependencia</th>
              <th>Monto</th>
              <th>Período</th>
              <th>Acción</th>
            </tr>
            </thead>
            <tbody>
              <?php foreach ($listado as $key) { ?>
              <tr>
                <td><?= $key->nombre ?>  </td>
                <td><?= $key->dependencia ?></td>
                <td>$<?= number_format($key->monto,2) ?></td>
                <td><?= date("d/m/Y", strtotime($key->fecha_inicio)) ?> a <?php if($key->fecha_finalizacion == '0000-00-00' || $key->fecha_finalizacion == '00-00-0000') echo 'la fecha'; else echo date("d/m/Y", strtotime($key->fecha_inicio)); ?></td>
                <td class="text-center">
                  <?php if($_SESSION["dUsuario"]["editar"] == 1){?>
                  <button type="button" class="btn btn-success btn-sm" onclick="editarRegObra(<?= $key->id_obras ?>);"><i class="fa fa-edit"></i></button>
                  <?php } ?>
                  <?php if($_SESSION["dUsuario"]["eliminar"] == 1){?>
                  <button type="button" class="btn btn-danger btn-sm" onclick="eliminarRegObra(<?= $key->id_obras ?>,'<?= $key->nombre ?>');"><i class="fa fa-trash"></i></button>
                  <?php } ?>
                </td>
              </tr>
              <?php } ?>
            </tbody>
            <tfoot>
            <tr>
              <th>Obra</th>
              <th>Dependencia</th>
              <th>Monto</th>
              <th>Período</th>
              <th>Acción</th>
            </tr>
            </tfoot>
          </table>
        <?php }else{ ?>
          <center><h4>¡No existen registros!</h4></center>
        <?php } ?>
        </div>
        <!-- /.box-body -->
      </div>
    </div>
    </div>
  <!-- /.row -->
</section>
