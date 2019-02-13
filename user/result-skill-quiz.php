<?php session_start();

require '../configs/configs.php';
require '../configs/functions.php';

comprobarSesion();

$conexion = conexion($bd_config);
if (!$conexion) {
   header('Location: error.php');
}

estatusSesion($conexion);

if (isset($_GET['token']) && isset($_GET['paciente']) && isset($_GET['cuestionarioNo'])) {
   $token = $_GET['token'];
   if ($_SESSION['password_usuario'] != $token){
      header('Location: index.php');
   }
   $resultadoID = $_GET['cuestionarioNo'];
   $resultado = comprobarEn('resultados_cuestionario','id_resultado',$resultadoID,$conexion);
   if (empty($resultado)) {
      header('Location: index.php');
   }
   if ($resultado['paciente_id'] != $_GET['paciente']) {
      header('Location: index.php');
   }
   $pacienteID = $_GET['paciente'];
   if ($_SESSION['tipo_usuario'] == 'Administrador') {
      $paciente = comprobarEn('pacientes','id_paciente',$pacienteID,$conexion);
   }else {
      $paciente = comprobarEnDosCampos('pacientes','id_paciente',$pacienteID,'usuario_id',$_SESSION['id_usuario'],$conexion);
   }
   if (empty($paciente)) {
      header('Location: index.php');
   }

   $datos_admin = "<div class='table-responsive'><table class='table table-striped table-bordered table-hover table-condensed' style='background: #e2e2e2;'>";
   $datos_admin .= "<tr class='info'>";
   $datos_admin .= "<td class='text-center'>X</td>";
   for ($i=1; $i < 11; $i++) {
      $datos_admin .= '<th>Columna ';
      $datos_admin .= $i;
      $datos_admin .= '</th>';
   }
   $datos_admin .= "</tr>";
   $datos_admin .= "<tr>";
   $datos_admin .= "<td class='text-center'>X</td>";
   for ($i=1; $i < 11; $i++) {
   $datos_admin .= "<td class='text-center'>";
   $datos_admin .= $resultado['resultado_' . $i];
   $datos_admin .= '</td>';
   }
   $datos_admin .= "</tr>";
   $datos_admin .= "<tr>";
   $datos_admin .= "<td class='text-center'>X</td>";
   for ($i=11; $i < 21; $i++) {
      $datos_admin .= "<td class='text-center'>";
      $datos_admin .= $resultado['resultado_' . $i];
      $datos_admin .= '</td>';
   }
   $datos_admin .= "</tr>";
   $datos_admin .= "<tr>";
   $datos_admin .= "<td class='text-center'>X</td>";
   for ($i=21; $i < 31; $i++) {
      $datos_admin .= "<td class='text-center'>";
      $datos_admin .= $resultado['resultado_' . $i];
      $datos_admin .= '</td>';
   }
   $datos_admin .= "</tr>";
   $datos_admin .= "<tr>";
   $datos_admin .= "<td class='text-center'>X</td>";
   for ($i=31; $i < 41; $i++) {
      $datos_admin .= "<td class='text-center'>";
      $datos_admin .= $resultado['resultado_' . $i];
      $datos_admin .= '</td>';
   }
   $datos_admin .= "</tr>";
   $datos_admin .= "<tr>";
   $datos_admin .= "<td class='text-center'>X</td>";
   for ($i=41; $i < 51; $i++) {
      $datos_admin .= "<td class='text-center'>";
      $datos_admin .= $resultado['resultado_' . $i];
      $datos_admin .= '</td>';
   }
   $datos_admin .= "</tr>";
   $datos_admin .= "<tr>";
   $datos_admin .= "<td class='text-center'>X</td>";
   for ($i=51; $i < 61; $i++) {
      $datos_admin .= "<td class='text-center'>";
      $datos_admin .= $resultado['resultado_' . $i];
      $datos_admin .= '</td>';
   }
   $datos_admin .= "</tr>";
   $datos_admin .= "<tr>";
   $datos_admin .= "<td>Suma-></td>";
   for ($x=1; $x < 11; $x++) {
      $suma = 0;
      $y = $x;
      while ($y < 61) {
      $suma = $suma + $resultado['resultado_' . $y];
      $y = $y + 10;
      }
      $datos_admin .= "<td class='text-center'>";
      $datos_admin .= $suma;
      $datos_admin .= '</td>';
   }
   $datos_admin .= "</tr>";
   $datos_admin .= "<tr class='success'>";
   $datos_admin .= "<td>%-></td>";
   $mayor = 0;
   $columna = '';
   for ($x=1; $x < 11; $x++) {
      $suma = 0;
      $y = $x;
      while ($y < 61) {
         $suma = $suma + $resultado['resultado_' . $y];
         $y = $y + 10;
      }
      $suma = ($suma * 100) / 24;
      $suma = round($suma,0);
      $array_suma[$x] = $suma;

      if ($mayor < $suma) {
         $columna = 'Columna ' . $x;
         $mayor = $suma;
      }else {
         $mayor = $mayor;
      }
      $datos_admin .= "<td class='text-center'>";
      $datos_admin .= $suma;
      $datos_admin .= '%</td>';
   }
   $datos_admin .= "</tr>";
   $datos_admin .= "</table></div>";


   switch ($columna) {
      case 'Columna 1':
         $exitoCabeza = "Resultado del cuestionario";
         $scriptExito = '<script>$(document).ready(function(){$("#ventanaExito").modal("show");});</script>';
         $exito = '<h3>Tu campo de aplicacion es:</h3>
         <h4 class="text-justify"><strong>Servicio social.- </strong>Habilidad para comprender problemas humanos, para tratar a personas, cooperar y preocuparse por los demás. Actitud de ayuda desinteresada hacia sus semejantes.</h4>';
         break;
      case 'Columna 2':
         $exitoCabeza = "Resultado del cuestionario";
         $scriptExito = '<script>$(document).ready(function(){$("#ventanaExito").modal("show");});</script>';
         $exito = '<h3>Tu campo de aplicacion es:</h3>
         <h4 class="text-justify"><strong>Ejecutivo-persuasivo.- </strong>Capacidad para organizar, dirigir, supervisar y mandar a otros. Iniciativa, confianza en sí mismo, ambición de progreso. Habilidad para dominar a grupos y personas.</h4>';
         break;
      case 'Columna 3':
         $exitoCabeza = "Resultado del cuestionario";
         $scriptExito = '<script>$(document).ready(function(){$("#ventanaExito").modal("show");});</script>';
         $exito = '<h3>Tu campo de aplicacion es:</h3>
         <h4 class="text-justify"><strong>Verval.- </strong>Aptitu para comprender y expresar con corrección el idioma; para utilizar el lenguaje efectivamente en la comunicación con otros.</h4>';
         break;
      case 'Columna 4':
         $exitoCabeza = "Resultado del cuestionario";
         $scriptExito = '<script>$(document).ready(function(){$("#ventanaExito").modal("show");});</script>';
         $exito = '<h3>Tu campo de aplicacion es:</h3>
         <h4 class="text-justify"><strong>Artístico-Plástica.- </strong>Aptitud para apreciar las formas y los colores de los objetos. Para el dibujo, la escultura, la pintura y el grabado.</h4>';
         break;
      case 'Columna 5':
         $exitoCabeza = "Resultado del cuestionario";
         $scriptExito = '<script>$(document).ready(function(){$("#ventanaExito").modal("show");});</script>';
         $exito = '<h3>Tu campo de aplicacion es:</h3>
         <h4 class="text-justify"><strong>Musical.- </strong>Aptitud para captar y distinguir sonidos en sus diversas tonalidades, para imaginarlos, reproducirlos, utilizarlos en forma creativa. Sensibilidad en la combinación y armonía de sonidos.</h4>';
         break;
      case 'Columna 6':
         $exitoCabeza = "Resultado del cuestionario";
         $scriptExito = '<script>$(document).ready(function(){$("#ventanaExito").modal("show");});</script>';
         $exito = '<h3>Tu campo de aplicacion es:</h3>
         <h4 class="text-justify"><strong>Organización.- </strong>Aptitud para el orden y la exactitud, rapidez en el manejo de nombres, números, documentos, sistemas y sus detalles de trabajos rutinarios.</h4>';
         break;
      case 'Columna 7':
         $exitoCabeza = "Resultado del cuestionario";
         $scriptExito = '<script>$(document).ready(function(){$("#ventanaExito").modal("show");});</script>';
         $exito = '<h3>Tu campo de aplicacion es:</h3>
         <h4 class="text-justify"><strong>Científica.- </strong>Aptitud para la investigación y capacidad para captar, definir y comprender principios y relaciones causales de los fenómenos, buscando siempre la razón de estos.</h4>';
         break;
      case 'Columna 8':
         $exitoCabeza = "Resultado del cuestionario";
         $scriptExito = '<script>$(document).ready(function(){$("#ventanaExito").modal("show");});</script>';
         $exito = '<h3>Tu campo de aplicacion es:</h3>
         <h4 class="text-justify"><strong>Cálculo.- </strong>Dominio de las operaciones y mecanizaciones numéricas, así como de la habilidad para el cálculo matemático.</h4>';
         break;
      case 'Columna 9':
         $exitoCabeza = "Resultado del cuestionario";
         $scriptExito = '<script>$(document).ready(function(){$("#ventanaExito").modal("show");});</script>';
         $exito = '<h3>Tu campo de aplicacion es:</h3>
         <h4 class="text-justify"><strong>Mecanica-constructiva.- </strong>Comprensión y aptitud en la manipulación de objetos, facilidad para percibir e imaginar movimientos, así como facilidad para construir o reparar mecanismos.</h4>';
         break;
      case 'Columna 10':
         $exitoCabeza = "Resultado del cuestionario";
         $scriptExito = '<script>$(document).ready(function(){$("#ventanaExito").modal("show");});</script>';
         $exito = '<h3>Tu campo de aplicacion es:</h3>
         <h4 class="text-justify"><strong>Destreza manual.- </strong>Aptitud en el uso de las manos y dedos para el manejo de herramientas finas. Facilidad para realizar trabajos detallados con las manos.</h4>';
         break;
      default:
         $exitoCabeza = "Resultado del cuestionario";
         $scriptExito = '<script>$(document).ready(function(){$("#ventanaExito").modal("show");});</script>';
         $errores = '<h1>Ocurrio un error inesperado</h1>';
         break;
   }
}else {
   header('Location: index.php');
}

$titulo = 'Resultado cuestionario habilidades';
$pagina = 'result-skill-quiz.php';
require 'views/header.php';

$verificacion = verificacionUsuario();
if (!empty($verificacion)) {
   echo $verificacion;
}

require 'views/result-skill-quiz.view.php';
require 'views/footer.php';
?>
