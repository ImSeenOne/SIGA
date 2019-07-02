<?Php
?>
<section class="content-header">
    <h1>
        Clientes
        <small>Inmobiliaria</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-home"></i> Inicio</a></li>
        <li class="active"><i class="fa fa-users"></i>clientes</li>
        
    </ol>
</section>
<div class="box box-warning collapsed-box">
    <div class="box-header with-border" data-widget="collapse">
        <h3 class="box-title">Formulario de Busqueda.</h3>
        
        <div class="box-tools pull-right">
            
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
            </button>
        </div>
        <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <form id="form_busquedaB">
            <div class="row">
                <div class="col-lg-3">
                    <fieldset class="form-group">
                        <label class="form-label semibold" for="n">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el Nombre">
                    </fieldset>
                </div>
                <div class="col-lg-3">
                    <fieldset class="form-group">
                        <label class="form-label semibold" for="n">RFC</label>
                        <input type="text" class="form-control" id="rfc" name="rfc" placeholder="Ingrese el RFC">
                    </fieldset>
                </div>
                <div class="col-lg-3">
                    <fieldset class="form-group">
                        <label class="form-label semibold" for="n">Dirección</label>
                        <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Ingrese la Dirección">
                    </fieldset>
                </div>

            </div><!--.row-->
            <div class="text-left">      
                <input type="button" class="btn btn-success btn-sm" value=" Buscar " onclick="" />
                <input type="button" class="btn btn-danger btn-sm" value=" Cancelar " onclick="location.href='clientes'"/>
            </div> 
         </form>
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->
<div class="row">                          
    <div class="col-xl-12" id="listado" >
        <?php require('pg/clienteslista.php');?>
    </div><!--.col-->
</div><!--.row-->
