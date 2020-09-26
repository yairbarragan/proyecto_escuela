<!-- MODAL AGREGAR NUEVO -->
<div class="modal fade" id="agregarNuevo" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">NUEVO PROYECTO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body py-3">
                <!-- FORM NUEVO -->
                <form class="container-fluid" id="frmNuevo" method="POST" 
                onsubmit="return insertarDatos()">
                
                <div class="row">
                    <!-- Especialidad -->
                    <!-- <input type="text" id="id_usuario" name="id_usuario" value="<?php //echo $idUsu ?>"> -->
                    <div class="col-md-6">
                        <label class="mt-2">Título</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" required="">
                    </div>
                    <div class="col-md-6">
                        <label class="mt-2">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required="">
                    </div>
                    <div class="col-md-6">
                        <label class="mt-2">Área Aplicación</label>
                        <input type="text" name="area_aplicacion" id="area_aplicacion" class="form-control"  required="">
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
                        <select class="form-control" id="id_estudiante" name="id_estudiante"
                                    required="">
                            <option value="">Selecciona un Estudiante</option>
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
                            $sql = "SELECT asesor.id_asesor, 
                                           usu.nombre 
                                      FROM t_usuario as usu 
                                INNER JOIN t_asesor as asesor on usu.id_usuario = asesor.id_usuario";
                            $query = Conexion::conectar()->prepare($sql);
                            $query->execute();
                            $datos = $query->fetchAll();
                        ?>
                        <label class="mt-2">Asesor</label>
                        <select class="form-control" id="id_asesor" name="id_asesor"
                                    required="">
                            <option value="">Selecciona un Asesor</option>
                            <?php  ?>
                            <?php foreach ($datos as $key => $value) : ?>
                                <option value="<?php echo $value[0] ?>"><?php echo $value[1]; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div><!-- ./ div row -->

                <div class="d-flex justify-content-center mt-3">
                    <button id="btnAgregar" class="btn btn-primary">
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