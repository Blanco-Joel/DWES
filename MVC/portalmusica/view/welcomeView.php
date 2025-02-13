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
	 
		
       <!--Formulario con botones -->
	
		<input type="button" value="Download music" onclick="window.location.href='downMusicContr.php'" class="btn btn-warning disabled">
		<input type="button" value="Ranking" onclick="window.location.href='rankingContr.php'" class="btn btn-warning disabled">
		<input type="button" value="Payments history" onclick="window.location.href='histfacturasContr.php'" class="btn btn-warning disabled">
		<input type="button" value="Payments" onclick="window.location.href='facturasContr.php'" class="btn btn-warning disabled">
		</br></br>
		
		
		
		<BR><a href="../controller/logoutContr.php">Sign out</a>
		</div>  	
	  
	     </body>
   
</html>


