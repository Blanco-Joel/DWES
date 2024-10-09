<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Cambio de bases</h1>
    <?php
        function imprimirDecimal($decimal)
        {
            echo "<label >Numero Decimal</label><br/><input type'number' name='decimal' value=".$decimal."><br/>";
        }
        function imprimirTabla($nombre,$base,$decimal)
        {
            echo "<tr><TD>$nombre</tD><tD>". base_convert($decimal,10,$base)."</tr>";
        }
        $decimal = strval($_POST["decimal"]);
        imprimirDecimal($decimal);
        echo "<table border=1>";
        if ( $_POST["conversion"] != "todas")
        {
            $nombre =  explode("-" , $_POST["conversion"]);
            imprimirTabla($nombre[0],$nombre[1],$decimal);
        }else {
            
            imprimirTabla("binario",2,$decimal);
            imprimirTabla("octal",8,$decimal);
            imprimirTabla("hexadecimal",16,$decimal);
        }
        echo "</table>";
    
        ?>
</body>
</html>
