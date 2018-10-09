var pSuccessMes = document.getElementById('pSuccessMes');
var pMes = document.getElementById('pMes');

function verificar() {
  var xmlhttp;
  var number = document.getElementById('number').value;

  if (window.XMLHttpRequest) {
    xmlhttp = new XMLHttpRequest();
  } else {
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }

  xmlhttp.onreadystatechange = function(){
    if (this.readyState === 4 && this.status === 200) {
      var answer = JSON.parse(this.responseText);
      // answerUserName.innerHTML = this.responseText;
      if (answer['registerNum'] > 0) {
        pSuccessMes.innerHTML = answer['registerMes'];
        pMes.innerHTML = 'El correo <strong>'+answer['registerMail']+'</strong> fue verificado con exito con el folio <strong>U-'+answer['registerNum']+'</strong>.<br>Ya puede iniciar sesión con su usuario o correo y contraseña.';
        mensajeExito();
        var myVar2 = setInterval(redirigir, 8000);
      } else {
        pSuccessMes.innerHTML = "Fallo registro";
        pMes.innerHTML = "Ocurrio un error con el servidor.<br>Favor de intentarlo mas tarde.<br>Si el problema persiste favor de contactar con el administrador";
        mensajeExito();
      }
    }
  }
  xmlhttp.open("POST","ajax/verify.ajax.php",true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send("number="+number);
}
function mensajeExito() {
  var myVar = setInterval(okModal, 3500);
  function okModal(){
    $('#modalLoad').modal('hide');
    $('#modalSuccess').modal('show');
    clearInterval(myVar);
  }
}
function redirigir(){
  location.href="login.php";
}
