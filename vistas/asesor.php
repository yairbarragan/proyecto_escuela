<?php 
session_start();

$idUsuario = $_SESSION['datosUsuario']['id'];      
$_SESSION['datosUsuario']['idRol'];   
$_SESSION['datosUsuario']['rol'];     
$_SESSION['datosUsuario']['usuario']; 

if (isset($_SESSION['datosUsuario'])) {
?>
	<div class="d-flex" style="overflow-x: hidden">
		
		<?php include "modulos/menu.php"; ?> <!-- menu -->

		<div class="d-flex flex-column main-content-wrap"> <!-- header/contenido wrap -->
			
			<?php include "modulos/header.php"; ?> <!-- header top bar -->



			<div class="container-fluid py-4 h-100 main-content"> <!-- contenido principal -->
				
				<?php include "modulos/breadcrum.php"; ?> <!-- breadcrum -->
				<br>
				<br><br>	

				<h2>INFORMACIÓN ASESOR</h2>
				
				<input type="text" id="idUsuario" value="<?php echo $idUsuario ?>" hidden>
				<div class="">
					<hr>
					<div id="tablaCarga"></div><!-- Cargando tabla dinamicamente con script final -->
				</div>
				<div style="margin-bottom: 100px;"></div>
			</div><!-- ./contenido principal -->




		</div>

	</div>
<?php
	include "modulos/footer.php"; 
	?>

	<script src="../js/asesor-vista.js"></script>
	
	<?php 
} else {
	header("location:../index.php");
}
?>