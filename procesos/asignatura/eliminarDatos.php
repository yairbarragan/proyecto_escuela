<?php
require_once "../../clases/Usuario.php";
$obj = new Usuario(); //creo mi objeto

$id_usuario = $_POST['id'];

$id_asesor     = $obj->buscarIDAsesor($id_usuario);
$id_estudiante = $obj->buscarIDEstudiante($id_usuario);

if ($id_asesor == "") {
	//echo "estudiante";
	if ($obj->eliminarEstudianteProyecto($id_estudiante)) {
		if ($obj->eliminarAsignaturaEstudiante($id_estudiante)) {
			if ($obj->eliminarDatosEstudiante($id_usuario)) {
				if ($obj->eliminarDatos($id_usuario)) {
					echo 1;
				} else {
					echo 0;
				}
			} else {
				//echo "eliminar estudiante";
				echo 0;
			}
		} else {
			//echo "asignatura estudiante";
			echo 0;
		}
	} else {
		//echo "estudiante proyecto";
		echo 0;
	}
} else {
	//echo "asesor";
	$id_proyecto   = $obj->buscarIDProyecto($id_asesor);
	if ($id_proyecto == "") {
		//echo "eliminar t_asesor_carrera, t_asesor";
		if ($obj->eliminarAsesorCarrera($id_asesor)) {
			if ($obj->eliminarDatosAsesor($id_usuario)) {
				if ($obj->eliminarDatos($id_usuario)) {
					echo 1;
				} else {
					echo 0;
				}
			} else {
				echo 0;
			}
		} else {
			echo 0;
		}
	}
	else {
		//echo "eliminar todo proyecto";
		$id_proyecto = $obj->buscarIDProyecto($id_asesor);
		if ($obj->eliminarProyectoAsig($id_proyecto)) {
			if ($obj->eliminarProyectoEstudiante($id_proyecto)) {
				if ($obj->eliminarProyectoArchivo($id_proyecto)) {
					if ($obj->eliminarProyecto($id_proyecto)) { // delete proyecto y archivo
						if ($obj->eliminarAsesorCarrera($id_asesor)) {
							if ($obj->eliminarDatosAsesor($id_usuario)) {
								if ($obj->eliminarDatos($id_usuario)) {
									echo 1;
								} else {
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
	}
}



