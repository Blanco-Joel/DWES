<!doctype html>
<html lang="es">
	<head>
        <title>Cambio de Bases</title>
		<meta charset="UTF-8">
        <meta name="Author" content="Joel Blanco">
	</head>
	<body>
		<header>
            <h1>Cambio de Bases</h1>
		</header>
		<nav>
		</nav>
		<main>
			<section>
				<article>
					<div>
                        <form name="formulario" method="post" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?> >
							<label >Numero:</label>
							<input type="text" name="numero"/><br/>
							<label >Nueva base:</label>
							<input type="text" name="base"/><br/>
							<input type="submit" name="submit" value="enviar"/>
							<input type="reset" name="reset" value="Borrar"/>
						</form>
					</div>
                    <?php
                        
                        function imprimirTabla($numeroAnterior, $baseAnterior, $numeroNuevo, $baseNueva)
                        {
                            echo "<p>El numero ".$numeroAnterior." en base ". $baseAnterior. " es ". $numeroNuevo . " en base " . $baseNueva. "</p>";
                        }

                        function recogerDatos(){
                            $baseNueva = limpiar($_POST["base"]);
                            $numero = limpiar(strval($_POST["numero"]));
                            $numero = explode("/", $numero);
                            $numero[1] = intval($numero[1]);
                            $numeroNuevo = base_convert($numero[0],$numero[1],$baseNueva);
                            imprimirTabla($numero[0],$numero[1],$numeroNuevo,$baseNueva);
                        }   

                        function limpiar($data) {
                            $data = trim($data);
                            $data = stripslashes($data);
                            $data = htmlspecialchars($data);
                            return $data;
                        }
                        if ($_SERVER["REQUEST_METHOD"] == "POST")  
                            recogerDatos();
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