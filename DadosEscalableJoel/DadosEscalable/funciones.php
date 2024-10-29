

<?php //LÓGICA---------------------------------------------------------------------------------------------------------------------
    
    function crearArrays($datos)
    {
        $arrayJuego = array();
        $arrayDatos = array();
        $todosDatos = array();
        foreach ($datos as $nombre ) {
            $arrayJuego[$nombre] = array();
            $arrayDatos[$nombre] = 0;
        }
        array_push($todosDatos,$arrayJuego);
        array_push($todosDatos,$arrayDatos);
        return $todosDatos;
    }

    /*Recibe los arrays con los nombres de los jugadores y el número de dados que se ha introducido e 
    inicializa los dados en el $arrayJuego, no devuelve nada  */
    function iniciarJuego(&$arrayJuego, $numDados,&$datosJuego)
    {
        foreach ($arrayJuego as $jugador => &$dados) {
            for ($i=0; $i < $numDados; $i++) 
                array_push($dados, rand(1,6));   
        }
        limpiezaArray($arrayJuego,$datosJuego);
    }

    /*Recibe los arrays con los dados de los jugadores y el número de dados que se ha introducido y 
    cuenta el resultado de cada jugador para guardarlo en $datosJuego. También llama a la función 
    que comprueba los dados iguales en caso de haber más de 2 dados. Devuelve el array con las pun-
    tuaciones de cada jugador */
    function conteoJugador($arrayJuego,$datosJuego,$numDados)
    {
        foreach ($arrayJuego as $jugador => $dados) 
            for ($i=0; $i < count($dados); $i++) 
                $datosJuego[$jugador] += $dados[$i];
        if ($numDados > 2)
            $datosJuego = iguales($arrayJuego,$datosJuego);
        
        return $datosJuego;
    }

    /*Recibe los datos de los dados de cada jugador y el resultado final para modificarlo en caso de
    que los dados sean iguales. Devuelve el array con las puntuaciones de cada jugador*/
    function iguales($arrayJuego,$datosJuego)
    {
        $media = 0.0;
        $cont = 0;
        foreach ($datosJuego as $jugador => $dados) {
            $media = doubleval($datosJuego[$jugador]/count($arrayJuego[$jugador]));
            $cont = 0;
            for ($i=0; $i < count($arrayJuego[$jugador]); $i++) 
                if ($media == doubleval(($arrayJuego[$jugador][$i]) )) 
                    $cont +=1;
            
            if ($cont == count($arrayJuego[$jugador]) ) 
                $datosJuego[$jugador] = 100;

        }
        return $datosJuego;
    }
    
    /*Recibe los datos de los dados de cada jugador y el resultado final para saber cual es el gana-
    dor de la partida e imprmirlo. No devuelve nada. */
    function saberGanador($arrayJuego,$datosJuego)
    {
        $numGanador = max($datosJuego);
        $ganadores = array();
        $conteoGanadores = 0;
        foreach ($datosJuego as $jugador => $dados)
            if ($dados == $numGanador) {
                array_push($ganadores,$jugador);
                imprimirGanador($jugador);
                $conteoGanadores += 1;
            }
        return $conteoGanadores;
    }

?>


<?php //EXCEPCIONES----------------------------------------------------------------------------------------------------------------
    
    /*Tratamiento de excepciones recibiendo los datos introducidos por el usuario. En caso de fallo
    mata el programa  */
    function erroresDatos($arrayJuego)
    {
        $valido = true;
        if (count($arrayJuego) < 3) {
            trigger_error("Han de ser minimo 2 jugadores.");
            $valido = false;
        }
        if (!$valido) 
            die;
        
    }
    function erroresDados($numDados)
    {
        $valido = true;

        if ($numDados < 1 || $numDados > 10) {
            trigger_error("El número de dados ha de estar entre 1 y 10.");
            $valido = false;
        }

        if (!$valido) 
            die;
    
    }

?>


<?php //RECOGIDA DE DATOS DE USUARIO-----------------------------------------------------------------------------------------------
    
    /*Inicio del programa recogiendo y limpiando los datos del fichero. Devuelve 
    todos los datos en un array. */
    function recogerDatos ()
    {   
        $datos = explode(";",file_get_contents("./datos.txt"));
        erroresDatos($datos);
       
        return $datos;

    }
    /*Inicio del programa recogiendo y limpiando los datos introducidos por el usuario. Devuelve 
    todos los datos en un array. */
    function recogerDados()
    {
        $numDados = limpiar($_POST["numdados"]);
        erroresDados($numDados);

        return $numDados;
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

    /*Recibe los dos arrays de datos y elimina los que estén vacios. No devuelve nada.*/
    function limpiezaArray(&$arrayJuego,&$datosJuego)
    {
        foreach ($arrayJuego as $jugador => &$dados) {
            if (empty($jugador)) {
                unset($arrayJuego[$jugador]);
                unset($datosJuego[$jugador]);
            }
        }

    }

?>


<?php //IMPRESIÓN------------------------------------------------------------------------------------------------------------------
    
    /*Recibe el nombre, los dados y la puntuación y la imprime por patalla jugador por jugador
    sus dados, su nombre y su puntuación. */
    function imprimirJugadores($jugador,$dados, $puntuacion)
    {
        echo "<hr>". $jugador. " DADOS =";
        for ($i=0; $i < count($dados); $i++) 
            echo "<img src=\"images/".($dados[$i].".PNG") ."\" width=\"50\" heigth=\"42\" style=\"visibility:visible;padding:1vw;\" />";
        echo "<br>" .$jugador. " Puntos =". $puntuacion;
        echo "<br>";
    }

    /*Recibe el nombre y la puntuación y la imprime por patalla el ganador. */
    function imprimirGanador($jugador)
    {
        echo "<hr><hr>Ganador " . $jugador. "<br>";
    }

    /*Recibe el total de ganadores y los imprime por pantalla. */
    function  imprimirNumGanadores($conteoGanadores)
    {
        echo "<hr><hr>TOTAL DE GANADORES : " . $conteoGanadores;
    }

?>

