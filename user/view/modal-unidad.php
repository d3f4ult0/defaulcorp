<div class="modal fade" id="modalUnidad" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Alta de Nueva unidad</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h5>Se va a registrar una nueva unidad con los siguientes datos:</h5>
        <ul>
          <li id="printPlacas"></li>
          <li id="printSerie"></li>
          <li id="printTipoFactura"></li>
          <li id="printFactura"></li>
          <li id="printFecha"></li>
          <li id="printTipo"></li>
          <li id="printMarca"></li>
          <li id="printPatron"></li>
        </ul>
        <h6 id="printEstatus"></h6>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Segir editando</button>
        <!-- <button type="button" class="btn btn-success" onclick="registrar()">Registrar</button> -->
        <button type="button" class="btn btn-success" data-dismiss="modal" data-toggle="modal" data-target="#modalLoad" onclick="newUnidad()">
          Continuar
        </button>
      </div>
    </div>
  </div>
</div>
