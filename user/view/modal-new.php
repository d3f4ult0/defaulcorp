<div class="modal fade" id="modalNew" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Registro de nuevo <strong id="tipoUsuario"></strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h5>Se va a asignar el usuario con los siguientes datos:</h5>
        <ul>
          <li>Identificador: <strong>U-<span id="printID"></span></strong></li>
          <li>Nombre usuario: <strong id="printUsuario"></strong></li>
          <li>Nombre completo: <strong id="printNombre"></strong></li>
          <li>Correo: <strong id="printCorreo"></strong></li>
        </ul>
        <h6 id="printEstatus"></h6>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Segir editando</button>
        <!-- <button type="button" class="btn btn-success" onclick="registrar()">Registrar</button> -->
        <button type="button" class="btn btn-success" data-dismiss="modal" data-toggle="modal" data-target="#modalLoad" onclick="newCambio()">
          Continuar
        </button>
      </div>
    </div>
  </div>
</div>
