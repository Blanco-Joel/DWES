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

    <form name='listaDpto' action= <?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?> method='POST'>
        <label >Departamentos: </label>
            <?php crearDesplegableDpto() ?>
        <br><br>
        <input type="submit" value="Comprobar" name="alta">
    </FORM>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST")  
        {
            $cod_dpto = substr(recogerDatos("cod_dpto"),0,4);
            listarEmplesDpto($cod_dpto);
        }
    ?>

</BODY>

</HTML>