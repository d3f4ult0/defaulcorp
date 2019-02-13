<?php if (!empty(verificacionUsuario())): ?>
   <div class="jumbotron main">
      <div class="container">
         <h2 class="text-center error">¡Algo ha salido mal!</h2>
         <h3>Nos da mucho gusto el tenerte aqui nuevamente.</h3>
         <h4>Lamentablemente ha ocurrido un error y no se puede continuar por favor tenga en cuenta las siguientes recomendaciones</h4>
         <h4>
            <ul>
               <?php echo verificacionUsuarioRecomendacion(); ?>
            </ul>
         </h4>
         <h5 class="text-right">DefaultCORP© Abril-2017</h5>
      </div>
   </div>
<?php else: ?>

   <div class="container main">
      <div class="row">
         <ol class="breadcrumb">
            <li><a href="<?php echo RUTA; ?>user/index.php">Inicio</a></li>
            <li class="active"><?php echo $titulo; ?></li>
         </ol>
      </div>
      <div class="row">
         <section class="col-xs-12 col-md-9">
            <form enctype="multipart/form-data" class="form-horizontal formulario" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
               <h2 class="text-center">Actualizar perfil de <strong><?php echo $paciente['nombre_completo_paciente']; ?></strong></h2>
               <div class="input-group">
                  <label class="control-label sr-only" for="id-info">ID paciente:</label>
                  <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                  <input class="form-control" type="text" name="id-info" value="ID paciente: <?php echo $paciente['id_paciente']; ?>" disabled>
               </div>
               <br>
               <div class="input-group">
                  <label class="control-label sr-only" for="fecha_registro">Fecha de registro :</label>
                  <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                  <input class="form-control" type="text" name="fecha_registro" value="Fecha de registro: <?php echo fechaCorta($paciente['fecha_registro_paciente']); ?>" disabled>
               </div>
               <br>
               <div class="input-group">
                  <label class="control-label sr-only" for="nombre">*Nombre propio:</label>
                  <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
                  <input class="form-control" type="text" id="input-nombre" name="nombre" placeholder="Nombre propio" value="<?php echo $paciente['nombre_completo_paciente']; ?>">
                  <span class="input-group-addon" id="nombre"><span class="glyphicon glyphicon-asterisk"></span></span>
               </div>
               <label class="control-label">Fecha de nacimiento: </label>
               <div class="form-group">
                  <div class="col-xs-4">
                     <label for="dia" class="control-label">Dia: </label><select class="form-control" name="dia" id="dia">
                        <?php for ($i=1; $i < 32; $i++){
                           echo "<option value='$i' ";
                           if ($dia == $i) {
                              echo "selected";
                           }
                           echo ">$i</option>";
                           }
                        ?>
                     </select>
                </div>
                <div class="col-xs-4">
                  <label for="mes" class="control-label">Mes: </label><select class="form-control" name="mes" id="mes">
                      <?php $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
                        for ($i=1; $i < 13; $i++) {
                           echo "<option value='$i' ";
                           if ($meses[$mes] == $meses[$i - 1]) {
                              echo "selected";
                           }
                           echo ">";
                           echo $meses[$i - 1];
                           echo "</option>";
                        }
                      ?>
                  </select>
               </div>
               <div class="col-xs-4">
                  <label for="year" class="control-label">Año: </label><select class="form-control" name="year" id="year">
                      <?php for ($i=2017; $i > 1949; $i--) {
                        echo "<option value='$i' ";
                        if ($year == $i) {
                           echo "selected";
                        }
                        echo ">$i</option>";
                      } ?>
                  </select>
               </div>
               </div>
               <label for="genero" class="control-label">Genero: </label>
               <div class="col-xs-10 col-xs-offset-2">
                  <div class="radio">
                     <input type="radio" name="genero" value="Masculino" id="m" <?php if ($paciente['genero_paciente']=='Masculino'): ?>
                        checked
                     <?php endif; ?>><label for="m"> Masculino </label>
                  </div>
                  <div class="radio">
                     <input type="radio" name="genero" value="Femenino" id="f"  <?php if ($paciente['genero_paciente']=='Femenino'): ?>
                        checked
                     <?php endif; ?>><label for="f"> Femenino </label>
                  </div>
                  <div class="radio">
                     <input type="radio" name="genero" value="Otro" id="o" <?php if ($paciente['genero_paciente']=='Otro'): ?>
                        checked
                     <?php endif; ?>><label for="o"> Otro </label>
                  </div>
               </div>
               <br><br>
               <label for="escolaridad" class="control-label">Escolaridad: </label>
               <select class="form-control" name="escolaridad" id="escolaridad">
                  <option value="Primaria" <?php if ($paciente['escolaridad_paciente']=='Primaria'): ?>
                      selected
                  <?php endif; ?>>Primaria</option>
                  <option value="Secundaria" <?php if ($paciente['escolaridad_paciente']=='Secundaria'): ?>
                      selected
                  <?php endif; ?>>Secundaria</option>
                  <option value="Preparatoria" <?php if ($paciente['escolaridad_paciente']=='Preparatoria'): ?>
                      selected
                  <?php endif; ?>>Preparatoria</option>
                  <option value="Licenciatura" <?php if ($paciente['escolaridad_paciente']=='Licenciatura'): ?>
                      selected
                  <?php endif; ?>>Licenciatura</option>
                  <option value="Maestria" <?php if ($paciente['escolaridad_paciente']=='Maestria'): ?>
                      selected
                  <?php endif; ?>>Maestria</option>
                  <option value="Doctorado" <?php if ($paciente['escolaridad_paciente']=='Doctorado'): ?>
                      selected
                  <?php endif; ?>>Doctorado</option>
               </select>
               <br>
               <label for="descripcion">Descripcion: </label>
               <textarea name="descripcion" id="descripcion" class="form-control" placeholder="Breve descripcion del usuario"><?php echo $paciente['descripcion_paciente']; ?></textarea>
               <div class="media">
                  <div class="media-left" id="foto">
                     <img class="thumbnail" src="<?php echo RUTA .'user/'. $blog_config['foto'] . $paciente['foto_paciente']; ?>" alt="">
                  </div>
                  <div class="media-body">
                     <label class="control-label"><span class="glyphicon glyphicon-camera"></span> Imagen de usuario en archivo</label><br>
                     <label class="control-label"><span class="glyphicon glyphicon-picture"></span> Se recomienda imagen de 100x100 pixeles</label><br>
                     <input type="file" name="foto-nueva" value="" class="btn btn-default">
                     <input type="hidden" name="foto-guardada" value="<?php echo $paciente['foto_paciente']; ?>">
                  </div>
               </div>
               <input type="hidden" name="id" value="<?php echo $paciente['id_paciente']; ?>">
               <input type="hidden" name="usuario-id" value="<?php echo $usuario['id_usuario']; ?>">
               <button type="submit" name="enviar" class="btn btn-primary btn-block">Actualizar datos <span class="glyphicon glyphicon-saved"></span></button>
            </form>
            <?php if (!empty($errores)): ?>
               <div class="alert alert-danger">
                  <button class="close" data-dismiss="alert"><span>&times;</span></button>
                  <ul>
                     <?php echo $errores; ?>
                  </ul>
               </div>
            <?php endif; ?>
            <?php if (!empty($exito)): ?>
               <div class="alert alert-success">
                  <button class="close" data-dismiss="alert"><span>&times;</span></button>
                  <ul>
                     <?php echo $exito; ?>
                  </ul>
               </div>
            <?php endif; ?>
         </section>
         <?php require 'views/aside.php'; ?>
      </div>
   </div>
<?php require '../views/pop-up.php'; ?>
<script src="../js/new-user.js" charset="utf-8"></script>
<script src="js/edit-picture.js" charset="utf-8"></script>
<?php endif; ?>
