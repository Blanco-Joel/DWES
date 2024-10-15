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

                            /*var_dump (realpath(dirname(basename($_SERVER['PHP_SELF']))));*/
                            $archivoOr = strtolower(realpath($_POST["ficheroOrigen"]));
                            var_dump($archivoOr);
                            if (!file_exists($archivoOr))
                                imprimirFinal("LA RUTA O EL ARCHIVO SON INCORRECTOS");
                            else
                            {
                                switch ($_POST["operacion"]) {
                                    case 'copiar':
                                        copiarRenombrarFichero($archivoOr,$_POST["operacion"]);
                                        break;
                                    case 'renombrar':
                                        copiarRenombrarFichero($archivoOr,$_POST["operacion"]);

                                        break;
                                    case 'borrar':
                                        borrarFichero($archivoOr);

                                        break;              
                                }
                            }
                        }
                        function copiarRenombrarFichero($archivoOr)
                        {
                            $archivoFi = strtolower($_POST["ficheroDestino"]);
                            if (!comprobarDestino($archivoFi)) 
                                echo "La ruta de destino ha de empezar por c:";
                            else{
                                if (!file_exists(dirname($archivoFi)))
                                {
                                    imprimirFalloDestino($archivoFi);
                                    mkdir(dirname($archivoFi),0777,true);
                                }
                                if ($_POST["operacion"] == 'copiar') {
                                    copy($archivoOr,$archivoFi);
                                    imprimirFinal("Se ha copiado con exito");
                                }else{
                                    rename($archivoOr,$archivoFi);
                                    imprimirFinal("Se ha renombrado con exito");
                                }

                            }
                        }
                        
                        function borrarFichero($archivoOr)
                        {
                            unlink($archivoOr);
                            imprimirFinal("Se ha eliminado con exito");
                        }


                        function comprobarDestino($archivoFi)
                        {
                            $valido = true;
                            $rutaArray = explode(chr(47),$archivoFi);
                            if ($rutaArray[0] != "c:") 
                               $valido = false;
                            return $valido;
                        }
                        function imprimirFalloDestino($archivoFi)
                        {
                            echo "<p> No existe la ruta " . dirname($archivoFi) . "</p>";
                            echo "<p> Se ha creado la ruta " . dirname($archivoFi) . "</p>";
                        }
                        function imprimirFinal($mensaje)
                        {
                            echo "<p>" . $mensaje . "</p>";
                        }
                        ?>
<?php
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