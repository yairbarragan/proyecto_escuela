<!DOCTYPE html>
<html>
<head>
	<title>Registro</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" type="text/css" href="librerias/bootstrap4/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="librerias/jquery-ui-1.12.1/jquery-ui.theme.css">
	<link rel="stylesheet" type="text/css" href="librerias/jquery-ui-1.12.1/jquery-ui.css">
	<link rel="stylesheet" href="librerias/fontawesome/css/all.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<div class="contacto-registro">
		<div class="container">
			<p><b>GESTOR DE ARCHIVOS</b></p>
		</div>
	</div>
	<div class="container mt-4">
		<br>
		<div class="titulo-registro d-flex align-items-center mb-4">
			<span class="fas fa-user-edit mr-2"></span>
			<h1 style="font-size: 20px; margin: 0;"><b>REGISTRO DE USUARIO</b></h1>
		</div>
		<form id="frmRegistro" method="post" onsubmit="return agregarUsuarioNuevo()" 
		autocomplete="off">
		<div class="container">
			<div class="row">
				<div class="col-md-6 pl-md-0">
					<div class="registro-wrap">
						<div class="form-icon">
							<label>DNI</label>
							<input type="text" id="dni" name="dni" class="form-control form-control-sm" required="">
							<span class="fas fa-hashtag"></span>
						</div>
						<div class="form-icon">
							<label>Apellido paterno</label>
							<input type="text" name="paterno" id="paterno" class="form-control form-control-sm" required="">	
							<span class="fas fa-user"></span>
						</div>
						<div class="form-icon">
							<label>Apellido materno</label>
							<input type="text" name="materno" id="materno" class="form-control form-control-sm" required="">
							<span class="fas fa-user"></span>
						</div>
						<div class="form-icon">
							<label>Nombre</label>
							<input type="text" name="nombre" id="nombre" class="form-control form-control-sm" required="">
							<span class="fas fa-user"></span>
						</div>
						<div class="form-icon">
							<label>Fecha de nacimiento</label>
							<input type="text" name="fechaNacimiento" id="fechaNacimiento" class="form-control form-control-sm" required="" readonly="" placeholder="click me!">
							<span class="far fa-calendar-alt"></span>
						</div>		
					</div>
				</div> <!-- end col md -->

				<div class="col-md-6 pr-md-0 mt-4 mt-md-0">
					<div class="registro-wrap">
						<div class="form-icon">
							<label>Carrera profesional</label>
							<select id="carreraProfesional" name="carreraProfesional" class="form-control form-control-sm" required="">
								<option value="Computación">Computación</option>
								<option value="Enfermería">Enfermería</option>
							</select>
							<span class="fas fa-list"></span>
						</div>
						<div class="form-icon">
							<label>Email o correo</label>
							<input type="email" name="correo" id="correo" class="form-control form-control-sm" required="">
							<span class="fas fa-envelope"></span>
						</div>
						<div class="form-icon">
							<label>Nombre de usuario</label>
							<input type="text" name="usuario" id="usuario" class="form-control form-control-sm" required="">
							<span class="fas fa-user-tag"></span>
						</div>
						<div class="form-icon">
							<label>Password</label>
							<input type="password" name="password" id="password" class="form-control form-control-sm" required="">
							<span class="fas fa-unlock-alt"></span>
						</div>
						<div class="form-icon">
							<label>Confirmar password</label>
							<input type="password" name="confirmarPassword" id="confirmarPassword" class="form-control form-control-sm" required="">
							<span class="fas fa-unlock-alt"></span>
						</div>
					</div>
				</div><!-- end col md -->
				<div class="col-12 text-center mt-4" >
					<button class="btn btn-primary">Registrar</button>
				</div>
				<div class="col-12 text-center mt-2 d-flex justify-content-center">
					<p>¿Ya tienes cuenta?</p>
					<a href="index.php" class="ml-2"><b>INICIA SESIÓN</b></a>
				</div>
			</div><!-- end row -->
		</div><!-- end container -->
	</form>
</div>
<script src="librerias/jquery-3.4.1.min.js"></script>
<script src="librerias/jquery-ui-1.12.1/jquery-ui.js"></script>
<script src="librerias/sweetalert.min.js"></script>

<script type="text/javascript">


	$(function() {
		var fechaA = new Date();
		var yyyy = fechaA.getFullYear();

		$("#fechaNacimiento").datepicker({
			changeMonth: true,
			changeYear: true,
			yearRange: '1900:' + yyyy,
			dateFormat: "yy-mm-dd"
		});
	});


	function agregarUsuarioNuevo() {

		$.ajax({
			method: "POST",
			data: $('#frmRegistro').serialize(),
			url: "procesos/usuario/registro/agregarUsuario.php",
			success:function(respuesta){

				respuesta = respuesta.trim();
				console.log(respuesta);
				if (respuesta == 1) {
					$("#frmRegistro")[0].reset();
					swal(":D", "Agregado con exito!", "success");
				} else {
					swal(":(", respuesta, "warning");
				}
			}
		});

		return false;
	}
</script>
</body>
</html>