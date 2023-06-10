<?php 
    //Llamamos el archivo de conexión para hacer uso de la base de datos.
    require '../php/ConexionBD.php';
    //Obtenemos el equipo al que se le asignaran los puntos.
    $equipo = $_POST['equipo'];
    //Convertimos a entero los puntos obtenidos.
    $puntos = (int)$_POST['asignarPuntos'];
    //se realiza un query con la actualización de los puntos, sumandole los puntos que a tenia con los que se enviaron.
    $consulta=mysqli_query($conn,"UPDATE Equipo SET Puntaje = Puntaje + $puntos WHERE idEquipo='".$equipo."'");
?>