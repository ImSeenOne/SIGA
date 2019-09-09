<section class="content-header">
  <h1>
    Estimaciones
    <small>Licitaciones</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="inicio"><i class="fa fa-home"></i> Inicio</a></li>
    <li><a href="#">Estimaciones</a></li>
    <li href="licitaciones" class="active">licitaciones</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="col-lg-12 col-md-12 col-sm-12">
    <div class="box box-default">
      <div class="box-header with-border">
        <h3 class="box-title">Nuevo registro</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>
      <div class="box-body">
        <div class="col-lg-12 alignMiddle">
           <button id="btnNewBidding" type="button" class="btn btn-primary btn-sm pull-right mt-2em" >
             Agregar una nueva licitación
           </button>
        </div>
        <div class="row">
          <!-- ésto sí sirve para la animación de .slideToggle() -->
        </div>
        <form id="frmBidding" name="frmBidding" style="display: none;">
          <div class="form-group col-lg-4 col-md-6 col-sm-12 col-xs-12 col-xl-4">
            <label class="text-center" for="bidNum">Número de licitación</label>
            <input required type="number" id="bidNum" name="bidNum" class="form-control" placeholder="#" onkeypress="isNumberKey(event)">
          </div>

          <div class="form-group col-lg-4 col-md-6 col-sm-12 col-xs-12 col-xl-4">
            <label class="text-center" for="work">Nombre de la Obra</label>
            <input required type="text" id="work" name="work" class="form-control" />
          </div>

          <div class="form-group col-lg-4 col-md-12 col-sm-12 col-xs-12 col-xl-12">
            <label class="text-center" for="propDelivery">Entrega propuesta</label>
            <input required type="text" id="propDelivery" name="propDelivery" class="form-control" />
          </div>

          <div class="form-group col-lg-4 col-md-12 col-sm-12 col-xs-12 col-xl-12">
            <label class="text-center" for="failDate">Fecha fallo</label>
            <input required type="text" id="failDate" name="failDate" class="form-control" />
          </div>

          <div class="form-group col-lg-2 col-md-12 col-sm-12 col-xs-12 col-xl-12">
            <label class="text-center" for="place">Lugar</label>
            <input required type="number" id="place" name="place" class="form-control" onkeypress="isNumberKey(event)"/>
          </div>

          <div class="form-group col-lg-6 col-md-12 col-sm-12 col-xs-12 col-xl-12">
            <label class="text-center" for="file">Archivo (PDF)</label>
            <input type="file" id="file" name="file" class="form-control" />
            <input type="hidden" name="hdFile" id="hdFile">
          </div>

          <div class="text-center">
            <div id="respServer"></div>
          </div>

          <input type="hidden" id="idBid" name="idBid">
          <input type="hidden" id="opcion" name="opcion" value="21">
          <div class="col-lg-6 col-sm-12 col-md-6">
            <button class="btn btn-primary btn-block" id="saveBidding" type="submit" name="btnGuardarAnt">Guardar</button>&nbsp;
          </div>
          <div class="col-lg-6 col-sm-12 col-md-6">
            <button class="btn btn-secondary btn-block"id="cancelBidding" type="button" name="btnCancelar">Cancelar</button>
          </div>
        </form>
      </div>
      <div class="box-footer">
        <div class="table"id="cntnListBiddings">

        </div>
       </div>
    </div>
  </div>
</section>

<script type="text/javascript">
  window.onload = function() {
    listBiddings();
    dateControl('failDate');
    dateControl('propDelivery');
  }
</script>
