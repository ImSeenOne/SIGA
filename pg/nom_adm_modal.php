<div class="modal fade" id="admPaymentDetails" tabindex="-1" role="dialog" aria-labelledby="admPaymentDetailsLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="width: 90%; margin-left: 5%">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="admPaymentDetailsLabel">Detalles del pago de nómina administrativa</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="respServerModal" class="row">
        </div>
        <div class="row" id="flAdmAddedActivities" style="display: none;">
          <div class="container">
            <p>
              <label>Empleado:</label>
              <strong> <cite id="employeeCiteModal" style="color: #335cbd; display: inline;"></cite> </strong>
            </p>
            <p>
              <label>Período:</label>
              <strong> <cite id="periodCiteModal" style="color: #335cbd; display: inline;"></cite> </strong>
            </p>
          </div>

          <form id="frmAdmAddActivity" autocomplete="off">
            <input autocomplete="false" type="hidden" style="display:none;">
            <div class="form-group col-lg-3 col-md-4 col-sm-6">
              <label for="addedActivity">Tipo</label>
              <select required class="form-control" name="addedActivity" id="addedActivity">
                <option value="0">Selecciona una actividad</option>
                <?php
                  $resp = @$conexion->obtenerlista($querys3->getAddedActivities());
                  $funciones->llenarcombo($resp);
                 ?>
              </select>
            </div>
            <div class="form-group col-lg-3 col-md-4 col-sm-6">
              <label for="nameAdmAddedActivity">Concepto</label>
              <input required class="form-control" type="text" name="nameAdmAddedActivity" id="nameAdmAddedActivity" placeholder="Concepto...">
            </div>
            <div class="form-group col-lg-3 col-md-4 col-sm-6">
              <label for="amountAddedActivity">Monto</label>
              <input required pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" class="form-control" type="text" name="amountAddedActivity" id="amountAddedActivity" placeholder=Monto>
            </div>
            <input type="hidden" name="opcion" value="42">
            <input type="hidden" name="id" id="idModal">
            <div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12 pull-right" style="margin-top: 25px;">
              <div class="col-lg-12 col-md-12- col-sm-12 col-xs-12 col-xl-12">
                <button type="submit" class="btn btn-primary btn-block"> <i class="fa fa-plus"></i> </button>
              </div>
            </div>
          </form>
          <br><br><br><br>
          <div class="table table-responsive container" id="cntnListAdmPaymentActivitiesModal">
          </div>
        </div>
        <div id="admPaymentDataModal" style="display:none;" class="row">
          <div class="container-fluid">
            <ul class="list-group">
              <li class="list-group-item active text-center">ID: <div id="idPaymentModal" style="color: #FFF; display: inline;"></div></li>
              <li class="list-group-item text-center">Empleado: <div id="employeeModal" style="color: #335cbd; display: inline;"></div></li>
              <li class="list-group-item text-center">Sueldo Base: <div id="totalPaymentModal" style="color: #335cbd; display: inline;"></div></li>
              <li class="list-group-item text-center">Monto Alimentos: <div id="foodAmountModal" style="color: #335cbd; display: inline;"></div></li>
              <li class="list-group-item text-center">Sumatoria percepciones: <div id="perceptionsModal" style="color: #335cbd; display: inline;"></div></li>
              <li class="list-group-item text-center">Sumatoria deducciones: <div id="deductionsModal" style="color: #335cbd; display: inline;"></div></li>
              <li class="list-group-item text-center">Monto Total: <div id="totalAmountModal" style="color: #335cbd; display: inline;"></div></li>
              <li class="list-group-item text-center">Período: <div id="periodModal" style="color: #335cbd; display: inline;"></div></li>
              <li class="list-group-item text-center">Status:&nbsp;<div id="statusModal" style="color: #335cbd; display: inline;"></div></li>
              <li class="list-group-item text-center">Observaciones: <div id="remarksModal" style="color: #335cbd; display: inline;"></div></li>
              <li class="list-group-item text-center">Fecha de registro: <div id="registerDate" style="color: #335cbd; display: inline;"></div></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
