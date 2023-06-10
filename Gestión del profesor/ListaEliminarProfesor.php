<?php
  session_start();//Se inicia la sesión
  //Si no existe la variable username se redirige al inicio de sesión
  if(!isset($_SESSION['username'])){
    header("Location: InicioSesion.php");
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
    <link rel="stylesheet" href="../css/Estilos_ListaEliminar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <title>Eliminar profesor</title>
  </head>
  <body class="grid-container">
    <header class="header">
      <a href="#" class="enlace">
        <img src="../imagenes/logo2.png" alt="" class="logo"><span>Ahorcado para la educación</span> 
      </a>
    </header>
    <nav class="navbar">
      <a class="volver" href="../Administrador.php"><button class="btnVolver btn-lg btn-block" type="submit"> <i class="fas fa-undo-alt"></i>Volver</button></a> 
    </nav>
    <section class="main">
      <div class="container py-5 h-100">
        <div class="table-responsive">
          <h2 class="mb-5" style="color: #4F1F91;"><i class="fas fa-user-times"></i> Eliminar profesor</h2>
          <table class="table table-striped table-hover">
            <!--Se muestra los nombres de cada columna de la tabla-->
            <thead>
              <th>Clave</th>
              <th>Nombre</th>
              <th>Apellido Paterno</th>
              <th>Apellido Materno</th>
              <th>Correo Electrónico</th>
              <th>Eliminar</th>
            </thead>
            <?php
              //Se inserta código del archivo php para la conexión de la base de datos.
              require '../php/ConexionBD.php';
              //Creamos un query para mostrar a la lista de profesores que hay en la bd.
              $sentencia="SELECT * FROM profesor";
              $resultado=mysqli_query($conn,$sentencia);
              while($filas=mysqli_fetch_assoc($resultado)){
                //Se van mostrando los datos en caso de que existan registros.
                echo "<tr>";
                echo "<td>"; echo $filas['idProfesor']; echo "</td>";
                echo "<td>"; echo $filas['Nombre']; echo "</td>";
                echo "<td>"; echo $filas['ApPaterno']; echo "</td>";
                echo "<td>"; echo $filas['ApMaterno']; echo "</td>";
                echo "<td>"; echo $filas['Email']; echo "</td>";
                //Se crea un botón que los dirige a la página de confirmación de la eliminación.
                echo "<td>  <a href='ConfirmarEliminarProfesor.php?idProfesor=".$filas['idProfesor']."'> <button type='button' class='btn btn-danger'>Eliminar</button> </a> </td>";
                echo "</tr>";
              }
            ?>
          </table>
        </div>
      </div>
    </section>
    <footer class="footer"></footer>
  </body>
</html>