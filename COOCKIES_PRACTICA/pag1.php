<?php
    include_once('./funciones.php');
?><HTML>

<HEAD> 
 <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Página 1</title>
  </head>

</HEAD>

<body>
        <h1>Página 1</h1>
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