<section class="content-header">
  <h1>
    Antigüedad
    <small>Inmobiliaria</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="inicio"><i class="fa fa-home"></i> Inicio</a></li>
    <li><a href="#">Inmobiliaria</a></li>
    <li href="#">Catálogos</li>
    <li href="cat_antiguedad" class="active">Antigüedad</li>
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
        <form id="frmAntique" name="frmAntique">
          <div class="form-group">
            <label for="txtNombre">Nombre</label>
            <input type="text" id="txtNombre" name="txtNombre" class="form-control" placeholder="Nombre...">
            <div id="reqTxtNombre"></div>
          </div>

          <div class="form-group">
            <label for="flIcono">Icono</label>
            <input type="file" id="flIcono" name="flIcono" class="form-control" />
            <input type="hidden" id="hdFlIcono" name="hdFlIcono" class="form-control" />
            <div id="reqFlIcono"></div>
          </div>
          <div id="respServer"></div>
          <div class="form-group">
            <input type="hidden" id="idAntiguedad" name="idAntiguedad">
            <input type="hidden" id="opcion" name="opcion" value="5">
            <button class="btn btn-primary btn-sm" id="btnGuardarAnt" type="button" name="btnGuardarAnt">Guardar</button>&nbsp;
            <button class="btn btn-secondary btn-sm"id="cancelar" type="button" name="btnCancelar">Cancelar</button>
          </div>
        </form>
      </div>
      <div class="box-footer">
       </div>
    </div>
  </div>

  <div class="">
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
            <div class="table"id="cntnListAntiguedad">

            </div>
        </div>

        <div class="box-footer">
         </div>
      </div>
    </div>
  </div>
</section>
<!-- /.content -->

<script type="text/javascript">
  window.onload = function() {
    antiquity_list();
  }
</script>
