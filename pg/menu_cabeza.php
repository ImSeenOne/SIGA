<header class="main-header">

    <!-- Logo -->
    <a href="inicio.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>SI</b>GA</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img src="img/engranes4.png" width="37%" /><b>SI</b>GA</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
                    
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?=$dUsuario["foto"];?>" width="18px" class="img-circle" alt="User Image">
              <span class="hidden-xs"><?= $dUsuario["nombre"]; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
              <img src="<?=$dUsuario["foto"];?>" width="160px" class="img-circle" alt="User Image">
                <p>
                  <?= $nombreC; ?>
                  <small><?= $dUsuario["nDepartamento"];?></small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href='usuarios_registroB' class="btn btn-default btn-flat">Datos</a>
                </div>
                <div class="pull-right">
                  <a href="javascript:cerrarSession();" class="btn btn-default btn-flat">Salir</a>
                </div>
              </li>
            </ul>
          </li>
          
        </ul>
      </div>

    </nav>
  </header>