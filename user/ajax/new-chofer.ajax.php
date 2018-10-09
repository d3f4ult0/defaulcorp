<?php
require '../../config/config.php';
require '../../config/functions.php';

$connection = dbConnection($db_config);
if (!$connection) {
  header('Location: error.php');
}
$answerJSON = array('num' => 0, 'mesTitle' => "", 'mes' => "");

if ($_POST['id'] != "" && $_POST['identificacion'] != "" && $_POST['numero'] != "" && $_POST['fecha'] != "" && $_POST['licencia'] != "" && $_POST['tarjeton'] != "" && $_POST['estatus'] != "") {
  $id = $_POST['id'];
  $identificacion = $_POST['identificacion'];
  $numero = $_POST['numero'];
  $numero = clearData($numero);
  $licencia = $_POST['licencia'];
  $licencia = clearData($licencia);
  $tarjeton = $_POST['tarjeton'];
  $tarjeton = clearData($tarjeton);
  $fecha = $_POST['fecha'];
  $estatus = $_POST['estatus'];

  $verify = getDataFromWhere($connection,'chofer','ID_USUARIO',$id);
  if ($verify) {
    $answerJSON['num'] = 1;
    $answerJSON['mesTitle'] = "El usuario ya esta registrado";
    $answerJSON['mes'] = "No se puede registrar el usuario 2 veces como chofer.<br>Si cree que es un problema del sistema contacte con el administrador al correo: ".MAIL;
  }else {
    $newChofer = $connection->prepare('INSERT INTO chofer (identificacion,n_identificacion,licencia,tarjeton,v_tarjeton,ID_USUARIO,ID_ESTATUS)
    VALUES (:identificacion,:numero,:licencia,:tarjeton,:fecha,:id,:estatus)');
    $newChofer->execute(array(':identificacion' => $identificacion,
    ':numero' => $numero,
    ':licencia' => $licencia,
    ':tarjeton' => $tarjeton,
    ':fecha' => $fecha,
    ':id' => $id,
    ':estatus' => $estatus));
    $verChofer = getDataFromWhere($connection,'chofer','ID_USUARIO',$id);
    if ($verChofer) {
      $verChofer = $verChofer[0];
      $answerJSON['num'] = 1;
      $answerJSON['mesTitle'] = "Registro completo";
      $answerJSON['mes'] = "El usuario seleccionado se dio de alta exitosamente como chofer y se le asigno el identificador <strong>C-".$verChofer['id_chofer']."</strong>.<br> Ya puede asignarle un turno y unidad al chofer.";
    } else {
      $answerJSON['num'] = 1;
      $answerJSON['mesTitle'] = "<p class='red-text'>Error en el servidor</p>";
      $answerJSON['mes'] = "Ocurrio un error en el servidor 2, favor de intentarlo mas tarde.<br>si el problema persiste favor de contactar con el administrador del sistema al correo: ".MAIL;
    }
  }
}else {
  $answerJSON['num'] = 1;
  $answerJSON['mesTitle'] = "<p class='red-text'>Error en el servidor</p>";
  $answerJSON['mes'] = "Ocurrio un error en el servidor 1, favor de intentarlo mas tarde.<br>si el problema persiste favor de contactar con el administrador del sistema al correo: ".MAIL;
}
echo json_encode($answerJSON);
?>
