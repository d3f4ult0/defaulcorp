<aside class="col-xs-12 col-md-3">
   <h3 class="text-center menu-aside">Menú de navegación</h3>
   <div class="list-group">
      <a href="index.php" class="list-group-item <?php if ($pagina == "index.php"): ?>
         active
      <?php endif; ?>"><span class="glyphicon glyphicon-home"></span> Inicio</a>
      <a href="new-user.php" class="list-group-item <?php if ($pagina == "new-user.php"): ?>
         active
      <?php endif; ?>"><span class="glyphicon glyphicon-ice-lolly-tasted"></span> Registrate</a>
      <a href="login.php" class="list-group-item <?php if ($pagina == "login.php"): ?>
         active
      <?php endif; ?>"><span class="glyphicon glyphicon-user"></span> Iniciar sesion</a>
      <a href="restore.php" class="list-group-item <?php if ($pagina == "restore.php"): ?>
         active
      <?php endif; ?>"><span class="glyphicon glyphicon-lock"></span> Contraseña Olvidada</a>
   </div>
</aside>
