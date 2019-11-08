

<section class="content-header">
  <h1>
    Recursos humanos
    <small>Nómina administrativa</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="inicio"><i class="fa fa-home"></i> Inicio</a></li>
    <li><a href="#">Recursos Humanos</a></li>
    <li href="#">Nómina administrativa</li>
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
             <button id="btnNewAdmPayment" type="button" class="btn btn-primary btn-sm pull-right mt-2em" >
               Agregar un nuevo pago
             </button>
           <?php } else {?>
             <p id="noEmployees" class="text-danger">
               No se pueden generar pagos si no hay empleados registrados
             </p>
           <?php } ?>
         </div>

          <form id="frmAdmPayment" name="frmAdmPayment" style="display:none;" autocomplete="off">
            <input autocomplete="false" name="hidden" type="hidden" style="display:none;">
              <div class="form-group col-lg-4 col-md-4 col-sm-6">
                  <label for="employee" style="display: block;">Empleado</label>
                  <select required name="employee" id="employee" class="form-control" onchange="employeeId()" style="width: 100%;">
                    <option value="0">Selecciona una opción...</option>
                    <?php
                    $combo = @$conexion->obtenerlista($querys3->getListadoEmpleados(2));
                    $querys3->llenarComboEmpleadoCat($combo);
                    ?>
                  </select>
              </div>
              <div class="form-group col-lg-4 col-md-4 col-sm-6">
                <label for="category">Categoría</label>
                <select required class="form-control" type="text" name="category" id="category" disabled>
                </select>
              </div>
              <div class="form-group col-lg-4 col-md-4 col-sm-6">
                <label for="payment">Sueldo (por día) </label>
                <input required pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency"  class="form-control" name="payment" id="payment" placeholder="Sueldo">
              </div>
              <div class="form-group col-lg-4 col-md-4 col-sm-6">
                <label for="workDays">Días de trabajo</label>
                <input required onkeypress="return isNumberKey(event)" class="form-control" type="text" name="workDays" id="workDays" placeholder="Número de días de trabajo">
              </div>
              <div class="form-group col-lg-4 col-md-4 col-sm-6">
                <label for="dateStart">Fecha Inicio</label>
                <input required class="form-control" name="dateStart" id="dateStart" placeholder="Fecha de inicio" onchange="verifyMinorDate()" onkeypress="return false">
              </div>
              <div class="form-group col-lg-4 col-md-4 col-sm-6">
                <label for="dateFinish">Fecha Final</label>
                <input required class="form-control" type="text" name="dateFinish" id="dateFinish" placeholder="Fecha de finalización" onchange="verifyMinorDate()" onkeypress="return false">
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
                <label for="totalAmount">Total a pagar</label>
                <input pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" class="form-control" name="totalAmount" id="totalAmount" placeholder="Total de la raya">
              </div>
              <div class="form-group col-lg-4 col-md-4 col-sm-6">
                <label for="paymentStatus">Status</label>
                <select class="form-control" name="paymentStatus" id="paymentStatus">
                  <option value="3">Cancelado</option>
                  <option value="1">Pagado</option>
                  <option value="2" selected>Pendiente</option>
                </select>
              </div>

              <div class="form-group col-lg-4 col-md-8 col-sm-12">
                <label for="remarks">Observaciones</label>
                <input maxlength="100" class="form-control" type="text" name="remarks" id="remarks">
              </div>
              <input type="hidden" name="opcion" id="opcion" value="14">
              &nbsp;
              <div class="form-group col-lg-8 col-md-4 col-sm-12">
                <div class="col-sm-12 col-lg-6 col-md-6 mt-1">
                  <button class="btn btn-primary btn-block" id="saveAdmPaymentBtn" type="submit">Guardar</button>
                </div>
                <div class="col-sm-12 col-lg-6 col-md-6 mt-1">
                  <button class="btn btn-secondary btn-block" id="cancelAdmPaymentBtn" type="button" >Cancelar</button>
                </div>
              </div>
          </form>

          <form id="searchAdmPaymentFrm" style="display: none;">
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
              <input class="form-control" type="text" name="rfcSearch" id="rfcSearch" onkeyup="listAdmPayments()">
            </div>
            <div class="form-group col-lg-3 col-md-12 col-sm-6">
              <button class="btn btn-secondary mt-2em btn-block" id="cancelSearchAdmPayment" type="button">Cancelar</button>
            </div>
          </form>

          <div id="respServer">
          </div>


        </div>

        <div class="row">
          <div id="cntnListAdmPayments" class="col-lg-12 col-md-12 col-sm-12 table-responsive">
          </div>
        </div>

      </div>
  </section>
</div>
<?php include('nom_adm_modal.php'); ?>
<script type="text/javascript">
  window.onload = function() {
    dateControl('dateStart');
    dateControl('dateFinish');
    listAdmPayments();
    $('#employee').select2();
    $('#work').select2();
    $('#foodDays').val("1");
    $('#totalAmount').val("0");
  }

  function verifyMinorDate(){
    let descomponeFecha1 = $('#dateStart').val().split("/");
    let fecha1 = new Date(descomponeFecha1[2],descomponeFecha1[1],descomponeFecha1[0]);
    let descomponeFecha2 = $('#dateFinish').val().split("/");
    let fecha2 = new Date(descomponeFecha2[2],descomponeFecha2[1],descomponeFecha2[0]);

    if(fecha1 > fecha2){
      let opciones = {
  			appendTo:'#frmAdmPayment',
  			minWidth:300,
  			maxWidth: 350,
  		};
  		parent.mensaje("La fecha inicial debe ser menor que la final",'warning',opciones);
      $('#dateFinish').val($('#dateStart').val());
    } else {
      let date1 = new Date($('#dateStart').val().split('/')[1]+'/'+$('#dateStart').val().split('/')[0]+'/'+$('#dateStart').val().split('/')[2]);
      let date2 = new Date($('#dateFinish').val().split('/')[1]+'/'+$('#dateFinish').val().split('/')[0]+'/'+$('#dateFinish').val().split('/')[2]);
      let dif_in_time = date2.getTime() - date1.getTime();
      let dif_in_days = dif_in_time / (1000 * 3600 * 24);
      $('#workDays').val(parseInt(dif_in_days));
    }
  }

  function totalAmountCalc() {
    $('#addedActAmount').prop('readonly',false);

    let totalFood =($('#foodTotalAmount').val()) ? parseFloat($('#foodTotalAmount').val().replace("$","").replace(",","")) : 0;
    let paymentAmount = ($('#paymentAmount').val()) ? parseFloat($('#paymentAmount').val().replace("$","").replace(",","")) : 0;
    let operation = parseInt($('#addedActivities').val());
    $('#totalAmount').val(totalFood + paymentAmount);
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
              $('#payment').keyup();
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
</script>
