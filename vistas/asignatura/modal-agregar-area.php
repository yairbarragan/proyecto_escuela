<!-- MODAL AGREGAR NUEVO -->
<div class="modal fade" id="agregarArea" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">NUEVA ÁREA APLICACIÓN</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body py-3">
                <!-- FORM NUEVO -->
                <form class="container-fluid" id="frmNuevaArea" method="POST" 
                onsubmit="return insertarDatos()">
                
                <div class="row">
                    <input type="text" id="id_area_aplicacion" name="id_area_aplicacion" 
                    placeholder="id_area_aplicacion">
                    <!-- Especialidad -->
                    <div class="col-md-6">
                        <label class="mt-2">Nombre</label>
                        <input type="text" class="form-control" id="nombre_asig" name="nombre_asig" required="">
                    </div>
                    <div class="col-md-6">
                        <label class="mt-2">Aportación</label>
                        <input type="text" class="form-control" id="aportacion" name="aportacion" required="">
                    </div>
                    <div class="col-md-6">
                        <label class="mt-2">Nodo</label>
                        <input type="text" name="nodo_problema" id="nodo_problema" class="form-control"  required="">
                    </div>
                    
                </div><!-- ./ div row -->

                <div class="d-flex justify-content-center mt-3">
                    <button id="btnAgregarArea" class="btn btn-primary">
                        GUARDAR
                    </button>
                    <button type="button" class="btn btn-danger ml-2" data-dismiss="modal">
                        CANCELAR
                    </button>
                </div>
                <!-- USUARIOS -->

                </form>
                <!-- END FORM NUEVO -->
            </div>
        </div>
    </div>
</div>
<!-- END MODAL AGREGAR NUEVO -->
