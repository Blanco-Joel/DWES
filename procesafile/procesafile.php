

<HTML>
<HEAD><TITLE>Reto 02 - Gestión de ficheros</TITLE></HEAD>
<BODY>
    <h1>Reto 02 - Gestión de ficheros</h1>
    <form action="" method="POST">
        <label for="valor">Mostrar : </label><br><br>
        <input type="radio" id="tiempoRozas" name="operaciones" value="tiempoRozas">
        <label for="tiempoRozas">Pronóstico del tiempo - Las Rozas</label><br>

        <input type="radio" id="tiempoMadrid" name="operaciones" value="tiempoMadrid">
        <label for="tiempoMadrid">Pronóstico del tiempo - Madrid</label><br>

        <input type="radio" id="censocsv" name="operaciones" value="censocsv">
        <label for="censocsv">Censo provincia CSV</label><br>

        <input type="radio" id="censotxt" name="operaciones" value="censotxt">
        <label for="censotxt">Censo provincia TXT</label>
        <br><br>

        <input type="submit" value="Ejecutar operación">
        <input type="reset" value="Borrar">
    </form>
    <?php
    
$archivo = file_get_contents("pronosticotiempoLasRozas.xml");
    
$xml = new SimpleXMLElement($archivo);
$nombre = $xml->xpath('//nombre');
echo $nombre[0];
$rutaDia = $xml->xpath('//dia');
echo $rutaDia[0]['fecha'];
foreach ($rutaDia as $dia) {
    foreach ($dia->prob_precipitacion as $lluvia){
        if ($lluvia['periodo'] != "00-24" &&
            $lluvia['periodo'] != "00-12" && 
            $lluvia['periodo'] != "12-24") {
                echo "<p>".($lluvia['periodo']) ."</p>";
                echo "<p>". ($lluvia) ."</p>";
        }
    }
    $viento2 = "viento";
    foreach ($dia->$viento2 as $viento){
        if ($viento['periodo'] != "00-24" &&
            $viento['periodo'] != "00-12" && 
            $viento['periodo'] != "12-24") {
                $viento3 = "\$viento->direccion";
                echo "<p>".($viento['periodo']) ."</p>";
                echo "<p>". ($viento3) ."</p>";
                echo "<p>". ($viento->velocidad) ."</p>";
            }
    }
}
?>
    </BODY>
</HTML>