<?php //LÓGICA------------------------------------------------------------------------------------------
    function leerIbex ()
    {
        $archivo = fopen('ibex35.txt','r') or die("No se encuentra el fichero");
        $linea = fgets($archivo);
        while ($linea != "") {
            imprimirLinea($linea);
            $linea = fgets($archivo);
        }
        fclose($archivo);
    } 

    function buscarValor($valor)
    {
        $archivo = fopen('ibex35.txt','r') or die("No se encuentra el fichero");
        $linea = fgets($archivo);
        imprimirLinea($linea);
        while ($linea[0] != "") {
            $linea = explode(" ",$linea);
            if ($linea[0] == $valor) 
            imprimirLinea(implode(" ",$linea));
            $linea = fgets($archivo);
        }
        fclose($archivo);
    }

    function buscarValorCot($valor)
    {
        $archivo = fopen('ibex35.txt','r') or die("No se encuentra el fichero");
        $linea = fgets($archivo);
        $lineaLey = explode(" ",$linea);

        while ($linea[0] != "") {
            $linea = explode(" ",$linea);
            if ($linea[0] == $valor) 
                
            $linea = fgets($archivo);
        }
        fclose($archivo);
    }


?>
<?php //CREAR OPTIONS-----------------------------------------------------------------------------------
    function crearDesplegable()
    {
        $archivo = fopen('ibex35.txt','r') or die("No se encuentra el fichero");
        $linea = fgets($archivo);
        $linea = explode(" ",$linea);
        imprimirInicioDesplegable();
        while ($linea[0] != "") {
            imprimirCuerpoDesplegable($linea[0]);
            $linea = fgets($archivo);
            $linea = explode(" ",$linea);
        }
        imprimirFinalDesplegable();
    }
?>
<?php //LECTURA DATOS-----------------------------------------------------------------------------------
    function recogerDatos ($llamada)
    {   
        $valor = limpiar($_POST["valor"]);
        $llamada = explode("/",$llamada);
        $llamada[3] == "bolsa2.php" ? buscarValor($valor) : buscarValorCot($valor);
    }
    
    function limpiar($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
 
?>

<?php //IMPRESIONES-------------------------------------------------------------------------------------
    function imprimirLinea($linea) 
    {
        echo "<p>" . $linea . "</p>";
    }
    function imprimirInicioDesplegable()
    {
        echo "<select name=\"valor\">";
    }
    function imprimirCuerpoDesplegable($dato)
    {
        echo "<option value=\"" . $dato . "\">". $dato ."</option>";
    }
    function imprimirFinalDesplegable()
    {
        echo "</select>";
    }

?>