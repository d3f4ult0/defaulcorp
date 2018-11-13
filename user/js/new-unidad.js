var placasHelp = document.getElementById('placasHelp');
var printPlacas = document.getElementById('printPlacas');
var serieHelp = document.getElementById('serieHelp');
var printSerie = document.getElementById('printSerie');
var tipoFacturaHelp = document.getElementById('tipoFacturaHelp');
var printTipoFactura = document.getElementById('printTipoFactura');
var facturaHelp = document.getElementById('facturaHelp');
var printFactura = document.getElementById('printFactura');
var fechaHelp = document.getElementById('fechaHelp');
var printFecha = document.getElementById('printFecha');
var tipoHelp = document.getElementById('tipoHelp');
var printTipo = document.getElementById('printTipo');
var patronHelp = document.getElementById('patronHelp');
var printPatron = document.getElementById('printPatron');
var estatusHelp = document.getElementById('estatusHelp');
var printEstatus = document.getElementById('printEstatus');
var printTitleMes = document.getElementById('pSuccessMes');
var printMes = document.getElementById('pMes');
var printForm = document.getElementById('new-unidad');
var btnCheck = [false,false,false,false,false,false,false,false,false];

function checkPlacas(){
  var xmlhttp;
  var placas = document.getElementById('placas').value;
  if (window.XMLHttpRequest) {
    xmlhttp = new XMLHttpRequest();
  } else {
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }

  if (placas === "") {
    placasHelp.innerHTML = "<p class='red-text'>Numero de placas <b>requerido</b></p>";
    document.getElementById('placas').style.borderColor = "red";
    printPlacas.innerHTML = "";
    btnCheck[0] = false;
    activeButton();
  }else {
    xmlhttp.onreadystatechange = function(){
      if (this.readyState === 4 && this.status === 200) {
        var answer = JSON.parse(this.responseText);
        // answerUserName.innerHTML = this.responseText;
        if (answer['check'] == 1) {
          document.getElementById('placas').style.borderColor = "green";
          placasHelp.innerHTML = "";
          btnCheck[0] = true;
          activeButton();
          printPlacas.innerHTML = "Placas: <strong>"+answer['data']+"</strong>";
        }else {
          placasHelp.innerHTML = "<p class='red-text'>Las placas <b>" + answer['data'] + "</b> ya estan asignadas a otra unidad</p>";
          document.getElementById('placas').style.borderColor = "red";
          printPlacas.innerHTML = "";
          btnCheck[0] = false;
          activeButton();
        }
      }
    }
    xmlhttp.open("GET","ajax/new-unidad.ajax.php?placas="+placas+"&serie=",true);
    xmlhttp.send();
  }
}

function checkSerie(){
  var xmlhttp;
  var serie = document.getElementById('serie').value;
  if (window.XMLHttpRequest) {
    xmlhttp = new XMLHttpRequest();
  } else {
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }

  if (serie === "") {
    serieHelp.innerHTML = "<p class='red-text'>Numero de serie <b>requerido</b></p>";
    document.getElementById('serie').style.borderColor = "red";
    printSerie.innerHTML = "";
    btnCheck[1] = false;
    activeButton();
  }else {
    xmlhttp.onreadystatechange = function(){
      if (this.readyState === 4 && this.status === 200) {
        var answer = JSON.parse(this.responseText);
        // answerUserName.innerHTML = this.responseText;
        if (answer['check'] == 1) {
          document.getElementById('serie').style.borderColor = "green";
          serieHelp.innerHTML = "";
          btnCheck[1] = true;
          activeButton();
          printSerie.innerHTML = "Número de Serie: <strong>"+answer['data']+"</strong>";
        }else {
          serieHelp.innerHTML = "<p class='red-text'>El número de serie <b>" + answer['data'] + "</b> ya estan asignado a otra unidad</p>";
          document.getElementById('serie').style.borderColor = "red";
          printSerie.innerHTML = "";
          btnCheck[1] = false;
          activeButton();
        }
      }
    }
    xmlhttp.open("GET","ajax/new-unidad.ajax.php?placas=&serie="+serie,true);
    xmlhttp.send();
  }
}

function checkFactura(){
  var factura = document.getElementById('tipoFactura').value;
  if (factura == 0) {
    tipoFacturaHelp.innerHTML = "<p class='red-text'>Seleccione un tipo de <b>factura</b> valido</p>";
    document.getElementById('tipoFactura').style.borderColor = "red";
    printTipoFactura.innerHTML = "";
    btnCheck[2] = false;
    activeButton();
  }else {
    tipoFacturaHelp.innerHTML = "";
    document.getElementById('tipoFactura').style.borderColor = "green";
    printTipoFactura.innerHTML = "Tipo de factura: <strong>"+factura+"</strong>";
    btnCheck[2] = true;
    activeButton();
  }
}
function checkNumero(){
  var numero = document.getElementById('factura').value;
  if (numero === "") {
    facturaHelp.innerHTML = "<p class='red-text'>Número de factura <b>requerido</b></p>";
    document.getElementById('factura').style.borderColor = "red";
    printFactura.innerHTML = "";
    btnCheck[3] = false;
    activeButton();
  }else {
    facturaHelp.innerHTML = "";
    document.getElementById('factura').style.borderColor = "green";
    printFactura.innerHTML = "Número de Factura: <strong>"+numero+"</strong>";
    btnCheck[3] = true;
    activeButton();
  }
}
function checkFecha(){
  var verFecha = new Date('2013-01-01');
  var fecha = new Date(document.getElementById('fecha').value);
  if (fecha < verFecha) {
    fechaHelp.innerHTML = "<p class='red-text'><b>Fecha</b> invalida, solo se aceptan unidades con asta 5 años.</p>"
    document.getElementById('fecha').style.borderColor = "red";
    printFecha.innerHTML = "";
    btnCheck[4] = false;
    activeButton();
  }else {
    fechaHelp.innerHTML = ""
    document.getElementById('fecha').style.borderColor = "green";
    printFecha.innerHTML = "Año: <strong>"+document.getElementById('fecha').value+"</strong>";
    btnCheck[4] = true;
    activeButton();
  }
}
function checkTipo(){
  var tipo = document.getElementById('tipo').value;
  if (tipo == 0) {
    tipoHelp.innerHTML = "<p class='red-text'>Seleccione un tipo de <b>unidad</b> valido</p>";
    document.getElementById('tipo').style.borderColor = "red";
    printTipo.innerHTML = "";
    btnCheck[5] = false;
    activeButton();
  }else {
    tipoHelp.innerHTML = "";
    document.getElementById('tipo').style.borderColor = "green";
    printTipo.innerHTML = "Tipo de unidad: <strong>"+tipo+"</strong>";
    btnCheck[5] = true;
    activeButton();
  }
}
function checkMarca(){
  var marca = document.getElementById('marca').value;
  var marca1 = document.getElementById('marca');
  var marcaName = marca1.options[marca1.selectedIndex].text;
  if (marca == 0) {
    marcaHelp.innerHTML = "<p class='red-text'>Seleccione <b>marca y modelo</b> valido</p>";
    document.getElementById('marca').style.borderColor = "red";
    printMarca.innerHTML = "";
    btnCheck[6] = false;
    activeButton();
  }else {
    marcaHelp.innerHTML = "";
    document.getElementById('marca').style.borderColor = "green";
    printMarca.innerHTML = "Marca/Modelo: <strong>"+marcaName+"</strong>";
    btnCheck[6] = true;
    checkPatron();
    checkEstatus();
    activeButton();
  }
}
function checkPatron(){
  var patron = document.getElementById('patron').value;
  var patron1 = document.getElementById('patron');
  var patronName = patron1.options[patron1.selectedIndex].text;
  if (patron == 0) {
    patronHelp.innerHTML = "<p class='red-text'>Seleccione a que <b>patron</b> pertenece la unidad.</p>";
    document.getElementById('patron').style.borderColor = "red";
    printPatron.innerHTML = "";
    btnCheck[7] = false;
    activeButton();
  }else {
    patronHelp.innerHTML = "";
    document.getElementById('patron').style.borderColor = "green";
    printPatron.innerHTML = "Pertenece al patron: <strong>"+patronName+"</strong>";
    btnCheck[7] = true;
    activeButton();
  }
}
function checkEstatus(){
  var estatus = document.getElementById('estatus').value;
  var estatus1 = document.getElementById('estatus');
  var estatusName = estatus1.options[estatus1.selectedIndex].text;
  if (estatus == 0) {
    estatusHelp.innerHTML = "<p class='red-text'>Seleccione <b>estatus</b> valido.</p>";
    document.getElementById('estatus').style.borderColor = "red";
    printEstatus.innerHTML = "";
    btnCheck[8] = false;
    activeButton();
  }else {
    estatusHelp.innerHTML = "";
    document.getElementById('estatus').style.borderColor = "green";
    printEstatus.innerHTML = "Estatus de la unidad: "+estatusName;
    btnCheck[8] = true;
    activeButton();
  }
}

function activeButton(){
  if (btnCheck[0] == true && btnCheck[1] == true && btnCheck[2] == true && btnCheck[3] == true && btnCheck[4] == true && btnCheck[5] == true && btnCheck[6] == true && btnCheck[7] == true && btnCheck[8] == true) {
    document.getElementById('bottomNewUnidad').disabled=false;
  } else {
    document.getElementById('bottomNewUnidad').disabled=true;
  }
}
function newUnidad(){
  var placas = document.getElementById('placas').value;
  var serie = document.getElementById('serie').value;
  var factura = document.getElementById('tipoFactura').value;
  var numero = document.getElementById('factura').value;
  var fecha = document.getElementById('fecha').value;
  var tipo = document.getElementById('tipo').value;
  var marca = document.getElementById('marca').value;
  var patron = document.getElementById('patron').value;
  var estatus = document.getElementById('estatus').value;

  var xmlhttp;
  if (window.XMLHttpRequest) {
    xmlhttp = new XMLHttpRequest();
  } else {
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }

  if (btnCheck[0] == true && btnCheck[1] == true && btnCheck[2] == true && btnCheck[3] == true && btnCheck[4] == true && btnCheck[5] == true && btnCheck[6] == true && btnCheck[7] == true && btnCheck[8] == true) {
    xmlhttp.onreadystatechange = function(){
      if (this.readyState === 4 && this.status === 200) {
        var answer = JSON.parse(this.responseText);
        // answerUserName.innerHTML = this.responseText;
        if (answer['unidadNum'] > 0) {
          printTitleMes.innerHTML = answer['mesTitle'];
          printMes.innerHTML = answer['mes'];
          mensajeExito();
          var myVar2 = setInterval(function () {
            printForm.innerHTML = "<br><br><h1>"+answer['mes']+"</h1>";
            clearInterval(myVar2);
          }, 3500);
        } else {
          printTitleMes.innerHTML = answer['mesTitle'];
          printMes.innerHTML = answer['mes'];
          mensajeExito();
        }
      }
    }
    xmlhttp.open("POST","ajax/new-unidad-r.ajax.php",true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("placas="+placas+"&serie="+serie+"&factura="+factura+"&numero="+numero+"&fecha="+fecha+"&tipo="+tipo+"&marca="+marca+"&patron="+patron+"&estatus="+estatus);
  }else {
    printTitleMes.innerHTML = "Error inesperado :(";
    printMes.innerHTML = "Error inesperado :(";
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
