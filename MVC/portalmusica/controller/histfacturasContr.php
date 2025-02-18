<?php
require_once ("cookieContr.php");
session_start();
compCookie();

require_once ("../model/rankingModel.php");
$mess ="";
$user = (string)$_COOKIE['USERPASS'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["next"])) {
        //model/rankingModel.php
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
        //model/rankingModel.php
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
require_once ("../view/rankingView.php");
?>