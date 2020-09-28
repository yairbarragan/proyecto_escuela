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
                <div class="container-fluid">
                    <div class="row">
                        
                          
                        <div class="col-md-12">
                            <form id="frmArchivoMA" enctype="multipart/form-data" 
                            onsubmit="return insertarArchivoMA()">
                            <input type="text" name="id_entregableM" class="id_entregableM" hidden="">
                                <table class="table table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Mat Apoyo</th>
                                            <th class="text-center">Archivo</th>
                                            <th class="text-center">Opción</th>
                                        </tr>
                                    </thead>
                                      <tbody>
                                        <tr>
                                            <td style="">
                                                <input type="file" class="" id="matApo" name="matApo" 
                                                style="margin: 8px 0;">
                                            </td>
                                            <td class="text-center" id="mostrarArchivosMA">

                                            </td>
                                            <td class="text-center">
                                                <button id="btnAgregarMaterial" class="btn btn-primary" style="padding: 2px 11px;font-size: 14px; margin-top: 6px">
                                                    GUARDAR
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>


                        <div class="col-md-12">
                            <form id="frmArchivoFI" enctype="multipart/form-data" 
                            onsubmit="return insertarArchivoFI()">
                            <input type="text" name="id_entregableM" class="id_entregableM" hidden="">
                                <table class="table table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Fuentes de Información</th>
                                            <th class="text-center">Archivo</th>
                                            <th class="text-center">Opción</th>
                                        </tr>
                                    </thead>
                                      <tbody>
                                        <tr>
                                            <td style="">
                                                <input type="file" class="" id="fuenInf" name="fuenInf" 
                                                style="margin: 8px 0;">
                                            </td>
                                            <td class="text-center" id="mostrarArchivosFI">

                                            </td>
                                            <td class="text-center">
                                                <button id="btnAgregarFuentes" class="btn btn-primary" style="padding: 2px 11px;font-size: 14px; margin-top: 6px">
                                                    GUARDAR
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>


                        <div class="col-md-12">
                            <form id="frmArchivoAE" enctype="multipart/form-data" 
                            onsubmit="return insertarArchivoAE()">
                            <input type="text" name="id_entregableM" class="id_entregableM" hidden="">
                                <table class="table table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Actividad Entregable</th>
                                            <th class="text-center">Archivo</th>
                                            <th class="text-center">Opción</th>
                                        </tr>
                                    </thead>
                                      <tbody>
                                        <tr>
                                            <td style="">
                                                <input type="file" class="" id="actAE" name="actAE" 
                                                style="margin: 8px 0;">
                                            </td>
                                            <td class="text-center" id="mostrarArchivosAE">

                                            </td>
                                            <td class="text-center">
                                                <button id="btnAgregarActAE" class="btn btn-primary" style="padding: 2px 11px;font-size: 14px; margin-top: 6px">
                                                    GUARDAR
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>


                        <div class="col-md-12">
                            <form id="frmArchivoAA" enctype="multipart/form-data" 
                            onsubmit="return insertarArchivoAA()">
                            <input type="text" name="id_entregableM" class="id_entregableM" hidden="">
                                <table class="table table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Actividad Aplicación</th>
                                            <th class="text-center">Archivo</th>
                                            <th class="text-center">Opción</th>
                                        </tr>
                                    </thead>
                                      <tbody>
                                        <tr>
                                            <td style="">
                                                <input type="file" class="" id="actAA" name="actAA" 
                                                style="margin: 8px 0;">
                                            </td>
                                            <td class="text-center" id="mostrarArchivosAA">

                                            </td>
                                            <td class="text-center">
                                                <button id="btnAgregarActAA" class="btn btn-primary" style="padding: 2px 11px;font-size: 14px; margin-top: 6px">
                                                    GUARDAR
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>

                        
                    </div><!-- ./ div row -->
                </div> <!-- ./container fluid -->
            </div>
        </div>
    </div>
</div>
<!-- END MODAL AGREGAR NUEVO -->