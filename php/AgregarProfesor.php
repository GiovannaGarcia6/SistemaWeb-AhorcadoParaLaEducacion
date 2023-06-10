<?php 
    //Insertamos código de otro archivo el cual contiene la conexión de la BD.
    require 'ConexionBD.php';
    session_start();//Se inicia la sesión.
    //Se obtienen todos los datos que se mandaron al formulario.
    $clave = $_POST['clave'];
    $nombre = $_POST['nombre'];
    $apellidoPaterno = $_POST['apellidoPaterno'];
    $apellidoMaterno = $_POST['apellidoMaterno'];
    $correo = $_POST['correo'];
    $contrasena=$_POST['contraseña'];
    $TipoUsuario = "Profesor";
    //Se realiza un conteo de cuantos administradores tiene la misma clave.
    $sql  = "Select count(*) as contar from administrador where idAdministrador = '".$clave."'";
    $consulta =  mysqli_query($conn, $sql);
    $array = mysqli_fetch_array($consulta);
    //Si es mayor a cero significa que la clave ya existe y debe redirigirse a la página de registrar.
    if($array['contar'] > 0 ){
        $_SESSION['status'] = "El usuario ya existe.";
        header("Location: ../Gestión%20del%20Profesor/RegistrarProfesor.php");
        exit();
    }else{
        //Se realiza un conteo de cuantos profesores tiene la misma clave.
        $sql  = "Select count(*) as contar from profesor where idProfesor = '".$clave."'";
        $consulta =  mysqli_query($conn, $sql);
        $array = mysqli_fetch_array($consulta);
        //Si es mayor a cero significa que la clave ya existe y debe redirigirse a la página de registrar.
        if($array['contar'] > 0 ){
            $_SESSION['status'] = "El usuario ya existe.";
            header("Location: ../Gestión%20del%20Profesor/RegistrarProfesor.php");
            exit();
        }else{
            //Se realiza un conteo de cuantos estudiantes tiene la misma clave.
            $sql  = "Select count(*) as contar from estudiante where matricula = '".$clave."'";
            $consulta =  mysqli_query($conn, $sql);
            $array = mysqli_fetch_array($consulta);
            //Si es mayor a cero significa que la clave ya existe y debe redirigirse a la página de registrar.
            if($array['contar'] > 0 ){
                $_SESSION['status'] = "El usuario ya existe.";
                header("Location: ../Gestión%20del%20Profesor/RegistrarProfesor.php");                exit();
            }else{
                //Query que realiza la inserción de los datos cuando todos son correctos.
                $query  = "Insert into Profesor (idProfesor,Nombre,ApPaterno,ApMaterno,Email,Contrasena,TipoUsuario) values ('".$clave."','".$nombre."','".$apellidoPaterno."','".$apellidoMaterno."','".$correo."',md5('".$contrasena."'),'".$TipoUsuario."')";
                //Si el query se ejecuta correctamente se muestra un mensaje de éxito.
                if($conn->query($query) === TRUE){
                    $_SESSION['status'] = "Registrado con éxito.";
                    header("Location: ../Gestión%20del%20Profesor/RegistrarProfesor.php");
                }else{
                    //Se manda el mensaje de error y se redirigirse a la página de registrar.
                    $_SESSION['status'] = "Hubo un error al registrar.";
                    header("Location: ../Gestión%20del%20Profesor/RegistrarProfesor.php");
                }
            }
        }
    }
    mysqli_close($conn);//Se cierra la conexión
?>
