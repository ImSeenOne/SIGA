<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?=$dUsuario["foto"];?>" width="160px" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?=$dUsuario["nombre"];?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> en linea</a>
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Menu</li>
        <?Php
          $modulosArray = array();
          $obtener_menu_padre = @$conexion->obtenerlista($querys->permisosmenuusuario($dUsuario["id_usuario"]));
          foreach($obtener_menu_padre as $menu_padre){
            if($menu_padre->archivo == NULL || $menu_padre->archivo == "#" || $menu_padre->archivo == ""){
                $menu_padre->archivo = '#';
            }
            array_push($modulosArray,$menu_padre->archivo);
            $modulos = explode(',',$menu_padre->modulos);
            if(is_array($modulos)){
                if(in_array($modulo,$modulos)) $activo = 'active treeview';
                else $activo = 'treeview';
            }
            else $activo = 'treeview';
            $obtener_submenu = @$conexion->obtenerlista($querys->permisosubmenuusuario($dUsuario["id_usuario"],$menu_padre->id_permiso));
        ?>
            <li class="<?=$activo;?>">
                <a href="<?=$menu_padre->archivo;?>">
                    <i class="<?=$menu_padre->icono;?>"></i> <span><?=$menu_padre->nombre;?></span>

                <?Php
                    $conteohijoarchivo = @$conexion->consultaregistro($querys->Conteopermisosubmenuusuariomodulo($dUsuario["id_usuario"], $menu_padre->id_permiso));
                    if($conteohijoarchivo != 0){
                ?>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                <?php
                        foreach($obtener_submenu as $menu_hijo){
                            array_push($modulosArray,$menu_hijo->archivo);
                            if($menu_hijo->archivo === $modulo) $activoHijo = 'class="active"';
                            else $activoHijo = '';
                            $conteohijoarchivoSub = @$conexion->consultaregistro($querys->Conteopermisosubmenuusuariomodulo($dUsuario["id_usuario"], $menu_hijo->id_permiso));
                            if($conteohijoarchivoSub == 0){
                ?>
                        <li <?= $activoHijo; ?>>
                            <a href="<?= $menu_hijo->archivo; ?>">
                                <i class="<?= $menu_hijo->icono; ?>"></i>
                                <?= $menu_hijo->nombre; ?>
                            </a>
                        </li>
                <?Php
                            }
                            else{
                                $modulosSub = explode(',',$menu_hijo->modulos);
                                if(is_array($modulosSub)){
                                    if(in_array($modulo,$modulosSub)) $activoSub = 'active treeview';
                                    else $activoSub = 'treeview';
                                }
                                else $activoSub = 'treeview';
                                $obtener_submenuSub = @$conexion->obtenerlista($querys->permisosubmenuusuario($dUsuario["id_usuario"],$menu_hijo->id_permiso));
                ?>
                        <li class="<?=$activoSub;?>">
                            <a href="<?=$menu_hijo->archivo;?>">
                                <i class="<?=$menu_hijo->icono;?>"></i> <span><?=$menu_hijo->nombre;?></span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">

                <?Php
                                foreach($obtener_submenuSub as $menu_hijoSub){
                                    array_push($modulosArray,$menu_hijoSub->archivo);
                                    if($menu_hijoSub->archivo === $modulo) $activoHijoSub = 'class="active"';
                                    else $activoHijoSub = '';
                ?>
                            <li <?= $activoHijoSub; ?>>
                                <a href="<?= $menu_hijoSub->archivo; ?>">
                                    <i class="<?= $menu_hijoSub->icono; ?>"></i>
                                    <?= $menu_hijoSub->nombre; ?>
                                </a>
                            </li>
                <?Php
                                }
                ?>
                            </ul>
                        </li>
                <?php
                            }
                        }
                ?>
                </ul>
                <?Php
                    }
                    else{
                ?>
                    </a>
                <?php
                    }
                ?>
                </li>
            <?Php
            }
            ?>
        </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
