<!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Listado de Inmuebles</h3>
                <div class="box-tools pull-right">
                    <a type="button" href="propiedades_registro" class="btn btn-inline btn-sm btn-primary" title="Editar">
                          <i class="fa fa-building"> + Registrar Inmuble</i>
                      </a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="listClientes" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Folio</th>
                  <th>Imagen</th>
                  <th>Tipo</th>
                  <th>Dirección</th>
                  <th>Precio</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>VRA0001</td>
                  <td><img src="img/inmuble.png" width="64px"/></td>
                  <td>Renta</td>
                  <td>Dirección I</td>
                  <td>$ 567,798.00</td>
                  <td>
                      <div class="margin">
                          <a type="button" href="propiedades_registro" class="btn btn-inline btn-sm btn-primary" title="Editar">
                              <i class="fa fa-edit"></i>
                          </a>
                          <a type="button" href="eliminar" class="btn btn-inline btn-sm btn-danger" title="eliminar">
                              <i class="fa fa-remove"></i>
                          </a>
                      </div>
                </td>        
                </tr>
                <tr>
                  <td>VVA0002</td>
                  <td><img src="img/inmuble.png" width="64px"/></td>
                  <td>Venta</td>
                  <td>Dirección II</td>
                  <td>$ 567,798.00</td>
                    <td>
                        <div class="margin">
                          <a type="button" href="clientesregistro" class="btn btn-inline btn-sm btn-primary" title="Editar">
                              <i class="fa fa-edit"></i>
                          </a>
                          <a type="button" href="eliminar" class="btn btn-inline btn-sm btn-danger" title="eliminar">
                              <i class="fa fa-remove"></i>
                          </a>
                      </div>
                    </td>
                </tr>
                <tr>
                  <td>VRB0003</td>
                  <td><img src="img/inmuble.png" width="64px"/></td>
                  <td>Renta</td>
                  <td>Dirección III</td>
                  <td>$ 657,688.00</td>
                    <td>
                        <div class="margin">
                          <a type="button" href="clientesregistro" class="btn btn-inline btn-sm btn-primary" title="Editar">
                              <i class="fa fa-edit"></i>
                          </a>
                          <a type="button" href="eliminar" class="btn btn-inline btn-sm btn-danger" title="eliminar">
                              <i class="fa fa-remove"></i>
                          </a>
                      </div>
                    </td>
                </tr>
                <tr>
                  <td>VVB0004</td>
                  <td><img src="img/inmuble.png" width="64px"/></td>
                  <td>Venta</td>
                  <td>Dirección IV</td>
                  <td>$ 987,567.00</td>
                    <td>
                        <div class="margin">
                          <a type="button" href="clientesregistro" class="btn btn-inline btn-sm btn-primary" title="Editar">
                              <i class="fa fa-edit"></i>
                          </a>
                          <a type="button" href="eliminar" class="btn btn-inline btn-sm btn-danger" title="eliminar">
                              <i class="fa fa-remove"></i>
                          </a>
                      </div>
                    </td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                  <th>Folio</th>
                  <th>Imagen</th>
                    <th>Tipo</th>
                  <th>Dirección</th>
                  <th>Precio</th>
                  <th>Acciones</th>
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
    <!-- /.content -->

<script type="text/javascript">
  window.onload = function() {    
    loadDataTable('listClientes',false);
  }
</script>
