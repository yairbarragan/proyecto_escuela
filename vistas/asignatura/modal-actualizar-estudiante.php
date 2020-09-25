<!-- MODAL ACTUALIZAR NUEVO -->
<div class="modal fade" id="editarRegistroEstudiante" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ACTUALIZAR ESTUDIANTE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body py-3">
                <!-- FORM ACTUALIZAR -->
                <form class="container-fluid" id="frmActualizar" method="POST" 
                onsubmit="return actualizarDatosEstudiante()">
                
                <div class="row">
                    <input type="text" id="id_estudianteU" name="id_estudianteU" placeholder="id_estudianteU" hidden="" >
                    <!-- Especialidad -->
                    <div class="col-md-12">
                        <label class="mt-2">Calificación</label>
                        <input type="text" class="form-control" id="calif" name="calif" required="">
                    </div>
                    
                </div><!-- ./ div row -->

                <div class="d-flex justify-content-center mt-3">
                    <button id="btnActualizar" class="btn btn-primary">
                        GUARDAR
                    </button>
                    <button type="button" class="btn btn-danger ml-2" data-dismiss="modal">
                        CANCELAR
                    </button>
                </div>
                <!-- USUARIOS -->

                </form>
                <!-- END FORM ACTUALIZAR -->
            </div>
        </div>
    </div>
</div>
<!-- END MODAL ACTUALIZAR -->