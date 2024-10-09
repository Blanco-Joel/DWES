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
					<div>
						<form name="formulario" method="post" action=<?php $_SERVER['PHP_SELF']; ?> >
							<label >IP Decimal</label><br/>
							<input type="text" name="decimal"/><br/>

							<input type="submit" name="submit" value="Notacion binaria" width="20px"/>
							<input type="reset" name="reset" value="Borrar"/>
						</form>
					</div>
					<?php
						function imprimirBinario($binario)
						{
							echo "<label >IP binaria</label><br/><input type='text' name='binaria'  value =".$binario." ><br/>";
						}
						function recogerDatos ()
						{   
							$decimal = limpiar($_POST["decimal"]);
							$ip = explode(".",$decimal);
							$binario = sprintf("%08b.%08b.%08b.%08b", $ip[0],$ip[1],$ip[2],$ip[3]);
							imprimirBinario($binario);
						}

						function limpiar($data)
						{
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