<section class="content-header">
  <h1>
    Empleados
    <small>Recursos humanos</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="inicio"><i class="fa fa-home"></i> Inicio</a></li>
    <li><a href="#">Recursos humanos</a></li>
    <li href="empleados">Empleados</li>
  </ol>
</section>

<section class="content">
  <div class="col-lg-12 col-md-12 col-sm-12">
    <div class="box box-default">
      <div class="box-header with-border">
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>
      <div class="box-body">
        <div class="row" style="margin-top:-1.2em!important;">
          <div class="col-lg-12"></div>
          <div class="col-lg-12 alignMiddle">
            <button id="btnNewEmployee" type="button" class="btn btn-primary btn-sm pull-right mt-2em" >
              Agregar empleado
            </button>
            &nbsp;
            <button id="btnSearchEmployee" type="button" class="btn btn-info pull-right btn-sm mt-2em " >
              Buscar empleado
            </button>

          </div>
        </div>
        <form id="frmSearchEmployee" name="frmSearchEmployee" class="mt-1em" style="display:none;">
          <div class="col-lg-12">
            <div class="col-lg-3 ">
              <div class="form-group">
                <label for="txtEmployee">Nombre</label>
                <input onkeyup="employees_list()" class="form-control" type="text" name="txtEmployee" id="txtEmployee">
                <small class="form-text text-danger"></small>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label for="txtSS">IMSS</label>
                <input onkeyup="employees_list()" class="form-control" type="text" maxlength="13" name="txtSS" id="txtSS" onkeypress="isNumberKey(event)">
                <small class="form-text text-danger"></small>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label for="txtRFC">RFC</label>
                <input onkeyup="employees_list()" class="form-control" type="text" maxlength="18" name="txtRFC" id="txtRFC">
                <small class="form-text text-danger"></small>
              </div>
            </div>
            <div class="col-lg-3">
                <button class="btn btn-danger btn-sm btn-block mt-2em" type="button" name="btnCancelSearch" id="btnCancelSearch">Cancelar</button>
            </div>
          </div>
        </form>
        <form id="frmAddEmployee" name="frmAddEmployee" class="mt-1em" style="display:none;">
          <div class="col-lg-12">

            <div class="col-lg-3 col-md-4 col-sm-6">
              <div class="form-group">
                <label for="txtName">Nombre</label>
                <input class="form-control" type="text" name="txtName" id="txtName" placeholder="Nombre">
                <p class="help-block text-danger" id="reqTxtName"></p>
              </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6">
              <div class="form-group">
                <label for="txtLastName">Apellido paterno</label>
                <input class="form-control" type="text" name="txtLastName" id="txtLastName" placeholder="Apellido paterno">
                <p class="help-block text-danger" id="reqTxtLastName"></p>

              </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6">
              <div class="form-group">
                <label for="txtMLastName">Apellido materno</label>
                <input class="form-control" type="text" name="txtMLastName" id="txtMLastName" placeholder="Apellido materno">
                <p class="help-block text-danger" id="reqTxtMLastName"></p>
              </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6">
              <div class="form-group">
                <label for="txtAddress">Dirección</label>
                <input class="form-control" type="text" name="txtAddress" id="txtAddress" placeholder="Dirección">
                <p class="help-block text-danger" id="reqtxtAddress"></p>
              </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6">
              <div class="form-group">
                <label for="txtIMSS">IMSS</label>
                <input class="form-control" type="text" name="txtIMSS" id="txtIMSS" placeholder="Número de seguro social">
              </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6">
              <div class="form-group">
                <label for="txtRFCi">RFC</label>
                <input class="form-control" type="text" name="txtRFCi" id="txtRFCi" placeholder="Registro federal de contribuyentes">
              </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6">
              <div class="form-group">
                <label for="txtCURP">CURP</label>
                <input type="text" class="form-control" id="txtCURP" name="txtCURP" placeholder="Clave Unica de Registro Poblacional">
                <p class="help-block text-danger" id="reqTxtCURP"></p>
              </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6">
              <div class="form-group">
                <label for="admissionDate">Fecha de admisión</label>
                <input type="text" class="form-control" class="admissionDate" name="admissionDate" id="admissionDate" placeholder="Fecha de admisión">
                <p class="help-block text-danger" id="reqAdmissionDate"></p>
              </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6">
              <div class="form-group">
                <label for="txtCivilSts">Estado Civil</label>
                <select class="custom-select form-control" name="txtCivilSts" id="txtCivilSts">
                  <option value="2">Casado</option>
                  <option value="1">Soltero</option>
                </select>
                <p class="help-block text-danger"id="reqTxtCivilSts"></p>
              </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6">
              <div class="form-group">
                <label for="txtGender">Género</label>
                <select class="custom-select form-control" name="txtGender" id="txtGender">
                  <option value="1">Masculino</option>
                  <option value="2">Femenino</option>
                </select>
                <p class="help-block text-danger" id="reqTxtGender"></p>
              </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6">
              <div class="form-group">
                <label for="txtCategory">Categoría</label>
                <select class="custom-select form-control" name="txtCategory" id="txtCategory">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                  <option value="10">10</option>
                </select>
                <p class="help-block text-danger" id="reqTxtCategory"></p>
              </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6">
              <div class="form-group">
                <label for="txtDepartment">Depto</label>
                <select class="custom-select form-control" name="txtDepartment" id="txtDepartment">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                  <option value="10">10</option>
                </select>
                <p class="help-block text-danger" id="reqTxtDepartment"></p>
              </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6">
              <div class="form-group">
                <label for="txtArea">Area</label>
                <select class="custom-select form-control" name="txtArea" id="txtArea">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                  <option value="10">10</option>
                </select>
                <p class="help-block text-danger" id="reqTxtArea"></p>
              </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6">
              <div class="form-group">
                <label for="txtType">Tipo</label>
                <select class="custom-select form-control" name="txtType" id="txtType">
                  <option value="1">Obra</option>
                  <option value="2">Administrativo</option>
                </select>
                <input type="hidden" name="id_employee" id="id_employee" value="">
              </div>
            </div>

            <div class="form-group col-lg-6 col-md-4 col-sm-12 mt-2em">
              <div class="col-sm-12 col-lg-6 col-md-6">
                <button class="btn btn-primary btn-block" type="button" id="btnAddEmployee" name="btnAddEmployee">Agregar</button>
                &nbsp;
              </div>
              <div class="col-sm-12 col-lg-6 col-md-6">
                <button class="btn btn-secondary btn-block" type="button" id="btnCancelEmployee" name="btnCancelEmployee">Cancelar</button>
              </div>
            </div>

            <div id="respServer">
            </div>
            <input type="hidden" name="opcion" id="opcion" value="7">
            <div class="form-group">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="col-lg-12 col-md-12 col-sm-12">
    <div class="box box-default">
      <div class="box-header with-border">
        <h3 class="box-title">Listado</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>
      <div class="box-body">
        <div class="table table-responsive"id="cntnListEmployees">

        </div>
      </div>
    </div>
  </div>
</section>

<script type="text/javascript">
    window.onload = function() {
      activaDatePicker("admissionDate");
      employees_list();
    }
</script>
