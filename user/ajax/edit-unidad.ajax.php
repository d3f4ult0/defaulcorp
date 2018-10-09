<?php
require '../../config/config.php';
require '../../config/functions.php';

$connection = dbConnection($db_config);
if (!$connection) {
  header('Location: error.php');
}

$answerJSON = array('registerMes' => "", 'registerNum' => 0);

if ($_POST['id'] != "") {
  $id = $_POST['id'];
  $serie = $_POST['serie'];
  $placas = $_POST['placas'];
  $tipoFactura = $_POST['tipoFactura'];
  $factura = $_POST['factura'];
  $fecha = $_POST['fecha'];
  $tipo = $_POST['tipo'];
  $marca = $_POST['marca'];
  $patron = $_POST['patron'];
  $estatus = $_POST['estatus'];

  $ver = $connection->prepare('UPDATE unidad
  SET placas = :placas, serie = :serie, factura = :tipoFactura, no_factura = :factura, fecha = :fecha, tipo = :tipo, ID_MARCA = :marca, ID_PATRON = :patron, ID_ESTATUS = :estatus
  WHERE id_unidad = :id');
  $ver->execute(array(
    ':id' => $id,
    ':serie' => $serie,
    ':placas' => $placas,
    ':tipoFactura' => $tipoFactura,
    ':factura' => $factura,
    ':fecha' => $fecha,
    ':tipo' => $tipo,
    ':marca' => $marca,
    ':patron' => $patron,
    ':estatus' => $estatus,
  ));
    $answerJSON['registerMes'] = "¡Los datos se actualizaron correctamente!";
    $answerJSON['registerNum'] = 1;
}else {
  $answerJSON['registerNum'] = 0;
  $answerJSON['registerMes'] = "Falla en el Servidor 01 :(";
}
echo json_encode($answerJSON);
?>
