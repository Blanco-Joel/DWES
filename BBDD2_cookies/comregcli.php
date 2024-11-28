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

    <form name='altaCliente' action= <?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?> method='POST'>
        <label for="nif">NIF:</label>
        <input type="text" id="nif" name="nif" maxlength="9" required>
        <br>

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" maxlength="40">
        <br>

        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" maxlength="40">
        <br>

        <label for="cp">Código Postal (CP):</label>
        <input type="text" id="cp" name="cp" maxlength="5">
        <br>

        <label for="direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion" maxlength="40">
        <br>

        <label for="ciudad">Ciudad:</label>
        <input type="text" id="ciudad" name="ciudad" maxlength="40">
        <br>

        <input type="submit" value="Registrarme" name="registro">
    </form>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST")  
        {
            $nif = recogerDatos("nif");
            $nombre = recogerDatos("nombre");
            $apellido = recogerDatos("apellido");
            $cp = recogerDatos("cp");
            $direccion = recogerDatos("direccion");
            $ciudad = recogerDatos("ciudad");
            introducirClienteCompleto($nif,$nombre,$apellido,$cp,$direccion,$ciudad);
        }
    ?>

</BODY>

</HTML>