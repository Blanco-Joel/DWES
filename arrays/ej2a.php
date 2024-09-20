<HTML>
<HEAD><TITLE> EJ2-Direccion Red – Broadcast y Rango</TITLE></HEAD>
<BODY>
<?php

    $array = [];
    $sumatorioPar = 0;
    $sumatorioImpar = 0;

    for ($i=1; $i < 40 ; $i++) 
        if ($i%2 == 1) 
            array_push($array,$i);    

    for ($i=0; $i < count($array) ; $i++)
    { 
        if ($i%2 == 0) 
            $sumatorioPar = $sumatorioPar + $array[$i];
        else
            $sumatorioImpar = $sumatorioImpar + $array[$i];
    }    
    echo "Pares : " . ($sumatorioPar/(count($array)/2));
    echo "Impares : " . ($sumatorioImpar/(count($array)/2));
?>
</BODY>
</HTML>