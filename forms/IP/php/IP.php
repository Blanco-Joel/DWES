<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Binario</h1>
    <?php
        function imprimirDecimal($decimal)
        {
            echo "<label >IP Decimal</label><br/><input type'text' name='decimal' value=".$decimal."><br/>";
        }
        function imprimirBinario($binario)
        {
            echo "<label >IP binaria</label><br/><input type='text' name='binaria'  value =".$binario." ><br/>";
        }
        function recogerDatos ()
        {   
            $decimal = limpiar($_POST["decimal"]);
            $ip = explode(".",$decimal);
            $binario = sprintf("%08b.%08b.%08b.%08b", $ip[0],$ip[1],$ip[2],$ip[3]);
            imprimirDecimal($decimal);
            imprimirBinario($binario);
        }

        function limpiar($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        recogerDatos();
        
        ?>
</body>
</html>
