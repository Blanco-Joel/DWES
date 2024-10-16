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
        $lineaNueva = array();
        while ($linea[0] != "") {
            $linea = explode(" " , $linea);
            if ($linea[0] == $valor) {
                foreach ($linea as $campo) 
                    if ($campo != '') 
                        array_push($lineaNueva, $campo);
                imprimirCotizaciones($lineaNueva[0],$lineaNueva[1],$lineaNueva[5], $lineaNueva[6]);
            }
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
        $linea = explode('/chr(32).chr(32)/',$linea);
        imprimirInicioDesplegable("valor");
        while ($linea[0] != "") {
            imprimirCuerpoDesplegable($linea[0]);
            $linea = fgets($archivo);
            $linea = explode(" ",$linea);
        }
        imprimirFinalDesplegable();
    }

    function crearDesplegableIndice()
    {
        $archivo = fopen('ibex35.txt','r') or die("No se encuentra el fichero");
        $linea = fgets($archivo);
        $linea = explode('/chr(32).chr(32)/',$linea);
        imprimirInicioDesplegable("indice");
        foreach ($linea as $campo) 
            if ($campo != '') 
                imprimirCuerpoDesplegable($campo);
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

    function imprimirInicioDesplegable($name)
    {
        echo "<select name=\"" . $name . "\">";
    }

    function imprimirCuerpoDesplegable($dato)
    {
        echo "<option value=\"" . $dato . "\">". $dato ."</option>";
    }
    
    function imprimirFinalDesplegable()
    {
        echo "</select>";
    }
    function imprimirCotizaciones($nombre, $valor, $max, $min)
    {
        echo "<p> Cotizacion Actual de " . $nombre . " : " . $valor. "</p>";
        echo "<p> Cotizacion mínima de " . $nombre . " : " . $min. "</p>";
        echo "<p> Cotizacion máxima de " . $nombre . " : " . $max. "</p>";
    }

?>