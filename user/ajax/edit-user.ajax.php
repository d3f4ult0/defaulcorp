<?php
require '../../config/config.php';
require '../../config/functions.php';

$connection = dbConnection($db_config);
if (!$connection) {
  header('Location: error.php');
}

$answerJSON = array('registerMes' => "", 'registerNum' => 0, 'registerUser' => 0);

if ($_POST['id'] != "") {
  $id = $_POST['id'];
  $name = $_POST['name'];
  $genero = $_POST['genero'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];
  $curp = $_POST['curp'];
  $rfc = $_POST['rfc'];

  $ver = $connection->prepare('UPDATE usuario
  SET nombre = :name, genero = :genero, telefono = :phone, direccion = :address, curp = :curp, rfc = :rfc
  WHERE id_usuario = :id');
  $ver->execute(array(
    ':id' => $id,
    ':name' => $name,
    ':genero' =>$genero,
    ':phone' => $phone,
    ':address' => $address,
    ':curp' => $curp,
    ':rfc' => $rfc
  ));
    $answerJSON['registerMes'] = "¡Los datos se actualizaron correctamente!";
    $answerJSON['registerNum'] = 1;
    $answerJSON['registerUser'] = $id;
}else {
  $answerJSON['registerNum'] = 0;
  $answerJSON['registerMes'] = "Falla en el Servidor 01 :(";
}
echo json_encode($answerJSON);
?>
