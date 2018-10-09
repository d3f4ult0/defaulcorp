<div class="modal fade" id="modalDeleteUnidad" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Borrar usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h5>¿Esta seguro de eliminar la unidad con los siguientes datos?</h5>
        <input type="hidden" id="id" value="">
        <input type="hidden" id="token" value="">
        <input type="hidden" id="unidadNumber" value="">
        <ul>
          <li id="printNumero"></li>
          <li id="printPlacas"></li>
          <li id="printMarca"></li>
          <li id="printPatron"></li>
          <li id="printFecha"></li>
        </ul>
        <br>
        <div class="alert alert-danger" role="alert">
          Esta accion no se puede revertir, se eliminaran tambien los documentos y/o fotos asociados a esta unidad.
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <!-- <button type="button" class="btn btn-success" onclick="registrar()">Registrar</button> -->
        <button type="button" class="btn btn-danger" data-dismiss="modal" data-toggle="modal" data-target="#modalLoad" onclick="borrar()">
          Eliminar
        </button>
      </div>
    </div>
  </div>
</div>
