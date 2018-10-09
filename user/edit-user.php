<?php session_start();
require '../config/config.php';
require '../config/functions.php';
sessionVer();

$connection = dbConnection($db_config);
if (!$connection) {
  header('Location: error.php');
}

$title = "Editar datos";
$page = "edit-user.php";

include 'view/header.php';
if (isset($_GET['id'])) {
  rango4($rangoUsuario);
  $checkUser = getDataFromWhere($connection,'usuario','id_usuario',$_GET['id']);
  $checkUser = $checkUser[0];
  if ($checkUser['password'] == $_GET['token']) {
    include 'view/edit-user.view.php';
  } else {
    echo "<h1 style='text-align: center;color: red;'><strong>Error 404</strong></h1><h2>La pagina a la que intenta acceder no esta disponible.<br>O el link es incorrecto, favor de intentarlo mas tarde.<br>Si el problema persiste favor de comunicarse con el administrador del sistema al correo: <strong>".MAIL."</strong>.</h2>";
  }

} else {
  $checkUser = getDataFromWhere($connection,'usuario','id_usuario',$_SESSION['id']);
  $checkUser = $checkUser[0];
  include 'view/edit-user.view.php';
}
include 'view/modal-ver1.php';
include '../view/footer.php';
include 'verify-status.php';
 ?>
