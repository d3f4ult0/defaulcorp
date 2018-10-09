<?php
require '../config/config.php';
require '../config/functions.php';

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
  SET password = :pass, ID_ESTATUS = 2
  WHERE id_usuario = :id');
  $ver->execute(array(':pass' => $pass, ':id' => $id));
  $print = getDataFromWhere($connection,"usuario","id_usuario",$id);
  $print = $print[0];
  if ($print['ID_ESTATUS'] == 2) {
    //Cuerpo del mensaje
    $mail = "Ha cambiado su contraseña exitosamente\r\n";
    $mail .= "Ya puede iniciar sesión con normalidad, utilizando su nueva contraseña, desde el siguiente link:\r\n";
    $mail .= "<h2><a href='".LINK."login.php'>".LINK."login.php</a></h2>\r\n";
    $mail .= "Si usted no solicito resstablecer su contraseña comunicarse con el Administrador del sitio al correo ".MAIL."\r\n";
    $mail .= "<h3 style='text-align: center;'>A T E N T A M E N T E</h3>\r\n";
    $mail .= "\r\n";
    $mail .= "\r\n";
    $mail .= "\r\n";
    $mail .= "<h3 style='text-align: center;'>CEO Default CORP</h3>\r\n";
    $mail .= "<h3 style='text-align: center;'>I.C.S. Adrián Cabrera Jacobo</h3>\r\n";
    //Titulo
    $titulo = "Recuperación exitosa en Default-CORP";
    //cabecera
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
    //dirección del remitente
    $headers .= "From: Soporte Default-CORP < ".MAIL." >\r\n";
    //Enviamos el mensaje a tu_dirección_email
    $bool = mail($email,$titulo,$mail,$headers);
    if($bool  == true){
      $answerJSON['registerMes'] = "¡Contraseña cambiada con exito!";
      $answerJSON['registerNum'] = $print['id_usuario'];
    }else{
      $answerJSON['registerNum'] = 0;
      $answerJSON['registerMes'] = "Falla en el Servidor 03 :(";
    }
  }else {
    $answerJSON['registerNum'] = 0;
    $answerJSON['registerMes'] = "Falla en el Servidor 02 :(";
  }
}else {
  $answerJSON['registerNum'] = 0;
  $answerJSON['registerMes'] = "Falla en el Servidor 01 :(";
}
echo json_encode($answerJSON);
?>
