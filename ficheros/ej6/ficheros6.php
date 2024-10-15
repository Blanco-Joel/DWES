<html lang="es">
	<head>
        <title>Ficheros 5</title>
		<meta charset="UTF-8">
        <meta name="Author" content="Joel Blanco">
	</head>
	<body>
		<header>
            <h1>Operaciones Ficheros</h1>
		</header>
		<nav>
		</nav>
		<main>
			<section>
				<article>
                        <form method="Post"   action=<?php $_SERVER['PHP_SELF']; ?> >
                            <label for="fichero" >Fichero(Path/Nombre) <label><input type="text" name="fichero" id="fichero" required><br>
                            <br>
                            <input type="submit" value="enviar">
                            <input type="reset" value="borrar">
                        </form>
                        <br><br>
					<?php
                        function recogerDatos()
                        {
                            $archivo = $_POST["fichero"];
                            if (!file_exists($archivo))
                                imprimirError();
                            else
                            {
                                sacarDatosArchivo($archivo);
                            }
                        }
                        function sacarDatosArchivo($archivo)
                        {
                            $nombre = basename($archivo);
                            $ruta = dirname(realpath($archivo));
                            $tamanio= filesize($archivo);
                            $ultimaModif =  date("d/M/Y H:i:s.", filemtime($archivo));
                            imprimirDatos($nombre,$ruta,$tamanio,$ultimaModif);
                        }

                        function imprimirDatos($nombre,$ruta,$tamanio,$ultimaModif)
                        {
                            echo "<h3>Nombre del Fichero :". $nombre  . " </h3> ";
                            echo "<h3>Directorio :" . $ruta . " </h3> ";
                            echo "<h3>Tamaño del fichero :" . $tamanio  . " Kb  </h3> ";
                            echo "<h3>Ultima modificación :" . $ultimaModif . " </h3> ";
                        }
                        function imprimirError()
                        {
                            echo "LA RUTA O EL ARCHIVO SON INCORRECTOS";
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