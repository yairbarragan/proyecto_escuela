<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" type="text/css" href="librerias/bootstrap4/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
	<div class="login-wrap fadeInDown">

    <div class="login-info text-center d-flex flex-column align-items-center justify-content-center">
      <h2><b>GESTOR DE ARCHIVOS</b></h2>
      <br>
      <p style="color: white;">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Deserunt ad facilis est optio officia inventore iure harum expedita, soluta nobis.</p>
    </div>

    <div class="py-4 text-center">

        <!-- Login Form -->
        <form method="post" id="frmLogin" onsubmit="return logear()">
          <div class="container">
            <input type="text" id="usuario" class="fadeIn second form-control" name="usuario" placeholder="USUARIO" required="">
            <br>
            <input type="password" id="password" class="fadeIn third form-control" name="password" placeholder="CONTRASEÑA" required="">
            <input type="submit" class="fadeIn fourth btn btn-primary mt-2" value="Entrar">            
          </div>
        </form>
    </div><!-- ./col-form -->

  </div><!-- ./login-wrap -->

  <script src="librerias/jquery-3.4.1.min.js"></script>
  <script src="librerias/sweetalert.min.js"></script>
  
  <script type="text/javascript">
   function logear(){
    $.ajax({
      type:"POST",
      data:$('#frmLogin').serialize(),
      url:"procesos/usuario/login/login.php",
      success:function(respuesta) {
        respuesta = respuesta.trim();
        if (respuesta == 1) {
          window.location = "vistas/inicio.php";
        } else {
          swal(":(", "Fallo al entrar!", "error");
        }
      }
    });
    return false;
  }
</script>

</body>
</html>