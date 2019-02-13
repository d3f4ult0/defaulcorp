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
               <a href="<?php echo RUTA; ?>user/index.php" class="navbar-brand texto-logo">
                  <?php if ($_SESSION['tipo_usuario'] == 'Personal'): ?>
                     <?php $headerPaciente = comprobarEn('pacientes','id_paciente',$_SESSION['paciente_id'],$conexion); ?>
                     <p><img src="<?php echo RUTA . "user/profile_picture/" . $headerPaciente['foto_paciente']; ?>" alt="" width="42" height="42" class="foto-perfil"> <?php echo $headerPaciente['nombre_completo_paciente']; ?></p>
                  <?php else: ?>
                     <p><img src="<?php echo RUTA . "user/profile_picture/" . $_SESSION['foto_usuario']; ?>" alt="" width="42" height="42" class="foto-perfil"> <?php echo $_SESSION['nombre_usuario']; ?></p>
                  <?php endif; ?>
               </a>
            </div>

            <!-- Inicia menu -->
            <div class="collapse navbar-collapse menu-barra" id="menu-dc">
               <ul class="nav navbar-nav navbar-right">
                  <!-- <?php if ($pagina == "index.php"): ?>
                     <li class="active"><a>
                  <?php else: ?>
                     <li><a href="<?php echo RUTA; ?>user/index.php">
                  <?php endif; ?>
                  Inicio</a></li> -->

                  <?php if ($pagina == "credits.php"): ?>
                     <li class="active"><a>
                  <?php else: ?>
                     <li><a href="<?php echo RUTA; ?>user/credits.php">
                  <?php endif; ?>
                  Creditos <span class="badge"><?php echo $_SESSION['creditos_usuario']; ?></span></a></li>

                  <li><a href="<?php echo RUTA; ?>user/close.php">Cerrar sesión</a></li>
               </ul>
            </div>
         </div>
      </nav>
   </header>
