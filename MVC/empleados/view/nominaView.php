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
		<div class="card border-success mb-3" style="max-width: 40rem;">
		<div class="card-header">RRHH - Vida laboral </div>
		<div class="card-body">
	  
	  	
	   

	<!-- INICIO DEL FORMULARIO -->
	<form action="" method="post">
				
    <B>Bienvenido/a: </B> <?php echo $_COOKIE["NAME"]  ?>   <BR><BR>
    <B>Identificador Cliente: </B> <?php echo $_COOKIE["USERPASS"]  ?>  <BR><BR>
    
         
    <?php
        if (!empty($employeeData)) {
          echo $messPdata;
          foreach ($employeeData as $emp ) {
              echo $emp["visual"];
          }
          
        }
        if (!empty($employeeDpt)) {
          echo $messDept;
          foreach ($employeeDpt as $emp ) {
              echo $emp["visual"];
          }
          if (!empty($managerMess)) {
            echo "<hr>Manager of <hr>";
              echo $managerMess;
          }
        }
        if (!empty($employeeTitle)) {
          echo $messTitl;
          foreach ($employeeTitle as $emp ) {
              echo $emp["visual"];
          }
        }
        echo $messSalar;
        ?><BR>
		<div>
			<input type="submit" value="Volver" name="Volver" class="btn btn-warning disabled">

		</div>		
	</form>
	<!-- FIN DEL FORMULARIO -->

    <BR><a href="../controller/logoutContr.php">Cerrar Sesión</a>

  </body>
   
</html>
