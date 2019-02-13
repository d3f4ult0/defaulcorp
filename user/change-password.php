<?php session_start();

require '../configs/configs.php';
require '../configs/functions.php';

comprobarSesion();

$conexion = conexion($bd_config);
if (!$conexion) {
   header('Location: error.php');
}

estatusSesion($conexion);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   $errores = '';
   $scriptCambio = '<script>$(document).ready(function(){
                                    $("#ventanaExito").modal("show");
                                    $("#entendido").click(function(){
                                       $("#ventanaExito").modal("hide");
                                    });
                                 });
                     </script>';

   if (empty($_POST['pass'])) {
      $errores .= '<li>Por favor ingrese su nueva <strong>contraseña</strong></li>';
      echo $scriptCambio;
   }else {
      $caracteresPass = strlen($_POST['pass']);
      if ($caracteresPass >= 5) {
         //  Se hashea la contraseña
          if ($_POST['pass'] === $_POST['pass2']) {
            $password = hash('sha512', $_POST['pass']);
            $password = token($password);
          }else {
            $errores .= '<li>Las <strong>contraseñas</strong> no coinciden</li>';
            echo $scriptCambio;
          }
      } else {
         $errores .= '<li>La <strong>contraseña</strong> tiene que ser de un minimo de 5 caracteres</li>';
         echo $scriptCambio;
      }
   }

   if (empty($errores)) {
      $id = $_SESSION['id_usuario'];

      $actualizarPass = $conexion->prepare('UPDATE usuarios SET password_usuario = :pass WHERE id_usuario = :id');
      $actualizarPass->execute(array(
         ':pass' => $password,
         ':id' => $id
      ));
      $comprobacion = $actualizarPass->rowCount();
      if ($comprobacion == 1) {
         echo '<div class="jumbotron main">
                  <div class="container">
                     <h1 class="text-center">¡Contraseña cambiada con exito!</h1>
                     <h2>La contraseña fue cambiada con exito</h2>
                     <h5 class="text-right">DefaultCORP© Abril-2017</h5>
                  </div>
               </div>';
         $cambioCabeza = '¡Contraseña actualizada con exito!';
         $cambio = '<li>La contraseña fue cambiada con exito</li>';
         echo $scriptCambio;

      }else {
         echo '<div class="jumbotron main">
                  <div class="container">
                     <h2 class="error text-center">¡A ocurrido un error!</h2>
                     <h3>A ocurrido un error inesperado favor de intentarlo mas tarde, si el error persiste puede ponerse en contacto con el administrador al correo: <strong>'.CORREO.'</strong></h3>
                     <h5 class="text-right">DefaultCORP© Abril-2017</h5>
                  </div>
               </div>';
      }

   }
}
$titulo = 'Cambiar contraseña';
$pagina = 'change-password.php';
require 'views/header.php';

$verificacion = verificacionUsuario();
if (!empty($verificacion)) {
   echo $verificacion;
}

require 'views/change-password.view.php';
require 'views/footer.php';
?>
