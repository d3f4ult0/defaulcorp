<?php session_start();
require 'config/config.php';
require 'config/functions.php';
sessionVerOut();

$connection = dbConnection($db_config);
if (!$connection) {
  header('Location: error.php');
}

$title = "Pagina de registro";
$page = "new-user.php";
include 'view/header.php';

include 'view/new-user.view.php';
include 'view/footer.php';
 ?>
