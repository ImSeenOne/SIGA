<div class="modal fade" id="modalPhysProgDetails">
  <div class="modal-dialog modal-xl" role="document" style="width:90%">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Conceptos del reporte de avances <cite id="physProgFolio"></cite></h4>
      </div>
      <div class="modal-body">
        <form autocomplete="off" id="frmConcept" name="frmConcept">
          <input autocomplete="false" name="hidden" type="text" style="display:none;">
            <div class="col-lg-12 col-md-12 col-sm-12">
              <p><br>
                <b>Folio: </b> <cite id="folioModal">Cargando...</cite><br>
                <b>Residente: </b> <cite id="residentModal">Cargando...</cite><br>
                <b>Obra: </b> <cite id="workModal">Cargando...</cite>
              </p>
            </div>
          <div class="form-group col-lg-3 col-md-6 col-sm-6">
            <label class="text-center" for="concepts">Concepto</label>
            <select name="concepts" id="concepts" class="form-control select2" onchange="setConceptData()">
              <option value="0">Selecciona un concepto...</option>
            </select>
            <div id="waitingConcepts">

            </div>
          </div>
          <div class="form-group col-lg-3 col-md-6 col-sm-6">
            <label class="text-center" for="unit">Unidad de Medida</label>
            <input disabled type="text" class="form-control" id="unit">
          </div>
          <div class="form-group col-lg-3 col-md-6 col-sm-6">
            <label class="text-center" for="quantity">Cantidad</label>
            <input required class="form-control" type="number" step="0.01" name="quantity" id="quantity" placeholder="Cantidad" onkeypress="isNumberKey(event)">
          </div>
          <div class="form-group col-lg-3 col-md-6 col-sm-6">
            <label class="text-center" for="totalQuant">Cantidad Restante</label>
            <input disabled type="text" class="form-control" id="totalQuant">
          </div>
          <input type="hidden" name="physProgId" id="physProgId">
          <input type="hidden" name="workConcepts" id="workConcepts">
          <input type="hidden" name="opcion" id="option" value="33">
          <div class="form-group col-lg-6 col-md-12 col-sm-12 col-xs-12 pull-right">
            <div class="col-sm-12 col-lg-6 col-md-6 col-xs-12">
              <button class="btn btn-primary btn-block" id="saveConcept" type="button" style="margin-bottom: 5px;">Guardar registro</button>
            </div>
            <div class="col-sm-12 col-lg-6 col-md-6">
              <button class="btn btn-danger btn-block" id="cancelConcept" type="button">Cancelar</button>
            </div>
          </div>
        </form>
        <div class="row">
        <br>
        <div class="col-lg-12 col-sm-12 col-md-12 table-responsive">
            <table id="listConceptsDetail" class="table table-bordered table-striped table-hover">
              <thead>
                <th style="width:4%" scope="col">ID</th>
                <th style="width:8%" scope="col">Código</th>
                <th scope="col">Concepto</th>
                <th style="width:8%" scope="col">Cantidad</th>
                <th style="width: 4%" scope="col">Unidad</th>
                <th style="width: 5%" scope="col">Acción</th>
              </thead>
              <tbody>
              </tbody>
            </table>
            <div id="respServerModalDetail">
            </div>
        </div>
      </div>
    </div>
    <br><br>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
  </div>
</div>
</div>
