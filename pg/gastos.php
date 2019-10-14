<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Gastos
    <small>Inmobiliaria</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="inicio"><i class="fa fa-home"></i> Inicio</a></li>
    <li><a href="#">Inmobiliaria</a></li>
    <li href="rentas" class="active">Gastos</li>
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
        <div class="col-lg-3 alignMiddle">
          <button id="btnNewExpense" type="button" class="btn btn-primary btn-sm pull-right mt-2em ml-05em" >Nuevo gasto</button>
          <button id="btnSearchExpense" type="button" class="btn btn-success btn-sm pull-right mt-2em" ><i class="fa fa-search"></i>Búsqueda</button>
        </div>
        <!-- /.col -->
      </div>

      <form id="frmNewExpense" autocomplete="off" class="row cntntFrm mt-1em" style="display:none;">
        <input autocomplete="false" name="hidden" type="text" style="display:none;">
        <h3 class="ml-1em mt-0">Nuevo Gasto</h3><br>
        <div class="col-lg-12">
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="form-group">
              <label for="property">Propiedad</label>
              <select id="property" name="property" class="form-control select2" style="width: 100%;">
                <option value="0" selected="selected">Seleccionar...</option>
                <?php
                  $combo = @$conexion->obtenerlista($querys3->getDetailedPropiedades());
                  foreach ($combo as $key) {
                    $des = @$conexion->fetch_array($querys3->getListadoDesarrollo($key->desarrollo));
                    $build = $key->numero_edificio;
                    $level = @$conexion->fetch_array($querys3->getLevels($key->numero_nivel));
                    $dep = $key->numero_departamento;
                    echo '
             			 <option value="'.$key->id_propiedad.'" name="'.$des['nombre'].', '.$build.', '.$level['nombre'].', '.$dep.''.'">'.$des['nombre'].', '.$build.', '.$level['nombre'].', '.$dep.'</option>';
                  }
                ?>

              </select>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="form-group">
              <label for="type">Tipo de Gasto</label>
              <select class="form-control" id="type" name="typeExpense" style="width: 100%;">
                <option>Seleccionar...</option>
                <?php
                  $combo = @$conexion->obtenerlista($querys3->getTypesOfExpenses());
                  $funciones->llenarCombo($combo);
                ?>
              </select>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="form-group">
              <label for="amount">Monto</label>
              <input required pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" class="form-control" type="text" id="amount" name="amount">
            </div>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="form-group">
              <label for="date">Fecha</label>
              <input type="text" id="date" name="date" class="form-control" >
            </div>
          </div>

          <div class="col-lg-8 col-md-6 col-sm-12">
            <div class="form-group">
              <label for="remarks">Descripción</label>
              <input id="remarks" name="remarks" class="form-control"></input>
            </div>
          </div>

          <input type="hidden" name="opcion" value="25">
          <input type="hidden" id="id" name="id">

          <div class="form-group col-lg-4 col-md-4 col-sm-12 mt-2em">
            <div class="col-sm-12 col-lg-6 col-md-6">
              <button class="btn btn-primary btn-block" type="submit" id="saveExpense">Agregar</button>
              &nbsp;
            </div>
            <div class="col-sm-12 col-lg-6 col-md-6">
              <button class="btn btn-secondary btn-block" type="button" id="cancelExpense">Cancelar</button>
            </div>
          </div>
        </div>
      </form>
      <form id="frmExpenseSearch" class="row cntntFrm mt-1em" style="display:none;">
        <div class="col-lg-3 col-md-3 col-sm-12">
          <div class="form-group">
              <label>Mes</label>
              <select id="searchMonth" class="form-control select2" style="width: 100%;">
                <?php for ($i=1; $i < 13; $i++) { ?>
                  <option <?php if($i == date('m')){echo 'selected';} ?>  value="<?= $i; ?>"><?= $funciones->mes($i); ?></option>
                <?php } ?>
              </select>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12">
          <div class="form-group">
              <label>Año</label>
              <select id="searchYear" class="form-control select2" style="width: 100%;">
                <option selected="selected">2019</option>
                <option>2018</option>
                <option>2017</option>
                <option>2016</option>
                <option>2015</option>
              </select>
          </div>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-12">
          <label>Tipo de Gasto</label>
              <select id="searchExpenseType" class="form-control select2" style="width: 100%;">
                <option value='0' selected="selected">Cualquiera</option>
                <?php
                  $combo = @$conexion->obtenerlista($querys3->getTypesOfExpenses());
                  $funciones->llenarCombo($combo);
                ?>
              </select>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12">
          <button id="resetSearchForm" type="button" class="btn btn-success btn-sm mt-2em" ><i class="fa fa-eraser"></i>&nbsp;Borrar</button>
          <button id="searchExpense" type="button" class="btn btn-primary btn-sm mt-2em" ><i class="fa fa-search"></i>&nbsp;Buscar</button>
          <button id="cancelSearch" type="button" class="btn btn-danger btn-sm mt-2em" ><i class="fa fa-times"></i>&nbsp;Cancelar</button>
        </div>
      </form>
      <hr>
      <div class="row">
        <div id="cntnListExpenses" class="col-lg-12 col-md-12 col-sm-12">

        </div>
      </div>
    </div>

    <div class="box-footer">
     </div>
  </div>
<!-- /.row -->
</section>
<!-- /.content -->

<script type="text/javascript">
  window.onload = function() {
    listExpenses();

    dateControl('date');
  }
</script>
