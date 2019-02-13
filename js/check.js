$(document).ready(function(){
   $(document).ready(function(){
      $("#ventanaExito").modal("show");
   });

   $.post("ajax/check.ajax.php", {
      id: '.$id.',
      token: '.$token.'
   }, function(respuestaServidor){
      $("#respuesta").html(respuestaServidor);
      $("#ventanaExitoVer").modal("show");
   });
});
