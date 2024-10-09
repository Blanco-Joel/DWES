<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>El resultado es : </h1>
    <?php
			function eleccion (){
				switch ($_POST["operacion"]) {
					case 'Suma':
						suma();
					break;
					case 'Resta':
						resta();
					break;
					case 'Producto':
						producto(); 
					break;
					case 'Division':
						division();
					break;

					default:
					echo "<p>Seleccione una operación</p>";
					break;
				}
			}
			function suma (){
				$resultado  = floatval($_POST["operando1"]) + floatval($_POST["operando2"]);
				echo "<h1>". $resultado. "</h1>";
			}
			function resta (){
				$resultado  = floatval($_POST["operando1"]) - floatval($_POST["operando2"]);
				echo "<h1>". $resultado. "</h1>";
			}
			function producto (){
				$resultado  = floatval($_POST["operando1"]) * floatval($_POST["operando2"]);
				echo "<h1>". $resultado. "</h1>";
			}
			function division (){
				$resultado  = floatval($_POST["operando1"]) / floatval($_POST["operando2"]);
				echo "<h1>". $resultado. "</h1>";
			}
			if ($_SERVER["REQUEST_METHOD"] == "POST")  
				eleccion();
			?>	
</body>
</html>
