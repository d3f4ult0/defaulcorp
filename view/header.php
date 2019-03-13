<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title><?php echo $title;?></title>
  </head>

  <header class="navbar sticky-top navbar-expand-lg navbar-dark sombra-header">
    <a class="navbar-brand" href="index.php">
      <img src="resources/bannerDefaultCORP350x50.png" height="30" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item <?php if ($page == "index.php") {
            echo "active";
          } ?>">
          <a class="nav-link" href="index.php">Inicio <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item <?php if ($page == "new-user.php") {
            echo "active";
          } ?>">
          <a class="nav-link" href="new-user.php">Registrate </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Preguntas Frecuentes
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="quienes.php">¿Quienes somos?</a>
            <a class="dropdown-item" href="test-help.php">¿Por que debes realizar el test?</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="contacto.php">Contacto</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="login.php">Portal del usuario</a>
        </li>
      </ul>
      <!-- <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
      </form> -->
    </div>
  </header>
  <body>
