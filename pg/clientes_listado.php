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
  $pagina = $funciones->limpia($_POST['pagina']);

  $aTipo = array(1 => 'Arrendatario', 2 => 'Comprador');

  @$conexion->obtenerlista($querys->getClientesData());
  $totRegistros = $conexion->numregistros();

  $limite = 10;
  $inicio = ($pagina - 1) * $limite;
  $totalPaginas = ceil($totRegistros / $limite);
  $listado = @$conexion->obtenerlista($querys->getClientesData()." LIMIT ".$inicio.','.$limite);

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
      <th class="text-center" style="width:10%;">Tipo</th>
      <th class="text-center" style="width:20%;">Fecha registro</th>
      <th class="text-center" style="width:20%;">Acciones</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($listado as $key) { ?>
    <tr>
      <td class="text-left v-align pt_2em">
        <p class="mg-1em"><label>RFC:</label> <strong><cite><?= $key->rfc ?></cite></strong></p>
        <p class="mg-1em"><label>NOMBRE:</label> <?= $key->nombre.' '.$key->apellido_p.' '.$key->apellido_m ?></p>
        <p class="mg-1em"><label>CORREO:</label> <cite><?= $key->correo ?></cite></p>
      </td>      
      <td class="text-center v-align"><?= $key->telefono ?></td>
      <td class="text-center v-align"><?= $aTipo[$key->id_tipo] ?></td>
      <td class="text-center v-align"><?= $funciones->ordenaFechaHora($key->fecha_registro); ?></td>
      <td class="text-center v-align">
        <div class="btn-group">
            <button type="button" class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-gear"></i> <span class="caret"></span></button>
              <ul class="dropdown-menu" role="menu">
                <li>
                  <a type="button" class="cusor" title="Archivos Personales" data-toggle="modal" data-target="#modal-archivos-cliente" onclick="cliente_archivos_listado(<?= $key->id_cliente ?>, '<?= $key->nombre.' '.$key->apellido_p.' '.$key->apellido_m ?>');"><i class="fa fa-file-archive-o"></i>Archivos Personales</a>
                </li>
                <li>
                  <a type="button" class="cusor" title="Referencias" data-toggle="modal" data-target="#modal-referencias-cliente" onclick="cliente_referencias_listado(<?= $key->id_cliente ?>, '<?= $key->nombre.' '.$key->apellido_p.' '.$key->apellido_m ?>');"><i class="fa fa-user"></i>Referencias</a>
                </li>
                <li>
                  <a type="button" class="cusor" title="Seguimiento" data-toggle="modal" data-target="#modal-interes-cliente" onclick="cliente_interes_listado(<?= $key->id_cliente ?>, '<?= $key->nombre.' '.$key->apellido_p.' '.$key->apellido_m ?>');"><i class="fa fa-building" ></i>Seguimiento</a>
                </li>
              </ul>
        </div>
        <button type="button" class="btn btn-success btn-sm" onclick="editarCliente(<?= $key->id_cliente ?>);"><i class="fa fa-edit"></i></button>
        <button type="button" class="btn btn-danger btn-sm" onclick="eliminarCliente(<?= $key->id_cliente ?>, '<?= $key->nombre.' '.$key->apellido_p.' '.$key->apellido_m ?>');"><i class="fa fa-trash"></i></button>
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