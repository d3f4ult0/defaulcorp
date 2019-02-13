<?php session_start();

require 'configs/configs.php';
require 'configs/functions.php';

sesionIniciada();

$conexion = conexion($bd_config);
if (!$conexion) {
   header('Location: error.php');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   $errores = '';
   $titulo = "Cambiar contraseña";
   $pagina = "reset-password.php";
   require 'views/header.php';

   if (empty($_POST['pass'])) {
      $errores .= '<li>Por favor ingrese su nueva <strong>contraseña</strong></li>';
   }else {
      $caracteresPass = strlen($_POST['pass']);
      if ($caracteresPass >= 5) {
         //  Se hashea la contraseña
          if ($_POST['pass'] === $_POST['pass2']) {
            $password = hash('sha512', $_POST['pass']);
            $password = token($password);
          }else {
            $errores .= '<li>Las <strong>contraseñas</strong> no coinciden</li>';
          }
      } else {
         $errores .= '<li>La <strong>contraseña</strong> tiene que ser de un minimo de 5 caracteres</li>';
      }
   }

   if (empty($errores)) {
      $id = $_POST['id'];
      $usuario = $_POST['nombre'];
      $correo = $_POST['correo'];

      $actualizarPass = $conexion->prepare('UPDATE usuarios SET password_usuario = :pass , verificacion_usuario = 1 WHERE id_usuario = :id');
      $actualizarPass->execute(array(
         ':pass' => $password,
         ':id' => $id
      ));
      $comprobacion = $actualizarPass->rowCount();
      if ($comprobacion == 1) {
         echo '<div class="jumbotron main">
                  <div class="container">
                     <h1 class="text-center">¡Contraseña actualizada con exito!</h1>
                     <h2>La contraseña fue cambiada con exito, ya puedes <a href="login.php">iniciar sesión</a> con el usuario <strong>'.$usuario.'</strong> o el correo <strong>'.$correo.'</strong> y tu nueva contraseña</h2>
                     <h5 class="text-right">DefaultCORP© Abril-2017</h5>
                  </div>
               </div>';
         $exitoCabeza = '¡Contraseña actualizada con exito!';
         $exito = '<li>La contraseña fue cambiada con exito</li><li>Ya puedes <a href="login.php">iniciar sesión</a> con el usuario <strong>'.$usuario.'</strong> o el correo <strong>'.$correo.'</strong> y tu nueva contraseña</li>';
         echo $scriptExito = '<script>$(document).ready(function(){
                                          $("#ventanaExito").modal("show");
                                          $("#entendido").click(function(){
                                             $("#ventanaExito").modal("hide");
                                          });
                                       });
                              </script>';
         require 'views/pop-up.php';

      }else {
         echo '<div class="jumbotron main">
                  <div class="container">
                     <h2 class="error text-center">¡A ocurrido un error!</h2>
                     <h3>A ocurrido un error inesperado favor de intentarlo mas tarde, si el error persiste puede ponerse en contacto con el administrador al correo: <strong>'.CORREO.'</strong></h3>
                     <h5 class="text-right">DefaultCORP© Abril-2017</h5>
                  </div>
               </div>';
      }

   } else {
      $id = $_POST['id'];
      $usuario = comprobarEn('usuarios','id_usuario',$id,$conexion);
      $exitoCabeza = '¡Algo ha salido mal!';
      $scriptExito = '<script>$(document).ready(function(){$("#ventanaExito").modal("show");});</script>';
      require 'views/reset-password.view.php';
   }


   require 'views/footer.php';

}else {
   if (isset($_GET['token']) && isset($_GET['id'])) {
      $titulo = "Cambiar contraseña";
      $pagina = "reset-password.php";
      require 'views/header.php';

      $id = $_GET['id'];
      $token = $_GET['token'];
      $usuario = comprobarEn('usuarios','id_usuario',$id,$conexion);
      if ($usuario['verificacion_usuario'] == 2) {
         if ($token === $usuario['password_usuario'] && $id === $usuario['id_usuario']) {
            require 'views/reset-password.view.php';

         } else {
            echo '<div class="jumbotron main">
                     <div class="container">
                        <h2 class="error text-center">¡A ocurrido un error!</h2>
                        <h3>El usuario no solicito un cambio de contraseña o el link ha expirado</h3>
                        <h3>Puede solicitar <a href="restore.php">restaurar contraseña olvidada</a></h3>
                        <h4>Si cree que es un error de la aplicacion favor de comunicarse con el administrador al correo: ' . CORREO . '</h4>
                     </div>
                  </div>';
         }
      } else {
         echo '<div class="jumbotron main">
                  <div class="container">
                     <h2 class="error text-center">¡A ocurrido un error!</h2>
                     <h3>El usuario no solicito un cambio de contraseña o ha cambiado su contraseña con exito</h3>
                     <h3>Trate <a href="login.php">Iniciar sesion</a> o solicite nuevamente <a href="restore.php">restaurar contraseña</a></h3>
                     <h4>Si cree que es un error de la aplicacion favor de comunicarse con el administrador al correo: ' . CORREO . '</h4>
                  </div>
               </div>';
      }
      require 'views/footer.php';

   }else {
      header('Location: index.php');
   }
}


?>
