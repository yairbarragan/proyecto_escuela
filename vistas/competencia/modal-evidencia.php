<!-- MODAL AGREGAR NUEVO -->
<div class="modal fade" id="actualizarEvidencia" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">EVIDENCIA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body py-3">
                

                <!-- FORM NUEVO -->
                <div class="container-fluid">
                
                <div class="row">
                    
                    
                <div class="col-md-12">
                    <form id="frmEvi" method="POST" onsubmit="return actualizarDatosEvidencia()">
                        <input type="text" name="id_entregableE" id="id_entregableE" placeholder="id_entregable" hidden="">

                        <div class="d_flex">
                            <p><b>EVIDENCIA</b></p>
                            <div>
                                <label class="mt-2">Material URL</label>
                                <input type="text" class="form-control" id="url" name="url" required="">
                            </div>
                            <div>
                                <label class="mt-2">Descripción</label>
                                <input type="text" class="form-control" id="descripcionE" name="descripcionE" required="">
                            </div>       
                        </div>

                        <div class="d_flex mt-4">
                            <p><b>DESEMPEÑO EVIDENCIA</b></p>
                            <div>
                                <label class="mt-2">Puntos</label>
                                <input type="text" class="form-control" id="puntos" name="puntos" required="">
                            </div>
                            <div>
                                <label class="mt-2">Descripción</label>
                                <input type="text" class="form-control" id="descripcionD" name="descripcionD" required="">
                            </div>       
                        </div>
                        <button id="btnAgregarEvidencia" class="btn btn-primary mt-4">
                            GUARDAR
                        </button>
                        <button type="button" class="btn btn-danger ml-2 mt-4" data-dismiss="modal">
                            CANCELAR
                        </button>
                    </form>
                </div>

      
                </div><!-- ./ div row -->

                <!-- USUARIOS -->

                </div> <!-- ./container fluid -->
                <!-- END FORM NUEVO -->
            </div>
        </div>
    </div>
</div>
<!-- END MODAL AGREGAR NUEVO -->