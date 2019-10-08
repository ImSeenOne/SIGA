<div class="modal fade" id="assignExpenseModal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitle">Asignación de combustible</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frmAssignExpense" autocomplete="off" class="row cntntFrm mt-1em">
          <input autocomplete="false" name="hidden" type="text" style="display:none;">
          <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
            <div class="form-group">
              <label for="employeeModal">Empleado</label>
              <select required class="form-control" name="employeeModal" id="employeeModal" style="display: block;">
                <option value="0">Selecciona una opción...</option>
                <?php
                $combo = @$conexion->obtenerlista($querys3->getListadoEmpleados());
                $querys3->llenarComboEmpleadoCat($combo);
                ?>
              </select>
            </div>
          </div>

          <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
            <div class="form-group">
              <label for="litersModal">Litros</label>
              <input required type="number" id="litersModal" class="form-control" name="litersModal">
            </div>
          </div>

          <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
            <div class="form-group">
              <label for="fuelTypeModal">Tipo</label>
              <select required class="form-control" name="fuelTypeModal" id="fuelTypeModal">
                <option value="0">Selecciona una opción...</option>
                <option value="1">Magna</option>
                <option value="2">Premium</option>
                <option value="3">Diesel</option>
              </select>
            </div>
          </div>

          <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
            <div class="form-group">
              <label for="locationModal">Ubicación</label>
              <input required type="text" class="form-control" name="locationModal" id="locationModal">
            </div>
          </div>

          <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
            <div class="form-group">
              <label for="machineryModal">Tipo de vehículo</label>
              <select required class="form-control" name="machineryModal" id="machineryModal" style="display: block;">
                <option value="0">Selecciona una opción...</option>
                <?php
                $combo = @$conexion->obtenerlista($querys3->listMachineryTypes());
                $querys3->fillSelectMachineryTypes($combo);
                ?>
              </select>
            </div>
          </div>

          <div class="respServerAssFuelExp">

          </div>

          <input type="hidden" name="opcion" id="opcion" value="28">
          <input type="hidden" name="idModal" id="idModal" value="">
          <input type="hidden" name="idInsFuelExpModal" id="idInsFuelExpModal" value="">

          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-2em pull-right">
            <div class="col-sm-12 col-lg-6 col-md-6">
              <button class="btn btn-primary btn-block" type="submit">Agregar</button>
              &nbsp;
            </div>
            <div class="col-sm-12 col-lg-6 col-md-6">
              <button class="btn btn-secondary btn-block" type="button" id="btnCancelAssExp" data-dismiss="modal">Cancelar</button>
            </div>
          </div>

        </form>

        <div class="row">
          <div id="cntnListAssignedFuelExpenses" class="col-lg-12 col-md-12 col-sm-12">

          </div>
        </div>

        <br><br><br><br><br><br><br><br>
      </div>
    </div>
  </div>
</div>
