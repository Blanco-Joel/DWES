<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <title>Listado Películas</title>
    </head>
    <body>
	 <p><h1>Peliculas disponibles ... </h1></p>
        <?php
		    // Solo muestra datos no accede a los mismos
            foreach ($datos as $dato) {
                echo $dato["title"]."<br/>";
            }
        ?>
    </body>
</html>