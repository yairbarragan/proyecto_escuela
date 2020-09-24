<?php 
session_start();
if (isset($_SESSION['datosUsuario'])) {
?>
	<div class="d-flex" style="overflow-x: hidden">
		
		<?php include "modulos/menu.php"; ?> <!-- menu -->

		<div class="d-flex flex-column main-content-wrap"> <!-- header/contenido wrap -->
			
			<?php include "modulos/header.php"; ?> <!-- header top bar -->



			<div class="container-fluid py-4 h-100 main-content carrera-view"> <!-- contenido principal -->
				
				<?php include "modulos/breadcrum.php"; ?> <!-- breadcrum -->
				<br>
				<br>
				
				<div class="d-flex flex-column align-items-center align-items-md-start">
					<p class="titulo"><b>ADMINISTRADOR ASIGNATURA ESTUDIANTES</b></p>
					<span class="btn btn-primary" data-toggle="modal" data-target="#agregarEstudiante" data-backdrop="static">
						Nuevo <span class="fa fa-plus-circle ml-2"></span>
					</span>
				</div>

				<div class="">
					<hr>
					<div id="tablaCargaEstudiante"></div><!-- Cargando tabla dinamicamente con script final -->
				</div>

			</div><!-- ./contenido principal -->




		</div>

	</div>
	<!-- MODALES -->
		<?php include "asignatura/modal-agregar-estudiante.php"; ?>
	<!-- END MODALES -->


<?php
	include "modulos/footer.php"; 
	?>

	<script src="../js/asignatura.js"></script>
	
	<?php 
} else {
	header("location:../index.php");
}
?>