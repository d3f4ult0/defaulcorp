<?php session_start();
require '../config/config.php';
require '../config/functions.php';
sessionVer();

$connection = dbConnection($db_config);
if (!$connection) {
  header('Location: error.php');
}

$title = "Editar unidad M-".$_GET['unidad'];
$page = "edit-unidad.php";

include 'view/header.php';
if (isset($_GET['unidad']) && isset($_GET['patron']) && isset($_GET['token'])) {
  rango3($rangoUsuario);
  $verUnidad = getDataFromWhere($connection,'unidad','id_unidad',$_GET['unidad']);
  if ($verUnidad) {
    $verUnidad = $verUnidad[0];
    $verPatron = getDataFromWhere($connection,'patron','id_patron',$_GET['patron']);
    if ($verPatron) {
      $verPatron = $verPatron[0];
      $verUsuario = getDataFromWhere($connection,'usuario','id_usuario',$verPatron['ID_USUARIO']);
      $verUsuario = $verUsuario[0];
      if ($verUsuario['password'] == $_GET['token']) {
        $patrones = getDataFrom($connection,'patron');
        $marcas = getDataFrom($connection,'marca');
        $estatus = getDataFromWhere($connection,'estatus','tipo','M');
        include 'view/edit-unidad.view.php';
      } else {
        echo "<h1 style='text-align: center;color: red;'><strong>Error 404</strong></h1><h2>La pagina a la que intenta acceder no esta disponible.<br>O el link es incorrecto, favor de intentarlo mas tarde.<br>Si el problema persiste favor de comunicarse con el administrador del sistema al correo: <strong>".MAIL."</strong>.</h2>";
      }
    } else {
      echo "<h1 style='text-align: center;color: red;'><strong>Error 404</strong></h1><h2>La pagina a la que intenta acceder no esta disponible.<br>O el link es incorrecto, favor de intentarlo mas tarde.<br>Si el problema persiste favor de comunicarse con el administrador del sistema al correo: <strong>".MAIL."</strong>.</h2>";
    }
  } else {
    echo "<h1 style='text-align: center;color: red;'><strong>Error 404</strong></h1><h2>La pagina a la que intenta acceder no esta disponible.<br>O el link es incorrecto, favor de intentarlo mas tarde.<br>Si el problema persiste favor de comunicarse con el administrador del sistema al correo: <strong>".MAIL."</strong>.</h2>";
  }
} else {
  echo "<h1 style='text-align: center;color: red;'><strong>Error 404</strong></h1><h2>La pagina a la que intenta acceder no esta disponible.<br>O el link es incorrecto, favor de intentarlo mas tarde.<br>Si el problema persiste favor de comunicarse con el administrador del sistema al correo: <strong>".MAIL."</strong>.</h2>";
}
include 'view/modal-ver1.php';
include '../view/footer.php';
include 'verify-status.php';
 ?>
