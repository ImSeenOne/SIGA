<!DOCTYPE html>
<?php
    require "php/inicializandoDatos.php";
?>
<html>
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Sistema SIGA</title>
      <link href="img/gAguilera.ico" rel="apple-touch-icon" type="image/png" sizes="32x32">
      <!-- Tell the browser to be responsive to screen width -->
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <!-- Bootstrap 3.3.7 -->
      <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
      <link rel="stylesheet" href="css/sweetalert.css">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
      <!-- Ionicons -->
      <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
      <!-- FANCYBOX -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
      <!-- jvectormap -->
      <!--daterangepicker-->
      <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
      <!-- DataTables -->
      <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
      <link rel="stylesheet" href="bower_components/datatables.net-bs/css/select.dataTables.min.css">
      <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
      <!-- Select2 -->
      <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
      <!--Magnific Popu-->
      <link rel="stylesheet" href="bower_components/magnific-popup/magnific-popup.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
      <!-- AdminLTE Skins. Choose a skin from the css/skins
           folder instead of downloading all of them to reduce the load. -->
      <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
       <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
       <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="plugins/iCheck/all.css">

      <!-- style -->
      <link rel="stylesheet" type="text/css" href="css/style.css">

      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->

      <!-- Google Font -->
      <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link href="img/gAguilera.ico" rel="icon" type="image/png" />
    </head>
    <?php
        if($dUsuario["tipo"] == 1){
    ?>
    <body class="hold-transition skin-blue sidebar-mini">
    <?php
        }
        else{
    ?>
        <body class="hold-transition skin-black sidebar-collapse sidebar-mini">
    <?php
        }
    ?>
        <div class="wrapper" id="cuerpo" style="height: 100vh; overflow: hidden;">
            <?php include_once('pg/menu_cabeza.php'); ?>
            <?php include_once('pg/menu_inicio.php'); ?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper" id="ContenidoGeneral">
                <?php
                if(file_exists('pg/'.$modulo.'.php')){
                    if ($permiso != 0) {
                        require('pg/'.$modulo.'.php');
                    }
                    else{
                        require('pg/inicio.php');
                    }
                }else{
                    require('pg/error-404.php');
                }
                ?>
            </div>
            <!-- /.content-wrapper -->
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 1.0.0
                </div>
                <strong>Copyright &copy; 2019 <a href="https://gruposelbor.com.mx/">Grupo Selbor</a></strong> Todos los derechos Reservados.
            </footer>
        </div>
        <!-- Google Maps -->
         <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAhwvP2m1CQmeYARAKBXVLrB0LjA5b2s1o&libraries=drawing,visualization,geometry"></script>
        <!-- jQuery 3 -->
        <script src="bower_components/jquery/dist/jquery-3.4.1.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
          $.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- Bootstrap 3.3.7 -->
        <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- DataTables -->
        <script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="bower_components/datatables.net/js/dataTables.select.min.js"></script>
        <script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
        <!-- SlimScroll -->
        <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="bower_components/fastclick/lib/fastclick.js"></script>
        <!-- iCheck --->
        <script src="plugins/iCheck/icheck.min.js"></script>
        <!-- Morris.js charts -->
        <script src="bower_components/raphael/raphael.min.js"></script>
        <script src="bower_components/morris.js/morris.min.js"></script>
        <!-- Sparkline -->
        <script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
        <!-- jvectormap -->
        <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
        <!-- jQuery Knob Chart -->
        <script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
        <!-- ChartJS -->
        <script src="bower_components/chart.js/Chart.js"></script>

        <!-- Select2 -->
        <script src="bower_components/select2/dist/js/select2.full.min.js"></script>
        <!-- daterangepicker -->
        <script src="bower_components/moment/min/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <!-- datepicker -->
        <script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
        <!-- Input Mask -->
        <script src="plugins/input-mask/jquery.inputmask.js"></script>
        <!-- FANCYBOX -->
        <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
        <!-- -------- -->
        <!-- magnific-popup -->
        <script src="bower_components/magnific-popup/jquery.magnific-popup.min.js"></script>
        <!--icheck-->
        <script src="plugins/iCheck/icheck.min.js"></script>
        <!-- Validación Formularios-->
        <script type="text/javascript" src="plugins/mdbB/js/popper.min.js"></script>
        <script type="text/javascript" src="plugins/mdbB/js/mdb.min.js"></script>
        <!-- funciones -->
        <script src="js/sweetalert.min.js"></script>
        <script src="js/simply-toast.js"></script>
        <script src="js/funciones.js" charset="UTF-8"></script>
        <script src="js/funciones2.js" charset="UTF-8"></script>
        <script src="js/funciones3.js" charset="UTF-8"></script>


        <!-- AdminLTE App -->
        <script src="dist/js/adminlte.min.js"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <!--<script src="dist/js/pages/dashboard.js"></script>-->
        <!-- AdminLTE for demo purposes -->
        <script src="dist/js/demo.js"></script>

    </body>
</html>
