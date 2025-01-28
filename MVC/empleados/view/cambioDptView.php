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
		<div class="card-header">RRHH - Modificar Departamento</div>
		<div class="card-body">
	  
	  	
	   

	<!-- INICIO DEL FORMULARIO -->
	<form action="" method="post">
				
    <B>Bienvenido/a: </B> <?php echo $_COOKIE["NAME"]  ?>   <BR><BR>
    <B>Identificador Cliente: </B> <?php echo $_COOKIE["USERPASS"]  ?>  <BR><BR>
    
    <label for="emp">Employee:</label>
    <select name="emp" id="emp" class="form-control">
    <option value=''>--Select an employee--</option>
      <?php foreach ($data as $Employee => $emp) 
        echo "<option value='" . $emp['emp_no'] . "'>" . $emp['visual'] . "</option>";
      ?>
    </select><BR>
    <?php
        if (!empty($actualDepart)) {
            echo $actualDepart;
        }
        ?><BR>
		<div>
			<input type="submit" value="Consultar Departamento" name="Consultar" class="btn btn-warning disabled">
			<?php
        if (!empty($button)) {
            echo $button;
        }
        ?>
			<input type="submit" value="Volver" name="Volver" class="btn btn-warning disabled">

		</div>		
	</form>
	<!-- FIN DEL FORMULARIO -->

    <BR><a href="../controller/logoutContr.php">Cerrar Sesión</a>

  </body>
   
</html>
