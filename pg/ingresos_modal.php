<div class="modal fade" id="assignConceptAccModal" tabindex="-1" role="dialog" aria-labelledby="assignConceptAccModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document" style="width: 90%;">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="assignConceptAccModalLabel">Retenciones</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="fillIncome" style="display:none;" class="row">
          <form id="frmRepModal" autocomplete="off">
            <input autocomplete="false" type="text" style="display:none;">
            <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12 col-xl-12">
              <label class="text-center" for="conceptModal">Concepto</label>
              <input required type="text" id="conceptModal" name="concept" class="form-control"/>
            </div>
            <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12 col-xl-12">
              <label class="text-center" for="amountModal">Monto</label>
              <input required pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" type="text" id="amountModal" name="amount" class="form-control"/>
            </div>
            <div class="form-group col-lg-4 col-md-12 col-sm-12 col-xs-12 col-xl-12" style="margin-top: 2%;" id="buttonModal">
              <button type="submit" class="btn btn-primary btn-block">Agregar concepto</button>
            </div>
            <input type="hidden" name="id" id="idModal">
            <input type="hidden" name="opcion" id="opcionModal" value="45">
          </form>
          <div class="row">
          </div>
          <div id="cntnListIncomesModal" style="margin-top: 5%;" class="table table-responsive">
          </div>
        </div>
        <div id="viewIncome" style="display:none;" class="row">
          <div class="container-fluid">
            <ul class="list-group">
              <li class="list-group-item active text-center">ID: <div id="idIncomeModal" style="color: #FFF; display: inline;"></div></li>
              <li class="list-group-item text-center">Número de factura: <div id="incomeNumberModal" style="color: #335cbd; display: inline;"></div></li>
              <li class="list-group-item text-center">Fecha de Factura: <div id="billDateModal" style="color: #335cbd; display: inline;"></div></li>
              <li class="list-group-item text-center">Fecha de Cobro: <div id="chargeDateModal" style="color: #335cbd; display: inline;"></div></li>
              <li class="list-group-item text-center">Tipo/Concepto: <div id="typeConceptModal" style="color: #335cbd; display: inline;"></div></li>
              <li class="list-group-item text-center">Proveedor: <div id="providerModal" style="color: #335cbd; display: inline;"></div></li>
              <li class="list-group-item text-center">Concepto: <div id="conceptTextModal" style="color: #335cbd; display: inline;"></div></li>
              <li class="list-group-item text-center">Retención IVA:&nbsp;<div id="withholdModal" style="color: #335cbd; display: inline;"></div></li>
              <li class="list-group-item text-center">Amortización Anticipo: <div id="repAdvanceModal" style="color: #335cbd; display: inline;"></div></li>
              <li class="list-group-item text-center">IVA Amortización: <div id="repIVAModal" style="color: #335cbd; display: inline;"></div></li>
              <li class="list-group-item text-center">Subtotal: <div id="subtotalModal" style="color: #335cbd; display: inline;"></div></li>
              <li class="list-group-item text-center">IVA: <div id="ivaModal" style="color: #335cbd; display: inline;"></div></li>
              <li class="list-group-item text-center">Monto total: <div id="totalAmountModal" style="color: #335cbd; display: inline;"></div></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
