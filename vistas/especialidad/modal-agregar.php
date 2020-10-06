<!-- MODAL AGREGAR NUEVO -->
<div class="modal fade" id="agregarNuevo" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">NUEVA ESPECIALIDAD</h5>
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
                    <div class="col-md-6">
                        <label class="mt-2">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required="">
                    </div>
                    <div class="col-md-6">
                        <label class="mt-2">Periodo Vigencia</label>
                        <div class="d-flex">
                            <input type="text" name="periodo_vigencia" id="periodo_vigencia" class="form-control calendario mr-2" required="" autocomplete="off">

                            <input type="text" name="periodo_vigencia_dos" id="periodo_vigencia_dos" class="form-control calendario" required="" autocomplete="off">    
                        </div>
                        
                    </div>
                    <div class="col-md-12">
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
                        <select class="form-control" id="id_carrera" name="id_carrera"
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