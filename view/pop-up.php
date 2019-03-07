<?php if (!empty($scriptExito)): ?>
   <div class="modal fade" id="ventanaExito" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <!-- <button class="close" type="button" data-dismiss="modal" aria-hidden="true">&times;</button> -->
               <h4 class="modal-title"><?php echo $exitoCabeza; ?></h4>
            </div>

            <div class="modal-body">
               <ul>
                  <?php if (empty($errores)): ?>
                     <?php echo $exito; ?>
                  <?php else: ?>
                     <?php echo $errores; ?>
                  <?php endif; ?>
               </ul>
            </div>

            <div class="modal-footer">
               <button class="btn btn-success" type="button" id="entendido"><span class="glyphicon glyphicon-ok"></span> Entendido</button>
               <a href="index.php" class="btn btn-primary"><span class="glyphicon glyphicon-home"></span> Inicio</a>
            </div>
         </div>
      </div>
   </div>
   <?php echo $scriptExito; ?>
<?php endif; ?>


<?php if (!empty($scriptCambio)): ?>
   <div class="modal fade" id="ventanaExito" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <!-- <button class="close" type="button" data-dismiss="modal" aria-hidden="true">&times;</button> -->
               <h4 class="modal-title"><?php echo $cambioCabeza; ?></h4>
            </div>

            <div class="modal-body">
               <ul>
                  <?php if (empty($errores)): ?>
                     <?php echo $cambio; ?>
                  <?php else: ?>
                     <?php echo $errores; ?>
                  <?php endif; ?>
               </ul>
            </div>

            <div class="modal-footer">
               <?php if (empty($errores)): ?>
                  <button class="btn btn-success" type="button" data-dismiss="modal"><span class="glyphicon glyphicon-ok"></span> Entendido</button>
               <?php else: ?>
                  <button class="btn btn-warning" type="button" id="entendido"><span class="glyphicon glyphicon-ok"></span> Intentar nuevamente</button>
               <?php endif; ?>
               <a href="index.php" class="btn btn-primary"><span class="glyphicon glyphicon-home"></span> Inicio</a>
            </div>
         </div>
      </div>
   </div>
   <?php echo $scriptCambio; ?>
<?php endif; ?>


<?php if (!empty($scriptCarga)): ?>
   <div class="jumbotron main">
      <div class="container">
         <h2>---------------------------------------------------------------</h2>
         <h2 class="text-center">¡Procesando peticion por favor espere!</h2>
         <h3>Por favor espere un momento en lo que se procesa su solicitud</h3>
         <h4>Si ocurre algun problema favor de comunicarlo al administrador del sitio al correo: <?php echo CORREO; ?></h4>
      </div>
   </div>
   <div class="modal fade" id="ventanaExito" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <!-- <button class="close" type="button" data-dismiss="modal" aria-hidden="true">&times;</button> -->
               <h4 class="modal-title"><?php echo $cabeza; ?></h4>
            </div>

            <div class="modal-body">
               <div class="text-center">
                  <?php echo $carga;?>
               </div>
            </div>
         </div>
      </div>
   </div>
   <?php echo $scriptCarga; ?>
<?php endif; ?>
