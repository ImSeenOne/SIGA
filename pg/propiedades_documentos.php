<?Php
  if(file_exists("php/inicializandoDatosExterno2.php")) require("php/inicializandoDatosExterno2.php");
  else require("../php/inicializandoDatosExterno2.php");
  $id = (isset($_POST["id_propiedad"]))?$_POST["id_propiedad"]:0;
  $id = $funcionesB->limpia($id);
  $imagenesP =  @$conexionB->obtenerlista($querysB->getListDocumentosPropiedades($id));
  $totRegs = $conexionB->numregistros();
?>
<section class="content-header">
    <h1>
        Documentos
        <small>Inmobiliaria</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-home"></i> Inicio</a></li>
        <li><a href="propiedades"><i class="fa fa-building"></i> Inmuebles</a></li>
        <li><a href="javascript: parent.propiedades_registro(<?= $id; ?>);"><i class="fa fa-building"></i> Editar Propiedad</a></li>
        <li class="active"><i class="fa fa-file-video-o"></i> Documentos</li>
    </ol>
</section>
<div class="box box-warning collapsed-box" id="divAgregaDocumento">
    <div class="box-header with-border cerrarAgregaDocumento">
        <h3 class="box-title"></h3>

        <div class="box-tools pull-right">
            <button type="button" id="btnCollapseDoc" class="btn btn-flat btn-sm cerrarAgregaDocumento btn-primary" ><i class="fa fa-plus"/>
              Agregar Documento
            </button>
        </div>
        <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <form id="form_AgregaD">
            <div class="row">
                <div class="col-lg-3">
                    <fieldset class="form-group">
                        <label for="txtTipoDocumento" class="form-label semibold">Tipo Documento</label>
                        <select class="form-control" id="txtTipoDocumento" name="txtTipoDocumento">
                          <option value="1">Avalúo Comercial</option>
                          <option value="2">Avalúo Catastral</option>
                          <option value="3">Certificado de liberación de Gravamen</option>
                          <option value="4">Otro</option>
                        </select>
                    </fieldset>
                </div>
                <div class="col-lg-6">
                    <fieldset class="form-group">
                        <label for="txtOtro" class="form-label semibold">Especifique</label>
                        <input type="text" id="txtOtro" name="txtOtro" class="form-control" disabled/>
                    </fieldset>
                </div>
                <div class="col-lg-3">
                    <fieldset class="form-group">
                        <label for="txtEstatus" class="form-label semibold">Estatus</label>
                        <select id="txtEstatus" class="form-control" name="txtEstatus">
                          <option value="1">Solicitado</option>
                          <option value="2">Entregado</option>
                          <option value="3">No Aplica</option>
                        </select>
                    </fieldset>
                </div>
                <div class="col-lg-3">
                    <fieldset class="form-group">
                        <label for="txtMonto" class="form-label semibold">Monto</label>
                        <input type="text" id="txtMonto" name="txtMonto" class="form-control classNum"/>
                    </fieldset>
                </div>
                <div class="col-lg-3">
                    <fieldset class="form-group">
                        <label for="txtVigencia" class="form-label semibold">Vigencia</label>
                        <input type="text" id="txtVigencia" name="txtVigencia" class="form-control"/>
                    </fieldset>
                </div>
                <div class="col-lg-2">
                    <fieldset class="form-group">
                        <label for="txtTipoArchivo" class="form-label semibold">Tipo de archivo</label>
                        <select id="txtTipoArchivo" name="txtTipoArchivo" class="form-control">
                          <option value="1">Imágen</option>
                          <option value="2">Documento</option>
                          <option value="3">No Aplica</option>
                        </select>
                    </fieldset>
                </div>
                <div class="col-lg-4">
                    <fieldset class="form-group">
                        <label for="flArchivo" class="form-label semibold">Archivo</label>
                        <input type="file" class="form-control" id="flArchivo" name="flArchivo" placeholder="Seleccione una archivo"/>
                        <input type="hidden" id="txtArchivo" name="txtArchivo"/>
                    </fieldset>
                </div>
                <div class="col-lg-12">
                    <fieldset class="form-group">
                        <label for="txtObservaciones" class="form-label semibold">Observaciones</label>
                        <textarea id="txtObservaciones" name="txtObservaciones" class="form-control"></textarea>
                    </fieldset>
                </div>
            </div><!--.row-->
            <div class="text-left">
                <input type="hidden" id="opcion" name="opcion" value="8"/>
                <input type="hidden" id="idFecha" name="idFecha" value="0"/>
                <input type="hidden" id="id_propiedad" name="id_propiedad" value="<?=$id;?>"/>
                <input type="hidden" id="id_documento" name="id_documento" value="0"/>
                <input type="button" class="btn btn-success btn-sm" value=" Guardar " id="btnGuardaDocumento" />
                <input type="button" class="btn btn-danger btn-sm cerrarAgregaImagen" value=" Cancelar " onclick="location.href='propiedades'"/>
            </div>
         </form>
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->
<div class="row">
    <div class="col-xl-12">
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Listado de Documentos del Inmueble</h3>
                <div id="mensajeServer"></div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <?php
                  if($totRegs > 0){
                ?>
                <table id="listImagenes" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Tipo Documento</th>
                    <th>Estatus</th>
                    <th>Monto</th>
                    <th>Vigencia</th>
                    <th>Archivo</th>
                    <th>Acciones</th>
                  </tr>
                  </thead>
                  <tbody id="bodyDocumentos">
                    <?Php
                      foreach($imagenesP as $list){
                    ?>
                  <tr>
                    <td><?= $list->txtTipo;?></td>
                    <td><?= $list->estatus;?></td>
                    <td class="classNum"><?= $list->monto;?></td>
                    <td ><?= $list->fVigencia;?></td>
                    <?Php
                        if($list->tipo_archivo != 3){
                    ?>
                      <td><a href="<?= $list->archivo?>" target="_blank">ver archivo</a></td>
                    <?Php
                        }
                        else{
                    ?>
                      <td></td>
                    <?Php
                        }
                    ?>
                    <td>
                        <div class="margin">
                            <a type="button" href='javascript: parent.btnEditarPropiedadDocumemnto(<?= json_encode($list); ?>,0);' class="btn btn-inline btn-sm btn-primary" title="Editar">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a type="button" href='javascript: parent.btnEditarPropiedadDocumemnto(<?= json_encode($list); ?>,1)' class="btn btn-inline btn-sm btn-danger" title="eliminar">
                                <i class="fa fa-remove"></i>
                            </a>
                        </div>
                  </td>
                  </tr>
                <?php } ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Tipo Documento</th>
                    <th>Estatus</th>
                    <th>Monto</th>
                    <th>Vigencia</th>
                    <th>Archivo</th>
                    <th>Acciones</th>
                  </tr>
                  </tfoot>
                </table>
                <?Php
                  }
                  else {
                ?>
                <center><h4>¡No existen registros!</h4></center>
                <?php
                  }
                ?>
              </div>
              <!-- /.box-body -->
            </div>
          </div>
          </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->
    </div><!--.col-->
</div><!--.row-->
