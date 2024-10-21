<<<<<<< HEAD
<html lang="es">
	<head>
        <title>Ficheros 1</title>
		<meta charset="UTF-8">
        <meta name="Author" content="Joel Blanco">
	</head>
	<body>
		<header>
            <h1>Imprimir valor de cotización</h1>
		</header>
		<nav>
		</nav>
		<main>
			<section>
				<article>
					<div>
						<form method="Post"  action=<?php echo  htmlspecialchars($_SERVER["PHP_SELF"]) ?>>		
						<?php
						 	include('./funciones_bolsa.php');
							crearDesplegable();
							echo "<br>";
							crearDesplegableIndice();
						?>
						<br>
							<input type="submit" value="enviar">
							<input type="reset" value="borrar">
						<br>
					</div>
					<?php
						if ($_SERVER["REQUEST_METHOD"] == "POST")  
							recogerDatos($_SERVER["PHP_SELF"]);     
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
            <h1>Imprimir valor de cotización</h1>
		</header>
		<nav>
		</nav>
		<main>
			<section>
				<article>
					<div>
						<form method="Post"  action=<?php echo  htmlspecialchars($_SERVER["PHP_SELF"]) ?>>		
						<?php
						 	include('./funciones_bolsa.php');
							crearDesplegable();
							echo "<br>";
							crearDesplegableIndice();
						?>
						<br>
							<input type="submit" value="enviar">
							<input type="reset" value="borrar">
						<br>
					</div>
					<?php
						if ($_SERVER["REQUEST_METHOD"] == "POST")  
							recogerDatos($_SERVER["PHP_SELF"]);     
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