<aside class="col-xs-12 col-md-3">
   <h3 class="text-center menu-aside">Menú de navegación</h3>
   <div class="list-group">
      <!-- Pagina de inicio -->
      <a href="<?php echo RUTA; ?>user/index.php" class="list-group-item <?php if ($pagina == "index.php"): ?>
         active
      <?php endif; ?>"><span class="glyphicon glyphicon-home"></span> Inicio</a>

      <!-- Editar paciente si es cuenta personal, sino editar perfil -->
      <?php if ($_SESSION['tipo_usuario'] == 'Personal'): ?>
         <a href="<?php echo RUTA; ?>user/edit-patient.php?token=<?php echo $_SESSION['password_usuario'].'&idPaciente='.$_SESSION['paciente_id']; ?>" class="list-group-item <?php if ($pagina == "edit-patient.php"): ?>
            active
         <?php endif; ?>"><span class="glyphicon glyphicon-pencil"></span> Editar perfil</a>
      <?php else: ?>
         <a href="<?php echo RUTA; ?>user/edit-profile.php" class="list-group-item <?php if ($pagina == "edit-profile.php"): ?>
            active
         <?php endif; ?>"><span class="glyphicon glyphicon-pencil"></span> Editar perfil</a>
      <?php endif; ?>

      <!-- Cuestionario -->
      <a href="<?php echo RUTA; ?>user/skill-quiz.php" class="list-group-item <?php if ($pagina == "skill-quiz.php"): ?>
         active
      <?php endif; ?>"><span class="glyphicon glyphicon-list-alt"></span> Cuestionario</a>

      <!-- Si es administrador puede ver todos los resultados de todos los pacientes, los resultados de sus pacientes y sus resultados personales -->
      <?php if ($_SESSION['tipo_usuario'] == 'Administrador'): ?>
         <a href="<?php echo RUTA; ?>user/all-results.php" class="list-group-item <?php if ($pagina == "all-results.php"): ?>
            active
         <?php endif; ?>"><span class="glyphicon glyphicon-stats"></span> Resultados de todos los pacientes</a>
         <a href="<?php echo RUTA; ?>user/results-pro.php" class="list-group-item <?php if ($pagina == "results-pro.php"): ?>
            active
         <?php endif; ?>"><span class="glyphicon glyphicon-stats"></span> Resultados de mis pacientes</a>
         <a href="<?php echo RUTA; ?>user/results-patient.php" class="list-group-item <?php if ($pagina == "results-patient.php"): ?>
            active
         <?php endif; ?>"><span class="glyphicon glyphicon-stats"></span> Mis resultados anteriores</a>
      <?php endif; ?>

      <!-- Si es Profesional puede ver los resultados de sus pacientes y los propios -->
      <?php if ($_SESSION['tipo_usuario'] == 'Profesional'): ?>
         <a href="<?php echo RUTA; ?>user/results-pro.php" class="list-group-item <?php if ($pagina == "results-pro.php"): ?>
            active
         <?php endif; ?>"><span class="glyphicon glyphicon-stats"></span> Resultados de mis pacientes</a>
         <a href="<?php echo RUTA; ?>user/results-patient.php" class="list-group-item <?php if ($pagina == "results-patient.php"): ?>
            active
         <?php endif; ?>"><span class="glyphicon glyphicon-stats"></span> Mis resultados anteriores</a>
      <?php endif; ?>

      <!-- Si es un paciente solo puede ver sus resultados -->
      <?php if ($_SESSION['tipo_usuario'] == 'Personal'): ?>
         <a href="<?php echo RUTA; ?>user/results-patient.php" class="list-group-item <?php if ($pagina == "results-patient.php"): ?>
            active
         <?php endif; ?>"><span class="glyphicon glyphicon-stats"></span> Mis resultados anteriores</a>
      <?php endif; ?>

      <!-- Si cuenta es administrador puede ver todos los ususarios -->
      <?php if ($_SESSION['tipo_usuario'] == 'Administrador'): ?>
         <a href="<?php echo RUTA; ?>admin/user-list.php" class="list-group-item <?php if ($pagina == "user-list.php"): ?>
            active
         <?php endif; ?>"><span class="glyphicon glyphicon-th-list"></span> Usuarios registrados</a>
      <?php endif; ?>

      <!-- Cambio de contraseña -->
      <a href="<?php echo RUTA; ?>user/change-password.php" class="list-group-item <?php if ($pagina == "change-password.php"): ?>
         active
      <?php endif; ?>"><span class="glyphicon glyphicon-lock"></span> Cambiar Contraseña</a>
   </div>
</aside>
