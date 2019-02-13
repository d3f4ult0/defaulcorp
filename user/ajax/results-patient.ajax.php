<?php session_start();

require '../../configs/configs.php';
require '../../configs/functions.php';

$conexion = conexion($bd_config);
if (!$conexion) {
   header('Location: error.php');
}

$resultados = obtenerTodosConCondicion('cuestionarios_paciente','paciente_id',$_SESSION['paciente_id'],$conexion); ?>
<table class="table table-striped table-bordered table-hover table-condensed">
   <tr class="info">
      <th class="text-center">ID</th>
      <th class="text-center">Nombre cuestionario</th>
      <th class="text-center">Fecha</th>
      <th class="text-center">Acciones</th>
   </tr>
   <?php foreach ($resultados as $resultado): ?>
      <tr>
         <td class="text-center"><?php echo $resultado['resultado_id']; ?></td>
         <td class="text-center"><?php echo $resultado['nombre_cuestionario']; ?></td>
         <td class="text-center"><?php echo fechaCompleta($resultado['fecha_aplicacion']); ?></td>
         <td class="text-center campo-botones">
            <a class="btn btn-xs btn-block btn-success" href="result-skill-quiz.php?token=<?php echo $_SESSION['password_usuario'].'&paciente='.$_SESSION['paciente_id'].'&cuestionarioNo='.$resultado['resultado_id'];?>"> Ver</a>
            <button class="btn btn-xs btn-block btn-danger" type="button" id="borrar-resultado-<?php echo $resultado['resultado_id']; ?>">Borrar</button>
         </td>
      </tr>
      <div class="modal fade" id="borrarResultado-<?php echo $resultado['resultado_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" data-keyboard="false" data-backdrop="static">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header" id="headerBorrar-<?php echo $resultado['resultado_id']; ?>">
                  <h4 class="modal-title">¿Borrar resultado?</h4>
               </div>

               <div class="modal-body" id="mensajeBorrar-<?php echo $resultado['resultado_id']; ?>">
                  <ul>
                     <li>Esta seguro que desea borrar el resultado de fecha <strong><?php echo fechaCompleta($resultado['fecha_aplicacion']); ?></strong></li>
                     <li>Si esta seguro presione el boton <strong>borrar</strong></li>
                  </ul>
                  <span class="rojo text-center"><h4>¡Esta acción no se puede deshacer!</h4></span>
               </div>

               <div class="modal-footer" id="footerBorrar-<?php echo $resultado['resultado_id']; ?>">
                  <button class="btn btn-warning" type="button" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                  <button class="btn btn-danger" type="button" id="confirmarBorrado-<?php echo $resultado['resultado_id']; ?>"><span class="glyphicon glyphicon-ok"></span> Borrar usuario</button>
               </div>
            </div>
         </div>
      </div>
   <?php endforeach; ?>
</table>
<?php require '../js/delete-result.php'; ?>
