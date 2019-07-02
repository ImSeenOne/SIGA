<style type="text/css">
  .classFrmRegClient{border-bottom:1px dotted #e8e8e8;margin:1em!important;width:97%;}
  .mr_04em{margin-right:0.4em!important;}
  .estilo-cntn-frm{border:1px dotted #e9e9e9;box-shadow: 0 0 px 1px #CFCFCF;margin:0.5em 1.5em!important;padding:1em!important;width:96%;}
</style>
<section class="content-header">
  <h1>
    Clientes
    <small>Inmobiliaria</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="inicio"><i class="fa fa-home"></i> Inicio</a></li>
    <li><a href="#">Inmobiliaria</a></li>    
    <li href="cat_desarrollo" class="active">Clientes</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">  
  <div class="col-lg-12 col-md-12 col-sm-12">
    <div class="box box-default">
      <div class="box-header with-border">
        <h3 class="box-title">&nbsp;</h3>      

        <div class="box-tools pull-right" style="width:30%;">
          <button id="btnNvoRegCliente" class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus"></i> Nuevo cliente</button>
          <button id="btnNvoRegCliente" class="btn btn-success btn-sm pull-right mr_04em"><i class="fa fa-search"></i> Búsqueda</button>
        </div>
      </div>

      <div id="cntnFrmNvoClient" class="col-lg-12 col-md-12 col-sm-12 classFrmRegClient" style="display:none;">
        <h3 id="txtTitleFrmClient" class="box-title"></h3>

        <form id="frmNvoCliente">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="form-group">
              <label for="cboTipoCliente">Tipo de cliente</label>
              <select id="cboTipoCliente" name="cboTipoCliente" class="form-control">
                <option value="0"> Seleccionar --</option>
                <option value="1"> Arrendatario </option>
                <option value="2"> Comprador </option>
              </select>
              <div id="reqCboTipoCliente" class="msgError"></div>
            </div>
          </div>

          
            <div class="col-lg-6 col-md-6 col-sm-12">
              <div class="form-group">
                <label for="txtRfc">RFC</label>
                <input type="text" id="txtRfc" name="txtRfc" class="form-control" />
                <div id="reqTxtRfc" class="msgError"></div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="form-group">
                <label for="txtNombre">Nombre</label>
                <input type="text" id="txtNombre" name="txtNombre" class="form-control" />              
                <div id="reqTxtNombre" class="msgError"></div>
              </div>
            </div>
          
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="form-group">
                <label for="txtApellidoP">Apellido paterno</label>
                <input type="text" id="txtApellidoP" name="txtApellidoP" class="form-control" />      
                <div id="reqTxtApellidoP" class="msgError"></div>
              </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="form-group">
                <label for="txtApellidoM">Apellido materno</label>
                <input type="text" id="txtApellidoM" name="txtApellidoM" class="form-control" />
                <div id="reqTxtApellidoM" class="msgError"></div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="form-group">
                <label for="cboEstadoCivil">Estado civil</label>
                <select id="cboEstadoCivil" name="cboEstadoCivil" class="form-control">
                  <option value="0"> Seleccionar -- </option>
                  <option value="1"> Soltero </option>
                  <option value="2"> Casado </option>
                </select>
                <div id="reqCboEstadoCivil" class="msgError"></div>
              </div>
            </div>
          
            <div class="col-lg-8 col-md-8 col-sm-12">
              <div class="form-group">
                <label for="cboEstadoCivil">Domicilio</label>
                <input type="text" id="txtDomicilio" name="txtDomicilio" class="form-control" />
                <div id="reqCboDomicilio" class="msgError"></div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="form-group">
                <label for="txtCorreo">Correo</label>
                <input type="email" id="txtCorreo" name="txtCorreo" class="form-control" />              
                <div id="reqTxtCorreo" class="msgError"></div>
              </div>
            </div>          
          
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="form-group">
                <label for="txtTelefono">Teléfono</label>
                <input type="text" id="txtTelefono" name="txtTelefono" class="form-control" />              
                <div id="reqTxtTelefono" class="msgError"></div>
              </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="form-group">
                <label for="txtCelular">Celular</label>
                <input type="text" id="txtCelular" name="txtCelular" class="form-control" />              
                <div id="reqTxtCelular" class="msgError"></div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="form-group">
                <label for="txtObservaciones">Observaciones</label>
                <textarea id="txtObservaciones" name="txtObservaciones" class="form-control"></textarea>
                <div id="reqTxtObservaciones" class="msgError"></div>
              </div>
            </div>
          </div>
          

          <div class="form-group text-center">
            <input type="hidden" id="idCliente" name="idCliente">
            <input type="hidden" id="opcion" name="opcion" value="207">
            <button type="button" id="btnGuardarRegClient" class="btn btn-primary btn-sm">Guardar</button>&nbsp;
            <button type="button" id="btnCancelarRegClient" class="btn btn-secondary btn-sm">Cancelar</button>
          </div>
          <div id="respServer" class="col-lg-12 text-center"></div>
        </form>
      </div>

          <!-- /.box-header -->
      <div id="cntnListClientes" class="box-body">
        
      </div>

      <div class="box-footer">
       </div>
    </div>
  </div>
</section>
<!-- /.content -->

<?php require 'modal_archivos_cliente.php' ?>
<?php require 'modal_referencias_cliente.php' ?>
<?php require 'modal_interes_cliente.php' ?>

<script type="text/javascript">
  window.onload = function() {
    clientes_listado(1);
  }
</script>