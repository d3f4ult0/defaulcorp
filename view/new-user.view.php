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
          <h1>Registro de nuevo usuario</h1>
          <div class="col-12 table-responsive caja-principal">
            <form id="newUser">
              <div class="form-group">
                <label for="userName">Nombre de usuario*</label>
                <input type="text" class="form-control" id="userName" aria-describedby="userNameHelp" placeholder="Ingresa Nombre de usuario" onkeyup="checkUser()">
                <small id="userNameHelp" class="form-text text-muted">El nombre de usuario solo reconoce minusculas.</small>
              </div>
              <div class="form-group">
                <label for="fullName">Nombre completo*</label>
                <input type="text" class="form-control" id="fullName" aria-describedby="fullNameHelp" placeholder="Ingresa Nombre completo" onblur="checkFullName()">
                <small id="fullNameHelp" class="form-text text-muted">Nombre y apellidos del usuario</small>
              </div>
              <div class="form-group">
                <label for="phone">Telefono</label>
                <input type="text" class="form-control" id="phone" placeholder="Ingresa Telefono" onblur="checkPhone()">
              </div>
              <div class="form-group">
                <label for="email">Correo*</label>
                <input type="text" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Ingresa correo" onblur="checkEmail()">
                <small id="emailHelp" class="form-text text-muted">Correo valido</small>
              </div>
              <div class="form-group">
                <label for="pass1">Contraseña*</label>
                <input type="password" class="form-control" id="pass1" aria-describedby="pass1Help" placeholder="Ingresa contraseña" onblur="checkPass1()">
                <small id="pass1Help" class="form-text text-muted">Contraseña de 6 digitos o mas</small>
              </div>
              <div class="form-group">
                <label for="pass2">Repetir contraseña*</label>
                <input type="password" class="form-control" id="pass2" aria-describedby="pass2Help" placeholder="Ingresa contraseña nuevamente" onkeydown="checkPass2()">
                <small id="pass2Help" class="form-text text-muted"></small>
              </div>
              <small class="form-text text-muted"><strong>*</strong>Campos requeridos</small>
              <button type="button" id="buttonNewUser" class="btn btn-primary" disabled data-toggle="modal" data-target="#modalRegister">
                Registrar
              </button>
              <button type="reset" class="btn btn-warning" onclick="desactiveButton()">
                Limpiar Formulario
              </button>
            </form>
            <br><br>
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
  <?php require 'view/modal.php'; ?>
  <?php require 'view/modal-load.php'; ?>
  <?php require 'view/modal-success.php'; ?>
</div>
<script type="text/javascript" src="<?php echo LINK; ?>js/new-user.js" charset="utf-8"></script>
