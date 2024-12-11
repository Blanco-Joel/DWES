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

    <form name='comprobarStock' action= <?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?> method='POST'>
    <label >Nombre del producto:</label>
            <?php crearDesplegable("productName","products","nombre","1 = 1")  ?>
        <br><br>
        <input type="submit" value="comprobar" name="comprobar">
        <input type="submit" value="Cerrar sesión" name="cerrarSes" id="cerrarSes">
    </form>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST")      
        {
            if(isset($_POST['comprobar']))
            {
                $nombre = recogerDatos("nombre");             
                comprobarStock($nombre);
            }
            
            if (isset($_POST['cerrarSes'])) {
                borrarCookie();     
            }
        }
    ?>

</BODY>
<?php ob_end_flush(); ?>
</HTML>