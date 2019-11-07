<section class="content-header">
  <h1>
    Departamentos
    <small>Recursos Humanos</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="inicio"><i class="fa fa-home"></i> Inicio</a></li>
    <li><a href="#">Recursos Humanos</a></li>
    <li href="#">Catálogos</li>
    <li href="cat_deptos_emp" class="active">Departamentos</li>
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
        <form autocomplete="off" id="frmEmpDept" name="frmEmpDept">
          <input autocomplete="false" name="hidden" type="text" style="display:none;">
          <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Nombre...">
          </div>
          <div id="respServer"></div>
          <input type="hidden" id="id" name="id">
          <input type="hidden" id="opcion" name="opcion" value="43">
          <div class="form-group">
            <button class="btn btn-primary btn-sm" type="submit">Guardar</button>&nbsp;
            <button class="btn btn-secondary btn-sm" id="btnCancelEmpCategory" type="button">Cancelar</button>
          </div>
        </form>
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
            <div class="table table-responsive"id="cntnListEmpDept">

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
    listEmpDepts();
  }
</script>
