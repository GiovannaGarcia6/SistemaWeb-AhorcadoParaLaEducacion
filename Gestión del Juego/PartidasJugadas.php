<?php
  session_start();//Se inicia la sesión.
  //Si no existe la variable username se redirige al inicio de sesión.
  if(!isset($_SESSION['username'])){
    header("Location: InicioSesion.php");
  }else{
    //Si existe se obtiene el id del profesor.
    $idProfesor=$_GET['idProfesor'];
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
    <link rel="stylesheet" href="../css/Estilos_PartidasCreadas.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <title>Consultar Partidas</title>
  </head>
  <body class="grid-container">
    <header class="header">
      <a href="#" class="enlace">
        <img src="../imagenes/logo2.png" alt="" class="logo"><span>Ahorcado para la educación</span> 
      </a>
    </header>
    <nav class="navbar">
      <a class="volver" href="../Reportes/MenuReportes.php?idProfesor=<?php echo $idProfesor;?>"><button class="btnVolver btn-lg btn-block" type="submit"> <i class="fas fa-undo-alt"></i>Volver</button></a> 
    </nav>
    <section class="main">
      <div class="container py-5 h-100">
        <div class="table-responsive">
          <h2 class="mb-5" style="color: #4F1F91;"><i class="fas fa-play"></i>Partidas creadas</h2>
          <table class="table table-striped table-hover">
            <!--Se muestra los nombres de cada columna de la tabla-->
            <thead>
              <th>IdPartida</th>
              <th>Fecha de creación</th>
              <th>Palabras correctas</th>
              <th>Palabras Incorrectas</th>
              <th>IdJuego</th>
              <th>Reporte</th>
            </thead>

            <?php
              //Se inserta código del archivo php para la conexión de la base de datos.
              require '../php/ConexionBD.php';
              //Creamos un query para obtener los datos de las partidas.
              $sql = "SELECT idPartida, FechaCreacion, Correctas, Incorrectas, Partida.idJuego FROM Partida 
              INNER JOIN Juego on Partida.idJuego = Juego.idJuego WHERE Juego.idProfesor = '".$idProfesor."' ORDER BY FechaCreacion DESC";
              $result = mysqli_query($conn, $sql);
              // verificamos que no haya error
              if (!$result){
                echo "<br>";
                echo "La consulta SQL contiene errores.".mysqli_error();
                exit();
              }else {
                $numfilas = $result->num_rows;
                if($numfilas==0){

            ?> 

                  <!-- Alerta para cuando no se encuentran registros-->
                  <div id="alerta" class="alert alert-danger d-flex align-items-center" role="alert"  style="margin-top:10px;"> No se encontraron registros</div><br>
            <?php
                      
                }else{
                  while($filas=mysqli_fetch_assoc($result)){
                    //Se van mostrando los datos en caso de que existan registros.
                    echo "<tr>";
                    echo "<td>"; echo $filas['idPartida']; echo "</td>";
                    echo "<td>"; echo $filas['FechaCreacion']; echo "</td>";
                    echo "<td>"; echo $filas['Correctas']; echo "</td>";
                    echo "<td>"; echo $filas['Incorrectas']; echo "</td>";
                    echo "<td>"; echo $filas['idJuego']; echo "</td>";
                    //Se crea un botón que los dirige a los reportes de partida.
                    echo "<td> <a href='../reportes/ReportePartida.php?idPartida=".$filas['idPartida']."'> <button type='button' class='btn btn-danger'>Generar <i class='fas fa-print'></i></button></a></td>";
                    echo "</tr>";
                  }
                }              
              }   
              mysqli_close($conn);//Se cierra la conexión con la bd.     
            ?>
          </table>
        </div>
      </div>
    </section>
    <footer class="footer"></footer>
  </body>
</html>