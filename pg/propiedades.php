<section class="content-header">
    <h1>
        Inmuebles
        <small>Inmobiliaria</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-home"></i> Inicio</a></li>
        <li class="active"><i class="fa fa-users"></i>Inmuebles</li>
    </ol>
</section>
<div class="box box-warning collapsed-box">
    <div class="box-header with-border" data-widget="collapse">
        <h3 class="box-title">Formulario de Busqueda.</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
            </button>
        </div>
        <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <form id="form_busquedaI">
            <div class="row">
                <div class="col-lg-6">
                    <fieldset class="form-group">
                        <label for="txtFolio" class="form-label semibold" for="n">Folio</label>
                        <input type="text" class="form-control" id="txtFolio" name="txtFolio" placeholder="Ingrese el Folio">
                    </fieldset>
                </div>
                <div class="col-lg-6">
                    <fieldset class="form-group">
                        <label for="txtAlias" class="form-label semibold" for="n">Alias</label>
                        <input type="text" class="form-control" id="txtAlias" name="txtAlias" placeholder="Ingrese el Alias">
                    </fieldset>
                </div>
                <div class="col-lg-6">
                    <fieldset class="form-group">
                        <label for="txtDireccion" class="form-label semibold" for="n">Dirección</label>
                        <input type="text" class="form-control" id="txtDireccion" name="txtDireccion" placeholder="Ingrese la Dirección">
                    </fieldset>
                </div>
                <div class="col-lg-6">
                    <fieldset class="form-group">
                        <label for="txtCliente" class="form-label semibold" for="n">Cliente</label>
                        <input type="text" class="form-control" id="txtCliente" name="txtCliente" placeholder="Ingrese al Cliente">
                    </fieldset>
                </div>

            </div><!--.row-->
            <div class="text-left">
                <input type="button" class="btn btn-success btn-sm" value=" Buscar " onclick="javascript: parent.propiedades_listado();" />
                <input type="button" class="btn btn-danger btn-sm" value=" Cancelar " onclick="location.href='propiedades'"/>
            </div>
         </form>
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->
<div class="row" id="contenedor">
    <div class="col-xl-12" id="listado" >

    </div><!--.col-->
</div><!--.row-->
<script type="text/javascript">
  window.onload = function() {
    propiedades_listado();
  }
</script>
