<style media="screen">
@media (min-width: 991px) {
  .buttonM{
    margin-top: 0px;
  }
}
@media (max-width: 990px) {
  .buttonM{
    margin-top: 5%;
  }
}
</style>

<section class="content-header">
  <h1>
    Reporte de asfalto
    <small>Asfalto</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="inicio"><i class="fa fa-home"></i> Inicio</a></li>
    <li><a href="#">Gerencia</a></li>
    <li>Asfalto</li>
    <li> <a href="#" class = "active">Reporte de Asfalto</a> </li>
  </ol>
</section>

<section class="content">
  <div class="col-lg-12 col-md-12 col-sm-12">
    <div class="box box-default">
      <div class="box-header with-border">
        <h3 class="box-title">&nbsp;</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-lg-6 pull-right">
            <button id="btnNewAsphaltReport" type="button" class="btn btn-primary btn-sm pull-right" >Nuevo Reporte</button>
          </div>
        </div>

        <form id="frmAsphaltReport" name="frmAsphaltReport" style="display:none;" autocomplete="off">
          <input autocomplete="false" type="text" style="display:none;">
          <div class="form-group col-lg-6 col-md-6 col-sm-6">
            <label for="reportDate">Fecha Reporte</label>
            <input required class="form-control" type="text" name="reportDate" id="reportDate" placeholder="Fecha de Reporte" onkeypress="return false">
          </div>
          <div class="form-group col-lg-6 col-md-6 col-sm-6">
            <label for="work">Obra</label>
            <select required class="form-control select2" name="work" id="work">
              <option>Selecciona una opción</option>
              <?php
                $resp = @$conexion->obtenerlista($querys3->getListadoObras());
                $funciones->llenarcombo($resp);
              ?>
            </select>
          </div>
          <div class="form-group col-lg-6 col-md-6 col-sm-6">
            <label for="asphaltLiters">Litros Asfalto</label>
            <input required class="form-control" type="text" name="asphaltLiters" id="asphaltLiters" placeholder="Litros" onkeypress="return isNumberKey(event)" step="0.01">
          </div>
          <div class="form-group col-lg-6 col-md-6 col-sm-6">
            <label for="asphaltConsumed">Cantidad Consumida</label>
            <input required class="form-control" type="text" name="asphaltConsumed" id="asphaltConsumed" placeholder="Asfalto" onkeypress="return isNumberKey(event)" onkeyup="return verifyLowerQuantity('#asphaltLiters', '#asphaltConsumed')" step="0.01">
          </div>
          <div class="form-group col-lg-6 col-md-6 col-sm-6">
            <label for="emulsionLiters">Litros Emulsión</label>
            <input required class="form-control" type="text" name="emulsionLiters" id="emulsionLiters" placeholder="Litros" onkeypress="return isNumberKey(event)" step="0.01">
          </div>
          <div class="form-group col-lg-6 col-md-6 col-sm-6">
            <label for="emulsionConsumed">Cantidad consumida</label>
            <input required class="form-control" type="text" name="emulsionConsumed" id="emulsionConsumed" placeholder="Emulsión" onkeypress="return isNumberKey(event)" onkeyup="return verifyLowerQuantity('#emulsionLiters', '#emulsionConsumed')" step="0.01">
          </div>
          <div class="form-group col-lg-6 col-md-6 col-sm-6">
            <label for="termoCapacity">Capacidad termo</label>
            <input required class="form-control" type="text" name="termoCapacity" id="termoCapacity" placeholder="Capacidad" onkeypress="return isNumberKey(event)" step="0.01">
          </div>
          <div class="form-group col-lg-6 col-md-6 col-sm-6">
            <label for="plantOperator">Nombre Operador de Planta</label>
            <input required class="form-control" type="text" name="plantOperator" id="plantOperator" placeholder="Nombre">
          </div>
          <input type="hidden" id="opcion" name="opcion" value="50">
          <input type="hidden" id="id" name="id">
          <div id="respServer">
          </div>
          <div class="form-group col-lg-6 col-md-12 col-sm-12 col-xs-12 pull-right" id="buttons">
            <div class="col-sm-12 col-lg-6 col-md-6">
              <button class="btn btn-primary btn-block" type="submit">Guardar</button>
            </div>
            <div class="col-sm-12 col-lg-6 col-md-6 buttonM">
              <button class="btn btn-secondary btn-block" id="cancelAsphaltReport" type="button" >Cancelar</button>
            </div>
          </div>
      </form>
      <div class="box-footer">
        <div id="cntnListAsphaltReports" class="col-lg-12 col-md-12 col-sm-12 table-responsive">
        </div>
      </div>
    </div>
  </div>
</section>
<?php include('reporte_asfalto_modal.php'); ?>
<script type="text/javascript">
  window.onload = function(){
    listAsphaltReports();
    selectFrm('select2');
    dateControl('reportDate');
  }

  function verifyLowerQuantity(check, current){
    if(parseFloat($(current).val()) > parseFloat($(check).val())){
      $(current).val(parseFloat($(check).val()-1));
      parent.mensaje('La cantidad de consumo debe ser menor o igual que la cantidad total','warning',{appendTo:'#frmAsphaltReport', minWidth:300,	maxWidth: 350});
    }
  }
</script>
