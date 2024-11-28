<HTML>

<HEAD> 
 <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>BBDD</title>
  </head>

</HEAD>
<?php //INCLUSIÓN DE ERRORES-------------------------------------------------------------------------------------------------------
    include "errores.php";
    set_error_handler("error_function");
?>
<?php //INCLUSIÓN DE FUNCIONES-----------------------------------------------------------------------------------------------------
    include "funciones.php"; 
?>
<BODY>

    <form name='altaCat' action= <?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?> method='POST'>
        NIF del cliente[00000000A]: <input type='text' name='NIF' value='' size=5><br><br>
        
        <label >Número del almacen:</label>
            <?php crearDesplegable("num_almacen","almacen","num_almacen")?>
        <br><br>
        
        <label >Nombre del producto:</label>
            <?php crearDesplegable("id_producto, ' | ', nombre","producto","id_producto")  ?>
        <br><br>
        Cantidad del producto: <input type='text' name='cantidad' value='' size=5><br>

        <input type="submit" value="Comprar" name="alta">
    </FORM>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST")  
        {
            $NIF = recogerDatos("NIF");
            $id_producto = recogerDatos("id_producto");
            $num_almacen = recogerDatos("num_almacen");
            $cantidad = recogerDatos("cantidad");
            realizarCompra($NIF,$id_producto,$num_almacen,$cantidad);
        }
    ?>

</BODY>

</HTML>