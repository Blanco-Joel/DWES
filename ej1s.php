<HTML>
<HEAD><TITLE> EJ1-Conversion IP Decimal a Binario </TITLE></HEAD>
<BODY>
<?php
    $ip = explode(".","10.33.4.2");
    $binario = sprintf("La ip 10.33.4.2 es %08b.%08b.%08b.%08b", $ip[0],$ip[1],$ip[2],$ip[3]);
    echo $binario;
?>
</BODY>
</HTML>

