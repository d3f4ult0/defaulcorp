<div class="col-12 col-md-4 col-lg-3">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12 table-responsive caja-principal" style="height: 650px;">
        <!-- <h1 class="text-center">Menu</h1>
        <div class="b-bottom"></div> -->
        <?php $patron = getDataFromWhere($connection,'patron','ID_USUARIO',$_SESSION['id']);
        $patron = $patron[0];
        $nMisUnidades = $connection->prepare('SELECT * FROM unidad WHERE ID_PATRON = :id_patron');
        $nMisUnidades->execute(array(':id_patron' => $patron['id_patron']));
        $nMisUnidades = $nMisUnidades->rowCount();
        $nUnidades = $connection->prepare('SELECT * FROM unidad');
        $nUnidades->execute();
        $nUnidades = $nUnidades->rowCount();
        $nUsuarios = $connection->prepare('SELECT * FROM usuario');
        $nUsuarios->execute();
        $nUsuarios = $nUsuarios->rowCount();
        $nEstatus = $connection->prepare('SELECT * FROM estatus');
        $nEstatus->execute();
        $nEstatus = $nEstatus->rowCount();?>
        <div class="list-group list-group-flush menu-aside">
          <a href="index.php" class="list-group-item list-group-item-action <?php if ($page == "index.php") {
              echo "active";
            } ?>"><i class="material-icons">home</i> Inicio</a>
            <?php if ($rangoUsuario === 0): ?>
              <a href="new-chofer.php" class="list-group-item list-group-item-action <?php if ($page == "new-chofer.php") {
                  echo "active";
                } ?>"><i class="material-icons">person_add</i> Pre-Registro Chofer</a>
            <?php endif; ?>
            <?php if ($rangoUsuario >= 1): ?>
              <a href="new-turno.php" class="list-group-item list-group-item-action <?php if ($page == "new-turno.php") {
                  echo "active";
                } ?>"><i class="material-icons">departure_board</i> Registrar nuevo turno</a>
            <?php endif; ?>
            <?php if ($rangoUsuario >= 2): ?>
              <a href="new-unidad.php?id=<?php echo $_SESSION['id'] ?>&token=<?php echo $_SESSION['token'] ?>" class="list-group-item list-group-item-action <?php if ($page == "pnew-unidad.php") {
                  echo "active";
                } ?>"><i class="material-icons">create</i> Pre-registrar unidad</a>
              <a href="unidades.php?id=<?php echo $_SESSION['id'] ?>&token=<?php echo $_SESSION['token'] ?>" class="list-group-item list-group-item-action <?php if ($page == "munidades.php") {
                  echo "active";
                } ?>"><i class="material-icons">local_taxi</i> Mis unidades
                <span class="badge badge-dark f-right"><?php echo $nMisUnidades; ?></span>
              </a>
              <a href="choferes.php" class="list-group-item list-group-item-action <?php if ($page == "choferes.php") {
                  echo "active";
                } ?>"><i class="material-icons">group</i> Listado de choferes</a>
            <?php endif; ?>
            <?php if ($rangoUsuario >= 3): ?>
              <a href="new-patron.php" class="list-group-item list-group-item-action <?php if ($page == "new-patron.php") {
                  echo "active";
                } ?>"><i class="material-icons">group_add</i> Registrar nuevo patrón</a>
                <a href="new-unidad.php" class="list-group-item list-group-item-action <?php if ($page == "new-unidad.php") {
                    echo "active";
                  } ?>"><i class="material-icons">create</i> Registrar nueva unidad</a>
                  <a href="unidades.php" class="list-group-item list-group-item-action <?php if ($page == "unidades.php") {
                      echo "active";
                    } ?>"><i class="material-icons">local_taxi</i> Listado de las unidades
                    <span class="badge badge-dark f-right"><?php echo $nUnidades; ?></span>
                  </a>
            <?php endif; ?>
            <?php if ($rangoUsuario === 4): ?>
              <a href="users.php" class="list-group-item list-group-item-action <?php if ($page == "users.php") {
                  echo "active";
                } ?>"><i class="material-icons">people_outline</i> Listado de los usuarios
                <span class="badge badge-dark f-right"><?php echo $nUsuarios; ?></span>
              </a>
              <a href="estatus.php" class="list-group-item list-group-item-action <?php if ($page == "estatus.php") {
                  echo "active";
                } ?>"><i class="material-icons">category</i> Listado de los estatus
                <span class="badge badge-dark f-right"><?php echo $nEstatus; ?></span>
              </a>
              <a href="new-estatus.php" class="list-group-item list-group-item-action <?php if ($page == "new-estatus.php") {
                  echo "active";
                } ?>"><i class="material-icons">create</i> Nuevo estatus</a>
            <?php endif; ?>
          <a href="contacto.php" class="list-group-item list-group-item-action <?php if ($page == "contacto.php") {
              echo "active";
            } ?>"><i class="material-icons">forum</i> Contacto</a>
          <a href="edit-user.php" class="list-group-item list-group-item-action <?php if ($page == "edit-user.php") {
              echo "active";
            } ?>"><i class="material-icons">settings</i> Modificar Datos</a>
          <a href="edit-pass.php" class="list-group-item list-group-item-action <?php if ($page == "edit-pass.php") {
              echo "active";
            } ?>"><i class="material-icons">lock_open</i> Cambiar contraseña</a>
            <a href="close.php" class="list-group-item list-group-item-action"><i class="material-icons">power_settings_new</i> Cerrar sesión</a>
        </div>
      </div>
    </div>
  </div>
</div>
