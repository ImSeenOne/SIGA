<br/>
<section class="content-header">
  <h1>
    Estimaciones
    <small>Seguimiento</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="inicio"><i class="fa fa-home"></i> Inicio</a></li>
    <li><a href="">Estimaciones</a></li>
    <li href="">Seguimiento estimaciones</li>
  </ol>
</section>
<br/>
<section class="content">
  <div class="box box-default">
    <div class="box-header">
      <h3 class="box-title">Seguimiento</h3>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" type="button" name="button" data-widget="collapse">
          <i class="fa fa-minus"></i>
        </button>
      </div>
    </div>
    <div class="box-body">
      <div class="row" style="margin-top:-1.2em!important;">
        <div class="col-lg-6"></div>
        <div class="col-lg-6 alignMiddle">
        	<button id="btnNewEstTrack" type="button" class="btn btn-primary btn-sm pull-right mt-2em" >
            Nuevo seguimiento de estimación
          </button>
        </div>
      </div>
      <form id="frmEstTrack" class="mt-1em" style="display:none;">
        <div class="form-group col-md-6 col-lg-4">
          <label for="inputTrackEst">Obra</label>
          <input type="email" class="form-control" id="inputTrackEst" name="inputTrackEst" placeholder="Nombre de la obra">
          <div id="reqInputTrackEst" class="text-danger"></div>
        </div>
        <div class="form-group col-md-6 col-lg-4">
          <label for="inputEstimateNum">Número de estimación</label>
          <input type="text" class="form-control" id="inputEstimateNum" name="inputEstimateNum" placeholder="Número de estimación">
          <div id="reqInputEstimateNum" class="text-danger"></div>
        </div>
        <div class="form-group col-md-6 col-lg-4">
          <label for="inputAmount">Monto</label>
          <input pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency"  class="form-control" name="inputAmount" id="inputAmount" placeholder="Monto" >
          <div id="reqInputAmount" class="text-danger"></div>
        </div>
        <div class="form-group col-md-6 col-lg-4">
          <label for="period">Fecha de inicio</label>
            <div id="reqDate1" class="text-danger"></div>
            <input onkeypress="return isNumberKey(event)" data-toggle="tooltip" data-placement="left" title="Fecha de inicio" id = "date1" name="date1" type="text" aria-label="Fecha de inicio" class="form-control" value="<?= date('d-m-Y') ?>">
        </div>
        <div class="form-group col-md-6 col-lg-4">
            <label for="period">Fecha de finalización</label>
            <div id="reqDate1" class="text-danger"></div>
            <input onkeypress="return isNumberKey(event) && formatNumber()" data-toggle="tooltip" data-placement="left" title="Fecha de finalización" id="date2" name="date2" type="text" aria-label="Fecha de finalización" class="form-control">
        </div>
        <div class="form-group col-md-6 col-lg-4">
          <label for="inputPhysicAdv">Avance Físico</label>
          <input type="text" class="form-control" id="inputPhysicAdv" name="inputPhysicAdv" placeholder="Avance Físico">
        </div>
        <div class="form-group col-md-6 col-lg-4">
          <label for="inputStatus">Status</label>
          <select id="inputStatus" name="inputStatus" class="form-control">
            <option value = "1">Elaboración</option>
            <option value = "2">Revisión/Supervisión</option>
            <option value = "3">Terminada</option>
          </select>
          <div id="reqInputStatus" class="text-danger"></div>
        </div>
        <div class="form-group col-md-6 col-lg-8">
            <label for="flsImg">Imágenes</label>
            <input type="file" id="flsImg" name="flsImg" class="form-control"/>
            <input type="hidden" id="hdFlsImg" name="hdFlsImg" class="form-control"/>
            <div id="reqFlsImg"></div>
        </div>
      <div id="respServer"></div>
      <input type="hidden" id="idEstTrack" name="idEstTrack">
      <input type="hidden" id="opcion" name="opcion" value="4">
      <div class="form-group col-lg-12 col-md-12 col-sm-12">
        <div class="col-sm-12 col-lg-6 col-md-6 mt-1">
          <button class="btn btn-primary btn-block" id="saveTrackEst" type="button">Generar estimación</button>
        </div>
        <div class="col-sm-12 col-lg-6 col-md-6 mt-1">
          <button class="btn btn-secondary btn-block" id="btnCancelEstTrack" type="button" >Cancelar</button>
        </div>
      </div>
      </form>
      <div class="row">
        <div id="cntnListPagos" class="col-lg-12 col-md-12 col-sm-12">
        </div>
      </div>
  </div>
</section>
<br/>
  <script type="text/javascript">
    window.onload = function(){
      activaDatePicker("date1");
      activaDatePicker("date2");
      estimation_list();

      $(function () {
        $('[data-toggle="tooltip"]').tooltip()
      });
    }

  </script>
