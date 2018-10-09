<?php
require 'config/config.php';
require 'config/functions.php';

$connection = dbConnection($db_config);
if (!$connection) {
  header('Location: error.php');
}

$title = "Restaurar contraseña";
$page = "restore.php";
include 'view/header.php';
include 'view/restore.view.php';
include 'view/footer.php';
 ?>
