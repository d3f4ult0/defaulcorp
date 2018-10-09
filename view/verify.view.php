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
          <h1>Verificación de correo</h1>
          <div class="col-12 table-responsive caja-principal">
            <h4>Estas a un paso de completar el Pre-registro.<br>Se confirmara el usuario con los siguientes datos: </h4>
            <form id="verEmail">
              <div class="form-group">
                <label for="number">Número</label>
                <input type="text" class="form-control" placeholder="U-<?php echo $checkUser['id_usuario']; ?>" disabled>
                <input type="hidden" id="number" value="<?php echo $checkUser['id_usuario']; ?>">
              </div>
              <div class="form-group">
                <label for="userName">Nombre de usuario</label>
                <input type="text" class="form-control" id="userName" placeholder="<?php echo $checkUser['usuario']; ?>" disabled>
              </div>
              <div class="form-group">
                <label for="fullName">Nombre completo</label>
                <input type="text" class="form-control" id="fullName" placeholder="<?php echo $checkUser['nombre']; ?>" disabled>
              </div>
              <div class="form-group">
                <label for="email">Correo</label>
                <input type="text" class="form-control" id="email" placeholder="<?php echo $checkUser['correo']; ?>" disabled>
              </div>
              <button type="button" id="buttonVerEmail" class="btn btn-primary" data-toggle="modal" data-target="#modalLoad" onclick="verificar()">
                Verificar correo
              </button>
            </form>
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
<script type="text/javascript" src="<?php echo LINK; ?>js/verify.js" charset="utf-8"></script>
