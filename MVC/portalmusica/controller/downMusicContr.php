<?php
require_once ("cookieContr.php");
session_start();
compCookie();

require_once ("../model/downMusicModel.php");
$mess ="";
$user = (string)$_COOKIE['USERPASS'];
    var_dump($_COOKIE);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["next"])) {
        //model/downMusicModel.php
        $totalSongs = getTotalSongs();
        // cookieContr.php
        if ($_COOKIE["OFFSET"]+20 >= $totalSongs) {
            makecookie("OFFSET",0);
            $_COOKIE["OFFSET"] = 0; 
        } else {
            makecookie("OFFSET",$_COOKIE["OFFSET"] + 20);
            $_COOKIE["OFFSET"] += 20;
        }
    }
    if (isset($_POST["prev"])) {
        //model/downMusicModel.php
        $totalSongs = getTotalSongs();
        //cookieContr.php
        if ($_COOKIE["OFFSET"] <= 20) {
            makecookie("OFFSET",max(0,$totalSongs - ($totalSongs % 20)));
            $_COOKIE["OFFSET"] = max(0,$totalSongs - ($totalSongs % 20));
        }else{
            makecookie("OFFSET",max(0,$_COOKIE["OFFSET"]-20));
            $_COOKIE["OFFSET"] = max(0,$_COOKIE["OFFSET"]-20);
        }
    }
    if (isset($_POST["annadir"])) {
        require_once ("dataContr.php");
        $song = recogerDatos("songs");
        var_dump($user);
        var_dump($_SESSION[$user]);
        var_dump($_SESSION);

        //cookieContr.php
        $cart = isset($_SESSION[$user]) ?  $_SESSION[$user] : array();
        $cart[$song] = !isset($cart[$song]) ? $cart[$song] = 1   : $cart[$song] += 1;
        $mess .= "Se ha añadido la canción: " . $song . " por ". $cart[$song] ." º vez.<br><br>";
        saveCart($cart);
    }
    if (isset($_POST["buy"])) {
        if (isset($_SESSION[$user])) {
            $visualAmount = 0;
            require_once ("dataContr.php");
            foreach ($_SESSION[$user] as $song => $units) {
                //model/downMusicModel.php

                $visualAmount += getPrice($song,$units);
            }

            $amount = floatval($visualAmount)*100;
            $mess = "EL PRECIO A PAGAR SON ".$visualAmount. "<br><br>";
            $payOrder = getPayOrder();

            require_once ("payContr.php");
            $button = "<br><br>
                        <form action='https://sis-t.redsys.es:25443/sis/realizarPago' method='POST' target='_blank'>
                            <input type='hidden' name='Ds_SignatureVersion' value='HMAC_SHA256_V1'/>
                            <input type='hidden' name='Ds_MerchantParameters' value='$params'/>
                            <input type='hidden' name='Ds_Signature' value='$firma'/>
                            <input type='submit' value='Realizar Pago' class='btn btn-warning disabled'/>
                        </form>";
        } else {
            $mess = "No hay canciones en el carro.<br><br>";
        }
    }
    var_dump($_SESSION);
}    
if (isset($_POST["clear"])) {
    
    // cookieContr.php
    deleteCart();
}

if (isset($_POST["Volver"])) {
    header("Location: ../controller/welcomeContr.php");
    
    // cookieContr.php
    deleteIndexSong();
}
if (!isset($_COOKIE["OFFSET"])) {
    
    // cookieContr.php
    makecookie("OFFSET",0);
    $data = getList(0);
}else {
    $data = getList($_COOKIE["OFFSET"]);
}
require_once ("../view/downMusicView.php");
?>