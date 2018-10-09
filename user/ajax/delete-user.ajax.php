<?php
require '../../config/config.php';
require '../../config/functions.php';

$connection = dbConnection($db_config);
if (!$connection) {
  header('Location: error.php');
}

$answerJSON = array('registerMes' => "", 'registerNum' => 0, 'mes' => "");

if ($_POST['token'] != "" && $_POST['id'] != "") {
  $pass = $_POST['token'];
  $id = $_POST['id'];

  //Comprobar si es administrador
  $admin = getDataFromWhere($connection,'administrador','ID_USUARIO',$id);
  if ($admin) {
    $admin = $admin[0];
    //Se borran los documentos del trabajador
    deleteFromWhere($connection,'documento','ID_ADMINISTRADOR',$admin['id_administrador']);
    //Se borran todas las imagenes del trabajador
    deleteFromWhere($connection,'imagen','ID_ADMINISTRADOR',$admin['id_administrador']);
    //Se borran los permisos del trabajador
    deleteFromWhere($connection,'administrador','ID_USUARIO',$id);
  }
  //Comprobar si es patron
  $patron = getDataFromWhere($connection,'patron','ID_USUARIO',$id);
  if ($patron) {
    $patron = $patron[0];
    //Se borran los documentos del patron
    deleteFromWhere($connection,'documento','ID_PATRON',$patron['id_patron']);
    //Se borran todas las imagenes del patron
    deleteFromWhere($connection,'imagen','ID_PATRON',$patron['id_patron']);
    //Se borra las unidades del patron
    deleteFromWhere($connection,'unidad','ID_PATRON',$patron['id_patron']);
    //Se borran los permisos del patron
    deleteFromWhere($connection,'patron','ID_USUARIO',$id);
  }
  //Comprobar si es chofer
  $chofer = getDataFromWhere($connection,'chofer','ID_USUARIO',$id);
  if ($chofer) {
    $chofer = $chofer[0];
    //Se borran los documentos del chofer
    deleteFromWhere($connection,'documento','ID_chofer',$chofer['id_chofer']);
    //Se borran todas las imagenes del chofer
    deleteFromWhere($connection,'imagen','ID_chofer',$chofer['id_chofer']);
    //Se borra los turnos del chofer
    deleteFromWhere($connection,'turno','ID_chofer',$chofer['id_chofer']);
    //Se borran los permisos del chofeer
    deleteFromWhere($connection,'chofer','ID_USUARIO',$id);
  }

  deleteFromWhere($connection,'usuario','id_usuario',$id);
  $ver = getDataFromWhere($connection,'usuario','id_usuario',$id);
  if ($ver) {
    $answerJSON['registerNum'] = 0;
    $answerJSON['registerMes'] = "Falla en el Servidor 03 :(";
    $answerJSON['mes'] = "Error en el Servidor, favor de intentar mas tarde<br>Si el problema persiste favor de comunicarse con el administrador al correo: <strong>".MAIL."</strong>";
  } else {
    $answerJSON['registerMes'] = "¡Se elimino el usuario!";
    $answerJSON['registerNum'] = 1;
    $answerJSON['mes'] = "El usuario <strong>U-".$id."</strong> fue eliminado con exito.";
  }
}else {
  $answerJSON['registerNum'] = 0;
  $answerJSON['registerMes'] = "Falla en el Servidor 01 :(";
  $answerJSON['mes'] = "Error en el Servidor, favor de intentar mas tarde<br>Si el problema persiste favor de comunicarse con el administrador al correo: <strong>".MAIL."</strong>";
}
echo json_encode($answerJSON);
?>
