<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Cobros
    <small>Inmobiliaria</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="inicio"><i class="fa fa-home"></i> Inicio</a></li>
    <li><a href="#">Inmobiliaria</a></li>
    <li href="rentas" class="active">Cobros</li>
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
      <div class="row divBusqueda" >
        <div class="col-lg-6" >
          <div class="form-group">
                  <label>Cliente</label>
                  <select class="form-control select2" style="width: 100%;">
                    <option selected="selected">Seleccionar</option>
                    <option>Juan Pérez López</option>
                    <option>María Suárez González</option>
                    <option>Ramón Cabrera Jiménez</option>
                    <option>Magaly Chavez Rojas</option>
                    <option>Josefina Vásquez Torres</option>
                    <option>Germán Parra Cruz</option>
                  </select>
          </div>
        </div>
        <div class="col-lg-3">
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
        <div class="col-lg-3 alignMiddle">
          <button id="btnNvoPago" type="button" class="btn btn-primary btn-sm pull-right mt-2em" >Nuevo cobro</button>
        </div>
        <!-- /.col -->
      </div>

      <div id="frmPago" class="row cntntFrm" style="display:none;">
        <div class="col-lg-12">
          <div class="col-lg-4">
            <div class="form-group">
              <label>Tipo de cobro</label>
              <select class="form-control select2" style="width: 100%;">
                <option value="0" selected="selected">Seleccionar</option>
                <option value="1" >Normal</option>
                <option value="2" >Anticipo</option>
              </select>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="form-group">
              <label for="txtFolio">Folio</label>
              <input type="text" id="txtFolio" name="txtFolio" class="form-control" placeholder="Folio...">
            </div>
          </div>

          <div class="col-lg-4">
            <div class="form-group">
              <label for="txtFecha">Fecha</label>              
              <input type="text" id="txtFecha" name="txtFecha" class="form-control" value="<?= date('d-m-Y') ?>">
            </div>
          </div>

          <div class="col-lg-4">
            <div class="form-group">
              <label for="txtMonto">Cliente</label>              
              <select class="form-control select2" id="txtCliente" name="txtCliente" style="width: 100%;">
                <option  selected="selected">Seleccionar</option>
                <option>Juan Pérez López</option>
                <option>María Suárez González</option>
                <option>Ramón Cabrera Jiménez</option>
                <option>Magaly Chavez Rojas</option>
                <option>Josefina Vásquez Torres</option>
                <option>Germán Parra Cruz</option>
              </select>
            </div>
          </div>
            <div class="col-lg-4">
            <div class="form-group">
              <label for="txtMonto">Inmueble</label>              
              <select class="form-control select2" id="txtInmueble" name="txtInmueble" style="width: 100%;">
                <option  selected="selected">Seleccionar</option>
                <option>Inmueble I</option>
                <option>Inmuble II</option>
                <option>Inmuble III</option>
                <option>Inmuble IV</option>
                <option>Inmuble V</option>
                <option>Inmuble VI</option>
              </select>
            </div>
          </div>
         <div class="col-lg-4">
            <div class="form-group">
              <label for="txtNumeroP">Número de Pago</label>              
              <select class="form-control select2" id="txtNumeroP" name="txtNumeroP" style="width: 100%;">
                <option  selected="selected">Seleccionar</option>
                <option>15-01-2019</option>
                <option>31-01-2019</option>
                <option>15-02-2019</option>
                <option>28-02-2019</option>
                <option>15-03-2019</option>
                <option>30-03-2019</option>
              </select>
            </div>
          </div>
            <div class="col-lg-4">
            <div class="form-group">
              <label for="txtMonto">Monto</label>              
              <input type="text" id="txtMonto" name="txtMonto" class="form-control" >
            </div>
          </div>
            <div class="col-lg-4">
            <div class="form-group">
              <label for="txtCuenta">A cuenta</label>              
              <select class="form-control select2" id="txtCuenta" name="txtCuenta" style="width: 100%;">
                <option  selected="selected">Seleccionar</option>
                <option>073576325723</option>
                <option>073587322323</option>
                <option>008231235723</option>
                <option>097686322312</option>
              </select>
            </div>
          </div>

          <div class="col-lg-12">
            <div class="form-group">
              <label for="txtObservaciones">Obervaciones</label>              
              <textarea id="txtObservaciones" name="txtObservaciones" class="form-control" rows="3"></textarea>
            </div>
          </div>

          <div class="col-lg-12 text-center">
              <button id="btnGuardaPago" class="btn btn-primary btn-sm">Guardar</button>
              <button id="btnCancelaPago" class="btn btn-secondary btn-sm">Cancelar</button>
          </div>
        </div>
      </div>
      <hr>
      <div class="row">
        <div id="cntnListPagos" class="col-lg-12 col-md-12 col-sm-12">
          <table id="listCobrosCliente" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th class="text-center">Num. Pago</th>
                  <th class="text-center">Monto</th>
                  <th class="text-center">Fecha</th>
                  <th class="text-center">Estatus</th>
                  <th class="text-center">Acciones</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td class="text-center">6</td>
                  <td class="text-right">$1,000.00</td>
                  <td class="text-center">01-06-2019</td>
                  <td class="text-center">Pagado</td>
                  <td class="text-center"><button type="button" class="btn btn-success btn-sm"><i class="fa fa-file-text-o"></i></button></td>
                </tr>
                <tr>
                  <td class="text-center">5</td>
                  <td class="text-right">$1,000.00</td>
                  <td class="text-center">02-05-2019</td>
                  <td class="text-center">Pagado</td>
                  <td class="text-center"><button type="button" class="btn btn-success btn-sm"><i class="fa fa-file-text-o"></i></button></td>
                </tr>
                <tr>
                  <td class="text-center">4</td>
                  <td class="text-right">$1,000.00</td>
                  <td class="text-center">01-04-2019</td>
                  <td class="text-center">Pagado</td>
                  <td class="text-center"><button type="button" class="btn btn-success btn-sm"><i class="fa fa-file-text-o"></i></button></td>
                </tr>
                <tr>
                  <td class="text-center">3</td>
                  <td class="text-right">$1,000.00</td>
                  <td class="text-center">01-03-2019</td>
                  <td class="text-center">Pagado</td>
                  <td class="text-center"><button type="button" class="btn btn-success btn-sm"><i class="fa fa-file-text-o"></i></button></td>
                </tr>
                <tr>
                  <td class="text-center">2</td>
                  <td class="text-right">$1,000.00</td>
                  <td class="text-center">02-02-2019</td>
                  <td class="text-center">Pagado</td>
                  <td class="text-center"><button type="button" class="btn btn-success btn-sm"><i class="fa fa-file-text-o"></i></button></td>
                </tr>
                <tr>
                  <td class="text-center">1</td>
                  <td class="text-right">$1,000.00</td>
                  <td class="text-center">03-01-2019</td>
                  <td class="text-center">Pagado</td>
                  <td class="text-center"><button type="button" class="btn btn-success btn-sm"><i class="fa fa-file-text-o"></i></button></td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                  <th>Rendering engine</th>
                  <th>Browser</th>
                  <th>Platform(s)</th>
                  <th>Engine version</th>
                  <th>CSS grade</th>
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

    //Inicializa DatePicker
    activaDatePicker('txtFecha');

    loadDataTable('listCobrosCliente', true);
      
    $("#btnNvoPago").on("click",function(){
        $(".divBusqueda").hide();
    });
    $("#btnCancelaPago").on("click",function(){
        $(".divBusqueda").show();
    });
  }
</script>