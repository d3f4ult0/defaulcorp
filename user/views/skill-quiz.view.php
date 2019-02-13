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
   <?php if ($_SESSION['creditos_usuario'] <= 0): ?>
      <div class="jumbotron main">
         <div class="container">
            <h2 class="text-center error">¡Algo ha salido mal!</h2>
            <h3>Nos da mucho gusto el tenerte aqui nuevamente.</h3>
            <h4>Lamentablemente no cuentas con creditos disponibles para poder continuar con el cuestionario.</h4>
            <h4>Puedes <a href="credits.php">recargar creditos</a></h4>
            <h4>Si crees que es un error de la aplicacion favor de comunicarse con el administrador al correo: <strong><?php echo CORREO; ?></strong></h4>
            <h5 class="text-right">DefaultCORP© Abril-2017</h5>
         </div>
      </div>
   <?php else: ?>
      <div class="container main">
         <div class="row">
            <ol class="breadcrumb">
               <li><a href="<?php echo RUTA; ?>user/index.php">Inicio</a></li>
               <li class="active"><?php echo $titulo; ?></li>
            </ol>
         </div>
         <div class="row">
            <section class="col-xs-12 col-md-9">
               <div id="pregunta" style="position: relative;">
                  <div class="jumbotron">
                     <h2 class="text-center">Bienvenido al Cuestionario de Habilidades</h2>
                     <h4>A continuación te presentamos un listado de 60 afirmaciones, una a la vez, cada afirmación asígnale el valor que creas pertinente.</h4>
                     <h4>Al responder piensa siempre en la pregunta y contesta correctamente, ya que no se puede volver a contestar la pregunta.</h4>
                     <h5>Se le restara un credito al finalizar el cuestionario</h5>
                     <form class="form-horizontal formulario" method="post">
                        <?php if (!empty($pacientes)): ?>
                           <label for="paciente" class="control-label">Quien va a contestar el cuestionario? </label>
                           <select class="form-control" name="paciente" id="paciente">
                              <?php foreach ($pacientes as $paciente): ?>
                                 <option value="<?php echo $paciente['id_paciente']; ?>">
                                    <?php echo $paciente['nombre_completo_paciente']; ?>
                                 </option>
                              <?php endforeach; ?>
                           </select>
                           <br>
                        <?php else: ?>
                           <input type="hidden" name="paciente" value="<?php echo $_SESSION['paciente_id']; ?>" id="paciente">
                        <?php endif; ?>
                        <button type="button" name="button" class="btn btn-success btn-block" id="comenzarCuestionario">Comenzar cuestionario <span class="glyphicon glyphicon-share-alt"></span></button>
                        <script src="js/skill-quiz.js" charset="utf-8"></script>
                     </form>
                  </div>
               </div>
            </section>
            <?php require 'views/aside.php'; ?>
         </div>
      </div>
      <?php require '../views/pop-up.php'; ?>
   <?php endif; ?>
<?php endif; ?>
