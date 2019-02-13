<?php session_start();

require '../configs/configs.php';
require '../configs/functions.php';

$conexion = conexion($bd_config);

sesionIniciada();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   if (!empty($_POST['usuario'])) {
       if (filter_var($_POST['usuario'], FILTER_VALIDATE_EMAIL)) {
          $correo = limpiarDatos($_POST['usuario']);
          $consulta = comprobarEn("usuarios","correo_usuario",$correo,$conexion);
          if (!$consulta) {
              echo '<div class="alert alert-danger"><button class="close" data-dismiss="alert"><span>&times;</span></button><ul><li>El <strong>correo</strong> no se encuentra registrado</li></ul></div>';
          }else {
             if (!empty($_POST['password'])) {
               $password = hash('sha512',$_POST['password']);
               if (password_verify($password, $consulta['password_usuario'])) {
                  $id = $consulta['id_usuario'];
                  $nuevaSesion = $conexion->prepare('INSERT INTO sesiones
                     (id_sesion,
                     fecha_sesion,
                     estatus_sesion,
                     usuario_id)
                     VALUES
                     (NULL,
                     CURRENT_TIMESTAMP,
                     1,
                     :id)');
                  $nuevaSesion->execute(array(':id' => $id));
                  $comprobacion = $nuevaSesion->rowCount();
                  if ($comprobacion == 1) {
                     $idSesion = $conexion->lastInsertId();
                     $sesionUsuario = $conexion->prepare('UPDATE usuarios SET sesion_id = :nueva WHERE id_usuario = :id');
                     $sesionUsuario->execute(array(':nueva' => $idSesion, ':id' => $id));
                     $comprobacion = $sesionUsuario->rowCount();
                     if ($comprobacion == 1) {
                        $consulta = comprobarEn("usuarios","id_usuario",$id,$conexion);
                        $_SESSION = $consulta;
                        echo '<div class="alert alert-success"><ul><li>Iniciando sesión <img src="resources/ajax-loader(1).gif"></li></ul></div>';
                     }
                  }
               }else {
                 echo '<div class="alert alert-danger"><button class="close" data-dismiss="alert"><span>&times;</span></button><ul><li>Datos <strong>incorrectos</strong> favor de revisar</li><li>Si perdio o no recuerda su contraseña puede <a href="restore.php">recuperar contraseña</a></li></ul></div>';
               }
             }else{
               echo '<div class="alert alert-danger"><button class="close" data-dismiss="alert"><span>&times;</span></button><ul><li>Ingrese <strong>contraseña</strong> para continuar</li></ul></div>';
             }
          }
       }else {
          $usuario = strtolower(limpiarDatos($_POST['usuario']));
          $consulta = comprobarEn('usuarios','nombre_usuario',$usuario,$conexion);
          if (!$consulta) {
             echo '<div class="alert alert-danger"><button class="close" data-dismiss="alert"><span>&times;</span></button><ul><li>Datos <strong>incorrectos</strong> favor de revisar</li><li>Si perdio o no recuerda su contraseña puede <a href="restore.php">recuperar contraseña</a></li></ul></div>';

          }else {
             if (!empty($_POST['password'])) {
               $password = hash('sha512',$_POST['password']);
               if (password_verify($password, $consulta['password_usuario'])) {
                  $id = $consulta['id_usuario'];
                  $nuevaSesion = $conexion->prepare('INSERT INTO sesiones
                     (id_sesion,
                     fecha_sesion,
                     estatus_sesion,
                     usuario_id)
                     VALUES
                     (NULL,
                     CURRENT_TIMESTAMP,
                     1,
                     :id)');
                  $nuevaSesion->execute(array(':id' => $id));
                  $comprobacion = $nuevaSesion->rowCount();
                  if ($comprobacion == 1) {
                     $idSesion = $conexion->lastInsertId();
                     $sesionUsuario = $conexion->prepare('UPDATE usuarios SET sesion_id = :nueva WHERE id_usuario = :id');
                     $sesionUsuario->execute(array(':nueva' => $idSesion, ':id' => $id));
                     $comprobacion = $sesionUsuario->rowCount();
                     if ($comprobacion == 1) {
                        $consulta = comprobarEn("usuarios","id_usuario",$id,$conexion);
                        $_SESSION = $consulta;
                        echo '<div class="alert alert-success"><ul><li>Iniciando sesión <img src="resources/ajax-loader(1).gif"></li></ul></div>';
                     }
                  }
               }else {
                  echo '<div class="alert alert-danger"><button class="close" data-dismiss="alert"><span>&times;</span></button><ul><li>Datos <strong>incorrectos</strong> favor de revisar</li><li>Si perdio o no recuerda su contraseña puede <a href="restore.php">recuperar contraseña</a></li></ul></div>';
               }
             }else{
               echo '<div class="alert alert-danger"><button class="close" data-dismiss="alert"><span>&times;</span></button><ul><li>Ingrese <strong>contraseña</strong> para continuar</li></ul></div>';
             }
          }
       }
   }else {
     echo '<div class="alert alert-danger"><button class="close" data-dismiss="alert"><span>&times;</span></button><ul><li>Ingrese <strong>nombre o correo</strong> para continuar</li></ul></div>';
   }
}
?>
