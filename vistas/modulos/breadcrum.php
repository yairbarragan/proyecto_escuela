<?php 
$host= $_SERVER["HTTP_HOST"];
$url= $_SERVER["REQUEST_URI"];
$aux      = explode("/", $url);
$urlAux   = explode(".", $aux[3]);
$urlFinal = $urlAux[0];

?>
<div class="breadcum d-flex align-items-center">
	<?php 
	if ($urlFinal == 'inicio') {
		echo '<span class="fas fa-home icon mr-3"><span class="rombo"></span></span>';
	} else if ($urlFinal == "usuarios") {
		echo '<span class="fas fa-users icon mr-3"><span class="rombo"></span></span>';
	} else if ($urlFinal == "carrera") {
		echo '<span class="fas fa-graduation-cap icon mr-3"><span class="rombo"></span></span>';
	} else if ($urlFinal == "especialidad") {
		echo '<span class="fas fa-book-open icon mr-3"><span class="rombo"></span></span>';
	} else if ($urlFinal == "asignatura") {
		echo '<span class="fas fa-book icon mr-3"><span class="rombo"></span></span>';
	} else if ($urlFinal == "asignaturaEstudiantes") {
		echo '<span class="fas fa-users icon mr-3"><span class="rombo"></span></span>';
	} else if ($urlFinal == "proyecto") {
		echo '<span class="fas fa-folder-open icon mr-3"><span class="rombo"></span></span>';
	} else if ($urlFinal == "proyectoMaterias") {
		echo '<span class="fas fa-folder-open icon mr-3"><span class="rombo"></span></span>';
	} else if ($urlFinal == "competencia") {
		echo '<span class="fas fa-clipboard-list icon mr-3"><span class="rombo"></span></span>';
	} else if ($urlFinal == "competenciaEntregable") {
		echo '<span class="fas fa-clipboard-list icon mr-3"><span class="rombo"></span></span>';
	} else if ($urlFinal == "estudiante") {
		echo '<span class="fas fa-user icon mr-3"><span class="rombo"></span></span>';
	} else if ($urlFinal == "asesor") {
		echo '<span class="fas fa-user icon mr-3"><span class="rombo"></span></span>';
	}
	?>
	<?php echo "<p class='bread-titulo ml-2'>" .$urlFinal. "</p>"; ?> <!-- $urlFinal declarada en plantilla.php -->
</div>

