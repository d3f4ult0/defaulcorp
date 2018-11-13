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
          <?php if ($verUsuario == 1): ?>
            <h1>Dar de alta un nuevo vehiculo en el sistema</h1>
          <?php else: ?>
            <h1>Pre-registar un vehiculo propio</h1>
          <?php endif; ?>
          <div class="col-12 table-responsive caja-principal">
            <form id="new-unidad">
              <h4>*Recuerde que para dar de alta una nueva unidad se tuvieron que haber pasado todos los puntos de verificacion, conforme marca las reglas del ratiotaxi.</h4>
              <?php if ($verUsuario == 0): ?>
                <small>*El pre-registro no garantiza que la unidad sea aceptada.</small>
              <?php endif; ?>
              <div class="form-group">
                <label for="placas">Numero de placas*</label>
                <input type="text" class="form-control" id="placas" placeholder="Ingrese numero de placas" maxlength="10" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" onblur="checkPlacas()">
                <small id="placasHelp" class="form-text text-muted">El numero de las placas incluye letras y sin guiones (-).</small>
              </div>
              <div class="form-group">
                <label for="serie">Numero de serie de la unidad*</label>
                <input type="text" class="form-control" id="serie" placeholder="Ingrese numero de serie" maxlength="20" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" onblur="checkSerie()">
                <small id="serieHelp" class="form-text text-muted">El numero de serie pueden ser asta de 20 caracteres incluyendo letras y sin guiones (-).</small>
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="tipoFactura">Tipo de la factura*</label>
                </div>
                <select class="custom-select" id="tipoFactura" onchange="checkFactura()">
                  <option value="0" selected>Selecciona...</option>
                  <option value="Original">Original</option>
                  <option value="Aseguradora">Aseguradora</option>
                  <option value="Empresa">Empresa</option>
                </select>
              </div>
              <small id="tipoFacturaHelp" class="form-text text-muted"></small>
              <div class="form-group">
                <label for="factura">Numero de factura*</label>
                <input type="text" class="form-control" id="factura" placeholder="Ingrese numero de factura" maxlength="20" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" onblur="checkNumero()">
                <small id="facturaHelp" class="form-text text-muted">El numero de la factura puede incluir letras y sin guiones (-).</small>
              </div>
              <div class="form-group">
                <label for="fecha">Fecha de factura*</label>
                <input class="form-control" id="fecha" type="date" step="1" min="2013-01-01" max="<?php echo date("Y-m-d");?>" value="<?php echo date("Y-m-d");?>" onblur="checkFecha()">
                <small id="fechaHelp" class="form-text text-muted">Tomar la fecha de la factura (en caso de ser original).</small>
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="tipo">Tipo de la unidad*</label>
                </div>
                <select class="custom-select" id="tipo" onchange="checkTipo()">
                  <option value="0" selected>Selecciona...</option>
                  <option value="Normal">Normal</option>
                  <option value="Limosina">Limosina</option>
                  <option value="Sub-Urban">Sub-Urban</option>
                </select>
              </div>
              <small id="tipoHelp" class="form-text text-muted"></small>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="marca">Marca/modelo*</label>
                </div>
                <select class="custom-select" id="marca" onchange="checkMarca()">
                  <option value="0" selected>Selecciona...</option>
                  <?php foreach ($marcas as $marca): ?>
                    <option value="<?php echo $marca['id_marca']; ?>">
                      <?php echo $marca['nombre']."/".$marca['modelo']."/".$marca['version']."/Cilindros:".$marca['cilindros'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <small id="marcaHelp" class="form-text text-muted"></small>
              <?php if ($verUsuario == 1): ?>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <label class="input-group-text" for="patron">Patron*</label>
                  </div>
                  <select class="custom-select" id="patron" onchange="checkPatron()">
                    <option value="0" selected>Selecciona...</option>
                    <?php foreach ($patrones as $patron): ?>
                      <option value="<?php echo $patron['id_patron']; ?>">
                        <?php $nombrePatron = getDataFromWhere($connection,'usuario','id_usuario',$patron['ID_USUARIO']);
                        $nombrePatron = $nombrePatron[0]; ?>
                        <?php echo $nombrePatron['nombre'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <small id="patronHelp" class="form-text text-muted"></small>
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
              <?php else: ?>
                <div class="input-group mb-3" style="display: none;">
                  <div class="input-group-prepend">
                    <label class="input-group-text" for="patron">Patron*</label>
                  </div>
                  <select class="custom-select" id="patron">
                    <option value="<?php echo $patron['id_patron']; ?>" selected disabled><?php echo $checkUser['nombre'] ?></option>
                  </select>
                </div>
                <small id="patronHelp" class="form-text text-muted"></small>
                <div class="input-group mb-3" style="display: none;">
                  <div class="input-group-prepend">
                    <label class="input-group-text" for="estatus">Estatus*</label>
                  </div>
                  <select class="custom-select" id="estatus">
                    <option value="701" selected disabled>Unidad pre-registrada, que aun no ha pasado los puntos de revisión o que esta en proceso.</option>
                  </select>
                </div>
                <small id="estatusHelp" class="form-text text-muted"></small>
              <?php endif; ?>
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
<script type="text/javascript" src="<?php echo LINK; ?>user/js/new-unidad.js" charset="utf-8"></script>
