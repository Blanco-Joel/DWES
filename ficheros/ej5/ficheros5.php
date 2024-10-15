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
                            Operaciones: <br>
                            <input type="radio" name="operacion"  value="mostrar" id="mostrar" required><label for="mostrar">Mostrar Archivo</label><br>
                            <input type="radio" name="operacion" value="linea" id="linea" required><label for="linea">Mostrar <input type="text" name="lineaSuelta" > linea del archivo</label><br>
                            <input type="radio" name="operacion" value="lineas" id="lineas" required><label for="lineas">Mostrar <input type="text" name="primerasLineas" > primeras lineas</label><br>
                            <br>
                            <input type="submit" value="enviar">
                            <input type="reset" value="borrar">
                        </form>
                        <br><br>
					<?php
                        function recogerDatos()
                        {
                            $archivo = fopen($_POST["fichero"], "r") or die("No existe el fichero"); 
                            $cont = 0;
                            switch ($_POST["operacion"]) {
                                case 'mostrar':
                                    $fila = fgets($archivo);
                                    while ($fila != "") {
                                        imprimirDatos($fila);
                                        $fila = fgets($archivo);
                                    }
                                    break;
                                case 'linea':
                                    $fila = fgets($archivo);
                                    while ($cont < $_POST["lineaSuelta"]) {
                                        $fila = fgets($archivo);
                                        $cont +=1;
                                    }
                                    imprimirDatos($fila);
                                    break;
                                case 'lineas':
                                    $fila = fgets($archivo);
                                    while ($cont <= $_POST["primerasLineas"]) {
                                        imprimirDatos($fila);
                                        $fila = fgets($archivo);
                                        $cont +=1;
                                    }
                                    break;
                                default:
                                    # code...
                                    break;
                            }
                        }
                        function imprimirDatos($fila)
                        {
                            echo $fila;
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