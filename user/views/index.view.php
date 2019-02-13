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
   <?php if ($estatusSesion['estatus_sesion'] == 1): ?>
      <div class="jumbotron main">
         <div class="container">
            <h1 class="text-center">Bienvenido <?php echo nombreCompleto(); ?></h1>
            <h3>Nos da mucho gusto el tenerte aqui nuevamente.</h3>
            <h4>Ultimo inicio de sesion: <strong><?php echo ultimaSesionFecha($conexion); ?></strong></h4>
            <h5 class="text-right">DefaultCORP© Abril-2017</h5>
         </div>
      </div>
   <?php endif; ?>
   <div class="container main">
      <div class="col-xs-12 col-md-9">
         <h3>Se ha implementado la tabla sesiones a la base de datos para guardar todos los inicios de sesion del usuario, y mostrar el ultimo inicio de sesion del usuario en pantalla.</h3>
         <h4>Puntos a trabajar para el usuario:</h4>
            <ol>
               <li>Header.php, footer.php <span class="glyphicon glyphicon-ok verde"></span></li>
               <li>Aside dinamico para el cambio automatico <span class="glyphicon glyphicon-ok verde"></span></li>
               <li>Editar perfil del usuario en edit-profile.php <span class="glyphicon glyphicon-ok verde"></span>
                  <ul>
                     <li>Vista <span class="glyphicon glyphicon-ok verde"></span></li>
                     <li>Logica <span class="glyphicon glyphicon-ok verde"></span></li>
                     <li>Script <span class="glyphicon glyphicon-ok verde"></span></li>
                     <li>Cambio de imagen de perfil (Se conservo elformato anterior)<span class="glyphicon glyphicon-remove rojo"></li>
                  </ul>
               </li>
               <li>Cambiar Contraseña en change-password.php(copia del formulario reset-password.php) <span class="glyphicon glyphicon-ok verde"></span>
                  <ul>
                     <li>Vista <span class="glyphicon glyphicon-ok verde"></span></li>
                     <li>Logica <span class="glyphicon glyphicon-ok verde"></span></li>
                     <li>Script (no fue necesario)<span class="glyphicon glyphicon-remove rojo"></span></li>
                  </ul>
               </li>
            </ol>
            <h4>Puntos a trabajar para el paciente:</h4>
            <ol>
               <li>Se modifico el hader para que aparezaca el nombre y la foto del paciente en lugar de la del usuario <span class="glyphicon glyphicon-ok verde"></span></li>
               <li>Editar perfil del paciente en edit-patient.php? <span class="glyphicon glyphicon-ok verde"></span>
                  <ul>
                     <li>Vista <span class="glyphicon glyphicon-ok verde"></span></li>
                     <li>Logica <span class="glyphicon glyphicon-ok verde"></span></li>
                     <li>Script <span class="glyphicon glyphicon-ok verde"></span></li>
                     <li>Preparado para modificar cualquier paciente que pertenezca al usuario <span class="glyphicon glyphicon-ok verde"></span></li>
                  </ul>
               </li>
               <li>Cuestionario de habilidades en skill-quiz.php(dinamico con JS y con movimiento) <span class="glyphicon glyphicon-ok verde"></span>
                  <ul>
                     <li>Vista <span class="glyphicon glyphicon-ok verde"></span></li>
                     <li>Logica(el archivo ajax/next-question.ajax.php es el encargado de mostrar las preguntas y subir todo a las bases de datos) <span class="glyphicon glyphicon-ok verde"></span></li>
                     <li>Script en skill-quiz.js(hace la peticion al archivo ajax)  <span class="glyphicon glyphicon-ok verde"></span></li>
                  </ul>
               </li>
            </ol>
            <h4>Puntos a trabajar para el administrador:</h4>
               <ol>
                  <li>Lista de todos los usuarios registrados en admin/user-list.php <span class="glyphicon glyphicon-ok verde"></span>
                     <ul>
                        <li>Vista <span class="glyphicon glyphicon-ok verde"></li>
                        <li>Logica <span class="glyphicon glyphicon-ok verde"></li>
                        <li>Script (no fue necesario)<span class="glyphicon glyphicon-remove rojo"></li>
                     </ul>
                  </li>
                  <li>Editar cualquier perfil de usuario en admin/edit-profile.php? <span class="glyphicon glyphicon-ok verde"></span>
                     <ul>
                        <li>Vista <span class="glyphicon glyphicon-ok verde"></span></li>
                        <li>Logica <span class="glyphicon glyphicon-ok verde"></span></li>
                        <li>Script (script de new-user.js)<span class="glyphicon glyphicon-ok verde"></span></li>
                     </ul>
                  </li>
                  <li>Borrar usuario con js en delete-user.php<span class="glyphicon glyphicon-ok verde"></span>
                     <ul>
                        <li>Vista <span class="glyphicon glyphicon-ok verde"></span></li>
                        <li>Logica <span class="glyphicon glyphicon-ok verde"></span></li>
                        <li>Script <span class="glyphicon glyphicon-ok verde"></span></li>
                     </ul>
                  </li>
               </ol>
      </div>
      <?php require 'views/aside.php'; ?>
   </div>
<?php endif; ?>
