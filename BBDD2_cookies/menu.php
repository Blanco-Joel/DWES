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

<body>
        <h1>MENÚ</h1>
        <ul>
            <li>
                <a href="./pag2.php">Página 2 </a>
            </li>
            <li>
                <a href="./comconscli.php">Comprobar Compras </a>
            </li>
        </ul>
        <form method="post" name="usuario" class="registro" action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>>
            <input type="submit" value="Cerrar sesión" name="cerrar" id="cerrar">
        </form>
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                borrarCookie();     
            }
        ?>
    </body>
</html>