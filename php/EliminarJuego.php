<?php
    //Insertamos código de otro archivo el cual contiene la conexión de la BD.
    require 'ConexionBD.php';
    //Obtenemos el id del jego y el del profesor
    $idJuego = $_POST['clave'];
    $idProfesor = $_POST['idProfesor'];
    //Query que elimina el juego que cmpla con el id del juego y del profesor.
    $consulta=mysqli_query($conn,"DELETE FROM juego WHERE idJuego='".$idJuego."'");
    //Se dirige a la página de elimnar
    header("location:../Gestión%20del%20Juego/EliminarJuego.php?idProfesor=$idProfesor");
?>