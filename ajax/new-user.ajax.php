<?php
require '../configs/configs.php';
require '../configs/functions.php';

$conexion = conexion($bd_config);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   if (!empty($_POST['usuario'])) {
      $usuario = limpiarDatos($_POST['usuario']);
      $caracteresUsuario = strlen($usuario);
      if ($caracteresUsuario >= 5) {
         $comprobacion = comprobarEn("usuarios","nombre_usuario",$usuario,$conexion);
         if ($comprobacion === false) {
            echo "<span class='glyphicon glyphicon-ok bien'></span>";
         }else {
            echo "<span class='glyphicon glyphicon-remove mal'></span>";
         }
      } else {
         echo "<span class='glyphicon glyphicon-remove mal'></span>";
      }
   }
   if (!empty($_POST['correo'])) {
     if (filter_var($_POST['correo'], FILTER_VALIDATE_EMAIL)) {
        $correo = limpiarDatos($_POST['correo']);
        $comprobacion = comprobarEn("usuarios","correo_usuario",$correo,$conexion);
        if ($comprobacion === false) {
           echo "<span class='glyphicon glyphicon-ok bien'></span>";
        }else {
           echo "<span class='glyphicon glyphicon-remove mal'></span>";
        }
     }else {
       echo "<span class='glyphicon glyphicon-remove mal'></span>";
     }
   }
}
?>
