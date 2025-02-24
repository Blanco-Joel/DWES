<html>
   
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>RESERVAS VUELOS</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
 </head>
   
 <body>
   

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 
		75rem;">
		<div class="card-header">Reservar Vuelos</div>
		<div class="card-body">
	  	  

	<!-- INICIO DEL FORMULARIO -->
	<form action="" method="post">
	
		<B>Email Cliente:</B>  <?php echo $_COOKIE["USERPASS"]  ?>  <BR>
		<B>Nombre Cliente:</B>    <?php echo $_COOKIE["NAME"]  ?> <BR>
		<B>Fecha:</B>  <?php echo date("d/m/Y") ?>  <BR><BR>
		
		<B>Vuelos</B><select name="vuelos" class="form-control">
		<?php
			foreach ($datos as $fly => $dato) 
				echo "<option value='" . $dato['id_Vuelo'] . "'> Origen : " . $dato['origen'] ." || Destino : " . $dato["destino"]. " || Salida :".  $dato["fechahorasalida"]. " || Llegada : ". $dato["fechahorallegada"]. " || Aerolinea : ". $dato["nombre_aerolinea"]. " || Asientos Disp. : ". $dato["asientos_disponibles"] . " || Precio Asiento : ". $dato["precio_asiento"] . "</option>";
		?>
			</select>	
		<BR> 
		<B>Número Asientos</B><input type="number" name="asientos" size="3" min="1" max="100" value="1" class="form-control">
		<BR><BR><BR><BR><BR>
		<?php
			if (isset($_SESSION["vuelos"]) ) {
				echo "<b>cesta</b><br>";
				foreach ($_SESSION["vuelos"] as $vuelo => $times) {
					echo  $vuelo ." || asientos : " . $times. "<br>";
				}
			}
			echo "<BR>";
			if (!empty($message)) {
				echo $message;
			}
		?>
		<div>
			<input type="submit" value="Agregar a Cesta" name="agregar" class="btn btn-warning disabled">
			<input type="submit" value="Comprar" name="comprar" class="btn btn-warning disabled">
			<input type="submit" value="Vaciar Cesta" name="vaciar" class="btn btn-warning disabled">
			<input type="submit" value="Volver" name="volver" class="btn btn-warning disabled">
		</div>		
	</form>
	
	<!-- FIN DEL FORMULARIO -->
    <a href = "../controller/logoutContr.php">Cerrar Sesion</a>
  </body>
   
</html>

