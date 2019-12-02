<style>
@media (min-width: 991px) {
  .buttonM{
    margin-top: 2%;
  }
}
@media (max-width: 990px) {
  .buttonM{
    margin-top: 3%;
  }
}
@media (min-width: 768px){
  .cancelButton{
    margin-top: 0;
  }
}
@media (max-width: 767px){
  .cancelButton{
    margin-top: 2%;
  }
  #assignAsphaltReportConsumptionModal{
    margin-left: 5%;
  }
}
</style>
<div class="modal fade" id="assignAsphaltReportConsumptionModal" tabindex="-1" role="dialog" aria-labelledby="assignAsphaltReportConsumptionModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document" style="width: 85%;">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="assignAsphaltReportConsumptionLabel"></h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <button type="button" id="btnNewAsphalftReportConsumption" class="btn btn-primary btn-sm pull-right">Nuevo Consumo</button>
        <div class="row">
        </div>
        <div id="fillAsphaltReportConsumption" class="row">
          <form id="frmAsphaltReportConsumption" style="display:none;" autocomplete="off">
            <input autocomplete="false" type="text" style="display:none;">
            <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12 col-xl-12">
              <label class="text-center" for="carriesNumber">Número de Viajes</label>
              <input required type="text" id="carriesNumber" name="carriesNumber" onkeypress="return isNumberKey(event)" class="form-control"/>
            </div>
            <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12 col-xl-12">
              <label class="text-center" for="plant">Consumo combustible Planta</label>
              <input required type="text" id="plant" name="plant" onkeypress="return isNumberKey(event)" class="form-control"/>
            </div>
            <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12 col-xl-12">
              <label class="text-center" for="generator">Consumo Combustible Generador</label>
              <input required type="text" id="generator" name="generator" onkeypress="return isNumberKey(event)" class="form-control"/>
            </div>
            <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12 col-xl-12">
              <label class="text-center" for="caldrown">Consumo Combustible Caldera</label>
              <input required type="text" id="caldrown" name="caldrown" onkeypress="return isNumberKey(event)" class="form-control"/>
            </div>
            <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12 col-xl-12">
              <label class="text-center" for="auxiliar">Generador Auxiliar</label>
              <input required type="text" id="auxiliar" name="auxiliar" onkeypress="return isNumberKey(event)" class="form-control"/>
            </div>
            <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12 col-xl-12 buttonM" id="buttonModal">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-xl-12">
                <button type="submit" class="btn btn-primary btn-block">Agregar concepto</button>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-xl-12 cancelButton">
                  <button type="button" class="btn btn-secondary btn-block" id="cancelAsphalftReportConsumption">Cancelar</button>
              </div>
            </div>
            <div id="respServerModal">
            </div>
            <input type="hidden" name="id" id="idModal">
            <input type="hidden" name="opcion" id="opcionModal" value="52">
          </form>
          <div class="row">
          </div>
          <div style="margin-top: 5%;">
            <h4 style="margin-left: 2.5%;">Listado</h4>
            <div id="cntnListAsphaltReportsConsumption" style="width: 95%; margin-left:2.5%;" class="table table-responsive">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
