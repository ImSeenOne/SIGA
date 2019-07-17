<?Php
  require_once("../php/inicializandoDatosExterno2.php");
  $latitud = '16.7473613';
  $longitud = '-93.1203101';
  $id = (isset($_POST["id"])) ? $_POST["id"] : 0;
  if($id > 0){
    $datos = @$conexionB->fetch_array($querysB->getPropiedadades($id));
  }
  else $datos = array();
?>
<section class="content-header">
    <h1>
        Clientes
        <small>Inmobiliaria</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-home"></i> Inicio</a></li>
        <li><a href="propiedades"><i class="fa fa-building"></i> Inmuebles</a></li>
        <li class="active">Registrar/Editar Inmuebles</li>
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
              <h3 class="box-title">Captura - Edición de Inmuebles</h3>
              <button id="open-popup" class="btn btn-info pull-right">Geolocalización</button>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

                <div class="box-body">
                  <form class="form-vertical" id="frmPropiedades">
                    <div class="form-group col-md-2">
                      <label for="txtFolio" class="control-label">Folio</label>
                      <input type="text" class="form-control" id="txtFolio" name="txtFolio" value="<?= ($id>0) ? $datos['folio']:'V'; ?>" readonly/>
                    </div>
                    <div class="form-group col-md-3">
                      <label for="txtClaveU" class="control-label">Clave Unica de Vivienda</label>
                      <input type="text" class="form-control" id="txtClaveU" name="txtClaveU" value="<?= ($id>0) ? $datos["clave_unica"]:''; ?>"/>                      
                    </div>
                    <div class="form-group col-md-2">
                        <label for="txtTipo" class="control-label">Tipo</label>
                        <select id="txtTipo" name="txtTipo" class="form-control" style="width: 100%;" onchange="javascript: parent.fnCambiaTipo('txtTipo');">
                          <?Php
                            if($id>0) {
                              if($datos["id_tipo"] == 1){
                          ?>
                                <option value="0">Seleccionar</option>
                                <option value="1" selected>Venta</option>
                                <option value ="2">Renta</option>
                          <?php }
                            else {
                          ?>
                            <option value="0">Seleccionar</option>
                            <option value="1">Venta</option>
                            <option value ="2" selected>Renta</option>
                          <?php }
                            }
                            else {
                          ?>
                              <option value="0" selected>Seleccionar</option>
                              <option value="1">Venta</option>
                              <option value ="2">Renta</option>
                          <?php } ?>
                            </select>                        
                    </div>
                    <div class="form-group col-md-3">
                        <label for="txtDesarrollo" class="control-label">Desarrollo</label>
                        <select id="txtDesarrollo" name="txtDesarrollo" class="form-control select2" onchange="javascript:parent.fnCambiaCodigoP('txtDesarrollo');">
                            <?php
                              $combo = @$conexionB->obtenerlista($querysB->getListCombo("tblc_desarrollo","id_desarrollo,
                              nombre,CONCAT_WS(';',alias,codigo_postal)"));
                              $id_desarrollo = ($id>0)?$datos['desarrollo']:0;
                              echo $funcionesB->llenarcombo($combo,$id_desarrollo);
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="txtCodigoP" class="control-label">Código Postal</label>
                        <input type="text" class="form-control" id="txtCodigoP" name="txtCodigoP" placeholder="Códigp Postal" readonly>
                    </div>
                    <div style="clear: both;"></div>

                    <div class="form-group col-md-8">
                        <label for="txtDescripcion" class="control-label">Descripción</label>
                        <textarea id="txtDescripcion" name="txtDescripcion" class="form-control"><?= ($id>0)?$datos["descripcion"]:''; ?></textarea>                        
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label for="txtAlias" class="control-label">Alias</label>
                        <input type="text" id="txtAlias" name="txtAlias" class="form-control" value="<?= ($id>0)?$datos['alias']:'';?>"/>
                    </div>

                    <div style="clear: both;"></div>

                    <div class="form-group col-md-6">
                        <label for="txtDireccion" class="control-label">Dirección</label>
                        <input type="text" class="form-control" id="txtDireccion" name="txtDireccion" placeholder="Dirección" value="<?= ($id>0)? $datos["direccion"]:''; ?>">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="txtNExterior" class="control-label">No. Exterior</label>
                        <input type="text" id="txtNExterior" name="txtNExterior" class="form-control" value="<?= ($id>0)? $datos["numero_exterior"]:''; ?>"/>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="txtNEdificio" class="control-label">No. Edificio.</label>
                        <input type="text" id="txtNEdificio" name="txtNEdificio" class="form-control" value="<?= ($id>0)? $datos["numero_edificio"]:''; ?>"/>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="txtNDepartamento" class="control-label">No. Depto.</label>
                        <input type="text" id="txtNDepartamento" name="txtNDepartamento" class="form-control" value="<?= ($id>0)? $datos["numero_departamento"]:''; ?>"/>
                    </div>

                    <div style="clear: both;"></div>

                    <div class="form-group col-md-3">
                        <label for="txtEstatus" class="control-label">Estatus</label>
                        <select id="txtEstatus" name="txtEstatus" class="form-control">
                          <?php
                            $combo = $conexionB->obtenerlista($querysB->getListCombo("tblc_estatus_propiedades","id_estatus,
                            nombre,CONCAT_WS(';',id_estatus)"));
                            $id_estatus = ($id>0)?$datos['estatus']:0;
                            echo $funcionesB->llenarcombo($combo,$id_estatus);
                          ?>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="txtPropietario" class="control-label">Propietario</label>
                        <select id="txtPropietario" name="txtPropietario" class="form-control">
                          <?php
                            $combo = $conexionB->obtenerlista($querysB->getListCombo("tblc_propiedades_propietarios","id_propietario,
                            nombre,CONCAT_WS(';',id_propietario)"));
                            $id_propietario = ($id>0)?$datos['propietario']:0;
                            echo $funcionesB->llenarcombo($combo,$id_propietario);
                          ?>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="txtMetros2" class="control-label">Metros Cuadrados</label>
                        <input type="number" step="any" min="0" class="form-control" id="txtMetros2" name="txtMetros2" placeholder="Metros cuadrados" value="<?= ($id>0)? $datos["metros_cuadrados"]:''; ?>"/>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="txtRecamaras" class="col-sm-4 control-label">Recamaras</label>
                        <input type="number" step="any" min="0" class="form-control" id="txtRecamaras" name="txtRecamaras" placeholder="Recamaras" value="<?= ($id>0)? $datos["recamaras"]:''; ?>"/>
                    </div>

                    <div style="clear: both;"></div>

                    <div class="form-group col-md-3">
                        <label for="txtNoBanos" class="control-label">No. Baños</label>
                        <select id="txtNoBanos" name="txtNoBanos" class="form-control">
                          <?php
                            $combo = $conexionB->obtenerlista($querysB->getListCombo("tblc_num_banios","id_num_banio,
                            nombre,CONCAT_WS(';',id_num_banio)"));
                            $id_num_banios = ($id>0)?$datos['numero_banos']:0;
                            echo $funcionesB->llenarcombo($combo,$id_num_banios);
                          ?>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="txtAcbado" class="control-label">Calidad Acabado</label>
                        <select id="txtAcbado" name="txtAcbado" class="form-control">
                          <?php
                            $combo = $conexionB->obtenerlista($querysB->getListCombo("tblc_calidad_acabado","id_calidad_acabado,
                            nombre,CONCAT_WS(';',id_calidad_acabado)"));
                            $id_calidad_acabado = ($id>0)?$datos['calidad_acabado']:0;
                            echo $funcionesB->llenarcombo($combo,$id_calidad_acabado);
                          ?>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="txtEstacionamiento" class="control-label">Lugares Estacionamiento</label>
                        <select id="txtEstacionamiento" name="txtEstacionamiento" class="form-control">
                          <?php
                            $combo = $conexionB->obtenerlista($querysB->getListCombo("tblc_estacionamiento","id_estacionamiento,
                            nombre,CONCAT_WS(';',id_estacionamiento)"));
                            $id_estacionamiento = ($id>0)?$datos['lugares_estacionamiento']:0;
                            echo $funcionesB->llenarcombo($combo,$id_estacionamiento);
                          ?>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="txtAntiguedad" class="control-label">Antiguedad</label>
                        <select id="txtAntiguedad" name="txtAntiguedad" class="form-control">
                          <?php
                            $combo = $conexionB->obtenerlista($querysB->getListCombo("tblc_antiguedad","id_antiguedad,
                            nombre,CONCAT_WS(';',id_antiguedad)"));
                            $id_antiguedad = ($id>0)?$datos['antiguedad']:0;
                            echo $funcionesB->llenarcombo($combo,$id_antiguedad);
                          ?>
                        </select>
                    </div>

                    <div style="clear: both;"></div>

                    <div class="form-group col-md-3">
                        <label for="txtCloset" class="control-label">Espacio para Guardar</label>
                        <select id="txtCloset" name="txtCloset" class="form-control">
                          <?php
                            $combo = $conexionB->obtenerlista($querysB->getListCombo("tblc_closet","id_closet,
                            nombre,CONCAT_WS(';',id_closet)"));
                            $id_closet = ($id>0)?$datos['closet']:0;
                            echo $funcionesB->llenarcombo($combo,$id_closet);
                          ?>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="txtCocina" class="control-label">Cocina</label>
                        <select id="txtCocina" name="txtCocina" class="form-control">
                          <?php
                            $combo = $conexionB->obtenerlista($querysB->getListCombo("tblc_cocina","id_cocina,
                            nombre,CONCAT_WS(';',id_cocina)"));
                            $id_cocina = ($id>0)?$datos['cocina']:0;
                            echo $funcionesB->llenarcombo($combo,$id_cocina);
                          ?>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="txtCocina" class="control-label">Servicios y Amenidades</label>
                        <select id="txtServicios" name="txtServicios[]" multiple="multiple" class="form-control select2">
                          <?php
                            $combo = $conexionB->obtenerlista($querysB->getListCombo("tblc_servicio_amenidad","id_servicio_amenidad,
                            nombre,CONCAT_WS(';',id_servicio_amenidad)"));
                            $id_servicio_amenidad = ($id>0)?$datos['servicios_amenidades']:0;
                            echo $funcionesB->llenarcomboM($combo,$id_servicio_amenidad);
                          ?>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="txtMonto" class="control-label">Precio</label>
                        <div class="input-group">
                          <span class="input-group-addon">$</span>
                          <input type="text" id="txtMonto" name="txtMonto" class="form-control" value="<?= ($id>0) ? $datos["monto"] : '';?>">
                        </div>
                    </div>

                    <div style="clear: both;"></div>

                    <div class="form-group col-md-3">
                        <label for="txtOtros1" class="control-label">Otros</label>
                        <input type="text" name="txtOtros1" id="txtOtros1" class="form-control" value="<?= ($id>0)? $datos["otros1"]:''; ?>"/>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="txtOtros2" class="control-label">&nbsp;&nbsp;</label>
                        <input type="text" name="txtOtros2" id="txtOtros2" class="form-control" value="<?= ($id>0)? $datos["otros2"]:''; ?>"/>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtObservaciones" class="control-label">Observaciones</label>
                        <textarea name="txtObservaciones" id="txtObservaciones" rows="3" class="form-control"><?= ($id>0)? $datos["observaciones"]:''; ?></textarea>
                    </div>

                    <div style="clear: both;"></div>

                    <div class="box box-success">
                        <div class="box-body">
                            <div class="form-group ">
                                <label>
                                    <input type="checkbox" name="txtLavado" id="txtLavado" class="minimal" <?= ($id>0)?($datos["area_lavado"]=1)?'checked':'':''?>/>
                                    Área de lavado.
                                </label>
                                <label>
                                    <input type="checkbox" name="txtDiscapacitado" id="txtDiscapacitado" class="minimal" <?= ($id>0)?($datos["acceso_discapacitado"]=1)?'checked':'':''?>/>
                                    Acceso a Discapacitados.
                                </label>
                                <label>
                                    <input type="checkbox" name="txtEcotecnologia" id="txtEcotecnologia" class="minimal" <?= ($id>0)?($datos["ecotecnologia"]=1)?'checked':'':''?>/>
                                    Ecotecnologia.
                                </label>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="latitud" name="latitud" value="<?=$latitud;?>"/>
                    <input type="hidden" id="longitud" name="longitud" value="<?=$longitud;?>"/>
                    <input type="hidden" id="id" name="id" value="<?=$id;?>"/>
                    <input type="hidden" id="idFecha" name="idFecha" value="0"/>
                    <input type="hidden" id="tipo_coordenada" name="tipo_coordenada" value="<?= ($id>0)? $datos["tipo_coordenada"]:0; ?>"/>
                    <input type="hidden" id="coordenadas" name="coordenadas" value="<?= ($id>0)? $datos["coordenadas"]:''; ?>"/>
                    <input type="hidden" id="opcion" name="opcion" value="6"/>
                    <div class="col-md-12 mfp-hide" id="geolocalizacion">
                        <div class="form-group">
                            <label class="form-label" for="map_canvas">Localización</label>
                            <br>
                            <div id="color-palette" style="display:none;"></div>
                            <a class="btn btn-success btn-sm pull-right" href="javascript:$.magnificPopup.close();">Cerrar</a>
                            <a class="btn btn-danger btn-sm" id="delete-button">Eliminar Polígono</a>
                            <div id="pac-input"></div>
                            <div id="cursel" style="display:none !important;"></div>
                            <div style="width: 100%; height: 70vh; " id="map_canvas"></div>
                        </div>
                    </div>
                </form>
            </div>
              <!-- /.box-body -->
              <div class="box-footer">
                  <div id="respServer"></div>
                  <button type="button" onclick="javascript:location.href = 'propiedades'" class="btn btn-default">Cancelar</button>
                  <?php
                    if($id == 0){
                  ?>
                    <button type="button" form="frmPropiedades" id="btnGuardarPropiedad" class="btn btn-info pull-right">Guardar</button>
                  <?php
                    }
                    else {
                  ?>
                    <button type="button" form="frmPropiedades" id="btnGuardarPropiedad" class="btn btn-info pull-right">Modificar</button>
                    <button type="button" form="frmPropiedades" onclick="javascript:propiedades_documentos(<?= $id ?>)" class="btn btn-primary pull-right">Documentos</button>
                    <button type="button" form="frmPropiedades" onclick="javascript:propiedades_imagenes(<?= $id ?>)" class="btn btn-primary pull-right">Imagenes</button>
                    <?php
                      }
                    ?>
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