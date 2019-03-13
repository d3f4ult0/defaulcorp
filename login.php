<?php session_start();
require 'config/configs.php';
require 'config/functions.php';
sessionVerOut();

$connection = dbConnection($db_config);
if (!$connection) {
  header('Location: error.php');
}

$site = LINK;
$title = "Inicio de sesión";
$page = "login.php";
include 'view/header.php';
include 'view/login.view.php';
include 'view/footer.php';

// $errores = '';
//
// $titulo = 'Iniciar Sesión';
// $pagina = 'login.php';
// require 'views/header.php';
//
// echo '<div class="container main">
//    <div class="row">
//       <ol class="breadcrumb">
//          <li><a href="'.RUTA.'index.php">Inicio</a></li>
//          <li class="active">Inicio de sesión</li>
//       </ol>
//    </div>
//    <div class="row">
//       <section class="col-xs-12 col-md-9">';
//
// require 'views/login.view.php';
//
// echo '</section>';
// require 'views/aside.php';
// echo '</div>
//       </div>';
//
// require 'views/footer.php';

?>
