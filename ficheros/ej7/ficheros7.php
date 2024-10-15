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
                            Fichero Origen (path/nombre)  :<input type="text" name="ficheroOrigen" required><br>
                            Fichero Destino (path/nombre) :<input type="text" name="ficheroDestino"><br>
                            Operaciones: <br>
                            <input type="radio" name="operacion" value="copiar"> Copiar Fichero <br>
                            <input type="radio" name="operacion" value="renombrar"> Renombrar Fichero <br>
                            <input type="radio" name="operacion" value="borrar"> Borrar Fichero <br>
                            <input type="submit" value="enviar">
                            <input type="reset" value="borrar">
                        </form>
                        <br><br>
					<?php
                        function recogerDatos()
                        {
                            $archivoOr = realpath($_POST["ficheroOrigen"]);
                            if (!file_exists($archivoOr))
                                imprimirError();
                            else
                            {
                                switch ($_POST["operacion"]) {
                                    case 'copiar':
                                        copiarFichero($archivoOr)
                                        break;
                                    case 'renombrar':
                                        renombrarFichero($archivoOr)

                                        break;
                                    case 'borrar':
                                        borrarFichero($archivoOr)

                                        break;              
                                }
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