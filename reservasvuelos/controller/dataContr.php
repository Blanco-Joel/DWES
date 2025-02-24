<?php //RECOGIDA DE DATOS DE USUARIO-----------------------------------------------------------------------------------------------
    
    /*Inicio del programa recogiendo y limpiando el dato introducido. Devuelve 
    el dato . */
    function recogerDatos($campo)
    {   
        $dato = limpiar($_POST["$campo"]);
        return $dato;
    }
    function recogerDatosFecha($campo)
    {   
        return limpiar($_POST["$campo"]);
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

?>
