<div class="modal fade" id="modal-interes-cliente">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Propiedades de interes del cliente: <cite id="titleModInteresClient"></cite></h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12"><button id="btnNvoInteresCte" class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus"></i> Nuevo</button></div>
        </div>
        <br>
        <div id="cntnFrmInteresCte" class="row" style="display:none;">
          <div class="col-lg-12">
            <form id="frmInteresCte">
              <div class="row estilo-cntn-frm">
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group">
                      <label for="txtAgente">Agente</label>
                      <input type="text" id="txtAgente" name="txtAgente" class="form-control" />
                      <div id="reqTxtAgente" class="msgError"></div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="form-group">
                      <label for="txtFechaFirma">Fecha firma</label>
                      <input type="date" id="txtFechaFirma" name="txtFechaFirma" class="form-control" disabled />
                      <div id="reqTxtFechaFirma" class="msgError"></div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="form-group">
                      <label for="txtFechaEntrega">Fecha entrega</label>
                      <input type="date" id="txtFechaEntrega" name="txtFechaEntrega" class="form-control" disabled />
                      <div id="reqTxtFechaEntrega" class="msgError"></div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group">
                      <label for="cboPropiedad">Propiedad</label>
                      <select id="cboPropiedad" name="cboPropiedad" class="form-control">
                      </select>
                      <div id="reqCboPropiedad" class="msgError"></div>
                    </div>
                  </div>

                  <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="form-group">
                      <label for="cboEstatusInt">Estatus</label>
                      <select id="cboEstatusInt" name="cboEstatusInt" class="form-control">
                      </select>
                      <div id="reqCboEstatusInt" class="msgError"></div>
                    </div>
                  </div>

                  <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="form-group">
                      <label for="txtMonto">Monto</label>
                      <input type="text" id="txtMonto" name="txtMonto" class="form-control" />
                      <div id="reqTxtMonto" class="msgError"></div>
                    </div>
                  </div>
                </div>

                <div id="respServer3" class="col-lg-12 text-center"></div>

                <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                  <input type="hidden" id="idClienteInt" name="idClienteInt">
                  <input type="hidden" id="idInteres" name="idInteres">
                  <input type="hidden" id="opcionIC" name="opcion" value="213">
                  <button type="button" id="btnGuardaInteresCte" class="btn btn-success btn-sm">Guardar</button>
                  <button type="button" id="btnCancelaInteresCte" class="btn btn-secondary btn-sm">Cancelar</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <br>
        <div class="row">
          <div id="cntnListadoInteresCliente" class="col-lg-12">
          </div>
        </div>
      </div>
      <div class="modal-footer"></div>
    </div>            
  </div>          
</div>