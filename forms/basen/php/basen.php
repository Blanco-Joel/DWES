<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Cambio de bases</h1>
    <?php
        
        function imprimirTabla($numeroAnterior, $baseAnterior, $numeroNuevo, $baseNueva)
        {
            echo "<p>El numero".$numeroAnterior." en base ". $baseAnterior. " es ". $numeroNuevo . "en base " . $baseNueva. "</p>";
        }

        function recogerDatos(){
            $baseNueva = limpiar($_POST["base"])
            $numero = limpiar(strval($_POST["numero"]));
            $numero = explode("/", $numero);
            $numero[1] = intval($numero[1]);
            $numeroNuevo = base_convert($numero[0],$numero[1],$baseNueva);
            imprimirTabla($numero[0],$numero[1],$numeroNuevo,$baseNueva);
        }   

        function limpiar($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        recogerDatos();
        ?>
</body>
</html>
