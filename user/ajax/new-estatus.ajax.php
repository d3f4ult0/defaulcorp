<?php
require '../../config/config.php';
require '../../config/functions.php';

$connection = dbConnection($db_config);
if (!$connection) {
  header('Location: error.php');
}

$answerJSON = array('check' => 0, 'num' => 0, 'error' => "");

if ($_GET['tipo'] != "") {
  $tipo = $_GET['tipo'];

  $gen = $connection->prepare('SELECT * FROM estatus WHERE tipo="'.$tipo.'" ORDER BY id_estatus DESC LIMIT 1');
  $gen->execute();
  print_r($gen);
  if ($gen["id_estatus"]>0) {
    $answerJSON['num'] = $gen["id_estatus"] + 1;
    $answerJSON['check'] = 1;
  } else {
    $answerJSON['error'] = "Problema interno del servidor 1";
    $answerJSON['check'] = 0;
  }
}else {
  $answerJSON['error'] = "Problema interno del servidor 2";
  $answerJSON['check'] = 0;
}
echo json_encode($answerJSON);
?>

<?php
require '../../config/config.php';
require '../../config/functions.php';

$connection = dbConnection($db_config);
if (!$connection) {
  header('Location: error.php');
}

$answerJSON = array('registerMes' => "", 'registerNum' => 0);

if ($_POST['pass'] != "" && $_POST['id'] != "") {
  $pass = $_POST['pass'];
  $pass = token($pass);
  $id = $_POST['id'];

  $ver = $connection->prepare('UPDATE usuario
  SET password = :pass
  WHERE id_usuario = :id');
  $ver->execute(array(':pass' => $pass, ':id' => $id));
  $print = getDataFromWhere($connection,"usuario","id_usuario",$id);
  $print = $print[0];
    $answerJSON['registerMes'] = "¡Contraseña cambiada con exito!";
    $answerJSON['registerNum'] = $print['id_usuario'];
}else {
  $answerJSON['registerNum'] = 0;
  $answerJSON['registerMes'] = "Falla en el Servidor 01 :(";
}
echo json_encode($answerJSON);
?>
