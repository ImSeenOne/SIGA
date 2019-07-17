<section class="content-header">
  <h1>
    Cocina
    <small>Inmobiliaria</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="inicio"><i class="fa fa-home"></i> Inicio</a></li>
    <li><a href="#">Inmobiliaria</a></li>
    <li href="#">Catálogos</li>
    <li href="cat_desarrollo" class="active">Cocina</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="col-lg-4 col-md-4 col-sm-12">
    <div class="box box-default">
      <div class="box-header with-border">
        <h3 class="box-title">Nuevo registro</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>
          <!-- /.box-header -->
      <div class="box-body">
        <form id="frmCocina" name="bntCancelCocina">
        <div class="form-group">
          <label for="txtNombre">Nombre</label>
          <input type="text" id="txtNombre" name="txtNombre" class="form-control" placeholder="Nombre...">
          <div id="reqTxtNombre"></div>
        </div>

        <div class="form-group">
          <label for="exampleInputFile">Icono</label>
          <input type="file" id="flIcono" name="flIcono" class="form-control" />
          <input type="hidden" name="txtIcono" id="txtIcono"/>
          <div id="reqFlIcono"></div>
        </div>
        <div id="respServer"></div>
      </form>
      </div>
      <div class="box-footer">
        <div class="form-group">
          <input type="hidden" id="opcion" form="frmCocina" name="opcion" value="2"/>
          <input type="hidden" id="txtFecha" form="frmCocina" name="txtFecha" value="0"/>
          <input type="hidden" id="txtId" form="frmCocina" name="txtId" value="0"/>
          <button type="button" id="bntAddCocina" name="btnAddCocina" form="frmCocina" class="btn btn-primary btn-sm">Guardar</button>&nbsp;
          <button type="button" id="bntCancelCocina" name="bntCancelCocina" form="frmCocina" class="btn btn-secondary btn-sm">Cancelar</button>
        </div>
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
      <div id="cntnListCocina" class="box-body">

      </div>

      <div class="box-footer">
       </div>
    </div>
  </div>
</section>
<!-- /.content -->

<script type="text/javascript">
  window.onload = function() {
    cocina_listado();
  }
</script>
