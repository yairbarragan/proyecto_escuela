<?php
	$rol = $_SESSION['datosUsuario']['id'];
	$idRol = $_SESSION['datosUsuario']['idRol'];
?>
<div class="menu-wrap container">
	<p class="mt-3" style="color: #2e2e2e;"><b>Menú</b></p>
	<hr>

	<ul class="navbar-nav ml-auto">
		<li class="nav-item active">
			<a class="nav-link" href="inicio.php"> <span class="fas fa-home"></span> Inicio
				<span class="sr-only">(current)</span>
			</a>
		</li>
		<?php if ($idRol == 1) { ?>
		<li class="nav-item">
			<a class="nav-link" href="carrera.php"> <span class="fas fa-graduation-cap"></span> Carrera</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="especialidad.php"> <span class="fas fa-book-open"></span> Especialidad</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="asignatura.php"> <span class="fas fa-book"></span> Asignatura</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="usuarios.php"> <span class="fas fa-users"></span> Usuarios</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="competencia.php"> <span class="fas fa-clipboard-list"></span>Competencia</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="proyecto.php"> <span class="fas fa-folder-open"></span> Proyecto</a>
		</li>
		<?php } ?>
		<?php if ($idRol == 3): ?>
			<li class="nav-item">
				<a class="nav-link" href="estudiante.php"> <span class="fas fa-user"></span> Estudiante</a>
			</li>
		<?php endif ?>
	</ul>
</div>