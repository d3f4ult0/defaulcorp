var pSuccessMes = document.getElementById('pSuccessMes');
var pMes = document.getElementById('pMes');

function actualizar(){
  var id = document.getElementById('numberID').value;
  var serie = document.getElementById('serie').value;
  var placas = document.getElementById('placas').value;
  var tipoFactura = document.getElementById('tipoFactura').value;
  var factura = document.getElementById('factura').value;
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
  xmlhttp.onreadystatechange = function(){
    if (this.readyState === 4 && this.status === 200) {
      var answer = JSON.parse(this.responseText);
      // answerUserName.innerHTML = this.responseText;
      if (answer['registerNum'] > 0) {
        pSuccessMes.innerHTML = answer['registerMes'];
        pMes.innerHTML = 'Has actualizado los datos de la unidad <strong>M-'+id+'</strong>, correctamente!';
        mensajeExito();
      } else {
        pSuccessMes.innerHTML = answer['registerMes'];
        pMes.innerHTML = "Ocurrio un error con el servidor.<br>Favor de intentarlo mas tarde.<br>Si el problema persiste favor de contactar con el administrador";
        mensajeExito();
      }
    }
  }
  xmlhttp.open("POST","ajax/edit-unidad.ajax.php",true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send("id="+id+"&serie="+serie+"&placas="+placas+"&tipoFactura="+tipoFactura+"&factura="+factura+"&fecha="+fecha+"&tipo="+tipo+"&marca="+marca+"&patron="+patron+"&estatus="+estatus);
}

function mensajeExito() {
  var myVar = setInterval(okModal, 2500);
  function okModal(){
    $('#modalLoad').modal('hide');
    $('#modalSuccess').modal('show');
    clearInterval(myVar);
  }
}
