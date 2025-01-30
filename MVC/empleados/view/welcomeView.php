<?php
require_once ("../controller/dataContr.php");
require_once ("../controller/cookieContr.php");
?>
<html>
   
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Bienvenido al Portal del Empleado</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
 </head>
   
 <body>
    <h1>Portal del Empleado</h1> 

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Menú Empleado - OPERACIONES </div>
		<div class="card-body">


		<B>Bienvenido/a: </B> <?php echo $_COOKIE["NAME"]  ?>   <BR><BR>
		<B>Identificador Empleado: </B> <?php echo $_COOKIE["USERPASS"]  ?>  <BR><BR>
	 
		
       <!--Formulario con botones -->
	
		<input type="button" value="Mi nómina" onclick="window.location.href='nominaContr.php'" class="btn btn-warning disabled">
		<input type="button" value="Historial laboral" onclick="window.location.href='histLaboralContr.php'" class="btn btn-warning disabled">
	</br></br>
		
		
		
		<BR><a href="../controller/logoutContr.php">Cerrar Sesión</a>
		</div>  
	  
	     </body>
   
</html>


