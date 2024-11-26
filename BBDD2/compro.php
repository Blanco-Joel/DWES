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
        
        <label >Localidad del almacen:</label>
            <?php crearDesplegableAlm() ?>
        <br><br>
        
        <label >Nombre del producto:</label>
            <?php crearDesplegableProd() ?>
        <br><br>
        Cantidad del producto: <input type='text' name='cantidad' value='' size=5><br>

        <input type="submit" value="Comprar" name="alta">
    </FORM>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST")  
        {
            $NIF = recogerDatos("NIF");
            $id_producto = recogerDatos("id_producto");
            $localidad = recogerDatos("localidad");
            $cantidad = recogerDatos("cantidad");
            realizarCompra($NIF,$id_producto,$localidad,$cantidad);
        }
    ?>

</BODY>

</HTML>