<?php
require_once "../../clases/Asignatura.php";
$obj = new Asignatura(); //creo mi objeto

$id_asignatura = $_POST['id_asignatura'];
$id_carrera    = $_POST['id_carreraU'];
$clave         = $_POST['claveU'];
$datos         = array(
	'nombre'        => $_POST['nombreU'],
	'creditos'      => $_POST['creditosU'],
	'id_asignatura' => $id_asignatura,
);

//$res misma carrera
$res          = $obj->buscarClaveUpdate($clave, $id_asignatura);
$id_carreraBD = $obj->buscarCarrera($id_asignatura);

if ($res === "igual" and $id_carrera == $id_carreraBD) {
	//echo "id y clave iguales y carrera, actualizo datos";
	$aux = "sinClave";
	$datos = array(
		'nombre'        => $_POST['nombreU'],
		'creditos'      => $_POST['creditosU'],
		'id_asignatura' => $id_asignatura,
		'aux'           => $aux,
	);
	echo $obj->actualizarDatosAsignatura($datos);

} else if ($res === "igual" and $id_carrera != $id_carreraBD) {
	//echo "id y clave iguales y carrera diferente, actualizo datos";
	$existeCarrera = $obj->existeCarrera($id_asignatura); //existe en t_asignatura_carrera
	if ($existeCarrera) {
		$aux = "sinClave";
		$datos = array(
			'nombre'        => $_POST['nombreU'],
			'creditos'      => $_POST['creditosU'],
			'id_asignatura' => $id_asignatura,
			'aux'           => $aux,
		);
		if ($obj->actualizarDatosAsignatura($datos)) {
			$datos = array(
				'id_carrera'    => $id_carrera,
				'id_asignatura' => $id_asignatura,
			);
			echo $obj->actualizarAsignaturaCarrera($datos);
		} else {
			echo 0;
		}
	} else { // if existe carrera, no existe
		$datos = array(
			'id_carrera'    => $id_carrera,
			'id_asignatura' => $id_asignatura,
		);
		if ($obj->insertarAsignaturaCarrera($datos)) {
			$aux ="sinClave";
			$datos = array(
				'nombre'        => $_POST['nombreU'],
				'creditos'      => $_POST['creditosU'],
				'id_asignatura' => $id_asignatura,
				'aux'           => $aux,
			);
			echo $obj->actualizarDatosAsignatura($datos);
		} else {
			echo 0;
		}
	}

} else if ($res === 1) {
	echo 2;
} else if ($res === 0) {
	//echo "clave disponible";
	$existeCarrera = $obj->existeCarrera($id_asignatura);
	if ($existeCarrera) {
		if ($id_carrera == $id_carreraBD) {
			//echo "misma carrera, actualizo datos";
			$aux = "conClave";
			$datos = array(
				'nombre'        => $_POST['nombreU'],
				'creditos'      => $_POST['creditosU'],
				'clave'         => $clave,
				'id_asignatura' => $id_asignatura,
				'aux'           => $aux,
			);
			echo $obj->actualizarDatosAsignatura($datos);
		} else {
			//echo "dif clave, dif carrera";
			$datos = array(
				'id_carrera'    => $id_carrera,
				'id_asignatura' => $id_asignatura,
			);
			if ($obj->actualizarAsignaturaCarrera($datos)) {
				$aux = "conClave";
				$datos = array(
					'nombre'        => $_POST['nombreU'],
					'creditos'      => $_POST['creditosU'],
					'clave'         => $clave,
					'id_asignatura' => $id_asignatura,
					'aux'           => $aux,
				);
				echo $obj->actualizarDatosAsignatura($datos);
			} else {
				echo 0;
			}
		}
	} else {
		//echo "no existe carrera";
		$datos = array(
			'id_carrera'    => $id_carrera,
			'id_asignatura' => $id_asignatura,
		);
		if ($obj->insertarAsignaturaCarrera($datos)) {
			$aux = "conClave";
			$datos = array(
				'nombre'        => $_POST['nombreU'],
				'creditos'      => $_POST['creditosU'],
				'clave'         => $clave,
				'id_asignatura' => $id_asignatura,
				'aux'           => $aux,
			);
			echo $obj->actualizarDatosAsignatura($datos);
		} else {
			echo 0;
		}
	}
} else {
	echo 0;
}