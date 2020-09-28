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
				<input type="text" id="idComp" name="idComp" value="<?php echo $_GET['id']; ?>" hidden="">
				<div class="d-flex flex-column align-items-center align-items-md-start">
					<p class="titulo"><b>ADMINISTRADOR COMPETENCIAS ENTREGABLE</b></p>
				</div>

				<div class="">
					<hr>
					<div id="tablaCargaEntregable"></div><!-- Cargando tabla dinamicamente con script final -->
				</div>

			</div><!-- ./contenido principal -->




		</div>

	</div>
	<!-- MODALES -->
		<?php include "competencia/modal-actualizar-entregable.php"; ?>
		<?php include "competencia/modal-evidencia.php"; ?>
		<?php include "competencia/modal-actividadea.php"; ?>
	<!-- END MODALES -->


<?php
	include "modulos/footer.php"; 
	?>

	<script src="../js/competencia.js"></script>
	
	<?php 
} else {
	header("location:../index.php");
}
?>