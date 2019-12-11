<style type="text/css">
  .v-align{vertical-align:middle!important;}
  .mg-1em{margin-top:-1em!important;display:block;}
  .pt_2em{padding-top:2em!important;}
  .cusor{cursor:pointer;}
  cite{color:#0000FF;}
</style>
<?php
  if(file_exists('../php/inicializandoDatosExterno2.php'))  require '../php/inicializandoDatosExterno2.php';
  else require 'php/inicializandoDatosExterno2.php';
  $folio        = (isset($_POST["txtFolio"]))? $_POST["txtFolio"] :'';
  $alias        = (isset($_POST["txtAlias"]))? $_POST["txtAlias"] :'';
  $direccion    = (isset($_POST["txtDireccion"]))? $_POST["txtDireccion"]:'';
  $cliente      = (isset($_POST["txtCliente"]))? $_POST["txtCliente"]:'';
  $estatus      = (isset($_POST["txtEstatus"]))? $_POST["txtEstatus"]:0;
  $idarea       = (isset($dUsuario["id_area"]))? $dUsuario["id_area"]:0;
  //echo $querysB->ListPropiedades($folio,$alias,$direccion,$cliente,$estatus,$idarea);
  $propiedades = @$conexionB->obtenerlista($querysB->ListPropiedades($folio,$alias,$direccion,$cliente,$estatus,$idarea));
  $totRegs = $conexionB->numregistros();
?>
<!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Listado de Inmuebles</h3>
                <div class="box-tools pull-right">
                    <a type="button" href="javascript: parent.propiedades_registro(0);" class="btn btn-inline btn-sm btn-primary" title="Editar">
                          <i class="fa fa-building"> + Registrar Inmueble</i>
                    </a>
                    <a type="button" href="#" id="verGaleria" class="btn btn-inline btn-sm btn-primary" title="ver galeria">
                          <i class="fa fa-camera-retro"> Ver Galeria</i>
                    </a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <?php
                if($totRegs > 0){
              ?>
              <table id="listClientes" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Folio</th>
                  <th>Imagen</th>
                  <th>Estatus</th>
                  <th>Ubicación</th>
                  <th>Precio</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                  <?Php
                    $items = array();
                    $contador = 0;
                    foreach($propiedades as $list){
                      $titulo = "<a href='javascript:$.magnificPopup.close();";
                      $titulo .= "propiedades_registro(" . $list->id_propiedad.")'>".$list->alias."</a>";
                      $items[$contador]["src"] = $list->imagen;
                      $items[$contador]["title"] =$titulo;
                      $contador += 1;
                  ?>
                <tr>
                  <td><?= $list->folio;?></td>
                  <td><img src="<?= $list->imagen;?>" width="64px"/></td>
                  <td><?= $list->estatusR;?></td>
                  <td class="text-left v-align pt_2em">
                    <p class="mg-1em"><label>DESARROLLO:</label> <strong><cite><?= $list->txtDesarrollo ?></cite></strong></p>
                    <p class="mg-1em"><label>EDIFICIO:</label> <strong><cite><?= $list->numero_edificio ?></cite></strong></p>
                    <p class="mg-1em"><label>NIVEL:</label> <strong><cite><?= $list->txtNivel ?></cite></strong></p>
                    <p class="mg-1em"><label>DEPARTAMENTO:</label> <cite><?= $list->numero_departamento ?></cite></p>
                  </td>
                  <td class="monto"><?= $list->monto;?></td>
                  <td style="width:14%">
                      <div class="margin">
                        <div class="btn-group">
                          <button type="button" class="btn btn-warning btn-flat btn-sm dropdown-toggle" data-toggle="dropdown"><li class="fa fa-gears"/></button>
                          <!--<button type="button" class="btn btn-warning btn-flat btn-sm dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>-->
                          <ul class="dropdown-menu" role="menu">
                            <li><a href="javascript:propiedades_imagenes(<?= $list->id_propiedad ?>)"><li class="fa fa-file-text"/>&nbsp;Imágenes</a></li>
                            <li><a href="javascript:propiedades_documentos(<?= $list->id_propiedad ?>)"><li class="fa fa-file-text"/>&nbsp;Documentos</a></li>
                            <li><a href="javascript:openPDF(<?= $list->id_propiedad ?>)"><li class="fa fa-file-text"/>&nbsp;Imprimir reporte</a></li>
                          </ul>
                          <?php
                            if($dUsuario['editar'] == 1){
                          ?>
                          <button type="button" onclick="javascript: parent.propiedades_registro(<?= $list->id_propiedad ?>);" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-edit"></i></button>
                          <?php
                            }
                            if($dUsuario['eliminar'] == 1){
                          ?>
                          <button type="button" onclick="javascript: parent.btnEliminarPropiedad(<?= $list->id_propiedad ?>);" class="btn btn-inline btn-sm btn-danger"><i class="fa fa-remove"></i></button>
                          <?php
                            }
                          ?>
                        </div>
                      </div>
                </td>
                </tr>
              <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Folio</th>
                  <th>Imagen</th>
                  <th>Estatus</th>
                  <th>Ubicación</th>
                  <th>Precio</th>
                  <th>Acciones</th>
                </tr>
                </tfoot>
              </table>
              <script>
                parent.GalleryI('verGaleria',1,<?= json_encode($items);?>);
              </script>
              <?php
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
