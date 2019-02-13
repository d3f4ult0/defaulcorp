$(document).ready(function(){
   function traerPregunta() {
      if (numPregunta === 0) {
         $.post("ajax/next-question.ajax.php", {
            paciente: $("#paciente").val(),
            preguntaNo: numPregunta
         }, function(respuestaServidoCuestionario){
            $("#pregunta").html(respuestaServidoCuestionario);
            $('#pregunta').animate({
              left: "0%"
           }, 500, "swing");
         });
      }else {
         $.post("ajax/next-question.ajax.php", {
            paciente: $("#paciente").val(),
            resultadoNo: $("#resultadoNo").val(),
            preguntaNo: numPregunta,
            respuesta: $("input:radio[name=respuesta]:checked").val()
         }, function(respuestaServidoCuestionario){
            $("#pregunta").html(respuestaServidoCuestionario);
            $('#pregunta').animate({
              left: "0%"
           }, 500, "swing");
         });
      }
   }

   function animarPregunta() {
      $('#pregunta').animate({
        left: "-120%"
     }, 1500, "swing",traerPregunta);
   }

   $("#siguiente").click(function(e){
      numPregunta++;
      animarPregunta();
   });

   $("#comenzarCuestionario").click(function(e){
      numPregunta = 0;
      animarPregunta();
   });
});
