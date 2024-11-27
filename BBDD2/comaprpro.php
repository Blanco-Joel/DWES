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
        <label >Nombre del producto:</label>
            <?php crearDesplegable("id_producto, ' | ', nombre","producto","id_producto")  ?>
        <br><br>
        <label >Localidad del Almacen:</label>
            <?php crearDesplegable("num_almacen","almacen","num_almacen") ?>
        <br><br>
        Cantidad del producto: <input type='text' name='cantidad' value='' size=5><br>
        <input type="submit" value="Validar" name="alta">
    </FORM>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST")  
        {
            $id_producto = recogerDatos("id_producto");
            $localidad = recogerDatos("num_almacen");
            $cantidad = recogerDatos("cantidad");
            introducirCantProd($id_producto,$localidad,$cantidad);
        }
    ?>

</BODY>

</HTML>