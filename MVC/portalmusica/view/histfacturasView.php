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
		
		<form method="POST" action="">
			<h3>Payments history: </h3>

			<?php 
				foreach ($data as $datas => $dt) {
					$group[$dt["vista"]][] = $dt["vista2"];
				}
				foreach ($group as $invoice => $list) {
					echo "<hr><strong>".$invoice."</strong><hr>";
					foreach ($list as $content) {
						echo "----".$content."<br>";
					}
				}

				
			?>

		
			<BR> <BR><BR><BR><BR><BR>
			<div>
				<input type="submit" value="Volver" name="Volver" class="btn btn-warning disabled">
			</div>		
		</form>

	<BR><a href="../controller/logoutContr.php">Cerrar Sesión</a>

	<!-- FIN DEL FORMULARIO -->
  </body>
   
</html>
