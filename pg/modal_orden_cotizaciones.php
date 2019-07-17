<div class="modal fade" id="modal-orden-compra-cotizaciones">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Cotizaciones de la orden de compra: <cite id="titleModOrdCompCotizaion"></cite></h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12"><button id="btnNvoCotizOrdComp" class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus"></i> Nueva cotización</button></div>
        </div>
        <br>
        <div id="cntnFrmCotizOrdComp" class="row" style="display:none;">
          <div class="col-lg-12">
            <form id="frmCotizOrdComp">
              <div class="row estilo-cntn-frm">
                <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="form-group">
                      <label for="txtArticulo">Proveedor</label>
                      <select id="cboProveedor" name="cboProveedor" class="form-control">
                        <option value="0">Seleccionar</option>
                        <option value="1">Proveedor 1</option>
                        <option value="2">Proveedor 2</option>
                        <option value="3">Proveedor 3</option>
                        <option value="4">Proveedor 4</option>
                        <option value="5">Proveedor 5</option>
                      </select>
                      <div id="reqCboProveedor" class="msgError"></div>
                    </div>
                  </div>

                  <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="form-group">
                      <label for="txtCuenta">Num. Cuenta</label>
                      <input type="text" id="txtCuenta" name="txtCuenta" class="form-control" />
                      <div id="reqTxtCuenta" class="msgError"></div>
                    </div>
                  </div>

                <div class="col-lg-3 col-md-3 col-sm-12">
                  <div class="form-group">
                    <label for="txtMonto">Monto</label>
                    <input type="number" id="txtMonto" name="txtMonto" class="form-control" />
                    <div id="reqTxtMonto" class="msgError"></div>
                  </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-12">
                  <div class="form-group">
                    <label for="flImagen">Imagen cotización</label>
                    <input type="file" id="flImagen" name="flImagen" class="form-control" />
                    <input type="hidden" id="hdFlImagen" name="hdFlImagen" class="form-control" />
                    <div id="reqFlImagen" class="msgError"></div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="form-group">
                    <label for="txtObservaciones">Observaciones</label>
                    <textarea id="txtObservaciones" name="txtObservaciones" class="form-control"></textarea>
                  </div>
                </div>
              </div>

                <div id="respServer3" class="col-lg-12 text-center"></div>

                <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                  <input type="hidden" id="idOrdCompCot" name="idOrdCompCot">
                  <input type="hidden" id="idCotizacion" name="idCotizacion">
                  <input type="hidden" id="opcionCotiz" name="opcion" value="219">
                  <button type="button" id="btnGuardaCotizOrdComp" class="btn btn-success btn-sm">Guardar</button>
                  <button type="button" id="btnCancelaCotizOrdComp" class="btn btn-secondary btn-sm">Cancelar</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <br>
        <div class="row">
          <div id="cntnListadoCotizaciones" class="col-lg-12">
          </div>
        </div>
      </div>
      <div class="modal-footer"></div>
    </div>            
  </div>          
</div>