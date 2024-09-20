<HTML>
<HEAD><TITLE> EJ1-Conversion IP Decimal a Binario </TITLE></HEAD>
<BODY>
<?php
    $ip = explode(".","10.33.4.2/16");
    $ipFinal = " ";
    $mascara = explode("/", $ip[3]);
    for ($i=0; $i <4 ; $i++) 
    { 
        $octal = $ip[$i];
        $octalSinCeros = decbin($octal);
        settype ($octalSinCeros,"string") ;
        while (strlen($octalSinCeros) < 8)
        $octalSinCeros = "0" . $octalSinCeros;
        $ipFinal = $ipFinal . "." . $octalSinCeros;
    }
    echo "La ip 10.33.4.2/16 es " . substr($ipFinal,2,strlen($ipFinal));
    echo "La mascara es " . $mascara[1];
?>
</BODY>
</HTML>