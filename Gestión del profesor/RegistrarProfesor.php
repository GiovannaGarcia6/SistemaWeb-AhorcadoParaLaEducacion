<?php 
  session_start();//Se inicia la sesión.
  //Se verifica que exista la variable de sesión.
  if(!isset($_SESSION['username'])){
    header("Location: InicioSesion.php");
  }
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <!-- Meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/Estilos_RegistrarProfesores.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <title>Registrar profesor</title>
  </head>
  <body class="grid-container">
    <header class="header">
      <a href="#" class="enlace">
        <img src="../imagenes/logo2.png" alt="" class="logo"><span>Ahorcado para la educación</span> 
      </a>
    </header>
    <nav class="navbar">
      <a class="volver" href="../Administrador.php"><button class="btnVolver btn-lg btn-block" type="submit"> <i class="fas fa-undo-alt"></i>Volver</button></a> 
    </nav>
    <section class="main">
      <div class="container py-5 h-100">
        <form action="../php/AgregarProfesor.php" method="post"> 
          <h2 class="mb-5" style="color: #4F1F91; margin-top:-20px"><i class="fas fa-user-plus"></i>  Agregar nuevo profesor</h2>
          <!--Se muestra el mensaje de éxito o de error-->
          <?php if(isset($_SESSION['status'])){ 
            if($_SESSION['status']=='Registrado con éxito.'){
          ?>
          <div id="alerta" class="alert alert-success d-flex align-items-center" role="alert"  style="margin-top:-30px; margin-bottom:px;">
            <?php echo $_SESSION['status']; ?>
          </div><br>  
          <?php }else{?> 
          <div id="alerta" class="alert alert-danger d-flex align-items-center" role="alert"  style="margin-top:-30px; margin-bottom:px;">
            <?php echo $_SESSION['status']; ?>
          </div> <br>     
          <?php }header("refresh:1; url = RegistrarProfesor.php");unset($_SESSION['status']); } ?><!--Se elimina la variable de sesión-->
          <!--Clave del profesor-->
          <div id="input1" class="input-group flex-nowrap">
            <span class="input-group-text" id=""><i class="fas fa-key"></i></span>
            <input type="text" autocomplete="off" class="form-control" name="clave" placeholder="Clave" aria-label="Username" aria-describedby="addon-wrapping" required>
          </div>
          <!--Nombre del profesor-->
          <div class="input-group flex-nowrap">
            <span class="input-group-text" id=""><i class="fas fa-user"></i></span>
            <input type="text" autocomplete="off" class="form-control" name="nombre" placeholder="Nombre" aria-label="Username" aria-describedby="addon-wrapping" required>
          </div>
          <!--Apellido paterno del profesor-->
          <div class="input-group flex-nowrap">
            <span class="input-group-text" id=""><i class="fas fa-user"></i></span>
            <input type="text" autocomplete="off" class="form-control" name="apellidoPaterno" placeholder="Apellido Paterno" aria-label="Username" aria-describedby="addon-wrapping" required>
          </div>
          <!--Apellido materno del profesor-->
          <div class="input-group flex-nowrap">
            <span class="input-group-text" id=""><i class="fas fa-user"></i></span>
            <input type="text" autocomplete="off" class="form-control" name="apellidoMaterno" placeholder="Apellido Materno" aria-label="Username" aria-describedby="addon-wrapping">
          </div>
          <!--Email del profesor-->
          <div class="input-group flex-nowrap">
            <span class="input-group-text" id=""><i class="fas fa-envelope"></i></span>
            <input type="email" autocomplete="off" class="form-control" name="correo"placeholder="E-mail" aria-label="Username" aria-describedby="addon-wrapping" required>
          </div>
          <!--Contraseña del profesor-->
          <div class="input-group flex-nowrap">
            <span class="input-group-text" id=""><i class="fas fa-lock"></i></span>
            <input type="Password" autocomplete="off" class="form-control" name="contraseña" placeholder="Contraseña" aria-label="Username" aria-describedby="addon-wrapping" required>
          </div>
          <button class="btn  btn-lg btn-block" type="submit">Registrar</button>
        </form>    
      </div> 
    </section>
    <footer class="footer"></footer>
  </body>
</html>