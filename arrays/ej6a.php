<HTML>
<HEAD><TITLE> EJ2-Direccion Red – Broadcast y Rango</TITLE></HEAD>
<BODY>
<?php


    $array0 = array("Bases Datos", "Entornos Desarrollo", "Programación");
    $array1 = array("Sistemas Informáticos","FOL","Mecanizado");
    $array2 = array("Desarrollo Web ES","Desarrollo Web EC","Despliegue","Desarrollo Interfaces", "Inglés");
    $arrayCompleta = array();


    $arrayCompleta  = array_merge($array0,$array1,$array2);
    if (in_array("Mecanizado",$arrayCompleta))
    unset($arrayCompleta[array_search("Mecanizado",$arrayCompleta)]);

    $arrayInverso = array_reverse($arrayCompleta);
    foreach ($arrayInverso as $a) {
        echo $a . "<br/>";
    }
?>
</BODY>
</HTML>
