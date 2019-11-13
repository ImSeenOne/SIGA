<section class="content-header">
  <h1>
    Contabilidad
    <small>Ingresos</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="inicio"><i class="fa fa-home"></i> Inicio</a></li>
    <li><a href="#">Contabilidad</a></li>
    <li href="ingresos" class="active">Ingresos</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="col-lg-12 col-md-12 col-sm-12">
    <div class="box box-default">
      <div class="box-header with-border">
        <h3 class="box-title">Nuevo Ingreso</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>
      <div class="box-body">
        <div class="col-lg-12 alignMiddle">
           <button id="btnNewIncome" type="button" class="btn btn-primary btn-sm pull-right mt-2em" >
             Agregar un Nuevo Ingreso
           </button>
        </div>
        <div class="row">
          <!-- ésto sí sirve para la animación de .slideToggle() -->
        </div>
        <form id="frmIncome" name="frmIncome" style="display: none;" autocomplete="off">
          <input autocomplete="false" type="text" style="display:none;">
          <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12 col-xl-12">
            <label class="text-center" for="billNum">No. de Factura</label>
            <input required type="text" id="billNum" name="billNum" class="form-control" placeholder="#" onkeypress="return isNumberKey(event)" onkeyup="addNumberSign()">
          </div>

          <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12 col-xl-12">
            <label class="text-center" for="billDate">Fecha Factura</label>
            <input required type="text" id="billDate" name="billDate" class="form-control" onchange="verifyMinorDate()" onkeypress="return false"/>
          </div>

          <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12 col-xl-12">
            <label class="text-center" for="chargeDate">Fecha Cobro</label>
            <input required type="text" id="chargeDate" name="chargeDate" class="form-control" onchange="verifyMinorDate()" onkeypress="return false"/>
          </div>

          <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12 col-xl-12">
            <label class="text-center" for="concept">Tipo/Concepto</label>
            <select class="form-control select2" name="concept" id="concept">
              <option value="0">Selecciona un concepto...</option>
              <?php
                $combo = @$conexion->obtenerlista($querys3->listConceptsAcc());
                $funciones->llenarcombo($combo);
               ?>
            </select>
          </div>

          <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12 col-xl-12">
            <label class="text-center" for="provider">Proveedor</label>
            <select class="form-control select2" name="provider" id="provider">
              <option value="0">Selecciona un proveedor...</option>
              <?php
                $combo = @$conexion->obtenerlista($querys3->listProvidersAcc());
                $funciones->llenarcombo($combo);
               ?>
            </select>
          </div>

          <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12 col-xl-3">
            <label class="text-center" for="conceptText">Concepto</label>
            <input required name="conceptText" id="conceptText" class="form-control"></input>
          </div>

          <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12 col-xl-3">
            <label class="text-center" for="withhold">Retención IVA (%)</label>
            <input type="text" id="withhold" name="withhold" class="form-control" onkeypress="return isNumberKey(event)"  step="0.01"/>
          </div>

          <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12 col-xl-12">
            <label class="text-center" for="repAdvance">Amortización Anticipo</label>
            <input type="text" id="repAdvance" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" name="repAdvance" class="form-control" onkeypress="return isNumberKey(event)"  step="0.01"/>
          </div>
          <div class="form-group col-lg-4 col-md-6 col-sm-12 col-xs-12 col-xl-12">
            <label class="text-center" for="repIVA">IVA Amortización (%)</label>
            <input type="text" id="repIVA" name="repIVA" class="form-control" onkeypress="return isNumberKey(event)" step="0.01"/>
          </div>
          <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12 col-xl-3">
            <label class="text-center" for="iva">IVA</label>
            <input required type="text" id="iva" name="iva" class="form-control" onkeypress="return isNumberKey(event)"  step="0.01"/>
          </div>

          <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12 col-xl-12">
            <label class="text-center" for="subtotal">Subtotal</label>
            <input required type="text" id="subtotal" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" name="subtotal" class="form-control" onkeypress="return isNumberKey(event)"  step="0.01"/>
          </div>

          <div class="text-center">
            <div id="respServer"></div>
          </div>

          <input type="hidden" id="id" name="id">
          <input type="hidden" id="opcion" name="opcion" value="39">
          <div class="col-lg-4 col-sm-12 col-md-12 col-xs-12 col-xl-4 pull-right" style="margin-top: 2.5%;">
            <div class="col-lg-6 col-sm-12 col-md-6">
              <button class="btn btn-primary btn-block" id="saveIncome" type="submit" name="btnGuardarAnt">Guardar</button>&nbsp;
            </div>
            <div class="col-lg-6 col-sm-12 col-md-6">
              <button class="btn btn-secondary btn-block"id="cancelIncome" type="button" name="btnCancelar">Cancelar</button>
            </div>
          </div>
        </form>
      </div>
      <div class="box-footer">
        <div class="table table-responsive"id="cntnListIncomes">

        </div>
       </div>
    </div>
  </div>
</section>

<?php include('ingresos_modal.php'); ?>

<script type="text/javascript">
  window.onload = function() {
    listIncomes();
    dateControl('billDate');
    dateControl('chargeDate');
    selectFrm('select2');
  }
  function verifyMinorDate(){
    let descomponeFecha1 = $('#billDate').val().split("/");
    let fecha1 = new Date(descomponeFecha1[2],descomponeFecha1[1],descomponeFecha1[0]);
    let descomponeFecha2 = $('#chargeDate').val().split("/");
    let fecha2 = new Date(descomponeFecha2[2],descomponeFecha2[1],descomponeFecha2[0]);

    if(fecha1 > fecha2){
      let opciones = {
  			appendTo:'#frmIncome',
  			minWidth:300,
  			maxWidth: 350,
  		};
  		parent.mensaje("La fecha de factura debe ser menor que la fecha de cobro",'warning',opciones);
      $('#billDate').val($('#chargeDate').val());
    }
  }
</script>
