<?php

require '../configs/configs.php';
require '../configs/functions.php';

$conexion = conexion($bd_config);
if (!$conexion) {
   header('Location: error.php');
}

sleep(5);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   $id = $_POST['id'];
   $token = $_POST['token'];

   $usuario = comprobarEn('usuarios','id_usuario',$id,$conexion);

   $verificar = $conexion->prepare('UPDATE usuarios SET verificacion_usuario = 1 WHERE id_usuario = :id');
   $verificar->execute(array(':id' => $id));
   $comprobacion = $verificar->rowCount();
   if ($comprobacion == 1) {
      $exitoCabeza = "¡Verificacion Exitosa!";
      $exito = '<li>El usuario <strong>'.$usuario['nombre_usuario'].'</strong> se verifico correctamente</li>
                <li>Ya puede <a href="login.php">Iniciar sesión</a> con el nombre <strong>'.$usuario['nombre_usuario'].'</strong> o el correo <strong>'.$usuario['correo_usuario'].'</strong></li>';

      echo '<div class="jumbotron main">
         <div class="container">
            <h2>---------------------------------------------------------------</h2>
            <h2 class="text-center">¡Verificacion Exitosa!</h2>
            <h3>Todo listo ya puede utilizar su cuenta sin problemas</h3>
            <h4>Puede <a href="login.php">Iniciar sesión</a> con su nombre de usuario <strong>'.$usuario['nombre_usuario'].'</strong> o su correo <strong>'.$usuario['correo_usuario'].'</strong> y su contraseña</h4>
         </div>
      </div>
      <div class="modal fade" id="ventanaExitoVer" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" data-keyboard="false" data-backdrop="static">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <button class="close" type="button" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">'.$exitoCabeza.'</h4>
               </div>

               <div class="modal-body">
                  <ul>
                     '.$exito.'
                  </ul>
               </div>

               <div class="modal-footer">
                  <a href="login.php" class="btn btn-success"><span class="glyphicon glyphicon-user"></span> Iniciar Sesión</a>
                  <button class="btn btn-primary" type="button" id="entendido" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-ok"></span> Entendido</button>
               </div>
            </div>
         </div>
      </div>
      <script>
      $(document).ready(function(){
         $("#entendido").click(function(){
            $( ".modal-backdrop" ).remove();
         });
      });
      </script>';
   }
}
 ?>
