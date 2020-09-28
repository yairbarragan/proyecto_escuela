<!-- MODAL AGREGAR NUEVO -->
<div class="modal fade" id="agregarArchivo" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">AGREGAR ARCHIVO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body py-3">
                <!-- FORM NUEVO -->
                <form class="container-fluid" id="frmArchivo" enctype="multipart/form-data" 
                onsubmit="return insertarArchivo()">
                
                <div class="row">
                    <input type="text" id="id_proyectoAr" name="id_proyectoAr" hidden="">
                    <p class="mb-2" style="color:#138496;"><b>Click any file to download!!!</b></p>
                    <div id="mostrarArchivos" class="col-md-12 row">

                            
                    </div>
                    <div class="col-md-12 mt-4">
                        <input type="file" id="archivo" name="archivo">
                    </div>
                    <div class="col-md-12 mt-2 text-left">
                        <hr>
                        <button id="btnAgregarArchivo" class="btn btn-primary">
                            GUARDAR
                        </button>
                        <button type="button" class="btn btn-danger ml-2" data-dismiss="modal">
                            CANCELAR
                        </button>
                    </div>
                </div><!-- ./ div row -->

                </form>

                <!-- END FORM NUEVO -->
            </div>
        </div>
    </div>
</div>
<!-- END MODAL AGREGAR NUEVO -->