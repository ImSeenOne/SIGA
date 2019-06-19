  <br/>
  <form class="container">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputWorkName">Obra</label>
      <input type="email" class="form-control" id="inputWorkName" placeholder="Nombre de la obra">
    </div>
    <div class="form-group col-md-6">
      <label for="inputEstimateNum">Número de estimación</label>
      <input type="text" class="form-control" id="inputEstimateNum">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputAmount">Monto</label>
      <input type="text" class="form-control" id="inputAmount" placeholder="">
    </div>
    <div class="form-group col-md-6">
      <label for="period">Período</label>
      <div class="input-group">
        <div name="period" class="input-group-prepend">
          <span class="input-group-text"></span>
        </div>
        <input name="date1" type="text" aria-label="Fecha de inicio" class="form-control" value="<?= date('d-m-Y') ?>">
        <input name="date2" type="text" aria-label="Fecha de finalización" class="form-control" value="<?= date('d-m-Y') ?>">
      </div>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">Avance Físico</label>
      <input type="text" class="form-control" id="inputCity">
    </div>
    <div class="form-group col-md-4">
      <label for="inputStatus">Status</label>
      <select id="inputStatus" class="form-control">
        <option selected>Choose...</option>
        <option>Elaboración</option>
        <option>Revisión/Supervisión</option>
        <option>Terminada</option>
      </select>
    </div>
    <div class="form-group col-md-2">
      <label for="inputImages">Imágenes</label><br>
      <button type="file" name="inputImages" class="btn btn-light form-control-file">Examinar...</button>
      <button type="button" name="inputImages" class="btn btn-secondary">Subir</button>
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Generar estimación</button>
</form>
<br>
<br>
<div class="container">
  <table class="table table-bordered table-striped table-hover">
    <thead>
      <tr>
        <th>Obra</th>
        <th>Status</th>
        <th>Período</th>
        <th>Monto</th>
        <th>Acción</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Edificio HHM</td>
        <td>Terminada</td>
        <td>20/01/2015 a 31/01/2019</td>
        <td>$15,000,000</td>
        <td>
          <div class="margin">
              <div class="btn-group">
                <a type="button" href="clientesregistro" class="btn btn-inline btn-sm btn-primary" title="Editar">
                      <i class="fa fa-edit"></i>
                </a>
                <a type="button" href="eliminar" class="btn btn-inline btn-sm btn-danger" title="eliminar">
                      <i class="fa fa-remove"></i>
                </a>
          </div>
        </td>
      </tr>
      <tr>
        <td>Conjunto Habitacional #12</td>
        <td>Elaboración</td>
        <td>20/01/2018</td>
        <td>$35,000,000</td>
        <td>
          <div class="margin">
              <div class="btn-group">
                <a type="button" href="clientesregistro" class="btn btn-inline btn-sm btn-primary" title="Editar">
                      <i class="fa fa-edit"></i>
                </a>
                <a type="button" href="eliminar" class="btn btn-inline btn-sm btn-danger" title="eliminar">
                      <i class="fa fa-remove"></i>
                </a>
          </div>
        </td>
      </tr>
      <tr>
        <td>Casa habitación</td>
        <td>Terminada</td>
        <td>19/02/2018 a 25/06/2018</td>
        <td>$300,000</td>
        <td>
          <div class="margin">
              <div class="btn-group">
                <a type="button" href="clientesregistro" class="btn btn-inline btn-sm btn-primary" title="Editar">
                      <i class="fa fa-edit"></i>
                </a>
                <a type="button" href="eliminar" class="btn btn-inline btn-sm btn-danger" title="eliminar">
                      <i class="fa fa-remove"></i>
                </a>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
</div>


  <script src="funciones.js" charset="utf-8"></script>
  <script type="text/javascript">
    activaDatePicker('date1');
    activaDatePicker('date2');
  </script>
