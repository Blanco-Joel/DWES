<?php
    function error_function($error_level, $error_message, $error_file, $error_line, $error_context){
        echo "<hr>";
        echo "Mensaje de error: $error_message <br>";
        echo "Línea: $error_line <br>";
        echo "<hr>";
    }
    ?>

<?php //EXCEPCIONES----------------------------------------------------------------------------------------------------------------
    
    /*Tratamiento de excepciones recibiendo los datos introducidos por el usuario. En caso de fallo
    mata el programa  */
    function erroresDatos($nombre,$campo)
    {
        if (empty($nombre)) {
            trigger_error("Introduzca un $campo.");
            muerte();
        }

    }
    function errorLogin()
    {
        trigger_error("Fallo de identificación.");
        muerte();
    }
    function errorAsientos($vuelo,$asientos)
    {
        trigger_error("El vuelo con identificador ".$vuelo . " no tiene " .$asientos ." asientos disponibles.<br> Vacie la cesta y vuelva a alquilar un número de asientos disponible. ");
        muerte();
    }

    /*Mata el programa.  */
    function muerte()
    {
        die;
    }

?>

