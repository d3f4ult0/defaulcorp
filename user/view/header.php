<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title><?php echo $title;?></title>
  </head>

  <header class="navbar sticky-top navbar-expand-lg navbar-dark sombra-header">
    <a class="navbar-brand" href="index.php">
      <img src="../resources/logo.png" height="30" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <!-- <li class="nav-item <?php if ($page == "index.php") {
            echo "active";
          } ?>">
          <a class="nav-link" href="index.php">Inicio <span class="sr-only">(current)</span></a>
        </li> -->
        <li class="nav-item <?php if ($page == "index.php") {
            echo "active";
          } ?>">
          <a class="nav-link" href="index.php"><?php echo $_SESSION['name']; ?></a>
        </li>
        <li class="nav-item <?php if ($page == "edit-user.php") {
            echo "active";
          } ?>">
          <a class="nav-link" href="edit-user.php">Rango:
            <?php $rangoUsuario = 0;
            $nivel1 = getDataFromWhere($connection,'administrador','ID_USUARIO',$_SESSION['id']);
            if ($nivel1) {
              $nivel1 = $nivel1[0];
              echo $nivel1['puesto'];
            }else {
              $nivel1 = "";
            }
            $nivel2 = getDataFromWhere($connection,'patron','ID_USUARIO',$_SESSION['id']);
            if ($nivel2) {
              if ($nivel1 != "") {
                echo "/";
              }
              $nivel2 = "Patron";
              echo $nivel2;
            }else {
              $nivel2 = "";
            }
            $nivel3 = getDataFromWhere($connection,'chofer','ID_USUARIO',$_SESSION['id']);
            if ($nivel3) {
              if ($nivel1 != "" || $nivel2 != "") {
                echo "/";
              }
              $nivel3 = "Chofer";
              echo $nivel3;
            }else {
              $nivel3 = "";
            }
            if ($nivel1 == "" && $nivel2 == "" && $nivel3 == "") {
              echo "Ninguno";
              $rangoUsuario = 0;
            }
            if ($nivel1 != "") {
              $rangoUsuario = 3;
              if ($nivel1['puesto'] == "CEO") {
                $rangoUsuario = 4;
              }
            }else {
              if ($nivel2 != "") {
                $rangoUsuario = 2;
              }else {
                if ($nivel3 != "") {
                  $rangoUsuario = 1;
                } else {
                  $rangoUsuario = 0;
                }
              }
            }
            ?>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Menu
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php if ($rangoUsuario === 0): ?>
              <a href="new-chofer.php" class="dropdown-item">Pre-Registro Chofer</a>
            <?php endif; ?>
            <?php if ($rangoUsuario >= 1): ?>
              <a href="new-turno.php" class="dropdown-item">Registrar nuevo turno</a>
            <?php endif; ?>
            <?php if ($rangoUsuario >= 2): ?>
              <a href="new-unidad.php?id=<?php echo $_SESSION['id'] ?>&token=<?php echo $_SESSION['token'] ?>" class="dropdown-item">Pre-registrar unidad</a>
              <a href="unidades.php?id=<?php echo $_SESSION['id'] ?>&token=<?php echo $_SESSION['token'] ?>" class="dropdown-item">Mis unidades</a>
              <a href="choferes.php" class="dropdown-item">Listado de choferes</a>
            <?php endif; ?>
            <?php if ($rangoUsuario >= 3): ?>
              <a href="new-patron.php" class="dropdown-item">Registrar nuevo patrón</a>
              <a href="new-unidad.php" class="dropdown-item">Registrar nueva unidad</a>
              <a href="unidades.php" class="dropdown-item">Listado de las unidades</a>
            <?php endif; ?>
            <?php if ($rangoUsuario === 4): ?>
              <a href="users.php" class="dropdown-item">Listado de los usuarios</a>
              <a href="estatus.php" class="dropdown-item">Listado de los estatus</a>
            <?php endif; ?>
            <div class="dropdown-divider"></div>
            <a href="contacto.php" class="dropdown-item">Contacto</a>
            <a href="edit-user.php" class="dropdown-item">Modificar Datos</a>
            <a href="edit-pass.php" class="dropdown-item">Cambiar contraseña</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="close.php">Cerrar Sesión</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><?php echo "Rango: ".$rangoUsuario; ?></a>
        </li>

      </ul>
      <!-- <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
      </form> -->
    </div>
  </header>
  <body>
