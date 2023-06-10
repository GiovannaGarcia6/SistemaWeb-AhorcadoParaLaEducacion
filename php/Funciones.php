<?php
    //Función que genera un código alfanúmerico,
    //el cual es utilizado para los códigos de las partidas.
    //Recibe una variable llamada length de un tamaño de 10.
    function generarCodigo($length = 10) {
        //Se definen todos los carateres con los que se puede formar le código.
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        //obtenemos el número de caracteres que forman la cadena completa
        $charactersLength = strlen($characters);
        //se declara una variable que sera la encargada de almacenar el código.
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            //se crea el código con una longitud de 10.
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString; //Se retorna.
    } 

    //Función que obtiene la fecha
    //no recibe ningún parametro
    function obtenerFechaActual(){
        //date es una funcionalidad que devuelve formateada la fecha local del sistema 
        //para obtener el día, mes y año actual.
        return $fechaActual = date('Y-m-d');
    }
?>
