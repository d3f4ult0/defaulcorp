var identificacionHelp = document.getElementById('identificacionHelp');
var numeroHelp = document.getElementById('numeroHelp');
var licenciaHelp = document.getElementById('licenciaHelp');
var tarjetonHelp = document.getElementById('tarjetonHelp');
var fechaHelp = document.getElementById('fechaHelp');
var estatusHelp = document.getElementById('estatusHelp');
var printTipoUsuario = document.getElementById('tipoUsuario')
var printID = document.getElementById('printID');
var printUsuario = document.getElementById('printUsuario');
var printNombre = document.getElementById('printNombre');
var printCorreo = document.getElementById('printCorreo');
var printTitleMes = document.getElementById('pSuccessMes');
var printMes = document.getElementById('pMes');
var printForm = document.getElementById('new-chofer');
var btnCheck = [false,false,false,false,false,false];

function checkIdentificacion(){
  var identificacion = document.getElementById('identificacion').value;
  if (identificacion == 0) {
    identificacionHelp.innerHTML = "<p class='red-text'>Seleccione un tipo de <b>identificación</b> valido</p>";
    document.getElementById('identificacion').style.borderColor = "red";
    btnCheck[0] = false;
    activeButton();
  }else {
    identificacionHelp.innerHTML = "";
    document.getElementById('identificacion').style.borderColor = "green";
    printTipoUsuario.innerHTML = "Chofer";
    printID.innerHTML = document.getElementById('number').value;
    printUsuario.innerHTML = document.getElementById('usuario').value;
    printNombre.innerHTML = document.getElementById('nombre').value;
    printCorreo.innerHTML = document.getElementById('correo').value;
    btnCheck[0] = true;
    activeButton();
  }
}
function checkNumero(){
  var numero = document.getElementById('numero').value;
  if (numero === "") {
    numeroHelp.innerHTML = "<p class='red-text'>Ingrese <b>numero</b> de la identificación valido</p>";
    document.getElementById('numero').style.borderColor = "red";
    btnCheck[1] = false;
    activeButton();
  }else {
    numeroHelp.innerHTML = "";
    document.getElementById('numero').style.borderColor = "green";
    btnCheck[1] = true;
    activeButton();
  }
}
function checkLicencia(){
  var licencia = document.getElementById('licencia').value;
  if (licencia === "") {
    licenciaHelp.innerHTML = "<p class='red-text'>Ingrese <b>numero</b> de la licencia del tipo A-00000</p>";
    document.getElementById('licencia').style.borderColor = "red";
    btnCheck[2] = false;
    activeButton();
  }else {
    licenciaHelp.innerHTML = "";
    document.getElementById('licencia').style.borderColor = "green";
    btnCheck[2] = true;
    activeButton();
  }
}
function checkTarjeton(){
  var tarjeton = document.getElementById('tarjeton').value;
  if (tarjeton === "") {
    tarjetonHelp.innerHTML = "<p class='red-text'>Ingrese <b>numero</b> del tarjeton</p>";
    document.getElementById('tarjeton').style.borderColor = "red";
    btnCheck[3] = false;
    activeButton();
  }else {
    tarjetonHelp.innerHTML = "";
    document.getElementById('tarjeton').style.borderColor = "green";
    btnCheck[3] = true;
    activeButton();
  }
}
function checkFecha(){
  var verFecha = new Date();
  var fecha = new Date(document.getElementById('fecha').value);
  if (fecha < verFecha) {
    fechaHelp.innerHTML = "<p class='red-text'><b>Fecha</b> invalida, el tarjeton esta vencido.</p>"
    document.getElementById('fecha').style.borderColor = "red";
    btnCheck[4] = false;
    activeButton();
  }else {
    fechaHelp.innerHTML = ""
    document.getElementById('fecha').style.borderColor = "green";
    btnCheck[4] = true;
    activeButton();
    checkEstatus();
  }
}
function checkEstatus(){
  var estatus = document.getElementById('estatus').value;
  if (estatus == 0) {
    estatusHelp.innerHTML = "<p class='red-text'>Seleccione un <b>estatus</b> valido</p>";
    document.getElementById('estatus').style.borderColor = "red";
    btnCheck[5] = false;
    activeButton();
    console.log("Estatus cargado");
  }else {
    estatusHelp.innerHTML = "";
    document.getElementById('estatus').style.borderColor = "green";
    btnCheck[5] = true;
    activeButton();
  }
}
function desactiveButton(){
  btnCheck[0] = false;
  btnCheck[1] = false;
  btnCheck[2] = false;
  btnCheck[3] = false;
  btnCheck[4] = false;
  btnCheck[5] = false;
  identificacionHelp.innerHTML = "";
  document.getElementById('identificacion').style.borderColor = "#ced4da";
  numeroHelp.innerHTML = "El numero de la identificacion puede contener letras y números hasta 20 caracteres.";
  document.getElementById('numero').style.borderColor = "#ced4da";
  licenciaHelp.innerHTML = "El numero de la licencia debe comenzar con el tipo de licencia. Ejemplo: A-00000";
  document.getElementById('licencia').style.borderColor = "#ced4da";
  tarjetonHelp.innerHTML = "Puede contener hasta 15 caracteres.";
  document.getElementById('tarjeton').style.borderColor = "#ced4da";
  fechaHelp.innerHTML = "No puede estar vencido."
  document.getElementById('fecha').style.borderColor = "#ced4da";
  estatusHelp.innerHTML = "";
  document.getElementById('estatus').style.borderColor = "#ced4da";
  activeButton();
}
function activeButton(){
  if (btnCheck[0] == true && btnCheck[1] == true && btnCheck[2] == true && btnCheck[3] == true && btnCheck[4] == true && btnCheck[5] == true) {
    document.getElementById('buttonNewChofer').disabled=false;
  } else {
    document.getElementById('buttonNewChofer').disabled=true;
  }
}
function newCambio(){
  var id = document.getElementById('number').value;
  var identificacion = document.getElementById('identificacion').value;
  var numero = document.getElementById('numero').value;
  var licencia = document.getElementById('licencia').value;
  var tarjeton = document.getElementById('tarjeton').value;
  var fecha = document.getElementById('fecha').value;
  var estatus = document.getElementById('estatus').value;

  var xmlhttp;
  if (window.XMLHttpRequest) {
    xmlhttp = new XMLHttpRequest();
  } else {
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }

  if (btnCheck[0] == true && btnCheck[1] == true && btnCheck[2] == true && btnCheck[3] == true && btnCheck[4] == true && btnCheck[5] == true) {
    xmlhttp.onreadystatechange = function(){
      if (this.readyState === 4 && this.status === 200) {
        var answer = JSON.parse(this.responseText);
        // answerUserName.innerHTML = this.responseText;
        if (answer['num'] > 0) {
          printTitleMes.innerHTML = answer['mesTitle'];
          printMes.innerHTML = answer['mes'];
          mensajeExito();
          var myVar2 = setInterval(function () {
            printForm.innerHTML = "<br><br><h1 class='text-center'>"+answer['mesTitle']+"</h1><h2>"+answer['mes']+"</h2>";
            clearInterval(myVar2);
          }, 4000);
        } else {
          printTitleMes.innerHTML = "Fallo registro";
          printMes.innerHTML = "Ocurrio un error con el servidor.<br>Favor de intentarlo mas tarde.<br>Si el problema persiste favor de contactar con el administrador";
          mensajeExito();
        }
      }
    }
    xmlhttp.open("POST","ajax/new-chofer.ajax.php",true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("id="+id+"&identificacion="+identificacion+"&numero="+numero+"&fecha="+fecha+"&licencia="+licencia+"&tarjeton="+tarjeton+"&estatus="+estatus);
  }else {
    printTitleMes.innerHTML = "Error inesperado :(";
    printMes.innerHTML = "Error inesperado :(";
    mensajeExito();
  }
}
function mensajeExito() {
  var myVar = setInterval(okModal, 4000);
  function okModal(){
    $('#modalLoad').modal('hide');
    $('#modalSuccess').modal('show');
    clearInterval(myVar);
  }
}
