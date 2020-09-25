<!-- MODAL AGREGAR NUEVO -->
<div class="modal fade" id="agregarEstudiante" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">AGREGAR ESTUDIANTE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body py-3">
                <!-- FORM NUEVO -->
                <form class="container-fluid" id="frmNuevaEstudiante" method="POST" 
                onsubmit="return insertarDatos()">
                
                <div class="row">
                    
                    <?php 
                        require_once "../clases/Conexion.php"; 
                        $c        = new Conexion();
                        $conexion =$c->conectar();
                        $sql = "SELECT est.id_estudiante,
                                       usu.nombre
                                  FROM t_estudiante as est
                            INNER JOIN t_usuario as usu on est.id_usuario=usu.id_usuario";
                        $query = Conexion::conectar()->prepare($sql);
                        $query->execute();
                        $datos = $query->fetchAll();
                    ?>
                    <label class="mt-2">Selecciona Estudiante</label>
                    <select class="form-control" id="id_estudiante" name="id_estudiante"
                                required="">
                        <option value="">Selecciona Estudiante</option>
                        <?php  ?>
                        <?php foreach ($datos as $key => $value) : ?>
                            <option value="<?php echo $value[0] ?>"><?php echo $value[1]; ?></option>
                        <?php endforeach; ?>
                    </select>
                    </div>
                </div><!-- ./ div row -->

                <div class="d-flex justify-content-center mt-3 mb-4">
                    <button id="btnAgregarEstudiante" class="btn btn-primary">
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
