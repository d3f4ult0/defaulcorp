<div class="modal fade" id="modalRegister" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalRegisterCenterTitle">Confirmar registro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Se va a registrar nuevo usuario con los siguientes datos:
        <ul>
          <li>Nombre de usuario: <strong id="pUser"></strong></li>
          <li>Nombre completo: <strong id="pName"></strong></li>
          <li>Telefono: <strong id="pPhone">Sin definir</strong></li>
          <li>Correo: <strong id="pEmail"></strong></li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Segir editando</button>
        <!-- <button type="button" class="btn btn-success" onclick="registrar()">Registrar</button> -->
        <button type="button" class="btn btn-success" data-dismiss="modal" data-toggle="modal" data-target="#modalLoad" onclick="registrar()">
          Registrar
        </button>
      </div>
    </div>
  </div>
</div>
