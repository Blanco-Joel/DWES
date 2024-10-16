<?php //LÓGICA------------------------------------------------------------------------------------------
    function leerIbex ()
    {
        $archivo = fopen('./ibex35.txt','r') or die("No se encuentra el fichero");
        $linea = fgets($archivo);
        while ($linea != "") {
            imprimirLinea($linea);
            $linea = fgets($archivo);
        }
    }
    ?>
<?php //IMPRESIONES-------------------------------------------------------------------------------------
    function imprimirLinea($linea) 
    {
        echo "<p>" . $linea . "</p>";
    }
?>