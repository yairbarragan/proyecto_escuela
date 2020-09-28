<!-- MODAL ACTUALIZAR NUEVO -->
<div class="modal fade" id="editarEntregable" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ACTUALIZAR ENTREGABLE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body py-3">
                <!-- FORM ACTUALIZAR -->
                <form class="container-fluid" id="frmActualizarEntregable" method="POST" 
                onsubmit="return actualizarDatosEntregable()">
                
                <div class="row">
                    <input type="text" id="id_entregable" name="id_entregable" hidden="">
                    <div class="col-md-12">
                        <label class="mt-2">Entregable</label>
                        <input type="text" class="form-control" id="entregable" name="entregable" required="">
                    </div>
                    <div class="col-md-12">
                        <label class="mt-2">Descripción</label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion" required="">
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