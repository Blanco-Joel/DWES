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
					<?php
                        function recogerDatos()
                        {
                            $archivo = fopen("alumnos2.txt", "r") or die("No existe el fichero"); 
                            $fila = fgets($archivo);
                            $cont = 0;
                            imprimirInicioTabla();
                            while ($fila != "") {
                                $fila = explode(chr(35).chr(35),$fila );
                                limpiarFila($fila);
                                $fila = fgets($archivo);
                                $cont +=1;
                            }
                            imprimirFinalTabla($cont);
                            fclose($archivo);   
                        }

                        function limpiarFila($fila)
                        {
                            $filaLimpia = array();
                            for ($i=0; $i < count($fila); $i++) { 
                                if ($fila[$i] != '')
                                    array_push($filaLimpia,$fila[$i]);
                            }
                            imprimirDatos($filaLimpia);
                        }
                        function imprimirInicioTabla()
                        {
                            echo "<table border=1>";
                            echo "<tr><th>fichero</th><th>Apellidos</th><th>Fecha de Nacimiento</th><th>Localidad</th></tr>";
                        }
                        function imprimirDatos($filaLimpia)
                        {
                            echo "<tr><td>$filaLimpia[0]</td><td>$filaLimpia[1]"." "."$filaLimpia[2]</td><td>$filaLimpia[3]</td><td>$filaLimpia[4]</tD></tr>";
                        }
                        function imprimirFinalTabla($cont)
                        {
                            echo "</table>";
                            echo "Se han impreso " . $cont . " filas de datos. ";
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