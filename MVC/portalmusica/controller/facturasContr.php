<?php
require_once ("cookieContr.php");
session_start();
compCookie();

$id = (string) $_COOKIE['USERPASS'];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["consultar"])) {
        require_once ("dataContr.php");
        $firstDate = recogerDatos("fechadesde");
        $secondDate = recogerDatos("fechahasta");
        if (!empty($firstDate) && !empty($secondDate))
        {
            require_once ("../model/facturasModel.php");
            $data = getList($id,$firstDate,$secondDate);
        }   
    }
}

if (isset($_POST["Volver"])) {
    header("Location: ../controller/welcomeContr.php");
}

require_once ("../view/facturasView.php");
?>