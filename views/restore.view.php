<div class="jumbotron main">
   <div class="container">
      <h1 class="text-center">¿Perdiste tu contraseña?</h1>
      <h2>No te preocupes desde aqui puedes recuperarla</h2>
      <h4>Lo unico que necesitas es ingresar tu nombre de usuario o tu correo electronico y listo, se te enviara a tu correo las instrucciones para recuperarla en menos de 5 minutos.</h4>
      <?php if (!empty($errores)): ?>
         <h4>Si ya a solicitado un camio de contraseña y no ha obtenido respuesta puede ponerse en contacto con el administrador de la aplicacion al correo: <strong><?php echo CORREO; ?></strong></h4>
      <?php endif; ?>
      <h5 class="text-right">DefaultCORP© Abril-2017</h5>
   </div>
</div>
<div class="container">
   <div class="row">
      <ol class="breadcrumb">
         <li><a href="<?php echo RUTA; ?>index.php">Inicio</a></li>
         <li class="active"><?php echo $titulo; ?></li>
      </ol>
   </div>
   <div class="row">
      <section class="col-xs-12 col-md-9">
         <form class="form-horizontal formulario" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <h2 class="text-center">Recuperar contraseña olvidada</h2>
            <div class="input-group">
               <label class="control-label sr-only" for="usuario">*Nombre de usuario o correo:</label>
               <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
               <input class="form-control" type="text" id="input-usuario" name="usuario" placeholder="Nombre de usuario o correo" value="<?php echo $_POST['usuario']; ?>">
               <span class="input-group-addon" id="usuario"><span class="glyphicon glyphicon-asterisk"></span></span>
            </div>
            <br>
            <button type="submit" name="button" class="btn btn-primary btn-lg btn-block" >Recuperar contraseña <span class="glyphicon glyphicon-refresh"></span></button>
         </form>
         <br>
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
<script src="js/restore.js" charset="utf-8"></script>
