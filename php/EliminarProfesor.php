<?php
    //Se requiere la conexión de la bd.
    require 'ConexionBD.php';
    //Se obtiene el id del profesor a eliminar
    $idProfesor = $_POST['clave'];
    //Query que realiza la eliminación del registro.
    $consulta=mysqli_query($conn,"DELETE FROM profesor WHERE idProfesor='".$idProfesor."' ");
    //Se dirige a la lista de profesores.
    header('location: ../Gestión%20del%20Profesor/ListaEliminarProfesor.php');
?>