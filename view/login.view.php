
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
