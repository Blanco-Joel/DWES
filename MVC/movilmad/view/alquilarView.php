<html>
   
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Bienvenido a MovilMAD</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
 </head>
   
 <body>
    <h1>Servicio de ALQUILER DE E-CARS</h1> 

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Menú Usuario - ALQUILAR VEHÍCULOS</div>
		<div class="card-body">
	  	  

	<!-- INICIO DEL FORMULARIO -->
	<form action="" method="post">
	
		<B>Bienvenido/a: </B> <?php echo $_COOKIE["NAME"]  ?>   <BR><BR>
		<B>Identificador Cliente: </B> <?php echo $_COOKIE["USERPASS"]  ?>  <BR><BR>
		
		<B>Vehiculos disponibles en este momento:</B> <?php echo date("d/m/Y h:i", strtotime("+1 hour")) ?> <BR><BR>
		
			<B>Matricula/Marca/Modelo: </B><select name="vehiculos" class="form-control">

			<?php
				foreach ($datos as $vehicle => $dato) 
					echo "<option value='" . $dato['matricula'] . "'>" . $dato['visual'] . "</option>";
			?>
			</select>
			<?php
			if (!empty($cart) ) {
				echo "<b>cesta</b><br>";
				foreach ($cart as $vehicle) {
					echo $vehicle."<br>";
				}
			}
			echo "<BR>";
			echo $message;
			?>
		
		<BR> <BR><BR><BR><BR><BR>
		<div>
			<input type="submit" value="Agregar a Cesta" name="agregar" class="btn btn-warning disabled">
			<input type="submit" value="Realizar Alquiler" name="alquilar" class="btn btn-warning disabled">
			<input type="submit" value="Vaciar Cesta" name="vaciar" class="btn btn-warning disabled">
			<input type="submit" value="Volver" name="Volver" class="btn btn-warning disabled">
		</div>		
	</form>
	<BR><a href="../controller/logoutContr.php">Cerrar Sesión</a>

	<!-- FIN DEL FORMULARIO -->
  </body>
   
</html>
