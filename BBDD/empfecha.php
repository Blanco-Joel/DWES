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

    <form name='histoDpto' action= <?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?> method='POST'>
    <label >Empleado </label>
            <?php crearDesplegableEmple() ?>
        <br><br>
        <label >Porcentaje variable: </label>
            <input type='text' name='porcentaje' value='' size=5><br>
        <br><br>
        <input type="submit" value="Comprobar" name="alta">
    </FORM>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST")  
        {
            $dni = substr(recogerDatos("DNI"),0,9);
            $porcentaje = recogerDatos("porcentaje");
            cambiarSalar($dni,$porcentaje);
        }
    ?>

</BODY>

</HTML>