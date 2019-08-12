<style type="text/css">
  .v-align{vertical-align:middle!important;}
  .mg-1em{margin-top:-1em!important;display:block;}
  .pt_2em{padding-top:2em!important;}
  .cusor{cursor:pointer;}
  cite{color:#0000FF;}
  .cntnAgentProveedor{border:1px dotted #e8e8e8;background:#fff;padding:0em 0.6em;margin-top:-1em;padding-top:1.8em;}
</style>
<?php
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
  require '../php/inicializandoDatosExterno.php';
  $pagina = $funciones->limpia($_POST['pagina']);
  $nombreBusq = $funciones->limpia($_POST['nombreBusq']);
  $rfcBusq    = $funciones->limpia($_POST['rfcBusq']);
  $agenteBusqueda= $funciones->limpia($_POST['agenteBusqueda']);
  $aEstatus = array(0 => 'Inactivo', 1 => 'Activo');
  
  @$conexion->obtenerlista($querys->getProveedoresData('', $nombreBusq, $rfcBusq, $agenteBusqueda));
  $totRegistros = $conexion->numregistros();

  $limite = 5;
  $inicio = ($pagina - 1) * $limite;
  $totalPaginas = ceil($totRegistros / $limite);
  $listado = @$conexion->obtenerlista($querys->getProveedoresData('', $nombreBusq, $rfcBusq, $agenteBusqueda)." LIMIT ".$inicio.','.$limite);

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
      <th class="text-center" style="width:15%;">Teléfono</th>
      <th class="text-center" style="width:10%;">Estatus</th>
      <th class="text-center" style="width:20%;">Fecha registro</th>
      <th class="text-center" style="width:20%;">Acciones</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($listado as $key) { ?>
    <tr>
      <td class="text-left v-align pt_2em">
        <p class="mg-1em"><label>NOMBRE:</label> <strong><cite><?= $key->nombre; ?></cite></strong></p>
        <p class="mg-1em"><label>RAZÓN SOCIAL:</label> <strong><cite><?= $key->razon_social; ?></cite></strong></p>
        <p class="mg-1em"><label>RFC:</label> <strong><cite><?= $key->rfc; ?></cite></strong></p>
        <div class="cntnAgentProveedor">
          <p class="mg-1em"><label>AGENTE:</label> <strong><cite><?= $key->nombre_agente; ?></cite></strong></p>
          <p class="mg-1em"><label>CORREO AGENTE:</label> <strong><cite><?= $key->correo_agente; ?></cite></strong></p>
          <p class="mg-1em"><label>TELÉFONO AGENTE:</label> <strong><cite><?= $key->telefono_agente; ?></cite></strong></p>
        </div>
      </td>      
      <td class="text-center v-align"><?= $key->telefono; ?></td>
      <td class="text-center v-align"><?= $aEstatus[$key->estatus]; ?></td>
      <td class="text-center v-align"><?= $funciones->ordenaFechaHora($key->fecha_registro); ?></td>
      <td class="text-center v-align">
        <div class="btn-group">
            <button type="button" class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-gear"></i> <span class="caret"></span></button>
              <ul class="dropdown-menu" role="menu">
                <li>
                  <a type="button" class="cusor" title="Archivos Personales" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#modal-proveedor-cuentas" onclick="proveedor_cuentas_listado(<?= $key->id_proveedor ?>, '<?= $key->nombre ?>');"><i class="fa fa-usd"></i> Cuentas bancarias</a>
                </li>
              </ul>
        </div>
      <?php if($_SESSION["dUsuario"]['editar'] == 1){ ?>
        <button type="button" class="btn btn-success btn-sm" onclick="editarProveedor(<?= $key->id_proveedor ?>);"><i class="fa fa-edit"></i></button>
      <?php }
          if($_SESSION["dUsuario"]['eliminar'] == 1){
      ?>
        <button type="button" class="btn btn-danger btn-sm" onclick="eliminarProveedor(<?= $key->id_proveedor ?>, '<?= $key->nombre ?>');"><i class="fa fa-trash"></i></button>
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