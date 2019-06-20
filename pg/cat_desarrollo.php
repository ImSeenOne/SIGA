<section class="content-header">
  <h1>
    Desarrollos
    <small>Inmobiliaria</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="inicio"><i class="fa fa-home"></i> Inicio</a></li>
    <li><a href="#">Inmobiliaria</a></li>
    <li href="#">Catálogos</li>
    <li href="cat_desarrollo" class="active">Desarrollos</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">&nbsp;</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>
        <!-- /.box-header -->
    <div class="box-body">
      <div class="row" style="margin-top:-1.2em!important;">
        <div class="col-lg-6"></div>
        <div class="col-lg-6 alignMiddle">
        	<button id="btnNvoDesarrollo" type="button" class="btn btn-primary btn-sm pull-right mt-2em" >Nuevo desarrollo</button>
        </div>
      </div>

      <div id="frmDesarrollo" class="row cntntFrm mt-1em" style="display:none;">
        <div class="col-lg-12">
          <div class="col-lg-3">
            <div class="form-group">
              <label for="txtNombre">Nombre</label>
              <input type="text" id="txtNombre" name="txtNombre" class="form-control" placeholder="Nombre">
              <div id="reqTxtNombre" style="color: red;"></div>
            </div>
          </div>

          <div class="col-lg-3">
            <div class="form-group">
              <label for="txtAlias">Alias</label>
              <input type="text" id="txtAlias" name="txtAlias" class="form-control" placeholder="Alias">
              <div id="reqTxtAlias"></div>
            </div>
          </div>

          <div class="col-lg-3">
            <div class="form-group">
              <label for="txtCp">C.P.</label>
              <input type="text" id="txtCp" name="txtCp" class="form-control" placeholder="Código postal" maxlength="5">
              <div id="reqTxtCp"></div>
            </div>
          </div>

          <div class="col-lg-3">
            <div class="form-group">
              <label for="txtMonto">Icono</label>
              <input type="file" id="flIcono" name="flIcono" class="form-control"/>
              <div id="reqFlIcono"></div>
            </div>
          </div>

          <div id="respServer"></div>
          <div class="form-group">
            <input type="hidden" id="idDesarrollo" name="idDesarrollo">
            <input type="hidden" id="opcion" name="opcion" value="1">
            <button id="btnGuardaDesarrollo" type="button" class="btn btn-primary btn-sm">Guardar</button>&nbsp;
            <button id="btnCancelarDesarrollo" type="button" class="btn btn-secondary btn-sm">Cancelar</button>
          </div>
        </div>
      </div>
      <hr>
      <div class="row">
        <div id="cntnListPagos" class="col-lg-12 col-md-12 col-sm-12">
        </div>
      </div>
    </div>

    <div class="box-footer">
     </div>
  </div>
<!-- /.row -->
</section>
<!-- /.content -->

<script type="text/javascript">
  window.onload = function() {
    desarrollo_listado();
  }
</script>
