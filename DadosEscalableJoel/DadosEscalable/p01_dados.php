<HTML>

<HEAD> 
 <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>JUEGO DADOS - PRÁCTICA OBLIGATORIA</title>
    <link rel="stylesheet" href="./bootstrap.min.css">
  </head>

</HEAD>
<?php //INCLUSIÓN DE ERRORES-------------------------------------------------------------------------------------------------------
    include "errores.php";
    set_error_handler("error_function");
?>
<?php //INCLUSIÓN DE FUNCIONES-----------------------------------------------------------------------------------------------------
    include "funciones.php"; 
?>
<BODY>

<form name='juegodados' action= <?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?> method='POST'>

<div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header"><B>JUEGO DADOS</B> </div>
		<div class="card-body">
 
<B>Numero Dados: <input type='text' name='numdados' value='' size=5><br><br>


<B>Pulsa para Tirar Dados: 

<div>

	<input type="submit" value="Tirar Dados" name="tirar" class="btn btn-warning disabled">
		
			
		
</div>	






</FORM>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST")  
    {
        $datos    = recogerDatos();	
        $numDados = recogerDados();
        $todosDatos = crearArrays($datos);
        $arrayJuego = $todosDatos[0];
        $datosJuego = $todosDatos[1];
        iniciarJuego($arrayJuego,$numDados,$datosJuego);
        $datosJuego = conteoJugador($arrayJuego,$datosJuego,$numDados);
        foreach ($arrayJuego as $jugador => $dados) 
            imprimirJugadores($jugador,$dados,$datosJuego[$jugador]);

        $conteoGanadores = saberGanador($arrayJuego,$datosJuego);
        imprimirNumGanadores($conteoGanadores);

    }
?>

</BODY>

</HTML>