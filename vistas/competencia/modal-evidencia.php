<!-- MODAL AGREGAR NUEVO -->
<div class="modal fade" id="agregarEvidencia" tabindex="-1">
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
                    <form id="frmEvi" method="POST" onsubmit="return insertarEvidencia()">
                        <input type="text" name="id_entregable" id="id_entregable" placeholder="id_entregable">
                        <input type="text" name="id_actividadea" id="id_actividadea" placeholder="id_actividadea">
                       
                        <div class="d_flex">
                            <p>Evidencia</p>
                            <div>
                                <label class="mt-2">Material URL</label>
                                <input type="text" class="form-control" id="url" name="url" required="">
                            </div>
                            <div>
                                <label class="mt-2">Descripción</label>
                                <input type="text" class="form-control" id="descripcion" name="descripcion" required="">
                            </div>       
                        </div>

                        <div class="d_flex mt-4">
                            <p>Desempeño </p>
                            <div>
                                <label class="mt-2">Puntos</label>
                                <input type="text" class="form-control" id="puntos" name="puntos" required="">
                            </div>
                            <div>
                                <label class="mt-2">Descripción</label>
                                <input type="text" class="form-control" id="descripcionD" name="descripcionD" required="">
                            </div>       
                        </div>
                        <button id="btnAgregarEvidencia" class="btn btn-primary">
                            GUARDAR
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