var answerUserName = document.getElementById('userNameHelp');
var answerPass = document.getElementById('passHelp');
var pSuccessMes = document.getElementById('pSuccessMes');
var pMes = document.getElementById('pMes');
var btnCheck = [false,false];

function checkUser(){
  var name = document.getElementById('userName').value;
  if (name === "") {
    answerUserName.innerHTML = "<p class='red-text'>Nombre de usuario o correo <b>requerido</b></p>";
    document.getElementById('userName').style.borderColor = "red";
    btnCheck[0] = false;
  } else {
    answerUserName.innerHTML = "";
    document.getElementById('userName').style.borderColor = "green";
    btnCheck[0] = true;
  }
  activeButton();
}
function checkPass(){
  var pass = document.getElementById('pass').value;
  if (pass === "") {
    answerPass.innerHTML = "<p class='red-text'>Contraseña <b>requerida</b>.</br>Si perdio su contraseña puede <a href='restore.php'>restaurar contraseña</a></p>";
    document.getElementById('pass').style.borderColor = "red";
    btnCheck[1] = false;
  } else {
    answerPass.innerHTML = "";
    document.getElementById('pass').style.borderColor = "green";
    btnCheck[1] = true;
  }
  activeButton();
}
function activeButton(){
  if (btnCheck[0] == true && btnCheck[1] == true) {
    document.getElementById('access').disabled=false;
  } else {
    document.getElementById('access').disabled=true;
  }

}
function iniciar(){
  var xmlhttp;
  var name = document.getElementById('userName').value;
  var pass = document.getElementById('pass').value;

  if (window.XMLHttpRequest) {
    xmlhttp = new XMLHttpRequest();
  } else {
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }

  xmlhttp.onreadystatechange = function(){
    if (this.readyState === 4 && this.status === 200) {
      var answer = JSON.parse(this.responseText);
      // answerUserName.innerHTML = this.responseText;
      if (answer['registerNum'] == 1) {
        var myVar = setInterval(redirigir, 2000);
      } else {
        pSuccessMes.innerHTML = answer['registerMes'];
        pMes.innerHTML = "<h5>Nombre de usuario y/o contraseña incorrectos.<br>Favor de veridicar sus Datos.<br>Si perdio su contraseña puede <a href='restore.php'>restaurar contraseña</a></h5>";
        mensajeExito();
      }
    }
  }
  xmlhttp.open("POST","ajax/login.ajax.php",true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send("name="+name+"&pass="+pass);
}
function redirigir(){
  var site = document.getElementById('site').value
  location.href= site+"user/index.php";
}
function mensajeExito() {
  var myVar = setInterval(okModal, 2500);
  function okModal(){
    $('#modalLoad').modal('hide');
    $('#modalSuccess').modal('show');
    clearInterval(myVar);
  }
}
