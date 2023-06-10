<?php 
  session_start();//Se inicia la sesión
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/Estilos_InicioSesion.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <title>Inicio de Sesion</title>
  </head>
  <body>
    <nav>
      <input type="checkbox" id="check">
      <label for="check" class="checkbtn"><i class="fas fa-bars"></i></label>
      <a href="#" class="enlace"><img src="imagenes/logo2.png" alt="" class="logo"><span>Ahorcado para la educación</span></a>
      <ul>
        <li><a href="#">Inicio</a></li>
        <li><a href="Registrarse.php">Registrarse</a></li>
      </ul>
    </nav>
    <section>
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card shadow-2-strong">
              <div class="card-body p-5 text-center">
                <form action="php/loguear.php" method="post"> 
                  <h2 class="mb-5" style="color: #FBB034;">Login</h2>
                  <!--Muestra el mensaje de la variable de status-->
                  <?php if(isset($_SESSION['status'])){ ?>
                  <div id="alerta" class="alert alert-danger d-flex align-items-center" role="alert">
                    <?php echo $_SESSION['status']; ?>
                  </div> <br>
                  <!--Se refresca la página un segundo despues de mostrar el mensaje y se elimina la variable-->
                  <?php header("refresh:1; url = InicioSesion.php"); unset($_SESSION['status']); } ?>
                  <!--Se solicitan los datos necesarios para iniciar sesión--> 
                  <div class="input-group flex-nowrap">
                    <span class="input-group-text" id=""><i class="fas fa-user"></i></span>
                    <input type="text" class="form-control" name="clave" autocomplete="off" placeholder="Usuario" aria-label="Username" aria-describedby="addon-wrapping" required>
                  </div>
                  <div class="input-group flex-nowrap">
                    <span class="input-group-text" id=""><i class="fas fa-lock"></i></span>
                    <input type="password" class="form-control" name="contraseña" autocomplete="off" placeholder="Contraseña" aria-label="Username" aria-describedby="addon-wrapping" required>
                  </div>
                  <button class="btn btn-lg btn-block" type="submit">Entrar</button>
                </form>      
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <footer></footer>       
    <!-- JS Bootstrap -->
    <script src="./js/bootstrap.bundle.min.js"></script>
  </body>
</html>


