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
    //Se crea un query para mostrar datos del juego seleccionado para eliminar.
    $buscar=mysqli_query($conn,"SELECT idJuego,titulo,palabras,pistas,numEquipos,idCategoria, idProfesor FROM Juego WHERE idJuego='".$clave."'");
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
    <link rel="stylesheet" href="../css/Estilos_ConfirmarEliminar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <title>Cormirmar eliminación</title>
  </head>
  <body class="grid-container">
    <header class="header">
      <a href="#" class="enlace">
        <img src="imagenes/logo2.png" alt="" class="logo">
        <span>Ahorcado para la educación</span> 
      </a>
    </header>
    <nav class="navbar">
      <a class="volver" href="EliminarJuego.php?idProfesor=<?php echo $idProfesor;?>"><button class="btnVolver btn-lg btn-block" type="submit"> <i class="fas fa-undo-alt"></i>Volver</button></a> 
    </nav>
    <section class="main">
      <div class="container py-5 h-100">
        <form action="../php/EliminarJuego.php" method="POST">
          <h2 class="mb-5" style="color: #4F1F91;"><i class="fas fa-file-alt"></i> Datos del juego</h2>
          <!--Mensaje para recordar si esta seguro de eliminar el registro-->
          <div id="alerta" class="alert alert-danger d-flex align-items-center" role="alert">
            ¿Está seguro de eliminar el siguiente registro?
          </div><br>
          <!--Se muestran cada uno de los datos del juego selecionado (campos no editables)-->
          <input type="hidden" name="clave" value="<?php echo $idJuego?>">
          <input type="hidden" name="idProfesor" value="<?php echo $idProfesor?>">
          <div id="input1" class="input-group flex-nowrap">
            <span class="input-group-text" id=""><i class="fas fa-key"></i></span>
            <input type="text" class="form-control" name="idJuego" value="<?php echo $clave?>" placeholder="Clave" aria-label="Username" aria-describedby="addon-wrapping" disabled>
          </div>
          <!--Titulo del juego-->
          <div class="input-group flex-nowrap">
            <span class="input-group-text" id=""><i class="far fa-keyboard"></i></span>
            <input type="text" class="form-control" name="titulo" value="<?php echo "Titulo: ".$titulo?>" placeholder="Titulo" aria-label="Username" aria-describedby="addon-wrapping" disabled>
          </div>
          <!--Palabras del juego-->
          <div class="input-group flex-nowrap">
            <span class="input-group-text" id=""><i class="fas fa-font"></i></span>
            <textarea class="form-control" name="Palabras" value="<?php echo $palabras?>" aria-label="Username" aria-describedby="addon-wrapping" disabled><?php echo $palabras?></textarea>
          </div>
          <!--Pistas del juego-->
          <div class="input-group flex-nowrap">
            <span class="input-group-text" id=""><i class="fas fa-search"></i></span>
            <textarea class="form-control" name="Pistas" value="<?php echo $pistas?>" aria-label="Username" aria-describedby="addon-wrapping" disabled><?php echo $pistas?></textarea>    
          </div>
          <!--Número máximo de equipos-->
          <div class="input-group flex-nowrap">
            <span class="input-group-text" id=""><i class="fas fa-users"></i></span>
            <input type="text" class="form-control" name="numEquipos" value="<?php echo "N° de Equipos: ".$numEquipos?>" placeholder="Clave de la Categoria" aria-label="Username" aria-describedby="addon-wrapping" disabled>
          </div>
          <!--Categoria a la que pertenece el juego-->
          <div class="input-group flex-nowrap">
            <span class="input-group-text" id=""><i class="fas fa-folder-open"></i></span>
            <input type="text" class="form-control" name="categoria" value="<?php echo "Clave de la categoria: ".$idCategoria?>" placeholder="Titulo" aria-label="Username" aria-describedby="addon-wrapping" disabled>
          </div>
          <!--Botones para eliminar o para cancelar la eliminación-->
          <button type="submit" class="btnEliminar btn-primary">Eliminar</button>
          <a class="cancelar" href="../Gestión%20del%20Juego/EliminarJuego.php?idProfesor=<?php echo $idProfesor;?>">
            <button class="btnCancelar btn-danger btn-lg btn-block" type="button"> Cancelar </button>
          </a>
        </form> 
      </div>  
    </section>
    <footer class="footer"></footer>  
  </body>
</html>

