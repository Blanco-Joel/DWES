<HTML>
<HEAD><TITLE> EJ2-Direccion Red – Broadcast y Rango</TITLE></HEAD>
<BODY>
<?php


    $array0 = array("Bases Datos", "Entornos Desarrollo", "Programación");
    $array1 = array("Sistemas Informáticos","FOL","Mecanizado");
    $array2 = array("Desarrollo Web ES","Desarrollo Web EC","Despliegue","Desarrollo Interfaces", "Inglés");
    $arrayCompleta = array();
    $nombre = "array";
    $i = 0;
    while ($i < (count($array0)+count($array1)+count($array2))) {
        $arrayAux = ($i < 3) ? ${$nombre.'0'} : (($i < 6) ? ${$nombre.'1'} : ${$nombre.'2'});
        $j = 0;
        while ($j < count($arrayAux))
        {
            $arrayCompleta[$i] = $arrayAux[$j];
            $j += 1;
            $i += 1;  
        }   
    }


    
    foreach ($arrayCompleta as $i ) 
        echo $i . "<br>";
    


?>
</BODY>
</HTML>
