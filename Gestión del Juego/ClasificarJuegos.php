<?php
  session_start();//Se inicia la sesión.
  //Si no existe la variable username se redirige al inicio de sesión.
  if(!isset($_SESSION['username'])){
    header("Location: InicioSesion.php");
  }else{
    //Se obtiene el id del profesor.
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
    <link rel="stylesheet" href="../css/Estilos_Clasificar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <title>Clasificar juegos</title>
  </head>
  <body class="grid-container">
    <header class="header">
      <a href="#" class="enlace">
        <img src="../imagenes/logo2.png" alt="" class="logo">
        <span>Ahorcado para la educación</span> 
      </a>
    </header>
    <nav class="navbar">
      <button onclick="location.href='../Profesor.php?idProfesor=<?php echo $idProfesor;?>'" class="btn_Volver btn-lg btn-block" type="submit"><i class="fas fa-undo-alt"></i>Volver </a></button>   
    </nav>
    <section class="main">
      <div class="container py-5 h-100">
        <!--Se crea un formulario para crear las categorias de los juegos-->
        <form action="../php/CrearCategoria.php" method="post"> 
          <h2 class="mb-5" style="color: #4F1F91; margin-top:-20px"><i class="fas fa-plus-circle"></i>  Crear categoria</h2>
          <h5 class="mb-5" style="color: red; margin-top:-20px"><i class="fas fa-info-circle"></i>  Ingresar información </h5> 
          <!--Se muestra un mensaje de éxito o de error, esto depende de la variable de sessión llamada status-->
          <?php if(isset($_SESSION['status'])){ 
            if($_SESSION['status']=='Categoría creada con éxito.'){
          ?>
          <div id="alerta" class="alert alert-success d-flex align-items-center" role="alert"  style="margin-top:-30px; margin-bottom:px;">
            <?php echo $_SESSION['status']; ?>
          </div>           
          <?php }else{?> 
          <div id="alerta" class="alert alert-danger d-flex align-items-center" role="alert"  style="margin-top:-30px; margin-bottom:px;">
            <?php echo $_SESSION['status']; ?>
          </div>      
          <?php }header("refresh:1; url = ClasificarJuegos.php?idProfesor=$idProfesor"); unset($_SESSION['status']); } ?>
          <input type="hidden" name="idProfesor" value="<?php echo $idProfesor?>"> 
          <!--Se solicitan los datos necesarios para crear la categoría del juego, en este caso
          solicita la clave de la categoria y el nombre-->
          <div id="input" class="input-group flex-nowrap">
            <span class="input-group-text" id=""><i class="fas fa-key"></i></span>
            <input type="text" class="form-control" autocomplete="off" name="idCategoria" placeholder="Clave de la categoria" aria-label="Username" aria-describedby="addon-wrapping" required>
            <span class="input-group-text" id=""><i class="fa-brands fa-amilia"></i></span>
            <input type="text" class="form-control" autocomplete="off" name="nomCategoria" placeholder="Nombre de la categoria" aria-label="Username" aria-describedby="addon-wrapping" required>
          </div><br>
          <button class="btnCrear btn-lg btn-block" type="submit">Crear</button>
        </form>   
        <br><br>
        <h2 class="mb-5" style="color: #4F1F91; margin-top:-20px"><i class="fas fa-folder-open"></i> Categorias creadas</h2>   
        <!--Se crea una tabla con las categorias creadas del profesor-->
        <table class="table table-striped table-hover">
          <!--Se muestran los nombres de las columnas de la tabla-->
          <thead>
            <th>Clave de la categoria</th>
            <th>Nombre de la categoria</th>
            <th>Juegos</th>
          </thead>
          <?php
            //Se inserta código del archivo php para la conexión de la base de datos.
            require '../php/ConexionBD.php';
            //Creamos un query para mostrar las categorias creadas por el profesor.
            $sentencia="SELECT * FROM categoria where idProfesor = '".$idProfesor."'";
            $resultado=mysqli_query($conn,$sentencia);
            while($filas=mysqli_fetch_assoc($resultado)){
              //Se muestran los datos encontrados
              echo "<tr>";
              echo "<td>"; echo $filas['idCategoria']; echo "</td>";
              echo "<td>"; echo $filas['NomCategoria']; echo "</td>";
              echo "<td>  <a href='MostrarJuegosPorCategoria.php?idCategoria=".$filas['idCategoria']."'> <button type='button' class='btn btn-danger'>Mostrar</button> </a> </td>";
              echo "</tr>";
            }
            mysqli_close($conn); //Se cierra la conexión con la bd. 
          ?>
  	    </table>
      </div> 
    </section>
    <footer class="footer"></footer>
  </body>
</html>