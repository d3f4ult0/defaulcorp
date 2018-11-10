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
          <h1>Nuevo estatus</h1>
          <div class="col-12 table-responsive caja-principal">
            <form id="new-estatus">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="tipo">Tipo del estado*</label>
                </div>
                <select class="custom-select" id="tipo" onchange="checkTipo()">
                  <option value="0" selected>Selecciona...</option>
                  <option value="U">Usuario (U)</option>
                  <option value="M">Unidad (M)</option>
                  <option value="A">Administrador/trabajador (A)</option>
                  <option value="C">Chofer (C)</option>
                  <option value="F1">Claves (F1)</option>
                </select>
              </div>
              <div class="form-group">
                <label for="numero">Numero identificador del estado*</label>
                <input type="text" class="form-control" id="numero" placeholder="Ingrese numero">
                <small id="numeroHelp" class="form-text text-muted">El numero no se puede repetir.</small>
              </div>
              <div class="form-group">
                <label for="nombre">Nombre del estado</label>
                <input type="text" class="form-control" id="nombre" placeholder="Ingrese nombre">
                <small id="nombreHelp" class="form-text text-muted">El nombre debe ser descriptivo, hasta 50 caracteres.</small>
              </div>
              <div class="form-group">
                <label for="comentario">Comentario</label>
                <input type="text" class="form-control" id="comentario" placeholder="">
                <small id="comentarioHelp" class="form-text text-muted">Describe a fondo el fin del estado, hasta 1500 caracteres.</small>
              </div>
              <small id="formHelp" class="form-text text-muted">*Datos Obligatorios</small>
              <br>
              <button type="button" id="buttonNewChofer" class="btn btn-primary" disabled data-toggle="modal" data-target="#modalNew">
                Nuevo chofer
              </button>
              <button type="reset" class="btn btn-warning" onclick="desactiveButton()">
                Limpiar Formulario
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
  <?php require 'view/modal-new.php'; ?>
</div>
<script type="text/javascript" src="<?php echo LINK; ?>user/js/new-estatus.js" charset="utf-8"></script>
