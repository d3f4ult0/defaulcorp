<?php if (!empty(verificacionUsuario())): ?>

   <div class="jumbotron main">
      <div class="container">
         <h2 class="text-center error">¡Algo ha salido mal!</h2>
         <h3>Nos da mucho gusto el tenerte aqui nuevamente.</h3>
         <h4>Lamentablemente ha ocurrido un error y no se puede continuar por favor tenga en cuenta las siguientes recomendaciones</h4>
         <h4>
            <ul>
               <?php echo verificacionUsuarioRecomendacion(); ?>
            </ul>
         </h4>
         <h5 class="text-right">DefaultCORP© Abril-2017</h5>
      </div>
   </div>
<?php else: ?>
   <!-- <div class="jumbotron main">
      <div class="container">
         <h1 class="text-center">Solo un paso mas</h1>
         <h2>Escribe una nueva contraseña, presiona el boton cambiar contraseña y listo</h2>
         <h5 class="text-right">DefaultCORP© Abril-2017</h5>
      </div>
   </div> -->
   <div class="container main">
      <div class="row">
         <ol class="breadcrumb">
            <li><a href="<?php echo RUTA; ?>user/index.php">Inicio</a></li>
            <li class="active"><?php echo $titulo; ?></li>
         </ol>
      </div>
      <div class="row">
         <section class="col-xs-12 col-md-9">
            <form class="form-horizontal formulario" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
               <h2 class="text-center">Cambio de contraseña</h2>
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
               <button type="submit" name="button" class="btn btn-primary btn-lg btn-block" >Cambiar contraseña <span class="glyphicon glyphicon-refresh"></span></button>
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
            </form>
         </section>
         <?php require 'views/aside.php'; ?>
      </div>
   </div>
   <?php require '../views/pop-up.php'; ?>
   <script src="../js/new-user.js" charset="utf-8"></script>      
<?php endif; ?>
