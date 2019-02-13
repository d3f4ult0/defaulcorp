<?php session_start();

require '../../configs/configs.php';
require '../../configs/functions.php';

comprobarSesion();

$conexion = conexion($bd_config);
if (!$conexion) {
   header('Location: error.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   $pacienteID = $_POST['paciente'];
   $preguntaNo = $_POST['preguntaNo'];

   $pregunta = $conexion->prepare("SELECT * FROM cuestionario_habilidades LIMIT $preguntaNo, 1");
   $pregunta->execute();
   $pregunta = $pregunta->fetch();

   $formPregunta = '<form class="form-horizontal formulario" method="post">
      <h2 class="text-center">Pregunta No. '.($preguntaNo+1).'</h2>
      <h3>'.$pregunta['pregunta_habilidades'].'</h3>
      <div class="col-xs-11 col-xs-offset-1" style="margin-bottom: 20px;">
         <div class="radio">
            <input type="radio" name="respuesta" value="4" id="r1" checked><label for="r1">Muy hábil</label>
         </div>
         <div class="radio">
            <input type="radio" name="respuesta" value="3" id="r2"><label for="r2">Hábil</label>
         </div>
         <div class="radio">
            <input type="radio" name="respuesta" value="2" id="r3"><label for="r3">Medianamente hábil</label>
         </div>
         <div class="radio">
            <input type="radio" name="respuesta" value="1" id="r4"><label for="r4">Poco hábil</label>
         </div>
         <div class="radio">
            <input type="radio" name="respuesta" value="0" id="r5"><label for="r5">Nada hábil</label>
         </div>
      </div>
      <input type="hidden" name="paciente" value="'.$pacienteID.'" id="paciente">
      <script src="js/skill-quiz.js" charset="utf-8"></script>';

   if ($preguntaNo == 0) {
      $nuevoResultado = $conexion->prepare("INSERT INTO resultados_cuestionario (id_resultado, paciente_id) VALUES(NULL,:id)");
      $nuevoResultado->execute(array(':id' => $pacienteID));
      $comprobacion = $nuevoResultado->rowCount();
      if ($comprobacion == 1) {
         $resultadoID = $conexion->lastInsertId();
         echo $formPregunta;
         echo '<button type="button" name="button" class="btn btn-success btn-block" id="siguiente">Siguiente pregunta <span class="glyphicon glyphicon-circle-arrow-right"></span></button><input type="hidden" name="resultadoNo" value="'.$resultadoID.'" id="resultadoNo"></form>';
      }else {
         echo '<div class="jumbotron"><h2 class="error">¡Ha ocurrido un error inesperado!</h2><h3>Favor de intentarlo mas tarde</h3></div>';
      }
   }

   if ($preguntaNo > 0 && $preguntaNo < 60) {
      $resultadoID = $_POST['resultadoNo'];
      $respuesta = $_POST['respuesta'];
      $query = 'UPDATE resultados_cuestionario SET resultado_' . $preguntaNo . ' = ' . $respuesta . ' WHERE id_resultado = ' . $resultadoID;
      $resultado = $conexion->prepare($query);
      $resultado->execute();
      $comprobacion = $resultado->rowCount();
      if ($comprobacion == 1) {
         echo $formPregunta;
         if ($preguntaNo == 59) {
            echo '<button type="button" name="button" class="btn btn-success btn-block" id="siguiente">Terminar cuestionario <span class="glyphicon glyphicon-ok"></span></button><input type="hidden" name="resultadoNo" value="'.$resultadoID.'" id="resultadoNo"></form>';
         }else {
            echo '<button type="button" name="button" class="btn btn-success btn-block" id="siguiente">Siguiente pregunta <span class="glyphicon glyphicon-circle-arrow-right"></span></button><input type="hidden" name="resultadoNo" value="'.$resultadoID.'" id="resultadoNo"></form>';
         }
      }else {
         echo '<div class="jumbotron"><h2 class="error">¡Ha ocurrido un error inesperado!</h2><h3>Favor de intentarlo mas tarde</h3></div>';
      }
   }
   if ($preguntaNo > 59) {
      $resultadoID = $_POST['resultadoNo'];
      $respuesta = $_POST['respuesta'];
      $resultado = $conexion->prepare('UPDATE resultados_cuestionario SET resultado_'.$preguntaNo.' = '.$respuesta.', fecha_resultados = CURRENT_TIMESTAMP WHERE id_resultado = :id');
      $resultado->execute(array(':id' => $resultadoID));
      $comprobacion = $resultado->rowCount();
      if ($comprobacion == 1) {
         $usuarioID = $_SESSION['id_usuario'];
         $cuestionario = $conexion->prepare("INSERT INTO cuestionarios_paciente (usuario_id, paciente_id, resultado_id, nombre_cuestionario, fecha_aplicacion) VALUES (:id_usuario, :id_paciente, :id_resultado, 'Cuestionario de habilidades', CURRENT_TIMESTAMP)");
         $cuestionario->execute(array(
            ':id_usuario' => $usuarioID,
            ':id_paciente' => $pacienteID,
            ':id_resultado' => $resultadoID
         ));
         $comprobacion = $cuestionario->rowCount();
         if ($comprobacion == 1) {
            $credito = $_SESSION['creditos_usuario'] - 1;
            $resultado = $conexion->prepare('UPDATE usuarios SET creditos_usuario = :credito WHERE id_usuario = :id_usuario');
            $resultado->execute(array(
               ':credito' => $credito,
               ':id_usuario' => $usuarioID
            ));
            $comprobacion = $resultado->rowCount();
            if ($comprobacion == 1) {
            $consulta = comprobarEn('usuarios','id_usuario',$usuarioID, $conexion);
            $_SESSION = $consulta;
            $paciente = comprobarEn('pacientes','id_paciente',$pacienteID,$conexion);

            echo '<div class="jumbotron"><h2 style="color: darkcyan">¡Felicidades <strong>'.$paciente['nombre_completo_paciente'].'</strong> has finalizado el cuestionario de habilidades!</h2><h3><a href="result-skill-quiz.php?token='.$_SESSION['password_usuario'].'&paciente='.$pacienteID.'&cuestionarioNo='.$resultadoID.'">Ver resultado</a></h3><h4>Puedes consultar tus resultados en cualquier momento desde <a href="results-patient.php">resultados anteriores</a></h4></div>';
            }else {
               echo '<div class="jumbotron"><h2 class="error">¡Ha ocurrido un error restar credito!</h2><h3>Favor de intentarlo mas tarde</h3></div>';
            }
         }else {
            echo '<div class="jumbotron"><h2 class="error">¡Ha ocurrido un error cuestionario_paciente!</h2><h3>Favor de intentarlo mas tarde</h3></div>';
         }
      }else {
         echo '<div class="jumbotron"><h2 class="error">¡Ha ocurrido un error fecha pregunta!</h2><h3>Favor de intentarlo mas tarde</h3></div>';
      }
   }

}

?>
