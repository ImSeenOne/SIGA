<?Php
    @session_start();
    
    $dUsuario = (isset($_SESSION["dUsuario"]))?$_SESSION["dUsuario"]:array();
    $arraySexo = array();
    array_push($arraySexo,(object)["id"=>"-1","valor"=>"Seleccionar","dataId"=>"0;0"]);
    array_push($arraySexo,(object)["id"=>"1","valor"=>"Masculino","dataId"=>"1;Masculino"]);
    array_push($arraySexo,(object)["id"=>"2","valor"=>"Femenino","dataId"=>"2;Femenino"]);
?>
<section class="content-header">
    <h1>
        Usuarios
        <small>SIGA</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-home"></i> Inicio</a></li>
    </ol>
</section>

<!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- right column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Editar Datos Usuario</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

                <div class="box-body">
                  <form class="form-vertical" id="frmUsuarios">
                    <div class="form-group col-md-4">
                        <img src="<?= $dUsuario["foto"];?>" width="50%"/>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="txtSexo" class="control-label">Sexo</label>
                        <select id="txtSexo" name="txtSexo" class="form-control select2" onchange="javascript:parent.fnCambiaCodigoP('txtDesarrollo');">
                            <?php
                              $id_sexo = $dUsuario["sexo"];
                              echo $funcionesB->llenarcombo($arraySexo,$id_sexo);
                            ?>
                        </select>
                    </div>
                    <div style="clear: both;"></div>
                    <div class="form-group col-md-4">
                      <label for="txtNombre" class="control-label">Nombre</label>
                      <input type="text" class="form-control" id="txtNombre" name="txtNombre" value="<?= $dUsuario["nombre"]?>"/>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="txtApellidoP" class="control-label">Apellido Paterno</label>
                      <input type="text" class="form-control" id="txtApellidoP" name="txtApellidoP" value="<?=$dUsuario["apellido_p"]?>"/>                      
                    </div>
                    <div class="form-group col-md-4">
                        <label for="txtApellidoM" class="control-label">Apellido Materno</label>
                        <input type="text" class="form-control" id="txtApellidoM" name="txtApellidoM" value="<?=$dUsuario["apellido_m"]?>"/>                          
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="txtDireccion" class="control-label">Dirección</label>
                        <input type="text" class="form-control" id="txtDireccion" name="txtDireccion" value="<?=$dUsuario["direccion"]?>"/>                          
                    </div>
                      
                    <div class="form-group col-md-3">
                        <label for="txtEmail" class="control-label">Correo</label>
                        <input type="text" class="form-control" id="txtEmail" name="txtEmail" value="<?=$dUsuario["correo"]?>"/>                          
                    </div>
                    
                    <div class="form-group col-md-3">
                        <label for="txtTelefono" class="control-label">Telefono</label>
                        <input type="text" class="form-control" id="txtTelefono" name="txtTelefono" value="<?=$dUsuario["telefono"]?>"/>                          
                    </div>
                    
                      
                    <div class="form-group col-md-3">
                        <label for="txtEmail" class="control-label">Departamento</label>
                        <select id="txtDepartamento" name="txtDepartamento" class="form-control select2" onchange="javascript:parent.fnCambiaCodigoP('txtDesarrollo');">
                            <?php
                              $combo = @$conexion->obtenerlista($querys->getListCombo("tblc_departamentos","id_departamento,
                              nombre,CONCAT_WS(';',id_departamento,nombre)"));
                              $id_departamento = $dUsuario["id_departamento"];
                              echo $funcionesB->llenarcombo($combo,$id_departamento);
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="txtArea" class="control-label">Área</label>
                        <select id="txtArea" name="txtArea" class="form-control select2">
                            <?php
                              $combo = @$conexion->obtenerlista($querys->getListCombo("tblc_areas","id_area,
                              nombre,CONCAT_WS(';',id_departamento,id_area)"));
                              $id_area = $dUsuario["id_area"];
                              echo $funcionesB->llenarcombo($combo,$id_area);
                            ?>
                        </select>
                    </div>
                      
                    <div class="form-group col-md-3">
                        <label for="txtUsuario" class="control-label">Usuario</label>
                        <input type="text" class="form-control" id="txtUsuario" name="txtUsuario" value="<?=$dUsuario["usuario"]?>"/>
                    </div>
                    
                    <div class="form-group col-md-3">
                        <label for="txtPassword" class="control-label">Password</label>
                        <input type="password" class="form-control" id="txtPassword" name="txtPassword" placeholder="Contraseña" />
                    </div>
                      
                    <div style="clear: both;"></div>

                    
                    <input type="hidden" id="id" name="id" value="<?=$dUsuario["id_usuario"];?>"/>
                    <input type="hidden" id="idFecha" name="idFecha" value="0"/>
                    <input type="hidden" id="opcion" name="opcion" value="10"/>
                </form>
            </div>
              <!-- /.box-body -->
              <div class="box-footer">
                    <div id="respServer"></div>
                    <button type="button" onclick="javascript:location.href = 'inicio'" class="btn btn-default">Cancelar</button>
                    <button type="button" form="frmPropiedades" id="btnGuardarPropiedad" class="btn btn-info pull-right">Modificar</button>
              </div>
              <!-- /.box-footer -->

          </div>
          <!-- /.box -->

        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->    