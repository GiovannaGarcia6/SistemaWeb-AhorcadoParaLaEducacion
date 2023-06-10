<?php 
  session_start();
  //Se inicia la sesión.
  //Si no existe la variable username se redirige al inicio de sesión.
  if(!isset($_SESSION['username'])){
    header("Location: InicioSesion.php");
  }else{
    //Si existe se obtiene el id de la partida.
    $idPartida=$_GET['idPartida'];
    //Llamamos los archivos externos. 
    require '../php/ConexionBD.php';
    //Query par aobtener el id del profesor
    $buscar=mysqli_query($conn,"SELECT idProfesor FROM Partida INNER JOIN Juego
    on Juego.idJuego = Partida.idJuego WHERE idPartida='".$idPartida."'");
    $filas=mysqli_fetch_array($buscar);
    $idProfesor = $filas['idProfesor']; //El dato se almacena. 
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/Estilos_TablaPosiciones.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <title>Inicio de Sesion</title>
  </head>
  <body>
    <nav>
      <input type="checkbox" id="check">
      <label for="check" class="checkbtn"><i class="fas fa-bars"></i></label>
      <a href="#" class="enlace">
        <img src="../imagenes/logo2.png" alt="" class="logo"><span>Ahorcado para la educación</span> 
      </a>
      <ul>
        <li><a href="../Profesor.php?idProfesor=<?php echo $idProfesor;?>">Salir</a></li>
      </ul>
    </nav>
    <section>
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="Equipos">
              <?php 
                //Requerimos el archivo para la conexión de la bd.
                require '../php/ConexionBD.php';
                //Query para obtener la información de los equipos.
                $sentencia="SELECT * FROM Equipo where idPartida = '".$idPartida."'  ORDER BY Puntaje DESC";
                $resultado=mysqli_query($conn,$sentencia);
                $registros=0;
                //Esta estructura va mostrando el avatar de los equipos participantes.
                while($avatar=mysqli_fetch_assoc($resultado)){
                  //Aquí se valida que solo sean 3 avatares para la tabla de posiciones.
                  if($registros<3){
                    echo "<div class='avatar'>";
                    echo "<img src='../imagenes/Equipos/$avatar[Avatar]' width='130px'>";
                    echo "</div>" ;
                    $registros = $registros + 1;
                  }
                }
              ?>
          </div>
            <div class="card shadow-2-strong">
              <div class="card-body p-5 text-center">
              <h2 class="mb-5" style="color: #FBB034;">Tablero de Posiciones</h2>
              <?php
                //Requerimos el archivo para la conexión de la bd.
                require '../php/ConexionBD.php';
                //Query para obtener la información de los equipos.
                $sentencia="SELECT nomEquipo,puntaje,matricula FROM Equipo WHERE idPartida = '".$idPartida."' ORDER BY Puntaje DESC";
                $resultado=mysqli_query($conn,$sentencia);
                $registros=0;
                //Esta estructura va mostrando los datos de los 3 equipos con mayor puntaje
                while($filas=mysqli_fetch_assoc($resultado)){
                  if($registros<3){
                    echo "<div class='input-group flex-nowrap'>";
                    echo "<input type='text' class='form-control' id='clave' value='".$filas['nomEquipo']."' aria-label='Username' aria-describedby='addon-wrapping' disabled>";
                    echo "<input type='text' class='form-control' id='clave' value='".$filas['puntaje']."' aria-label='Username' aria-describedby='addon-wrapping' disabled>";
                    echo "</div>";
                    $registros = $registros + 1;
                  }
                }
                mysqli_close($conn); //Se cierra la conexión con la bd. 
              ?>   
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <footer></footer>          
    <!-- JS Bootstrap -->
    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  </body>
</html>


