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
        <label >Nombre del empleado:</label> <input type='text' name='nombre' value='' size=40><br>
        <label >Apellidos del empleado:</label> <input type='text' name='apellido' value='' size=40><br>
        <label >DNI del empleado:</label> <input type='text' name='DNI' value='' size=9><br>
        <label >Salario del empleado:</label> <input type='text' name='salario' value='' size=8><br>
        <label >Fecha de nacimiento del empleado:</label> <input type='text' name='fecha_nac' value='' size=8><br>
        <label >Departamento del empleado:</label>
            <?php crearDesplegable() ?>
        <br><br>
        <input type="submit" value="Dar de alta" name="alta">
    </FORM>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST")  
        {
            $nombre = recogerDatos("nombre");
            $ape = recogerDatos("apellido");
            $dni = recogerDatos("DNI");
            $salario = recogerDatos("salario");
            $fecha_nac = recogerDatos("fecha_nac");
            $cod_dpto = recogerDatos("cod_dpto");
            introducirEmple($nombre,$ape,$dni,$salario,$cod_dpto,$fecha_nac);
        }
    ?>

</BODY>

</HTML>