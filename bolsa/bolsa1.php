<html lang="es">
	<head>
        <title>Ficheros 1</title>
		<meta charset="UTF-8">
        <meta name="Author" content="Joel Blanco">
	</head>
	<body>
		<header>
            <h1>Imprimir Ibex 35</h1>
		</header>
		<nav>
		</nav>
		<main>
			<section>
				<article>
					<?php
                        include('./funciones_bolsa.php');
                        leerIbex();
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