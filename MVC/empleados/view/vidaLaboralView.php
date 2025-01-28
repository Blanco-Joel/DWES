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
		<div class="card-header">RRHH - Vida laboral </div>
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
      <select name="options" id="options"  class="form-control">
          <option value="">--Select an option--</option>
          <option value="departments">Departments</option>
          <option value="salaries">Salaries</option>
          <option value="personalData">Personal data</option>
          <option value="titles">Titles</option>
      </select><BR>
    <?php
        if (!empty($employeeData)) {
          echo $mess;
          foreach ($employeeData as $emp ) {
              echo $emp["visual"];
          }
          if (!empty($managerMess)) {
            echo "<hr>Manager of <hr>";
              echo $managerMess;
          }
        }
        ?><BR>
		<div>
			<input type="submit" value="Consultar Vida Laboral " name="Consultar" class="btn btn-warning disabled">
			<input type="submit" value="Volver" name="Volver" class="btn btn-warning disabled">

		</div>		
	</form>
	<!-- FIN DEL FORMULARIO -->

    <BR><a href="../controller/logoutContr.php">Cerrar Sesión</a>

  </body>
   
</html>
