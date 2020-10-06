<?php
require_once "../../clases/Usuario.php";
$obj = new Usuario(); //creo mi objeto

$pass    = sha1($_POST['password']);
$usuario = trim($_POST['usuario']);
$usuario = preg_replace('/\s\s+/', ' ', $usuario);

$datos = array(
	'nombre'              => $_POST['nombre'],
	'usuario'             => $usuario,
	'email'               => $_POST['email'],
	'password'            => $pass,
	'id_rol_usuario'      => $_POST['id_rol_usuario'],
	'no_empleado'         => $_POST['no_empleado'],
	'grado_estudios'      => $_POST['grado_estudios'],
	'id_carrera'          => $_POST['id_carrera'],
	'no_control'          => $_POST['no_control'],
	'genero'              => $_POST['genero'],
	'periodo_ingreso'     => $_POST['periodo_ingreso'],
	'periodo_ingreso_dos' => $_POST['periodo_ingreso_dos'],
);
$id_usuario = $obj->insertarDatosUsuario($datos);
if ($id_usuario == 'existe') {
	echo 2;
} else {
	if ($id_usuario > 0) {
		if ($_POST['id_rol_usuario'] == 2) {
			$datos = array(
				'id_usuario'     => $id_usuario,
				'no_empleado'    => $_POST['no_empleado'],
				'grado_estudios' => $_POST['grado_estudios'],
				'id_carrera'     => $_POST['id_carrera'],
			);
			if ($obj->insertarDatosAsesor($datos)) {
				echo 1;
			} else {
				echo 0;
			}
		} else {
			$datos = array(
				'id_usuario'          => $id_usuario,
				'no_control'          => $_POST['no_control'],
				'genero'              => $_POST['genero'],
				'periodo_ingreso'     => $_POST['periodo_ingreso'],
				'periodo_ingreso_dos' => $_POST['periodo_ingreso_dos'],
			);
			if ($obj->insertarDatosEstudiante($datos)) {
				echo 1;
			} else {
				echo 0;
			}
		}
	}
}