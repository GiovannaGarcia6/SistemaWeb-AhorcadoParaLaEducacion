<?php
  session_start();//Se inicia la sesión.
  //Se verifica que exista la variable de sesión para que el usuario pueda acceder al menú.
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
    <!-- Bootstrap - CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/Estilos_MenuAdmin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <title>Administrador</title>
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
        <h3 class="text-center">Administrador</h3>
      </div>
      <a href="php/CerrarSesion.php"  style = "text-decoration: None">
        <span class="spanCerrarSesión" >Cerrar sesión</span>
      </a>  
    </nav>
    <!-- En esta parte se encuentran las opciones que el usuario de tipo administrador tiene acceso,
    para este caso, puede realizar lo siguiente:
      -Agregar profesores.
      -Modificar profesores.
      -Eliminar profesores.
      -Consultar profesores.
      -Consultar la cantidad de juegos creados por profesor.-->
    <section class="main">
      <div class="row">
        <div class="col-lg-3 col-md-9 col-sm-9 align-self-start article">
          <div class="opcionesTam"><i class="fas fa-user-plus fa-3x"></i></div>
          <a href="Gestión%20del%20Profesor/RegistrarProfesor.php"><div class="col-lg-3 col-m-9 col-sm-9 align-self-start contenido">Agregar profesor</div></a>
        </div>
        <div class="col-lg-3 col-md-9 col-sm-9 align-self-start article">
          <div class="opcionesTam"><i class="fas fa-user-edit fa-3x"></i></div>
          <a href="Gestión%20del%20Profesor/ListaModificarProfesor.php"><div class="col-lg-3 col-m-9 col-sm-9 align-self-start contenido">Modificar profesor</div></a>
        </div>
        <div class="col-lg-3 col-md-9 col-sm-9 align-self-start article">
          <div class="opcionesTam"><i class="fas fa-user-minus fa-3x"></i></div>
          <a href="Gestión%20del%20Profesor/ListaEliminarProfesor.php"><div class="col-lg-3 col-m-9 col-sm-9 align-self-start contenido">Eliminar profesor</div></a>
        </div> 
      </div>
      <div class="row">
        <div class="col-lg-3 col-md-9 col-sm-9 align-self-start article">
          <div class="opcionesTam"><i class="fas fa-user fa-3x"></i><i class="fas fa-search fa-3x"></i></div>
          <a href="Gestión%20del%20Profesor/ConsultarProfesores.php"> <div class="col-lg-3 col-m-9 col-sm-9 align-self-start contenido">Consultar profesor</div></a>
        </div>
        <div class="col-lg-7 col-md-9 col-sm-9 align-self-start article">
          <div class="opcionesTam"><i class="fas fa-user fa-3x"></i><i class="fas fa-search fa-3x"></i></div>
          <a href="Gestión%20del%20Profesor/CantJuegosPorProfesor.php"><div class="col-lg-6 col-m-9 col-sm-9 align-self-start contenido">Consultar cantidad de juegos creados por profesor</div></a>      
        </div>
      </div>
    </section>
    <footer class="footer"></footer>
  </body>
</html>
