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
   $exito = '';
   $id = $_POST['id'];
   if (!empty($_POST['nombre'])) {
      $nombre_completo = $_POST['nombre'];
   }else {
      $exitoCabeza = "¡Algo ha salido mal!";
      $errores = "<li>El campo <strong>Nombre</strong> no puede estar vacio</li>";
      $scriptExito = '<script>$(document).ready(function(){$("#ventanaExito").modal("show");});</script>';
   }

   $dia = $_POST['dia'];
   $mes = $_POST['mes'];
   $year = $_POST['year'];
   $fecha = $year . '-' . $mes . '-' . $dia;

   $genero = $_POST['genero'];
   $escolaridad = $_POST['escolaridad'];
   $descripcion = ($_POST['descripcion']) ? $_POST['descripcion'] : "";
   // Comprubacion de nueva foto_usuario
   $foto_guardada = $_POST['foto-guardada'];
   $foto_nueva = $_FILES['foto-nueva'];

   if (empty($foto_nueva['name'])) {
      $foto_nueva = $foto_guardada;
   } else {
      $archivo_subido = $blog_config['foto'] .'paciente-'. $id . '-' . $foto_nueva['name'];
      move_uploaded_file($foto_nueva['tmp_name'], $archivo_subido);
      $foto_nueva = 'paciente-'.$id . '-' . $foto_nueva['name'];
   }

   if (!empty($_POST['usuario-id'])) {
      $idUsuario = $_POST['usuario-id'];
   }else {
      $exitoCabeza = "¡Algo ha salido mal!";
      $errores = "<li>Ha ocurrido un error por favor reinicie su sesion.</li>";
      $scriptExito = '<script>$(document).ready(function(){$("#ventanaExito").modal("show");});</script>';
   }

   if (empty($errores)) {
      $editarPaciente = $conexion->prepare(
         'UPDATE pacientes SET nombre_completo_paciente = :nombre_completo,
         fecha_nacimiento_paciente = :fecha,
         genero_paciente = :genero,
         escolaridad_paciente = :escolaridad,
         descripcion_paciente = :descripcion,
         foto_paciente = :foto
         WHERE id_paciente = :id'
      );
      $editarPaciente->execute(array(
        ':nombre_completo' => $nombre_completo,
        ':fecha' => $fecha,
        ':genero' => $genero,
        ':escolaridad' => $escolaridad,
        ':descripcion' => $descripcion,
        ':foto' => $foto_nueva,
        ':id' => $id
      ));
      $comprobacion = $editarPaciente->rowCount();
      if ($comprobacion == 1) {
         if ($_SESSION['id_usuario'] == $idUsuario) {
            $usuario = comprobarEn('usuarios','id_usuario',$_SESSION['id_usuario'], $conexion);
            $headerPaciente = comprobarEn('pacientes','id_paciente',$_SESSION['paciente_id'],$conexion);
            $paciente = comprobarEn('pacientes','id_paciente',$id,$conexion);
            $exito .= "<li>Estimado ".$paciente['nombre_completo_paciente'].", tu perfil se actualizo correctamente</li>";
         }else {
            $paciente = comprobarEn('pacientes','id_paciente',$id,$conexion);
            $usuario = comprobarEn('usuarios','id_usuario',$idUsuario, $conexion);
            $exito .= "<li>Estimado ".nombreCompleto().", el perfil de <strong>".$paciente['nombre_completo_paciente']."</strong> se actualizo correctamente</li>";
         }
         $exitoCabeza = "¡Perfil actualizado!";
         $scriptExito = '<script>$(document).ready(function(){$("#ventanaExito").modal("show");});</script>';
      }else {
         $exitoCabeza = "¡Algo ha salido mal!";
         $errores .= '<li>Hubo un error vuelva a intentarlo</li><li>Ningun cambio realizado</li>';
         $scriptExito = '<script>$(document).ready(function(){$("#ventanaExito").modal("show");});</script>';
      }
   }
}else {
   if (isset($_GET['token']) && isset($_GET['idPaciente'])) {
      $token = $_GET['token'];
      $idUsuario = $_SESSION['id_usuario'];
      $idPaciente = $_GET['idPaciente'];
      $usuario = comprobarEnDosCampos('usuarios','id_usuario',$idUsuario,'password_usuario',$token,$conexion);
      $idUsuario = $usuario['id_usuario'];
      $paciente = comprobarEnDosCampos('pacientes','id_paciente',$idPaciente,'usuario_id',$idUsuario,$conexion);
      if (empty($paciente)) {
         header('Location: index.php');
      }
   }else {
      header('Location: index.php');
   }
}

$timestamp = strtotime($paciente['fecha_nacimiento_paciente']);
$dia = date('d', $timestamp);
$mes = date('m', $timestamp) - 1;
$year = date('Y', $timestamp);

$titulo = 'Editar perfil de '.$paciente['nombre_completo_paciente'];
$pagina = 'edit-patient.php';
require 'views/header.php';

$verificacion = verificacionUsuario();
if (!empty($verificacion)) {
   echo $verificacion;
}

require 'views/edit-patient.view.php';
require 'views/footer.php';
?>
