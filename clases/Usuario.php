<?php

require_once "Conexion.php";

class Usuario extends Conexion {

	public function login($usuario, $password) {
		$sql = "SELECT count(*)
				FROM t_usuario 
				WHERE usuario = '$usuario' 
					AND password = '$password'";
		$query = Conexion::conectar()->prepare($sql);
		$query->execute();
		$respuesta = $query->fetch()[0];
		if ( $respuesta > 0) {
			$sql = "SELECT usuario.id_usuario as idUsuario,
					       rol.id_rol_usuario as idRolUsuario,
					       rol.nombre as nombreRol
					  FROM t_usuario AS usuario
				INNER JOIN t_rol_usuario AS rol ON usuario.id_rol_usuario = rol.id_rol_usuario
					   AND usuario.usuario = '$usuario'
					   AND usuario.password = '$password'";

				$query = Conexion::conectar()->prepare($sql);
				$query->execute();
				$datosUsuario = $query->fetch();
				$_SESSION['datosUsuario']['id']      = $datosUsuario['idUsuario'];
				$_SESSION['datosUsuario']['idRol']   = $datosUsuario['idRolUsuario'];
				$_SESSION['datosUsuario']['rol']     = $datosUsuario['nombreRol'];
				$_SESSION['datosUsuario']['usuario'] = $usuario;

			return 1;
		} else {
			return 0;
		}
	}

	public function mostrarDatos() {
		$sql = "SELECT usuario.id_usuario,
					   usuario.nombre,
					   usuario.email,
					   usuario.usuario
		from t_usuario as usuario";
		$query = Conexion::conectar()->prepare($sql);
		$query->execute();
		return $query->fetchAll();
		$query->close();
	}

}

?>