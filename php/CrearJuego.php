<?php 
    //Insertamos código de otro archivo el cual contiene la conexión de la BD.
    require 'ConexionBD.php';
    session_start(); //Se inicia la sesión.
    //Se obtienen todos los datos que se mandaron al formulario.
    $claveJuego = $_POST['claveJuego'];
    $claveProfesor = $_POST['claveProfesor'];
    $categoria = $_POST['idCategoria'];
    $titulo = $_POST['titulo'];
    $palabras = $_POST['palabras'];
    $pistas = $_POST['pistas'];
    $numEquipos=$_POST['numEquipos'];
    //Se realiza un conteo de cuantos juegos tiene la misma clave.
    $sql  = "Select count(*) as contar from juego where idJuego = '".$claveJuego."'";
    $consulta =  mysqli_query($conn, $sql);
    $array = mysqli_fetch_array($consulta);
    //Si es mayor a cero significa que la clave del juego ya existe y debe redirigirse a la página de crear juego.
    if($array['contar'] > 0 ){
        $_SESSION['status'] = "La clave del juego ya existe.";
        header("Location: ../Gestión%20del%20Juego/CrearJuego.php?idProfesor=$claveProfesor");
        exit();
    }else{
        //Se realiza un conteo de cuantas categorias hay con la misma clave.     
        $sql  = "Select count(*) as contar from categoria where idCategoria = '".$categoria."' && idProfesor = '".$claveProfesor."'";
        $consulta =  mysqli_query($conn, $sql);
        $array = mysqli_fetch_array($consulta);
        //Si es mayor a cero significa que la clave del juego existe
        //y puede proceguir con la siguiente vericación.
        if($array['contar'] > 0 ){
            //Se realiza un conteo de cuantas claves son iguales a la que se mando del formulario.     
            $sql  = "Select count(*) as contar from profesor where idProfesor = '".$claveProfesor."'";
            $consulta =  mysqli_query($conn, $sql);
            $array = mysqli_fetch_array($consulta);
            //Si es mayor a cero significa que la clave del profesor existe
            //y puede proceguir con la siguiente vericación.
            if($array['contar'] > 0 ){
                //Se realiza un conteo de cuantos titulos tienen el mismo.     
                $sql  = "Select count(*) as contar from Juego where titulo = '".$titulo."'";
                $consulta =  mysqli_query($conn, $sql);
                $array = mysqli_fetch_array($consulta);
                //Si es mayor a cero significa que ya existe ese titulo y el usuario debe ingresar otro.
                if($array['contar'] > 0 ){
                    $_SESSION['status'] = "El titulo del juego ya existe.";
                    header("Location: ../Gestión%20del%20Juego/CrearJuego.php?idProfesor=$claveProfesor");
                    exit(); 
                }else{
                    //Query que realiza la inserción de los datos cuando todos son correctos
                    $query  = "Insert into juego (idJuego,titulo,palabras,pistas,numEquipos,idCategoria,idProfesor) values ('".$claveJuego."','".$titulo."','".$palabras."','".$pistas."','".$numEquipos."','".$categoria."','".$claveProfesor."')";    
                    //Si el query se ejecuta correctamente se muestra un mensaje de éxito.
                    if($conn->query($query) === TRUE){
                        $_SESSION['status'] = "Creado con éxito.";
                        header("Location: ../Gestión%20del%20Juego/CrearJuego.php?idProfesor=$claveProfesor");
                    }else{
                        //Se manda el mensaje de error y se redirigirse a la página de crear juego para mkostrarlo.
                        $_SESSION['status'] = "Hubo un error al registrar.";
                        header("Location: ../Gestión%20del%20Juego/CrearJuego.php?idProfesor=$claveProfesor");
                    }
                }
            }else{
                //Se manda el mensaje y se redirigirse a la página de crear juego para mkostrarlo.
                $_SESSION['status'] = "El usuario no existe.";
                header("Location: ../Gestión%20del%20Juego/CrearJuego.php?idProfesor=$claveProfesor");                
                exit();
            }   
        }else{
            //Se manda el mensaje y se redirigirse a la página de crear juego para mkostrarlo.
            $_SESSION['status'] = "Crea una categoria para poder crear el juego.";
            header("Location: ../Gestión%20del%20Juego/CrearJuego.php?idProfesor=$claveProfesor"); 
            exit();
        }
    }
    mysqli_close($conn); //Se cierra la conexión con la bd.
?>
