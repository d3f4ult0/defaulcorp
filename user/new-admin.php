<?php session_start();
require '../config/config.php';
require '../config/functions.php';
sessionVer();

$connection = dbConnection($db_config);
if (!$connection) {
  header('Location: error.php');
}

$title = "Nuevo trabajador";
$page = "new-admin.php";

include 'view/header.php';
rango4($rangoUsuario);
$usuarios = getDataFromWhere($connection,'usuario','ID_ESTATUS',2);
$estatus = getDataFromWhere($connection,'estatus','tipo','A');
include 'view/new-admin.view.php';
include 'view/modal-ver1.php';
include '../view/footer.php';
include 'verify-status.php';
 ?>
