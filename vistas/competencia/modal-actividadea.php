<!-- MODAL AGREGAR NUEVO -->
<div class="modal fade" id="agregarActividadEA" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ACTIVIDAD EA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body py-3">
                

                <!-- FORM NUEVO -->
                <div class="container-fluid">
                
                <div class="row">
                    
                    
                <div class="col-md-12">
                    <form id="frmMaterial" method="POST" onsubmit="return insertarMaterial()">
                        <input type="text" name="id_entregableM" id="id_entregableM" placeholder="id_entregable">
                        <input type="text" name="id_actividadeaM" id="id_actividadeaM" placeholder="id_actividadea">
                        <div class="d_flex">
                            <div>
                                <label class="mt-2">Material Apoyo</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required="">
                            </div>
                            <div>
                                <label class="mt-2">Archivo</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required="">
                            </div>
                            <div>
                                <label class="mt-2">Descarga</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required="">
                            </div>
                            <div>
                                <label class="mt-2">Agregar</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required="">
                            </div>
                            <div>
                                <label class="mt-2">Eliminar</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required="">
                            </div>
                        </div>
                        <button id="btnAgregarMaterial" class="btn btn-primary">
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