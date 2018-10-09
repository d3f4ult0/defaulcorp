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
          <h1>Dar de alta un nuevo administrador</h1>
          <div class="col-12 table-responsive caja-principal">
            <h4>*Se puede asignar cualquier usuario que ya este Pre-registrado y que aya pasado los examenes de conocimiento y la entrevista para poder empezar a laborar.</h4>
            <form id="new-unidad">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="usuario">Usuario*</label>
                </div>
                <select class="custom-select" id="usuario" onchange="checkUsuario()">
                  <option value="0" selected>Selecciona...</option>
                  <?php foreach ($usuarios as $usuario): ?>
                    <option value="<?php echo $usuario['id_usuario']; ?>">
                      <?php echo $usuario['usuario']."/".$usuario['nombre']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <small id="usuarioHelp" class="form-text text-muted"></small>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="puesto">Puesto*</label>
                </div>
                <select class="custom-select" id="puesto" onchange="checkTipo()">
                  <option value="0" selected>Selecciona...</option>
                  <option value="Técnico">Técnico</option>
                  <option value="Enlace">Enlace</option>
                  <option value="Sub-Jefe">Sub-Jefe</option>
                  <option value="Jefe">Jefe</option>
                  <option value="Socio">Socio</option>
                  <option value="CEO">CEO</option>
                </select>
              </div>
              <small id="tipoHelp" class="form-text text-muted"></small>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="estatus">Estatus de la unidad*</label>
                </div>
                <select class="custom-select" id="estatus" onchange="checkEstatus()">
                  <option value="0" selected>Selecciona...</option>
                  <?php foreach ($estatus as $estatu): ?>
                    <option value="<?php echo $estatu['id_estatus']; ?>">
                      <?php echo $estatu['nombre']."/".$estatu['comentario']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <small id="estatusHelp" class="form-text text-muted"></small>
              <small id="formHelp" class="form-text text-muted">*Datos Obligatorios</small>
              <br>
              <button type="button" id="bottomNewUnidad" class="btn btn-primary" data-toggle="modal" data-target="#modalUnidad" disabled>
                Dar de alta unidad
              </button>
            </form>
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
  <?php require '../view/modal-success.php'; ?>
  <?php require 'view/modal-unidad.php'; ?>
</div>
<script type="text/javascript" src="<?php echo LINK; ?>user/js/new-admin.js" charset="utf-8"></script>
