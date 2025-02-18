<?php
require_once ("cookieContr.php");
session_start();
compCookie();

require_once ("../model/rankingModel.php");
$mess ="";
$user = (string)$_COOKIE['USERPASS'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["consultar"]) || isset($_POST["next"]) || isset($_POST["prev"] )) {
        require_once ("dataContr.php");
        $firstDate = recogerDatos("fechadesde");
        $secondDate = recogerDatos("fechahasta");

            if (isset($_POST["next"])) {
                //model/rankingModel.php

                // cookieContr.php
                if ($_COOKIE["OFFSET"]+10 >= $_COOKIE["F3"]) {
                    makecookie("OFFSET",0);
                    $_COOKIE["OFFSET"] = 0; 
                } else {
                    makecookie("OFFSET",$_COOKIE["OFFSET"] + 10);
                    $_COOKIE["OFFSET"] += 10;
                }
            }
            if (isset($_POST["prev"])) {


                //cookieContr.php
                if ($_COOKIE["OFFSET"] <= 10) {
                    makecookie("OFFSET",max(0,$_COOKIE["F3"] - ($_COOKIE["F3"] % 10)));
                    $_COOKIE["OFFSET"] = max(0,$_COOKIE["F3"] - ($_COOKIE["F3"] % 10));
                }else{
                    makecookie("OFFSET",max(0,$_COOKIE["OFFSET"]-10));
                    $_COOKIE["OFFSET"] = max(0,$_COOKIE["OFFSET"]-10);
                }
            }
            if (!empty($firstDate) && !empty($secondDate))
            {
                makecookie("F1",$firstDate);
                $_COOKIE["F1"] = $firstDate;
                makecookie("F2",$secondDate);
                $_COOKIE["F2"] = $secondDate;

                $totalSongs = getTotalSongs($_COOKIE["F1"],$_COOKIE["F2"]);
                makecookie("F3",$totalSongs);
                $_COOKIE["F3"] = $totalSongs;
            }
            if (!isset($_COOKIE["OFFSET"])) {
                
                // cookieContr.php
                makecookie("OFFSET",0);
                $_COOKIE["OFFSET"] = 0; 
        
                $data = getList(0,$firstDate,$secondDate);
            }else {
                $data = getList($_COOKIE["OFFSET"],$_COOKIE["F1"],$_COOKIE["F2"]);
            }
        
    }
   
}    

if (isset($_POST["Volver"])) {
    header("Location: ../controller/welcomeContr.php");
    
    // cookieContr.php
    deleteIndexSong();
}

require_once ("../view/rankingView.php");
?>