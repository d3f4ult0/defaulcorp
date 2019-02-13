$(document).ready(function(){

   function verificarUsuario() {
      $("#usuario").html('<img src="resources/ajax-loader(1).gif">');
      if ($("#input-usuario").val() === ''){
         $("#usuario").html("<span class='glyphicon glyphicon-remove mal'></span>");
      }else {
         $("#usuario").load("ajax/restore.ajax.php", {usuario: $("#input-usuario").val()});
      }
   }

   $("#input-usuario").blur(verificarUsuario);

   $("#entendido").click(function(){
        $("#ventanaExito").modal("hide");
        verificarUsuario();
    });

});
