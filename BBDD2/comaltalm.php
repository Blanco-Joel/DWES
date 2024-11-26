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

    <form name='altaAlm' action= <?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?> method='POST'>
        Localidad del almacén: <input type='text' name='localidad' value='' size=5><br>
        <input type="submit" value="Dar de alta" name="alta">
    </FORM>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST")  
        {
            $localidad = recogerDatos("localidad");
            introducirAlm($localidad);
        }
    ?>

</BODY>

</HTML>