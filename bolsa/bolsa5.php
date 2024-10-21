<<<<<<< HEAD
<html lang="es">
	<head>
        <title>Ficheros 1</title>
		<meta charset="UTF-8">
        <meta name="Author" content="Joel Blanco">
	</head>
	<body>
		<header>
            <h1>Imprimir Totales</h1>
		</header>
		<nav>
		</nav>
		<main>
			<section>
				<article>
					<div>
						<?PHP include('./funciones_bolsa.php');?>
						<form method="post"  action = <?php echo  htmlspecialchars($_SERVER["PHP_SELF"]) ?>>		
						<label for="totales">Mostrar : </label>
						<select name="Totales" id="totales" required>
							<option value="7">Total Volumen</option>
							<option value="8">Total Capitalizacion</option>
						</select>
						<br>

						<br>
							<input type="submit" value="enviar">
							<input type="reset" value="borrar">
						<br>
						</form>
					</div>
					<?php
						
						if ($_SERVER["REQUEST_METHOD"] == "POST") {
							recogerDatosTotales();     
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
=======
<html lang="es">
	<head>
        <title>Ficheros 1</title>
		<meta charset="UTF-8">
        <meta name="Author" content="Joel Blanco">
	</head>
	<body>
		<header>
            <h1>Imprimir Totales</h1>
		</header>
		<nav>
		</nav>
		<main>
			<section>
				<article>
					<div>
						<?PHP include('./funciones_bolsa.php');?>
						<form method="post"  action = <?php echo  htmlspecialchars($_SERVER["PHP_SELF"]) ?>>		
						<label for="totales">Mostrar : </label>
						<select name="Totales" id="totales" required>
							<option value="7">Total Volumen</option>
							<option value="8">Total Capitalizacion</option>
						</select>
						<br>

						<br>
							<input type="submit" value="enviar">
							<input type="reset" value="borrar">
						<br>
						</form>
					</div>
					<?php
						
						if ($_SERVER["REQUEST_METHOD"] == "POST") {
							recogerDatosTotales();     
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
>>>>>>> debd5bb96715453eb305c38f8d742c266a83a851
</html>