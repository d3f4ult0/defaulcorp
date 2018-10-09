<?php session_start();
require '../config/config.php';
require '../config/functions.php';
sessionVer();

$connection = dbConnection($db_config);
if (!$connection) {
  header('Location: error.php');
}

$title = "Pruebas";
$page = "temporal.php";

include 'view/header.php';
include 'view/temporal.view.php';
include 'view/modal-ver1.php';
include '../view/footer.php';
include 'verify-status.php';
?>
