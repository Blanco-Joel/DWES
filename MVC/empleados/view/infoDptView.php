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
		<div class="card-header">RRHH - Información de los departamentos </div>
		<div class="card-body">
	  
	  	
	   

	<!-- INICIO DEL FORMULARIO -->
	<form action="" method="post">
				
    <B>Bienvenido/a: </B> <?php echo $_COOKIE["NAME"]  ?>   <BR><BR>
    <B>Identificador Cliente: </B> <?php echo $_COOKIE["USERPASS"]  ?>  <BR><BR>
    
    <label for="dpt">Department:</label>
    <select name="dpt" id="dpt" class="form-control">
      <option value=''>--Select a department--</option>
      <?php foreach ($data as $department => $depart) 
        echo "<option value='" . $depart['dept_no'] . "'>" . $depart['visual'] . "</option>";
      ?>
    </select><BR>
    <?php
        if (!empty($dptData)) {
          echo $mess;
          foreach ($dptData as $departmentEach ) {
              echo $departmentEach["visual"];
          }
          if (!empty($managerMess)) {
            echo "<hr>Manager <hr>";
              echo $managerMess;
          }
        }
        ?><BR>
		<div>
			<input type="submit" value="Consultar información" name="Consultar" class="btn btn-warning disabled">
			<input type="submit" value="Volver" name="Volver" class="btn btn-warning disabled">

		</div>		
	</form>
	<!-- FIN DEL FORMULARIO -->

    <BR><a href="../controller/logoutContr.php">Cerrar Sesión</a>

  </body>
   
</html>
