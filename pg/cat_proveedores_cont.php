<section class="content-header">
  <h1>Proveedores</h1>
  <small>Contabilidad</small>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-home"></i>Inicio</a></li>
    <li><a href="#">Contabilidad</a></li>
    <li href="cat_conceptos_cont">Proveedores</li>
  </ol>
</section>

<section class="content">
  <div class="col-lg-4 col-md-4 col-sm-12">
    <div class="box box-default">
      <div class="box-header with-border">
        <h3 class="box-title">Nuevo Proveedor</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>
          <!-- /.box-header -->
      <div class="box-body">
        <form id="frmProviderAcc" name="frmProviderAcc" autocomplete="off">
          <input autocomplete="false" name="hidden" type="text" style="display:none;">
          <div class="form-group">
            <label for="name">Nombre del Proveedor</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Nombre del proveedor">
          </div>
          <div id="respServer"></div>
          <div class="form-group">
            <input type="hidden" id="id" name="id">
            <input type="hidden" id="opcion" name="opcion" value="37">
            <button class="btn btn-primary btn-sm" type="submit">Guardar</button>&nbsp;
            <button class="btn btn-secondary btn-sm"id="cancelProvider" type="button">Cancelar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="col-lg-8 col-md-8 col-sm-12">
    <div class="box box-default">
      <div class="box-header with-border">
        <h3 class="box-title">Listado</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>
          <!-- /.box-header -->
      <div class="box-body">
          <div class="table"id="cntnListProvidersAcc">

          </div>
      </div>

      <div class="box-footer">
       </div>
    </div>
  </div>
</section>

<script type="text/javascript">
  window.onload = function(){
    listProvidersAcc();
  };
</script>
