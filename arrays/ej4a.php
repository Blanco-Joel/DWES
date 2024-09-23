<HTML>
<HEAD><TITLE> EJ2-Direccion Red – Broadcast y Rango</TITLE></HEAD>
<BODY>
<?php


    $array = [];
    $arrayVuelta = [];
    for ($i=0; $i <= 20 ; $i++) 
        array_push($array,sprintf("%08b", $i)); 
    foreach ($array as $i) 
        array_unshift($arrayVuelta,$i);
    foreach ($arrayVuelta as $i )
        echo "<p>".$i."</p>";
    

?>
</BODY>
</HTML>