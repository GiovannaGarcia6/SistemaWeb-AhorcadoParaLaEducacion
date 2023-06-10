<?php 
    //Se requiere el archivo para la conexión.
    require 'ConexionBD.php';
    session_start();//Se inicia la sesión.
    //Se obtiene los datos que se enviaron del formulario.
    $clave = $_POST['clave'];
    $nombre = $_POST['nombre'];
    $apellidoPaterno = $_POST['apellidoPaterno'];
    $apellidoMaterno = $_POST['apellidoMaterno'];
    $correo = $_POST['correo'];
    $contrasena=$_POST['contraseña'];
    $TipoUsuario = $_POST['tipoUsuario'];
    $verificado = 0;
    //Si el usuario que se va a registrar es administrador se debe requerir una clave de otro administrador.
    if ($TipoUsuario == "Administrador" || $TipoUsuario == "Profesor"){
        $claveAdmin = $_POST['claveAdmin'];
        //Query que hace el conteo para saber si existe la clave.
        $sql  = "Select count(*) as contar from administrador where idAdministrador = '".$claveAdmin."'";
        $consulta =  mysqli_query($conn, $sql);
        $array = mysqli_fetch_array($consulta);
        //Si existe la variable verificado pasa a 1 y con este puede pasar a las sig validación.
        if($array['contar'] > 0 ){
            $verificado = 1;
        }
    }
    //Si el verificado es 1 o el tipo de usuario es estudiantes entonces...
    if($verificado == 1 || $TipoUsuario == "Estudiante"){
        //Se verifica si existe la clave del administrador a registrar.
        $sql  = "Select count(*) as contar from administrador where idAdministrador = '".$clave."'";
        $consulta =  mysqli_query($conn, $sql);
        $array = mysqli_fetch_array($consulta);
        //Si existe, debe ingresar otra nuevamente.
        if($array['contar'] > 0 ){
            $_SESSION['status'] = "El usuario ya existe.";
            header("Location: ../Registrarse.php");
            exit();
        }else{
            //Caso contrario, se verifica que no se repita con un profesor
            $sql  = "Select count(*) as contar from profesor where idProfesor = '".$clave."'";
            $consulta =  mysqli_query($conn, $sql);
            $array = mysqli_fetch_array($consulta);
            //Si existe, debe ingresar otra nuevamente.
            if($array['contar'] > 0 ){
                $_SESSION['status'] = "El usuario ya existe.";
                header("Location: ../Registrarse.php");
                exit();
            }else{
                //En cao de que no se encuentre en los dos tipos de usuarios anteriores, se verifica que no se repita con un estudiante.
                $sql  = "Select count(*) as contar from estudiante where matricula = '".$clave."'";
                $consulta =  mysqli_query($conn, $sql);
                $array = mysqli_fetch_array($consulta);
                //Si existe, debe ingresar otra nuevamente.
                if($array['contar'] > 0 ){
                    $_SESSION['status'] = "El usuario ya existe.";
                    header("Location: ../Registrarse.php");
                    exit();
                }else{
                    //Sino se encontro en ninguna condición se verifica de que tipo de usuario es para registrarlo donde corresponda.
                    if ($TipoUsuario == "Administrador"){
                        $query  = "Insert into Administrador (idAdministrador,Nom,ApellidoPa,ApellidoMa,Correo,Pass,TipoUsuario) values ('".$clave."','".$nombre."','".$apellidoPaterno."','".$apellidoMaterno."','".$correo."',md5('".$contrasena."'),'".$TipoUsuario."')";    
                    }else{
                        if ($TipoUsuario == "Profesor"){
                            $query  = "Insert into Profesor (idProfesor,Nombre,ApPaterno,ApMaterno,Email,Contrasena,TipoUsuario) values ('".$clave."','".$nombre."','".$apellidoPaterno."','".$apellidoMaterno."','".$correo."',md5('".$contrasena."'),'".$TipoUsuario."')";
                        }else{
                            $query  = "Insert into Estudiante (Matricula,Nom,Paterno,Materno,CorreoElectronico,Password,TipoUsuario) values ('".$clave."','".$nombre."','".$apellidoPaterno."','".$apellidoMaterno."','".$correo."',md5('".$contrasena."'),'".$TipoUsuario."')";
                        } 
                    }
                    //si es exitoso o no se mandan un mensaje.
                    if($conn->query($query) === TRUE){
                        $_SESSION['status'] = "Registrado con éxito.";
                        header("Location: ../Registrarse.php");
                    }else{
                        $_SESSION['status'] = "Hubo un error al registrar.";
                        header("Location: ../Registrarse.php");
                    }
                }
            }
        }
    }else{
        $_SESSION['status'] = "Clave del administrador incorrecta.";
        header("Location: ../Registrarse.php"); //Se manda un mensaje de la clave incorrecta.
    }
    mysqli_close($conn);//Se cierra la conexión.
?>
