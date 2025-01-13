<?php
     //Llama a la funcion busquedaBBDD y definirCookie, compara dichos resultados y crea la cookie.
    function makecookie($datos)
    {    
        setcookie("USERPASS", $datos[0]['email'] , time() + (86400 * 30), "/"); // 86400 segundos = 1 día
        header("Location: view/welcome.php");
    }
    //Comprueba la cookie en cada inicio de cada página.
    function comprobarCookie()
    {    
        if(!isset($_COOKIE["USERPASS"])) {
            header("Location: view/login.php");
        }
    }
    //Elimina la cookie.
    function borrarCookie()     
    {
        if(isset($_COOKIE["USERPASS"])) {
            setcookie("USERPASS", "0", (time() - 3600), "/"); // 86400 segundos = 1 día
            header("Location: ./pe_login.php");
        }

    }

 
 ?>
?>
