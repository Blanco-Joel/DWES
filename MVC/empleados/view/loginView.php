<html>
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page - Empleados</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
 </head>
      
<body>
    <h1>Portal del Empleado</h1>

    <div class="container ">
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Login Usuario</div>
		<div class="card-body">
		
		<form id="" name="" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ;?>" method="post" class="card-body">
		
		<div class="form-group">
			Número del empleado <input type="text" name="user" placeholder="número" class="form-control">
        </div>
		<div class="form-group">
			Clave <input type="password" name="password" placeholder="password" class="form-control">
        </div>				
		<input type="submit" name="submit" value="Login" class="btn btn-warning disabled">
        </form>
		
	    </div>

    </div>
    </div>
    </div>

</body>
</html>