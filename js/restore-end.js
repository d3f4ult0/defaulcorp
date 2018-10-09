var answerPass1 = document.getElementById('pass1Help');
var answerPass2 = document.getElementById('pass2Help');
var pSuccessMes = document.getElementById('pSuccessMes');
var pMes = document.getElementById('pMes');
var pRestoreMes = document.getElementById('restoreMes');
var pRestoreMes2 = document.getElementById('restoreMes2');
var btnCheck = [false, false];

function checkPass1(){
  var pass1 = document.getElementById('pass1').value;
  if (pass1 === "") {
    answerPass1.innerHTML = "<p class='red-text'>Contraseña <b>requerida</b></p>";
    document.getElementById('pass1').style.borderColor = "red";
    btnCheck[0] = false;
    checkPass2();
    activeButton();
  } else {
    if (pass1.length >= 6) {
      answerPass1.innerHTML = "";
      document.getElementById('pass1').style.borderColor = "green";
      btnCheck[0] = true;
      checkPass2();
      activeButton();
    } else {
      answerPass1.innerHTML = "<p class='red-text'>La contraseña debe contener <b>6 caracteres o mas</b></p>";
      document.getElementById('pass1').style.borderColor = "red";
      btnCheck[0] = false;
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
    btnCheck[1] = true;
    activeButton();
  }else {
    answerPass2.innerHTML = "<p class='red-text'>Las contraseñas <b>no coinciden</b></p>";
    document.getElementById('pass2').style.borderColor = "red";
    btnCheck[1] = false;
    activeButton();
  }
}

function activeButton(){
  if (btnCheck[0] == true && btnCheck[1] == true) {
    document.getElementById('bRestore').disabled=false;
  } else {
    document.getElementById('bRestore').disabled=true;
  }
}

function recuperar() {
  var xmlhttp;
  var pass = document.getElementById('pass1').value;
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
        pMes.innerHTML = 'La contraseña fue cambiada con exito, con el folio <strong>U-'+answer['registerNum']+'</strong>.';
        mensajeExito();
        var myVar2 = setInterval(function () {
          pRestoreMes2.innerHTML = "<br>";
          pRestoreMes.innerHTML = '<h3>La contraseña fue cambiada con exito, con el folio <strong>U-'+answer['registerNum']+'</strong>.</h3>';
          clearInterval(myVar2);
        }, 3500);
      } else {
        pSuccessMes.innerHTML = "Algo salio mal";
        pMes.innerHTML = "Ocurrio un error con el servidor.<br>Favor de intentarlo mas tarde.<br>Si el problema persiste favor de contactar con el administrador";
        mensajeExito();
      }
    }
  }
  xmlhttp.open("POST","ajax/restore-end.ajax.php",true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send("pass="+pass+"&id="+number);
}

function mensajeExito() {
  var myVar = setInterval(okModal, 3500);
  function okModal(){
    $('#modalLoad').modal('hide');
    $('#modalSuccess').modal('show');
    clearInterval(myVar);
  }
}
