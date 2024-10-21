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
    function sacarTotales($total)
    {
        $archivo = fopen('ibex35.txt','r') or die("No se encuentra el fichero");
        $linea = fgets($archivo);
        
        $suma = 0;
        while ($linea[0] != "") {
            $linea = separarCampos($linea);
            $suma += intval(str_replace(".","",$linea[$total]));
            $linea = fgets($archivo);
        }
        $total = ($total == 7) ? "Total Volumen" : "Total Capitalizacion";
        imprimirTotal($suma,$total);
        fclose($archivo);
    }

    function maximoMinimo()
    {
        $archivo = fopen('ibex35.txt','r') or die("No se encuentra el fichero");
        $linea = fgets($archivo);
        $linea = fgets($archivo);

        $cotizacion = array();
        $volumen = array();
        $capitalizacion = array();
        while ($linea[0] != "") {
            $linea = separarCampos($linea);
            array_push($cotizacion,doubleval(str_replace(",",".",$linea[1])));
            array_push($volumen,intval(str_replace(".","",$linea[7])));
            array_push($capitalizacion,intval(str_replace(".","",$linea[8])));
            $linea = fgets($archivo);
        }
        sacarMaxMin($cotizacion,$volumen,$capitalizacion);
    }

    function sacarMaxMin($cotizacion,$volumen,$capitalizacion)
    {
        $archivo = fopen('ibex35.txt','r') or die("No se encuentra el fichero");
        $linea = fgets($archivo);
        $linea = fgets($archivo);
        while ($linea[0] != "") {
            $linea = separarCampos($linea);
            if (doubleval(str_replace(",",".",$linea[1])) == min($cotizacion)) 
                imprimirMinMax($linea[0],min($cotizacion),"cotización Minima");
            if (doubleval(str_replace(",",".",$linea[1])) == max($cotizacion)) 
                imprimirMinMax($linea[0],max($cotizacion),"cotización Máxima");
            if (intval(str_replace(".","",$linea[7])) == min($volumen)) 
                imprimirMinMax($linea[0],min($volumen),"volumen Minima");
            if (intval(str_replace(".","",$linea[7])) == max($volumen)) 
                imprimirMinMax($linea[0],max($volumen),"volumen Máximo");
            if (intval(str_replace(".","",$linea[8])) == min($capitalizacion)) 
                imprimirMinMax($linea[0],min($capitalizacion),"capitalización Minima");
            if (intval(str_replace(".","",$linea[8])) == max($capitalizacion)) 
                imprimirMinMax($linea[0],max($capitalizacion),"capitalización Máxima");
            $linea = fgets($archivo);
        }
        
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

    function recogerDatosTotales()
    {   
        $total = limpiar($_POST["Totales"]);
        sacarTotales(intval($total));
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
    function imprimirIndice($nombre, $valor,$nombreCampo)
    {
        echo "<p>" . $nombreCampo . " de " . $nombre . " : " . $valor. "</p>";
    }
    function imprimirTotal($suma,$total) 
    {
        echo "<p>" .$total. ": " . $suma . "</p>";
    }
    function imprimirMinMax($nombre,$valor,$mensaje)
    {
        echo "<p>" . $mensaje . " : " . $nombre . "| valor : " . $valor . "</p>";
    }
?>