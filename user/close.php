<?php session_start();

require '../configs/configs.php';
require '../configs/functions.php';

$conexion = conexion($bd_config);
if (!$conexion) {
   header('Location: error.php');
}
$idSesion = $_SESSION['sesion_id'];
$cerrarSesion = $conexion->prepare('UPDATE sesiones SET estatus_sesion = 0 WHERE id_sesion = :id');
$cerrarSesion->execute(array(':id' => $idSesion));
$comprobacion = $cerrarSesion->rowCount();
if ($comprobacion == 1) {
   session_destroy();
   $_SESSION = array();
   header('Location: ' . RUTA . 'login.php');
   die();
}
?>
