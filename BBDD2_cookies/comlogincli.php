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
                $usuario     = recogerDatos("usuario");
                $contrasenia = recogerDatos("passw");
                $comprobarDatos = busquedaBBDD($usuario,$contrasenia);
                if (!empty($comprobarDatos))
                {
                    hacerCoockie($usuario,$contrasenia);
                    cambiarAcceso($usuario);
                }elseif(!isset($_COOKIE["USERPASS"])) {
                    mensajeFallo();
                }
            }
            ?>
    </body>
</HTML>