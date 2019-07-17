<style type="text/css">
  .cursor{cursor:pointer;}
  .v-align{vertical-align:middle!important;}
  .mt-1em{margin-top:1em;}
  .mt-2_15em{margin-top:2.15em;}
  .mg-1em{margin-top:-1em!important;display:block;}
  .pt_2em{padding-top:2em!important;}
  .cusor{cursor:pointer;}
  .cntnFrmServPV{border:1px dotted #e9e9e9;margin: 0.5em auto;padding:0.8em;}
  cite{color:#0000FF;}
</style>
<?php
  require '../php/inicializandoDatosExterno.php';
  $id      = $funciones->limpia($_POST['id']);  
  $listado = @$conexion->obtenerlista($querys->getInteresListadoCte($id));
  $totRegs = $conexion->numregistros();
  $aTipo = array(1 => 'Principal', 2 => 'Normal');

  if($totRegs > 0){
?>
<table id="listadoInteresCliente" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th class="text-left">Info</th>
      <th class="text-center">Fecha firma</th>
      <th class="text-center">Fecha entrega</th>
      <th class="text-center">Fecha registro</th>
      <th class="text-center">Acción</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($listado as $key) {
        $fechaFirma   = (!is_null($key->fecha_firma))? $funciones->fecha4($key->fecha_firma):'--';
        $fechaEntrega = (!is_null($key->fecha_entrega))? $funciones->fecha4($key->fecha_entrega):'--';
  ?>
    <tr>
      <td class="text-left">
        <p><strong>ID:</strong> <cite><?= $key->id_interes ?></cite></p>
        <p class="mg-1em"><strong>AGENTE:</strong> <cite><?= $key->agente ?></cite></p>
        <p class="mg-1em"><strong>PROPIEDAD:</strong> <cite><?= $key->Descripcion ?></cite></p>
        <p class="mg-1em"><strong>MONTO:</strong> <cite>$<?= number_format($key->monto, 2) ?></cite></p>
        <p class="mg-1em"><strong>ESTATUS:</strong> <cite><?= $key->txtestatus ?></cite></p>
      </td>      
      <td class="text-center v-align"><?= $fechaFirma ?></td>
      <td class="text-center v-align"><?= $fechaEntrega ?></td>
      <td class="text-center v-align"><?= $funciones->ordenaFechaHora($key->fecha_registro) ?></td>
      <td class="text-center v-align">
        <button type="button" class="btn btn-default btn-sm" title="Servicio Posventa" onclick="servicioPosVentaDown(<?= $key->id_interes ?>);"><i class="fa fa-wrench"></i></button>
        <button type="button" class="btn btn-success btn-sm" title="Editar" onclick="editarInteresCte(<?= $id ?>, <?= $key->id_interes ?>);"><i class="fa fa-edit"></i></button>
        <button type="button" class="btn btn-danger btn-sm" title="Eliminar" onclick="eliminarInteresCte(<?= $key->id_interes ?>, '<?= $key->Descripcion ?>');"><i class="fa fa-trash"></i></button>
      </td>
    </tr>
    <tr id="cntnMtto<?= $key->id_interes ?>" style="display:none;">
      <td colspan="5">
        <div class="row">
          <div class="col-lg-12">
            <div class="panel panel-default">
              <div class="panel-heading"><strong>Servicio Posventa</strong> <a class="cursor pull-right" onclick="servicioPosVentaUp(<?= $key->id_interes ?>)" title="Cerrar panel"><i class="fa fa-times text-danger"></i></a></div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12"><button id="btnNvoServPV<?= $key->id_interes ?>" class="btn btn-primary btn-sm pull-right" onclick="dispFrmServPV(<?= $key->id_interes ?>);"><i class="fa fa-plus"></i> Nuevo servicio</button></div>
                </div>

                <div id="cntFrmServPV<?= $key->id_interes ?>" class="row cntnFrmServPV" style="display:none;">
                <form id="frnServPv<?= $key->id_interes ?>">
                  <div class="col-lg-12">
                    <div class="row">
                      <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="form-group">
                          <label for="txtFolioPV<?= $key->id_interes ?>">Folio</label>
                          <input type="text" id="txtFolioPV<?= $key->id_interes ?>" name="txtFolioPV<?= $key->id_interes ?>" class="form-control" />
                          <div id="reqTxtFolioPV<?= $key->id_interes ?>" class="msgError"></div>
                        </div>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="form-group">
                          <label for="txtFechaPV<?= $key->id_interes ?>">Fecha</label>
                          <input type="date" id="txtFechaPV<?= $key->id_interes ?>" name="txtFechaPV<?= $key->id_interes ?>" class="form-control" value="<?= date('Y-m-d') ?>" />
                          <div id="reqTxtFechaPV<?= $key->id_interes ?>" class="msgError"></div>
                        </div>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="form-group">
                          <label for="cboMotivoPV<?= $key->id_interes ?>">Motivo</label>
                          <select id="cboMotivoPV<?= $key->id_interes ?>" name="cboMotivoPV<?= $key->id_interes ?>" class="form-control" >
                            <option value="0">Seleccionar</option>
                            <option value="1">Repacación</option>
                            <option value="2">Quejas</option>
                            <option value="3">Otros</option>
                          </select>
                          <div id="reqCboMotivoPV<?= $key->id_interes ?>" class="msgError"></div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                          <label for="txtDescripcion<?= $key->id_interes ?>">Descripción</label>
                          <textarea id="txtDescripcion<?= $key->id_interes ?>" name="txtDescripcion<?= $key->id_interes ?>" class="form-control" ></textarea>
                          <div id="reqTxtDescripcion<?= $key->id_interes ?>" class="msgError"></div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="form-group">
                          <label for="cboEstatus<?= $key->id_interes ?>">Estatus</label>
                          <select id="cboEstatus<?= $key->id_interes ?>" name="cboEstatus<?= $key->id_interes ?>" class="form-control" >
                            <option value="1">Revisión </option>
                            <option value="2">Proceso </option>
                            <option value="3">Terminado </option>
                          </select>
                          <div id="reqCboEstatus<?= $key->id_interes ?>" class="msgError"></div>
                        </div>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="form-group">
                          <label for="txtFechaTerminoPV<?= $key->id_interes ?>">Fecha termino</label>
                          <input type="date" id="txtFechaTerminoPV<?= $key->id_interes ?>" name="txtFechaTerminoPV<?= $key->id_interes ?>" class="form-control" />
                          <div id="reqTxtFechaTerminoPV<?= $key->id_interes ?>" class="msgError"></div>
                        </div>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-12">
                        <input type="hidden" id="idServPV<?= $key->id_interes ?>" name="idServPV" value="<?= $key->id_interes ?>">
                        <input type="hidden" id="opcionServPV<?= $key->id_interes ?>" name="opcion" value="222">
                        <button type="button" id="btnGuardaServPV<?= $key->id_interes ?>" class="btn btn-primary btn-sm mt-2_15em" onclick="guardaServPV(<?= $key->id_interes ?>);">Guardar</button>&nbsp;
                        <button type="button" id="btnCancelaServPV<?= $key->id_interes ?>" class="btn btn-secondary btn-sm mt-2_15em" onclick="dispFrmServPV(<?= $key->id_interes ?>);">Cancelar</button>
                      </div>
                    </div>
                  </div>
                </form>
                <div id="respServ<?= $key->id_interes ?>" class="col-lg-12 mt-1em"></div>
                </div>

                <div class="row mt-1em">
                  <div id="cntnListServPV<?= $key->id_interes ?>" class="col-lg-12 col-md-12 col-sm-12">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </td>
    </tr>
  <?php } ?>
  </tbody>
  <tfoot>    
      <th class="text-left">Info</th>
      <th class="text-center">Monto</th>
      <th class="text-center">Estatus</th>
      <th class="text-center">Fecha registro</th>
      <th class="text-center">Acción</th>
  </tfoot>                
</table>
<?php }else{ ?>
  <center><h4>¡No existen registros!</h4></center>
<?php } ?>