<?php session_start();
require '../config/config.php';
require '../config/functions.php';
sessionVer();

$connection = dbConnection($db_config);
if (!$connection) {
  header('Location: error.php');
}

$title = "Listado de Estatus";
$page = "estatus.php";

include 'view/header.php';
rango4($rangoUsuario);
$estatus = getDataFrom($connection,'estatus');
include 'view/estatus.view.php';
include 'view/modal-ver1.php';
include '../view/footer.php';
include 'verify-status.php';
?>
