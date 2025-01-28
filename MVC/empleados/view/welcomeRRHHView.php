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
    <h1>Portal de Recursos Humanos</h1> 

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Menú RRHH - OPERACIONES </div>
		<div class="card-body">


		<B>Bienvenido/a: </B> <?php echo $_COOKIE["NAME"]  ?>   <BR><BR>
		<B>Identificador Empleado: </B> <?php echo $_COOKIE["USERPASS"]  ?>  <BR><BR>
	 
		
       <!--Formulario con botones -->
	
		<input type="button" value="Alta de empleado" onclick="window.location.href='altaEmplContr.php'" class="btn btn-warning disabled">
		<input type="button" value="Alta masiva de empleados" onclick="window.location.href='altaEmplMasContr.php'" class="btn btn-warning disabled"><br><br>
		<input type="button" value="Modificar salario" onclick="window.location.href='modifSalarContr.php'" class="btn btn-warning disabled">
		<input type="button" value="Vida laboral" onclick="window.location.href='vidaLaboralContr.php'" class="btn btn-warning disabled">
		<input type="button" value="Info del departamento" onclick="window.location.href='infoDptContr.php'" class="btn btn-warning disabled"><br><br>
		<input type="button" value="Cambio de departamento" onclick="window.location.href='cambioDptContr.php'" class="btn btn-warning disabled">
		<input type="button" value="Cambio de jefe de departamento" onclick="window.location.href='devolverContr.php'" class="btn btn-warning disabled"><br><br>
		<input type="button" value="Baja de empleado" onclick="window.location.href='devolverContr.php'" class="btn btn-warning disabled">
		<input type="button" value="Mi nómina" onclick="window.location.href='devolverContr.php'" class="btn btn-warning disabled">
		<input type="button" value="Historial laboral" onclick="window.location.href='devolverContr.php'" class="btn btn-warning disabled">
	</br></br>
		
		
		
		<BR><a href="../controller/logoutContr.php">Cerrar Sesión</a>
		</div>  
	  
	     </body>
   
</html>


