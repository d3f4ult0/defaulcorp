<?php session_start();

require 'configs/configs.php';
require 'configs/functions.php';

sesionIniciada();

$conexion = conexion($bd_config);
if (!$conexion) {
   header('Location: error.php');
}
$errores = '';


$titulo = 'Iniciar Sesión';
$pagina = 'login.php';
require 'views/header.php';

echo '<div class="container main">
   <div class="row">
      <ol class="breadcrumb">
         <li><a href="'.RUTA.'index.php">Inicio</a></li>
         <li class="active">Inicio de sesión</li>
      </ol>
   </div>
   <div class="row">
      <section class="col-xs-12 col-md-9">';

require 'views/login.view.php';

echo '</section>';
require 'views/aside.php';
echo '</div>
      </div>';

require 'views/footer.php';

?>
