<div class="modal fade" id="modal-archivos-cliente">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Archivos personales del cliente: <cite id="titleModFileClient"></cite></h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12"><button id="btnNvoArchivoCte" class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus"></i> Nuevo archivo</button></div>
        </div>
        <br>
        <div id="cntnFrmArchivoCte" class="row" style="display:none;">
          <div class="col-lg-12">
            <form id="frmArchivosCte">
              <div class="row estilo-cntn-frm">
                <div class="col-lg-6 col-md-6 col-sm-12">
                  <div class="form-group">
                    <label for="cboTipoCliente">Archivo</label>
                    <input type="file" id="flArchivo" name="flArchivo" class="form-control" />
                    <input type="hidden" id="hdFlArchivo" name="hdFlArchivo" />
                    <div id="reqFlArchivo" class="msgError"></div>
                  </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12">
                  <div class="form-group">
                    <label for="txtDescripcion">Descripción</label>
                    <input type="text" id="txtDescripcion" name="txtDescripcion" class="form-control" />
                    <div id="reqTxtDescripcion" class="msgError"></div>
                  </div>
                </div>

                <div id="respServer1" class="col-lg-12 text-center"></div>

                <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                  <input type="hidden" id="idClienteArchivo" name="idClienteArchivo">
                  <input type="hidden" id="idArchivo" name="idArchivo">
                  <input type="hidden" id="opcionAC" name="opcion" value="209">
                  <button type="button" id="btnGuardaArchivoCte" class="btn btn-success btn-sm">Guardar</button>
                  <button type="button" id="btnCancelaArchivoCte" class="btn btn-secondary btn-sm">Cancelar</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <br>
        <div class="row">
          <div id="cntnListadoArchivosCliente" class="col-lg-12">
          </div>
        </div>
      </div>
      <div class="modal-footer"></div>
    </div>            
  </div>          
</div>