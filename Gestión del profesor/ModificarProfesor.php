<?php
  session_start();
  //Se verifica que exista la variable de sesión.
  if(!isset($_SESSION['username'])){
    header("Location: InicioSesion.php");
  }else{
    //Se obtiene el id del profesor.
    $idProfesor=$_GET['idProfesor'];
    //Requerimos del archivo para realizar la conexión.
    require '../php/ConexionBD.php';
    //Se crea un query para obtener datos del profesor seleccionado para modificar.
    $buscar=mysqli_query($conn,"SELECT idProfesor, nombre,ApPaterno,ApMaterno,Email FROM Profesor WHERE idProfesor='".$idProfesor."' ");
    $filas=mysqli_fetch_array($buscar);
    //Se obtienen los datos del juego.
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
    <link rel="stylesheet" href="../css/Estilos_RegistrarProfesores.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <title>Modificar profesor</title>
  </head>
  <body class="grid-container">
    <header class="header">
      <a href="#" class="enlace">
        <img src="imagenes/logo2.png" alt="" class="logo"><span>Ahorcado para la educación</span> 
      </a>
    </header>
    <nav class="navbar">
      <a class="volver" href="ListaModificarProfesor.php"><button class="btnVolver btn-lg btn-block" type="submit"> <i class="fas fa-undo-alt"></i>Volver</button></a> 
    </nav>
    <section class="main">
      <div class="container py-5 h-100">
        <form action="../php/ActualizarProfesor.php" method="POST">
          <!--Se muestran todos los campos editables de la información del profesor-->
          <h2 class="mb-5" style="color: #4F1F91;"><i class="fas fa-user-edit"></i> Datos del profesor</h2>
          <input type="hidden" name="clave" value="<?php echo $idProf?> ">
          <div id="input1" class="input-group flex-nowrap">
            <span class="input-group-text" id=""><i class="fas fa-key"></i></span>
            <input type="text" autocomplete="off" class="form-control" name="idProfesor" value="<?php echo $idProf?>" placeholder="Clave" aria-label="Username" aria-describedby="addon-wrapping" disabled>
          </div>
          <div class="input-group flex-nowrap">
            <span class="input-group-text" id=""><i class="fas fa-user"></i></span>
            <input type="text" autocomplete="off" class="form-control" name="nombre" value="<?php echo $nombre ?>" placeholder="Nombre" aria-label="Username" aria-describedby="addon-wrapping" required>
          </div>
            <div class="input-group flex-nowrap">
            <span class="input-group-text" id=""><i class="fas fa-user"></i></span>
            <input type="text" autocomplete="off" class="form-control" name="apPaterno" value="<?php echo $apPaterno ?>" placeholder="Apellido Paterno" aria-label="Username" aria-describedby="addon-wrapping" required>
          </div>
          <div class="input-group flex-nowrap">
            <span class="input-group-text" id=""><i class="fas fa-user"></i></span>
            <input type="text" autocomplete="off" class="form-control" name="apMaterno" value="<?php echo $apMaterno ?>" placeholder="Apellido Materno" aria-label="Username" aria-describedby="addon-wrapping">
          </div>
          <div class="input-group flex-nowrap">
            <span class="input-group-text" id=""><i class="fas fa-envelope"></i></span>
            <input type="email" autocomplete="off" class="form-control" name="correo"  value="<?php echo $correo ?>" placeholder="E-mail" aria-label="Username" aria-describedby="addon-wrapping" required>
          </div><br>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </form> 
      </div> 
    </section>
    <footer class="footer"></footer>
  </body>
</html>