<?php session_start();

require '../configs/configs.php';
require '../configs/functions.php';

comprobarSesion();

$conexion = conexion($bd_config);
if (!$conexion) {
   header('Location: error.php');
}

estatusSesion($conexion);

$titulo = 'Resultados anteriores';
$pagina = 'results-patient.php';
require 'views/header.php';

$verificacion = verificacionUsuario();
if (!empty($verificacion)) {
   echo $verificacion;
}

require 'views/results-patient.view.php';
require 'views/footer.php';
?>
