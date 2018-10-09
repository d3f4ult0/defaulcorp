<div class="container-fluid">
  <div class="row m-top">
    <div class="col-12 col-md-8 col-lg-9">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $title; ?></li>
              </ol>
            </nav>
          </div>
          <h1>Restaurar contraseña</h1>
          <div class="col-12 table-responsive caja-principal">
            <div id="restoreMes2">
              <h3>Estas a un paso para recuperar tu contraseña.</h3>
              <h4>Solo ingresa en los siguientes campos tu nueva contraseña.</h4>
              <h5>Recuerda que tiene que ser de mas de 6 caracteres.</h5>
            </div>
            <div class="col-12" id="restoreMes">
              <form id="restore">
                <div class="form-group">
                  <label for="pass1">Contraseña*</label>
                  <input type="password" class="form-control" id="pass1" aria-describedby="pass1Help" placeholder="Ingresa contraseña" onblur="checkPass1()">
                  <small id="pass1Help" class="form-text text-muted">Contraseña de 6 digitos o mas</small>
                </div>
                <div class="form-group">
                  <label for="pass2">Repetir contraseña*</label>
                  <input type="password" class="form-control" id="pass2" aria-describedby="pass2Help" placeholder="Ingresa contraseña nuevamente" onblur="checkPass2()">
                  <small id="pass2Help" class="form-text text-muted"></small>
                </div>
                <input type="hidden" id="number" value="<?php echo $checkUser['id_usuario']; ?>">
                <button type="button" id="bRestore" class="btn btn-success" data-toggle="modal" data-target="#modalLoad" disabled onclick="recuperar()">
                  Cambiar contraseña
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php include 'view/aside.php';; ?>
  </div>
</div>
<div class="espacio-final">
</div>
<div>
  <?php require 'view/modal-load.php'; ?>
  <?php require 'view/modal-success.php'; ?>
</div>
<script type="text/javascript" src="<?php echo LINK; ?>js/restore-end.js" charset="utf-8"></script>
