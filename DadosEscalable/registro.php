<?php //LÓGICA---------------------------------------------------------------------------------------------------------------------
    function guardartxt($nombre,$ape)
    {
        $archivo = fopen("./datos.txt","a");
        $linea = $nombre. "," . $ape . ";";
        fwrite($archivo,$linea);
        fclose($archivo);
    }

?>


<?php //EXCEPCIONES----------------------------------------------------------------------------------------------------------------
    
    /*Tratamiento de excepciones recibiendo los datos introducidos por el usuario. En caso de fallo
    mata el programa  */
    function erroresDatos($nombre, $ape)
    {
        $valido = true;
        if (empty($nombre) ) {
            trigger_error("Por favor, introduzca un nombre. ");
            $valido = false;
        }
        if (empty($ape) ) {
            trigger_error("Por favor, introduzca un apellido. ");
            $valido = false;
        }

        if (!$valido) 
            die;
        
    }
?>


<?php //RECOGIDA DE DATOS DE USUARIO-----------------------------------------------------------------------------------------------
    
    /*Inicio del programa recogiendo y limpiando los datos introducidos por el usuario. Devuelve 
    todos los datos en un array. */
    function recogerDatos ()
    {   
        $nombre = limpiar($_POST["nombre"]);
        $ape = limpiar($_POST["ape"]);

        erroresDatos($nombre,$ape);
        $datos = array();
        array_push($datos,$nombre);
        array_push($datos,$ape);

        
        return $datos;

    }

?>


<?php //LIMPIEZA-------------------------------------------------------------------------------------------------------------------
    
    /*Recibe una String y la limpia los datos introducidos por el usuario. Devuelve el mismo dato
    limpio.*/
    function limpiar($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    /*Recibe los dos arrays de datos y elimina los que estén vacios. No devuelve nada.
    function limpiezaArray(&$arrayJuego,&$datosJuego)
    {
        foreach ($arrayJuego as $jugador => &$dados) {
            if (empty($jugador)) {
                unset($arrayJuego[$jugador]);
                unset($datosJuego[$jugador]);
            }
        }

    }*/

?>
