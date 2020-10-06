<?php
require_once "../../clases/Usuario.php";
$obj = new Usuario(); //creo mi objeto

$usuario    = trim($_POST['usuarioU']);
$usuario    = preg_replace('/\s\s+/', ' ', $usuario);
$id_usuario = $_POST['id_usuario'];
$id_rol     = $_POST['id_rol_usuarioU'];
$datos      = array(
	'id_usuario'      => $id_usuario,
	'nombre'          => $_POST['nombreU'],
	'usuario'         => $usuario,
	'email'           => $_POST['emailU'],
	//'password'        => $pass,
	'id_rol_usuario'  => $id_rol,
);

$id_rol_bd = $obj->buscarIdRol($id_usuario);
//$id_rol;
if ($id_rol_bd == $id_rol and $id_rol == 2) {

	//echo "actualizo usuario, actualizo asesor";
	$respuesta = $obj->actualizarDatosUsuario($datos);
	if ($respuesta > 0) {
		$datos = array(
			'id_usuario'     => $id_usuario,
			'no_empleado'    => $_POST['no_empleadoU'],
			'grado_estudios' => $_POST['grado_estudiosU'],
			'id_carrera'     => $_POST['id_carreraU'],
		);
		if ($obj->actualizarDatosAsesor($datos)) {
			echo 1;
		} else {
			echo 0;
		}
	} else {
		if ($respuesta == 'existe') {
			echo 2;
		}else {
			echo 0;
		}
	}

} else if ($id_rol_bd != $id_rol and $id_rol == 3) {

	//echo"actualizo usuario, elimino asesor inserto estudiante";
	$respuesta = $obj->actualizarDatosUsuario($datos);
	if ($respuesta > 0) {
		
		$datos = array(
		'id_usuario'          => $id_usuario,
		'no_control'          => $_POST['no_controlU'],
		'genero'              => $_POST['generoU'],
		'periodo_ingreso'     => $_POST['periodo_ingresoU'],
		'periodo_ingreso_dos' => $_POST['periodo_ingreso_dosU'],
		);
		/**/
		$id_asesor   = $obj->buscarIDAsesor($id_usuario);
		$id_proyecto = $obj->buscarIDProyecto($id_asesor);
		if ($obj->eliminarProyectoAsig($id_proyecto)) {
			if ($obj->eliminarProyectoEstudiante($id_proyecto)) {
				if ($obj->eliminarProyectoArchivo($id_proyecto)) {
					if ($obj->eliminarProyecto($id_proyecto)) { // delete proyecto y archivo
						if ($obj->eliminarAsesorCarrera($id_asesor)) {
							if ($obj->eliminarDatosAsesor($id_usuario)) {
								if ($obj->insertarDatosEstudiante($datos)) {
									echo 1;
								} else {
									//echo "error datos estudiante";
									echo 0;
								}
							}else {
								//echo "error eliminar datos asesor";
								echo 0;
							}
						} else {
							//echo "eliminar asesor carrera";
							echo 0;
						}
					} else {
						//echo "eliminar proyecto";
						echo 0;
					}
				} else {
					//echo "eliminar proyecto archivo";
					echo 0;	
				}
		    } else {
		    	//echo "eliminar proyecto estudiante";
		    	echo 0;
		    }
		} else { 
			//echo "eliminar proyecto asignatura";
			echo 0;
		} 


	} else { // if respuesta > 0 $respuesta = $obj->actualizarDatosUsuario($datos)
		if ($respuesta == 'existe') {
			echo 2;
		}else {
			echo 0;
		}
	}

} else if ($id_rol_bd == $id_rol and $id_rol == 3) {

	//echo "actualizo usuario, actualizo estudiante";
	$respuesta = $obj->actualizarDatosUsuario($datos);
	if ($respuesta > 0) {
		$datos = array(
		'id_usuario'          => $id_usuario,
		'no_control'          => $_POST['no_controlU'],
		'genero'              => $_POST['generoU'],
		'periodo_ingreso'     => $_POST['periodo_ingresoU'],
		'periodo_ingreso_dos' => $_POST['periodo_ingreso_dosU'],
		);
		if ($obj->actualizarDatosEstudiante($datos)) {
			echo 1;
		} else {
			echo 0;
		}
	} else {
		if ($respuesta == 'existe') {
			echo 2;
		}else {
			echo 0;
		}
	}

} else {

	//echo "actualizo usuario, elimino estudiante inserto asesor";
	$respuesta = $obj->actualizarDatosUsuario($datos);
	if ($respuesta > 0) {
		$datos = array(
			'id_usuario'     => $id_usuario,
			'no_empleado'    => $_POST['no_empleadoU'],
			'grado_estudios' => $_POST['grado_estudiosU'],
			'id_carrera'     => $_POST['id_carreraU'],
		);
		/**/
		$id_estudiante   = $obj->buscarIDEstudiante($id_usuario);
		if ($obj->eliminarEstudianteProyecto($id_estudiante)) {
			if ($obj->eliminarAsignaturaEstudiante($id_estudiante)) {
				if ($obj->eliminarDatosEstudiante($id_usuario)) {
					if ($obj->insertarDatosAsesor($datos)) {
						echo 1;
					} else {
						echo 0;
					}
				}else {
					echo "eliminar estudiante asignatura";
					echo 0;
				}
		    } else {
		    	echo "eliminar estudiante asignatura";
		    	echo 0;
		    }
		} else { 
			echo "eliminar estudiante proyecto";
			echo 0;
		} 
	} else {
		if ($respuesta == 'existe') {
			echo 2;
		}else {
			echo 0;
		}
	}

}
