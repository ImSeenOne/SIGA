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
                <td><?= $key->monto ?></td>
                <td><?= $key->fecha_inicio ?> a <?= $key->fecha_finalizacion ?></td>
                <td class="text-center">
                  <button type="button" class="btn btn-success btn-sm" onclick="editarRegObra(<?= $key->id_obras ?>);"><i class="fa fa-edit"></i></button>
                  <button type="button" class="btn btn-danger btn-sm" onclick="eliminarRegObra(<?= $key->id_obras ?>,'<?= $key->nombre ?>');"><i class="fa fa-trash"></i></button>
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
