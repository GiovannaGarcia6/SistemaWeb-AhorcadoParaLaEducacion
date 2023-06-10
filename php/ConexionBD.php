<?php  
    $host = 'localhost'; //El host por el que se esta conectando
    $user = 'root'; //El usuario
    $pw = '';//La contraseña del usuario
    $bd = 'Ahorcado';//El nombre de la base de datos
    //Se realiza la conexión con todos los datos anteriores.
    $conn = mysqli_connect($host,$user,$pw,$bd);
    if ($conn) {
        //Se realiza la conexión exitosa
        //echo "Conexion exitosa";
    }else{
        //Hubo un error al realizar la conexíon.
        echo "Error de conexion";
    }

?>