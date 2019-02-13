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
   if (empty($_POST['usuario'])) {
      $errores .= '<li>El campo <strong>nombre de usuario</strong> no puede estar vacio</li>';
   }else {
      $usuario = limpiarDatos($_POST['usuario']);
      $caracteresUsuario = strlen($usuario);
      if ($caracteresUsuario >= 5) {
         $comprobacion = comprobarEn("usuarios","nombre_usuario",$usuario,$conexion);
         if (!empty($comprobacion)) {
            $errores .= '<li>El <strong>nombre de usuario</strong> ya se encuentra registrado</li>
                         <li>Puede utilizar alguna de las siguientes recomendaciones:
                            <ul>
                               <li>x'.$usuario.'</li>
                               <li>'.$usuario.'2</li>
                               <li>'.$usuario.'0</li>
                               <li>'.$usuario.'_x</li>
                               <li>'.$usuario.'-1</li>
                            </ul>
                         </li>';
         }
      } else {
         $errores .= '<li>El <strong>nombre de usuario</strong> tiene que ser de un minimo de 5 caracteres</li>';
      }
   }

   if (empty($_POST['correo'])) {
      $errores .= '<li>El campo <strong>correo</strong> no puede estar vacio</li>';
   }else {
      if (filter_var($_POST['correo'], FILTER_VALIDATE_EMAIL)) {
         $correo = limpiarDatos($_POST['correo']);
         $comprobacion = comprobarEn("usuarios","correo_usuario",$correo,$conexion);
         if (!empty($comprobacion)) {
            $errores .= '<li>El <strong>correo</strong> ya se encuentra registrado</li>
                         <li>Si perdio su contraseña puede <a href="restore.php">recuperarla</a></li>';
         }
      }else {
        $errores .= '<li>El <strong>correo</strong> no es valido</li>';
      }
   }

   if ($_POST['correo'] != $_POST['correo2']) {
      $errores .= '<li>Los <strong>correos</strong> no coinciden</li>';
   }

   if (empty($_POST['nombre'])) {
      $errores .= '<li>El campo <strong>nombre</strong> no puede estar vacio</li>';
   } else {
      $nombre = $_POST['nombre'];
   }

   if (empty($_POST['pass'])) {
      $errores .= '<li>El campo <strong>contraseña</strong> no puede estar vacio</li>';
   }else {
      // se comprueba que la contraseña tenga como minimo 5 caracteres
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
      $apellido_pat = ($_POST['apellido-pat']) ? limpiarDatos($_POST['apellido-pat']) : "";
      $apellido_mat = ($_POST['apellido-mat']) ? limpiarDatos($_POST['apellido-mat']) : "";
      $creaUsuario = $conexion->prepare("INSERT INTO usuarios
      (id_usuario,
      fecha_registro_usuario,
      nombre_usuario,
      password_usuario,
      correo_usuario,
      nombre_per_usuario,
      apellido_pat_usuario,
      apellido_mat_usuario,
      foto_usuario,
      tipo_usuario,
      verificacion_usuario,
      creditos_usuario)
      VALUES (NULL,
      CURRENT_TIMESTAMP,
      :usuario,
      :password,
      :correo,
      :nombre,
      :apellido_pat,
      :apellido_mat,
      'default.png',
      'Personal',
      '0',
      '1')");
      $creaUsuario->execute(array(
      ':usuario' => $usuario,
      ':password' => $password,
      ':correo' => $correo,
      ':nombre' => $nombre,
      ':apellido_pat' => $apellido_pat,
      ':apellido_mat' => $apellido_mat
      ));
      $comprobacion = $creaUsuario->rowCount();
      if ($comprobacion == 1) {
         $id = $conexion->lastInsertId();

         $nombreCompleto = $nombre;
         if (!empty($apellido_pat)) {
            $nombre .= ' '. $apellido_pat;
         }
         $nombreCompleto = $nombre;
         if (!empty($apellido_mat)) {
            $nombre .= ' '. $apellido_mat;
         }
         $creaPaciente = $conexion->prepare("INSERT INTO pacientes
         (id_paciente,
         fecha_registro_paciente,
         nombre_completo_paciente,
         foto_paciente,
         usuario_id)
         VALUES (NULL,
         CURRENT_TIMESTAMP,
         :nombreCompleto,
         'default.png',
         :idUsuario)");
         $creaPaciente->execute(array(
            ':nombreCompleto' => $nombreCompleto,
            ':idUsuario' => $id));
         $comprobacion = $creaPaciente->rowCount();
         if ($comprobacion == 1) {
            $idPaciente = $conexion->lastInsertId();
            $actualizarUsuario = $conexion->prepare('UPDATE usuarios SET paciente_id = :id_paciente WHERE id_usuario = :id');
            $actualizarUsuario->execute(array(
               ':id_paciente' => $idPaciente,
               ':id' => $id
            ));
            //para el envío en formato HTML
            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

            //dirección de respuesta, si queremos que sea distinta que la del remitente
            $headers .= "Reply-To: support.mail@defaultcorp.latitudmegalopolis.com\r\n";

            $asunto = 'Verificacion de usuario en ' . SITIO;
            $cuerpo = '<h3>Para verificar su correo favor de ingresar en la siguiente direccion: </h3>\r\n';
            $cuerpo .= '<h1><a href="';
            $cuerpo .= RUTA;
            $cuerpo .= '/check.php?token=';
            $cuerpo .= $password;
            $cuerpo .= '&id=';
            $cuerpo .= $id;
            $cuerpo .= '">Verificar cuenta</a></h1>\r\n';
            $cuerpo .= '<h4>Si usted no solicito este registro por favor de enviar un correo a: \r\n';
            $cuerpo .= CORREO;
            $cuerpo .= '</h4>';
            $cuerpo = wordwrap($cuerpo, 70, "\r\n");
            mail($correo, $asunto, $cuerpo, $headers);

            $exitoCabeza = "¡Registro completado con exito!";
            $exito = "<li>Se a creado con exito el usuario <strong>$usuario</strong></li><li>Ha sido enviado un correo a su cuenta para verificarla</li><li>Favor de <strong>verificar su cuenta</strong></li><li>Una vez verificada su cuenta puede <a href='login.php'>Iniciar Sesión</a> con el usuario <strong>$usuario</strong> o  correo <strong>$correo</strong> y su contraseña</li>";
            $scriptExito = '<script>$(document).ready(function(){$("#ventanaExito").modal("show");});</script>';
         }else {
            $errores = "<li>A ocurrido un error inesperado al crear el paciente</li>";
            $exitoCabeza = '¡Algo ha salido mal!';
            $scriptExito = '<script>$(document).ready(function(){$("#ventanaExito").modal("show");});</script>';
         }
      }else {
         $errores = "<li>A ocurrido un error inesperado al crear el usuario</li>";
         $exitoCabeza = '¡Algo ha salido mal!';
         $scriptExito = '<script>$(document).ready(function(){$("#ventanaExito").modal("show");});</script>';
      }
   }else {
      $exitoCabeza = '¡Algo ha salido mal!';
      $scriptExito = '<script>$(document).ready(function(){$("#ventanaExito").modal("show");});</script>';
   }

}


$titulo = 'Nuevo usuario';
$pagina = 'new-user.php';
require 'views/header.php';
require 'views/new-user.view.php';
require 'views/footer.php';

?>
