<?php 
  session_start();//Se inicia la sesión.
  //Si no existe la variable username se redirige al inicio de sesión.
  if(!isset($_SESSION['username'])){
    header("Location: InicioSesion.php");
  }else{
    //Si existe se obtiene el id del juego.
    $idJuego=$_GET['idJuego'];
    //Llamamos los archivos externos. 
    require '../php/ConexionBD.php';
    require '../php/Funciones.php';
    //Crear un query para obtener la categoria del juego
    $buscar=mysqli_query($conn,"SELECT idCategoria FROM Juego WHERE idJuego='".$idJuego."'");
    $filas=mysqli_fetch_array($buscar);
    $idCategoria = $filas['idCategoria'];
    $repetido = 0;
    //El do while es para generar de nuevo el código en caso de que se repita.
    do{
      $codigo = generarCodigo(); //Se llama la función que genera el código.
      //Query que verifica si el código existe en la bd.
      $sql  = "Select count(*) as contar from partida where idPartida = '".$codigo."'";
      $consulta =  mysqli_query($conn, $sql);
      $array = mysqli_fetch_array($consulta);
      //Si es mayor a 0 significa que ya existe.
      if($array['contar'] > 0 ){
        $repetido = 1; 
      }else{
        //Sino se sigue con obtener la fecha.
        $repetido = 0;
        $codigoUnico = $codigo;
        $FechaCreacion = obtenerFechaActual(); //Se obtiene la fecha con una función.
        //Query que inserta la partida en la bd.
        $query  = "Insert into partida (idPartida,FechaCreacion,idJuego) values ('".$codigo."','".$FechaCreacion."','".$idJuego."')";    
        //si el query es exitoso se manda un mensaje de éxito.
        if($conn->query($query) === TRUE){
          $_SESSION['status'] = "Creado con éxito.";
        }else{
          //En caso contrario, se manda un mensaje de error.
          $_SESSION['status'] = "Hubo un error al registrar.";
        }
      }
    }while($repetido!=0);
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
    <link rel="stylesheet" href="../css/Estilos_Partida.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <title>Partida</title>
  </head>
  <body>
    <nav>
      <input type="checkbox" id="check">
      <label for="check" class="checkbtn"><i class="fas fa-bars"></i></label>
      <a href="#" class="enlace">
        <img src="../imagenes/logo2.png" alt="" class="logo"><span>Ahorcado para la educación</span> 
      </a>
      <ul>
        <li><a href="MostrarJuegosPorCategoria.php?idCategoria=<?php echo $idCategoria;?>">Volver</a></li>
      </ul>
    </nav>
    <section>
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card shadow-2-strong">
              <div class="card-body p-5 text-center">
                <!--En esta parte muestra el código en un input no editable-->
                <h2 class="mb-5" style="color: #FBB034;">Código de la Partida</h2>
                <div class="input-group flex-nowrap">
                  <span class="input-group-text" id=""><i class="fas fa-key"></i></span>
                  <input type="text" autocomplete="off" class="form-control" id="clave" name="clave" value="" placeholder="<?php echo $codigoUnico?>" aria-label="Username" aria-describedby="addon-wrapping" disabled required>
                </div>
                <!--una vez que los equipos se hayan registrado se da click al enlace para comenzar-->
                <a href="../Gestión%20del%20Juego/JuegoAhorcado.php?idPartida=<?php echo $codigoUnico ?>"><button onclick="limpiarStorage()"class="btn btn-lg btn-block" name="btnEntrar" type="submit">COMENZAR</button></a>  
              </div>
            </div>        
          </div>
        </div>
      </div>
    </div>
      	
    </section>
    <footer></footer>
    <script>
      //Esta función limpia el localStorage antes de iniciar el juego
      function limpiarStorage(){
        if(localStorage.getItem('incorrectas_palabras')!=null){
          localStorage.removeItem('correctas_palabras');
          localStorage.removeItem('incorrectas_palabras');
        }  
      }
    </script>              
    <!-- JS Bootstrap -->
    <script src="../js/bootstrap.bundle.min.js"></script>
  </body>
</html>
