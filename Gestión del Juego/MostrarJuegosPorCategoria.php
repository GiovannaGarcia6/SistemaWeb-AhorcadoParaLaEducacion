<?php
  session_start();//Se inicia la sesión.
  //Se verifica que exista la variable de sesión
  if(!isset($_SESSION['username'])){
    //Sino existe se dirige al inicio de sesión.
    header("Location: InicioSesion.php");
  }else{
    //Se obtiene el id de la categoria
    $idCategoria=$_GET['idCategoria'];
    //Requerimos del archivo para realizar la conexión.
    require '../php/ConexionBD.php';
     //Se crea un query para obtener el id del profesor.
    $buscar=mysqli_query($conn,"SELECT idProfesor FROM categoria WHERE idCategoria='".$idCategoria."'");
    $filas=mysqli_fetch_array($buscar);
    //Se almacena el valor en la variable
    $idProfesor = $filas['idProfesor'];
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
    <link rel="stylesheet" href="../css/Estilos_MostrarJuegos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <title>Juegos</title>
  </head>
  <body class="grid-container">
    <header class="header">
      <a href="#" class="enlace">
        <img src="../imagenes/logo2.png" alt="" class="logo"><span>Ahorcado para la educación</span> 
      </a>
    </header>
    <nav class="navbar">
      <a class="volver" href="ClasificarJuegos.php?idProfesor=<?php echo $idProfesor;?>"><button class="btnVolver btn-lg btn-block" type="submit"> <i class="fas fa-undo-alt"></i>Volver</button></a> 
    </nav>
    <section class="main">
      <div class="container py-5 h-100">
        <div class="table-responsive">
          <h2 class="mb-5" style="color: #4F1F91;"><i class="fas fa-play"></i>Juegos</h2>
          <h5 class="mb-5" style="color: red;"> <i class="fas fa-info-circle"></i>  Para generar partidas presione <i class="far fa-play-circle"></i> que se encuentra aún lado del titulo del juego. </h5> 
          <table class="table table-striped table-hover">
            <!--Se muestra los nombres de cada columna de la tabla.-->
            <thead>
              <th>Clave del juego</th>
              <th>Titulo</th>
              <th>Partida</th>
            </thead>
            <?php
              //Se inserta código del archivo php para la conexión de la base de datos.
              require '../php/ConexionBD.php';
              //Creamos un query para obtener la información de juegos que cumplan con el id de la categoria y el id del profesor.
              $sentencia="SELECT * FROM Juego where idCategoria = '".$idCategoria."' && idProfesor = '".$idProfesor."'";
              $resultado=mysqli_query($conn,$sentencia);
              while($filas=mysqli_fetch_assoc($resultado)){
                echo "<tr>";
                //Se muestran los datos encontrados
                echo "<td>"; echo $filas['idJuego']; echo "</td>";
                echo "<td>"; echo $filas['Titulo']; echo "</td>";
                echo "<td> <a href='Partida.php?idJuego=".$filas['idJuego']."'> <i class='far fa-play-circle fa-3x'></i> </a> </td>";
                echo "</tr>";
              }
              mysqli_close($conn); //Se cierra la conexión con la bd.
            ?>
          </table>
        </div>
      </div>
    </section>
    <footer class="footer"></footer>
  </body>
</html>