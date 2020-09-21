<?php
require_once "../../clases/Usuario.php";
$obj = new Usuario(); //creo mi objeto

//$pass    = sha1($_POST['password']);
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
		//print_r($datos);
		echo $obj->actualizarDatosAsesor($datos);
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
		if ($_POST['periodo_ingresoU'] == '') {
			$fecha = null;
		} else {
		$fecha = $_POST['periodo_ingresoU'];
		}
		$datos = array(
		'id_usuario'      => $id_usuario,
		'no_control'      => $_POST['no_controlU'],
		'genero'          => $_POST['generoU'],
		'periodo_ingreso' => $fecha,
		);
		if ($obj->eliminarDatosAsesor($id_usuario)) {
			echo $obj->insertarDatosEstudiante($datos);
		}else {
			echo 0;
		}
	} else {
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
		if ($_POST['periodo_ingresoU'] == '') {
			$fecha = null;
		} else {
		$fecha = $_POST['periodo_ingresoU'];
		}
		$datos = array(
		'id_usuario'      => $id_usuario,
		'no_control'      => $_POST['no_controlU'],
		'genero'          => $_POST['generoU'],
		'periodo_ingreso' => $fecha,
		);
		echo $obj->actualizarDatosEstudiante($datos);
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
		if ($obj->eliminarDatosEstudiante($id_usuario)) {
			echo $obj->insertarDatosAsesor($datos);
		}else {
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
