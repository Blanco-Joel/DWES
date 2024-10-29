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
    include "registro.php"; 
?>
<BODY>

<form name='juegodados' action= <?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?> method='POST'>

<div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header"><B>JUEGO DADOS</B> </div>
		<div class="card-body">



 
<B>Nombre: </B><input type='text' name='nombre' value='' size=25><br><br> 
<B>Apellido: </B><input type='text' name='ape' value='' size=25><br><br> 
 
<B>Pulsa para Registrarte: 

<div>

	<input type="submit" value="registrarme" name="registrarme" class="btn btn-warning disabled">
		
			
		
</div>	






</FORM>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST")  
    {
        $datos = recogerDatos();	
        guardartxt($datos[0],$datos[1]);
    }
?>

</BODY>

</HTML>