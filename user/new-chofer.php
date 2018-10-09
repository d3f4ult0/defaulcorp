<?php session_start();
require '../config/config.php';
require '../config/functions.php';
sessionVer();

$connection = dbConnection($db_config);
if (!$connection) {
  header('Location: error.php');
}

$title = "Nuevo chofer";
$page = "new-chofer.php";

include 'view/header.php';
$estatus = getDataFromWhere($connection,'estatus','tipo','C');
if (isset($_GET['id'])) {
  $verUsuario = 1;
  $checkUser = getDataFromWhere($connection,'usuario','id_usuario',$_GET['id']);
  $checkUser = $checkUser[0];
  if ($checkUser['password'] == $_GET['token']) {
    include 'view/new-chofer.view.php';
  } else {
    echo "<h1 style='text-align: center;color: red;'><strong>Error 404</strong></h1><h2>La pagina a la que intenta acceder no esta disponible.<br>O el link es incorrecto, favor de intentarlo mas tarde.<br>Si el problema persiste favor de comunicarse con el administrador del sistema al correo: <strong>".MAIL."</strong>.</h2>";
  }

} else {
  $verUsuario = 0;
  $checkUser = getDataFromWhere($connection,'usuario','id_usuario',$_SESSION['id']);
  $checkUser = $checkUser[0];
  include 'view/new-chofer.view.php';
}
include 'view/modal-ver1.php';
include '../view/footer.php';
include 'verify-status.php';
 ?>
