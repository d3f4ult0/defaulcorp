var numeroHelp = document.getElementById('numeroHelp');
var btnCheck = [false,false,false,false,false,false,false,false,false];

function checkNumero(){
  var xmlhttp;
  var numero = document.getElementById('numero').value;
  if (window.XMLHttpRequest) {
    xmlhttp = new XMLHttpRequest();
  } else {
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }

  if (serie === "") {
    serieHelp.innerHTML = "<p class='red-text'>Numero del estatus <b>requerido</b></p>";
    document.getElementById('numeroHelp').style.borderColor = "red";
    printSerie.innerHTML = "";
    btnCheck[0] = false;
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
