<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <script src="<?php echo RUTA; ?>js/jquery.min.js" charset="utf-8"></script>
   <title><?php echo $titulo; ?></title>
   <link rel="stylesheet" href="<?php echo RUTA; ?>css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Alegreya+Sans+SC:500,700|Poppins:400,500|Special+Elite" rel="stylesheet">
   <link rel="stylesheet" href="<?php echo RUTA; ?>css/estilos.css">
</head>
<body>
   <header>
      <nav class="navbar navbar-fixed-top barra" role="navigation">
         <div class="container">
            <div class="navbar-header">
               <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu-dc">
                  <span class="sr-only">Menu</span>
                  <span class="glyphicon glyphicon-th icon-menu"></span>
               </button>
               <a href="index.php" class="navbar-brand">
                  <img src="resources/bannerDefaultCORP350x50.png" alt="">
               </a>
            </div>

            <!-- Inicia menu -->
            <div class="collapse navbar-collapse menu-barra" id="menu-dc">
               <ul class="nav navbar-nav navbar-right">
                  <?php if ($pagina == "index.php"): ?>
                     <li class="active"><a>
                  <?php else: ?>
                     <li><a href="<?php echo RUTA; ?>index.php">
                  <?php endif; ?>
                  Inicio</a></li>

                  <?php if ($pagina == "new-user.php"): ?>
                     <li class="active"><a>
                  <?php else: ?>
                     <li><a href="<?php echo RUTA; ?>new-user.php">
                  <?php endif; ?>
                  Nuevo usuario</a></li>

                  <?php if ($pagina == "login.php"): ?>
                     <li class="active"><a>
                  <?php else: ?>
                     <li><a href="#" id="btn-login">
                  <?php endif; ?>
                  Iniciar Sesión</a></li>

                  <!-- <?php if ($pagina == "contacto.php"): ?>
                     <li class="active"><a>
                  <?php else: ?>
                     <li><a href="<?php echo RUTA; ?>contacto.php">
                  <?php endif; ?>
                  Contacto</a></li> -->
               </ul>
            </div>
         </div>
      </nav>
   </header>
