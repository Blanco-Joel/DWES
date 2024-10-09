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
            echo "<label >Numero Decimal</label><br/><input type'number' name='decimal' value=".$decimal."><br/>";
        }
        function imprimirBinario($binario)
        {
            echo "<label >Numero Binario</label><br/><input type'number' name='binario' value=".$binario."><br/>";
        }
        $binario = decbin($_POST["decimal"]);
        $decimal = $_POST["decimal"];
        imprimirDecimal($decimal);
        imprimirBinario($binario);
        ?>
</body>
</html>
