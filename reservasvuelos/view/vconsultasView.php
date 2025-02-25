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
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Consultar Reservas</div>
		<div class="card-body">
	  	  

	<!-- INICIO DEL FORMULARIO -->
	<form action="" method="post">
	
		<B>Email Cliente:</B>  <?php echo $_COOKIE["USERPASS"]  ?>  <BR>
		<B>Nombre Cliente:</B>    <?php echo $_COOKIE["NAME"]  ?> <BR>
		<B>Fecha:</B>  <?php echo date("d/m/Y") ?>  <BR><BR>
		
		<B>Numero Reserva</B><select name="reserva" class="form-control">
			<?php
			foreach ($data as $dt => $dato) 
				echo "<option value='" . $dato['id_reserva'] . "'> ". $dato['id_reserva'] ."|| fecha :".$dato["fecha_reserva"] ."</option>";
				?>
			</select>	
		<BR><BR><BR><BR><BR><BR><BR>
		<?php
		if (isset($data2)) {
			foreach ($data2 as $dt => $dato) 
			echo "Origen : " . $dato['origen'] ." || Destino : " . $dato["destino"]. " || Salida :".  $dato["fechahorasalida"]. " || Llegada : ". $dato["fechahorallegada"]. " || Aerolinea : ". $dato["nombre_aerolinea"]. " || Asientos : ". $dato["num_asientos"] . "<br>";
		}
		?>
		<div>
			<input type="submit" value="Consultar Reserva" name="consultar" class="btn btn-warning disabled">
			<input type="submit" value="Volver" name="volver" class="btn btn-warning disabled">
		</div>		
	</form>
	
	<!-- FIN DEL FORMULARIO -->
    <a href = "../controller/logoutContr.php">Cerrar Sesion</a>
  </body>
   
</html>

