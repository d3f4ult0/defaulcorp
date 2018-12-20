var pSuccessMes = document.getElementById('pSuccessMes');
var pMes = document.getElementById('pMes');

function actualizar(){
  var id = document.getElementById('number').value;
  var fullName = document.getElementById('fullName').value;
  var genero = document.getElementById('genero').value;
  var phone = document.getElementById('phone').value;
  var address = document.getElementById('address').value;
  var curp = document.getElementById('curp').value;
  var rfc = document.getElementById('rfc').value;

  var xmlhttp;
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
        pMes.innerHTML = 'Has actualizado tus datos correctamente con el folio: <strong>U-'+answer['registerUser']+'</strong>.';
        mensajeExito();
      } else {
        pSuccessMes.innerHTML = answer['registerMes'];
        pMes.innerHTML = "Ocurrio un error con el servidor.<br>Favor de intentarlo mas tarde.<br>Si el problema persiste favor de contactar con el administrador";
        mensajeExito();
      }
    }
  }
  xmlhttp.open("POST","ajax/edit-user.ajax.php",true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send("id="+id+"&name="+fullName+"&genero="+genero+"&phone="+phone+"&address="+address+"&curp="+curp+"&rfc="+rfc);
}

function mensajeExito() {
  var myVar = setInterval(okModal, 2500);
  function okModal(){
    $('#modalLoad').modal('hide');
    $('#modalSuccess').modal('show');
    clearInterval(myVar);
  }
}
