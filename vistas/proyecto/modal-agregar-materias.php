<!-- MODAL AGREGAR NUEVO -->
<div class="modal fade" id="agregarMateria" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">AGREGAR MATERIAS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body py-3">
                <!-- FORM NUEVO -->
                <form class="container-fluid" id="frmNuevaMateria" method="POST" 
                onsubmit="return insertarDatosMateria()">
                
                <div class="row">
                    <input type="text" id="id_proyectoM" name="id_proyectoM" hidden="">
                    <div class="col-md-6">
                        <?php 
                            require_once "../clases/Conexion.php"; 
                            $c        = new Conexion();
                            $conexion =$c->conectar();
                            $sql = "SELECT id_asignatura, 
                                           nombre 
                                      FROM t_asignatura";
                            $query = Conexion::conectar()->prepare($sql);
                            $query->execute();
                            $datos = $query->fetchAll();
                        ?>
                        <label class="mt-2">Materias</label>
                        <select class="form-control" id="id_asignaturaM" name="id_asignaturaM"
                                    required="">
                            <option value="">Selecciona una Materia</option>
                            <?php  ?>
                            <?php foreach ($datos as $key => $value) : ?>
                                <option value="<?php echo $value[0] ?>"><?php echo $value[1]; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6 mt-4 text-right">
                        <button id="btnAgregarMateria" class="btn btn-primary">
                            GUARDAR
                        </button>
                        <button type="button" class="btn btn-danger ml-2" data-dismiss="modal">
                            CANCELAR
                        </button>
                    </div>
                </div><!-- ./ div row -->

                </form>

                <div class="col-md-12">
                    <hr>
                    <div id="tablaCargaMateria"></div><!-- Cargando tabla dinamicamente con script final -->
                </div>
                <!-- END FORM NUEVO -->
            </div>
        </div>
    </div>
</div>
<!-- END MODAL AGREGAR NUEVO -->