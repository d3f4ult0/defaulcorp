<?php
require '../config/config.php';
require '../config/functions.php';

$connection = dbConnection($db_config);
if (!$connection) {
  header('Location: error.php');
}
$answerJSON = array('checkUser' => 0, 'userN' => "", 'checkEmail' => 0, 'emailN' => "");



if ($_GET['userName'] != "") {
  $userName = $_GET['userName'];
  $userName = clearData($userName);
  $userName = strtolower($userName);

  $checkUser = getDataFromWhere($connection,"usuario","usuario",$userName);
  if ($checkUser) {
    $answerJSON['checkUser'] = 0;
    $answerJSON['userN'] = $userName;
    // echo '<p class="red-text">El usuario <b>' . $userName . ' no</b> esta disponible</p>';
  }else {
    $answerJSON['checkUser'] = 1;
    $answerJSON['userN'] = $userName;
    // echo '<p class="green-text">El usuario <b>' . $userName . '</b> esta disponible</p>';
  }
}
if ($_GET['email'] != "") {
  $email = $_GET['email'];
  $email = clearData($email);
  $email = strtolower($email);

  $checkEmail = getDataFromWhere($connection,"usuario","correo",$email);
  if ($checkEmail) {
    $answerJSON['checkEmail'] = 0;
    $answerJSON['emailN'] = $email;
    // echo '<p class="red-text">El correo <b>' . $email . '</b> ya esta asociado a otra cuenta</p>';
  }else {
    $answerJSON['checkEmail'] = 1;
    $answerJSON['emailN'] = $email;
    // echo '<p class="green-text">El correo <b>' . $email . '</b> es correcto</p>';
  }
}

echo json_encode($answerJSON);
?>
