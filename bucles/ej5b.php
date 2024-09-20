<HTML>
<HEAD><TITLE> EJ1B – Conversor decimal a binario</TITLE></HEAD>
<BODY>
<?php
    $num="6";
    echo "<table border = 1>";
    for ($i=0; $i <= 10 ; $i++) 
    {
        echo "<tr>";
        echo "<th>" . $num . " · " . $i .  "</th>".  "<th>".($num * $i) . "</th>";
        echo "</tr>";
    }    
    echo "</table>";

?>
</BODY>
</HTML>