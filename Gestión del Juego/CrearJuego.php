<?php
  session_start();
  //Se verifica que exista la variable de sesión para que el usuario pueda acceder al menú,
  if(isset($_SESSION['username'])){
    //Se obtiene el id del profesor,
    $clave=$_GET['idProfesor'];
  }else{
    //En caso de que no se encuentre la variable de sesión se redirige al inicio de sesión.
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
    <link rel="stylesheet" href="../css/Estilos_CrearJuego.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <title>Crear Juego</title>
  </head>
 <body class="grid-container">
    <header class="header">
      <a href="#" class="enlace">
        <img src="../imagenes/logo2.png" alt="" class="logo">
        <span>Ahorcado para la educación</span> 
      </a>
    </header>
    <nav class="navbar">
      <a class="volver" href="../Profesor.php?idProfesor=<?php echo $clave;?>"><button class="btnVolver btn-lg btn-block" type="submit"> <i class="fas fa-undo-alt"></i>Volver</button></a> 
    </nav>
    <section class="main">
      <div class="container py-5 h-100">
        <form action="../php/CrearJuego.php" method="post"> 
          <h2 class="mb-5" style="color: #4F1F91; margin-top:-20px"><i class="fas fa-plus-circle"></i>  Crear juego</h2>
          <h5 class="mb-5" style="color: red; margin-top:-20px"><i class="fas fa-info-circle"></i>  Ingresar información </h5> 
          <!--Se muestra un mensaje de éxito o de error-->
          <?php if(isset($_SESSION['status'])){ 
            if($_SESSION['status']=='Creado con éxito.'){
          ?>
          <div id="alerta" class="alert alert-success d-flex align-items-center" role="alert"  style="margin-top:-30px; margin-bottom:px;">
            <?php echo $_SESSION['status']; ?>
          </div>        
          <?php }else{?> 
          <div id="alerta" class="alert alert-danger d-flex align-items-center" role="alert"  style="margin-top:-30px; margin-bottom:px;">
            <?php echo $_SESSION['status']; ?>
          </div> 
          <!--Se elimina la variable status-->     
          <?php } header("refresh:1; url = CrearJuego.php?idProfesor=$clave"); unset($_SESSION['status']); } ?>
          
          <br>            
          <div id="input1" class="input-group flex-nowrap">
            <input type="hidden" name="claveProfesor" value="<?php echo $clave?>">
            <span class="input-group-text" id=""><i class="fas fa-key"></i></span>
            <input type="text" class="form-control" name="claveJuego" placeholder="Clave del Juego" aria-label="Username" aria-describedby="addon-wrapping" required>
            <span class="input-group-text" id=""><i class="fas fa-key"></i></span>
            <!--Obtenemos la lista de categorias del profesor, las cueles se encuntran en la base de datos-->    
            <select class="form-control" id="idCategoria" name="idCategoria" aria-label="Username" required>
              <option value="Categoria">Seleccione una categoria</option>
              <?php
                require '../php/ConexionBD.php';
                $sentencia="SELECT * FROM categoria where idProfesor = '".$clave."'";
                $resultado=mysqli_query($conn,$sentencia);
                while ($categorias = mysqli_fetch_array($resultado)) {
                  echo '<option value="'.$categorias['idCategoria'].'">'.$categorias['NomCategoria'].'</option>';
                }
                mysqli_close($conn); //Se cierra la conexión con la base de datos
              ?>
            </select>
          </div>
          <!--Se solicitan mas datos como el titulo del juego, las palabras, las pistas y el n° de equipos-->    
          <div id="input" class="input-group flex-nowrap">
            <span class="input-group-text" id=""><i class="far fa-keyboard"></i></span>
            <input type="text" autocomplete="off" class="form-control" name="titulo" placeholder="Titulo del juego" aria-label="Username" aria-describedby="addon-wrapping" required>
          </div>
          <div class="input-group flex-nowrap">
            <span class="input-group-text" id=""><i class="fas fa-font"></i></span>
            <textarea class="form-control" name="palabras" placeholder="Las palabras deben estas separadas por una coma y sin espacios. -->Ejemplo: Perro,Gato,Jirafa" id="" required></textarea>
          </div>
          <div class="input-group flex-nowrap">
            <span class="input-group-text" id=""><i class="fas fa-search"></i></span>
            <textarea class="form-control" name="pistas" placeholder="Las pistas deben estar separadas por un punto, sin espacios y debe ser una pista por palabra. -->Ejemplo:Pista1.Pista2.Pista3" id="" required></textarea>
          </div> 
          <div class="input-group flex-nowrap">
            <span class="input-group-text" id=""><i class="fas fa-users"></i></span>
            <select class="form-control" id="numEquipos" name="numEquipos" aria-label="Username" required>
              <option selected value="N° de Equipos">N° de Equipos</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
            </select>
          </div> 
          <!--Botón que mediante el formulario enviará los datos a otro archivo php que tiene la funcion de ingresar
          los datos en caso de que sean correctos-->    
          <button class="btn  btn-lg btn-block" type="submit">Crear</button>
        </form>    
      </div> 
    </section>
    <footer class="footer"></footer>
  </body>
</html>