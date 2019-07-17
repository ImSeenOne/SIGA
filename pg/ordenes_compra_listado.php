<style type="text/css">
  .v-align{vertical-align:middle!important;}
  .mg-1em{margin-top:-1em!important;display:block;}
  .pt_2em{padding-top:2em!important;}
  .cusor{cursor:pointer;}
  cite{color:#0000FF;}
</style>
<?php
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
  require '../php/inicializandoDatosExterno.php';
  $pagina    = $funciones->limpia($_POST['pagina']);
  $folio     = (isset($_POST['folio']))? $funciones->limpia($_POST['folio']):'';
  $obra      = (isset($_POST['obra']))? $funciones->limpia($_POST['obra']):0;
  $empresa   = (isset($_POST['empresa']))? $funciones->limpia($_POST['empresa']):0;
  $estatus   = (isset($_POST['estatus']))? $funciones->limpia($_POST['estatus']):-1;
  $tipoComp  = (isset($_POST['estatus']))? $funciones->limpia($_POST['tipoCompra']):0;
  $fechaDesde= (isset($_POST['fechaDesde']))? $funciones->limpia($_POST['fechaDesde']):'';
  $fechaHasta= (isset($_POST['fechaHasta']))? $funciones->limpia($_POST['fechaHasta']):'';

  $aTipoComp = array(1 => 'Credito', 2 => 'De contado');
  $aEstatus  = array(0 => 'En captura', 1 => 'En espera', 2 => 'En proceso', 3 => 'Autorizada', 4 => 'Concluida', 5 => 'Cancelada');
  //exit($querys->ordenes_compra_listado($folio, $obra, $empresa, $estatus, $tipoComp, $fechaDesde, $fechaHasta));
  @$conexion->obtenerlista($querys->ordenes_compra_listado($folio, $obra, $empresa, $estatus, $tipoComp, $fechaDesde, $fechaHasta));
  $totRegistros = $conexion->numregistros();

  $limite = 10;
  $inicio = ($pagina - 1) * $limite;
  $totalPaginas = ceil($totRegistros / $limite);
  $listado = @$conexion->obtenerlista($querys->ordenes_compra_listado($folio, $obra, $empresa, $estatus, $tipoComp, $fechaDesde, $fechaHasta)." LIMIT ".$inicio.','.$limite);

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
<table id="listOrdenCompra" class="table table-bordered table-striped">
  <thead>
    <tr>
      <th class="text-left" style="width:30%;">&nbsp;</th>      
      <th class="text-center" style="width:10%;">Tipo compra</th>
      <th class="text-right" style="width:10%;">Monto</th>
      <th class="text-center" style="width:20%;">Residente</th>
      <th class="text-center" style="width:10%;">Fecha</th>
      <th class="text-center" style="width:25%;">Acciones</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($listado as $key) {
    $result       = @$conexion->fetch_array($querys->getSumMontoArtOrdComp($key->id_orden_compra));
    $montoOrdComp = (!is_null($result['total']))? number_format($result['total'],2):'0.00';
  ?>
    <tr>
      <td class="text-left v-align pt_2em">
        <p class="mg-1em"><label>FOLIO:</label> <strong><cite><?= $key->folio ?></cite></strong></p>
        <p class="mg-1em"><label>OBRA:</label> <?= $key->obra ?></p>
        <p class="mg-1em"><label>EMPRESA:</label> <cite><?= $key->id_empresa ?></cite></p>
        <p class="mg-1em"><label>ESTATUS:</label> <span class="badge badge-primary"><?= $aEstatus[$key->estatus] ?></span></p>
      </td>      
      <td class="text-center v-align"><?= $aTipoComp[$key->id_tipo_compra] ?></td>
      <td class="text-right v-align"><strong>$<?= $montoOrdComp ?></strong></td>
      <td class="text-left v-align"><?= $key->residente ?></td>
      <td class="text-center v-align"><?= $funciones->fecha4($key->fecha_captura) ?></td>
      <td class="text-center v-align">
        <div class="btn-group">
            <button type="button" class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-gear"></i> <span class="caret"></span></button>
              <ul class="dropdown-menu" role="menu">
                <li>
                  <a type="button" class="cusor" title="Artículos" data-toggle="modal" data-target="#modal-orden-compra-artiuclos" onclick="ordenes_compra_articulos_listado(<?= $key->id_orden_compra ?>, '<?= $key->folio ?>');"><i class="fa fa-file-archive-o"></i>Artículos de la orden</a>
                </li>
                <li>
                  <a type="button" class="cusor" title="Cotizaciones" data-toggle="modal" data-target="#modal-orden-compra-cotizaciones" onclick="ordenes_compra_cotizaciones_listado(<?= $key->id_orden_compra ?>, '<?= $key->folio ?>');"><i class="fa fa-usd"></i> Cotizaciones</a>
                </li>
              </ul>
        </div>
        <button type="button" class="btn btn-success btn-sm" onclick="editarOrdenC(<?= $key->id_orden_compra ?>);"><i class="fa fa-edit"></i></button>
        <button type="button" class="btn btn-danger btn-sm" onclick="eliminarOrdenC(<?= $key->id_orden_compra ?>, '<?= $key->folio ?>');"><i class="fa fa-trash"></i></button>
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