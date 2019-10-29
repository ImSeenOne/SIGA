<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Combustibles
    <small>Gerencia</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="inicio"><i class="fa fa-home"></i> Inicio</a></li>
    <li><a href="#">Gerencia</a></li>
    <li>Combustibles</li>
    <li href="gasolina_interna" class="active">Gasolina Interna</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">&nbsp;</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>
        <!-- /.box-header -->
    <div class="box-body">
      <div class="row">
        <div class="col-lg-6"></div>
        <div class="col-lg-3"></div>
        <div class="col-lg-3">
          <button id="btnNewInsFuelExp" type="button" class="btn btn-primary btn-sm pull-right mt-2em ml-05em" ><i class="fa fa-plus"></i>&nbsp;Agregar gasto</button>
        </div>
        <!-- /.col -->
      </div>

      <form id="frmNewInsFuelExp" autocomplete="off" class="row cntntFrm mt-1em" style="display:none;">
        <input autocomplete="false" name="hidden" type="text" style="display:none;">
        <h3 class="ml-1em mt-0">Registro de combustible</h3><br>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xl-12">
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="form-group">
              <label for="property">Folio</label>
              <input class="form-control" type="text" id="folio" name="folio" disabled value="Folio generado automáticamente">
            </div>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="form-group">
              <label for="dateStart">Fecha inicial</label>
              <input required class="form-control text-center" type="text" name="dateStart" id="dateStart" onchange="setWeek()">
            </div>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="form-group">
              <label for="dateStart">Fecha final</label>
              <input required class="form-control text-center" type="text" name="dateFinish" id="dateFinish" onchange="verifyMinorDate()">
            </div>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="form-group">
              <label for="status">Status</label>
              <select class="form-control" name="status" id="status">
                <option value="0">Selecciona una opción...</option>
                <?php
                  $tmpS = @$conexion->obtenerlista($querys3->listInsFuelExpStatus());
                  $querys3->fillSelectInsFuelExpStatus($tmpS);
                 ?>
              </select>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="form-group">
              <label for="magna">Magna</label>
              <input required pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" class="form-control" type="text" id="magna" name="magna" onkeyup="sumTotal()">
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="form-group">
              <label for="premium">Premium</label>
              <input required pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" class="form-control" type="text" id="premium" name="premium" onkeyup="sumTotal()">
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="form-group">
              <label for="diesel">Diesel</label>
              <input required pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" class="form-control" type="text" id="diesel" name="diesel" onkeyup="sumTotal()">
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="form-group">
              <label for="magnaLts">Litros en Magna</label>
              <input required class="form-control" type="number" step =".01" id="magnaLts" name="magnaLts" onkeyup="sumTotal()">
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="form-group">
              <label for="premiumLts">Litros en Premium</label>
              <input required class="form-control" type="number" step =".01" id="premiumLts" name="premiumLts" onkeyup="sumTotal()">
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="form-group">
              <label for="dieselLts">Litros en Diesel</label>
              <input required class="form-control" type="number" step =".01" id="dieselLts" name="dieselLts" onkeyup="sumTotal()">
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="form-group">
              <label for="totalAmount">Importe total</label>
              <input disabled pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" class="form-control" type="text" id="totalAmount" name="totalAmount">
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="form-group">
              <label for="work">Obra</label>
              <select required class="form-control" name="work" id="work">
                <option value="0">Selecciona una opción...</option>
                <?php
                  $combo = @$conexion->obtenerlista($querys3->getListadoObras());
                  $funciones->llenarCombo($combo);
                ?>
              </select>
            </div>
          </div>

          <input type="hidden" name="opcion" id="opcion" value="27">
          <input type="hidden" id="id" name="id">

          <div id="respServer">

          </div>

          <div class="form-group col-lg-4 col-md-12 col-sm-12 col-xs-12 mt-2em pull-right">
            <div class="col-sm-12 col-lg-6 col-md-6">
              <button class="btn btn-primary btn-block" type="submit">Agregar</button>
              &nbsp;
            </div>
            <div class="col-sm-12 col-lg-6 col-md-6">
              <button class="btn btn-secondary btn-block" type="button" id="btnCancelInsFuelExp">Cancelar</button>
            </div>
          </div>
        </div>
      </form>
      <hr>
      <div class="row">
        <div id="cntnListInsFuelExp" class="col-lg-12 col-md-12 col-sm-12 table-responsive">

        </div>
      </div>
    </div>

    <div class="box-footer">
    </div>
  </div>
<!-- /.row -->
</section>
<!-- /.content -->
<?php include('gasolina_interna_asignacion_modal.php'); ?>

<script type="text/javascript">
  window.onload = function() {
    listInsFuelExps();
    dateControl('dateStart');
    dateControl('dateFinish');
    dateControl('dateAss');
    $('#assignExpenseModal').on('shown.bs.modal', function () {
      $('#modalUser').trigger('focus');
    });
    loadDataTable('listInsFuelExp',true);
  }

  function setWeek(){
    let year = parseInt($('#dateStart').val().split('/')[2]);
    let month = parseInt($('#dateStart').val().split('/')[1]);
    let day = parseInt($('#dateStart').val().split('/')[0]);
    switch(month){
      case 1:
        if(day > 24){
          month++;
          day += 7;
          if(day > 31){
            day -= 31;
          }
        } else {
          day += 7;
        }
      break;

      case 2:
        if(day > 21){
          month++;
          day += 7;
          if(day > 28){
            day -= 28;
          }
        } else {
          day += 7;
        }
      break;

      case 3:
        if(day > 24){
          month++;
          day += 7;
          if(day > 31){
            day -= 31;
          }
        } else {
          day += 7;
        }
      break;

      case 4:
        if(day > 23){
          month++;
          day += 7;
          if(day > 30){
            day -= 30;
          }
        } else {
          day += 7;
        }
      break;

      case 5:
        if(day > 24){
          month++;
          day += 7;
          if(day > 31){
            day -= 31;
          }
        } else {
          day += 7;
        }
      break;

      case 6:
        if(day > 23){
          month++;
          day += 7;
          if(day > 30){
            day -= 30;
          }
        } else {
          day += 7;
        }
      break;

      case 7:
        if(day > 24){
          month++;
          day += 7;
          if(day > 31){
            day -= 31;
          }
        } else {
          day += 7;
        }
      break;

      case 8:
      if(day > 24){
        month++;
        day += 7;
        if(day > 31){
          day -= 31;
        }
      } else {
        day += 7;
      }
      break;

      case 9:
        if(day > 23){
          month++;
          day += 7;
          if(day > 30){
            day -= 30;
          }
        } else {
          day += 7;
        }
      break;

      case 10:
        if(day > 24){
          month++;
          day += 7;
          if(day > 31){
            day -= 31;
          }
        } else {
          day += 7;
        }
      break;

      case 11:
        if(day > 23){
          month++;
          day += 7;
          if(day > 30){
            day -= 30;
          }
        } else {
          day += 7;
        }
      break;
      case 12:
        if(day > 24){
          year++;
          month = 1;
          day += 7;
          if(day > 31){
            day -= 31;
          }
        } else {
          day += 7;
        }
      break;
    }
    if(day < 10){
      day = '0'+day;
    }
    if(month < 10){
      month = '0'+month;
    }
    $('#dateFinish').val(day+'/'+month+'/'+year);
    verifyMinorDate();
  }

  function sumTotal(){
    let magnaPrice = ($('#magna').val()) ? parseFloat($('#magna').val().replace("$", "").replace(",","")) : 0;

    let premiumPrice = ($('#premium').val()) ? parseFloat($('#premium').val().replace("$", "").replace(",","")) : 0;

    let dieselPrice = ($('#diesel').val()) ? parseFloat($('#diesel').val().replace("$", "").replace(",","")) : 0;


    let quantMagna = ($('#magnaLts').val()) ? parseFloat($('#magnaLts').val().replace(',','')) : 0;
    let quantPremium = ($('#premiumLts').val()) ? parseFloat($('#premiumLts').val()) : 0;
    let quantDiesel = ($('#dieselLts').val()) ? parseFloat($('#dieselLts').val()) : 0;
    let total = (parseFloat(magnaPrice) * parseFloat(quantMagna)) + (parseFloat(premiumPrice) * parseFloat(quantPremium)) + (parseFloat(dieselPrice) * parseFloat(quantDiesel));


    $('#totalAmount').val(total);
    $('#totalAmount').trigger('keyup');
  }

  function verifyMinorDate(){
    let descomponeFecha1 = $('#dateStart').val().split("/");
    let fecha1 = new Date(descomponeFecha1[2],descomponeFecha1[1],descomponeFecha1[0]);
    let descomponeFecha2 = $('#dateFinish').val().split("/");
    let fecha2 = new Date(descomponeFecha2[2],descomponeFecha2[1],descomponeFecha2[0]);

    if(fecha1 > fecha2){
      let opciones = {
  			appendTo:'#frmNewInsFuelExp',
  			minWidth:300,
  			maxWidth: 350,
  		};
  		parent.mensaje("La fecha inicial debe ser menor que la final",'warning',opciones);
      $('#dateFinish').val($('#dateStart').val());
    }
  }
</script>
