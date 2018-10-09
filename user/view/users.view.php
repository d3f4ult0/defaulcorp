<div class="container-fluid">
  <div class="row m-top">
    <div class="col-12 col-md-8 col-lg-9">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $title; ?></li>
              </ol>
            </nav>
          </div>
          <h1>Todas los usuarios registrados</h1>
          <div class="col-12 table-responsive caja-principal">
            <table class="table table-bordered table-hover" style="text-align: center;">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Usuario</th>
                  <th scope="col">Nombre Completo</th>
                  <th scope="col">Estatus</th>
                  <th scope="col">Trabajador</th>
                  <th scope="col">Patron</th>
                  <th scope="col">Chofer</th>
                  <th scope="col">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                  <tr id="row<?php echo $usuario['id_usuario']; ?>">
                    <td><?php echo "U-".$usuario['id_usuario']; ?></td>
                    <td style="text-align: left;"><?php echo $usuario['usuario']; ?></td>
                    <td style="text-align: left;"><?php echo $usuario['nombre']; ?></td>
                    <td><?php $estatus = getDataFromWhere($connection,'estatus','id_estatus',$usuario['ID_ESTATUS']);
                    $estatus = $estatus[0];
                    echo $estatus['nombre'];?></td>
                    <td><?php $admin = getDataFromWhere($connection,'administrador','ID_USUARIO',$usuario['id_usuario']);
                    if ($admin) {
                      $admin = $admin[0];
                      echo "<a class='btn btn-outline-dark btn-sm' href='#'>A-".$admin['id_administrador']."/".$admin['puesto']."</a>";
                    } else {
                      echo "<a class='btn btn-outline-info btn-sm' href='new-admin.php?id=".$usuario['id_usuario']."'>Nuevo</a>";
                    }
                    ?></td>

                    <td><?php $patron = getDataFromWhere($connection,'patron','ID_USUARIO',$usuario['id_usuario']);
                    if ($patron) {
                      $patron = $patron[0];
                      echo "<a class='btn btn-outline-dark btn-sm' href='#'>P-".$patron['id_patron']."</a>";
                    } else {
                      echo "<a class='btn btn-outline-info btn-sm' href='new-patron.php?id=".$usuario['id_usuario']."'>Nuevo</a>";
                    }
                    ?></td>

                    <td><?php $chofer = getDataFromWhere($connection,'chofer','ID_USUARIO',$usuario['id_usuario']);
                    if ($chofer) {
                      $chofer = $chofer[0];
                      echo "<a class='btn btn-outline-dark btn-sm' href='#'>C-".$chofer['id_chofer']."</a>";
                    } else {
                      echo "<a class='btn btn-outline-info btn-sm' href='new-chofer.php?id=".$usuario['id_usuario']."&token=".$usuario['password']."'>Nuevo</a>";
                    }
                    ?></td>
                    <td><a class="btn btn-outline-primary btn-sm" href="edit-user.php?id=<?php echo $usuario['id_usuario']; ?>&token=<?php echo $usuario['password']; ?>">Modificar</a>
                      <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#modalLoad" onclick="eliminar<?php echo $usuario['id_usuario']; ?>()" <?php if ($usuario['id_usuario'] == $_SESSION['id']): ?>
                          disabled
                      <?php endif; ?>>Eliminar</button></td>
                      <script type="text/javascript">
                        function eliminar<?php echo $usuario['id_usuario']; ?>(){
                          printNumero.innerHTML = "Identificador del usuario: <strong>U-<?php echo $usuario['id_usuario']; ?></strong>";
                          printUsuario.innerHTML = "Nombre de usuario: <strong><?php echo $usuario['usuario']; ?></strong>";
                          printNombre.innerHTML = "Nombre Completo: <strong><?php echo $usuario['nombre']; ?></strong>";
                          printCorreo.innerHTML = "Correo: <strong><?php echo $usuario['correo']; ?></strong>";
                          printFecha.innerHTML = "Fecha en que se inscribio: <strong><?php echo $usuario['fu_alta']; ?></strong>";
                          idNumber.value = <?php echo $usuario['id_usuario']; ?>;
                          tokenNumber.value = "<?php echo $usuario['password']; ?>";
                          var myVar = setInterval(okModal, 1500);
                          function okModal(){
                            $('#modalLoad').modal('hide');
                            $('#modalDeleteUser').modal('show');
                            clearInterval(myVar);
                          }
                        }
                      </script>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <?php include 'view/aside.php'; ?>
  </div>
</div>
<div class="espacio-final">
</div>
<div>
  <?php require '../view/modal-load.php'; ?>
  <?php require 'view/modal-delete-user.php'; ?>
  <?php require '../view/modal-success.php'; ?>
</div>

<script type="text/javascript" src="<?php echo LINK; ?>user/js/users.js" charset="utf-8"></script>
