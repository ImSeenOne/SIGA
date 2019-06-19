<section class="content-header">
    <h1>
        Clientes
        <small>Inmobiliaria</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-home"></i> Inicio</a></li>
        <li><a href="clientes"><i class="fa fa-users"></i> Clientes</a></li>
        <li class="active">Registrar/Editar Clientes</li>
    </ol>
</section>

<!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- right column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Captura - Edición de Clientes</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal">
              <div class="box-body">
                  <div class="form-group col-md-6">
                  <label for="txtTipo" class="col-sm-4 control-label">Tipo de Cliente</label>

                  <div class="col-sm-8">
                    <select class="form-control select2" style="width: 100%;">
                  <option selected="selected">Arrendatario</option>
                  <option>Comprador</option>
                </select>
                  </div>
                </div>
                  <div style="clear: both;"></div>
                <div class="form-group col-md-6">
                  <label for="txtRFC" class="col-sm-4 control-label">RFC</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="txtRFC" placeholder="RFC">
                  </div>
                </div>
                  
                <div class="form-group col-md-6">
                  <label for="txtNombre" class="col-sm-4 control-label">Nombre</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="txtNombre" placeholder="Nombre">
                  </div>
                </div>
                  <div style="clear: both;"></div>
                  <div class="form-group col-md-6">
                  <label for="txtApellioP" class="col-sm-4 control-label">Apellido Paterno</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="txtApellioP" placeholder="Apellido P">
                  </div>
                </div>
                  <div class="form-group col-md-6">
                  <label for="txtApellidoM" class="col-sm-4 control-label">Apellido Materno</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="txtApellidoM" placeholder="Apellido M">
                  </div>
                </div>
                  <div style="clear: both;"></div>
                  <div class="form-group col-md-6">
                  <label for="txtCorreo" class="col-sm-4 control-label">Correo</label>

                  <div class="col-sm-8">
                    <input type="email" class="form-control" id="txtCorreo" placeholder="correo">
                  </div>
                </div>
                  <div class="form-group col-md-6">
                  <label for="txtTelefono" class="col-sm-4 control-label">Telefono</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="txtTelefono" placeholder="Telefono">
                  </div>
                </div>
                  <div style="clear: both;"></div>
                  <div class="form-group col-md-6">
                  <label for="txtCelurar" class="col-sm-4 control-label">Celular</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="txtCelular" placeholder="Celular">
                  </div>
                </div>
                  <div class="form-group col-md-6">
                  <label for="txtEstadoC" class="col-sm-4 control-label">Estado Civil</label>

                  <div class="col-sm-8">
                    <select class="form-control select2" style="width: 100%;">
                  <option selected="selected">Soltero</option>
                  <option>Casado</option>
                </select>
                  </div>
                </div>
                  
                <div style="clear: both;"></div>
                  <div class="form-group col-md-12">
                  <label for="txtDireccion" class="col-sm-2 control-label">Dirección</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="txtDireccion" placeholder="Dirección">
                  </div>
                </div>
                  <div style="clear: both;"></div>
                  <div class="form-group col-md-12">
                  <label for="txtObservaciones" class="col-sm-2 control-label">Observaciones</label>

                  <div class="col-sm-10">
                    <textarea id="txtObservaciones" name="txtObservaciones" class="form-control" rows="3"></textarea>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                  <button type="button" onclick="javascript:location.href = 'clientes'" class="btn btn-default">Cancelar</button>
                  <button type="submit" class="btn btn-info pull-right">Guardar</button>
                  <button type="button" onclick="javascript:location.href = 'clientes_archivos'" class="btn btn-primary pull-right">Archivos Personales</button>
                  <button type="button" onclick="javascript:location.href = 'clientes_referencias'" class="btn btn-primary pull-right">Referencias</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          <!-- /.box -->
          
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

<script type="text/javascript">
  window.onload = function() {    
    //Initialize Select2 Elements
    selectFrm('select2');

    //Inicializa DatePicker
    activaDatePicker('txtFecha');
  }
</script>
