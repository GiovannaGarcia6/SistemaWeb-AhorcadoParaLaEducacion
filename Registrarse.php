<?php 
  session_start();//Se inicia la sesión
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap - CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/Estilos_Registrarse.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <title>Registrarse</title>
  </head>
  <body>
    <nav>
      <input type="checkbox" id="check">
      <label for="check" class="checkbtn"><i class="fas fa-bars"></i></label>
      <a href="#" class="enlace">
        <img src="imagenes/logo2.png" alt="" class="logo"><span>Ahorcado para la educación</span> 
      </a>
      <ul>
        <li><a href="InicioSesion.php">Iniciar Sesión</a></li>
      </ul>
    </nav>
    <section>
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card shadow-2-strong">
              <div class="card-body p-4 text-center">
                <form action="php/RegistrarUsuarios.php" method="post"> 
                  <h2 class="mb-5" style="color: #FBB034">Registro</h2>
                  <!--Muestra el mensaje ya sea de éxito o de error, según sea el caso-->
                  <?php if(isset($_SESSION['status'])){ 
                    if($_SESSION['status']=='Registrado con éxito.'){
                  ?>
                  <div id="alerta" class="alert alert-success d-flex align-items-center" role="alert"  style="margin-top:-30px; margin-bottom:px;">
                    <?php echo $_SESSION['status']; ?>
                  </div><br>
                  <!--Se refresca la página un segundo despues de mostrar el mensaje-->
                  <?php header("refresh:1; url = Registrarse.php"); }else{?> 
                  <div id="alerta" class="alert alert-danger d-flex align-items-center" role="alert"  style="margin-top:-30px; margin-bottom:px;">
                    <?php echo $_SESSION['status']; ?>
                  </div><br> 
                  <!--Se refresca la página un segundo despues de mostrar el mensaje-->    
                  <?php header("refresh:1; url = Registrarse.php"); }unset($_SESSION['status']); } ?>
                  <!--Se solicitan los datos necesarios para registrarse--> 
                  <div id="input1" class="input-group flex-nowrap">
                    <span class="input-group-text" id=""><i class="fas fa-key"></i></span>
                    <input type="text" class="form-control" autocomplete="off" name="clave" placeholder="Clave o matricula" aria-label="Username" aria-describedby="addon-wrapping" required>
                  </div>
                  <div class="input-group flex-nowrap">
                    <span class="input-group-text" id=""><i class="fas fa-user"></i></span>
                    <input type="text" class="form-control" autocomplete="off" name="nombre" placeholder="Nombre" aria-label="Username" aria-describedby="addon-wrapping" required>
                  </div>
                  <div class="input-group flex-nowrap">
                    <span class="input-group-text" id=""><i class="fas fa-user"></i></span>
                    <input type="text" class="form-control" autocomplete="off" name="apellidoPaterno" placeholder="Apellido Paterno" aria-label="Username" aria-describedby="addon-wrapping" required>
                  </div>
                  <div class="input-group flex-nowrap">
                    <span class="input-group-text" id=""><i class="fas fa-user"></i></span>
                    <input type="text" class="form-control" autocomplete="off" name="apellidoMaterno" placeholder="Apellido Materno" aria-label="Username" aria-describedby="addon-wrapping">
                  </div>
                  <div class="input-group flex-nowrap">
                    <span class="input-group-text" id=""><i class="fas fa-envelope"></i></span>
                    <input type="email" class="form-control" autocomplete="off" name="correo"placeholder="E-mail" aria-label="Username" aria-describedby="addon-wrapping" required>
                  </div>
                  <div class="input-group flex-nowrap">
                    <span class="input-group-text" id=""><i class="fas fa-lock"></i></span>
                    <input type="Password" class="form-control" autocomplete="off" name="contraseña" placeholder="Contraseña" aria-label="Username" aria-describedby="addon-wrapping" required>
                  </div>
                  <!--Se solicita el tipo de registro, ya sea de administrador, profesor o estudiante--> 
                  <select class="input-group flex-nowrap" id="selectorUsuario" name="tipoUsuario" aria-label="Username" onchange="habilitar(this);">
                    <option selected value="Administrador">Administrador</option>
                    <option value="Profesor">Profesor</option>
                    <option value="Estudiante">Estudiante</option>
                  </select>
                  <!--De acuerdo a la elección anterior se habilita el siguiente input--> 
                  <div class="input-group flex-nowrap" >
                    <span class="input-group-text" id=""><i class="fas fa-key"></i></span>
                    <input type="text" id="claveAdmin" autocomplete="off" class="form-control" name="claveAdmin" placeholder="Clave del administrador" aria-label="Username" aria-describedby="addon-wrapping" required>
                  </div>    
                  <button class="btn  btn-lg btn-block" type="submit">Registrar</button>
                </form>    
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <footer></footer>
    <!-- JS -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/HabilitarInputs.js"></script><!--Determina si se habilita o no el input-->
  </body>
</html>



