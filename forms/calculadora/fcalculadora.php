<!doctype html>
<html lang="es">
	<head>
        <title>Calculadora</title>
		<meta charset="UTF-8">
        <meta name="Author" content="Joel Blanco">
	</head>
	<body>
		<header>
            <h1>Calculadora</h1>
		</header>
		<nav>
		</nav>
		<main>
			<section>
				<article>
					<div>
                        <form name="formulario" method="post" action=<?php $_SERVER["PHP_SELF"]; ?> >
							<label >Operando 1</label><br/>
							<input type="text" name="operando1"/><br/>
							<label >Operando 2</label><br/>
							<input type="text" name="operando2"/><br/>
							<label>Selecciona una operación:</label><br/>


							<input type="radio" id="suma" name="operacion" value="Suma">
							<label for="suma">Suma</label><br>
							<input type="radio" id="resta" name="operacion" value="Resta">
							<label for="resta">Resta</label><br>
							<input type="radio" id="producto" name="operacion" value="Producto">
							<label for="producto">Producto</label><br>
							<input type="radio" id="division" name="operacion" value="Division">
							<label for="division">Division</label><br>
							<input type="submit" name="submit" value="enviar"/>
							<input type="reset" name="reset" value="Borrar"/>
						</form>
					</div>
				</article>
			</section>
			<article>
			<h1>El resultado es : </h1>
			<?php
			function eleccion (){
				switch (floatval($_POST["operacion"])) {
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
		</article>
		</main>
		<footer>
		</footer>
		<aside>
		</aside>
	</body>
</html>