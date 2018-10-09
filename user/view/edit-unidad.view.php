<div class="container-fluid">
  <div class="row m-top">
    <div class="col-12 col-md-8 col-lg-9">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                <li class="breadcrumb-item"><a href="unidades.php">Unidades</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $title; ?></li>
              </ol>
            </nav>
          </div>
          <h1>Actualizar unidad M-<?php echo $verUnidad['id_unidad'];?></h1>
          <div class="col-12 table-responsive caja-principal">
            <form id="edit-unidad">
              <input type="hidden" id="numberID" value="<?php echo $verUnidad['id_unidad']; ?>">
              <div class="form-group">
                <label for="number">Identificador de la unidad</label>
                <input type="text" class="form-control" id="number" placeholder="M-<?php echo $verUnidad['id_unidad']; ?>" disabled>
              </div>
              <div class="form-group">
                <label for="fechaR">Fecha de registro</label>
                <input type="text" class="form-control" id="fechaR" placeholder="<?php echo $verUnidad['fu_alta']; ?>" disabled>
              </div>
              <div class="form-group">
                <label for="serie">Numero de serie</label>
                <input type="text" class="form-control" id="serie" value="<?php echo $verUnidad['serie']; ?>" maxlength="20">
              </div>
              <div class="form-group">
                <label for="placas">Placas</label>
                <input type="text" class="form-control" id="placas" value="<?php echo $verUnidad['placas']; ?>" maxlength="10">
              </div>
              <div class="form-group">
                <label for="factura">Numero de factura</label>
                <input type="text" class="form-control" id="factura" value="<?php echo $verUnidad['no_factura']; ?>" maxlength="20" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="tipoFactura">Tipo de la factura*</label>
                </div>
                <select class="custom-select" id="tipoFactura" onchange="">
                  <option value="Original" <?php if ($verUnidad['factura'] == "Original"): ?>
                    selected
                  <?php endif; ?>>Original</option>
                  <option value="Aseguradora" <?php if ($verUnidad['factura'] == "Aseguradora"): ?>
                    selected
                  <?php endif; ?>>Aseguradora</option>
                  <option value="Empresa" <?php if ($verUnidad['factura'] == "Empresa"): ?>
                    selected
                  <?php endif; ?>>Empresa</option>
                </select>
              </div>
              <div class="form-group">
                <label for="fecha">Año</label>
                <input class="form-control" id="fecha" type="date" step="1" min="2013-01-01" max="<?php echo date("Y-m-d");?>" value="<?php echo $verUnidad['fecha'];?>">
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="tipo">Tipo de la unidad</label>
                </div>
                <select class="custom-select" id="tipo">
                  <option value="Normal" <?php if ($verUnidad['tipo'] == "Normal"): ?>
                    selected
                  <?php endif; ?>>Normal</option>
                  <option value="Limosina" <?php if ($verUnidad['tipo'] == "Limosina"): ?>
                    selected
                  <?php endif; ?>>Limosina</option>
                  <option value="Sub-Urban" <?php if ($verUnidad['tipo'] == "Sub-Urban"): ?>
                    selected
                  <?php endif; ?>>Sub-Urban</option>
                </select>
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="marca">Marca/modelo</label>
                </div>
                <select class="custom-select" id="marca">
                  <?php foreach ($marcas as $marca): ?>
                    <option value="<?php echo $marca['id_marca']; ?>" <?php if ($marca['id_marca'] == $verUnidad['ID_MARCA']): ?>
                      selected
                    <?php endif; ?>>
                      <?php echo $marca['nombre']."/".$marca['modelo']."/".$marca['version']."/Cilindros:".$marca['cilindros'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="patron">Patron</label>
                </div>
                <select class="custom-select" id="patron">
                  <?php foreach ($patrones as $patron): ?>
                    <option value="<?php echo $patron['id_patron']; ?>" <?php if ($patron['id_patron'] == $verUnidad['ID_PATRON']): ?>
                      selected
                    <?php endif; ?>>
                      <?php $nombrePatron = getDataFromWhere($connection,'usuario','id_usuario',$patron['ID_USUARIO']);
                      $nombrePatron = $nombrePatron[0]; ?>
                      <?php echo $nombrePatron['nombre'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="estatus">Estatus de la unidad</label>
                </div>
                <select class="custom-select" id="estatus">
                  <?php foreach ($estatus as $estatu): ?>
                    <option value="<?php echo $estatu['id_estatus']; ?>" <?php if ($estatu['id_estatus'] == $verUnidad['ID_ESTATUS']): ?>
                      selected
                    <?php endif; ?>>
                      <?php echo $estatu['nombre']."/".$estatu['comentario']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <button type="button" id="buttonActualizar" class="btn btn-primary" data-toggle="modal" data-target="#modalLoad" onclick="actualizar()">
                Actualizar unidad M-<?php echo $verUnidad['id_unidad'];?>
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
</div>
<script type="text/javascript" src="<?php echo LINK; ?>user/js/edit-unidad.js" charset="utf-8"></script>
