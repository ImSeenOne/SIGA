<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<style type="text/css">
  .classFrmRegClient{border-bottom:1px dotted #e8e8e8;margin:1em!important;padding:0.8em!important;width:97%;}
  .mt-1-9em{margin-top:1.9em!important;}
  .mr_04em{margin-right:0.4em!important;}
  .estilo-cntn-frm{border:1px dotted #e9e9e9;box-shadow: 0 0 px 1px #CFCFCF;margin:0.5em 1.5em!important;padding:1em!important;width:96%;}
  .dispInline{display:inline-block!important;}
</style>
<section class="content-header">
  <h1>
    Orden de compra
    <small>Compras</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="inicio"><i class="fa fa-home"></i> Inicio</a></li>
    <li><a href="#">Compras</a></li>    
    <li href="cat_desarrollo" class="active">Orden de compra</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">  
  <div class="col-lg-12 col-md-12 col-sm-12">
    <div class="box box-default">
      <div class="box-header with-border">
        <h3 class="box-title">&nbsp;</h3>      

        <div class="box-tools pull-right" style="width:30%;">
          <button id="btnNvaOrdenCompra" class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus"></i> Nueva orden</button>
          <button id="btnBusqOrdenCompra" class="btn btn-success btn-sm pull-right mr_04em"><i class="fa fa-search"></i> Búsqueda</button>
        </div>
      </div>

      <div id="cntnBusqOrdenCompra" class="col-lg-12 col-md-12 col-sm-12 classFrmRegClient" style="display:none;">        
          <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12">
              <div class="form-group">
                  <label for="txtFolioBusq">FOLIO</label>
                  <input type="text" id="txtFolioBusq" name="txtFolioBusq" class="form-control" />
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-12">
              <div class="form-group">
                  <label for="cboObraBusq">OBRA</label>
                  <select id="cboObraBusq" name="cboObraBusq" class="form-control">
                    <option value="0"> Todas </option>
                    <?php $funciones->llenarcombo($conexion->obtenerlista($querys1->loadCboObras())); ?>
                  </select>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="form-group">
                  <label for="cboEmpresaBusq">EMPRESA</label>
                  <select id="cboEmpresaBusq" name="cboEmpresaBusq" class="form-control">
                    <option value="0"> Todas </option>
                    <option value="1"> Oficina </option>
                    <option value="2"> Taller </option>
                    <option value="3"> Obras </option>
                    <option value="4"> ---- </option>
                    <option value="5"> Casa aguilera </option>
                    <option value="6"> Refaccionaria </option>
                  </select>                
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-12 text-center">
              <label for="cboTipoClienteBusq">ESTATUS</label>
                  <select id="cboEstatusBusq" name="cboEstatusBusq" class="form-control">
                  <option value="-1"> Todos </option>
                  <option value="0"> En Captura </option>
                  <option value="1"> En espera </option>
                  <option value="2"> En proceso </option>
                  <option value="3"> Autorizado </option>
                  <option value="4"> Concluido </option>
                  <option value="5"> Cancelado </option>
              </select>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12">
              <div class="form-group">
                  <label for="cboTipoCompraBusq">TIPO DE COMPRA</label>
                  <select id="cboTipoCompraBusq" name="cboTipoCompraBusq" class="form-control">
                    <option value="0"> Todas </option>
                    <option value="1"> Credito </option>
                    <option value="2"> De contado </option>
                  </select>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-12">
              <div class="form-group">
                  <label for="cboObraBusq" class="dispInline">FECHA DESDE</label>
                  <input type="date" id="txtFechaDesde" name="txtFechaDesde" class="form-control" >
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-12">
              <div class="form-group">
                  <label for="txtFechaHasta">FECHA HASTA</label>
                  <input type="date" id="txtFechaHasta" name="txtFechaHasta" class="form-control" >
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-12 text-center">
              <button type="button" id="btnBusqOrdComp" class="btn btn-primary btn-sm mt-1-9em"><i class="fa fa-search"></i> Buscar</button>
              <button type="button" id="btnResetBusqOrdComp" class="btn btn-secondary btn-sm mt-1-9em"><i class="fa fa-eraser"></i> Limpiar</button>           
            </div>
          </div>        
      </div>

      <div id="cntnFrmNvaOrdenComp" class="col-lg-12 col-md-12 col-sm-12 classFrmRegClient" style="display:none;">
        <h3 id="txtTitleFrmClient" class="box-title"></h3>

        <form id="frmNvaOrdenComp">
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="form-group">
                <label for="txtFolio">Folio</label>
                <input type="text" id="txtFolio" name="txtFolio" class="form-control" />
                <div id="reqTxtFolio" class="msgError"></div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="form-group">
                <label for="cboObra">Obra</label>
                <select id="cboObra" name="cboObra" class="form-control">
                    <option value="0"> Todas </option>
                    <?php $funciones->llenarcombo($conexion->obtenerlista($querys1->loadCboObras())); ?>
                  </select>
                  <div id="reqCboObra"></div>
              </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="form-group">
                <label for="cboEmpresa">Empresa</label>
                <select id="cboEmpresa" name="cboEmpresa" class="form-control">
                    <option value="0"> Todas </option>
                    <option value="1"> Oficina </option>
                    <option value="2"> Taller </option>
                    <option value="3"> Obras </option>
                    <option value="4"> ---- </option>
                    <option value="5"> Casa aguilera </option>
                    <option value="6"> Refaccionaria </option>
                  </select>
                  <div id="reqCboEmpresa"></div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="form-group">
                <label for="txtDireccionObra">Dirección obra</label>
                <input type="text" id="txtDireccionObra" name="txtDireccionObra" class="form-control" />
                <div id="reqTxtDireccionObra" class="msgError"></div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="form-group">
                <label for="txtFechaCapt">fecha captura</label>
                <input type="date" id="txtFechaCapt" name="txtFechaCapt" class="form-control" value="<?= date('Y-m-d') ?>" />
                <div id="reqCboObra" class="msgError"></div>
              </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="form-group">
                <label for="txtResidente">Residente</label>
                <input type="text" id="txtResidente" name="txtResidente" class="form-control" />
                <div id="reqTxtResidente" class="msgError"></div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12">
              <div class="form-group">
                <label for="cboTipoComp">Tipo compra</label>
                <select id="cboTipoComp" name="cboTipoComp" class="form-control">
                  <option value="1"> Credito </option>
                  <option value="2"> De contado </option>
                </select>
                <div id="reqCboTipoComp" class="msgError"></div>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12">
              <div class="form-group">
                <label for="cboEstatus">Estatus de la orden</label>
                <select id="cboEstatus" name="cboEstatus" class="form-control">
                  <option value="0"> En captura </option>
                  <option value="1"> En espera </option>
                  <option value="2"> En proceso </option>
                  <option value="3"> Autorizda </option>
                  <option value="4"> Concluida </option>
                  <option value="5"> Cancelada </option>
                </select>
                <div id="reqCboEstatusComp" class="msgError"></div>
              </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-12">
              <div class="form-group">
                <label for="cboTipoComp">Archivo transferencia</label>
                <input type="file" id="flTransferencia" name="flTransferencia" class="form-control" disabled />
                <div id="reqFlTransferencia" class="msgError"></div>
              </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-12">
              <div class="form-group">
                <label for="cboTipoComp">Archivo Factura</label>
                <input type="file" id="flFactura" name="flFactura" class="form-control" disabled />
                <div id="reqFlFactura" class="msgError"></div>
              </div>
            </div>
          </div>

          <div class="form-group text-center">
            <input type="hidden" id="idOrdenComp" name="idOrdenComp" />         
            <input type="hidden" id="opcion" name="opcion" value="215" />
            <button type="button" id="btnGuardarOrdenComp" class="btn btn-primary btn-sm">Guardar</button>&nbsp;
            <button type="button" id="btnCancelarOrdenComp" class="btn btn-secondary btn-sm">Cancelar</button>
          </div>
          <div id="respServer" class="col-lg-12 text-center"></div>
        </form>
      </div>

          <!-- /.box-header -->
      <div id="cntnListOrdenesCompra" class="box-body">
        
      </div>

      <div class="box-footer">
       </div>
    </div>
  </div>
</section>
<!-- /.content -->

<?php require 'modal_orden_compra_artiuculos_cliente.php'; ?>
<?php require 'modal_orden_cotizaciones.php'; ?>

<script type="text/javascript">
  window.onload = function() {
    ordenes_compra_listado(1);
  }
</script>