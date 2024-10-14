<html lang="es">
	<head>
        <title>Ficheros 1</title>
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
					<div>
						<form method="Post"  action=<?php echo  htmlspecialchars($_SERVER["PHP_SELF"]) ?>  >
							<label for="nombre" >Nombre :</label><input type="text" name="nombre" id="nombre" ><br>
							<label for="ape1" >Apellido 1:</label> <input type="text" name="ape1" id="ape1" ><br>
							<label for="ape2" >Apellido 2:</label> <input type="text" name="ape2" id="ape2" ><br>
							<label for="fechaNac" >Fecha de nacimiento:</label><input type="fechaNac" name="fechaNac" id="fechaNac" ><br>
							<label for="localidad" >localidad :</label><input type="localidad" name="localidad" id="localidad" ><br>

							<br>
							<input type="submit" value="enviar">
							<input type="reset" value="borrar">
						</form>
					</div>
					<?php
                        function fileDatos($nombre,$ape1,$ape2,$localidad,$fechaNac)
                        {
                            $fila = ""; 
                            $fila .= sumarEspacios($nombre,strlen($fila),40);
                            $fila .= sumarEspacios($ape1,strlen($fila),81);
                            $fila .= sumarEspacios($ape2,strlen($fila),123);
                            $fila .= sumarEspacios($fechaNac,strlen($fila),133);
                            $fila .= sumarEspacios($localidad,strlen($fila),160);
                            $archivo = fopen("alumnos1.txt", "w") or die("No existe el fichero"); 
                            fwrite($archivo,$fila);
                            fclose($archivo);   
                        }
                        function sumarEspacios($dato, $inicio, $final)
                        {
                            while ($inicio+strlen($dato) < $final-1) 
                                $dato .= " ";
                            
                            return $dato;

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