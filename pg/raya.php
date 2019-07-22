

<section class="content-header">
  <h1>
    Recursos humanos
    <small>Raya</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="inicio"><i class="fa fa-home"></i> Inicio</a></li>
    <li><a href="#">Recursos Humanos</a></li>
    <li href="#">Raya</li>
  </ol>
</section>
<div class="col-lg-12 col-md-12 col-sm-12">
  <section class="content">
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Nuevo pago</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"> <i class="fa fa-minus"></i> </button>

          </div>
        </div>
        <div class="box-body">
          <div class="col-lg-12 alignMiddle">

            <?php
              $listado = @$conexion->obtenerlista($querys3->getEmpleadosById());
              $totRegs = $conexion->numregistros();
              if($totRegs > 0){
             ?>
             <button id="btnNewPayment" type="button" class="btn btn-primary btn-sm pull-right mt-2em" >
               Agregar un nuevo pago
             </button>
           <?php } else {?>
             <p id="noEmployees" class="text-danger">
               No se pueden generar pagos si no hay empleados registrados
             </p>
           <?php } ?>
          </div>

          <form id="frmPayment" name="frmPayment" style="display:none;">
              <div class="form-group col-lg-4 col-md-4 col-sm-6">
                <label for="dateStart">Fecha de inicio</label>
                <input required class="form-control" name="dateStart" id="dateStart" placeholder="Fecha de inicio">
              </div>
              <div class="form-group col-lg-4 col-md-4 col-sm-6">
                <label for="dateFinish">Fecha de finalización</label>
                <input required class="form-control" type="text" name="dateFinish" id="dateFinish" placeholder="Fecha de finalización">
              </div>
              <div class="form-group col-lg-4 col-md-4 col-sm-6">
                <label for="work"style="display: block;">Obra</label>
                <select required name="work" id="work" class="form-control" style="width: 100%;"onchange="workId()">
                  <option value="0">Selecciona una opción...</option>
                  <?php
                    $combo = @$conexion->obtenerlista($querys3->getListadoObras());
                    $funciones->llenarCombo($combo);
                  ?>
                </select>
              </div>
              <div class="form-group col-lg-4 col-md-4 col-sm-6">
                  <label for="employee" style="display: block;">Empleado</label>
                  <select required name="employee" id="employee" class="form-control" onchange="employeeId()" style="width: 100%;">
                    <option value="0">Selecciona una opción...</option>
                    <?php
                    $combo = @$conexion->obtenerlista($querys3->getListadoEmpleados());
                    $funciones->llenarComboEmpleadoCat($combo);
                    ?>
                  </select>
              </div>
              <div class="form-group col-lg-4 col-md-4 col-sm-6">
                <label for="category">Categoría</label>
                <select required class="form-control" type="text" name="category" id="category" disabled>
                </select>
              </div>
              <div class="form-group col-lg-4 col-md-4 col-sm-6">
                <label for="payment">Sueldo<sub>(por día)</sub> </label>
                <input required pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency"  class="form-control" name="payment" id="payment" placeholder="Sueldo" readonly>
              </div>

              <div class="form-group col-lg-4 col-md-4 col-sm-6">
                <label for="workDays">Días de trabajo</label>
                <input required onkeypress="return isNumberKey(event)" class="form-control" type="text" name="workDays" id="workDays" placeholder="Número de días de trabajo" readonly>
              </div>
              <div class="form-group col-lg-4 col-md-4 col-sm-6">
                <label for="paymentAmount">Monto</label>
                <input required pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" class="form-control" type="text" name="paymentAmount" id="paymentAmount" placeholder="Monto a pagar" readonly>
              </div>
              <div class="form-group col-lg-4 col-md-4 col-sm-6">
                <label for="foodPieceAmount">Alimentos</label>
                <input required maxlength="8" onkeyup="keyUpFoodPieceAmount()" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" class="form-control" type="text" name="foodPieceAmount" id="foodPieceAmount" placeholder="Monto por alimento">
              </div>

              <div class="form-group col-lg-4 col-md-4 col-sm-6">
                <label for="foodDays">Días de alimentos</label>
                <input required maxlength="2" onkeyup="keyUpFoodDays()" onkeypress="return isNumberKey(event)" class="form-control" name="foodDays" id="foodDays" placeholder="Días de alimentos pagados">
              </div>
              <div class="form-group col-lg-4 col-md-4 col-sm-6">
                <label for="foodTotalAmount">Monto</label>
                <input required pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" class="form-control" placeholder="Monto a pagar" name="foodTotalAmount" id="foodTotalAmount" readonly>
              </div>
              <div class="form-group col-lg-4 col-md-4 col-sm-6">
                <label for="addedActivities">Otras actividades</label>
                <select class="form-control" id="addedActivities" name="addedActivities" onchange="totalAmountCalc()">
                  <option value="0">N/A</option>
                  <option value="1">Percepciones</option>
                  <option value="2">Deducciones</option>
                </select>
              </div>

              <div class="form-group col-lg-4 col-md-4 col-sm-6">
                <label for="addedActAmount">Monto</label>
                <input onkeyup="keyUpAddedActAmount()" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" class="form-control" name="addedActAmount" id="addedActAmount" placeholder="Monto de actividades añadidas">
              </div>
              <div class="form-group col-lg-4 col-md-4 col-sm-6">
                <label for="totalAmount">Total a pagar</label>
                <input pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" class="form-control" name="totalAmount" id="totalAmount" placeholder="Total de la raya" readonly>
              </div>
              <div class="form-group col-lg-4 col-md-4 col-sm-6">
                <label for="paymentStatus">Status</label>
                <select class="form-control" name="paymentStatus">
                  <option value="1">Pagado</option>
                  <option value="2">Pendiente</option>
                  <option value="3">Cancelado</option>
                </select>
              </div>

              <div class="form-group col-lg-8 col-md-8 col-sm-6">
                <label for="remarks">Observaciones</label>
                <input maxlength="100" class="form-control" type="text" name="remarks" id="remarks">
              </div>
              <input type="hidden" name="employeeSelected" id="employeeSelected">
              <input type="hidden" name="workSelected" id="workSelected">
              <input type="hidden" name="opcion" id="opcion" value="11">
              &nbsp;
              <div class="form-group col-lg-4 col-md-4 col-sm-12">
                <div class="col-sm-12 col-lg-6 col-md-6 mt-1">
                  <button class="btn btn-primary btn-block" id="savePaymentBtn" type="button">Guardar</button>
                </div>
                <div class="col-sm-12 col-lg-6 col-md-6 mt-1">
                  <button class="btn btn-secondary btn-block" id="cancelPaymentBtn" type="button" >Cancelar</button>
                </div>
              </div>
          </form>

          <form id="searchPaymentFrm" style="display: none;" method="post">
            <div class="form-group col-lg-3 col-md-4 col-sm-6">
              <label for="">Empleado</label>
              <input type="text" name="employeeSearch" class="form-control" id="employeeSearch" onkeyup="listPayments()">
            </div>
            <div class="form-group col-lg-3 col-md-4 col-sm-6">
              <label for="workSearch">Obra</label>
              <input class="form-control" type="text" name="workSearch" id="workSearch" onkeyup="listPayments()">
            </div>
            <div class="form-group col-lg-3 col-md-4 col-sm-6">
              <label for="rfcSearch">RFC</label>
              <input class="form-control" type="text" name="rfcSearch" id="rfcSearch" onkeyup="listPayments()">
            </div>
            <div class="form-group col-lg-3 col-md-12 col-sm-6">
              <button class="btn btn-secondary mt-2em btn-block" id="cancelSearchPayment" type="button">Cancelar</button>
            </div>
          </form>

          <div id="respServer">
          </div>


        </div>

        <div class="row">
          <div id="cntnListPayments" class="col-lg-12 col-md-12 col-sm-12">
          </div>
        </div>

      </div>
  </section>
</div>

<script type="text/javascript">
  window.onload = function() {
    activaDatePicker('dateStart');
    activaDatePicker('dateFinish');
    listPayments();
    $('#employee').select2();
    $('#work').select2();
    $('#foodDays').val("1");
    $('#totalAmount').val("0");
    if(!parseInt($('#addedActivities').val())){
      $('#addedActAmount').prop('readonly',true);
    }
  }

  function totalAmountCalc() {
    $('#addedActAmount').prop('readonly',false);

    let totalFood =($('#foodTotalAmount').val()) ? parseFloat($('#foodTotalAmount').val().replace("$","").replace(",","")) : 0;
    let paymentAmount = ($('#paymentAmount').val()) ? parseFloat($('#paymentAmount').val().replace("$","").replace(",","")) : 0;
    let addedActAmount = ($('#addedActAmount').val()) ? parseFloat($('#addedActAmount').val().replace("$","").replace(",","")) : 0;
    let operation = parseInt($('#addedActivities').val());

    switch (operation) {
      case 0:
        $('#totalAmount').val(totalFood + paymentAmount);
        $('#addedActAmount').val("");
        $('#addedActAmount').prop('readonly',true);
        break;
      case 1:
        $('#addedActAmount').prop('readonly',false);
        $('#totalAmount').val(totalFood + paymentAmount + addedActAmount);
      break;
      case 2:
      $('#addedActAmount').prop('readonly',false);
        $('#totalAmount').val(totalFood + paymentAmount - addedActAmount);
        if(addedActAmount > (totalFood + paymentAmount)){
          $('#totalAmount').val("0");
        }
      break;
    }
    $('#totalAmount').keyup();
  }

  function workId(){
    $('#workSelected').val($('#work').val());
  }

  function employeeId(){
    $('#employeeSelected').val($('#employee').val());
    var sel = document.getElementById('employee');
    var selected = sel.options[sel.selectedIndex];
    var category = selected.getAttribute('data-cat');
    $.ajax({
          type:    "post",
          url:     "../siga/php/consultas3.php",
          data:    {"opt":20,"category" : category},
          dataType: 'json',
          success: function(resp){
              $('#category').append('<option value="' + category + '" selected>'+resp.name+'</option>');
              $('#payment').val(resp.pay);
              $('#workDays').val(resp.days);
              $('#paymentAmount').val(resp.pay * resp.days);
              totalAmountCalc();
              $('#paymentAmount').keyup();
          }
    });
  }

  function foodCalc(){
    let foodPiece = parseFloat($('#foodPieceAmount').val().replace("$","").replace(",",""));
    let foodDays = ($('#foodDays').val().length) ? parseFloat($('#foodDays').val()) : 0;
    $('#foodTotalAmount').val(foodPiece*foodDays);
    totalAmountCalc();
  }

  function keyUpFoodDays(){
    foodCalc();
    $('#foodTotalAmount').keyup();
    $('#foodDays').focus();
  }

  function keyUpFoodPieceAmount(){
    foodCalc();
    $('#foodTotalAmount').keyup();
    $('#foodPieceAmount').focus();
  }

  function keyUpAddedActAmount(){
    totalAmountCalc();
  }
</script>
