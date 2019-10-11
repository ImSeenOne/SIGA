<section class="content-header">
  <h1>
    Estimaciones
    <small>Obras</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="inicio"><i class="fa fa-home"></i> Inicio</a></li>
    <li><a href="#">Estimaciones</a></li>
    <li href="#" class = "active">Obras</li>
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
        <div class="row" style="margin-top:-1.2em!important;">
          <div class="col-lg-6"></div>
          <div class="col-lg-6 alignMiddle">
            <button id="btnNewWork" type="button" class="btn btn-primary btn-sm pull-right mt-2em" >Nueva obra</button>
          </div>
        </div>

        <form id="frmWork" name="frmWork" class="cntntFrm mt-1em" style="display:none;" autocomplete="off">
          <input autocomplete="false" name="hidden" type="text" style="display:none;">
            <div class="row col-lg-12">
              <div class="col-lg-3">
                <div class="form-group">
                  <label for="txtName">Nombre de la obra</label>
                  <input required type="text" id="txtName" name="txtName" class="form-control" placeholder="Nombre" maxlength="100">
                  <div id="reqTxtName" class="text-danger"></div>
                </div>
              </div>

              <div class="col-lg-3">
                <div class="form-group">
                  <label for="inputType">Tipo</label>
                  <select required id="inputType" name="inputType" class="form-control">
                    <!-- <option selected>Escoger un tipo</option> -->
                    <option value="1">Licitación</option>
                    <option value="2">Asignación directa</option>
                    <option value="3">Proyectos</option>
                  </select>
                  <div id="reqSelType"></div>
                </div>
              </div>

              <div class="col-lg-3">
                <div class="form-group">
                  <label for="txtDependency">Dependencia</label>
                  <input required type="text" maxlength="50" id="txtDependency" name="txtDependency" class="form-control" placeholder="Dependencia">
                  <div id="reqTxtDependency" class="text-danger"></div>
                </div>
              </div>

              <div class="col-lg-3">
                <div class="form-group">
                  <label for="inputAmount">Monto</label>
                  <input required pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" type="text" id="inputAmount" name="inputAmount" class="form-control"/>
                  <div id="reqInputAmount" class="text-danger"></div>
                </div>
              </div>
            </div>
            <div class="row col-lg-12">
              <div class="col-lg-3">
                <div class="form-group">
                  <label for="">Fecha inicio</label>
                  <input required onkeypress="return isNumberKey(event)" data-toggle="tooltip" data-placement="right" title="Fecha de inicio" id = "date1" name="date1" type="date" aria-label="Fecha de inicio" class="form-control" value="<?= date('Y-m-d') ?>">
                  <div id="reqDateStart" class="text-danger"></div>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group">
                  <label for="date2">Fecha finalización</label>
                  <input required onkeypress="return isNumberKey(event)" data-toggle="tooltip" data-placement="right" title="Fecha de termino" id = "date2" name="date2" type="date" aria-label="Fecha de finalización" class="form-control">
                  <div id="reqDateFinish" class="text-danger"></div>
                </div>
              </div>
              <div class="col-lg-3" hidden>
                <div class="form-group" hidden>
                  <label hidden for="txtFolderVol">Volumenes carpeta</label>
                  <input type="hidden" maxlength="50" name="txtFolderVol" id="txtFolderVol" class="form-control">
                  <div id="reqFolderVol" class="text-danger"></div>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group">
                  <label for="addedType">Tipo agregado</label>
                  <select class="custom-select form-control" name="addedType" id="addedType">
                    <?php
                      $lista =$conexion->obtenerlista("SELECT id_tipo_agregado id, nombre valor FROM tblc_tipo_agregado");
                      $funciones->llenarcombo($lista);
                    ?>
                  </select>
                </div>
              </div>
              <div id="reqFormWork" class="text-danger"></div>
            </div>
              <div class="row col-lg-12" hidden>
                <div class="col-lg-3" hidden>
                  <div class="form-group" hidden>
                    <label for="txtConcreteVol" hidden>Volumen de concreto</label>
                    <input class="form-control" type="hidden" name="txtConcreteVol" id="txtConcreteVol">
                    <div id="reqConcreteVol" class="text-danger"></div>
                  </div>
                </div>
                <div class="col-lg-3">
                  <div class="form-group">
                    <label for="txtWorkArea">Área de la obra</label>
                    <input class="form-control" type="text" name="txtWorkArea" id="txtWorkArea">
                    <div id="reqWorkArea" class="text-danger"></div>
                  </div>
                </div>
              </div>
              <div id="alert" class="alert alert-success" style="display: none;" role="alert">

              </div>
              <div class="row col-lg-12">
                <div class="form-group text-right text-bottom">
                  <input type="hidden" id="idWork" name="idWork">
                  <input type="hidden" id="opcion" name="opcion" value="3">
                  <div id="respServer"></div>
                  <br>
                  <button id="btnSavePO" type="button" data-fancybox data-type="ajax"
                  class="btn btn-success btn-sm">Presupuesto de Obra</button>&nbsp;
                  <button id="btnSaveEI" type="button" data-fancybox data-type="ajax"
                  class="btn btn-success btn-sm">Explosión de Insumos</button>&nbsp;
                  <button id="btnSaveMO" type="button" data-fancybox data-type="ajax"
                  class="btn btn-success btn-sm">Mano de Obra</button>&nbsp;
                  <button id="btnSaveWork" type="button" class="btn btn-primary btn-sm">Guardar</button>&nbsp;
                  <button id="btnCancelWork" type="button" class="btn btn-secondary btn-sm">Cancelar</button>
                </div>
              </div>
            </div>

        </form>
        <hr>
        <div class="row">
          <div id="cntnListPagos" class="col-lg-12 col-md-12 col-sm-12">
          </div>
        </div>
      </div>
  </div>
</section>

<!-- Main content -->

    <!-- /.content -->

<script type="text/javascript">
  window.onload = function(){
    work_list();
  }
</script>
