<section class="content-header">
  <h1>
    Servicios y amenidades
    <small>Inmobiliaria</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="inicio"><i class="fa fa-home"></i> Inicio</a></li>
    <li><a href="#">Inmobiliaria</a></li>
    <li href="#">Catálogos</li>
    <li href="cat_servicio_amenidades" class="active">Servicios y amenidades</li>
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
      <form id="frmAmenidades">
        <div class="form-group">
          <label for="txtNombre">Nombre</label>
          <input type="text" id="txtNombre" name="txtNombre" class="form-control" placeholder="Nombre...">
          <div id="reqTxtNombre"></div>
        </div>

        <div class="form-group">
          <label for="exampleInputFile">Icono</label>
          <input type="file" id="flIcono" name="flIcono" class="form-control" />
          <input type="hidden" id="hdFlIcono" name="hdFlIcono" class="form-control" />
          <div id="reqFlIcono"></div>
        </div>

        <div class="form-group">
          <input type="hidden" id="idServAmenidad" name="idServAmenidad">
          <input type="hidden" id="opcion" name="opcion" value="205">
          <button id="btnGuardaServAmenidad" type="button" class="btn btn-primary btn-sm">Guardar</button>&nbsp;
          <button id="btnCancelaServAmenidad" type="button" class="btn btn-secondary btn-sm">Cancelar</button>
        </div>
      </form>
      </div>
      <div class="box-footer">
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
      <div id="cntnListServicioAmenidades" class="box-body">
        
      </div>

      <div class="box-footer">
       </div>
    </div>
  </div>
</section>
<!-- /.content -->

<script type="text/javascript">
  window.onload = function() {
    servicio_amenidades_listado();
  }
</script>