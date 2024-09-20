<HTML>
<HEAD><TITLE> EJ1B – Conversor decimal a binario</TITLE></HEAD>
<BODY>
<?php
    $num="222";
    $base = "16";
    $numStr = "";
    while ($num >= 1)
    {
        settype ($num, "integer");
        $numStr = ($num%$base) . $numStr;
        $num = $num/ $base; 
    }
    echo $numStr;
?>
</BODY>
</HTML>