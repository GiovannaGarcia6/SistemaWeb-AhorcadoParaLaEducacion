<?php 
    //Se requiere el archivo para la conexión.
    require 'ConexionBD.php';
    session_start();//Se inicia la sesión.
    //Se obtiene los datos que se enviaron del formulario.
    $nombreEquipo = $_POST['nombreEquipo'];
    $avatar = $_POST['avatar'];
    $matricula = $_POST['matricula'];
    $idPartida = $_POST['idPartida'];
    //Query que obtiene el número de equipos que van a participar en la partida.
    $buscar=mysqli_query($conn,"SELECT numEquipos FROM Juego inner join partida on juego.idJuego = partida.idJuego WHERE idpartida='".$idPartida."'");
    $filas=mysqli_fetch_array($buscar);
    $numEquipos = $filas['numEquipos'];
    //Query que obtiene el conteo de los equipos que ya se registraron.
    $sql  = "Select count(*) as contar from equipo where idPartida = '".$idPartida."'";
    $consulta =  mysqli_query($conn, $sql);
    $array = mysqli_fetch_array($consulta);
    //si el contar es mayor al número de equipos permitidos de envia un mensaje al usuario.
    if($array['contar'] >= $filas['numEquipos']){
        $_SESSION['status'] = "Se excede el número de equipos";
        header("Location: ../Gestión%20del%20Juego/CodigoJuego.php?matricula=$matricula");
        exit();
    }else{
        //Sino, se insertan los datos del equipo.
        $query  = "Insert into equipo (idEquipo,NomEquipo,Puntaje,Avatar,idPartida,Matricula) values (0,'".$nombreEquipo."',0,'".$avatar."','".$idPartida."','".$matricula."')";
        //Se dirige a la página del código del juego para mostrar el mensaje según sea el caso.
        if($conn->query($query) === TRUE){
            $_SESSION['status'] = "Registrado con éxito. Observa la pantalla del profesor.";
            header("Location: ../Gestión%20del%20Juego/CodigoJuego.php?matricula=$matricula");
        }else{
            $_SESSION['status'] = "Hubo un error al registrar.";
            header("Location: ../Gestión%20del%20Juego/CodigoJuego.php?matricula=$matricula");
        }
    }
?>