<?php
require 'config/config.php';
require 'config/functions.php';

$connection = dbConnection($db_config);
if (!$connection) {
  header('Location: error.php');
}

$title = "Restaurar contraseña";
include 'view/header.php';

if (isset($_GET['user']) && isset($_GET['token'])) {
  $user = $_GET['user'];
  $token = $_GET['token'];
  $checkUser = getDataFromWhere($connection,"usuario","id_usuario",$user);
  $checkUser = $checkUser[0];
  if ($checkUser['password'] == $token) {
    if ($checkUser['ID_ESTATUS'] == 3) {
      $page = "verify.php";
      include 'view/restore-end.view.php';
    }else {
      $message = "<h2>No solicito ninguna recuperación de correo.<br><br>La puede solicitar en <a href='".LINK."restore.php'>recuperar contraseña</a></h2>";
      include 'view/error.view.php';
    }
  }else {
    $message = "<h2>La pagina a la que intenta accesar no esta disponible o el link es incorrecto.<br><br>Favor de verificar.<br><br>Si el problema persiste por favor contacte con el administrador del sistema al correo".MAIL."</h2>";
    include 'view/error.view.php';
  }
}else {
}

include 'view/footer.php';
?>
