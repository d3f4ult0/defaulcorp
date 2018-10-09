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
          <h1>Todas las unidades registradas</h1>
          <div class="col-12 table-responsive caja-principal">
            <table class="table table-bordered table-hover" style="text-align: center;">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Placas</th>
                  <th scope="col">Numero de serie</th>
                  <th scope="col">Marca</th>
                  <th scope="col">Modelo</th>
                  <th scope="col">Patron</th>
                  <th scope="col">Estatus</th>
                  <th scope="col">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($unidades as $unidad): ?>
                  <tr id="row<?php echo $unidad['id_unidad']; ?>">
                    <td><?php echo "M-".$unidad['id_unidad']; ?></td>
                    <td style="text-align: left;"><?php echo $unidad['placas']; ?></td>
                    <td style="text-align: left;"><?php echo $unidad['serie']; ?></td>
                    <?php $marca = getDataFromWhere($connection,'marca','id_marca',$unidad['ID_MARCA']);
                    $marca = $marca[0];
                    echo "<td>".$marca['nombre']."</td>";
                    echo "<td>".$marca['modelo']."</td>"?>
                    <td><?php $patron = getDataFromWhere($connection,'patron','id_patron',$unidad['ID_PATRON']);
                    $patron = $patron[0];
                    echo "<a class='btn btn-outline-dark btn-sm' href='#'>P-".$patron['id_patron']."</a>";
                    ?></td>
                    <td><?php $estatus = getDataFromWhere($connection,'estatus','id_estatus',$unidad['ID_ESTATUS']);
                    $estatus = $estatus[0];
                    echo $estatus['nombre'];?></td>
                    <?php if ($verUsuario == 1): ?>
                      <?php $usuario = getDataFromWhere($connection,'usuario','id_usuario',$patron['ID_USUARIO']);
                      $usuario = $usuario[0]; ?>
                      <td><a class="btn btn-outline-primary btn-sm" href="edit-unidad.php?unidad=<?php echo $unidad['id_unidad']; ?>&patron=<?php echo $patron['id_patron']; ?>&token=<?php echo $usuario['password']; ?>">Modificar</a>
                        <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#modalLoad" onclick="eliminar<?php echo $unidad['id_unidad']; ?>()">Eliminar</button></td>
                        <script type="text/javascript">
                          function eliminar<?php echo $unidad['id_unidad']; ?>(){
                            printNumero.innerHTML = "Unidad: <strong>M-<?php echo $unidad['id_unidad']; ?></strong>";
                            printPlacas.innerHTML = "Placas: <strong><?php echo $unidad['placas']; ?></strong>";
                            printMarca.innerHTML = "Marca/Modelo: <strong><?php echo $marca['nombre']."/".$marca['modelo']."/".$marca['version']; ?></strong>";
                            printPatron.innerHTML = "Pertenece a: <strong><?php echo $usuario['nombre']; ?></strong>";
                            printFecha.innerHTML = "Fecha que se registro: <strong><?php echo $unidad['fu_alta']; ?></strong>";
                            idNumber.value = <?php echo $patron['id_patron']; ?>;
                            tokenNumber.value = "<?php echo $usuario['password']; ?>";
                            idUnidad.value = <?php echo $unidad['id_unidad']; ?>;
                            var myVar = setInterval(okModal, 1500);
                            function okModal(){
                              $('#modalLoad').modal('hide');
                              $('#modalDeleteUnidad').modal('show');
                              clearInterval(myVar);
                            }
                          }
                        </script>
                    <?php else: ?>
                      <td></td>
                    <?php endif; ?>
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
  <?php require 'view/modal-delete-unidad.php'; ?>
  <?php require '../view/modal-success.php'; ?>
</div>

<script type="text/javascript" src="<?php echo LINK; ?>user/js/unidades.js" charset="utf-8"></script>
