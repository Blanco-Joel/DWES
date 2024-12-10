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

    <form name='altaPro' action= <?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?> method='POST'>
        <label >Nombre del producto:</label> <input type='text' name='nombre' value='' size=40><br>
        <label >Precio del producto:</label> <input type='text' name='precio' value='' size=8><br>
        <label >Categoria del producto:</label>
            <?php crearDesplegable("id_categoria,' | ', nombre","categoria","id_categoria") ?>
        <br><br>
        <input type="submit" value="Dar de alta" name="alta">
    </FORM>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST")  
        {
            $nombre = recogerDatos("nombre");
            $precio = recogerDatos("precio");
            $id_categoria = recogerDatos("id_categoria");
            introducirProd($nombre,$precio,$id_categoria);
        }
    ?>

</BODY>

</HTML>