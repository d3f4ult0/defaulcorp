var answerEmail = document.getElementById('emailHelp');
var pSuccessMes = document.getElementById('pSuccessMes');
var pMes = document.getElementById('pMes');
var pRestoreMes = document.getElementById('restoreMes');
var pRestoreMes2 = document.getElementById('restoreMes2');
var btnCheck = [false];

function checkEmail(){
  var email = document.getElementById('email').value;
  var xmlhttp;
  if (window.XMLHttpRequest) {
    xmlhttp = new XMLHttpRequest();
  } else {
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }

  if (email === "") {
    answerEmail.innerHTML = "<p class='red-text'>Correo <b>requerido</b></p>";
    document.getElementById('email').style.borderColor = "red";
    btnCheck[2] = false;
    activeButton();
  }else {
    emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i
    if (emailRegex.test(email)) {
      xmlhttp.onreadystatechange = function(){
        if (this.readyState === 4 && this.status === 200) {
          var answer = JSON.parse(this.responseText);
          if (answer['checkEmail'] == 0) {
            answerEmail.innerHTML = "";
            document.getElementById('email').style.borderColor = "green";
            btnCheck[0] = true;
            activeButton();
          }else {
            answerEmail.innerHTML = "<p class='red-text'>El correo <b>" + email + "</b> no se encuentra registrado.</br>Puede <a href='new-user.php'>resgistrarse</a> como nuevo usuario.</p>";
            document.getElementById('email').style.borderColor = "red";
            btnCheck[0] = false;
            activeButton();
          }
        }
      }
      xmlhttp.open("GET","ajax/new-user.ajax.php?email="+email+"&userName=",true);
      xmlhttp.send();
    } else {
      answerEmail.innerHTML = "<p class='red-text'>Formato de correo <b> no valido.</b></p>";
      document.getElementById('email').style.borderColor = "red";
      btnCheck[2] = false;
      activeButton();
    }
  }
}
function activeButton(){
  if (btnCheck[0] == true) {
    document.getElementById('bRestore').disabled=false;
  } else {
    document.getElementById('bRestore').disabled=true;
  }
}

function recuperar() {
  var xmlhttp;
  var email = document.getElementById('email').value;

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
        pMes.innerHTML = 'Las instrucciones para recuperar la contraseña, fueron enviadas al correo <strong>'+answer['registerMail']+'</strong> con el folio <strong>U-'+answer['registerNum']+'</strong>.<br>Favor de revisar su correo para poder recuperar su contraseña.';
        mensajeExito();
        var myVar2 = setInterval(function () {
          pRestoreMes2.innerHTML = "<br>";
          pRestoreMes.innerHTML = '<h3>Las instrucciones para recuperar la contraseña, fueron enviadas al correo <strong>'+answer['registerMail']+'</strong> con el folio <strong>U-'+answer['registerNum']+'</strong>.<br>Favor de revisar su correo para poder recuperar su contraseña.</h3>';
          clearInterval(myVar2);
        }, 3500);
      } else {
        pSuccessMes.innerHTML = "Algo salio mal";
        pMes.innerHTML = "Ocurrio un error con el servidor.<br>Favor de intentarlo mas tarde.<br>Si el problema persiste favor de contactar con el administrador";
        mensajeExito();
      }
    }
  }
  xmlhttp.open("POST","ajax/restore.ajax.php",true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send("email="+email);
}

function mensajeExito() {
  var myVar = setInterval(okModal, 3500);
  function okModal(){
    $('#modalLoad').modal('hide');
    $('#modalSuccess').modal('show');
    clearInterval(myVar);
  }
}
