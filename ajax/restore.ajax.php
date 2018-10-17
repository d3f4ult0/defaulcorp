<?php
require '../config/config.php';
require '../config/functions.php';

$connection = dbConnection($db_config);
if (!$connection) {
  header('Location: error.php');
}

$answerJSON = array('registerMes' => "", 'registerMail' => "", 'registerNum' => 0);

if ($_POST['email'] != "") {
  $email = $_POST['email'];

  $ver = $connection->prepare('UPDATE usuario
  SET ID_ESTATUS = 203
  WHERE correo = :mail');
  $ver->execute(array(':mail' => $email));
  $print = getDataFromWhere($connection,"usuario","correo",$email);
  $print = $print[0];
  if ($print['ID_ESTATUS'] == 203) {
    //Cuerpo del mensaje
    $mail = "Solicito restablecer su contrase&ntilde;a\r\n";
    $mail .= "Puede cambiar su contrase&ntilde;a dando click en la siguiente liga:\r\n";
    $mail .= "<h2><a href='".LINK."restore-end.php?user=".$print['id_usuario']."&token=".$print['password']."'>Restaurar contrase&ntilde;a</a></h2>\r\n";
    $mail .= "Si usted no solicito restablecer su contrase&ntilde;a, favor de comunicarse con el Administrador del sitio al correo ".MAIL."\r\n";
    $mail .= "<h3 style='text-align: center;'>A T E N T A M E N T E</h3>\r\n";
    $mail .= "\r\n";
    $mail .= "\r\n";
    $mail .= "\r\n";
    $mail .= "<h3 style='text-align: center;'>CEO Default CORP</h3>\r\n";
    $mail .= "<h3 style='text-align: center;'>I.C.S. Adri&#225;n Cabrera Jacobo</h3>\r\n";
    //Titulo
    $titulo = "Cambio de contraseña en Default-CORP";
    //cabecera
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
    //dirección del remitente
    $headers .= "From: Soporte Default-CORP < ".MAIL." >\r\n";
    //Enviamos el mensaje a tu_dirección_email
    $bool = mail($email,$titulo,$mail,$headers);
    if($bool  == true){
      $answerJSON['registerMes'] = "¡Solicitud de recuperación exitosa!";
      $answerJSON['registerMail'] = $print['correo'];
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
