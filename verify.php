<?php
require 'config/config.php';
require 'config/functions.php';

$connection = dbConnection($db_config);
if (!$connection) {
  header('Location: error.php');
}

$title = "Verificacion de correo";
include 'view/header.php';

if (isset($_GET['user']) && isset($_GET['token'])) {
  $user = $_GET['user'];
  $token = $_GET['token'];
  $checkUser = getDataFromWhere($connection,"usuario","id_usuario",$user);
  $checkUser = $checkUser[0];
  if ($checkUser['password'] == $token) {
    if ($checkUser['ID_ESTATUS'] == 2) {
      $message = "<h2>El correo ya fue verificado con exito, no es necesario hacer este proceso nuevamente.<br><br>Ya puede <a href='".LINK."login.php'>iniciar sesión</a><br><br><br><br><br><br><br><br><br><br></h2>";
      include 'view/error.view.php';
    }else {
      $page = "verify.php";
      include 'view/verify.view.php';
    }
  }else {
    $message = "<h2>La pagina a la que intenta accesar no esta disponible o el link es incorrecto.<br><br>Favor de verificar.<br><br>Si el problema persiste por favor contacte con el administrador del sistema al correo: <strong>".MAIL."</strong></h2><br><br><br><br><br><br><br><br><br>";
    include 'view/error.view.php';
  }
}else {
}

include 'view/footer.php';
?>
