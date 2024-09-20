<HTML>
<HEAD><TITLE> EJ1B – Conversor decimal a binario</TITLE></HEAD>
<BODY>
<?php
    $num="6";
    $aux = 1;
    for ($i=0; $i <= $num ; $i++) 
    {
        if (gettype ($num)  == "string") 
            settype ($num, "integer");
        $aux *= $num;
        $num -= 1;
    }
    echo $aux;
?>
</BODY>
</HTML>