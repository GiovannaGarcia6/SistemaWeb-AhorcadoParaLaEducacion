<?php 
  session_start();//Se inicia la sesión.
  //Se verifica que exista la variable de sesión.
  if(!isset($_SESSION['username'])){
    header("Location: InicioSesion.php");
  }else{
    //Se obtiene la matricula del estudiante.
    $matricula=$_GET['matricula'];
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
    <link rel="stylesheet" href="../css/Estilos_CodigoJuego.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <title>Codigo de la partida</title>
  </head>
  <body>
    <nav>
      <input type="checkbox" id="check">
      <label for="check" class="checkbtn"><i class="fas fa-bars"></i></label>
      <a href="#" class="enlace">
        <img src="../imagenes/logo2.png" alt="" class="logo"><span>Ahorcado para la educación</span> 
      </a>
      <ul>
        <li><a href="../Estudiante.php?matricula=<?php echo $matricula;?>">Volver</a></li>
      </ul>
    </nav>
    <section>
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card shadow-2-strong">
              <div class="card-body p-5 text-center">
                <form action=" ../Gestión%20del%20Juego/CodigoJuego.php?matricula=<?php echo $matricula?>" method="post"> 
                  <h2 class="mb-5" style="color: #FBB034;">Juego</h2>
                  <!--Se muestra el mensaje de la variable status-->
                  <?php if(isset($_SESSION['status'])){ ?>
                  <div id="alerta" class="alert alert-danger d-flex align-items-center" role="alert">
                    <?php echo $_SESSION['status']; ?>
                  </div>
                  <!--Se refresca la página y se elimina la variable-->
                  <?php header("refresh:1; url = CodigoJuego.php?matricula=$matricula"); unset($_SESSION['status']); } ?>
                  <!--Se solicita el código de la partida-->
                  <div class="input-group flex-nowrap">
                    <span class="input-group-text" id=""><i class="fas fa-key"></i></span>
                    <input type="text" class="form-control" autocomplete="off" id="clave" name="clave" placeholder="Código de la partida" aria-label="Username" aria-describedby="addon-wrapping" required>
                  </div>
                  <button class="btn btn-lg btn-block" name="btnEntrar" type="submit">Entrar</button>
                  <?php
                    //Se inserta código del archivo php para la conexión de la base de datos.
                    require '../php/ConexionBD.php';
                    if(isset($_POST['btnEntrar'])){
                      //Se obtiene el código de la partida.
                      $codigoPartida = $_POST['clave'];
                      //Creamos un query para contar los registros que tengan ese código.
                      $sql  = "Select count(*) as contar from partida where idPartida = '".$codigoPartida."'";
                      $consulta =  mysqli_query($conn, $sql);
                      $array = mysqli_fetch_array($consulta);
                      //Si es mayor a 0, existe el código.
                      if($array['contar'] > 0 ){
                        //Dirige a la página de Equipos para poder seleccionar su avatar.
                        header("Location: Equipos.php?idPartida=$codigoPartida&matricula=$matricula"); 
                        exit();
                      }else{
                        //Sino existe, se redirige a la página con el mensaje.
                        $_SESSION['status'] = "Código inválido";
                        header("Location: CodigoJuego.php?matricula=$matricula");
                      }
                    }  
                  ?>
                </form>   
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <footer></footer>
  </body>
</html>


