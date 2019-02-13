<?php if ($pagina != 'login.php'): ?>
   <div class="modal fade" id="ventanaSesion" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
      <div class="modal-dialog modal-lg">
         <div class="modal-content">
            <div class="modal-header">
               <button class="close" type="button" data-dismiss="modal" aria-hidden="true">&times;</button>
               <!-- <h4 class="modal-title">Iniciar sesión</h4> -->
            </div>

            <div class="modal-body">
               <?php require 'views/login.view.php'; ?>
            </div>

            <div class="modal-footer">
               <button class="btn btn-danger" type="button" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
            </div>
         </div>
      </div>
   </div>
   <script>
   $(document).ready(function(){
      $("#btn-login").click(function(e){
         e.preventDefault();
         $("#ventanaSesion").modal("show");
       });
   });
   </script>
<?php endif; ?>
      <footer>
         <div class="container-fluid">
            <div class="row">
               <div class="col-xs-12 text-center">
                  <p>Adrián Cabrera Jacobo - Default CORP© 2017
                  <br>Todos los derechos reservados, cualquier reproduccion, copia o modificación sin previa autorización esta penada por la ley.</p>
               </div>
            </div>
         </div>
      </footer>
   <script src="<?php echo RUTA; ?>js/bootstrap.min.js" charset="utf-8"></script>
   </body>
</html>
