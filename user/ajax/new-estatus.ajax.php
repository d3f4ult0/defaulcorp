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

  $num = $connection->prepare('SELECT * FROM estatus');
  $num->execute();
  $num->fetchAll();
  // $numSig = $numSig[0];
  echo $num;
  // if ($numSig["id_estatus"]>0) {
  //   $answerJSON['num'] = $numSig["id_estatus"] + 1;
  //   $answerJSON['check'] = 1;
  // } else {
  //   $answerJSON['error'] = "Problema interno del servidor 1";
  //   $answerJSON['check'] = 0;
  // }
}else {
  $answerJSON['error'] = "Problema interno del servidor 2";
  $answerJSON['check'] = 0;
}
echo json_encode($answerJSON);
?>
