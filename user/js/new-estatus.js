var numeroHelp = document.getElementById('numeroHelp');
var nombreHelp = document.getElementById('nombreHelp');
var btnCheck = [false,false];

function checkTipo() {
  var xmlhttp;
  var tipo = document.getElementById('tipo').value;
  if (window.XMLHttpRequest) {
    xmlhttp = new XMLHttpRequest();
  } else {
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  if (tipo === 0) {
    document.getElementById('tipo').style.borderColor = "red";
    document.getElementById('numero').style.borderColor = "red";
    numeroHelp.innerHTML = "<p class='red-text'>Seleccione un <b>tipo de estatus</b> para que el sistema le asigne un numero.</p>";
    btnCheck[0] = false;
    activeButton();
  } else {
    xmlhttp.onreadystatechange = function(){
      if (this.readyState === 4 && this.status === 200) {
        var answer = JSON.parse(this.responseText);
        // answerUserName.innerHTML = this.responseText;
        if (answer['check'] == 1) {
          document.getElementById('tipo').style.borderColor = "green";
          document.getElementById('numero').style.borderColor = "green";
          document.getElementById('numero').value = answer['num']
          numeroHelp.innerHTML = "";
          btnCheck[0] = true;
          activeButton();
        }else {
          document.getElementById('tipo').style.borderColor = "red";
          document.getElementById('numero').style.borderColor = "red";
          numeroHelp.innerHTML = "<p class='red-text'>"+answer['error']+"</p>";
          btnCheck[0] = false;
          activeButton();
        }
      }
    }
    xmlhttp.open("GET","ajax/new-estatus.ajax.php?tipo="+tipo,true);
    xmlhttp.send();
  }
}

function checkNombre(){
  var nombre = document.getElementById('nombre').value;
  if (nombre = "") {
    document.getElementById('nombre').style.borderColor = "red";
    nombreHelp.innerHTML = "<p class='red-text'>De un <b>nombre</b> al estatus.</p>";
    btnCheck[0] = false;
    activeButton();
  } else {
    document.getElementById('nombre').style.borderColor = "green";
    nombreHelp.innerHTML = "";
    btnCheck[0] = true;
    activeButton();
  }
}

function activeButton(){
  if (btnCheck[0] == true && btnCheck[1] == true) {
    document.getElementById('buttonNewStatus').disabled=false;
  } else {
    document.getElementById('buttonNewStatus').disabled=true;
  }
}
