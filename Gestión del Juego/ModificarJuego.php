<?php
  session_start();//Se inicia la sesión.
   //Si no existe la variable username se redirige al inicio de sesión.
  if(!isset($_SESSION['username'])){
    header("Location: InicioSesion.php");
  }else{
    //Si existe se obtiene el id del juego.
    $clave=$_GET['idJuego'];
    //Requerimos del archivo para realizar la conexión.
    require '../php/ConexionBD.php';
    //Se crea un query para mostrar datos del juego seleccionado para modificar.
    $buscar=mysqli_query($conn,"SELECT idJuego,titulo,palabras,pistas,numEquipos,idCategoria,idProfesor FROM Juego WHERE idJuego='".$clave."'");
    $filas=mysqli_fetch_array($buscar);
    //Se obtienen los datos del juego.
    $idJuego = $filas['idJuego'];
    $titulo = $filas['titulo'];
    $palabras = $filas['palabras'];
    $pistas = $filas['pistas'];
    $numEquipos = $filas['numEquipos'];
    $idCategoria = $filas['idCategoria'];
    $idProfesor = $filas['idProfesor'];
    mysqli_close($conn); //Se cierra la conexión de la bd.
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
    <link rel="stylesheet" href="../css/Estilos_ModificarJuegos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <title>Modificar Juego</title>
  </head>
  <body class="grid-container">
    <header class="header">
      <a href="#" class="enlace">
        <img src="../imagenes/logo2.png" alt="" class="logo"><span>Ahorcado para la educación</span> 
      </a>
    </header>
    <nav class="navbar">
      <a class="volver" href="ListaModificarJuegos.php?idProfesor=<?php echo $idProfesor;?>"><button class="btnVolver btn-lg btn-block" type="submit"> <i class="fas fa-undo-alt"></i>Volver</button></a> 
    </nav>
    <section class="main">
      <div class="container py-5 h-100">
        <form action="../php/ActualizarJuegos.php" method="POST">
          <h2 class="mb-5" style="color: #4F1F91;"><i class="fas fa-edit"></i></i> Datos del juego</h2>
          <!--Se muestra el mensaje que contenga la variable-->
          <?php if(isset($_SESSION['status'])){ ?>
          <div id="alerta" class="alert alert-danger d-flex align-items-center" role="alert">
            <?php echo $_SESSION['status']; ?>
          </div> <br>
          <!--Se refresca la página despues de mostrar el mensaje-->
          <?php header("refresh:1; url = ModificarJuego.php?idJuego=$clave"); unset($_SESSION['status']); } ?>
          <input type="hidden" name="claveProfesor" value="<?php echo $idProfesor?>">  
          <input type="hidden" name="clave" value="<?php echo $clave?>">
          <!--ID del juego-->
          <div id="input1" class="input-group flex-nowrap">
            <span class="input-group-text" id=""><i class="fas fa-key"></i></span>
            <input type="text" autocomplete="off" class="form-control" name="idJuego" value="<?php echo $clave?>" placeholder="Clave" aria-label="Username" aria-describedby="addon-wrapping" disabled>
          </div>
          <!--Titulo del juego-->
          <div class="input-group flex-nowrap">
            <span class="input-group-text" id=""><i class="far fa-keyboard"></i></span>
            <input type="text" autocomplete="off" class="form-control" name="titulo" value="<?php echo $titulo?>" placeholder="Titulo" aria-label="Username" aria-describedby="addon-wrapping">
          </div>
          <!--Palabras del juego-->
          <div class="input-group flex-nowrap">
            <span class="input-group-text" id=""><i class="fas fa-font"></i></span>
            <textarea class="form-control" autocomplete="off" name="palabras" value="<?php echo $palabras?>" aria-label="Username" aria-describedby="addon-wrapping"><?php echo $palabras?></textarea>
          </div>
          <!--Pistas del juego-->
          <div class="input-group flex-nowrap">
            <span class="input-group-text" id=""><i class="fas fa-search"></i></span>
            <textarea class="form-control" name="pistas" value="<?php echo $pistas?>" aria-label="Username" aria-describedby="addon-wrapping"><?php echo $pistas?></textarea>    
          </div>
          <!--Número máximo de equipos-->
          <div class="input-group flex-nowrap">
            <span class="input-group-text" id=""><i class="fas fa-users"></i></span>
            <select class="form-control" id="numEquipos" name="numEquipos" aria-label="Username" required>
              <?php
                //Se crea un ciclo que muestra los números de equipo que puede tener el juego.
                for($valor = 1; $valor < 9; $valor++) {
                  echo "<option value='$valor'";
                  //Si el n° de equipos es igual a la variable valor, en la pagina se mostrará como seleccionada.
                  if ($numEquipos == $valor) { 
                    echo ' selected="selected"';
                  }
                    echo ">$valor</option>";
                }
              ?> 
            </select>
          </div>
          <div class="input-group flex-nowrap">
            <span class="input-group-text" id=""><i class="fas fa-folder-open"></i></span>
            <select class="form-control" id="categoria" name="categoria" aria-label="Username" required>
              <?php
                //Se requiere la conexión de la bd.
                require '../php/ConexionBD.php';
                //Se crea el query para mostrar la lista de categorias creadas por ese profesor.
                $sentencia="SELECT * FROM categoria where idProfesor = '".$idProfesor."'";
                $resultado=mysqli_query($conn,$sentencia);
                while ($categorias = mysqli_fetch_array($resultado)) {
                  //Se muestran los nombres de las categorias existentes.
                  echo "<option value='".$categorias['idCategoria']."'";
                  //Si es el mismo id que se obtuvo al inicio se muestra como seleccionada.
                  if($categorias['idCategoria']==$idCategoria){
                    echo ' selected="selected"';
                  }
                  echo ">".$categorias['NomCategoria']."</option>";
                }
                mysqli_close($conn);//Se cierra la conexión.
              ?>
            </select>
          </div>
          <button type="submit" class="btnGuardar btn-primary">Guardar</button>
        </form>     
      </div> 
    </section>
    <footer class="footer"></footer>
  </body>
</html>