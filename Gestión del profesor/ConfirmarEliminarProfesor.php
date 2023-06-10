<?php
  session_start();//Se inicia la sesión
  //Si no existe la variable username se redirige al inicio de sesión
  if(!isset($_SESSION['username'])){
    header("Location: InicioSesion.php");
  }else{
    //Si existe se obtiene el id del profesor.
    $idProfesor=$_GET['idProfesor'];
    //Requerimos del archivo para realizar la conexión.
    require '../php/ConexionBD.php';
    //Se crea un query para mostrar datos del profesor seleccionado para eliminar.
    $buscar=mysqli_query($conn,"SELECT idProfesor, nombre,ApPaterno,ApMaterno,Email FROM Profesor WHERE idProfesor='".$idProfesor."' ");
    $filas=mysqli_fetch_array($buscar);
    //Se obtienen los datos del profesor.
    $idProf = $filas['idProfesor'];
    $nombre = $filas['nombre'];
    $apPaterno = $filas['ApPaterno'];
    $apMaterno = $filas['ApMaterno'];
    $correo = $filas['Email'];
    mysqli_close($conn);//Se cierra la conexión de la bd.
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
        <img src="../imagenes/logo2.png" alt="" class="logo"><span>Ahorcado para la educación</span> 
      </a>
    </header>
    <nav class="navbar">
      <a class="volver" href="ListaEliminarProfesor.php"><button class="btnVolver btn-lg btn-block" type="submit"> <i class="fas fa-undo-alt"></i>Volver</button></a> 
    </nav>
    <section class="main">
      <div class="container py-5 h-100">
        <form action="../php/EliminarProfesor.php" method="POST">
          <h2 class="mb-5" style="color: #4F1F91;"><i class="fas fa-user"></i> Datos del profesor</h2>
          <!--Mensaje para recordar si esta seguro de eliminar el registro-->
          <div id="alerta" class="alert alert-danger d-flex align-items-center" role="alert">¿Está seguro de eliminar el siguiente registro?</div><br>
          <!--Se muestran cada uno de los datos del profesor selecionado (campos no editables)-->
          <input type="hidden" name="clave" value="<?php echo $idProf?> ">
          <div id="input1" class="input-group flex-nowrap">
            <span class="input-group-text" id=""><i class="fas fa-key"></i></span>
            <input type="text" class="form-control" name="idProfesor" value="<?php echo $idProf?>" placeholder="Clave" aria-label="Username" aria-describedby="addon-wrapping" disabled>
          </div>
          <div class="input-group flex-nowrap">
            <span class="input-group-text" id=""><i class="fas fa-user"></i></span>
            <input type="text" class="form-control" name="nombre" value="<?php echo $nombre ?>" placeholder="Nombre" aria-label="Username" aria-describedby="addon-wrapping" disabled>
            <input type="text" class="form-control" name="apPaterno" value="<?php echo $apPaterno ?>" placeholder="Apellido Paterno" aria-label="Username" aria-describedby="addon-wrapping" disabled>
            <input type="text" class="form-control" name="apMaterno" value="<?php echo $apMaterno ?>" placeholder="Apellido Materno" aria-label="Username" aria-describedby="addon-wrapping" disabled>    
          </div>
          <div class="input-group flex-nowrap">
            <span class="input-group-text" id=""><i class="fas fa-envelope"></i></span>
            <input type="email" class="form-control" name="correo"  value="<?php echo $correo ?>" placeholder="E-mail" aria-label="Username" aria-describedby="addon-wrapping" disabled>
          </div>
          <button type="submit" class="btnEliminar btn-primary">Eliminar</button>
          <a class="cancelar" href="ListaEliminarProfesor.php"><button class="btnCancelar btn-danger btn-lg btn-block" type="button"> Cancelar </button></a>
        </form> 
      </div> 
    </section>
    <footer class="footer"></footer>
  </body>
</html>