<?php
/* Nombre Alumno:   JOEL BLANCO OTERO                    */
?>


<?php //LÓGICA---------------------------------------------------------------------------------------------------------------------
  
  
  /*recibe el array de puntos y de  las cartas, las apuestas  y el numero de cartas ,llama a todas las funciones del programa*/
  function juegoCompleto(&$arrayJuego, $numCartas,&$datosJuego,$apuesta)
    {
        $arrayCartas =  array("1B","1C","1E","1O",
                              "2B","2C","2E","2O",
                              "3B","3C","3E","3O",
                              "4B","4C","4E","4O",
                              "5B","5C","5E","5O",
                              "6B","6C","6E","6O",
                              "7B","7C","7E","7O",
                              "CB","CC","CE","CO",
                              "RB","RC","RE","RO",
                              "SB","SC","SE","SO");
        shuffle($arrayCartas);
        foreach ($arrayJuego as $jugador => &$cartas){ 
          for ($i=0; $i < $numCartas; $i++) { 
            array_push($cartas,$arrayCartas[0]);
            array_shift($arrayCartas);
          }
        }


        foreach ($arrayJuego as $jugador => &$cartas)
          imprimirJugadores($jugador,$cartas);

        $datosJuego = conteoJugador($arrayJuego,$datosJuego,$numCartas);
        foreach ($datosJuego as $jugador => $puntos) 
          imprimirPuntos($jugador,$puntos);
        
        
        $ganadores = saberGanador($arrayJuego,$datosJuego);
        if(!empty($ganadores))
          $divisionApuesta = $apuesta / count($ganadores);
        logicaImpresionGanad($ganadores, $apuesta,$arrayJuego);
        foreach ($datosJuego as $jugador => $puntos) 
        {
            if(!empty($ganadores[$jugador]))
              guardarTxt($jugador,$puntos,$ganadores[$jugador],$divisionApuesta);
            else
              guardarTxt($jugador,$puntos,"",$divisionApuesta);
        }
    }

    /*recibe el array de puntos vacio y las cartas, saca las puntucaiones y devuelvearray de puntos    */

    function conteoJugador($arrayJuego,$datosJuego,$numCartas)
    {
        foreach ($arrayJuego as $jugador => $cartas) 

            for ($i=0; $i < count($cartas); $i++) 
              if (floatval(substr($cartas[$i],0,1)) == 0) 
                  $datosJuego[$jugador] += 0.5;
              else
                  $datosJuego[$jugador] += substr($cartas[$i],0,1);

        return $datosJuego;
    }
    
    /*recibe el array de puntos y las cartas, comprueba las puntucaiones y devuelve array de ganadores   */
    function saberGanador($arrayJuego,$datosJuego)
    {
        $conteoGanadores = 0;
        $puntosAux = 0;
        $ganadores = array();
        foreach ($datosJuego as $jugador => $puntos)
          if($puntos == 7.5)
          {
            $ganadores[$jugador] = $puntos;
            $puntosAux = 7.5;
          }elseif ($puntos < 7.5 ) 
          {
            $puntosAux = $puntosAux < $puntos ? $puntos : $puntosAux;
            $posiblesGanadores[$jugador] = $puntos;
          } 
          if ($puntosAux > 0 && $puntosAux < 7.5 )
            foreach ($posiblesGanadores as $jugador => $puntos)
              if ($puntosAux == $puntos) 
                $ganadores[$jugador] = $puntos;
          return $ganadores;
    }
        /*recibe los ganadores, la apuesta y los comprueba el numero de ganadores llama a las funciones de impresion de ganadores   */
    function logicaImpresionGanad($ganadores,$apuesta)
    {
      if(!empty($ganadores))
      {
        imprimirInicioGanadores();
        $divisionApuesta = $apuesta / count($ganadores);
        foreach ($ganadores as $ganador => $puntos) 
          imprimirGanador($ganador,$divisionApuesta);
      }else
        imprimirBote($apuesta);
    }

    function guardarTxt($jugador,$puntos,$ganador,$apuesta)
    {
        $fila = ""; 
        $fila .= $jugador ."***";
        $fila .= $puntos ."***";
        if(!empty($ganador))
          $fila .= $apuesta . "\n";
        else
          $fila .= 0 . "\n";
        $archivo = fopen("exam.txt", "a") or die("No existe el fichero"); 
        fwrite($archivo,$fila);
        fclose($archivo); 
    }



?>


<?php //EXCEPCIONES----------------------------------------------------------------------------------------------------------------

    
    /*Tratamiento de excepciones recibiendo los datos introducidos por el usuario. En caso de fallo
    mata el programa  */
    function erroresDatos($arrayJuego)
    {
        $valido = true;
        if (count($arrayJuego) < 2) {
            trigger_error("Han de ser minimo 2 jugadores.");
            $valido = false;
        }
        if (!$valido) 
            die;
        
    }
        /*Tratamiento de excepciones recibiendo las cartas introducidas por el usuario. En caso de fallo
    mata el programa  */
    function errorescartas($numCartas)
    {
        $valido = true;

        if ($numCartas < 1 || $numCartas > 10) {
            trigger_error("El número de cartas ha de estar entre 1 y 10.");
            $valido = false;
        }

        if (!$valido) 
            die;
    
    }
        /*Tratamiento de excepciones recibiendo la apuesta introducida  por el usuario. En caso de fallo
    mata el programa  */
    function erroresApuesta($apuesta)
    {
        $valido = true;

        if ($apuesta <= 0) {
            trigger_error("La apuesta tiene que ser positiva.");
            $valido = false;
        }

        if (!$valido) 
            die;
    
    }

?>


<?php //RECOGIDA DE DATOS DE USUARIO-----------------------------------------------------------------------------------------------
   
   
   // Regoge los datos introducidos por el usuario  y los envia al trato de excepciones y a la funcion del juego.
    function recogerDatos ()
    {   
        $i = 1;
        $nombre = "nombre";
        $arrayJuego = array();
        
        while (!empty($_POST[$nombre.$i])) {
          $arrayJuego[limpiar($_POST[$nombre.$i])] = array();
          $datosJuego[limpiar($_POST[$nombre.$i])] = 0;
          $i +=1;
        }

        $numCartas= limpiar($_POST["numcartas"]);
        $apuesta= limpiar($_POST["apuesta"]);


        erroresDatos($arrayJuego,$numCartas);
        errorescartas($numCartas);
        erroresApuesta($apuesta);

        juegoCompleto($arrayJuego, $numCartas,$datosJuego,$apuesta);
    }

?>


<?php //LIMPIEZA-------------------------------------------------------------------------------------------------------------------
    function limpiar($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

?>

<?php //ERRORES ------------------------------------------------------------------------------------------------------------------
    function error_function($error_level, $error_message, $error_file, $error_line, $error_context){
        echo "<hr>";
        echo "Mensaje de error: $error_message <br>";
        echo "<hr>";
    }
?>



<?php // IMPRESION ----------------------------------------------------------------------------------------------------------------
  function imprimirJugadores($jugador,&$cartas)
  { 
      echo $jugador. " CARTAS =";
      for ($i=0; $i < count($cartas); $i++) 
          echo "<img src=\"images/".($cartas[$i].".PNG") ."\" width=\"50\" heigth=\"42\" style=\"visibility:visible;padding:1vw;\" />";
      echo "<br>";
  }
  function imprimirPuntos($jugador,$puntos)
  {
    echo $jugador . " Puntos  : " . $puntos ;
    echo "<br>";
  }

  function imprimirInicioGanadores()
  {
    echo "<br>";
    echo " GANADORES Y PREMIOS .";
    echo "<br>";
  }
  function imprimirGanador($ganador,$apuesta)
  {
    echo $ganador. " GANADO  : " . $apuesta;
    echo "<br>";
  } 
  function imprimirBote($apuesta)
  {
    echo "NO HA GANADO NADIE, LO APOSTADO SE SUMA AL BOTE : " . $apuesta;
  }
?>

<?php //INICIO DEL JUEGO 
      recogerDatos();
?>