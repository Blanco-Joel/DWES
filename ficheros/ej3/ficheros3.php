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

                        function fileDatos()
                        {
                            $archivo = fopen("alumnos1.txt", "r") or die("No existe el fichero"); 
                            $fila = fgets($archivo);
                            $cont = 0;
                            imprimirInicioTabla();
                            while ($fila != "") {
                                $fila = explode(" ",$fila );
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
                            $filaLimpia[4] = substr($filaLimpia[3],10);
                            $filaLimpia[3] = substr($filaLimpia[3],0,10);
                            imprimirDatos($filaLimpia);
                        }
                        function imprimirInicioTabla()
                        {
                            echo "<table border=1>";
                            echo "<tr><th>Nombre</th><th>Apellidos</th><th>Fecha de Nacimiento</th><th>Localidad</th></tr>";
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
                            fileDatos();    
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