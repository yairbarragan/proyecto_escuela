<!-- MODAL ACTUALIZAR NUEVO -->
<div class="modal fade" id="editarRegistro" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ACTUALIZAR ASIGNATURA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body py-3">
                <!-- FORM ACTUALIZAR -->
                <form class="container-fluid" id="frmActualizar" method="POST" 
                onsubmit="return actualizarDatos()">
                
                <div class="row">
                    <input type="text" id="id_asignatura" name="id_asignatura" placeholder="id_asignatura" hidden="">
                    <!-- Especialidad -->
                    <div class="col-md-6">
                        <label class="mt-2">Nombre</label>
                        <input type="text" class="form-control" id="nombreU" name="nombreU" required="">
                    </div>
                    <div class="col-md-6">
                        <label class="mt-2">Clave</label>
                        <input type="text" name="claveU" id="claveU" class="form-control"  required="">
                    </div>
                    <div class="col-md-6">
                        <label class="mt-2">Creditos</label>
                        <input type="text" name="creditosU" id="creditosU" class="form-control"  required="">
                    </div>
                    <div class="col-md-6">
                        <?php 
                            require_once "../clases/Conexion.php"; 
                            $c        = new Conexion();
                            $conexion =$c->conectar();
                            $sql = "SELECT id_carrera, nombre 
                                      FROM t_cat_carrera";
                            $query = Conexion::conectar()->prepare($sql);
                            $query->execute();
                            $datos = $query->fetchAll();
                        ?>
                        <label class="mt-2">Carrera</label>
                        <select class="form-control" id="id_carreraU" name="id_carreraU"
                                    required="">
                            <option value="">Selecciona una carrera</option>
                            <?php  ?>
                            <?php foreach ($datos as $key => $value) : ?>
                                <option value="<?php echo $value[0] ?>"><?php echo $value[1]; ?></option>
                            <?php endforeach; ?>
                        </select>
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