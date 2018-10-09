<?php session_start();
require '../config/config.php';
require '../config/functions.php';
sessionVer();

$connection = dbConnection($db_config);
if (!$connection) {
  header('Location: error.php');
}

$title = "Cambio de contraseña";
$page = "edit-pass.php";

include 'view/header.php';
$checkUser = getDataFromWhere($connection,'usuario','id_usuario',$_SESSION['id']);
$checkUser = $checkUser[0];
include 'view/edit-pass.view.php';
include 'view/modal-ver1.php';
include '../view/footer.php';
include 'verify-status.php';
?>
