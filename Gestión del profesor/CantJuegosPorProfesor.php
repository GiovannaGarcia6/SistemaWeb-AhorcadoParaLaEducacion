<?php
  session_start();//Se inicia la sesión.
  //Si no existe la variable username se redirige al inicio de sesión.
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
    <link rel="stylesheet" href="../css/Estilos_Consultar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <title>Consultar</title>
  </head>
  <body class="grid-container">
    <header class="header">
      <a href="#" class="enlace">
        <img src="../imagenes/logo2.png" alt="" class="logo">
        <span>Ahorcado para la educación</span> 
      </a>
    </header>
    <nav class="navbar">
      <a class="volver" href="../Administrador.php"><button class="btnVolver btn-lg btn-block" type="submit"> <i class="fas fa-undo-alt"></i>Volver</button></a> 
    </nav>
    <section class="main">
      <div class="container py-5 h-100">
        <div class="table-responsive">
          <h2 class="mb-5" style="color: #4F1F91;"><i class="fas fa-user"></i><i class="fas fa-search"></i> Consultar cantidad de juegos por profesor</h2>
          <!--Buscador para consultar los juegos-->
          <form action="CantJuegosPorProfesor.php" method="post">
            <div id="input1" class="input-group flex-nowrap">
              <span class="input-group-text" id=""><i class="fas fa-key"></i></span>
              <input type="text" autocomplete="off" class="form-control" name="buscador" id="buscador" placeholder="Clave/Nombre/Apellido Paterno/Apellido Materno" aria-label="Username" aria-describedby="addon-wrapping">
            </div>   
            <button type='submit' class='btn btn-primary' value="Buscar">Buscar</button> 
          </form>
          <?php
            //Se inserta código del archivo php para la conexión de la base de datos.
            require '../php/ConexionBD.php';
            if(isset($_POST['buscador'])){
              //Se obtiene el buscador
              $clave = htmlentities($_POST['buscador']);
              //Creamos un query para mostrar los datos de los profesore con el dato que inserto en el buscador.
              $sql = "SELECT profesor.idprofesor, nombre, apPaterno, apMaterno, count(*) as 'Cantidad de juegos' FROM profesor INNER JOIN juego on profesor.idProfesor = juego.idProfesor WHERE profesor.idProfesor LIKE '%".$clave."%' OR nombre LIKE '%".$clave."%' OR apPaterno LIKE '%".$clave."%' OR apMaterno LIKE '%".$clave."%' GROUP BY juego.idProfesor";
              $result = mysqli_query($conn, $sql);
              // verificamos que no haya error
              if (!$result){
                echo "<br>";
                echo "La consulta SQL contiene errores.".mysqli_error();
                exit();
              }else{
                //Se obtiene el numero de filas que tuvo el reultado del query.
                $numfilas = $result->num_rows;
                //Si es igual a 0 indica que no existe un registro de esa manera que se busco.
                if($numfilas==0){
          ?> 

                  <!-- Alerta para cuando no se encuentran registros-->
                  <div id="alerta" class="alert alert-danger d-flex align-items-center" role="alert"  style="margin-top:10px;">No se encontraron registros</div><br>
          <?php
                }else{
                  //En otro caso, se muestra la tabla con los registros.
                  echo "<table class='table table-striped table-hover'>";
                    //Se muestra los nombres de cada columna de la tabla
                    echo "<thead>";
                    echo "<th>Clave</th>";
                    echo "<th>Nombre</th>";
                    echo "<th>Apellido Paterno</th>";
                    echo "<th>Apellido Materno</th>";
                    echo "<th>Cantidad de juegos creados</th>";
                    echo "</thead>"; 
                    //Se muestran los datos encontrados de la busqueda
                    while ($row = mysqli_fetch_row($result)){
                      echo "<tr>";
                      echo "<td>"; echo $row[0]; echo "</td>";
                      echo "<td>"; echo $row[1]; echo "</td>";
                      echo "<td>"; echo $row[2]; echo "</td>";
                      echo "<td>"; echo $row[3]; echo "</td>";
                      echo "<td>"; echo $row[4]; echo "</td>";
                      echo "</tr>"; 
                    }
                  echo "</table>";
                }    
              }   
            }
            mysqli_close($conn); //Se cierra la conexión con la bd. 
          ?>
        </div>
      </div>
    </section>
    <footer class="footer"></footer>
  </body>
</html>