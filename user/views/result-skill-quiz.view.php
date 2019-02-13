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
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <script type="text/javascript">
      google.charts.load("current", {packages:['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
         var data = google.visualization.arrayToDataTable([
            ["Columna", "Porcentaje", { role: "style" } ],
            ["Servicio social", <?php echo $array_suma['1'] ?>, "#98DDCC"],
            ["Ejecutivo-persuasivo", <?php echo $array_suma['2'] ?>, "#36647A"],
            ["Verval", <?php echo $array_suma['3'] ?>, "#98DDCC"],
            ["Artístico-Plástica", <?php echo $array_suma['4'] ?>, "#36647A"],
            ["Musical", <?php echo $array_suma['5'] ?>, "#98DDCC"],
            ["Organización", <?php echo $array_suma['6'] ?>, "#36647A"],
            ["Científica", <?php echo $array_suma['7'] ?>, "#98DDCC"],
            ["Cálculo", <?php echo $array_suma['8'] ?>, "#36647A"],
            ["Mecanica-constructiva", <?php echo $array_suma['9'] ?>, "#98DDCC"],
            ["Destreza manual", <?php echo $array_suma['10'] ?>, "#36647A"]
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Perfil de habilidades en porcentaje %",
      //   width: 600,
      //   height: 400,
        bar: {groupWidth: "75%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);
  }
  </script>
  <?php if ($_SESSION['tipo_usuario'] == 'Administrador'): ?>
     <div class="jumbotron main">
        <div class="container-fluid">
           <h2>Tabla de respuestas:</h2>
           <?php echo $datos_admin; ?>
        </div>
     </div>
  <?php endif; ?>
   <div class="container main">
      <div class="row">
         <ol class="breadcrumb">
            <li><a href="<?php echo RUTA; ?>user/index.php">Inicio</a></li>
            <li><a href="<?php echo RUTA; ?>user/results-patient.php">Todos los resultados</a></li>
            <li class="active"><?php echo $titulo; ?></li>
         </ol>
      </div>
      <div class="row">
         <section class="col-xs-12 col-md-9">
            <h2>Resultados del cuestionario de habilidades que <strong><?php echo $paciente['nombre_completo_paciente']; ?></strong> resolvio el <strong><?php echo fechaCorta($resultado['fecha_resultados']); ?></strong></h2>
            <div id="columnchart_values" style="height: 400px;"></div>
            <br>
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
<?php endif; ?>
