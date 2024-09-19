<HTML>
<HEAD><TITLE> EJ1-Conversion IP Decimal a Binario </TITLE></HEAD>
<BODY>
<?php
    $ip = array(10,33,4,2);
    $ipFinal = " ";
    for ($i=0; $i <4 ; $i++) 
    { 
        $octal = $ip[$i];
        (String) $octalSinCeros = decbin($octal) ;
        while (strlen($octalSinCeros) < 8)
        $octalSinCeros = "0" . $octalSinCeros;
        $ipFinal = $ipFinal . "." . $octalSinCeros;
    }
    echo "La ip 10.33.4.2 es " . substr($ipFinal,2,strlen($ipFinal));
?>
</BODY>
</HTML>