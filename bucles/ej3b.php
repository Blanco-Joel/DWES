<HTML>
<HEAD><TITLE> EJ1B – Conversor decimal a binario</TITLE></HEAD>
<BODY>
<?php
    $num="1515";
    $base = "16";
    $numStr = "";
    while ($num >= 1)
    {
        settype ($num, "integer");
        if ($num%$base > 9) 
            $numStr = chr(64 + (($num%$base)-9)) . $numStr;
        else
            $numStr = ($num%$base) . $numStr;
        $num = $num/ $base; 
    }
    echo $numStr;
?>
</BODY>
</HTML>