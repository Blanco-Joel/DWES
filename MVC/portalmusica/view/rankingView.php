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
		<div class="card border-success mb-3" style="max-width: 60rem;">
		<div class="card-header">User menu </div>
		<div class="card-body">

			<B>Welcome: </B> <?php echo $_COOKIE["NAME"]  ?>   <BR><BR>
			<B>Client id: </B> <?php echo $_COOKIE["USERPASS"]  ?>  <BR><BR>
			
		<form method="POST" action="">
			<B>Songs: </B>
   
				Fecha Desde: <input type='date' name='fechadesde' value='' size=10 placeholder="fechadesde" class="form-control">
			 	Fecha Hasta: <input type='date' name='fechahasta' value='' size=10 placeholder="fechahasta" class="form-control"><br><br>
			<?php
				if (!empty($data)) 
				{
					foreach ($data as $songs => $dt) 
						echo "<br>" . $dt['visual'];
				}
			?>

				<?php 
				if (isset($_COOKIE["OFFSET"])) {
					echo "<div style='padding-top:1rem;display: flex;justify-content:center'><input style='margin-right:1rem' type='submit' value='<' name='prev' class='btn btn-warning disabled'><input type='submit' value='>' name='next' class='btn btn-warning disabled'></div>";
				}
				?>
			<?php
			?>
		
			<BR> <BR><BR><BR><BR><BR>
			<div>
				<input type="submit" value="Consultar" name="consultar" class="btn btn-warning disabled">
				<input type="submit" value="Volver" name="Volver" class="btn btn-warning disabled">
			</div>		
		</form>

	<BR><a href="../controller/logoutContr.php">Cerrar Sesión</a>

	<!-- FIN DEL FORMULARIO -->
  </body>
   
</html>
