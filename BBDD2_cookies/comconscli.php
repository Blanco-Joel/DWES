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

<BODY>

    <form name='altaCat' action= <?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?> method='POST'>
        Priemra Fecha[AAAA-MM-DD]: <input type='text' name='ini' value='' size=15><br><br>
        Segunda Fecha[AAAA-MM-DD]: <input type='text' name='fin' value='' size=15><br><br>
        <input type="submit" value="Comprobar" name="comprobar">
        <input type="submit" value="Cerrar Sesion" name="cerrarSes">   


    </FORM>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST")  
        {
            if(isset($_POST['comprobar']))
            {
                $fecha_inicio = recogerDatos("ini");
                $fecha_final = recogerDatos("fin");
                $NIF = $_COOKIE["USERPASS"];
                comprobarCompras($NIF,$fecha_inicio,$fecha_final);
            }
            
            if (isset($_POST['cerrarSes'])) {
                borrarCookie();     
                boorarCesta();
            }
        }
    ?>

</BODY>

</HTML>