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
          <button id="btnNvoGasto" type="button" class="btn btn-primary btn-sm pull-right mt-2em ml-05em" >Nuevo gasto</button>
          <button id="btnBusquedaGastos" type="button" class="btn btn-success btn-sm pull-right mt-2em" ><i class="fa fa-search"></i>Búsqueda</button>
        </div>
        <!-- /.col -->
      </div>      

      <div id="frmBusquedaGasto" class="row cntntFrm mt-1em" style="display:none;">
        <div class="col-lg-3 col-md-3 col-sm-12">
          <div class="form-group">
              <label>Mes</label>
              <select class="form-control select2" style="width: 100%;">
                <?php for ($i=1; $i < 13; $i++) { ?>
                  <option <?php if($i == date('m')){echo 'selected';} ?>  value="<?= $i; ?>"><?= $funciones->mes($i); ?></option>
                <?php } ?>
              </select>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12">
          <div class="form-group">
              <label>Año</label>
              <select class="form-control select2" style="width: 100%;">
                <option selected="selected">2019</option>
                <option>2018</option>
                <option>2017</option>
                <option>2016</option>
                <option>2015</option>
              </select>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12">
          <label>Tipo de gasto</label>
              <select class="form-control select2" style="width: 100%;">
                <option selected="selected">Propaganda</option>
                <option>Mantenimiento</option>
                <option>Operación</option>
                <option>Servicios</option>
                <option>Suministros</option>
              </select>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12">
          <button id="btnBusquedaGastos" type="button" class="btn btn-success btn-sm pull-right mt-2em ml-05em" ><i class="fa fa-eraser"></i> Resetear</button>
          <button id="btnNvoGasto" type="button" class="btn btn-primary btn-sm pull-right mt-2em" ><i class="fa fa-search"></i> Buscar</button>
        </div>
      </div>
      <div id="frmGasto" class="row cntntFrm mt-1em" style="display:none;">
        <h3 class="ml-1em mt-0">Nuevo gasto</h3><br>
        <div class="col-lg-12">
          <div class="col-lg-4">
            <div class="form-group">
              <label>Propiedad</label>
              <select class="form-control select2" style="width: 100%;">
                <option value="0" selected="selected">Seleccionar</option>
                <option value="1" >Propiedad 1</option>
                <option value="2" >Proiedad 2</option>
                <option value="3" >Proiedad 3</option>
                <option value="4" >Proiedad 4</option>
                <option value="5" >Proiedad 5</option>
                <option value="6" >Proiedad 6</option>
                <option value="7" >Proiedad 7</option>
                <option value="8" >Proiedad 8</option>
                <option value="9" >Proiedad 9</option>
                <option value="10" >Proiedad 10</option>
                <option value="11" >Proiedad 11</option>
              </select>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="form-group">
              <label for="txtFolio">Tipo de gasto</label>
              <select class="form-control select2" style="width: 100%;">
                <option value="0" selected="selected">Seleccionar</option>
                <option value="1" >Pago Agua</option>
                <option value="2" >Pago Luz</option>
                <option value="3" >Fontanería</option>
                <option value="4" >Gastos de operación</option>
                <option value="5" >Publicidad</option>
                <option value="6" >Otros Gastos</option>
              </select>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="form-group">
              <label for="txtMonto">Monto</label>              
              <input type="text" id="txtMonto" name="txtMonto" class="form-control">
            </div>
          </div>

          <div class="col-lg-4">
            <div class="form-group">
              <label for="txtFecha">Fecha</label>              
              <input type="text" id="txtFecha" name="txtFecha" class="form-control" >
            </div>
          </div>

          <div class="col-lg-12">
            <div class="form-group">
              <label for="txtObservaciones">Obervaciones</label>              
              <textarea id="txtObservaciones" name="txtObservaciones" class="form-control" rows="3"></textarea>
            </div>
          </div>

          <div class="col-lg-12 text-center">
              <button id="btnGuardaGasto" class="btn btn-primary btn-sm">Guardar</button>
              <button id="btnCancelaGasto" class="btn btn-secondary btn-sm">Cancelar</button>
          </div>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 text-center">
          <h3>Gastos del mes de <cite class="cite">Junio</cite></h3>
        </div>
        <div id="cntnListGastos" class="col-lg-12 col-md-12 col-sm-12">
          <table id="listGastos" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th class="text-center">Propiedad</th>
                  <th class="text-center">Tipo de gasto</th>
                  <th class="text-center">Descripción</th>
                  <th class="text-center">Monto</th>
                  <th class="text-center">Fecha</th>
                  <th class="text-center">Acciones</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td class="text-center">Casa Num. 1, Fracc. Nombre</td>
                  <td class="text-center">Fontanería</td>
                  <td class="text-center">Cambio de llaves de lavabo</td>
                  <td class="text-right">$500.00</td>
                  <td class="text-center">13-06-2019</td>
                  <td class="text-center"><button type="button" class="btn btn-success btn-sm" title="Comprobante de gasto"><i class="fa fa-file-text-o"></i></button></td>
                </tr>
                <tr>
                  <td class="text-center">Casa Num. 1, Fracc. Nombre</td>
                  <td class="text-center">Fontanería</td>
                  <td class="text-center">Cambio de llaves de lavabo</td>
                  <td class="text-right">$500.00</td>
                  <td class="text-center">13-06-2019</td>
                  <td class="text-center"><button type="button" class="btn btn-success btn-sm" title="Comprobante de gasto"><i class="fa fa-file-text-o"></i></button></td>
                </tr>
                <tr>
                  <td class="text-center">Casa Num. 1, Fracc. Nombre</td>
                  <td class="text-center">Fontanería</td>
                  <td class="text-center">Cambio de llaves de lavabo</td>
                  <td class="text-right">$500.00</td>
                  <td class="text-center">13-06-2019</td>
                  <td class="text-center"><button type="button" class="btn btn-success btn-sm" title="Comprobante de gasto"><i class="fa fa-file-text-o"></i></button></td>
                </tr>
                <tr>
                  <td class="text-center">Casa Num. 1, Fracc. Nombre</td>
                  <td class="text-center">Fontanería</td>
                  <td class="text-center">Cambio de llaves de lavabo</td>
                  <td class="text-right">$500.00</td>
                  <td class="text-center">13-06-2019</td>
                  <td class="text-center"><button type="button" class="btn btn-success btn-sm" title="Comprobante de gasto"><i class="fa fa-file-text-o"></i></button></td>
                </tr>
                <tr>
                  <td class="text-center">Casa Num. 1, Fracc. Nombre</td>
                  <td class="text-center">Fontanería</td>
                  <td class="text-center">Cambio de llaves de lavabo</td>
                  <td class="text-right">$500.00</td>
                  <td class="text-center">13-06-2019</td>
                  <td class="text-center"><button type="button" class="btn btn-success btn-sm" title="Comprobante de gasto"><i class="fa fa-file-text-o"></i></button></td>
                </tr>
                <tr>
                  <td class="text-center">Casa Num. 1, Fracc. Nombre</td>
                  <td class="text-center">Fontanería</td>
                  <td class="text-center">Cambio de llaves de lavabo</td>
                  <td class="text-right">$500.00</td>
                  <td class="text-center">13-06-2019</td>
                  <td class="text-center"><button type="button" class="btn btn-success btn-sm" title="Comprobante de gasto"><i class="fa fa-file-text-o"></i></button></td>
                </tr>
                <tr>
                  <td class="text-center">Casa Num. 1, Fracc. Nombre</td>
                  <td class="text-center">Fontanería</td>
                  <td class="text-center">Cambio de llaves de lavabo</td>
                  <td class="text-right">$500.00</td>
                  <td class="text-center">13-06-2019</td>
                  <td class="text-center"><button type="button" class="btn btn-success btn-sm" title="Comprobante de gasto"><i class="fa fa-file-text-o"></i></button></td>
                </tr>
                <tr>
                  <td class="text-center">Casa Num. 1, Fracc. Nombre</td>
                  <td class="text-center">Fontanería</td>
                  <td class="text-center">Cambio de llaves de lavabo</td>
                  <td class="text-right">$500.00</td>
                  <td class="text-center">13-06-2019</td>
                  <td class="text-center"><button type="button" class="btn btn-success btn-sm" title="Comprobante de gasto"><i class="fa fa-file-text-o"></i></button></td>
                </tr>
                <tr>
                  <td class="text-center">Casa Num. 1, Fracc. Nombre</td>
                  <td class="text-center">Fontanería</td>
                  <td class="text-center">Cambio de llaves de lavabo</td>
                  <td class="text-right">$500.00</td>
                  <td class="text-center">13-06-2019</td>
                  <td class="text-center"><button type="button" class="btn btn-success btn-sm" title="Comprobante de gasto"><i class="fa fa-file-text-o"></i></button></td>
                </tr>
                <tr>
                  <td class="text-center">Casa Num. 1, Fracc. Nombre</td>
                  <td class="text-center">Fontanería</td>
                  <td class="text-center">Cambio de llaves de lavabo</td>
                  <td class="text-right">$500.00</td>
                  <td class="text-center">13-06-2019</td>
                  <td class="text-center"><button type="button" class="btn btn-success btn-sm" title="Comprobante de gasto"><i class="fa fa-file-text-o"></i></button></td>
                </tr>

                <tr>
                  <td class="text-center">Casa Num. 1, Fracc. Nombre</td>
                  <td class="text-center">Fontanería</td>
                  <td class="text-center">Cambio de llaves de lavabo</td>
                  <td class="text-right">$500.00</td>
                  <td class="text-center">13-06-2019</td>
                  <td class="text-center"><button type="button" class="btn btn-success btn-sm" title="Comprobante de gasto"><i class="fa fa-file-text-o"></i></button></td>
                </tr>
                <tr>
                  <td class="text-center">Casa Num. 1, Fracc. Nombre</td>
                  <td class="text-center">Fontanería</td>
                  <td class="text-center">Cambio de llaves de lavabo</td>
                  <td class="text-right">$500.00</td>
                  <td class="text-center">13-06-2019</td>
                  <td class="text-center"><button type="button" class="btn btn-success btn-sm" title="Comprobante de gasto"><i class="fa fa-file-text-o"></i></button></td>
                </tr>
                <tr>
                  <td class="text-center">Casa Num. 1, Fracc. Nombre</td>
                  <td class="text-center">Fontanería</td>
                  <td class="text-center">Cambio de llaves de lavabo</td>
                  <td class="text-right">$500.00</td>
                  <td class="text-center">13-06-2019</td>
                  <td class="text-center"><button type="button" class="btn btn-success btn-sm" title="Comprobante de gasto"><i class="fa fa-file-text-o"></i></button></td>
                </tr>
                <tr>
                  <td class="text-center">Casa Num. 1, Fracc. Nombre</td>
                  <td class="text-center">Fontanería</td>
                  <td class="text-center">Cambio de llaves de lavabo</td>
                  <td class="text-right">$500.00</td>
                  <td class="text-center">13-06-2019</td>
                  <td class="text-center"><button type="button" class="btn btn-success btn-sm" title="Comprobante de gasto"><i class="fa fa-file-text-o"></i></button></td>
                </tr>
                <tr>
                  <td class="text-center">Casa Num. 1, Fracc. Nombre</td>
                  <td class="text-center">Fontanería</td>
                  <td class="text-center">Cambio de llaves de lavabo</td>
                  <td class="text-right">$500.00</td>
                  <td class="text-center">13-06-2019</td>
                  <td class="text-center"><button type="button" class="btn btn-success btn-sm" title="Comprobante de gasto"><i class="fa fa-file-text-o"></i></button></td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                  <th class="text-center">Propiedad</th>
                  <th class="text-center">Tipo de gasto</th>
                  <th class="text-center">Descripción</th>
                  <th class="text-center">Monto</th>
                  <th class="text-center">Fecha</th>
                  <th class="text-center">Acciones</th>
                </tr>
                </tfoot>
              </table>
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
    //Initialize Select2 Elements
    selectFrm('select2');

    //frmNumerico('txtMonto');

    //Inicializa DatePicker
    activaDatePicker('txtFecha');

    loadDataTable('listGastos', true);
  }
</script>