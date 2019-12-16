<div class="col-lg-12 col-md-12 col-sm-12 col-xl-12 col-xs-12">
  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Listado de Clientes Morosos</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>
    <div class="box-body">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12 col-xs-12" id="buttonPrint" style="display: none;">
        <button type="button" class="btn btn-md btn-primary pull-right" onclick="openPDFSlugClients()"><i class="fa fa-file-text"></i>&nbsp;Imprimir Reporte</button>
      </div>
      <div class="content" style="margin-top: 5%;">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12 col-xs-12 table-responsive" id="cntnListSluggishClients">
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  window.onload = function(){
    listSluggishClients();
  }
</script>
