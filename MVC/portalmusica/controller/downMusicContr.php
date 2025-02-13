<?php
require_once ("cookieContr.php");
session_start();
compCookie();

require_once ("../model/downMusicModel.php");

$data = getList();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["annadir"])) {
        require_once ("dataContr.php");
        $song = recogerDatos("songs");

        if (isset($_SESSION['SONGS'])) {
            $_SESSION['SONGS'][] = array_push($song);
        } else {
            $_SESSION['SONGS'] = [$song];
        }
        $mess .= "Se hao la canción: " . $employee . ".<br><br>";
    }
    
    if (isset($_POST["buy"])) {
        if (isset($_SESSION["SONGS"])) {
            $datas = $_SESSION["SONGS"];
            $mess = "";
            foreach ($datas as $employee) {
                $lastNum = getLastNo();
                insertAll($lastNum, $employee);
                $mess .= "Se ha descargado la canción: " . $employee . ".<br><br>";
            }
            unset($_SESSION["SONGS"]);
        } else {
            $mess = "No hay canciones en el carro.<br><br>";
        }
    }
}    

if (isset($_POST["Volver"])) {
    header("Location: ../controller/welcomeContr.php");
    exit();
}

require_once ("../view/downMusicView.php");
?>