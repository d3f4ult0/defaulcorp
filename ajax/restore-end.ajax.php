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
  SET password = :pass, ID_ESTATUS = 202
  WHERE id_usuario = :id');
  $ver->execute(array(':pass' => $pass, ':id' => $id));
  $print = getDataFromWhere($connection,"usuario","id_usuario",$id);
  $print = $print[0];
  if ($print['ID_ESTATUS'] == 202) {
    //Cuerpo del mensaje
    $mail = "Ha cambiado su contrase&ntilde;a exitosamente<br>";
    $mail .= "Ya puede iniciar sesi&#243;n con normalidad, utilizando su nueva contrase&ntilde;a, desde la siguiente liga:\r\n";
    $mail .= "<h2><a href='".LINK."login.php'>Iniciar sesi&#243;n</a></h2>\r\n";
    $mail .= "Si usted no solicito resstablecer su contrase&ntilde;a comunicarse con el Administrador del sitio al correo ".MAIL."\r\n";
    $mail .= "<br><br>";
    $mail .= "<h3 style='text-align: center;'>A T E N T A M E N T E</h3>\r\n";
    $mail .= "<br><br><br>";
    $mail .= "<h3 style='text-align: center;'>CEO Default CORP</h3>\r\n";
    $mail .= "<h3 style='text-align: center;'>I.C.S. Adri&#225;n Cabrera Jacobo</h3>\r\n";
    //Titulo
    $titulo = "Recuperación exitosa en Default-CORP";
    //cabecera
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
    //dirección del remitente
    $headers .= "From: Soporte Default-CORP < ".MAIL." >\r\n";
    //Enviamos el mensaje a tu_dirección_email
    $bool = mail($print['correo'],$titulo,$mail,$headers);
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
