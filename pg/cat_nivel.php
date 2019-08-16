<section class="content-header">
  <h1>Nivel</h1>
  <small>Inmobiliaria</small>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-home"></i> Inicio</a></li>
    <li><a href="#">Inmobiliaria</a></li>
    <li href="cat_nivel">  </li>
  </ol>
</section>

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
        <form id="frmLevel" name="frmLevel" autocomplete="off">
          <input autocomplete="false" name="hidden" type="text" style="display:none;">
          <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Nombre del nivel">
          </div>
          <div id="respServer"></div>
          <div class="form-group">
            <input type="hidden" id="id" name="id">
            <input type="hidden" id="opcion" name="opcion" value="17">
            <button class="btn btn-primary btn-sm" id="saveLevel" type="submit" name="saveLevel">Guardar</button>&nbsp;
            <button class="btn btn-secondary btn-sm"id="cancelLevel" type="button" name="cancelLevel">Cancelar</button>
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
          <div class="table"id="cntnListLevels">

          </div>
      </div>

      <div class="box-footer">
       </div>
    </div>
  </div>
</section>

<script type="text/javascript">
  window.onload = function(){
    listLevels();
  }
</script>
