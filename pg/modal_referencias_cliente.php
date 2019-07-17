<div class="modal fade" id="modal-referencias-cliente">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Referencias del cliente: <cite id="titleModRefClient"></cite></h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12"><button id="btnNvoRefCte" class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus"></i> Nueva referencia</button></div>
        </div>
        <br>
        <div id="cntnFrmReferenciaCte" class="row" style="display:none;">
          <div class="col-lg-12">
            <form id="frmReferenciaCte">
              <div class="row estilo-cntn-frm">
                <div class="row">
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="form-group">
                      <label for="cboTipoCliente">Nombre</label>
                      <input type="text" id="txtNombreRef" name="txtNombreRef" class="form-control" />
                      <div id="reqTxtNombreRef" class="msgError"></div>
                    </div>
                  </div>

                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="form-group">
                      <label for="txtApellidoPRef">Apellido paterno</label>
                      <input type="text" id="txtApellidoPRef" name="txtApellidoPRef" class="form-control" />
                      <div id="reqTxtApellidoPRef" class="msgError"></div>
                    </div>
                  </div>

                <div class="col-lg-4 col-md-4 col-sm-12">
                  <div class="form-group">
                    <label for="txtApellidoMRef">Apellido materno</label>
                    <input type="text" id="txtApellidoMRef" name="txtApellidoMRef" class="form-control" />
                    <div id="reqTxtApellidoMRef" class="msgError"></div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12">
                  <div class="form-group">
                    <label for="cboTipoRef">Tipo</label>
                    <select id="cboTipoRef" name="cboTipoRef" class="form-control" >
                      <option value="0">Seleccionar --</option>
                      <option value="1">Principal</option>
                      <option value="2">Normal</option>
                    </select>
                    <div id="reqCboTipoRef" class="msgError"></div>
                  </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12">
                  <div class="form-group">
                    <label for="txtDireccionRef">Dirección</label>
                    <input type="text" id="txtDireccionRef" name="txtDireccionRef" class="form-control" />
                    <div id="reqTxtDireccionRef" class="msgError"></div>
                  </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-12">
                  <div class="form-group">
                    <label for="txtTelefonoRef">Teléfono</label>
                    <input type="text" id="txtTelefonoRef" name="txtTelefonoRef" class="form-control" />
                    <div id="reqTxtTelefonoRef" class="msgError"></div>
                  </div>
                </div>
              </div>

                <div id="respServer2" class="col-lg-12 text-center"></div>

                <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                  <input type="hidden" id="idClienteRef" name="idClienteRef">
                  <input type="hidden" id="idReferencia" name="idReferencia">
                  <input type="hidden" id="opcionRC" name="opcion" value="211">
                  <button type="button" id="btnGuardaRefCte" class="btn btn-success btn-sm">Guardar</button>
                  <button type="button" id="btnCancelaRefCte" class="btn btn-secondary btn-sm">Cancelar</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <br>
        <div class="row">
          <div id="cntnListadoReferenciasCliente" class="col-lg-12">
          </div>
        </div>
      </div>
      <div class="modal-footer"></div>
    </div>            
  </div>          
</div>