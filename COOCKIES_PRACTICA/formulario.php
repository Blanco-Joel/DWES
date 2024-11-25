<?php
    include_once('./funciones.php');
?>
<HTML>

<HEAD> 
 <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>FORMULARIO</title>
  </head>

</HEAD>

    <body>
        <h1>FORMULARIO</h1>
        <form method="post" name="usuario" class="registro" action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>>
            <label>Usuario</label>
            <input type="text"  id="usuario" name="usuario">
            <label>Contraseña</label>
            <input type="text"  id="passw" name="passw">
            <input type="submit" value="Aceptar" name="aceptar" id="aceptar">
        </form>
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                hacerCoockie();     
            }
            ?>
    </body>
</html>