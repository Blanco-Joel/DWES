<HTML>
<HEAD><TITLE> EJ2-Direccion Red – Broadcast y Rango</TITLE></HEAD>
<BODY>
<?php


    $array = [];
    for ($i=0; $i <= 20 ; $i++) 
        array_push($array,sprintf("%b", $i)); 
    
    echo "<table border = 1>";
    echo "<tr><th>Indice</th><th>Binario</th><th>Octal</th></tr>";
    for ($i=0; $i < count($array) ; $i++)
    { 
        echo "<tr>";
        echo "<th>" . $i . "</th>" . "<th>" . ($array[$i]) . "</th>" . "<th>" . sprintf("%o",$i). "</th>";
        echo "</tr>";
    }    
    echo "</table>";
?>
</BODY>
</HTML>