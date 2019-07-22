<?php
  require '../php/inicializandoDatosExterno.php';
  $listado = @$conexion->obtenerlista($querys3->getContracts());
  $totRegs = $conexion->numregistros();
  if($totRegs > 0){
 ?>
<div class="col-lg-12 col-md-12 col-sm-12">
  <table id="listContracts" name="listContracts" class="table table-bordered table-striped">
    <thead>
      <th class="col">ID</th>
      <th class="col">Folio</th>
      <th class="col">Cliente</th>
      <th class="col">Propiedad</th>
      <th class="col">Vigencia</th>
      <th class="col">Tipo de contrato</th>
      <th class="col">Arrendatario/Propietario</th>
      <th class="col">Depósito/Enganche</th>
      <th class="col">Acciones</th>
    </thead>
    <tbody>
      <?php foreach ($listado as $key) { ?>
        <tr>
          <td><?= $key->id_contrato ?></td>
          <td><?= $key->folio ?></td>
          <td>
            <?php
              $resp = @$conexion->fetch_array($querys3->listClientes($key->id_cliente));
              $nombre = $resp['nombre'];
              $apellido = $resp['apellido_p'];
              echo $nombre.' '.$apellido;
            ?>
          </td>
          <td>
            <?php
            $resp = @$conexion->fetch_array($querys3->getPropiedades($key->id_propiedad));
            $nombre = $resp['valor'];
            echo $nombre;
            ?>
          </td>
          <td><?= $key->vigencia ?></td>
          <td>
            <?php
              switch ($key->tipo_contrato) {
                case '1':
                  echo 'Arrendatario';
                break;

                case '2':
                  echo 'Propietario';
                break;
              }
            ?>
         </td>
         <td>
           <?php
           switch ($key->tipo_contrato) {
             case '1'://en caso de ser arrendatario
               //$resp = @$conexion->fetch_array($querys3->getListadoArrendatarios($key->id_arrendatario));
               echo 'Arrendatario';

             break;

             case '2':
               $resp = @$conexion->fetch_array($querys3->getListadoPropietarios($key->id_propietario));
               $nombre = $resp['valor'];
               echo $nombre;
             break;
           }
            ?>
         </td>
          <td>$<?= number_format($key->enganche_deposito,2) ?></td>
          <td class="text-center">
            <button type="button" class="btn btn-success btn-sm" onclick="editContract(<?= $key->id_contrato ?>);"><i class="fa fa-edit"></i></button>
            <button type="button" class="btn btn-danger btn-sm" onclick="deleteContract(<?= $key->id_contrato ?>, '<?= $nombre.' '.$apellido ?>','<?= $key->archivo ?>');"><i class="fa fa-trash"></i></button>
          </td>
        </tr>
      <?php } ?>
    </tbody>
    <tfoot>
      <th class="col">ID</th>
      <th class="col">Folio</th>
      <th class="col">Cliente</th>
      <th class="col">Propiedad</th>
      <th class="col">Vigencia</th>
      <th class="col">Tipo de contrato</th>
      <th class="col">Arrendatario/Propietario</th>
      <th class="col">Depósito/Enganche</th>
    </tfoot>
  </table>
</div>
<?php }else{ ?>
  <center><h4>¡No se encontraron registros!</h4></center>
<?php } ?>
