<?Php
  if(file_exists("php/inicializandoDatosExterno2.php")) require("php/inicializandoDatosExterno2.php");
  else require("../php/inicializandoDatosExterno2.php");
  $id = (isset($_POST["id_propiedad"]))?$_POST["id_propiedad"]:0;
  $id = $funcionesB->limpia($id);
  $imagenesP =  @$conexionB->obtenerlista($querysB->getListImagenPropiedades($id));
  $totRegs = $conexionB->numregistros();
?>
<section class="content-header">
    <h1>
        Imagenes
        <small>Inmobiliaria</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-home"></i> Inicio</a></li>
        <li><a href="propiedades"><i class="fa fa-building"></i> Propiedades</a></li>
        <li><a href="javascript: parent.propiedades_registro(<?= $id; ?>);"><i class="fa fa-building"></i> Editar Propiedad</a></li>
        <li class="active"><i class="fa fa-file-video-o"></i>Imagenes</li>
    </ol>
</section>
<div class="box box-warning collapsed-box" id="divAgregaImagen">
    <div class="box-header with-border cerrarAgregaImagen">
        <h3 class="box-title"></h3>

        <div class="box-tools pull-right">
            <button type="button" id="btnCollapseImg" class="btn btn-flat btn-sm cerrarAgregaImagen btn-primary" ><i class="fa fa-plus"/>
              Agregar una Imágen
            </button>
        </div>
        <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <form id="form_AgregaI">
            <div class="row">
                <div class="col-lg-6">
                    <fieldset class="form-group">
                        <label for="flImagen" class="form-label semibold">Imagen</label>
                        <input type="file" class="form-control" id="flImagen" name="flImagen" placeholder="Seleccione una imagen"/>
                        <input type="hidden" id="txtImagen" name="txtImagen"/>
                    </fieldset>
                </div>
                <div class="col-lg-6">
                    <fieldset class="form-group">
                        <label for="txtTipo" class="form-label semibold">Tipo imágen</label>
                        <select id="txtTipo" name="txtTipo" class="form-control">
                          <option value="0">Normal</option>
                          <option value="1">Principal</option>
                        </select>
                    </fieldset>
                </div>
                <div class="col-lg-12">
                    <fieldset class="form-group">
                        <label for="txtDescripcion" class="form-label semibold">Descripción</label>
                        <textarea id="txtDescripcion" class="form-control" name="txtDescripcion"></textarea>
                    </fieldset>
                </div>
            </div><!--.row-->
            <div class="text-left">
                <input type="hidden" id="opcion" name="opcion" value="7"/>
                <input type="hidden" id="idFecha" name="idFecha" value="0"/>
                <input type="hidden" id="id_propiedad" name="id_propiedad" value="<?=$id;?>"/>
                <input type="hidden" id="id_imagen" name="id_imagen" value="0"/>
                <input type="button" class="btn btn-success btn-sm" value=" Guardar " onclick="javascript: parent.funAgregaImagenP(<?= $id; ?>);" />
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
                <h3 class="box-title">Listado de Imagenes del Inmueble</h3>
                <div id="mensajeServer"></div>
                <div class="box-tools pull-right">
                    <button type="button" id="verGaleria" class="btn btn-flat btn-sm btn-primary" ><i class="fa fa-camera-retro"/>
                      Ver Galeria
                    </button>
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <?php
                  if($totRegs > 0){
                ?>
                <table id="listImagenes" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Imagen</th>
                    <th>Descripción</th>
                    <th>Tipo</th>
                    <th>Acciones</th>
                  </tr>
                  </thead>
                  <tbody id="bodyImagen">
                    <?Php
                      $items = array();
                      $contador = 0;
                      foreach($imagenesP as $list){
                        $items[$contador]["src"] = $list->imagen;
                        $items[$contador]["title"] = $list->descripcion;
                        $contador += 1;
                    ?>
                  <tr>
                    <td><img src="<?= $list->imagen;?>" width="64px"/></td>
                    <td><?= $list->descripcion;?></td>
                    <td><?= $list->txtTipo;?></td>
                    <td>
                        <div class="margin">
                            <a type="button" href='javascript: parent.btnEditarPropiedadImagen(<?= json_encode($list); ?>,0);' class="btn btn-inline btn-sm btn-primary" title="Editar">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a type="button" href='javascript: parent.btnEditarPropiedadImagen(<?= json_encode($list); ?>,1)' class="btn btn-inline btn-sm btn-danger" title="eliminar">
                                <i class="fa fa-remove"></i>
                            </a>
                        </div>
                  </td>
                  </tr>
                <?php } ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Imagen</th>
                    <th>Descripción</th>
                    <th>Tipo</th>
                    <th>Acciones</th>
                  </tr>
                  </tfoot>
                </table>
                <script>
                  parent.GalleryI('verGaleria',1,<?= json_encode($items);?>);
                </script>
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
