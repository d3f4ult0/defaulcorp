<div class="container">
  <div class="row m-top">
    <div class="col-12 col-md-9">
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
          <h1>Iniciar sesión</h1>
          <div class="col-12 table-responsive caja-principal">
            <form id="login">
              <input type="hidden" id="site" value="<?php echo $site; ?>">
              <div class="form-group">
                <label for="userName">Nombre de usuario</label>
                <input type="text" class="form-control" id="userName" aria-describedby="userNameHelp" placeholder="Ingresa Nombre de usuario o correo electronico" onblur="checkUser()">
                <small id="userNameHelp" class="form-text text-muted">El nombre de usuario solo reconoce minusculas.</small>
              </div>
              <div class="form-group">
                <label for="pass">Contraseña</label>
                <input type="password" class="form-control" id="pass" aria-describedby="passHelp" placeholder="Ingresa contraseña" onkeyup="checkPass()">
                <small id="passHelp" class="form-text text-muted">Contraseña de 6 digitos o mas</small>
              </div>
              <button type="button" id="access" class="btn btn-success" data-toggle="modal" data-target="#modalLoad" disabled onclick="iniciar()">
                Iniciar Sesión
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php include 'view/aside.php' ?>
  </div>
</div>
<div class="espacio-final">
</div>


         <form class="form-horizontal formulario" method="post">
            <h2 class="text-center">Iniciar Sesión</h2>
            <div class="input-group">
               <label class="control-label sr-only" for="usuario">*Nombre de usuario o correo:</label>
               <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
               <input class="form-control" type="text" id="input-login-usuario" name="usuario" placeholder="Nombre de usuario o correo" value="<?php echo $_POST['usuario'] ?>">
            </div>
            <br>
            <div class="input-group">
               <label class="control-label sr-only" for="usuario">*Contraseña:</label>
               <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
               <input class="form-control" type="password" id="input-login-password" name="password" placeholder="*Contraseña">
               <span class="input-group-btn">
                  <button type="button" name="iniciar" class="btn btn-success boton-inicio" id="iniciar">
                     <span class="sr-only">Iniciar sesion</span>
                     <span class="glyphicon glyphicon-ok"></span>
                  </button>
               </span>
            </div>
         </form>
         <div id="respuesta">
         </div>

<script src="<?php echo RUTA; ?>js/login.js" charset="utf-8"></script>
