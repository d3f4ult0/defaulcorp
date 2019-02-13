<?php
require '../configs/configs.php';
require '../configs/functions.php';

$conexion = conexion($bd_config);

// Comprobamos que los datos se mandaron por el metodo POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   if (!empty($_POST['usuario'])) {
      if (filter_var($_POST['usuario'], FILTER_VALIDATE_EMAIL)) {
         $correo = limpiarDatos($_POST['usuario']);
         $consulta = comprobarEn("usuarios","correo_usuario",$correo,$conexion);
         if (!$consulta) {
             echo "<span class='glyphicon glyphicon-remove mal'></span>";
         }else {
            echo "<span class='glyphicon glyphicon-ok bien'></span>";
         }
      }else {
         $usuario = strtolower(limpiarDatos($_POST['usuario']));
         $consulta = comprobarEn('usuarios','nombre_usuario',$usuario,$conexion);
         if (!$consulta) {
            echo "<span class='glyphicon glyphicon-remove mal'></span>";
         }else {
            echo "<span class='glyphicon glyphicon-ok bien'></span>";
         }
      }
   }
}


 ?>
