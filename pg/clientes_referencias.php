<section class="content-header">
    <h1>
        Clientes
        <small>Inmobiliaria</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-home"></i> Inicio</a></li>
        <li><a href="clientes"><i class="fa fa-users"></i> Clientes</a></li>
        <li class="active"><i class="fa  fa-user"></i> Referencias</li>
    </ol>
</section>
<div class="box box-warning collapsed-box">
    <div class="box-header with-border" data-widget="collapse">
        <h3 class="box-title">Agregar/Editar Referencias</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <form class="form-horizontal">
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="txtTipo" class="col-sm-4 control-label">Tipo Referencia</label>
                    <div class="col-sm-8">
                        <select class="form-control select2" style="width: 100%;">
                            <option selected="selected" value="2">Normal</option>
                            <option value="1">Principal</option>
                        </select>
                    </div>
                </div>
                  
                <div class="form-group col-md-6">
                    <label for="txtNombre" class="col-sm-4 control-label">Nombre</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="txtNombre" placeholder="Nombre">
                    </div>
                </div>
                
                <div style="clear: both;"></div>
                
                <div class="form-group col-md-6">
                    <label for="txtApellioP" class="col-sm-4 control-label">Apellido Paterno</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="txtApellioP" placeholder="Apellido P">
                    </div>
                </div>
                
                <div class="form-group col-md-6">
                    <label for="txtApellidoM" class="col-sm-4 control-label">Apellido Materno</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="txtApellidoM" placeholder="Apellido M">
                    </div>
                </div>
                
                <div style="clear: both;"></div>
                
                <div class="form-group col-md-6">
                    <label for="txtTelefono" class="col-sm-4 control-label">Telefono</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="txtTelefono" placeholder="Telefono">
                    </div>
                </div>
                
                <div class="form-group col-md-6">
                    <label for="txtDireccion" class="col-sm-2 control-label">Dirección</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtDireccion" placeholder="Dirección">
                    </div>
                </div>
                
                <div style="clear: both;"></div>
            </div>
            
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="button" onclick="javascript:location.href = 'clientes'" class="btn btn-default">Cancelar</button>
                <button type="submit" class="btn btn-info pull-right">Guardar</button>
            </div>
            <!-- /.box-footer -->
        </form>
    </div>
</div>
    
<!-- /.box-header -->
<div class="row">
    <div class="col-xs-12">
        <div class="box-body">
            <table id="listArchivos" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Nombbre</th>
                        <th>Dirección</th>
                        <th>Telefono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>XXXXXXXXXXXXX</td>
                        <td>AAAAA AAAAA AAAAAAA</td>
                        <td>XXXXXXXXXXXXX</td>
                        <td>XXXXXXXXXXXXX</td>
                        <td>
                            <a type="button" href="clientesregistro" class="btn btn-inline btn-sm btn-primary" title="Editar"><i class="fa fa-edit"></i></a>
                            <a type="button" href="eliminar" class="btn btn-inline btn-sm btn-danger" title="eliminar"><i class="fa fa-remove"></i></a>
                        </td>        
                    </tr>
                    <tr>
                        <td>XXXXXXXXXXXXX</td>
                        <td>BBBBB BBBBBBBB BBBBBBBB</td>
                        <td>XXXXXXXXXXXXX</td>
                        <td>XXXXXXXXXXXXX</td>
                        <td>
                            <a type="button" href="clientesregistro" class="btn btn-inline btn-sm btn-primary" title="Editar"><i class="fa fa-edit"></i></a>
                            <a type="button" href="eliminar" class="btn btn-inline btn-sm btn-danger" title="eliminar"><i class="fa fa-remove"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>XXXXXXXXXXXXX</td>
                        <td>CCCCC CCCCCCC CCCCCCCCC</td>
                        <td>XXXXXXXXXXXXX</td>
                        <td>XXXXXXXXXXXXX</td>
                        <td>
                            <a type="button" href="clientesregistro" class="btn btn-inline btn-sm btn-primary" title="Editar"><i class="fa fa-edit"></i></a>
                            <a type="button" href="eliminar" class="btn btn-inline btn-sm btn-danger" title="eliminar"><i class="fa fa-remove"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>XXXXXXXXXXXXX</td>
                        <td>DDDDD DDDDDDD DDDDDDD</td>
                        <td>XXXXXXXXXXXXX</td>
                        <td>XXXXXXXXXXXXX</td>
                        <td>
                            <a type="button" href="clientesregistro" class="btn btn-inline btn-sm btn-primary" title="Editar"><i class="fa fa-edit"></i></a>
                            <a type="button" href="eliminar" class="btn btn-inline btn-sm btn-danger" title="eliminar"><i class="fa fa-remove"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>XXXXXXXXXXXXX</td>
                        <td>FFFFFFFF FFFFFFFFFF FFFFFFFFF</td>
                        <td>XXXXXXXXXXXXX</td>
                        <td>XXXXXXXXXXXXX</td>
                        <td>
                            <a type="button" href="clientesregistro" class="btn btn-inline btn-sm btn-primary" title="Editar"><i class="fa fa-edit"></i></a>
                            <a type="button" href="eliminar" class="btn btn-inline btn-sm btn-danger" title="eliminar"><i class="fa fa-remove"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>XXXXXXXXXXXXX</td>
                        <td>GGGGG GGGGGGGG GGGGGGGGG GGGGGG</td>
                        <td>XXXXXXXXXXXXX</td>
                        <td>XXXXXXXXXXXXX</td>
                        <td>
                            <a type="button" href="clientesregistro" class="btn btn-inline btn-sm btn-primary" title="Editar"><i class="fa fa-edit"></i></a>
                            <a type="button" href="eliminar" class="btn btn-inline btn-sm btn-danger" title="eliminar"><i class="fa fa-remove"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>XXXXXXXXXXXXX</td>
                        <td>HHHHHH HHHHHHHHH HHHHHH</td>
                        <td>XXXXXXXXXXXXX</td>
                        <td>XXXXXXXXXXXXX</td>
                        <td>
                            <a type="button" href="clientesregistro" class="btn btn-inline btn-sm btn-primary" title="Editar"><i class="fa fa-edit"></i></a>
                            <a type="button" href="eliminar" class="btn btn-inline btn-sm btn-danger" title="eliminar"><i class="fa fa-remove"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>XXXXXXXXXXXXX</td>
                        <td>IIIIII IIIIIIII IIIIIIIII</td>
                        <td>XXXXXXXXXXXXX</td>
                        <td>XXXXXXXXXXXXX</td>
                        <td>
                            <a type="button" href="clientesregistro" class="btn btn-inline btn-sm btn-primary" title="Editar"><i class="fa fa-edit"></i></a>
                            <a type="button" href="eliminar" class="btn btn-inline btn-sm btn-danger" title="eliminar"><i class="fa fa-remove"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>XXXXXXXXXXXXX</td>
                        <td>JJJJJJJJJ JJJJJJJ JJJJJJJ JJJJJJ</td>
                        <td>XXXXXXXXXXXXX</td>
                        <td>XXXXXXXXXXXXX</td>
                        <td>
                            <a type="button" href="clientesregistro" class="btn btn-inline btn-sm btn-primary" title="Editar"><i class="fa fa-edit"></i></a>
                            <a type="button" href="eliminar" class="btn btn-inline btn-sm btn-danger" title="eliminar"><i class="fa fa-remove"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>XXXXXXXXXXXXX</td>
                        <td>KKKKKK KKKKKKKKK KKKKKKKKK</td>
                        <td>XXXXXXXXXXXXX</td>
                        <td>XXXXXXXXXXXXX</td>
                        <td>
                            <a type="button" href="clientesregistro" class="btn btn-inline btn-sm btn-primary" title="Editar"><i class="fa fa-edit"></i></a>
                            <a type="button" href="eliminar" class="btn btn-inline btn-sm btn-danger" title="eliminar"><i class="fa fa-remove"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>XXXXXXXXXXXXX</td>
                        <td>LLLLLL LLLLLLLL LLLLLLL LLLLLL</td>
                        <td>XXXXXXXXXXXXX</td>
                        <td>XXXXXXXXXXXXX</td>
                        <td>
                            <a type="button" href="clientesregistro" class="btn btn-inline btn-sm btn-primary" title="Editar"><i class="fa fa-edit"></i></a>
                            <a type="button" href="eliminar" class="btn btn-inline btn-sm btn-danger" title="eliminar"><i class="fa fa-remove"></i></a>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                    <th>Tipo</th>
                    <th>Nombbre</th>
                    <th>Dirección</th>
                    <th>Telefono</th>
                    <th>Acciones</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
</div>


<script type="text/javascript">
window.onload = function() {    
loadDataTable('listArchivos',true);
}
</script>
