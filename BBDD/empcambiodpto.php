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

    <form name='altaDpto' action= <?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?> method='POST'>
        <label >DNI del empleado:</label> 
            <?php crearDesplegableEmple() ?>
        <br><br>
        <label >Departamento del empleado:</label>
            <?php crearDesplegableDpto() ?>
        <br><br>
        <input type="submit" value="Dar de alta" name="alta">
    </FORM>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST")  
        {
            $dni = substr(recogerDatos("DNI"),0,9);
            var_dump($dni);
            $cod_dpto = substr(recogerDatos("cod_dpto"),0,4);
            //cambiarEmpleDpto($dni,$cod_dpto);
        }
    ?>

</BODY>

</HTML>