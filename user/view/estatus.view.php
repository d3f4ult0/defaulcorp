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
          <div class="col-12">
            <h1>Todos los estatus en el Sistema</h1>
            <div class="col-12 table-responsive caja-principal">
              <table class="table table-bordered table-hover" style="text-align: center;">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($estatus as $estatu): ?>
                    <tr id="row<?php echo $estatu['id_estatus']; ?>">
                      <td><?php echo $estatu['tipo']."-".$estatu['id_estatus']; ?></td>
                      <td style="text-align: left;"><?php echo $estatu['nombre']; ?></td>
                      <td style="text-align: left;"><?php echo $estatu['comentario']; ?></td>
                      <td><button class="btn btn-outline-primary btn-sm" disabled>Modificar</button></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
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
