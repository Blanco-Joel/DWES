<HTML>
<HEAD><TITLE> EJ2-Direccion Red – Broadcast y Rango</TITLE></HEAD>
<BODY>
<?php


    $array0 = array("Bases Datos", "Entornos Desarrollo", "Programación");
    $array1 = array("Sistemas Informáticos","FOL","Mecanizado");
    $array2 = array("Desarrollo Web ES","Desarrollo Web EC","Despliegue","Desarrollo Interfaces", "Inglés");
    $arrayCompleta = array();
    $arrayCompleta2  = array();
    $arrayCompleta3  = array();
    $nombre = "array";
    $i = 0;
    while ($i < (count($array0)+count($array1)+count($array2))) {
        $arrayAux = ($i < 3) ? ${$nombre.'0'} : (($i <= 5) ? ${$nombre.'1'} : ${$nombre.'2'});
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

    /*********************************************************************************************/
    $arrayCompleta2  = array_merge($array0,$array1,$array2);
    foreach ($arrayCompleta2 as $i ) 
        echo $i . "<br>";
    /*********************************************************************************************/
    $i = 0;
    while ($i < (count($array0)+count($array1)+count($array2))) {
        $arrayAux = ($i < 3) ? ${$nombre.'0'} : (($i <= 5) ? ${$nombre.'1'} : ${$nombre.'2'});
        $j = 0;
        while ($j < count($arrayAux)) {
            array_push($arrayCompleta3, $arrayAux[$j]);
            $j += 1;
            $i += 1;  
        }   
    }
    foreach ($arrayCompleta3 as $i ) 
        echo $i . "<br>";

?>
</BODY>
</HTML>
