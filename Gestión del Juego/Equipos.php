<?php
  session_start();//Se inicia la sesión.
  //Se verifica que exista la variable de sesión.
  if(!isset($_SESSION['username'])){
    header("Location: InicioSesion.php");
  }else{
    //Se obtiene la matricula del estudiante y el código de la partida.
    $codigoPartida=$_GET['idPartida'];
    $matricula = $_GET['matricula'];
    //Requerimos del archivo para realizar la conexión.
    require '../php/ConexionBD.php';
    //Se crea un query para obtener el titulo del juego.
    $buscar=mysqli_query($conn,"SELECT titulo FROM Juego INNER JOIN partida on juego.idJuego = partida.idJuego WHERE idPartida='".$codigoPartida."'");
    //En caso de existir se muestra el error;
    if(!$buscar) {
      var_dump(mysqli_error($conn));
      exit;
    }
    //Se obtiene el titulo.
    while($filas=mysqli_fetch_assoc($buscar)){
      $titulo = $filas['titulo'];
    }
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
    <link rel="stylesheet" href="../css/Estilos_Equipo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <title>Partida-Equipos</title>
  </head>
  <body>
    <nav>
      <input type="checkbox" id="check">
      <label for="check" class="checkbtn"><i class="fas fa-bars"></i></label>
      <a href="#" class="enlace">
        <img src="../imagenes/logo2.png" alt="" class="logo"><span>Ahorcado para la educación</span> 
      </a>
      <ul>
        <li><a href="#">Volver</a></li>
      </ul>
    </nav>
    <section>
      <div class="container py-5 h-100">
        <form action="../php/RegistrarEquipo.php" method="post"> 
          <div class="row">  
            <div class="col-3 col-md-6 align-self-start titulo"><?php echo $titulo?></div>
          </div> 
          <!--Se muestra el mensaje de la variable status-->
          <?php if(isset($_SESSION['status'])){ 
            if($_SESSION['status']=='Registrado con éxito. Observa la pantalla del profesor.'){
          ?>
          <div id="alerta" class="alert alert-success d-flex align-items-center" role="alert"  style="margin-top:-30px; margin-bottom:px;">
            <?php echo $_SESSION['status']; ?>
          </div><br>
          <?php }else{?> 
          <div id="alerta" class="alert alert-danger d-flex align-items-center" role="alert"  style="margin-top:-30px; margin-bottom:px;">
            <?php echo $_SESSION['status']; ?>
          </div><br>     
          <!--Se recarga la página y se elimina la variable-->  
          <?php }header("refresh:1; url = Equipos.php?idPartida=$codigoPartida'&matricula='$matricula"); unset($_SESSION['status']); } ?>
          <input type="hidden" name="matricula" value="<?php echo $matricula?>">   
          <input type="hidden" name="idPartida" value="<?php echo $codigoPartida?>">   
          <!--Se solicita el nombre del equipo-->
          <div class="row">  
            <div class="equipo col-6">
              <div class="input-group flex-nowrap">
                <span class="input-group-text" id=""><i class="fas fa-users"></i></span>
                <input type="text" autocomplete="off" class="form-control" name="nombreEquipo" placeholder="Nombre del equipo" aria-label="Username" aria-describedby="addon-wrapping" required>
              </div><br>
            </div>
          </div>
          <!--Se muestran los avatares que se pueden seleccionar-->
          <div class="avatares form-check">
            <label class="seleccionLabel form-label">Selecciona un avatar</label>  
              <div class="row">
                <div class="radios col-md-1">
                  <input class=" form-check-input" type="radio" name="avatar" id="" value="1.png" checked>
                  <div class="text-center">
                    <img src="../imagenes/Equipos/1.png" width="80px" class="avatar rounded" alt="...">
                  </div>
                </div>
                <div class="radios col-md-1">
                  <input class="form-check-input" type="radio" name="avatar" id="" value="2.png">
                  <div class="text-center">
                    <img src="../imagenes/Equipos/2.png" width="80px" class="avatar rounded" alt="...">
                  </div>
                </div>
                <div class="radios col-md-1">
                  <input class="form-check-input" type="radio" name="avatar" id="" value="3.png">
                  <div class="text-center">
                    <img src="../imagenes/Equipos/3.png" width="80px" class="avatar rounded" alt="...">
                  </div>
                </div>
                <div class="radios col-md-1">
                  <input class="form-check-input" type="radio" name="avatar" id="" value="4.png">
                  <div class="text-center">
                    <img src="../imagenes/Equipos/4.png" width="80px" class="avatar rounded" alt="...">
                  </div>
                </div>
                <div class="radios col-md-1">
                  <input class="form-check-input" type="radio" name="avatar" id="" value="5.png">
                  <div class="text-center">
                    <img src="../imagenes/Equipos/5.png" width="80px" class="avatar rounded" alt="...">
                  </div>
                </div>
                <div class="radios col-md-1">
                  <input class="form-check-input" type="radio" name="avatar" id="" value="6.png">
                  <div class="text-center">
                    <img src="../imagenes/Equipos/6.png" width="80px" class="avatar rounded" alt="...">
                  </div>
                </div>
                <div class="radios col-md-1">
                  <input class="form-check-input" type="radio" name="avatar" id="" value="7.png">
                  <div class="text-center">
                    <img src="../imagenes/Equipos/7.png" width="80px" class="avatar rounded" alt="...">
                  </div>
                </div>
                <div class="radios col-md-1">
                  <input class="form-check-input" type="radio" name="avatar" id="" value="8.png">
                  <div class="text-center">
                    <img src="../imagenes/Equipos/8.png" width="80px" class="avatar rounded" alt="...">
                  </div>
                </div>
              </div>
            </div>
            <div class="row">  
            <div class="equipo col-md-6 align-self-start">
              <button class="btn btn-lg btn-block" type="submit">Entrar</button>
            </div>
          </div> 
        </form>   
      </div>
    </section>
    <footer></footer>
  </body>
</html>