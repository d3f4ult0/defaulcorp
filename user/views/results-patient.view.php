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
            <h3 class="text-center titulo-tabla">Mis resultados anteriores</h3>
            <div class="table-responsive" id="tablaResultados">
            </div>
         </section>
         <?php require 'views/aside.php'; ?>
      </div>
   </div>
</div>
<script src="js/results-patient.js" charset="utf-8"></script>
<?php endif; ?>
