<?php
    //Requerimos del archivo para realizar la conexión.
    require 'ConexionBD.php';
    session_start();//Se inicia la sesión.
    //Se obtiene los datos que se enviaron del formulario.
    $idJuego = $_POST['clave'];
    $titulo = $_POST['titulo'];
    $palabras = $_POST['palabras'];
    $pistas = $_POST['pistas'];
    $numEquipos = $_POST['numEquipos'];
    $categoria = $_POST['categoria'];
    $idProfesor = $_POST['claveProfesor'];
    //Se realiza un query que cuente cuantas categorias existen con la información que se mando.
    $sql  = "Select count(*) as contar from categoria where idCategoria = '".$categoria."'";
    $consulta =  mysqli_query($conn, $sql);
    $array = mysqli_fetch_array($consulta);
    //Si esta es mayor a cero significa que existe la categoria y se procede con la actualización.
    if($array['contar'] > 0 ){
        // Se crea un query que actualiza todos los datos que se enviaron del formulario.
        $query="UPDATE Juego SET titulo = '".$titulo."', palabras = '".$palabras."', pistas = '".$pistas."', numEquipos= '".$numEquipos."', idCategoria= '".$categoria."'  WHERE idJuego='".$idJuego."'";
        //Si el query es exitoso se dirige a la página donde esta la lista de los juegos.
        if($conn->query($query) === TRUE){
            header("location: ../Gestión%20del%20Juego/ListaModificarJuegos.php?idProfesor=$idProfesor");
        }else{
            //En otro caso, se guarda el mensaje de session y se dirige a la página de donde mandaron los datos para mostrar el mensaje.
            $_SESSION['status'] = "Hubo un error al modificar.";
            header("location: ../Gestión%20del%20Juego/ModificarJuego.php?idJuego=$idJuego");
        }
    }else{
        //Sino se manda un mensaje en la variable de sesion para que sea mostrada en la pagina de modificar juego
        $_SESSION['status'] = "Seleccione una la categoria.";
        header("location: ../Gestión%20del%20Juego/ModificarJuego.php?idJuego=$idJuego");
    }
?>