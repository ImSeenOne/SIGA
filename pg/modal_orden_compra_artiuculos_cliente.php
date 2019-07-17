<div class="modal fade" id="modal-orden-compra-artiuclos">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Artículos de la orden de compra: <cite id="titleModOrdCompArt"></cite></h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12"><button id="btnNvoArtOrdComp" class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus"></i> Nuevo artículo</button></div>
        </div>
        <br>
        <div id="cntnFrmArtOrdComp" class="row" style="display:none;">
          <div class="col-lg-12">
            <form id="frmArtOrdComp">
              <div class="row estilo-cntn-frm">
                <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="form-group">
                      <label for="txtArticulo">Artículo</label>
                      <input type="text" id="txtArticulo" name="txtArticulo" class="form-control" />
                      <div id="reqTxtArticulo" class="msgError"></div>
                    </div>
                  </div>

                  <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="form-group">
                      <label for="txtUnidad">Unidad</label>
                      <input type="text" id="txtUnidad" name="txtUnidad" class="form-control" />
                      <div id="reqTxtUnidad" class="msgError"></div>
                    </div>
                  </div>

                <div class="col-lg-3 col-md-3 col-sm-12">
                  <div class="form-group">
                    <label for="txtCantidad">Cantidad</label>
                    <input type="number" id="txtCantidad" name="txtCantidad" class="form-control" />
                    <div id="reqTxtCantidad" class="msgError"></div>
                  </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-12">
                  <div class="form-group">
                    <label for="txtCosto">Costo</label>
                    <input type="text" id="txtCosto" name="txtCosto" class="form-control" />
                    <div id="reqTxtCosto" class="msgError"></div>
                  </div>
                </div>
              </div>

                <div id="respServer2" class="col-lg-12 text-center"></div>

                <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                  <input type="hidden" id="idOrdComp" name="idOrdComp">
                  <input type="hidden" id="idArticulo" name="idArticulo">
                  <input type="hidden" id="opcionAC" name="opcion" value="217">
                  <button type="button" id="btnGuardaArtOrdComp" class="btn btn-success btn-sm">Guardar</button>
                  <button type="button" id="btnCancelaArtOrdComp" class="btn btn-secondary btn-sm">Cancelar</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <br>
        <div class="row">
          <div id="cntnListadoArticulos" class="col-lg-12">
          </div>
        </div>
      </div>
      <div class="modal-footer"></div>
    </div>            
  </div>          
</div>