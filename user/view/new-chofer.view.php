<div class="container-fluid">
  <div class="row m-top">
    <div class="col-12 col-md-8 col-lg-9">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                <?php if (isset($_GET['id'])): ?>
                  <li class="breadcrumb-item"><a href="users.php">Usuarios</a></li>
                <?php endif; ?>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $title; ?></li>
              </ol>
            </nav>
          </div>
          <?php if ($verUsuario == 1): ?>
            <h1>Dar de alta un nuevo chofer</h1>
          <?php else: ?>
            <h1>Trabaja con nosotros</h1>
          <?php endif; ?>
          <div class="col-12 table-responsive caja-principal">
            <form id="new-chofer">
              <?php if ($verUsuario == 1): ?>
                <h4>*Se puede asignar cualquier usuario que ya este Pre-registrado y que aya pasado los examenes de conocimiento y la entrevista para poder empezar a laborar.</h4>
              <?php else: ?>
                <h4>Sube tus datos para poder ser candidato y trabajar con el mejor equipo.<br><small>*El pre-registro no garantiza que sea autorizado.</small></h4>
              <?php endif; ?>
              <div class="form-group">
                <input type="hidden" id="number" value="<?php echo $checkUser['id_usuario']; ?>">
                <label for="usuario">Nombre usuario</label>
                <input type="text" class="form-control" id="usuario" value="<?php echo $checkUser['usuario']; ?>" disabled>
              </div>
              <div class="form-group">
                <label for="correo">Correo</label>
                <input type="text" class="form-control" id="correo" value="<?php echo $checkUser['correo']; ?>" disabled>
              </div>
              <div class="form-group">
                <label for="nombre">Nombre completo</label>
                <input type="text" class="form-control" id="nombre" value="<?php echo $checkUser['nombre']; ?>" disabled>
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="identificacion">Tipo de identificación*</label>
                </div>
                <select class="custom-select" id="identificacion" onchange="checkIdentificacion()">
                  <option value="0" selected>Selecciona...</option>
                  <option value="INE">INE</option>
                  <option value="IFE">IFE</option>
                  <option value="Cartilla">Cartilla</option>
                  <option value="Cédula Profesional">Cédula Profesional</option>
                  <option value="Licencia">Licencia</option>
                  <option value="Pasaporte">Pasaporte</option>
                </select>
              </div>
              <small id="identificacionHelp" class="form-text text-muted"></small>
              <div class="form-group">
                <label for="numero">Numero de identificación*</label>
                <input type="text" class="form-control" id="numero" placeholder="Ingrese el numero del documento" maxlength="20" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" onblur="checkNumero()">
                <small id="numeroHelp" class="form-text text-muted">El numero de la identificacion puede contener letras y números hasta 20 caracteres.</small>
              </div>
              <div class="form-group">
                <label for="licencia">Numero de licencia*</label>
                <input type="text" class="form-control" id="licencia" placeholder="Ingrese el numero del licencia" maxlength="15" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" onblur="checkLicencia()">
                <small id="licenciaHelp" class="form-text text-muted">El numero de la licencia debe comenzar con el tipo de licencia. Ejemplo: A-00000</small>
              </div>
              <div class="form-group">
                <label for="tarjeton">Numero de tarjeton*</label>
                <input type="text" class="form-control" id="tarjeton" placeholder="Ingrese el numero del tarjeton" maxlength="15" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" onblur="checkTarjeton()">
                <small id="tarjetonHelp" class="form-text text-muted">Puede contener hasta 15 caracteres.</small>
              </div>
              <div class="form-group">
                <label for="fecha">Vencimiento tarjeton*</label>
                <input class="form-control" id="fecha" type="date" step="1" min="<?php echo date("Y-m-d");?>" value="<?php echo date("Y-m-d");?>" onblur="checkFecha()">
                <small id="fechaHelp" class="form-text text-muted">No puede estar vencido.</small>
              </div>
              <?php if ($verUsuario == 1): ?>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <label class="input-group-text" for="estatus">Estatus del chofer*</label>
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
              <?php else: ?>
                <input type="hidden" id="estatus" value="401">
                <small id="estatusHelp" class="form-text text-muted"></small>
              <?php endif; ?>
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
<script type="text/javascript" src="<?php echo LINK; ?>user/js/new-chofer.js" charset="utf-8"></script>
