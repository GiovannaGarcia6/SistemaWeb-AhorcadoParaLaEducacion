<?php
  session_start();//Se inicia la sesión.
  //Se verifica que exista la variable de sesión para que el usuario pueda acceder al menú.
  if(isset($_SESSION['username'])){
    //Se obtiene el id del profesor.
    $clave=$_GET['idProfesor'];
  }else{
    //En caso de que no se encuentre la variable de sesión se redirige al inicio de sesión.
    header("Location: InicioSesion.php");
  }
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <!-- Meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap - CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/Estilos_MenuProfesor.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <title>Profesor</title>
  </head>
 <body class="grid-container">
    <header class="header">
      <a href="#" class="enlace">
        <img src="imagenes/logo2.png" alt="" class="logo">
        <span>Ahorcado para la educación</span> 
      </a>
    </header>
    <nav class="navbar">
      <div class="usuario">
        <div class="usuarioTam">
          <i class="fas fa-user-circle fa-4x" style="margin-left: 30%"></i>
        </div>
        <h3 class="text-center">Profesor(a)</h3>
      </div>
      <a href="php/CerrarSesion.php"  style = "text-decoration: None">
        <span class="spanCerrarSesión" >Cerrar sesión</span>
      </a>
    </nav>
    <!-- En esta parte se encuentran las opciones que el usuario de tipo profesor tiene acceso,
    para este caso, puede realizar lo siguiente:
      -Crear juegos.
      -Modificar juegos.
      -Eliminar juegos.
      -Consultar juegos.
      -Consultar la cantidad de partidas ganadas por estudiante.
      -Generar reportes de los estudiantes que han participado en los juegos, de todos los juegos creados 
      del profesor y por partida.-->
    <section class="main">
      <div class="row">
        <div class="col-lg-3 col-md-9 col-sm-9 align-self-start article">
          <div class="opcionesTam">
            <i class="fas fa-plus-circle fa-3x"></i>
          </div>
          <a href="Gestión%20del%20Juego/CrearJuego.php?idProfesor=<?php echo $clave;?>">
          <div class="col-lg-3 col-m-9 col-sm-9 align-self-start contenido">Crear Juego</div> 
          </a>
        </div>
        <div class="col-lg-3 col-md-9 col-sm-9 align-self-start article">
          <div class="opcionesTam">
          <i class="fas fa-pencil-alt fa-3x"></i>
          </div>
          <a href="Gestión%20del%20Juego/ListaModificarJuegos.php?idProfesor=<?php echo $clave;?>">
            <div class="col-lg-3 col-m-9 col-sm-9 align-self-start contenido">Modificar Juego</div>
          </a>
        </div>
        <div class="col-lg-3 col-md-9 col-sm-9 align-self-start article">
          <div class="opcionesTam">
            <i class="fas fa-trash-alt fa-3x"></i>
          </div>
          <a href="Gestión%20del%20Juego/EliminarJuego.php?idProfesor=<?php echo $clave;?>">
            <div class="col-lg-3 col-m-9 col-sm-9 align-self-start contenido">Eliminar Juego</div>
          </a>
        </div> 
      </div>
      <div class="row">
        <div class="col-lg-3 col-md-9 col-sm-9 align-self-start article">
          <div class="opcionesTam">
            <i class="fas fa-search fa-3x"></i>
          </div>
          <a href="Gestión%20del%20Juego/ConsultarJuegos.php?idProfesor=<?php echo $clave;?>">
            <div class="col-lg-3 col-m-9 col-sm-9 align-self-start contenido">Consultar juego</div> 
          </a>
        </div>
        <div class="col-lg-7 col-md-9 col-sm-9 align-self-start article">
          <div class="opcionesTam">
            <i class="fas fa-user-graduate fa-3x"></i><i class="fas fa-search fa-3x"></i>
          </div>
          <a href="Gestión%20del%20Juego/CantPartidasGanadas.php?idProfesor=<?php echo $clave;?>">
            <div class="col-lg-6 col-m-9 col-sm-9 align-self-start contenido">Consultar estudiantes y cantidad de partidad ganadas</div>
          </a>      
        </div>
      </div>
      <div class="row">
        <div class="col-lg-3 col-md-9 col-sm-9 align-self-start article">
          <div class="opcionesTam">
            <i class="fas fa-folder-open fa-3x"></i>
          </div>
          <a href="Gestión%20del%20Juego/ClasificarJuegos.php?idProfesor=<?php echo $clave;?>">
            <div class="col-lg-3 col-m-9 col-sm-9 align-self-start contenido">Clasificar juego</div> 
          </a>
        </div>
        <div class="col-lg-3 col-md-9 col-sm-9 align-self-start article">
          <div class="opcionesTam">
            <i class="fas fa-file-pdf fa-3x"></i>
          </div>
          <a href="Reportes/MenuReportes.php?idProfesor=<?php echo $clave;?>">
            <div class="col-lg-3 col-m-9 col-sm-9 align-self-start contenido">Generar reportes</div> 
          </a>
        </div>
      </div>
    </section>
    <footer class="footer"></footer>
  </body>
</html>
