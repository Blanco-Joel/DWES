<html lang="es">
	<head>
        <title>Ficheros 3</title>
		<meta charset="UTF-8">
        <meta name="Author" content="Joel Blanco">
	</head>
	<body>
		<header>
            <h1>Datos</h1>
		</header>
		<nav>
		</nav>
		<main>
			<section>
				<article>
					<?php

                        function fileDatos($nombre,$ape1,$ape2,$localidad,$fechaNac)
                        {
                            $fila = ""; 
                            $fila .= $nombre ."##";
                            $fila .= $ape1 ."##";
                            $fila .= $ape2 ."##";
                            $fila .= $fechaNac ."##";
                            $fila .= $localidad . "\n";
                            $archivo = fopen("alumnos2.txt", "a") or die("No existe el fichero"); 
                            fwrite($archivo,$fila);
                            fclose($archivo);   
                        }
                        function recogerDatos ()
                        {   
                            $nombre = limpiar($_POST["nombre"]);
                            $ape1 = limpiar($_POST["ape1"]);
                            $ape2 = limpiar($_POST["ape2"]);
                            $localidad = limpiar($_POST["localidad"]);
                            $fechaNac = limpiar($_POST["fechaNac"]);
                            fileDatos($nombre,$ape1,$ape2,$localidad,$fechaNac);
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