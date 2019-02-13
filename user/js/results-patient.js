$(document).ready(function(){
   function cargarUsuarios() {
      $("#tablaResultados").load("ajax/results-patient.ajax.php");
   }
   cargarUsuarios();

   $("#terminarBorrado").click(function(){
      $("#tablaResultados").load("ajax/results-patient.ajax.php");
   });
});
