<div class="modal fade" id="modal-ver1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-ver-title">No ha completado su registro</h5>
      </div>
      <div class="modal-body" id="modal-ver-mes">

      </div>
      <div class="modal-footer">
        <?php if ($_SESSION['verify'] == 2): ?>
          <button type="button" class="btn btn-success" data-dismiss="modal" data-toggle="modal" data-target="#modal-ver1">
            Cerrar
          </button>
        <?php else: ?>
          <button type="button" class="btn btn-danger" data-dismiss="modal" data-toggle="modal" data-target="#modal-ver1" onclick="redirigir()">
            Cerrar sesión
          </button>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
