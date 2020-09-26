<!-- MODAL ACTUALIZAR NUEVO -->
<div class="modal fade" id="editarRegistro" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ACTUALIZAR PROYECTO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body py-3">
                <!-- FORM ACTUALIZAR -->
                <form class="container-fluid" id="frmActualizar" method="POST" 
                onsubmit="return actualizarDatos()">
                <input type="text" id="id_proyecto" name="id_proyecto" placeholder="id_proyecto" hidden="">                
                <div class="row">
                    <div class="col-md-6">
                        <label class="mt-2">Título</label>
                        <input type="text" class="form-control" id="tituloU" name="tituloU" required="">
                    </div>
                    <div class="col-md-6">
                        <label class="mt-2">Nombre</label>
                        <input type="text" class="form-control" id="nombreU" name="nombreU" required="">
                    </div>
                    <div class="col-md-6">
                        <label class="mt-2">Área Aplicación</label>
                        <input type="text" name="area_aplicacionU" id="area_aplicacionU" class="form-control"  required="">
                    </div>
                    <div class="col-md-6">
                        <?php 
                            require_once "../clases/Conexion.php"; 
                            $c        = new Conexion();
                            $conexion =$c->conectar();
                            $sql = "SELECT asesor.id_asesor, 
                                           usu.nombre 
                                      FROM t_usuario as usu 
                                INNER JOIN t_asesor as asesor on usu.id_usuario = asesor.id_usuario";
                            $query = Conexion::conectar()->prepare($sql);
                            $query->execute();
                            $datos = $query->fetchAll();
                        ?>
                        <label class="mt-2">Asesor</label>
                        <select class="form-control" id="id_asesorU" name="id_asesorU"
                                    required="">
                            <option value="">Selecciona un Asesor</option>
                            <?php  ?>
                            <?php foreach ($datos as $key => $value) : ?>
                                <option value="<?php echo $value[0] ?>"><?php echo $value[1]; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <?php 
                            require_once "../clases/Conexion.php"; 
                            $c        = new Conexion();
                            $conexion =$c->conectar();
                            $sql = "SELECT est.id_estudiante, 
                                           usu.nombre 
                                      FROM t_usuario as usu 
                                INNER JOIN t_estudiante as est on usu.id_usuario = est.id_usuario";
                            $query = Conexion::conectar()->prepare($sql);
                            $query->execute();
                            $datos = $query->fetchAll();
                        ?>
                        <label class="mt-2">Estudiante</label>
                        <select class="form-control" id="id_estudianteU" name="id_estudianteU"
                                    required="">
                            <option value="">Selecciona un Estudiante</option>
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