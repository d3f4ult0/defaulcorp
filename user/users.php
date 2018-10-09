<?php session_start();
require '../config/config.php';
require '../config/functions.php';
sessionVer();

$connection = dbConnection($db_config);
if (!$connection) {
  header('Location: error.php');
}

$title = "Usuarios";
$page = "users.php";

include 'view/header.php';
rango4($rangoUsuario);
$usuarios = getDataFrom($connection,'usuario');
include 'view/users.view.php';
include 'view/modal-ver1.php';
include '../view/footer.php';
include 'verify-status.php';
 ?>
