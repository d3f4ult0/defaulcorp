<?php
require '../config/config.php';
require '../config/functions.php';

$connection = dbConnection($db_config);
if (!$connection) {
  header('Location: error.php');
}

$answerJSON = array('registerMes' => "", 'registerUser' => "", 'registerNum' => 0);

if ($_POST['user'] != "" && $_POST['email'] != "" && $_POST['name'] != "" && $_POST['pass'] != "") {
  $user = $_POST['user'];
  $user = clearData($user);
  $user = strtolower($user);
  $name = $_POST['name'];
  $name = clearData($name);
  $email = $_POST['email'];
  $email = clearData($email);
  $email = strtolower($email);
  $phone = $_POST['phone'];
  if ($phone == "") {
    $phone = "No asignado";
  }else {
    $phone = clearData($phone);
  }
  $pass = $_POST['pass'];
  $pass = token($pass);

  $reg = $connection->prepare('INSERT INTO usuario (usuario,nombre,telefono,correo,password,ID_ESTATUS)
  VALUES (:user,:name,:phone,:email,:pass,201)');
  $reg->execute(array(':user' => $user,
  ':name' => $name,
  ':email' => $email,
  ':phone' => $phone,
  ':pass' => $pass));
  $print = getDataFromWhere($connection,"usuario","usuario",$user);
  $print = $print[0];
  if ($print) {
    //Cuerpo del mensaje
    $mail = "Gracias por registrarse en el sitio Default-CORP<br>";
    $mail .= "Por favor de click en la siguiente liga para completar su registro:\r\n";
    $mail .= "<h2><a href='".LINK."verify.php?user=".$print['id_usuario']."&token=".$pass."'>Verificar correo</a></h2>\r\n";
    $mail .= "Si usted no se registro en el sitio, ignorar este mensaje o comunicarse con el Administrador del sitio al correo ".MAIL."\r\n";
    $mail .= "<br><br>";
    $mail .= "<h3 style='text-align: center;'>A T E N T A M E N T E</h3>\r\n";
    $mail .= "<br><br><br>";
    $mail .= "<h3 style='text-align: center;'>CEO Default CORP</h3>\r\n";
    $mail .= "<h3 style='text-align: center;'>I.C.S. Adri&#225;n Cabrera Jacobo</h3>\r\n";
    //Titulo
    $titulo = "Registro en el sitio Default-CORP";
    //cabecera
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
    //dirección del remitente
    $headers .= "From: Soporte Default-CORP < ".MAIL." >\r\n";
    //Enviamos el mensaje a tu_dirección_email
    $bool = mail($email,$titulo,$mail,$headers);
    if($bool == true){
      $answerJSON['registerMes'] = "¡Registrado con exito!";
      $answerJSON['registerUser'] = $print['usuario'];
      $answerJSON['registerNum'] = $print['id_usuario'];
    }else{
      $answerJSON['registerMes'] = "Falla en el Servidor 03 :(";
    }
  }else {
    $answerJSON['registerMes'] = "Falla en el Servidor 02 :(";
  }
}else {
  $answerJSON['registerMes'] = "Falla en el Servidor 01 :(";
}
echo json_encode($answerJSON);
?>
