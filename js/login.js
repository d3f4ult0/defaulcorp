$(document).ready(function(){
   $("#iniciar").click(function(e){
      e.preventDefault();
      if ($("#input-login-usuario").val() === '') {
         $("#respuesta").html('<div class="alert alert-danger"><button class="close" data-dismiss="alert"><span>&times;</span></button><ul><li>Ingrese su <strong>nombre de usuario</strong> o <strong>correo</strong></li></ul></div>');
      }else if ($("#input-login-password").val() === '') {
         $("#respuesta").html('<div class="alert alert-danger"><button class="close" data-dismiss="alert"><span>&times;</span></button><ul><li>Ingrese su <strong>contraseña</strong>');
      }else {
         $.post("ajax/login.ajax.php", {
            usuario: $("#input-login-usuario").val(),
            password: $("#input-login-password").val()
         }, function(respuestaServidorLogin){
            $("#respuesta").html(respuestaServidorLogin);
            if (respuestaServidorLogin == '<div class="alert alert-success"><ul><li>Iniciando sesión <img src="resources/ajax-loader(1).gif"></li></ul></div>') {
               setTimeout(function(){
                  window.location.href = "login.php";
               }, 3000);
            }
         });
      }
   });
});
