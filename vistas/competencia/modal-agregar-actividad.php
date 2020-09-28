<!-- MODAL AGREGAR NUEVO -->
<div class="modal fade" id="agregarNuevo" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">NUEVA COMPETENCIA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body py-3">
                <!-- FORM NUEVO -->
                <form class="container-fluid" id="frmNuevo" method="POST" 
                onsubmit="return insertarDatos()">
                
                <div class="row">
                    
                    <div class="col-md-12">
                        <label class="mt-2">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required="">
                    </div>
                    <div class="col-md-12">
                        <label class="mt-2">Campo Desarrollo Asignatura</label>
                        <input type="text" class="form-control" id="campo_desar_asig" name="campo_desar_asig" required="">
                    </div>
                    <div class="col-md-12">
                        <label class="mt-2">Campo Desarrollo Proyecto Integrador</label>
                        <input type="text" class="form-control" id="campo_desar_proyint" name="campo_desar_proyint" required="">
                    </div>
                    <div class="col-md-12">
                        <?php 
                            require_once "../clases/Conexion.php"; 
                            $c        = new Conexion();
                            $conexion =$c->conectar();
                            $sql = "SELECT id_asignatura, nombre 
                                      FROM t_asignatura";
                            $query = Conexion::conectar()->prepare($sql);
                            $query->execute();
                            $datos = $query->fetchAll();
                        ?>
                        <label class="mt-2">Asignatura</label>
                        <select class="form-control" id="id_asignatura" name="id_asignatura"
                                    required="">
                            <option value="">Selecciona una asignatura</option>
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