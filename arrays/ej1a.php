<HTML>
<HEAD><TITLE> EJ2-Direccion Red – Broadcast y Rango</TITLE></HEAD>
<BODY>
<?php

    $array = [];
    $sumatorio = 0;
    for ($i=1; $i < 40 ; $i++) 
        if ($i%2 == 1) 
            array_push($array,$i);    
    echo "<table border = 1>";
    echo "<tr><th>Indice</th><th>Valor</th><th>Suma</th></tr>";
    for ($i=0; $i < count($array) ; $i++)
    { 
        $sumatorio = $sumatorio + $array[$i];
        echo "<tr>";
        echo "<th>" . $i . "</th>" . "<th>".($array[$i]) . "</th>" . "<th>" . $sumatorio . "</th>";
        echo "</tr>";
    }    
    echo "</table>";
?>
</BODY>
</HTML>