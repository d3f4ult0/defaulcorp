<?php session_start();

require 'configs/configs.php';
require 'configs/functions.php';

sesionIniciada();

$conexion = conexion($bd_config);
if (!$conexion) {
   header('Location: error.php');
}

if (isset($_GET['token']) && isset($_GET['id'])) {
   $titulo = "Verificacion de nuevo usuario";
   $pagina = "check.php";
   require 'views/header.php';

   $id = $_GET['id'];
   $token = $_GET['token'];

   $usuario = comprobarEn('usuarios','id_usuario',$id,$conexion);
   if ($usuario['verificacion_usuario'] == 0) {
      if ($token === $usuario['password_usuario'] && $id === $usuario['id_usuario']) {
         $cabeza = "Procesando...";
         $carga = '<img src="resources/ajax-loader(7).gif">';
         $scriptCarga = '<script>
                           $(document).ready(function(){
                              $("#ventanaExito").modal("show");
                              $.post("ajax/check.ajax.php", {
                                 id: "'.$id.'",
                                 token: "'.$token.'"
                              }, function(respuestaServidor){
                                 $("#respuesta").html(respuestaServidor);
                                 $("#ventanaExitoVer").modal("show");
                                 $("#ventanaExito").modal("hide");
                              });
                           });
                         </script>';
         echo '<div id="respuesta">';
         require 'views/pop-up.php';
         echo '</div>';
         require 'views/check.view.php';

      } else {
         echo '<div class="jumbotron main">
                  <div class="container">
                     <h2 class="error text-center">¡A ocurrido un error!</h2>
                     <h3>El usuario no existe o el link ha expirado</h3>
                     <h4>Si cree que es un error de la aplicacion favor de comunicarse con el administrador al correo: ' . CORREO . '</h4>
                  </div>
               </div>';
      }
   } else {
      echo '<div class="jumbotron main">
               <div class="container">
                  <h2 class="error text-center">¡A ocurrido un error!</h2>
                  <h3>El usuario ya fue verificado o ha solicitado un cambio de contraseña</h3>
                  <h3>Trate <a href="login.php">Iniciar sesion</a> o solicite una <a href="restore.php">restauracion de contraseña</a></h3>
                  <h4>Si cree que es un error de la aplicacion favor de comunicarse con el administrador al correo: ' . CORREO . '</h4>
               </div>
            </div>';
   }
   require 'views/footer.php';
}else {
   header('Location: index.php');
}
?>
