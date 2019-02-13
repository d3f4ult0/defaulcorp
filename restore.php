<?php session_start();

require 'configs/configs.php';
require 'configs/functions.php';

sesionIniciada();

$conexion = conexion($bd_config);
if (!$conexion) {
   header('Location: error.php');
}

$errores = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   if (!empty($_POST['usuario'])) {
      if (filter_var($_POST['usuario'], FILTER_VALIDATE_EMAIL)) {
         $correo = limpiarDatos($_POST['usuario']);
         $consulta = comprobarEn("usuarios","correo_usuario",$correo,$conexion);
         if (!$consulta) {
              $errores .= '<li>El <strong>correo</strong> ingresado no se encuentra registrado.</li><li>Puede <a href="new-user.php">registrase</a> o verificar su correo</li>';
         }
      }else {
         $usuario = strtolower(limpiarDatos($_POST['usuario']));
         $consulta = comprobarEn('usuarios','nombre_usuario',$usuario,$conexion);
         if (!$consulta) {
            $errores .= '<li>El <strong>usuario</strong> ingresado no se encuentra registrado.</li><li>Si no recuerda su nombre de usuario puede ingresar su <strong>correo</strong></li><li>Puede <a href="new-user.php">registrase</a> o verificar su nombre de usuario</li>';
         }
      }
   }else {
      $errores .= '<li>Ingrese <strong>nombre de usuario</strong> o <strong>correo</strong> para continuar</li>';
   }
   if (empty($errores)) {
      $id = $consulta['id_usuario'];
      $password = $consulta['password_usuario'];
      $correo = $consulta['correo_usuario'];
      $verificar = $conexion->prepare('UPDATE usuarios SET verificacion_usuario = 2 WHERE id_usuario = :id');
      $verificar->execute(array(':id' => $id));
      $comprobacion = $verificar->rowCount();
      if ($comprobacion == 1) {
         //para el envío en formato HTML
         $headers = "MIME-Version: 1.0\r\n";
         $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

         //dirección de respuesta, si queremos que sea distinta que la del remitente
         $headers .= "Reply-To: support.mail@defaultcorp.latitudmegalopolis.com\r\n";

         $asunto = 'Restauracion de contraseña en en Default CORP';
         $cuerpo = '<h2>Ha solicitado restaurar su contraseña</h2><h3>Para restaurar su contraseña favor de ingresar en la siguiente direccion: </h3><br>';
         $cuerpo .= '<a href="';
         $cuerpo .= RUTA;
         $cuerpo .= '/reset.password.php?token=';
         $cuerpo .= $password;
         $cuerpo .= '&id=';
         $cuerpo .= $id;
         $cuerpo .= '"><h1>Recuperar contraseña</h1></a><br>';
         $cuerpo .= '<h4>Si usted no solicito este cambio por favor de notificarlo al correo: <br>';
         $cuerpo .= CORREO;
         $cuerpo .= '</h4>';
         mail($correo, $asunto, $cuerpo, $headers);

         $exitoCabeza = "¡Todo bien!";
         $exito = "<li>Se ha enviado un correo con las instrucciones para recuperar la contraseña a la direccion: <strong>$correo</strong></li><li>No podra <strong>iniciar sesión</strong> asta que recupere su cotraseña</li>";
         $scriptExito = '<script>$(document).ready(function(){$("#ventanaExito").modal("show");});</script>';
      }else {
         $exitoCabeza = "¡Algo ha salido mal!";
         $errores .= "<li style='color:crimson;'>A ocurrido un error inesperado por favor intentarlo mas tarde</li><li>O quizas ya se ha solicitado <strong>restaurar la contraseña</strong> anteriormente</li><li>Puede que el correo se encuentre en la carpeta <strong>spam</strong></li>";
         $scriptExito = '<script>$(document).ready(function(){$("#ventanaExito").modal("show");});</script>';
      }
   }else {
      $exitoCabeza = '¡Algo ha salido mal!';
      $scriptExito = '<script>$(document).ready(function(){$("#ventanaExito").modal("show");});</script>';
   }
}



$titulo = "Recuperar contraseña";
$pagina = "restore.php";

require 'views/header.php';
require 'views/restore.view.php';
require 'views/footer.php';


 ?>
