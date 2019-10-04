<div class="modal fade" id="modalPhysProgDetails">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Conceptos del reporte de avances <cite id="physProgFolio"></cite></h4>
      </div>
      <div class="modal-body">
        <ul class="list-group">
          <li id="folioModal" class="list-group-item active text-center">Cargando...</li>
          <li id="residentModal" class="list-group-item text-center">Cargando...</li>
          <li id="workModal" class="list-group-item text-center">Cargando...</li>
        </ul>
        <br>
        <div class="col-lg-12 col-sm-12 col-md-12">
            <table id="listConceptsDetail" class="table table-bordered table-striped table-hover">
              <thead>
                <th style="width:4%" scope="col">ID</th>
                <th style="width:8%" scope="col">Código</th>
                <th scope="col">Concepto</th>
                <th style="width:23%" scope="col">Cantidad</th>
              </thead>
              <tbody>
              </tbody>
            </table>
            <div id="respServerModalDetail">
            </div>
        </div>
      </div>
      <br><br><br><br><br>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
