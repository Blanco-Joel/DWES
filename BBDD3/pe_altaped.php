<?php
    include_once('./funciones.php');
    ob_start();
    comprobarCookie();
?>
<?php //INCLUSIÓN DE ERRORES-------------------------------------------------------------------------------------------------------
    include_once "errores.php";
    set_error_handler("error_function");
?>
<HTML>

<HEAD> 
 <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>BBDD</title>
  </head>

</HEAD>

<BODY>

    <form name='comprar' action= <?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?> method='POST'>
        
        <label >Nombre del producto:</label>
            <?php crearDesplegable("productName","products","nombre","quantityInStock > 0")  ?>
        <br><br>

        Cantidad del producto: <input type='text' name='cantidad' value='' size=5><br><br>
        Metodo de pago [AA99999]: <input type='text' name='pago' value='' size=5><br><br>

        <input type="submit" value="Añadir Producto" name="annadirProd">
        <br><br>
        <input type="submit" value="Comprar Cesta" name="comprarCest">
        <br><br>
        <input type="submit" value="Eliminar Cesta" name="borrarCest">
        <br><br>
        <input type="submit" value="Cerrar Sesion" name="cerrarSes">   
        <br><br><br>

        <?php imprimirInicioCesta(); ?>
    </form>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST")  
        {
            if(isset($_POST['annadirProd']))
            {
                $nombre = recogerDatos("nombre");
                $cantidad = recogerDatos("cantidad");
                annadirProductoCesta($nombre,$cantidad);
            }
            if (isset($_POST['comprarCest'])) 
            {
                $user = $_COOKIE["USERPASS"];
                $pago = recogerDatos("pago");
                realizarCompraFinal($pago);
                boorarCesta();
            }
            if (isset($_POST['borrarCest'])) 
            {
                boorarCesta();
            }    
            if (isset($_POST['cerrarSes'])) 
            {
                borrarCookie();     
                boorarCesta();
            }

        }
    ?>

</BODY>
<?php ob_end_flush(); ?>
</HTML>