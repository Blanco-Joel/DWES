<HTML>
<HEAD><TITLE> EJ1B – Conversor decimal a binario</TITLE></HEAD>
<BODY>
<?php
    $num="128";
    $numStr = "";
    while ($num >= 1)
    {
        settype ($num, "integer");
        $numStr = ($num%2) . $numStr;
        $num = $num/ 2; 
    }
    echo $numStr;
?>
</BODY>
</HTML>