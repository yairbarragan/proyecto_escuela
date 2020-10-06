<!-- MODAL AGREGAR NUEVO -->
<div class="modal fade" id="agregarNuevo" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">NUEVO USUARIO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body py-3">
                <!-- FORM NUEVO -->
                <form class="container-fluid" id="frmNuevo" method="POST" 
                onsubmit="return insertarDatos()">
                
                <div class="row">
                    <!-- USUARIOS -->
                    <div class="col-md-6">
                        <label class="mt-2">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required="">
                    </div>
                    <div class="col-md-6">
                        <label class="mt-2">E-Mail</label>
                        <input type="email" class="form-control" id="email" name="email" required="">
                    </div>
                    <div class="col-md-6">
                        <label class="mt-2">Usuario</label>
                        <input type="text" class="form-control" id="usuario" name="usuario"required="">
                    </div>
                    <div class="col-md-6">
                        <label class="mt-2">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required="">
                    </div>
                    <div class="col-md-12">
                        <?php 
                            require_once "../clases/Conexion.php"; 
                            $c        = new Conexion();
                            $conexion =$c->conectar();
                            $sql = "SELECT id_rol_usuario, nombre 
                                      FROM t_rol_usuario
                                     WHERE nombre='asesor' or nombre ='estudiante'";
                            $query = Conexion::conectar()->prepare($sql);
                            $query->execute();
                            $datos = $query->fetchAll();
                        ?>
                        <label class="mt-2">Tipo Usuario</label>
                        <select class="form-control" id="id_rol_usuario" name="id_rol_usuario"
                                    required="">
                            <option value="">Selecciona tipo de usuario</option>
                            <?php  ?>
                            <?php foreach ($datos as $key => $value) : ?>
                                <option value="<?php echo $value[0] ?>"><?php echo $value[1]; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div id="asesor" class="col-md-12 mt-2">
                        <div class="frmAsesor" id="frmAsesor">
                            <div class="container asesor-wrap">
                                <div class="row">
                                     <div class="col-md-6">
                                        <label class="mt-2">No. Empleado</label>
                                        <input type="text" class="form-control reset asesor-input" id="no_empleado" name="no_empleado">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="mt-2">Grado Estudios</label>
                                        <input type="text" class="form-control reset asesor-input" id="grado_estudios" name="grado_estudios">
                                    </div>
                                    <?php 
                                    $sql = "SELECT id_carrera, nombre 
                                              FROM t_cat_carrera";
                                    $query = Conexion::conectar()->prepare($sql);
                                    $query->execute();
                                    $datos = $query->fetchAll();
                                    ?>
                                    <div class="col-md-6">
                                        <label class="mt-2">Carrera</label>
                                        <select class="form-control reset asesor-input" id="id_carrera" name="id_carrera">
                                            <option value="">Selecciona Carrera</option>
                                            <?php  ?>
                                            <?php foreach ($datos as $key => $value) : ?>
                                                <option value="<?php echo $value[0] ?>"><?php echo $value[1]; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>  
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="estudiante" class="col-md-12 mt-2">
                        <div class="frmEstudiante" id="frmEstudiante">
                            <div class="container estudiante-wrap">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="mt-2">No. Control</label>
                                        <input type="text" class="form-control reset estudiante-input" id="no_control" name="no_control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="mt-2">Genero</label>
                                        <div class="d-flex align-items-center mt-2">
                                            <p>Masculino</p>
                                            <input type="radio" class=" ml-2" id="masculino" name="genero" value="masculino" checked="">
                                            
                                            <p class="ml-3">Femenino</p>
                                            <input type="radio" class=" ml-2" id="femenino" name="genero" value="femenino">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="mt-2">Periodo Ingreso</label>
                                        <div class="d-flex">
                                            <input type="text" name="periodo_ingreso" id="periodo_ingreso" class="form-control mr-2 calendario reset estudiante-input" readonly="" autocomplete="off">

                                            <input type="text" name="periodo_ingreso_dos" id="periodo_ingreso_dos" class="form-control  calendario periodo" readonly="" autocomplete="off">    
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
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