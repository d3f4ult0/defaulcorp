<?php session_start();
require 'config/config.php';
require 'config/functions.php';
sessionVerOut();

$connection = dbConnection($db_config);
if (!$connection) {
  header('Location: error.php');
}
$site = LINK;
$title = "Inicio de sesión";
$page = "login.php";
include 'view/header.php';
include 'view/login.view.php';
include 'view/footer.php';
 ?>
