<?php
require '../config/config.php';
require '../config/functions.php';

$connection = dbConnection($db_config);
if (!$connection) {
  header('Location: error.php');
}

$answerJSON = array('registerMes' => "", 'registerMail' => "", 'registerNum' => 0);

if ($_POST['number'] != "") {
  $number = $_POST['number'];

  $ver = $connection->prepare('UPDATE usuario
  SET ID_ESTATUS = 2
  WHERE id_usuario = :num');
  $ver->execute(array(':num' => $number));
  $print = getDataFromWhere($connection,"usuario","id_usuario",$number);
  $print = $print[0];
  if ($print['ID_ESTATUS'] == 2) {
    //Cuerpo del mensaje
    $mail = "Su correo fue verificado con exito\r\n";
    $mail .= "Ya puede iniciar sesi&#243;n normalmente desde el siguiente link:\r\n";
    $mail .= "<h2><a href='".LINK."login.php'>Iniciar Sesi&#243;n</a></h2>\r\n";
    $mail .= "Si usted no se registro en el sitio, ignorar este mensaje o comunicarse con el Administrador del sitio al correo ".MAIL."\r\n";
    $mail .= "<h3 style='text-align: center;'>A T E N T A M E N T E</h3>\r\n";
    $mail .= "\r\n";
    $mail .= "\r\n";
    $mail .= "\r\n";
    $mail .= "<h3 style='text-align: center;'>CEO Default CORP</h3>\r\n";
    $mail .= "<h3 style='text-align: center;'>I.C.S. Adri&#225;n Cabrera Jacobo</h3>\r\n";
    //Titulo
    $titulo = "Verificacion en el sitio Default-CORP";
    //cabecera
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
    //dirección del remitente
    $headers .= "From: Soporte Default-CORP < ".MAIL." >\r\n";
    //Enviamos el mensaje a tu_dirección_email
    $bool = mail($print['correo'],$titulo,$mail,$headers);
    if($bool == true){
      $answerJSON['registerMes'] = "¡Registrado con exito!";
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
