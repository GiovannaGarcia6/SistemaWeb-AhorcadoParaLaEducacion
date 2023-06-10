<?php
   //Requerimos del archivo para realizar la conexión.
   require 'ConexionBD.php';
   session_start();//Se inicia la sesión.
   //Se obtiene los datos que se enviaron del formulario.
    $idCategoria = $_POST['idCategoria'];
    $idProfesor = $_POST['idProfesor'];
    $nomCategoria = $_POST['nomCategoria'];
    //Se realiza un query que cuente cuantas categorias existen con la información que se mando.
    $sql  = "Select count(*) as contar from categoria where idCategoria = '".$idCategoria."'";
    $consulta =  mysqli_query($conn, $sql);
    $array = mysqli_fetch_array($consulta);
    //Si esta es mayor a cero significa que existe la categoria.
    if($array['contar'] > 0 ){
        //Por lo que, debe mandarse u mensaje al usuario para que inserte una nueva clave.
        $_SESSION['status'] = "La clave de la categoria ya existe.";
        header("Location: ../Gestión%20del%20Juego/ClasificarJuegos.php?idProfesor=$idProfesor");
        exit(); 
    }else{
        //Sino existe se crea un query para ingresar los datos de la nueva categoria.
        $query  = "Insert into categoria (idCategoria, NomCategoria, idProfesor) values ('".$idCategoria."','".$nomCategoria."','".$idProfesor."')";    
        //Si el query es exitoso se manda un mensaje de éxito.
        if($conn->query($query) === TRUE){
            $_SESSION['status'] = "Categoría creada con éxito.";
            header("Location: ../Gestión%20del%20Juego/ClasificarJuegos.php?idProfesor=$idProfesor");
        }else{
            //Caso contrario, se envia mensaje de que hubo un error.
            $_SESSION['status'] = "Hubo un error al registrar.";
            header("Location: ../Gestión%20del%20Juego/ClasificarJuegos.php?idProfesor=$idProfesor");
        }    
    }
?>