<div class="modal fade" id="modalSuccess" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalSuccessCenterTitle"><strong id="pSuccessMes"></strong></h5>
      </div>
      <div class="modal-body">
        <div id="pMes">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal" <?php if ($page == "verify.php") {
          echo "onclick='redirigir()'";
        } ?>>Aceptar</button>
      </div>
    </div>
  </div>
</div>
