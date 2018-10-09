<?php
require '../config/config.php';
require '../config/functions.php';

$connection = dbConnection($db_config);
if (!$connection) {
  header('Location: error.php');
}

$answerJSON = array('registerMes' => "", 'registerNum' => 0);

if ($_POST['name'] != "" && $_POST['pass'] != "") {
  $name = $_POST['name'];
  $name = clearData($name);
  $name = strtolower($name);
  $pass = $_POST['pass'];
  $check =getDataFromWhere($connection,"usuario","correo",$name);
  if ($check) {
    $check = $check[0];
    if (password_verify($pass, $check['password'])) {
      session_start();
      $_SESSION['id'] = $check['id_usuario'];
      $_SESSION['user'] = $check['usuario'];
      $_SESSION['token'] = $check['password'];
      $_SESSION['name'] = $check['nombre'];
      $_SESSION['verify'] = $check['ID_ESTATUS'];
      $answerJSON['registerNum'] = 1;
    } else {
      $answerJSON['registerNum'] = 0;
      $answerJSON['registerMes'] = "Fallo inicio de sesión 03";
    }
  } else {
    $check =getDataFromWhere($connection,"usuario","usuario",$name);
    if ($check) {
      $check = $check[0];
      if (password_verify($pass, $check['password'])) {
        session_start();
        $_SESSION['id'] = $check['id_usuario'];
        $_SESSION['user'] = $check['usuario'];
        $_SESSION['token'] = $check['password'];
        $_SESSION['name'] = $check['nombre'];
        $_SESSION['verify'] = $check['ID_ESTATUS'];
        $answerJSON['registerNum'] = 1;
      } else {
        $answerJSON['registerNum'] = 0;
        $answerJSON['registerMes'] = "Fallo inicio de sesión 04";
      }
    } else {
      $answerJSON['registerNum'] = 0;
      $answerJSON['registerMes'] = "Fallo inicio de sesión 02";
    }

  }

}else {
  $answerJSON['registerNum'] = 0;
  $answerJSON['registerMes'] = "Fallo inicio de sesión 01";
}
echo json_encode($answerJSON);
?>
