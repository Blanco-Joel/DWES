<?php
require_once ("../controller/dataContr.php");
require_once ("../controller/cookieContr.php");
?>
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
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header"> RRHH - Alta de empleado Masiva </div>
		<div class="card-body">


		<B>Bienvenido/a: </B> <?php echo $_COOKIE["NAME"]  ?>   <BR><BR>
		<B>Identificador Empleado: </B> <?php echo $_COOKIE["USERPASS"]  ?>  <BR><BR>
	 	<form action="" method="post">
			<fieldset style="display:grid; grid-template-columns: auto 1fr; gap: 10px;border:1px solid lightgreen;border-radius:2%;padding:5px">
					
				<label for="birth_date">Birth Date:</label>
				<input class="form-control" type="text" id="birth_date" name="birth_date" placeholder="yyyy-mm-dd"  pattern="\d{4}-\d{2}-\d{2}" >
				
				<label for="first_name">First Name:</label>
				<input class="form-control"  type="text" id="first_name" name="first_name" >
				
				<label for="last_name">Last Name:</label>
				<input  class="form-control" type="text" id="last_name" name="last_name" >
				
				<label for="gender">Gender:</label>
				<select class="form-control" id="gender" name="gender" >
					<option value="M">Male</option>
					<option value="F">Female</option>
				</select>

				<label for="dpt">Department:</label>
				<select name="dpt" id="dpt" class="form-control">
					<?php foreach ($data as $department => $dpt) 
						echo "<option value='" . $dpt['dept_no'] . "'>" . $dpt['dept_name'] . "</option>";
					?>
				</select>

				<label for="title">Title:</label>
				<input class="form-control" type="text" id="title" name="title"  >

				<label for="salary">Salary:</label>
				<input class="form-control" type="text" id="salary" name="salary"  >
				
				<input type="submit" value="Añadir empleado" name="annadir" class="btn btn-warning disabled">
				<input type="submit" value="Dar de alta a los empleados" name="alta" class="btn btn-warning disabled">
				
			</fieldset>
			<br>
			<?php
			if (!empty($mess)) {
				echo $mess;
			}
			?>
			<input type="submit" value="Volver" name="Volver" class="btn btn-warning disabled">
		</form>
		
	</br></br>
		
		
		
		<BR><a href="../controller/logoutContr.php">Cerrar Sesión</a>
		</div>  
	  
	     </body>
   
</html>


