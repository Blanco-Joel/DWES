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
            <button type="submit"><a href="./pe_signin.php">Sign In</a></button>
        </form>
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $usuario     = recogerDatos("usuario");
                $compararClave = recogerDatos("passw");
                $contrasenia = password_hash(recogerDatos("passw"), PASSWORD_DEFAULT);
                $comprobarDatos = busquedaBBDD($usuario);
                if (!empty($comprobarDatos)) 
                {
                    if (password_verify($compararClave,$comprobarDatos[0][0]))
                    {
                        hacerCoockie($usuario);
                        session_unset();
                        session_destroy();
                        cambiarInicio($usuario);
                        setcookie("PHPHSESSID","",time()-3600,"/");
                    }elseif (empty($_SESSION['usuario']) || $_SESSION['usuario'] != $usuario)
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
                
                if ($_SESSION['contador'] == 3)               
                {
                    mensajeFalloFinal(); 
                    session_unset();
                    session_destroy();
                    setcookie("PHPSESID","",time()-3600,"/");
                    bloqueoUser($usuario);
                }
            
            }
            ?>
    </body>
</HTML>