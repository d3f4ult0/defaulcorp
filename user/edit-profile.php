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
   $id = $_SESSION['id_usuario'];
   $usuario = $_SESSION['nombre_usuario'];
   if (!empty($_POST['nombre'])) {
      $nombre = limpiarDatos($_POST['nombre']);
   } else {
      $exitoCabeza = "¡Algo ha salido mal!";
      $errores .= "<li>Campo <strong>Nombre</strong> no puede estar vacio.</li>";
      $scriptExito = '<script>$(document).ready(function(){$("#ventanaExito").modal("show");});</script>';
   }
   $apellido_pat = ($_POST['apellido-pat']) ? limpiarDatos($_POST['apellido-pat']) : "";
   $apellido_mat = ($_POST['apellido-mat']) ? limpiarDatos($_POST['apellido-mat']) : "";
   $genero = ($_POST['genero']) ? $_POST['genero'] : "";
   $telefono = ($_POST['telefono']) ? limpiarDatos($_POST['telefono']) : "";
   $nacionalidad = ($_POST['nacionalidad']) ? $_POST['nacionalidad'] : "";
   $direccion = ($_POST['direccion']) ? limpiarDatos($_POST['direccion']) : "";
   $ocupacion = ($_POST['ocupacion']) ? limpiarDatos($_POST['ocupacion']) : "";
   $escolaridad = ($_POST['escolaridad']) ? $_POST['escolaridad'] : "";
   $cedula = ($_POST['cedula']) ? limpiarDatos($_POST['cedula']) : "";
   $descripcion = ($_POST['descripcion']) ? $_POST['descripcion'] : "";
   // Comprobar fecha
   $dia = $_POST['dia'];
   $mes = $_POST['mes'];
   $year = $_POST['year'];
   $fecha = $year . '-' . $mes . '-' . $dia;
   // Comprubacion de nueva foto_usuario
   $foto_guardada = $_POST['foto-guardada'];
   $foto_nueva = $_FILES['foto-nueva'];

   if (empty($foto_nueva['name'])) {
      $foto_nueva = $foto_guardada;
   } else {
      $archivo_subido = $blog_config['foto'] . $id . '-' . $foto_nueva['name'];
      move_uploaded_file($foto_nueva['tmp_name'], $archivo_subido);
      $foto_nueva = $id . '-' . $foto_nueva['name'];
   }

   if (empty($errores)) {
      $actualizar_perfil = $conexion->prepare(
         'UPDATE usuarios SET nombre_per_usuario = :nombre,
         apellido_pat_usuario = :apellido_pat,
         apellido_mat_usuario = :apellido_mat,
         fecha_nacimiento_usuario = :fecha,
         genero_usuario = :genero,
         telefono_usuario = :telefono,
         nacionalidad_usuario = :nacionalidad,
         direccion_usuario = :direccion,
         ocupacion_usuario = :ocupacion,
         escolaridad_usuario = :escolaridad,
         cedula_usuario = :cedula,
         descripcion_usuario = :descripcion,
         foto_usuario = :foto_nueva WHERE id_usuario = :id'
      );
      $actualizar_perfil->execute(array(
         ':nombre' => $nombre,
         ':apellido_pat' => $apellido_pat,
         ':apellido_mat' => $apellido_mat,
         ':fecha' => $fecha,
         ':genero' => $genero,
         ':telefono' => $telefono,
         ':nacionalidad' => $nacionalidad,
         ':direccion' => $direccion,
         ':ocupacion' => $ocupacion,
         ':escolaridad' => $escolaridad,
         ':cedula' => $cedula,
         ':descripcion' => $descripcion,
         ':foto_nueva' => $foto_nueva,
         ':id' => $id
      ));
      // Se comprueba que una fila se modifico
      $comprobacion = $actualizar_perfil->rowCount();
      if ($comprobacion == 1) {
         $exitoCabeza = "¡Perfil actualizado!";
         $exito = "<li>Estimado ".nombreCompleto().", tu perfil se actualizo correctamente</li>";
         $scriptExito = '<script>$(document).ready(function(){$("#ventanaExito").modal("show");});</script>';
         $consulta = comprobarEn('usuarios','id_usuario',$id, $conexion);
         $_SESSION = $consulta;
      }else{
         $exitoCabeza = "¡Algo ha salido mal!";
         $errores .= '<li>Hubo un error vuelva a intentarlo</li><li>Ningun cambio realizado</li>';
         $scriptExito = '<script>$(document).ready(function(){$("#ventanaExito").modal("show");});</script>';
      }
   }
}

$timestamp = strtotime($_SESSION['fecha_nacimiento_usuario']);
$dia = date('d', $timestamp);
$mes = date('m', $timestamp) - 1;
$year = date('Y', $timestamp);

$titulo = 'Editar perfil';
$pagina = 'edit-profile.php';
require 'views/header.php';

$verificacion = verificacionUsuario();
if (!empty($verificacion)) {
   echo $verificacion;
}

require 'views/edit-profile.view.php';
require 'views/footer.php';
?>
