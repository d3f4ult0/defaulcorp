<!-- <div class="jumbotron">
   <div class="container">
      <h1>Pagina principal del la sesion</h1>
      <h2>Este es un jumbotron</h2>
      <h4>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur fugit ipsa dicta iusto quam laudantium dolor, quasi repellendus quaerat magni velit culpa consequatur voluptas voluptate eum. Quod numquam saepe libero.</h4>
   </div>
</div> -->
<div class="container main">
   <div class="row">
      <ol class="breadcrumb">
         <li><a href="<?php echo RUTA; ?>index.php">Inicio</a></li>
         <li class="active"><?php echo $titulo; ?></li>
      </ol>
   </div>
   <div class="row">
      <section class="col-xs-12 col-md-9">
         <form class="form-horizontal formulario" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <h2 class="text-center">Registro de nuevo usuario</h2>
            <div class="input-group">
               <label class="control-label sr-only" for="usuario">*Nombre de usuario:</label>
               <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
               <input class="form-control" type="text" id="input-usuario" name="usuario" placeholder="Nombre de usuario(Sin mayusculas ni espacios)" value="<?php echo $_POST['usuario']; ?>">
               <span class="input-group-addon" id="usuario"><span class="glyphicon glyphicon-asterisk"></span></span>
            </div>
            <br>
            <div class="input-group">
               <label class="control-label sr-only" for="correo">*Correo electronico:</label>
               <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
               <input class="form-control" type="text" id="input-correo" name="correo" placeholder="Correo electronico" value="<?php echo $_POST['correo']; ?>">
               <span class="input-group-addon" id="correo"><span class="glyphicon glyphicon-asterisk"></span></span>
            </div>
            <br>
            <div class="input-group">
               <label class="control-label sr-only" for="correo2">*Repita su correo:</label>
               <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
               <input class="form-control" type="text" id="input-correo2" name="correo2" placeholder="Repita su correo" value="<?php echo $_POST['correo2']; ?>">
               <span class="input-group-addon" id="correo2"><span class="glyphicon glyphicon-asterisk"></span></span>
            </div>
            <br>
            <div class="input-group">
               <label class="control-label sr-only" for="nombre">*Nombre propio:</label>
               <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
               <input class="form-control" type="text" id="input-nombre" name="nombre" placeholder="Nombre propio" value="<?php echo $_POST['nombre']; ?>">
               <span class="input-group-addon" id="nombre"><span class="glyphicon glyphicon-asterisk"></span></span>
            </div>
            <br>
            <div class="input-group">
               <label class="control-label sr-only" for="nombre">Apellido paterno:</label>
               <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
               <input class="form-control" type="text" name="apellido-pat" placeholder="Apellido paterno" value="<?php echo $_POST['apellido-pat']; ?>">
            </div>
            <br>
            <div class="input-group">
               <label class="control-label sr-only" for="nombre">Apellido materno:</label>
               <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
               <input class="form-control" type="text" name="apellido-mat" placeholder="Apellido materno" value="<?php echo $_POST['apellido-mat']; ?>">
            </div>
            <br>
            <div class="input-group">
               <label class="control-label sr-only" for="pass">*Contraseña(minimo 5 caracteres):</label>
               <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
               <input class="form-control" type="password" id="input-pass" name="pass" placeholder="Contraseña(minimo 5 caracteres)">
               <span class="input-group-addon" id="pass"><span class="glyphicon glyphicon-asterisk"></span></span>
            </div>
            <br>
            <div class="input-group">
               <label class="control-label sr-only" for="pass2">*Repetir contraseña:</label>
               <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
               <input class="form-control" type="password" id="input-pass2" name="pass2" placeholder="Repetir contraseña">
               <span class="input-group-addon" id="pass2"><span class="glyphicon glyphicon-asterisk"></span></span>
            </div>
            <br>
            <button type="submit" name="button" class="btn btn-primary btn-lg btn-block" >Registrarse... <span class="glyphicon glyphicon-share-alt"></span></button>
            <br>
         </form>
         <?php if (!empty($errores)): ?>
            <div class="alert alert-danger">
               <button class="close" data-dismiss="alert"><span>&times;</span></button>
               <ul>
                  <?php echo $errores; ?>
               </ul>
            </div>
         <?php endif; ?>
         <?php if (!empty($exito)): ?>
            <div class="alert alert-success">
               <button class="close" data-dismiss="alert"><span>&times;</span></button>
               <ul>
                  <?php echo $exito; ?>
               </ul>
            </div>
         <?php endif; ?>
         <div class="alert alert-info">
            <button class="close" data-dismiss="alert"><span>&times;</span></button>
            <ul>
               <li>Campos marcados con <span class="glyphicon glyphicon-asterisk"></span> son obligatorios</li>
            </ul>
         </div>
      </section>
      <?php require 'views/aside.php'; ?>
   </div>
</div>
<?php require 'pop-up.php'; ?>
<script src="js/new-user.js" charset="utf-8"></script>
