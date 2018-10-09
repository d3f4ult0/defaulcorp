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
              <h3>¿Olvido su contraseña?</h3>
              <h4>No hay inconveniente, solo ingrese su correo y podra recuperarla.</h4>
              <h5>Se le enviara a su correo las instrucciones para poderla cambiar y segir disfritando de todos los beneficios que ofrece el estar registrado.</h5>
            </div>
            <div class="col-12" id="restoreMes">
              <form id="restore">
                <div class="form-group">
                  <label for="email">Correo registrado</label>
                  <input type="text" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Ingresa correo electronico" onblur="checkEmail()">
                  <small id="emailHelp" class="form-text text-muted">Correo valido y registrado.</small>
                </div>
                <button type="button" id="bRestore" class="btn btn-success" data-toggle="modal" data-target="#modalLoad" disabled onclick="recuperar()">
                  Recuperar contraseña
                </button>
              </form>
            </div>
            <br><br>
          </div>
        </div>
      </div>
    </div>
    <?php include 'view/aside.php'; ?>
  </div>
</div>
<div class="espacio-final">
</div>
<div>
  <?php require 'view/modal-load.php'; ?>
  <?php require 'view/modal-success.php'; ?>
</div>
<script type="text/javascript" src="<?php echo LINK; ?>js/restore.js" charset="utf-8"></script>
