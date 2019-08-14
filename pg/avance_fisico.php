

<section class="content-header">
  <h1>
    Residentes
    <small>Avance físico</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="inicio"><i class="fa fa-home"></i>Residentes</a></li>
    <li><a href="#">Avance físico</a></li>
  </ol>
</section>
<div class="col-lg-12 col-md-12 col-sm-12">
  <section class="content">
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Nuevo avance</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"> <i class="fa fa-minus"></i> </button>
          </div>
        </div>
        <div class="box-body">

          <div class="col-lg-12 alignMiddle">
             <button id="btnNewPhysProg" type="button" class="btn btn-primary btn-sm pull-right mt-2em" >
               Agregar avances
             </button>
          </div>

          <form autocomplete="off" id="newPhysProg" name="newPhysProg" style="display:none;">
            <input autocomplete="false" name="hidden" type="text" style="display:none;">
            <div class="form-group col-lg-6 col-md-6 col-sm-6">
              <label class="text-center" for="dateStart">Residente</label>
              <input required class="form-control" name="resident" id="resident" placeholder="Nombre">
            </div>
            <div class="form-group col-lg-6 col-md-6 col-sm-6">
              <label for="work" style="display: block;">Obra</label>
              <select name="work" id="work" class="form-control" style="width: 100%;" onchange="fillConcepts()">
                <?php
                $combo = @$conexion->obtenerlista($querys1->loadCboObras());
                $funciones->llenarcombo($combo);
                ?>
              </select>
            </div>
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xl-12">
                <hr>
              </div>
            </div>
            <div class="form-group col-lg-6 col-md-6 col-sm-6">
              <label class="text-center" for="dateStart">Fecha de inicio <sub>del avance</sub> </label>
              <input required class="form-control" type="date" name="dateStart" id="dateStart" placeholder="Fecha de inicio">
            </div>
            <div class="form-group col-lg-6 col-md-6 col-sm-6">
              <label class="text-center" for="dateFinish">Fecha de finalización <sub>del avance</sub></label>
              <input required class="form-control" type="date" name="dateFinish" id="dateFinish" placeholder="Fecha de finalización">
            </div>
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xl-12">
                <hr>
              </div>
            </div>
            <div class="form-group col-lg-6 col-md-12 col-sm-12">
                <label for="concept" style="display: block;">Concepto</label>
                <div id="waitingConcepts">
                </div>
                <select name="concept" id="concept" class="form-control" style="width: 100%;">
                </select>
            </div>
            <div class="form-group col-lg-6 col-md-12 col-sm-12 mt-2em">
              <div class="col-sm-12 col-lg-6 col-md-12">
                <button class="btn btn-success btn-block" id="addToTable" type="button">Agregar</button>
              </div>
              <div class="col-sm-12 col-lg-6 col-md-12">
                <button class="btn btn-danger btn-block" id="cancelAllConcepts" type="button">Cancelar</button>
              </div>
            </div>
              <table id="listConcepts" class="table table-striped table-hover">
                <thead>
                  <th style="width:4%" scope="col" class="text-center">ID</th>
                  <th style="width:8%" scope="col" class="text-center">Código</th>
                  <th scope="col" class="text-center">Concepto</th>
                  <th style="width:23%" scope="col" class="text-center">Cantidad</th>
                  <th style="width:10%" scope="col" class="text-cneter">Acción</th>
                </thead>
                <tbody>
                </tbody>
              </table>
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div id="respServer">
                  </div>
                </div>
              </div>
              <input type="hidden" name="opcion" id="opcion" value="15">
              <input type="hidden" name="id" id="id" value="">
              <div class="form-group col-lg-3 col-md-12 col-sm-12 pull-right">
                <div class="col-sm-12 col-lg-12 col-md-12">
                  <button style="display: none;" class="btn btn-primary btn-block" id="saveConcepts" type="submit">Agregar conceptos</button>
                </div>
              </div>
          </form>
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xl-12">
              <hr>
            </div>
          </div>
          <div class="row">
            <div id="cntnListProgress" class="col-lg-12 col-md-12 col-sm-12">
            </div>
          </div>
        </div>

      </div>
  </section>
</div>

<?php include('avance_fisico_modal_detalle.php'); ?>

<script type="text/javascript">
  window.onload = function() {
    fillConcepts();
    var tbody = $("#listConcepts tbody");
    if (tbody.children().length == 0) {
        $("#listConcepts").slideToggle();
    }
    listPhysProg();
    $('#concept').select2();
  };

</script>
