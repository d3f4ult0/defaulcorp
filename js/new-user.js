$(document).ready(function(){

   function verificarUsuario() {
      $("#usuario").html('<img src="resources/ajax-loader(1).gif">');
      if ($("#input-usuario").val() === ''){
         $("#usuario").html("<span class='glyphicon glyphicon-remove mal'></span>");
      }else {
         $("#usuario").load("ajax/new-user.ajax.php", {usuario: $("#input-usuario").val()});
      }
   }
   function verificarCorreo() {
      $("#correo").html('<img src="resources/ajax-loader(1).gif">');
      if ($("#input-correo").val() === '') {
         $("#correo").html("<span class='glyphicon glyphicon-remove mal'></span>");
      }else {
         $("#correo").load("ajax/new-user.ajax.php", {correo: $("#input-correo").val()});
      }
   }
   function verificarCorreo2() {
      $("#correo2").html('<img src="resources/ajax-loader(1).gif">');
      if ($("#input-correo2").val() === '') {
         $("#correo2").html("<span class='glyphicon glyphicon-remove mal'></span>");
      }else {
         if ($("#input-correo").val() == $("#input-correo2").val()) {
            $("#correo2").html("<span class='glyphicon glyphicon-ok bien'></span>");
         }else {
            $("#correo2").html("<span class='glyphicon glyphicon-remove mal'></span>");
         }
      }
   }
   function verificarNombre() {
      $("#nombre").html('<img src="resources/ajax-loader(1).gif">');
      if ($("#input-nombre").val() === '') {
         $("#nombre").html("<span class='glyphicon glyphicon-remove mal'></span>");
      }else {
         $("#nombre").html("<span class='glyphicon glyphicon-ok bien'></span>");
      }
   }
   function verificarPass() {
      $("#pass").html('<img src="resources/ajax-loader(1).gif">');
      if ($("#input-pass").val() === '') {
         $("#pass").html("<span class='glyphicon glyphicon-remove mal'></span>");
      }else {
         if ($("#input-pass").val().length >= 5) {
            $("#pass").html("<span class='glyphicon glyphicon-ok bien'></span>");
         } else {
            $("#pass").html("<span class='glyphicon glyphicon-remove mal'></span>");
         }
      }
   }
   function verificarPass2() {
      $("#pass2").html('<img src="resources/ajax-loader(1).gif">');
      if ($("#input-pass2").val() === '') {
         $("#pass2").html("<span class='glyphicon glyphicon-remove mal'></span>");
      } else {
         if ($("#input-pass").val() === $("#input-pass2").val()) {
            $("#pass2").html("<span class='glyphicon glyphicon-ok bien'></span>");
         }else {
            $("#pass2").html("<span class='glyphicon glyphicon-remove mal'></span>");
         }
      }
   }

   function verificarTodo(){
      verificarUsuario();
      verificarCorreo();
      verificarCorreo2();
      verificarNombre();
      verificarPass();
      verificarPass2();
   }

   $("#input-usuario").blur(verificarUsuario);
   $("#input-correo").blur(verificarCorreo);
   $("#input-correo2").blur(verificarCorreo2);
   $("#input-nombre").blur(verificarNombre);
   $("#input-pass").blur(verificarPass);
   $("#input-pass2").blur(verificarPass2);

   $("#entendido").click(function(){
        $("#ventanaExito").modal("hide");
        verificarTodo();
    });

});
