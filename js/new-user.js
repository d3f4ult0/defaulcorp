var answerUserName = document.getElementById('userNameHelp');
var answerFullName = document.getElementById('fullNameHelp');
var answerEmail = document.getElementById('emailHelp');
var answerPass1 = document.getElementById('pass1Help');
var answerPass2 = document.getElementById('pass2Help');
var printUser = document.getElementById('pUser');
var printName = document.getElementById('pName');
var printPhone = document.getElementById('pPhone');
var printEmail = document.getElementById('pEmail');
var pSuccessMes = document.getElementById('pSuccessMes');
var pMes = document.getElementById('pMes');
var btnCheck = [false,false,false,false,false];

function checkUser(){
  var xmlhttp;
  var userName = document.getElementById('userName').value;
  if (window.XMLHttpRequest) {
    xmlhttp = new XMLHttpRequest();
  } else {
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }

  if (userName === "") {
    answerUserName.innerHTML = "<p class='red-text'>Nombre de usuario <b>requerido</b></p>";
    document.getElementById('userName').style.borderColor = "red";
    btnCheck[0] = false;
    activeButton();
  }else {
    xmlhttp.onreadystatechange = function(){
      if (this.readyState === 4 && this.status === 200) {
        var answer = JSON.parse(this.responseText);
        // answerUserName.innerHTML = this.responseText;
        if (answer['checkUser'] == 1) {
          answerUserName.innerHTML = "<p class='green-text'>El usuario <b>" + answer['userN'] + "</b> esta disponible</p>";
          document.getElementById('userName').style.borderColor = "green";
          btnCheck[0] = true;
          activeButton();
          printUser.innerHTML = answer['userN'];
        }else {
          answerUserName.innerHTML = "<p class='red-text'>El usuario <b>" + answer['userN'] + "</b> no esta disponible</p>";
          document.getElementById('userName').style.borderColor = "red";
          btnCheck[0] = false;
          activeButton();
        }
      }
    }
    xmlhttp.open("GET","ajax/new-user.ajax.php?userName="+userName+"&email=",true);
    xmlhttp.send();
  }
}

function checkFullName(){
  var fullName = document.getElementById('fullName').value;
  if (fullName === "") {
    answerFullName.innerHTML = "<p class='red-text'>Nombre completo <b>requerido</b></p>";
    document.getElementById('fullName').style.borderColor = "red";
    btnCheck[1] = false;
  } else {
    answerFullName.innerHTML = "";
    document.getElementById('fullName').style.borderColor = "green";
    btnCheck[1] = true;
    pName.innerHTML = fullName;
  }
  activeButton();
}

function checkPhone(){
  var phone = document.getElementById('phone').value;
  if (phone === "") {
    pPhone.innerHTML = "Sin definir";
  } else {
    pPhone.innerHTML = phone;
  }
}

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
          if (answer['checkEmail'] == 1) {
            answerEmail.innerHTML = "<p class='green-text'>El correo <b>" + answer['emailN'] + "</b> esta disponible</p>";
            document.getElementById('email').style.borderColor = "green";
            btnCheck[2] = true;
            activeButton();
            printEmail.innerHTML = answer['emailN'];
          }else {
            answerEmail.innerHTML = "<p class='red-text'>El correo <b>" + email + "</b> ya se encuentra registrado.</br>Si perdio su contraseña puede <a href='restore.php'>restaurar contraseña</a></p>";
            document.getElementById('email').style.borderColor = "red";
            btnCheck[2] = false;
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

function checkPass1(){
  var pass1 = document.getElementById('pass1').value;
  if (pass1 === "") {
    answerPass1.innerHTML = "<p class='red-text'>Contraseña <b>requerida</b></p>";
    document.getElementById('pass1').style.borderColor = "red";
    btnCheck[3] = false;
    checkPass2();
    activeButton();
  } else {
    if (pass1.length >= 6) {
      answerPass1.innerHTML = "";
      document.getElementById('pass1').style.borderColor = "green";
      btnCheck[3] = true;
      checkPass2();
      activeButton();
    } else {
      answerPass1.innerHTML = "<p class='red-text'>La contraseña debe contener <b>6 caracteres o mas</b></p>";
      document.getElementById('pass1').style.borderColor = "red";
      btnCheck[3] = false;
      checkPass2();
      activeButton();
    }
  }
}
function checkPass2(){
  var pass1 = document.getElementById('pass1').value;
  var pass2 = document.getElementById('pass2').value;
  if (pass1 === pass2) {
    answerPass2.innerHTML = "<p class='green-text'>Las contraseñas <b>coinciden</b></p>";
    document.getElementById('pass2').style.borderColor = "green";
    btnCheck[4] = true;
    activeButton();
  }else {
    answerPass2.innerHTML = "<p class='red-text'>Las contraseñas <b>no coinciden</b></p>";
    document.getElementById('pass2').style.borderColor = "red";
    btnCheck[4] = false;
    activeButton();
  }
}

function activeButton(){
  if (btnCheck[0] == true && btnCheck[1] == true && btnCheck[2] == true && btnCheck[3] == true && btnCheck[4] == true) {
    document.getElementById('buttonNewUser').disabled=false;
  } else {
    document.getElementById('buttonNewUser').disabled=true;
  }
}
function desactiveButton(){
  answerUserName.innerHTML = "El nombre de usuario solo reconoce minusculas.";
  document.getElementById('userName').style.borderColor = "#ced4da";
  btnCheck[0] = false;
  answerFullName.innerHTML = "Nombre y apellidos del funcionario (requerido)";
  document.getElementById('fullName').style.borderColor = "#ced4da";
  btnCheck[1] = false;
  answerEmail.innerHTML = "Correo del funcionario (requerido)";
  document.getElementById('email').style.borderColor = "#ced4da";
  btnCheck[2] = false;
  answerPass1.innerHTML = "Contraseña de 6 digitos o mas";
  document.getElementById('pass1').style.borderColor = "#ced4da";
  btnCheck[3] = false;
  answerPass2.innerHTML = "";
  document.getElementById('pass2').style.borderColor = "#ced4da";
  btnCheck[4] = false;
  document.getElementById('buttonNewUser').disabled=true;
}
function registrar(){
  var xmlhttp;
  var userName = document.getElementById('userName').value;
  var fullName = document.getElementById('fullName').value;
  var email = document.getElementById('email').value;
  var phone = document.getElementById('phone').value;
  var pass1 = document.getElementById('pass1').value;

  if (window.XMLHttpRequest) {
    xmlhttp = new XMLHttpRequest();
  } else {
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }

  if (btnCheck[0] == true && btnCheck[1] == true && btnCheck[2] == true && btnCheck[3] == true && btnCheck[4] == true) {
    xmlhttp.onreadystatechange = function(){
      if (this.readyState === 4 && this.status === 200) {
        var answer = JSON.parse(this.responseText);
        // answerUserName.innerHTML = this.responseText;
        if (answer['registerNum'] > 0) {
          pSuccessMes.innerHTML = answer['registerMes'];
          pMes.innerHTML = 'El usuario: <strong>'+answer['registerUser']+'</strong> fue registrado con exito con el folio <strong>U-'+answer['registerNum']+'</strong>.<br>Favor de consultar su correo para verificar su cuenta y poder iniciar sesión.';
          mensajeExito();
          desactiveButton();
          document.getElementById("newUser").reset();
        } else {
          pSuccessMes.innerHTML = "Fallo registro";
          pMes.innerHTML = "Ocurrio un error con el servidor.<br>Favor de intentarlo mas tarde.<br>Si el problema persiste favor de contactar con el administrador";
          mensajeExito();
        }
      }
    }
    xmlhttp.open("POST","ajax/register.ajax.php",true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("user="+userName+"&name="+fullName+"&email="+email+"&phone="+phone+"&pass="+pass1);
  }else {
    pSuccessMes.innerHTML = "Fallo registro";
    pMes.innerHTML = answer['registerMes'];
    mensajeExito();
  }
}

function mensajeExito() {
  var myVar = setInterval(okModal, 3500);
  function okModal(){
    $('#modalLoad').modal('hide');
    $('#modalSuccess').modal('show');
    clearInterval(myVar);
  }
}
