<?php
//Creacion de los scripts dinamicos para la verificacion del Estatus
//En caso de que el usuario no ha verificado su correo
if ($_SESSION['verify'] == 201) {
  echo "<script type='text/javascript'>
    var title = document.getElementById('modal-ver-title');
    var mes = document.getElementById('modal-ver-mes');
    title.innerHTML = 'Aun no ha verificado su correo';
    mes.innerHTML = 'Estimado <strong>".$_SESSION['name']."</strong> aun no ha verificado su correo, puede ser que se encuentre en el buzon de SPAM.<br>Si no ha recibido ningun correo favor de comunicarse con el administrador al correo <strong>".MAIL."</strong>.';
    function redirigir(){
      location.href='".LINK."user/close.php';
    }
    $('#modal-ver1').modal({backdrop: 'static', keyboard: false});
    $('#modal-ver1').modal('show');
  </script>";
}
//En caso de que el ususario solicito recuperacion de contraseña
if ($_SESSION['verify'] == 203) {
  echo "<script type='text/javascript'>
    var title = document.getElementById('modal-ver-title');
    var mes = document.getElementById('modal-ver-mes');
    title.innerHTML = 'Cambio de contraseña';
    mes.innerHTML = 'Estimado <strong>".$_SESSION['name']."</strong> solicito recuperar su contraseña, se envio las instrucciones para recuperarla a su correo, puede ser que se encuentre en el buzon de SPAM.<br>Si no ha recibido ningun correo favor de comunicarse con el administrador al correo <strong>".MAIL."</strong>.';
    function redirigir(){
      location.href='".LINK."user/close.php';
    }
    $('#modal-ver1').modal({backdrop: 'static', keyboard: false});
    $('#modal-ver1').modal('show');
  </script>";
}
//Bienvenida al ususario
// if ($_SESSION['verify'] == 202) {
//   echo "<script type='text/javascript'>
//     var title = document.getElementById('modal-ver-title');
//     var mes = document.getElementById('modal-ver-mes');
//     title.innerHTML = '!Bienvenido¡';
//     mes.innerHTML = 'Nos da mucho gusto verte de nuevo <strong>".$_SESSION['name']."</strong>.<br>Actualizaciones: <ul><li>Ninguna</li></ul>';
//     $('#modal-ver1').modal({backdrop: 'static', keyboard: false});
//     $('#modal-ver1').modal('show');
//   </script>";
// }
 ?>
