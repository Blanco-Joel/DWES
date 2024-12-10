<?php
    session_start();

    if (!isset($_SESSION['contador'])) 
        $_SESSION['contador'] = 1;
    if (!isset($_SESSION['usuario'])) 
        $_SESSION['usuario'] = "";
    
?>
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
                $contrasenia = password_hash(recogerDatos("passw"), PASSWORD_DEFAULT);
                $comprobarDatos = busquedaBBDD($usuario,$contrasenia);
                if (!empty($comprobarDatos)) 
                {
                    if (password_verify($comprobarDatos[0][0],$contrasenia))
                    {
                        hacerCoockie($usuario);
                        session_unset();
                        session_destroy();
                        setcookie("PHPHSESID","",time()-3600,"/");
                    }
                }elseif(!isset($_COOKIE["USERPASS"])) 
                {   
                    if (empty($_SESSION['usuario']) || $_SESSION['usuario'] != $usuario)
                    {
                        $_SESSION['usuario'] = $usuario;
                        $_SESSION['contador'] = 1;
                        mensajeFallo(); 
                    }elseif($_SESSION['usuario'] == $usuario)  
                    {
                        $_SESSION['contador'] += 1;
                        mensajeFallo(); 
                    }
                }
                var_dump($_SESSION['contador']);
                var_dump($_SESSION['usuario']);
                
                if ($_SESSION['contador'] == 3)               
                {
                    mensajeFalloFinal(); 
                    session_unset();
                    session_destroy();
                    setcookie("PHPHSESID","",time()-3600,"/");
                }

            }
            ?>
    </body>
</HTML>