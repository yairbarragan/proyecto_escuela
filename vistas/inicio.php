<?php 
session_start();
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
				<h1 class="inicio-titulo text-center">GESTOR DE ARCHIVOS</h1>
				<p class="text-center">Lorem ipsum, dolor sit amet consectetur adipisicing elit. In nisi qui, autem eveniet id officiis quis reprehenderit amet. Atque natus amet libero labore aliquid assumenda nesciunt iure esse voluptas asperiores.	</p>

			</div><!-- ./contenido principal -->




		</div>

	</div>
<?php
	include "modulos/footer.php"; 
} else {
	header("location:../index.php");
}
?>