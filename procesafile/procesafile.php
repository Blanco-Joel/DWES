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
    foreach ($dia->viento as $viento){
        if ($viento['periodo'] != "00-24" &&
            $viento['periodo'] != "00-12" && 
            $viento['periodo'] != "12-24") {
                echo "<p>".($viento['periodo']) ."</p>";
                echo "<p>". ($viento->direccion) ."</p>";
                echo "<p>". ($viento->velocidad) ."</p>";
            }
    }
}
?>

