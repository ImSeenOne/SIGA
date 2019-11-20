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
    Solicitud de asfalto
    <small>Asfalto</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="inicio"><i class="fa fa-home"></i> Inicio</a></li>
    <li><a href="#">Gerencia</a></li>
    <li>Asfalto</li>
    <li> <a href="#" class = "active">Solicitud de asfalto</a> </li>
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
            <button id="btnNewAsphaltRequest" type="button" class="btn btn-primary btn-sm pull-right" >Nueva Solicitud</button>
          </div>
        </div>

        <form id="frmAsphaltRequest" name="frmAsphaltRequest" style="display:none;" autocomplete="off">
          <input autocomplete="false" type="text" style="display:none;">
            <div class="form-group col-lg-6 col-md-6 col-sm-6">
              <label for="work">Obra</label>
              <select class="form-control select2" name="work" id="work">
                <option>Selecciona una opción</option>
                <?php
                  $resp = @$conexion->obtenerlista($querys3->getListadoObras());
                  $funciones->llenarcombo($resp);
                ?>
              </select>
            </div>
            <div class="form-group col-lg-6 col-md-6 col-sm-6">
              <label for="requestDate">Fecha Solicitud</label>
              <input required class="form-control" type="text" name="requestDate" id="requestDate" placeholder="Fecha de Solicitud" onchange="verifyMinorDate()" onkeypress="return false">
            </div>
            <div class="form-group col-lg-6 col-md-6 col-sm-6">
              <label for="asphaltLiters">Litros Asfalto</label>
              <input required class="form-control" type="text" name="asphaltLiters" id="asphaltLiters" placeholder="Litros" onkeypress="return isNumberKey(event)" step="0.01">
            </div>
            <div class="form-group col-lg-6 col-md-6 col-sm-6">
              <label for="asphaltDelivery">Fecha Entrega</label>
              <input required class="form-control" type="text" name="asphaltDelivery" id="asphaltDelivery" placeholder="Fecha Entrega" onchange="verifyMinorDate()" onkeypress="return false">
            </div>
            <div class="form-group col-lg-6 col-md-6 col-sm-6">
              <label for="emulsionLiters">Litros Emulsión</label>
              <input required class="form-control" type="text" name="emulsionLiters" id="emulsionLiters" placeholder="Litros" onkeypress="return isNumberKey(event)" step="0.01">
            </div>
            <div class="form-group col-lg-6 col-md-6 col-sm-6">
              <label for="emulsionDelivery">Fecha Entrega</label>
              <input required class="form-control" type="text" name="emulsionDelivery" id="emulsionDelivery" placeholder="Fecha Entrega" onchange="verifyMinorDate()" onkeypress="return false">
            </div>
            <div class="form-group col-lg-6 col-md-6 col-sm-6">
              <label for="alternateFuelLiters">Litros Combustible Alterno</label>
              <input required class="form-control" type="text" name="alternateFuelLiters" id="alternateFuelLiters" placeholder="Litros" onkeypress="return isNumberKey(event)" step="0.01">
            </div>
            <div class="form-group col-lg-6 col-md-6 col-sm-6">
              <label for="alternateFuelDelivery">Fecha Entrega</label>
              <input required class="form-control" type="text" name="alternateFuelDelivery" id="alternateFuelDelivery" placeholder="Fecha Entrega" onchange="verifyMinorDate()" onkeypress="return false">
            </div>
            <input type="hidden" id="opcion" name="opcion" value="48">
            <input type="hidden" id="id" name="id">
            <div id="respServer">
            </div>
            <div class="form-group col-lg-6 col-md-12 col-sm-12 col-xs-12 pull-right" id="buttons">
              <div class="col-sm-12 col-lg-6 col-md-6">
                <button class="btn btn-primary btn-block" type="submit">Guardar</button>
              </div>
              <div class="col-sm-12 col-lg-6 col-md-6 buttonM">
                <button class="btn btn-secondary btn-block" id="cancelAsphaltRequest" type="button" >Cancelar</button>
              </div>
            </div>
        </form>
        <div class="box-footer">
          <div id="cntnListAsphaltRequests" class="col-lg-12 col-md-12 col-sm-12 table-responsive">
          </div>
        </div>
      </div>
  </div>
</section>

<script type="text/javascript">
  window.onload = function(){
    listAsphaltRequests();
    selectFrm('select2');
    dateControl('requestDate');
    dateControl('asphaltDelivery');
    dateControl('emulsionDelivery');
    dateControl('alternateFuelDelivery');
  }

  function verifyMinorDate(){
    let dateSplitted1 = $('#requestDate').val().split("/");
    let date1 = new Date(dateSplitted1[2],dateSplitted1[1],dateSplitted1[0]);

    let dateSplitted2 = $('#asphaltDelivery').val().split("/");
    let date2 = new Date(dateSplitted2[2],dateSplitted2[1],dateSplitted2[0]);

    let dateSplitted3 = $('#emulsionDelivery').val().split("/");
    let date3 = new Date(dateSplitted3[2],dateSplitted3[1],dateSplitted3[0]);

    let dateSplitted4 = $('#alternateFuelDelivery').val().split("/");
    let date4 = new Date(dateSplitted4[2],dateSplitted4[1],dateSplitted4[0]);

    if((date1 > date2) || (date1 > date3) || (date1 > date4)){
      let opciones = {
  			appendTo:'#frmAsphaltRequest',
  			minWidth:300,
  			maxWidth: 350,
  		};
      if(date1 > date2){
        $('#asphaltDelivery').val($('#requestDate').val());
      }
      if(date1 > date3){
        $('#emulsionDelivery').val($('#requestDate').val());
      }
      if(date1 > date4){
        $('#alternateFuelDelivery').val($('#requestDate').val());
      }
      parent.mensaje("Todas las fechas de entrega deben ser mayores a la fecha de solicitud",'warning',opciones);
    }
  }
</script>
