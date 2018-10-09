<?php
require '../../config/config.php';
require '../../config/functions.php';

$connection = dbConnection($db_config);
if (!$connection) {
  header('Location: error.php');
}
$answerJSON = array('check' => 0, 'data' => "");



if ($_GET['placas'] != "") {
  $placas = $_GET['placas'];
  $placas = clearData($placas);

  $chechUnidad = getDataFromWhere($connection,"unidad","placas",$placas);
  if ($chechUnidad) {
    $answerJSON['check'] = 0;
    $answerJSON['data'] = $placas;
    // echo '<p class="red-text">El usuario <b>' . $userName . ' no</b> esta disponible</p>';
  }else {
    $answerJSON['check'] = 1;
    $answerJSON['data'] = $placas;
    // echo '<p class="green-text">El usuario <b>' . $userName . '</b> esta disponible</p>';
  }
}
if ($_GET['serie'] != "") {
  $serie = $_GET['serie'];
  $serie = clearData($serie);

  $checkUnidad = getDataFromWhere($connection,"unidad","serie",$serie);
  if ($checkUnidad) {
    $answerJSON['check'] = 0;
    $answerJSON['data'] = $serie;
    // echo '<p class="red-text">El correo <b>' . $email . '</b> ya esta asociado a otra cuenta</p>';
  }else {
    $answerJSON['check'] = 1;
    $answerJSON['data'] = $serie;
    // echo '<p class="green-text">El correo <b>' . $email . '</b> es correcto</p>';
  }
}

echo json_encode($answerJSON);
?>
