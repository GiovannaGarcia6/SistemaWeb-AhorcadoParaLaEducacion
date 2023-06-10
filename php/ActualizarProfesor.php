<?php
    //Requerimos del archivo para realizar la conexión.
    require 'ConexionBD.php';
    //Se obtiene los datos que se enviaron del formulario.
    $idProfesor = $_POST['clave'];
    $nombre = $_POST['nombre'];
    $apPaterno = $_POST['apPaterno'];
    $apMaterno = $_POST['apMaterno'];
    $correo = $_POST['correo'];
    //Se realiza un query que realiza las actualizaciones pertinentes de los datos obtenidos.
    $consulta=mysqli_query($conn,"UPDATE Profesor SET nombre= '".$nombre."', apPaterno = '".$apPaterno."', apMaterno = '".$apMaterno."', email= '".$correo."' WHERE idProfesor='".$idProfesor."'");
    //Se dirige a la lista de los profesores.
    header('location: ../Gestión%20del%20Profesor/ListaModificarProfesor.php');
?>