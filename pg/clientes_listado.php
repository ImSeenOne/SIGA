<style type="text/css">
  .cntnTitlePopOver{font-weight:600;font-style:italic;}
  .cntnPopOver{border-bottom:1px dotted #e8e8e8;font-size:8pt!important;padding:0.5em 0.6em!important;}
  div.cntnPopOver:hover{background-color:#f8f8f8!important;}
  .v-align{vertical-align:middle!important;}
  .mb-0em{margin-bottom:0em!important;}
  .mg-1em{margin-top:-1em!important;display:block;}
  .pt_2em{padding-top:2em!important;}
  .cusor{cursor:pointer;}
  cite{color:#0000FF;}
</style>
<?php
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
  require '../php/inicializandoDatosExterno.php';
  $pagina      = $funciones->limpia($_POST['pagina']);
  $optSelected = $funciones->limpia($_POST['optSelected']);
  $busqueda    = $funciones->limpia($_POST['busqueda']);
  $tipoCte     = $funciones->limpia($_POST['tipoCteBusq']);
  $modalidad   = $funciones->limpia($_POST['modalidadBusq']);

  $aTipo = array(1 => 'Arrendatario', 2 => 'Comprador');
  $aModalidad = array(1 => 'Infonavit', 2 => 'Fovissste', 3 => 'Bancario', 4 => 'Contado', 5 => 'Otra');

  @$conexion->obtenerlista($querys->getClientesData('', $optSelected, $busqueda, $tipoCte, $modalidad));
  $totRegistros = $conexion->numregistros();

  $limite = 5;
  $inicio = ($pagina - 1) * $limite;
  $totalPaginas = ceil($totRegistros / $limite);
  $listado = @$conexion->obtenerlista($querys->getClientesData('', $optSelected, $busqueda, $tipoCte, $modalidad)." LIMIT ".$inicio.','.$limite);

    //------------------------------------
      $pag = new Paginador();
      $pag->setCantidadRegistros($limite);
      $pag->setCantidadEnlaces(7);
      $datos = $pag->paginar($pagina, $totRegistros);
      if(!$datos){
         $currentPage = 1;
      }else{
        foreach ($datos as $key){
          if($key['active']) $currentPage = $key['vista'];
        }
      }

    //------------------------------------

  if($totRegistros > 0){
?>
<table id="listCloset" class="table table-bordered table-striped">
  <thead>
    <tr>
      <th class="text-left" style="width:35%;">&nbsp;</th>
      <th class="text-center" style="width:15%;">Tipo</th>
      <th class="text-center" style="width:10%;">Modalidad</th>
      <th class="text-center" style="width:20%;">Propiedades Asignadas</th>
      <th class="text-center" style="width:20%;">Acciones</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($listado as $key) {
      $cntnEstProp = '';
      $modalidadOtro = (!is_null($key->modalidad_otro))? '<p>('.$key->modalidad_otro.')</p>':'';
      $aEstatusProp  = $conexion->obtenerlista($querys->getEstatusPropIntCte($key->id_cliente));
      $totRegsEst    = $conexion->numregistros();
      $txtPlural     = ($totRegsEst > 1)? 'es':'';

      foreach($aEstatusProp as $keyEst){
        $cntnEstProp = '<div class="cntnPopOver" onclick="propiedades_registro('.$keyEst->id_propiedad.')" >';
          $cntnEstProp.= '<p><b>Desarrollo:</b> <cite>'.$funciones->MayusMin($keyEst->desarrollo).'</cite></p>';
          $cntnEstProp.= '<p class="mg-1em"><b>Edificio:</b> <cite>'.$funciones->MayusMin($keyEst->numero_edificio).'</cite></p>';
          $cntnEstProp.= '<p class="mg-1em"><b>Nivel:</b> <cite>'.$funciones->MayusMin($keyEst->nivel).'</cite></p>';
          $cntnEstProp.= '<p class="mg-1em"><b>Departamento:</b> <cite>'.$funciones->MayusMin($keyEst->numero_departamento).'</cite></p>';
          $cntnEstProp.= '<p class="mg-1em"><b>Dirección:</b> <cite>'.$funciones->MayusMin($keyEst->direccion).'</cite></p>';
          $cntnEstProp.= '<p class="mg-1em mb-0em"><b>Estatus:</b> <cite>'.$funciones->MayusMin($keyEst->estatus_propiedad).'</cite></p>';
        $cntnEstProp.= '</div>';
      }
  ?>
    <tr>
      <td class="text-left v-align pt_2em">
        <p class="mg-1em"><label>RFC:</label> <strong><cite><?= $key->rfc ?></cite></strong></p>
        <p class="mg-1em"><label>CURP:</label> <strong><cite><?= $key->curp ?></cite></strong></p>
        <p class="mg-1em"><label>NOMBRE:</label> <?= $key->nombre.' '.$key->apellido_p.' '.$key->apellido_m ?></p>
        <p class="mg-1em"><label>CORREO:</label> <cite><?= $key->correo ?></cite></p>
        <p class="mg-1em"><label>TELÉFONO:</label> <cite><?= $key->telefono ?></cite></p>
        <p class="mg-1em"><label>FECHA REGISTRO:</label> <cite><?= $funciones->ordenaFechaHora($key->fecha_registro); ?></cite></p>
      </td>
      <td class="text-center v-align"><?= $aTipo[$key->id_tipo]; ?></td>
      <td class="text-center v-align"><?= $aModalidad[$key->id_modalidad].$modalidadOtro; ?></td>
      <td class="text-center v-align">
        <?php if($totRegsEst > 0){ ?>
            <a class="btn btn-info- btn-xs popOver" rel="popover" data-html="true" data-placement="top" title="<span class='cntnTitlePopOver'>Propiedades Asignadas</span>" data-content='<?= $cntnEstProp; ?>'><?= $totRegsEst; ?> Propiedad<?= $txtPlural; ?></a>
        <?php }else{ ?>
          <cite>Sin Propiedades Asignadas</cite>
        <?php } ?>
      </td>
      <td class="text-center v-align">
        <div class="btn-group">
            <button type="button" class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-gear"></i> <span class="caret"></span></button>
              <ul class="dropdown-menu" role="menu">
                <li>
                  <a type="button" class="cusor" title="Archivos Personales" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#modal-archivos-cliente" onclick="cliente_archivos_listado(<?= $key->id_cliente ?>, '<?= $key->nombre.' '.$key->apellido_p.' '.$key->apellido_m ?>');"><i class="fa fa-file-archive-o"></i>Archivos Personales</a>
                </li>
                <li>
                  <a type="button" class="cusor" title="Referencias" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#modal-referencias-cliente" onclick="cliente_referencias_listado(<?= $key->id_cliente ?>, '<?= $key->nombre.' '.$key->apellido_p.' '.$key->apellido_m ?>');"><i class="fa fa-user"></i>Referencias</a>
                </li>
                <li>
                  <a type="button" class="cusor" title="Seguimiento" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#modal-interes-cliente" onclick="cliente_interes_listado(<?= $key->id_cliente ?>, '<?= $key->nombre.' '.$key->apellido_p.' '.$key->apellido_m ?>');"><i class="fa fa-building" ></i>Seguimiento</a>
                </li>
              </ul>
        </div>
        <?php if($_SESSION["dUsuario"]['editar'] == 1){ ?>
          <button type="button" class="btn btn-success btn-sm" onclick="editarCliente(<?= $key->id_cliente ?>);"><i class="fa fa-edit"></i></button>
        <?php }
          if($_SESSION["dUsuario"]['eliminar'] == 1){
        ?>
          <button type="button" class="btn btn-danger btn-sm" onclick="eliminarCliente(<?= $key->id_cliente ?>, '<?= $key->nombre.' '.$key->apellido_p.' '.$key->apellido_m ?>');"><i class="fa fa-trash"></i></button>
        <?php } ?>
      </td>
    </tr>
  <?php } ?>
  </tbody>
  <tfoot>
    <tr>
      <th colspan="7">
        <nav style="width: 100%!important;">
                        <span style="float: left;">
                            <?php
                            if($datos){
                                echo '
                                    <span style="color:#464949!important;">Resultados encontrados: <b>'.$totRegistros.'</b></span>
                                    <br>
                                    <span style="color:#128499!important; font-weight:bold!important;">Página ' .$pagina. ' de ' . $pag->getCantidadPaginas().'</span>';
                            }
                            ?>
                        </span>
                        <ul class="pagination pagination-sm" style="float:right!important; margin-right:0.5em!important; margin-top:-0em!important;">
                            <?php
                            if($datos){
                                foreach ($datos as $enlace){
                                    if($enlace['active'] == false){ ?>
                                        <li class="page-item"><a  class="page-link" href="javascript:clientes_listado(<?php echo $enlace['numero'] ?>);"><?php echo $enlace['vista']; ?></a></li><?php
                                    }else{ ?>
                                        <li class="page-item active" ><a  class="page-link"><?php echo $enlace['vista']; ?></a></li>
                            <?php
                                    }
                                }
                            }
                            ?>
                        </ul>
                    </nav>
      </th>
    </tr>
  </tfoot>
</table>
<?php }else{ ?>
  <center><h4>¡No existen registros!</h4></center>
<?php } ?>
