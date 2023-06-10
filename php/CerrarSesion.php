<?php
    session_start();//Se inicia la sesión.
    session_unset();//Se elimina.
    session_destroy();//Se destruye la variable.
    header("Location: ../InicioSesion.php");//Se dirige al inicio de sesión.
    die();
?>