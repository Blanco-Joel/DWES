<html lang="es">
	<head>
        <title>Ficheros 1</title>
		<meta charset="UTF-8">
        <meta name="Author" content="Joel Blanco">
	</head>
	<body>
		<header>
            <h1>Imprimir Valor Bursátil</h1>
		</header>
		<nav>
		</nav>
		<main>
			<section>
				<article>
					<div>
						<form method="Post"  action=<?php echo  htmlspecialchars($_SERVER["PHP_SELF"]) ?>>
						<label for="Valor" >Valor :</label><input type="text" name="valor" id="Valor" ><br>
						<br>
							<input type="submit" value="enviar">
							<input type="reset" value="borrar">
						<br>
					</div>
					<?php
                        include('./funciones_bolsa.php');
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
</html>