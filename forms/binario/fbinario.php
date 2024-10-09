<!doctype html>
<html lang="es">
	<head>
        <title>Binario</title>
		<meta charset="UTF-8">
        <meta name="Author" content="Joel Blanco">
	</head>
	<body>
		<header>
            <h1>Binario</h1>
		</header>
		<nav>
		</nav>
		<main>
			<section>

				<article>
				<?php
					echo "<form name='formulario' method='post' action=<?php $_SERVER['PHP_SELF']; ?> >
						<label >Numero Decimal</label><br/>
						<input type='number' name='decimal'/><br/>
						<input type='submit' name='submit' value='enviar'/>
						<input type='reset' name='reset' value='Borrar'/>
					</form>"
					function imprimirDecimal($decimal)
					{
						echo "<label >Numero Decimal</label><br/><input type'number' name='decimal' value=".$decimal."><br/>";
					}
					function imprimirBinario($binario)
					{
						echo "<label >Numero Binario</label><br/><input type'number' name='binario' value=".$binario."><br/>";
					}
					if ($_SERVER["REQUEST_METHOD"] == "POST")  {

						$binario = decbin($_POST["decimal"]);
						$decimal = $_POST["decimal"];
						imprimirDecimal($decimal);
						imprimirBinario($binario);
					}
					?>
				</article>
			</section>
		</main>
		<footer>
		</footer>
		<aside>
		</aside>
	</body>
</html>