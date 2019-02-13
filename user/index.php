<?php session_start();

require '../configs/configs.php';
require '../configs/functions.php';

comprobarSesion();

$conexion = conexion($bd_config);
if (!$conexion) {
   header('Location: error.php');
}

$estatusSesion = comprobarEn('sesiones','id_sesion',$_SESSION['sesion_id'],$conexion);

$titulo = 'Panel de usuario ' . $_SESSION['nombre_usuario'];
$pagina = 'index.php';
require 'views/header.php';

$verificacion = verificacionUsuario();
if (!empty($verificacion)) {
   echo $verificacion;
}

require 'views/index.view.php';
require 'views/footer.php';
?>
