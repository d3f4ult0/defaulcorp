<div class="container-fluid">
  <div class="row m-top">
    <div class="col-12 col-md-8 col-lg-9">
      <div class="container-fluid">
        <div class="row">
          <h1>Pagina de inicio del usuario <?php echo $_SESSION['name']; ?></h1>
          <div class="col-12 table-responsive caja-principal">
            <h3 class="text-center">Puntos a tratar en el sistema:</h3>
            <ol>
              <li>Funcionalidad del Sistema:</li>
              <ul style="padding-left: 0px;">
                <li style="list-style-type: none"><i class="material-icons green-text">done</i> Edicion de datos del usuario---->ok</li>
                <li style="list-style-type: none"><i class="material-icons green-text">done</i> Cambiar contraseña------->ok</li>
                <li style="list-style-type: none"><i class="material-icons green-text">done</i> Cerrar sesion------>ok</li>
                <li style="list-style-type: none"><i class="material-icons green-text">done</i> Verificacion de correo (mensaje en pantalla)---->ok</li>
                <li style="list-style-type: none"><i class="material-icons green-text">done</i> Comprobacion de rango de usuario--->ok</li>
                <li style="list-style-type: none"><i class="material-icons red-text">clear</i> Alta de turno----></li>
                <li style="list-style-type: none"><i class="material-icons green-text">done</i> Alta de chofer--->OK</li>
                <li style="list-style-type: none"><i class="material-icons red-text">clear</i> Alta de patron---></li>
                <li style="list-style-type: none"><i class="material-icons green-text">done</i> Alta de unidad--->Ok</li>
                <li style="list-style-type: none"><i class="material-icons red-text">clear</i> Alta de trabajador---></li>
                <li style="list-style-type: none"><i class="material-icons yellow-text">report_problem</i> Listado de usuarios--->Todos estan en el archivo users.php</li>
                <li style="list-style-type: none"><i class="material-icons red-text">clear</i> Listado de turnos---></li>
                <li style="list-style-type: none"><i class="material-icons yellow-text">report_problem</i> Listado de choferes--->Se cambio al archivo choferes.php (incompleto)</li>
                <li style="list-style-type: none"><i class="material-icons yellow-text">report_problem</i> Listado de patrones--->Todos estan en el archivo users.php</li>
                <li style="list-style-type: none"><i class="material-icons yellow-text">report_problem</i> Listado de unidades--->Completo</li>
                <li style="list-style-type: none"><i class="material-icons yellow-text">report_problem</i> Editar unidad--->Solo para administrador, accesible solo desde el listado de unidades.</li>
                <li style="list-style-type: none"><i class="material-icons yellow-text">report_problem</i> Listado de trabajadores--->Todos estan en el archivo users.php</li>
                <li style="list-style-type: none"><i class="material-icons yellow-text">report_problem</i> Listado de los estatus del sistema---> Incompleto</li>
                <li>Prueba de modificación en la computadora del trabajo.</li>
              </ul>
              <li>Estilos y vistas:</li>
              <ul style="padding-left: 0px;">
                <li style="list-style-type: none"><i class="material-icons green-text">done</i> Header con diseño y logos---->ok</li>
                <li style="list-style-type: none"><i class="material-icons green-text">done</i> Animacion de "Procesando..."------->ok</li>
                <li style="list-style-type: none"><i class="material-icons green-text">done</i> Iconos para aside------>ok</li>
                <li style="list-style-type: none"><i class="material-icons green-text">done</i> Menu dinamico---->ok</li>
                <li style="list-style-type: none"><i class="material-icons green-text">done</i> Pagina responsive--->ok</li>
              </ul>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <?php include 'view/aside.php'; ?>
  </div>
</div>
<br>
<div class="espacio-final">
</div>
