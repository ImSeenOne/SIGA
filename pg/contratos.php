

<section class="content-header">
  <h1>
    Inmobiliaria
    <small>Contratos</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="inicio"><i class="fa fa-home"></i> Inicio</a></li>
    <li><a href="#">Inmobiliaria</a></li>
    <li href="#">Contratos</li>
  </ol>
</section>
<div class="col-lg-12 col-md-12 col-sm-12">
  <section class="content">
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Nuevo contrato</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"> <i class="fa fa-minus"></i> </button>
          </div>
        </div>
        <div class="box-body">
          <div class="col-lg-12 alignMiddle">
             <button id="btnNewContract" type="button" class="btn btn-primary btn-sm pull-right mt-2em" >
               Agregar un nuevo contrato
             </button>
          </div>

          <form id="frmContract" name="frmContract" style="display:none;">
              <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-6">
                <label for="folio">Folio</label>
                <input class="form-control" name="folio" id="folio" placeholder="Folio generado automáticamente" readonly>
              </div>
              <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-6">
                <label for="dateContract">Fecha</label>
                <input required class="form-control" type="text" name="dateContract" id="dateContract" placeholder="Fecha">
                <p class="text-danger" id="dateContractReq"></p>
              </div>
              <!--id_tipo cliente: arrendatario = 1, comprador = 2-->
              <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-6">
                <label for="clientSelected">Cliente</label>
                <select class="form-control" id="clientSelected" name="clientSelected" onchange="clientChanged()">
                  <option value="0">Seleccione un cliente</option>
                  <?php
                    $combo = @$conexion->obtenerlista($querys3->listClientes());
                    $funciones->llenarCombo($combo);
                  ?>
                </select>
                <p class="text-danger" id="clientSelectedReq"></p>
              </div>
              <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-6">
                <label for="propertySelected"style="display: block;">Propiedad</label>
                <select name="propertySelected" id="propertySelected" class="form-control" style="width: 100%;"onchange="changeProperty()">
                  <option value="0">Selecciona una propiedad</option>
                </select>
                <p class="text-danger" id="propertySelectedReq"></p>
              </div>
              <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-6">
                <label for="contractValidity">Vigencia</label>
                <input required class="form-control" type="text" name="contractValidity" id="contractValidity" placeholder="Vigencia">
                <p class="text-danger" id="contractValidityReq"></p>
              </div>
              <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-6">
                <label for="contractType">Tipo</label>
                <select class="form-control" name="contractType" id="contractType" onchange="changeContractType()">
                  <option value="1">Propietario</option>
                  <option value="2">Arrendatario</option>
                </select>
                <p class="text-danger" id="contractTypeReq"></p>
              </div>

              <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-6">
                <label for="contractAmount">Monto</label>
                <input required pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" class="form-control" type="text" name="contractAmount" id="contractAmount" placeholder="Monto">
                <p class="text-danger" id="contractAmountReq"></p>
              </div>
              <div id="ownerField" class="form-group col-lg-4 col-md-4 col-sm-6" >
                <label for="contractOwner">Propietario</label>
                <select class="form-control" name="contractOwner" id="contractOwner" style="width:100%">
                  <option value="0">Seleccione un propietario</option>
                  <?php
                    $combo = @$conexion->obtenerlista($querys3->getListadoPropietarios());
                    $funciones->llenarCombo($combo);
                  ?>
                </select>
                <p class="text-danger" id="contractOwnerReq"></p>
              </div>
              <div id="lesseeField" class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-6" style="display: none;">
                <label for="contractLessee">Arrendatario</label>
                <input class="form-control" type="text" name="contractLessee" id="contractLessee">
                <p class="text-danger" id="contractLesseeReq"></p>
              </div>

              <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-6">
                <label for="hitch" id="hitchLabel"></label>
                <input required class="form-control" type="text" name="hitch" id="hitch" placeholder="Monto" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency">
                <p class="text-danger" id="hitchReq"></p>
              </div>

              <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-6">
                <label for="flContract">Archivo</label>
                <input required type="file" id="flContract" name="flContract" class="form-control"/>
                <input type="hidden" id="hdFlContract" name="hdFlContract" class="form-control"/>
                <p class="text-danger" id="flContractReq"></p>
              </div>

              <div class="form-group col-lg-4 col-md-4 col-sm-12 ">
                <label for="period">Período</label>
                <select class="form-control" name="period" id="period">
                  <option value="0">Selecciona un período</option>
                  <option value="1">Quincenal</option>
                  <option value="2">Mensual</option>
                  <option value="3">Trimestral</option>
                  <option value="4">Semestral</option>
                  <option value="5">Anual</option>
                </select>
              </div>

              <div class="form-group col-lg-4 col-md-4 col-sm-12 ">
                <label for="remarks">Observaciones<sub>(opcional)</sub> </label>
                <input class="form-control" type="text" name="remarks" id="remarks">
              </div>


              <!-- <div class="form-group col-lg-4 col-md-4 col-sm-6">
                <label for=""></label>
                <input class="form-control" type="text" name="" id="">
              </div>
              <div class="form-group col-lg-4 col-md-4 col-sm-6">
                <label for=""></label>
                <input class="form-control" type="text" name="" id="">
              </div>
              <div class="form-group col-lg-4 col-md-4 col-sm-6">
                <label for=""></label>
                <input class="form-control" type="text" name="" id="">
              </div> -->
              <input type="hidden" name="idContract" id="idContract" value="">
              <input type="hidden" name="idDevelopment" id="idDevelopment">
              <input type="hidden" name="opcion" id="opcion" value="12">

              &nbsp;
              <div class="form-group col-lg-12 col-md-12 col-sm-12">
                <div class="col-sm-12 col-lg-6 col-md-6 mt-1" style="margin-bottom: 1.3%;vertical-align: baseline;">
                  <button class="btn btn-primary btn-block" id="saveContract" type="submit">Guardar contrato</button>
                </div>
                <div class="col-sm-12 col-lg-6 col-md-6 mt-1">
                  <button class="btn btn-secondary btn-block" id="cancelContract" type="button">Cancelar</button>
                </div>
              </div>
          </form>

          <div id="respServer">
          </div>

        </div>

      </div>
  </section>
</div>
<div id="sillyTable" class="col-lg-12 col-md-12 col-sm-12" style="margin-top:-10%">
  <div class="content col-lg-12 col-md-12 col-sm-12">
    <div class="box box-default">
      <div class="box-header">
        <h3 class="box-title">Listado de contratos</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"> <i class="fa fa-minus"></i> </button>
        </div>
      </div>
      <div class="box-body">
        <div class="row">
          <div id="cntnListContracts" class="col-lg-12 col-md-12 col-sm-12">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  window.onload = function(){
    dateControl('contractValidity');
    dateControl('dateContract');
    listContracts();
    changeContractType();
  };

  function changeProperty(){
    let dev = $('#propertySelected').find(":selected").data("development");
    let amount = $('#propertySelected').find(":selected").data("amount");
    let type = $('#propertySelected').find(":selected").data("type");
    let owner = $('#propertySelected').find(":selected").data("owner");

    $('#idDevelopment').val(dev);
    $('#contractAmount').val(amount);
    $("#contractType option[value="+ type +"]").attr("selected",true);
    $("#contractOwner option[value="+ owner +"]").attr("selected",true);
    $('#contractAmount').keyup();
  }

  function changeContractType(){
    let type = parseInt($('#contractType').val());
    switch(type){
      case 2://lessee
      $('#hitchLabel').text("Depósito");
      /*if($('#ownerField').is(":visible")){
        $('#ownerField').hide();
      }
      if($('#lesseeField').is(":hidden")){
        $('#lesseeField').show();
      }*/
      break;
      case 1://owner
      $('#hitchLabel').text("Enganche");
      /*if($('#lesseeField').is(":visible")){
        $('#lesseeField').hide();
      }
      if($('#ownerField').is(":hidden")){
        $('#ownerField').show();
      }*/
      break;
    }
  }
</script>
