<?php session_start();

require '../configs/configs.php';
require '../configs/functions.php';

comprobarSesion();

$conexion = conexion($bd_config);
if (!$conexion) {
   header('Location: error.php');
}

estatusSesion($conexion);

if ($_SESSION['tipo_usuario'] != 'Personal') {
   $pacientes = obtenerTodosConCondicion('pacientes','usuario_id',$_SESSION['id_usuario'],$conexion);
}

$titulo = 'Cuestionario de habilidades';
$pagina = 'skill-quiz.php';
require 'views/header.php';

$verificacion = verificacionUsuario();
if (!empty($verificacion)) {
   echo $verificacion;
}

require 'views/skill-quiz.view.php';
require 'views/footer.php';
?>
