<?php
     //Llama a la funcion busquedaBBDD y definirCookie, compara dichos resultados y crea la cookie.
    function makecookie($nombre,$datos)
    {    
        setcookie((string) $nombre,(string)  $datos , time() + (86400 * 30), "/"); // 86400 segundos = 1 día
    }
    //Comprueba la cookie en cada inicio de cada página.
    function compCookie()
    {    
        if(!isset($_COOKIE["USERPASS"]) || !isset($_COOKIE["NAME"]))
        {
            setcookie("NAME", "0", (time() - 3600), "/"); // 86400 segundos = 1 día
            setcookie("USERPASS", "0", (time() - 3600), "/"); // 86400 segundos = 1 día
            header("Location: ../index.php");
        }
        
    }
    function compCookieIndex()
    {    
        if(isset($_COOKIE["USERPASS"]) && isset($_COOKIE["NAME"])) 
            header("Location: controller/welcomeContr.php");
        
    }
    //Elimina la cookie.
    function deleteCookie()     
    {
        if(isset($_COOKIE["USERPASS"])) {
            setcookie("NAME", "0", (time() - 3600), "/"); // 86400 segundos = 1 día
            setcookie("USERPASS", "0", (time() - 3600), "/"); // 86400 segundos = 1 día
            if(isset($_COOKIE["CART"])) {
                setcookie("CART", "0", (time() - 3600), "/"); // 86400 segundos = 1 día
            }
            if(isset($_COOKIE["OFFSET"])) 
            setcookie("OFFSET", "0", (time() - 3600), "/"); // 86400 segundos = 1 día

            header("Location: ../index.php");
        }

    }
    function saveCart($songData)
    {    
        $_SESSION["SONGS".$_COOKIE['USERPASS']] = $songData;
    }

    function deleteCart()
    {
        unset($_SESSION["SONGS".$_COOKIE['USERPASS']] );
        if (isset($_SESSION["SONGS".$_COOKIE['USERPASS']] )) {
        }
    }

    function deleteIndexSong()
    {
        if(isset($_COOKIE["OFFSET"])) 
            setcookie("OFFSET", "0", (time() - 3600), "/"); // 86400 segundos = 1 día
        if(isset($_COOKIE["F3"])) 
            setcookie("F3", "0", (time() - 3600), "/"); // 86400 segundos = 1 día
        if(isset($_COOKIE["F2"])) 
            setcookie("F2", "0", (time() - 3600), "/"); // 86400 segundos = 1 día
        if(isset($_COOKIE["F1"])) 
            setcookie("F1", "0", (time() - 3600), "/"); // 86400 segundos = 1 día


        
    }

 
 ?>

