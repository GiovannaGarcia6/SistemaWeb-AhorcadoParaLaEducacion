<?php
    //Se requiere el archivo para la conexión.
    require 'ConexionBD.php';
    session_start();//Se inicia la sesión.
    //Se obtiene los datos que se enviaron del formulario.
    $usuario = $_POST['clave'];
    $password = $_POST['contraseña'];
    //Query que hace un conteo con los usuarios administradores que considan con los datos enviados.
    $sql  = "Select count(*) as contar from administrador where idAdministrador = '".$usuario."' and pass = md5('".$password."')";
    $consulta =  mysqli_query($conn, $sql);
    $array = mysqli_fetch_array($consulta);
    //Si es mayor a 0 significa que encontro al usuario.
    if($array['contar'] > 0 ){
        //se dirige a menu correspondiente.
        $_SESSION['username'] = $usuario;
        header("Location: ../Administrador.php");
    }else{
        //Query que hace un conteo con los usuarios profesores que considan con los datos enviados.
        $sql  = "Select count(*) as contar from profesor where idProfesor = '".$usuario."' and contrasena = md5('".$password."')";
        $consulta =  mysqli_query($conn, $sql);
        $array = mysqli_fetch_array($consulta);
        //Si es mayor a 0 significa que encontro al usuario.
        if($array['contar'] > 0 ){
            //se dirige a menu correspondiente.
            $_SESSION['username'] = $usuario;
            header("Location: ../Profesor.php?idProfesor=$usuario");
        }else{
            //Query que hace un conteo con los usuarios estudiantes que considan con los datos enviados.
            $sql  = "Select count(*) as contar from estudiante where matricula = '".$usuario."' and password = md5('".$password."')";
            $consulta =  mysqli_query($conn, $sql);
            $array = mysqli_fetch_array($consulta);

            //Si es mayor a 0 significa que encontro al usuario.
            if($array['contar'] > 0 ){
            //se dirige a menu correspondiente.
                $_SESSION['username'] = $usuario;
                header("Location: ../Estudiante.php?matricula=$usuario");
            }else{
                //Sino entro en ninguna de las condiciones anteriores es porque no se encontro al usuario con esos datos.
                //Se dirige de nuevo al inicio de sesión mostrandole un mensaje.
                $_SESSION['status'] = "Usuario y/o contraseña incorrectos";
                header("Location: ../InicioSesion.php");
            }

        }
    }

    mysqli_close($conn);
?>


