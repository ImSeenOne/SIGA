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
              <tr>
                <td>Edificio HHM</td>
                <td>Lorem Ipsum</td>
                <td>$15,000,000</td>
                <td>20/01/2015 a 31/01/2019</td>
                <td class="text-center">
                  <button type="button" class="btn btn-success btn-sm" onclick="editarRegDesarrollo(<?= $key->id_desarrollo ?>);"><i class="fa fa-edit"></i></button>
                  <button type="button" class="btn btn-danger btn-sm" onclick="eliminarRegDesarrollo(<?= $key->id_desarrollo ?>, '<?= $key->icono ?>', '<?= $key->nombre ?>');"><i class="fa fa-trash"></i></button>
                </td>
              </tr>
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
        </div>
        <!-- /.box-body -->
      </div>
    </div>
    </div>
  <!-- /.row -->
</section>
