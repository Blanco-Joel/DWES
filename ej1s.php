<HTML>
<HEAD><TITLE> EJ1-Conversion IP Decimal a Binario </TITLE></HEAD>
<BODY>
<?php
    $oct1="10";
    $oct2="33";
    $oct3="4";
    $oct4="2";
    $binario = sprintf("La ip 10.33.4.2 es %08b.%08b.%08b.%08b", $oct1,$oct2,$oct3,$oct4);
    echo $binario;
?>
</BODY>
</HTML>

