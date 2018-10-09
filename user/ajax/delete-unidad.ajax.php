<?php
require '../../config/config.php';
require '../../config/functions.php';

$connection = dbConnection($db_config);
if (!$connection) {
  header('Location: error.php');
}

$answerJSON = array('registerMes' => "", 'registerNum' => 0, 'mes' => "");

if ($_POST['unidad'] != "" && $_POST['patron'] != "" && $_POST['token'] != "") {
  $unidad = $_POST['unidad'];
  $pass = $_POST['token'];
  $patron= $_POST['patron'];

  $verPatron = getDataFromWhere($connection,'patron','id_patron',$patron);
  if ($verPatron) {
    $verPatron = $verPatron[0];
    $verUsuario = getDataFromWhere($connection,'usuario','id_usuario',$verPatron['ID_USUARIO']);
    if ($verUsuario) {
      $verUsuario = $verUsuario[0];
      if ($pass == $verUsuario['password']) {
        //Se borran los documentos de la unidad
        deleteFromWhere($connection,'documento','ID_UNIDAD',$unidad);
        //Se borran todas las imagenes de la unidad
        deleteFromWhere($connection,'imagen','ID_UNIDAD',$unidad);
        //Se borran la unidad
        deleteFromWhere($connection,'unidad','id_unidad',$unidad);
        $verUnidad = getDataFromWhere($connection,'unidad','id_unidad',$unidad);
        if ($verUnidad) {
          $answerJSON['registerNum'] = 0;
          $answerJSON['registerMes'] = "Falla en el Servidor 04 :(";
          $answerJSON['mes'] = "Error en el Servidor, favor de intentar mas tarde<br>Si el problema persiste favor de comunicarse con el administrador al correo: <strong>".MAIL."</strong>";
        } else {
          $answerJSON['registerNum'] = 1;
          $answerJSON['registerMes'] = "Unidad eliminada correctamente";
          $answerJSON['mes'] = "La unidad <strong>M-".$unidad."</strong> fue eliminada exitosamente, asi como los documentos y fotografias asociadas a ella.";
        }

      } else {
        $answerJSON['registerNum'] = 0;
        $answerJSON['registerMes'] = "Falla en el Servidor 03 :(";
        $answerJSON['mes'] = "Error en el Servidor, favor de intentar mas tarde<br>Si el problema persiste favor de comunicarse con el administrador al correo: <strong>".MAIL."</strong>";
      }

    } else {
      $answerJSON['registerNum'] = 0;
      $answerJSON['registerMes'] = "Falla en el Servidor 02 :(";
      $answerJSON['mes'] = "Error en el Servidor, favor de intentar mas tarde<br>Si el problema persiste favor de comunicarse con el administrador al correo: <strong>".MAIL."</strong>";
    }

  } else {
    $answerJSON['registerNum'] = 0;
    $answerJSON['registerMes'] = "Falla en el Servidor 01 :(";
    $answerJSON['mes'] = "Error en el Servidor, favor de intentar mas tarde<br>Si el problema persiste favor de comunicarse con el administrador al correo: <strong>".MAIL."</strong>";
  }
}
echo json_encode($answerJSON);
?>
