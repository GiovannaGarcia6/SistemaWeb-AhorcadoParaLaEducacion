<?php
  session_start();//Se inicia la sesión.
  if(isset($_SESSION['username'])){
    //Se obtiene el id del profesor.
    $clave=$_GET['idProfesor'];
  }else{
    //Si no existe la variable username se redirige al inicio de sesión.
    header("Location: InicioSesion.php");
  }
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <!-- Meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/Estilos_MenuReportes.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <title>Generar Reportes</title>
  </head>
  <body class="grid-container">
    <header class="header">
      <a href="#" class="enlace">
        <img src="../imagenes/logo2.png" alt="" class="logo">
        <span>Ahorcado para la educación</span> 
      </a>
    </header>
    <nav class="navbar">
      <a class="volver" href="../Profesor.php?idProfesor=<?php echo $clave;?>"><button class="btnVolver btn-lg btn-block" type="submit"> <i class="fas fa-undo-alt"></i>Volver</button></a> 
    </nav>
    <!-- En esta parte se encuentran las opciones para generar reportes estos
    pueden ser de los estudiantes que han participado en los juegos, de todos los juegos creados 
    del profesor y por partida.-->
    <section class="main">
      <div class="row">
        <div class="col-lg-3 col-md-9 col-sm-9 align-self-start article">
          <div class="opcionesTam">
            <i class="fas fa-file-pdf fa-3x"></i><i class="fas fa-user-graduate fa-3x"></i>
          </div>
          <a href="ReporteEstudiantes.php?idProfesor=<?php echo $clave;?>">
            <div class="col-lg-3 col-m-9 col-sm-9 align-self-start contenido">Reporte de estudiantes</div> 
          </a>
        </div>
        <div class="col-lg-3 col-md-9 col-sm-9 align-self-start article">
          <div class="opcionesTam">
          <i class="fas fa-file-pdf fa-3x"></i><i class="fas fa-play fa-3x"></i>
          </div>
          <a href="ReporteJuegos.php?idProfesor=<?php echo $clave;?>">
            <div class="col-lg-3 col-m-9 col-sm-9 align-self-start contenido">Reporte de todos los Juegos</div>
          </a>
        </div>
        <div class="col-lg-3 col-md-9 col-sm-9 align-self-start article">
          <div class="opcionesTam">
            <i class="fas fa-file-pdf fa-3x"></i><i class="fas fa-play fa-3x"></i>
          </div>
          <a href="../Gestión%20del%20Juego/PartidasJugadas.php?idProfesor=<?php echo $clave;?>">
            <div class="col-lg-3 col-m-9 col-sm-9 align-self-start contenido">Reporte por partida</div>
          </a>
        </div> 
      </div>
    </section>
    <footer class="footer"></footer>
  </body>
</html>
