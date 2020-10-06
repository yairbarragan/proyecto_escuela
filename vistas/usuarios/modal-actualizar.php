<!-- MODAL ACTUALIZAR NUEVO -->
<div class="modal fade" id="editarRegistro" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ACTUALIZAR USUARIO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body py-3">
                <!-- FORM ACTUALIZAR -->
                <form class="container-fluid" id="frmActualizar" method="POST" 
                onsubmit="return actualizarDatos()">
                
                <div class="row">
                    <!-- USUARIOS -->
                    <input type="text" id="id_usuario" name="id_usuario" hidden="">  
                    <div class="col-md-6">
                        <label class="mt-2">Nombre</label>
                        <input type="text" class="form-control" id="nombreU" name="nombreU" required="">
                    </div>
                    <div class="col-md-6">
                        <label class="mt-2">E-Mail</label>
                        <input type="email" class="form-control" id="emailU" name="emailU" required="">
                    </div>
                    <div class="col-md-6">
                        <label class="mt-2">Usuario</label>
                        <input type="text" class="form-control" id="usuarioU" name="usuarioU"required="">
                    </div>
                    <!-- <div class="col-md-6">
                        <label class="mt-2">Password</label>
                        <input type="password" class="form-control" id="passwordU" name="passwordU" required="">
                    </div> -->
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
                        <select class="form-control" id="id_rol_usuarioU" name="id_rol_usuarioU" required="">
                            <option value="">Selecciona tipo de usuario</option>
                            <?php  ?>
                            <?php foreach ($datos as $key => $value) : ?>
                                <option value="<?php echo $value[0] ?>"><?php echo $value[1]; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div id="asesorU" class="col-md-12 mt-2">
                        <div class="frmAsesor" id="frmAsesorU">
                            <div class="container asesor-wrap">
                                <div class="row">
                                     <div class="col-md-6">
                                        <label class="mt-2">No. Empleado</label>
                                        <input type="text" class="form-control asesor-input" id="no_empleadoU" name="no_empleadoU" required="">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="mt-2">Grado Estudios</label>
                                        <input type="text" class="form-control asesor-input" id="grado_estudiosU" name="grado_estudiosU" required="">
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
                                        <select class="form-control asesor-input" id="id_carreraU" name="id_carreraU">
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
                    <div id="estudianteU" class="col-md-12 mt-2">
                        <div class="frmEstudiante" id="frmEstudianteU">
                            <div class="container estudiante-wrap">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="mt-2">No. Control</label>
                                        <input type="text" class="form-control estudiante-input" id="no_controlU" name="no_controlU" required="">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="mt-2">Genero</label>
                                        <div class="d-flex align-items-center mt-2">
                                            <p>Masculino</p>
                                            <input type="radio" class=" ml-2" id="masculinoU" 
                                            name="generoU" value="masculino">
                                            
                                            <p class="ml-3">Femenino</p>
                                            <input type="radio" class=" ml-2" id="femeninoU" 
                                            name="generoU" value="femenino">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="mt-2">Periodo Ingreso</label>
                                        
                                        <div class="d-flex">
                                            <input type="text" name="periodo_ingresoU" id="periodo_ingresoU" class="form-control calendario estudiante-input mr-2" readonly="" autocomplete="off">

                                            <input type="text" name="periodo_ingreso_dosU" id="periodo_ingreso_dosU" class="form-control calendario estudiante-input" readonly="" autocomplete="off">    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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