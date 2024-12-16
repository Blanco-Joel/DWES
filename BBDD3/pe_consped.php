<?php
    include_once('./funciones.php');
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

    <form name='altaCat' action= <?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?> method='POST'>
        <?php $cliente = $_COOKIE["USERPASS"];crearDesplegable("orderNumber,' || ', orderDate","orders","pedido","customerNumber = '$cliente'")  ?><br><br>
        <input type="submit" value="Comprobar Pedido" name="comprobar"><br><br>
        <input type="button" onclick="location.href='./pe_inicio.php';" value="MENÚ" /><br><br>

        <input type="submit" value="Cerrar Sesion" name="cerrarSes">   <br><br>


    </FORM>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST")  
        {
            if(isset($_POST['comprobar']))
            {
                $pedido = recogerDatos("pedido");             
                comprobarPedidos($pedido);
            }
            
            if (isset($_POST['cerrarSes'])) {
                borrarCookie();     
                boorarCesta();
            }
        }
    ?>

</BODY>

</HTML>