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
          <h1>Actualizacion de datos</h1>
          <div class="col-12 table-responsive caja-principal">
            <form id="edit-user">
              <input type="hidden" id="number" value="<?php echo $checkUser['id_usuario']; ?>">
              <div class="form-group">
                <label for="userName">Nombre de usuario</label>
                <input type="text" class="form-control" id="userName" placeholder="<?php echo $checkUser['usuario']; ?>" disabled>
              </div>
              <div class="form-group">
                <label for="email">Correo</label>
                <input type="text" class="form-control" id="email" placeholder="<?php echo $checkUser['correo']; ?>" disabled>
              </div>
              <div class="form-group">
                <label for="fecha">Fecha de registro</label>
                <input type="text" class="form-control" id="fecha" placeholder="<?php echo $checkUser['fu_alta']; ?>" disabled>
              </div>
              <div class="form-group">
                <label for="fullName">Nombre completo</label>
                <input type="text" class="form-control" id="fullName" value="<?php echo $checkUser['nombre']; ?>" maxlength="200">
              </div>
              <div class="form-group">
                <label for="phone">Telefono</label>
                <input type="text" class="form-control" id="phone" value="<?php echo $checkUser['telefono']; ?>" maxlength="15">
              </div>
              <div class="form-group">
                <label for="address">Dirección</label>
                <input type="text" class="form-control" id="address" value="<?php echo $checkUser['direccion']; ?>" maxlength="500">
              </div>
              <div class="form-group">
                <label for="curp">CURP</label>
                <input type="text" class="form-control" id="curp" value="<?php echo $checkUser['curp']; ?>" maxlength="18" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
              </div>
              <div class="form-group">
                <label for="rfc">RFC</label>
                <input type="text" class="form-control" id="rfc" value="<?php echo $checkUser['rfc']; ?>" maxlength="13" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
              </div>
              <button type="button" id="buttonActualizar" class="btn btn-primary" data-toggle="modal" data-target="#modalLoad" onclick="actualizar()">
                Actualizar datos
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
<script type="text/javascript" src="<?php echo LINK; ?>user/js/edit-user.js" charset="utf-8"></script>
