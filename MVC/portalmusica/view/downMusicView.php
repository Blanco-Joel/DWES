<?php
require_once ("../controller/dataContr.php");
require_once ("../controller/cookieContr.php");
?>
<html>
   
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Welcome</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
 </head>
   
 <body>
    <h1>Customer portal</h1> 

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">User menu </div>
		<div class="card-body">


		<B>Welcome: </B> <?php echo $_COOKIE["NAME"]  ?>   <BR><BR>
		<B>Client id: </B> <?php echo $_COOKIE["USERPASS"]  ?>  <BR><BR>
	 
			<B>Songs: </B><select name="songs" class="form-control">

			<?php
				foreach ($data as $songs => $dt) 
					echo "<option value='" . $dt['name'] . "'>" . $dt['visual'] . "</option>";
			?>
			</select>
			<?php
			if (!empty($song) ) {
				echo "<b>cesta</b><br>";
				foreach ($cart as $vehicle) {
					echo $vehicle."<br>";
				}
			}
			if (!empty($cart) ) {
				echo "<b>cesta</b><br>";
				foreach ($cart as $song) {
					echo $song."<br>";
				}
			}
			echo "<BR>";
			if (!empty($mess)) {
				echo $mess;
			}
			?>
		
		<BR> <BR><BR><BR><BR><BR>
		<div>
			<input type="submit" value="Agregar a Cesta" name="annadir" class="btn btn-warning disabled">
			<input type="submit" value="Realizar Alquiler" name="buy" class="btn btn-warning disabled">
			<input type="submit" value="Vaciar Cesta" name="vaciar" class="btn btn-warning disabled">
			<input type="submit" value="Volver" name="Volver" class="btn btn-warning disabled">
		</div>		
	</form>
	<BR><a href="../controller/logoutContr.php">Cerrar Sesión</a>

	<!-- FIN DEL FORMULARIO -->
  </body>
   
</html>
