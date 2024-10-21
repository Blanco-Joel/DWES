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

    function buscarValorCot($valor,$indice)
    {
        $archivo = fopen('ibex35.txt','r') or die("No se encuentra el fichero");
        $lineaIndice = fgets($archivo);
        $lineaIndice = separarCampos($lineaIndice);
        $i = 0;
        $campoSelec = 0;
        while ($i < count($lineaIndice)) {
            if ($lineaIndice[$i] == $indice) 
                $campoSelec = $i;
            $i += 1;
        }
        $linea = fgets($archivo);
        $linea = separarCampos($linea);
        while ($linea[0] != "") {
            if ($linea[0] == $valor) 
                imprimirIndice($linea[0],$linea[$campoSelec],$lineaIndice[$campoSelec]);
            $linea = fgets($archivo);
            $linea = separarCampos($linea);
        }
        fclose($archivo);
    }

    function separarCampos($linea)
    {
        $campo = array();
        $campo[0] = limpiar(substr($linea,0,23));
        $campo[1] = limpiar(substr($linea,23,9));
        $campo[2] = limpiar(substr($linea,32,8));
        $campo[3] = limpiar(substr($linea,40,8));
        $campo[4] = limpiar(substr($linea,48,12));
        $campo[5] = limpiar(substr($linea,60,9));
        $campo[6] = limpiar(substr($linea,69,9));
        $campo[7] = limpiar(substr($linea,78,13));
        $campo[8] = limpiar(substr($linea,91,9));
        $campo[9] = limpiar(substr($linea,100,5));
        return $campo;
    }

?>
<?php //CREAR OPTIONS-----------------------------------------------------------------------------------

    function crearDesplegable()
    {
        $archivo = fopen('ibex35.txt','r') or die("No se encuentra el fichero");
        $linea = fgets($archivo);
        $linea = separarCampos($linea);
        imprimirInicioDesplegable("valor");
        while ($linea[0] != "") {
            imprimirCuerpoDesplegable($linea[0]);
            $linea = fgets($archivo);
            $linea = separarCampos($linea);
        }
        imprimirFinalDesplegable();
    }

    function crearDesplegableIndice()
    {
        $archivo = fopen('ibex35.txt','r') or die("No se encuentra el fichero");
        $linea = fgets($archivo);
        $linea = separarCampos($linea);
        imprimirInicioDesplegable("indice");
        foreach ($linea as $i => $campo)
            if ($i != 0) 
                imprimirCuerpoDesplegable($campo);
           
        imprimirFinalDesplegable();
    }


?>
<?php //LECTURA DATOS-----------------------------------------------------------------------------------
    function recogerDatos ($llamada)
    {   
        $valor = limpiar($_POST["valor"]);
        $indice = limpiar($_POST["indice"]);
        $llamada = explode("/",$llamada);
        $llamada[3] == "bolsa2.php" ? buscarValor($valor) : buscarValorCot($valor,$indice);
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
    function imprimiriNDICE($nombre, $valor,$nombreCampo)
    {
        echo "<p>" . $nombreCampo . " de " . $nombre . " : " . $valor. "</p>";
    }
?>