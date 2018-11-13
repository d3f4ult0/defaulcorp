<?php
require '../../config/config.php';
require '../../config/functions.php';

$connection = dbConnection($db_config);
if (!$connection) {
  header('Location: error.php');
}
$answerJSON = array('unidadNum' => 0, 'mesTitle' => "", 'mes' => "");

if ($_POST['placas'] != "" && $_POST['serie'] != "" && $_POST['factura'] != "" && $_POST['numero'] != "" && $_POST['fecha'] != "" && $_POST['tipo'] != "" && $_POST['marca'] != "" && $_POST['patron'] != "" && $_POST['estatus'] != "") {
  $placas = $_POST['placas'];
  $placas = clearData($placas);
  $serie = $_POST['serie'];
  $serie = clearData($serie);
  $factura = $_POST['factura'];
  $numero = $_POST['numero'];
  $numero = clearData($numero);
  $fecha = $_POST['fecha'];
  $tipo = $_POST['tipo'];
  $marca = $_POST['marca'];
  $patron = $_POST['patron'];
  $estatus = $_POST['estatus'];

  $verify = getDataFromWhere($connection,'unidad','placas',$placas);
  if ($verify) {
    $answerJSON['unidadNum'] = 0;
    $answerJSON['mesTitle'] = "Falla en el servidor 02";
    $answerJSON['mes'] = "No se pudo dar de alta la unidad, placas repetidas, si el problema persiste contacte con el administrador";
  } else {
    $verify = getDataFromWhere($connection,'unidad','serie',$serie);
    if ($verify) {
      $answerJSON['unidadNum'] = 0;
      $answerJSON['mesTitle'] = "Falla en el servidor 03";
      $answerJSON['mes'] = "No se pudo dar de alta la unidad, numero de serie repetido, si el problema persiste contacte con el administrador";
    } else {
      $newUnidad = $connection->prepare('INSERT INTO unidad (placas,serie,factura,no_factura,fecha,tipo,ID_MARCA,ID_PATRON,ID_ESTATUS)
      VALUES (:placas,:serie,:factura,:numero,:fecha,:tipo,:marca,:patron,:estatus)');
      $newUnidad->execute(array(':placas' => $placas,
      ':serie' => $serie,
      ':factura' => $factura,
      ':numero' => $numero,
      ':fecha' => $fecha,
      ':tipo' => $tipo,
      ':marca' => $marca,
      ':patron' => $patron,
      ':estatus' => $estatus));
      $verUnidad = getDataFromWhere($connection,'unidad','serie',$serie);
      $verUnidad = $verUnidad[0];
      if ($verUnidad) {
        $answerJSON['unidadNum'] = 1;
        $answerJSON['mesTitle'] = "Registro correcto";
        $answerJSON['mes'] = "La unidad con placas: <strong>".$placas."</strong>, se dio de alta en el sistema con el numero <strong>M-".$verUnidad['id_unidad']."</strong><br>Ya se puede visualizar en el listado de unidades, para poder asignarle un turno y chofer.";
      } else {
        $answerJSON['unidadNum'] = 0;
        $answerJSON['mesTitle'] = "Falla en el servidor 04";
        $answerJSON['mes'] = "No se pudo dar de alta la unidad, si el problema persiste contacte con el administrador";
      }
    }
  }
} else {
  $answerJSON['unidadNum'] = 0;
  $answerJSON['mesTitle'] = "Falla en el servidor 01";
  $answerJSON['mes'] = "No se pudo dar de alta la unidad, si el problema persiste contacte con el administrador";
}



echo json_encode($answerJSON);
?>
