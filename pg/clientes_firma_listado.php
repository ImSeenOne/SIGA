<?php
  require '../php/inicializandoDatosExterno.php';
  $listado = @$conexion->obtenerlista('SELECT * FROM tbl_interes_cliente WHERE (fecha_firma IS NOT NULL OR fecha_entrega IS NOT NULL) AND fecha_eliminado IS NULL;');
  $totRegs = $conexion->numregistros();
  if($totRegs > 0){
    $sign = 1;
 ?>
 <style>
   .upper{
     text-transform: uppercase;
   }

   cite{
     color: steelblue;
     font-style: normal;
   }

   .proper-name{
     text-transform: capitalize;
   }

   cite.email{
     text-transform: lowercase;
     text-decoration: none;
     color: midnightblue;
   }

   strong > cite{
     font-weight: lighter;
   }
 </style>
<div class="col-lg-12 col-md-12 col-sm-12">
  <table id="listSignClients" class="table table-bordered table-striped">
    <thead>
      <th scope="col">Cliente</th>
      <th scope="col">Propiedad</th>
      <th scope="col" class="text-center" style="width: 10%;">Fecha Firma</th>
      <th scope="col" class="text-center" style="width: 10%;">Fecha Entrega</th>
    </thead>
    <tbody>
      <?php foreach ($listado as $key) { ?>
        <tr>
          <td class="text-left v-align pt_2em" style="vertical-align: middle;">
            <?php
              $resp = @$conexion->fetch_array($querys3->listClientes($key->id_cliente));
            ?>
            <p class="mg-1em">
              <label>RFC:&nbsp;</label>
              <strong>
                <cite><?= $resp['rfc'] ?></cite>
              </strong>
            </p>
            <?php if(isset($resp['curp'])){ ?>
              <p class="mg-1em">
                <label>CURP:&nbsp;</label>
                <strong>
                  <cite><?= $resp['curp'] ?></cite>
                </strong>
              </p>
            <?php } ?>
            <p class="mg-1em">
              <label>Nombre:&nbsp;</label>
              <strong>
                <cite class="proper-name"><?= strtolower($resp['nombre'].' '.$resp['apellido_p'].' '.$resp['apellido_m']) ?></cite>
              </strong>
            </p>
            <p class="mg-1em">
              <label>Correo:&nbsp;</label>
              <strong>
                <cite class="email"><a class="email" href="mailto:<?= $resp['correo'] ?>"><?= $resp['correo'] ?></a></cite>
              </strong>
            </p>
            <?php if(isset($resp['telefono'])){ ?>
              <p class="mg-1em">
                <label>Teléfono:&nbsp;</label>
                <strong>
                  <cite><?= $resp['telefono'] ?></cite>
                </strong>
              </p>
            <?php } ?>
            <?php if(isset($resp['celular'])){ ?>
              <p class="mg-1em">
                <label>Celular:&nbsp;</label>
                <strong>
                  <cite><?= $resp['celular'] ?></cite>
                </strong>
              </p>
            <?php } ?>
          </td>
          <td class="text-left v-align pt_2em"  style="vertical-align: middle;">
            <?php
              $strQuery = 'SELECT * FROM tblc_propiedades WHERE fecha_eliminado IS NULL AND id_propiedad = '.$key->id_propiedad;
              $property = @$conexion->fetch_array($strQuery);
             ?>
             <p class="mg-1em">
               <label>Desarrollo:&nbsp;</label>
               <strong>
                 <cite class="proper-name"><?= @$conexion->fetch_array($querys3->getListadoDesarrollo($property['desarrollo']))['nombre'] ?></cite>
               </strong>
             </p>
             <p class="mg-1em">
               <label>Edificio:&nbsp;</label>
               <strong>
                 <cite class="upper"><?= $property['numero_edificio'] ?></cite>
               </strong>
             </p>
             <p class="mg-1em">
               <label>Nivel:&nbsp;</label>
               <strong>
                 <cite><?= @$conexion->fetch_array($querys3->getLevels($key->numero_nivel))['nombre'] ?></cite>
               </strong>
             </p>
             <p class="mg-1em">
               <label>Departamento:&nbsp;</label>
               <strong>
                 <cite class="upper"><?= $property['numero_departamento'] ?></cite>
               </strong>
             </p>
          </td>
          <td style="vertical-align: middle;">
            <?= date("d/m/Y", strtotime($key->fecha_firma)) ?>
          </td>
          <td style="vertical-align: middle;">
            <?= date("d/m/Y", strtotime($key->fecha_entrega)) ?>
          </td>
        </tr>
      <?php } ?>
    </tbody>
    <tfoot>
      <th scope="col">Cliente</th>
      <th scope="col">Propiedad</th>
      <th scope="col" class="text-center" style="width: 10%;">Fecha Firma</th>
      <th scope="col" class="text-center" style="width: 10%;">Fecha Entrega</th>>
    </tfoot>
  </table>
</div>
<?php }else{
        $sign = 0;?>
  <center><h4>¡No se encontraron clientes para firma!</h4></center>
<?php } ?>
<input type="hidden" id="sign" value="<?= $sign ?>">
