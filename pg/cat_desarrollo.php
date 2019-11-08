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

      <form id="frmDesarrollo" class="row cntntFrm mt-1em" style="display:none;">
        <div class="col-lg-12 col-lg-12 col-md-12 col-sm-12">
          <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label for="txtNombre">Nombre</label>
              <input type="text" id="txtNombre" name="txtNombre" class="form-control" placeholder="Nombre">
              <div id="reqTxtNombre" style="color: red;"></div>
            </div>
          </div>

          <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label for="txtAlias">Identificador</label>
              <input type="text" id="txtAlias" name="txtAlias" class="form-control" placeholder="Alias" maxlength="2">
              <div id="reqTxtAlias" style="color: red;"></div>
            </div>
          </div>

          <div hidden class="col-lg-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label for="txtNumeroOferta">Número etapa/oferta</label>
              <input type="text" id="txtNumeroOferta" name="txtNumeroOferta" class="form-control" placeholder="Número" maxlength="50">
              <div id="reqTxtAlias" style="color: red;"></div>
            </div>
          </div>

          <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label for="txtCp">C.P.</label>
              <input type="text" id="txtCp" onkeypress="isNumberKey(event)" name="txtCp" class="form-control" placeholder="Código postal" maxlength="5">
              <div id="reqTxtCp" style="color: red;"></div>
            </div>
          </div>

          <div class="col-lg-3 col-md-4 col-sm-12">
            <div class="form-group">
              <label for="flIcono">Icono</label>
              <input type="file" id="flIcono" name="flIcono" class="form-control"/>
              <input type="hidden" id="hdFlIcono" name="hdFlIcono" class="form-control"/>
              <div id="reqFlIcono"></div>
            </div>
          </div>

          

          
          <div class="form-group col-lg-12 col-md-4 col-sm-12 mt-2em pull-right">
            <input type="hidden" id="idDesarrollo" name="idDesarrollo">
            <input type="hidden" id="opcion" name="opcion" value="1">
            <input type="hidden" id="latitud" name="latitud" value="16.7473613"/>
            <input type="hidden" id="longitud" name="longitud" value="-93.1203101"/>
            <div class="col-sm-12 col-lg-4 col-md-6">
            
              <button id="btnSaveGeo" type="button" 
                  class="form-control btn btn-success btn-sm">Geolocalizar</button>&nbsp;
          </div>
            <div class="col-sm-12 col-lg-4 col-md-6">
              <button id="btnGuardaDesarrollo" type="button" class="btn btn-primary btn-block">Guardar</button>&nbsp;
            </div>
            <div class="col-sm-12 col-lg-4 col-md-6">
              <button id="btnCancelarDesarrollo" type="button" class="btn btn-secondary btn-block">Cancelar</button>
            </div>
          </div>
        </div>
      </form>
      <div id="respServer"></div>
      <hr>
      <div class="row">
        <div id="cntnListPagos" class="col-lg-12 col-md-12 col-sm-12 table-responsive">
        </div>
      </div>
    </div>
  </div>
<!-- /.row -->
</section>
<!-- /.content -->
<div class="form-group mfp-hide" id="geolocalizacion">
    <label class="form-label" for="mapa_canvas">Localización</label>
    <br>
    <div id="color-palette" style="display:none;"></div>
    <a class="btn btn-success btn-sm pull-right" href="javascript:$.magnificPopup.close();">Cerrar</a>
    
    <div id="pac-input"></div>
    <div id="cursel" style="display:none !important;"></div>
    <div style="width: 100%; height: 70vh; " id="mapa_canvas"></div>
</div>
<script type="text/javascript">
  window.onload = function() {
    desarrollo_listado();
    
    Geo("btnSaveGeo");
    setTimeout(mapa_formregistro, 1000);
  }

function isNumberKey(evt) {
  var charCode = (evt.which) ? evt.which : evt.keyCode;
  // Added to allow decimal, period, or delete
  if (charCode == 110 || charCode == 190 || charCode == 46)
    return true;

  if (charCode > 31 && (charCode < 48 || charCode > 57))
      return false;

    return true;
}
</script>
