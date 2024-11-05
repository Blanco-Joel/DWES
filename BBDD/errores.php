<?php
    function error_function($error_level, $error_message, $error_file, $error_line, $error_context){
        echo "<hr>";
        echo "Mensaje de error: $error_message <br>";
        echo "Línea: $error_line <br>";
        echo "<hr>";
    }
?>
