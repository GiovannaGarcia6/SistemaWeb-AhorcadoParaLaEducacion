<?php 
    require '../php/ConexionBD.php';
    $idPartida = $_POST['idPartida'];
    
    //Se obtiene las palabras correctas e incorrectas que se genero en el juego del ahorcado.
    $palabrasCorrectas = $_POST['palabrasCorrectas'];
    $palabrasIncorrectas = $_POST['palabrasIncorrectas'];

    //Se obtiene el puntaje maximo que se genero en la partida
    $buscar=mysqli_query($conn,"SELECT max(Puntaje) as puntajeMax from equipo where idPartida = '".$idPartida."'");
    $filas=mysqli_fetch_array($buscar);
    $puntajeMax = $filas['puntajeMax'];

    //Se realiza un recorrido para buscar que equipos tienen el puntaje maximo y
    //si cumplen con la condición se realiza la actualización del estatus como 'Ganada'
    $sentencia="SELECT * FROM Equipo where idPartida = '".$idPartida."'";
    $resultado=mysqli_query($conn,$sentencia);
    while($filas=mysqli_fetch_assoc($resultado)){
        if($filas['Puntaje']==$puntajeMax){
            $sqlGanador=mysqli_query($conn,"UPDATE Equipo SET Estatus = 'Ganada' WHERE idEquipo='".$filas['idEquipo']."'");
        }
    }
    
    //Se realizan las actualizaciones correspondientes para almacenar las palabras
    //correctas e incorrectas que se tuvieron en el juego.
    $sqlCorrectas=mysqli_query($conn,"UPDATE Partida SET Correctas = '".$palabrasCorrectas."' WHERE idPartida='".$idPartida."'");
    $sqlIncorrectas=mysqli_query($conn,"UPDATE Partida SET Incorrectas = '".$palabrasIncorrectas."' WHERE idPartida='".$idPartida."'");

    //Una vez realizadas las actualizaciones se dirige al tablero de posiciones
    header("Location: ../Gestión%20del%20Juego/TableroPosiciones.php?idPartida=$idPartida");
?>